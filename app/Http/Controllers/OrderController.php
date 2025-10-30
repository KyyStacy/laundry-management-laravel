<?php

namespace App\Http\Controllers;

use App\Mail\NewOrderNotification;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Address;
use App\Models\LaundryType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

class OrderController extends Controller
{

    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function create()
    {
        $user = Auth::user();
        $addresses = Address::where('user_id', $user->id)
                            ->where('is_active', true)
                            ->get();
        $laundryTypes = LaundryType::all();
        $existingOrders = Order::where('user_id', $user->id)->get();

        if ($addresses->isEmpty()) {
            return view('orders.no_address');
        }

        return view('orders.create', compact('addresses', 'laundryTypes', 'existingOrders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
            'laundry_types' => 'required|array',
            'laundry_types.*' => 'required|string',
            'quantities' => 'required|array',
            'quantities.*' => 'nullable|integer|min:0',
            'pickup_date' => 'required|in:today,tomorrow',
            'pickup_time' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $user = Auth::user();
            
            $dateFormat = Carbon::now()->format('dmY');
            $isExpress = in_array('pakaian_ekspress', $request->laundry_types);
            $orderType = $isExpress ? 'EXP' : 'REG';
            $randomPart = strtoupper(Str::random(4));
            $orderId = "TRX-{$dateFormat}-{$orderType}{$randomPart}";

            $pickupDateTime = $this->formatPickupDateTime($request->pickup_date, $request->pickup_time);
            $deliveryDate = $isExpress ? $pickupDateTime->toDateString() : $request->delivery_date;

            $order = new Order([
                'id_order' => $orderId,
                'user_id' => $user->id,
                'address_id' => $request->address_id,
                'jadwal_penjemputan' => $pickupDateTime,
                'jadwal_pengantaran' => $deliveryDate,
                'status' => 'Menunggu Penjemputan',
                'metode_pembayaran' => 'Belum Dipilih',
            ]);

            $order->save();

            $laundryTypes = $request->laundry_types;

            foreach ($laundryTypes as $type) {
                if ($type === 'pakaian_ekspress' || $type === 'pakaian_reguler') {
                    $jenisLaundry = ($type === 'pakaian_reguler') ? 'Pakaian Reguler' : 'Pakaian Ekspress';
                    
                    OrderDetail::create([
                        'order_id' => $orderId,
                        'jenis_laundry' => $jenisLaundry,
                        'jumlah' => 0,
                        'harga' => 0,
                    ]);
                } else {
                    $laundryType = LaundryType::find($type);
                    if ($laundryType && isset($request->quantities[$type]) && $request->quantities[$type] > 0) {
                        OrderDetail::create([
                            'order_id' => $orderId,
                            'jenis_laundry' => $laundryType->nama_jenis,
                            'jumlah' => $request->quantities[$type],
                            'harga' => $laundryType->harga_per_satuan * $request->quantities[$type],
                        ]);
                    }
                }
            }

            DB::commit();

            // Kirim email (jangan biarkan gagal email menghalangi redirect)
            try {
                // Kirim email ke pelanggan
                Mail::to($user->email)->send(new NewOrderNotification($order));

                // Kirim email ke karyawan (asumsikan semua user dengan role 'karyawan' akan menerima notifikasi)
                $karyawanEmails = User::where('role', 'karyawan')->pluck('email');
                if ($karyawanEmails->count() > 0) {
                    Mail::to($karyawanEmails)->send(new NewOrderNotification($order));
                }
            } catch (\Exception $e) {
                // Log error tapi tetap lanjut redirect
                logger()->error('Gagal mengirim email notifikasi: ' . $e->getMessage());
            }

            return redirect()->route('orders.show', $orderId)->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat membuat pesanan. Silakan coba lagi.'])->withInput();
        }
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('orders.show', compact('order'));
    }

    private function formatPickupDateTime($pickupDate, $pickupTime)
    {
        $date = ($pickupDate === 'today') ? Carbon::today() : Carbon::tomorrow();
        $time = explode('-', $pickupTime)[0];
        return Carbon::parse($date->format('Y-m-d') . ' ' . $time . ':00');
    }

    public function employeeIndex()
    {
        $orders = Order::with('user')
                ->orderByRaw('status != "Selesai" DESC')
                ->orderBy('created_at', 'desc')
                ->get();
        return view('employee-orders.index', compact('orders'));
    }

    public function employeeShow(Order $order)
    {
        $order->load('user', 'address', 'orderDetails');
        $laundryTypes = LaundryType::all();
        return view('employee-orders.show', compact('order', 'laundryTypes'));
    }

    public function employeeUpdate(Request $request, Order $order)
    {
        $request->validate([
            'weights' => 'nullable|array',
            'weights.*' => 'numeric|min:0',
            'status' => 'required|in:Menunggu Penjemputan,Dijemput,Diproses,Siap Antar,Diantar,Selesai',
        ]);

        DB::beginTransaction();

        try {
            $order->status = $request->status;
            $order->save();

            if ($request->has('weights')) {
                foreach ($request->weights as $detailId => $weight) {
                    $orderDetail = $order->orderDetails()->findOrFail($detailId);
                    if (strpos($orderDetail->jenis_laundry, 'Pakaian') !== false) {
                        $orderDetail->jumlah = $weight;
                        $orderDetail->harga = $this->calculatePrice($orderDetail->jenis_laundry, $weight);
                        $orderDetail->save();
                    }
                }
            }

            DB::commit();
            return redirect()->route('employee.orders.show', $order->id_order)->with('success', 'Order berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui order. Silakan coba lagi.'])->withInput();
        }
    }

    private function calculatePrice($jenisLaundry, $weight)
    {
        if ($jenisLaundry === 'Pakaian Reguler') {
            return $weight * 7000;
        } elseif ($jenisLaundry === 'Pakaian Ekspress') {
            return $weight * 15000;
        }
        return 0;
    }

    public function customerIndex()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->orderBy('created_at', 'desc')
                       ->get();
        return view('customer-orders.index', compact('orders'));
    }

    public function customerShow(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $laundryTypes = LaundryType::all();

        if (in_array($order->status, ['Diantar', 'Menunggu Pembayaran', 'Gagal'])) {
            if (!$order->snap_token) {
                $this->generateSnapToken($order);
            } elseif ($order->metode_pembayaran === 'Payment Gateway (Non Tunai)') {
                $this->checkPaymentStatus($order);
            }
        }

        return view('customer-orders.show', compact('order', 'laundryTypes'));
    }

    private function generateSnapToken(Order $order)
    {
        $params = [
            'transaction_details' => [
                'order_id' => $order->id_order,
                'gross_amount' => $order->orderDetails->sum('harga'),
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
                'phone' => $order->address->whatsapp,
            ],
            'callbacks' => [
                'finish' => route('orders.finish', $order->id_order),
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $order->snap_token = $snapToken;
            $order->save();
        } catch (\Exception $e) {
        }
    }

    private function checkPaymentStatus(Order $order)
    {
        try {
            $statusResponse = Transaction::status($order->id_order);
            if (is_object($statusResponse) && property_exists($statusResponse, 'transaction_status')) {
                $transactionStatus = $statusResponse->transaction_status;
                if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
                    $order->status = 'Selesai';
                    $order->save();
                }
            } else {
                Log::error('Unexpected Midtrans response format', ['response' => $statusResponse]);
            }
        } catch (\Exception $e) {
            Log::error('Error checking Midtrans payment status', ['error' => $e->getMessage()]);
        }
    }

    public function processPayment(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id() || !in_array($order->status, ['Diantar', 'Menunggu Pembayaran', 'Gagal'])) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'payment_method' => 'required|in:cod,midtrans',
        ]);

        if ($request->payment_method === 'cod') {
            $order->metode_pembayaran = 'Cash On Delivery (COD)';
            $order->status = 'Selesai';
            $order->save();
            return response()->json(['success' => true, 'message' => 'Pembayaran COD berhasil dipilih. Pesanan telah selesai.']);
        } else {
            $order->metode_pembayaran = 'Payment Gateway (Non Tunai)';
            $order->status = 'Menunggu Pembayaran';
            $order->save();

            if (!$order->snap_token) {
                $this->generateSnapToken($order);
            }

            return response()->json(['success' => true, 'snap_token' => $order->snap_token]);
        }
    }

    public function finishPayment(Request $request, Order $order)
    {
        return redirect()->route('customer.orders.show', $order->id_order)
            ->with('success', 'Pembayaran telah diproses. Silakan cek status pesanan Anda.');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string',
            'status' => 'required|in:Selesai,Menunggu Pembayaran,Gagal',
        ]);

        $order = Order::where('id_order', $request->order_id)->firstOrFail();
        $order->status = $request->status;
        $order->save();

        return response()->json(['success' => true]);
    }

    public function handlePaymentCallback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $order = Order::where('id_order', $request->order_id)->firstOrFail();

            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $order->status = 'Selesai';
            } elseif ($request->transaction_status == 'cancel' || $request->transaction_status == 'expire') {
                $order->status = 'Gagal';
            } elseif ($request->transaction_status == 'pending') {
                $order->status = 'Menunggu Pembayaran';
            }

            $order->save();

            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error'], 403);
        }
    }
}