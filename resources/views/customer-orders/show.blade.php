<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
                Detail Pesanan - {{ $order->id_order }}
            </h2>
            <a href="{{ route('customer.orders.index') }}" class="px-5 py-2.5 bg-gradient-to-r from-slate-700 to-slate-600 text-gray-300 font-semibold rounded-lg hover:from-slate-600 hover:to-slate-500 transition-all duration-300">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Customer Info Card -->
            <div class="bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-md shadow-xl border border-purple-500/20 rounded-xl p-6 hover:border-purple-500/40 transition-all duration-300">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Tanggal Pemesanan</p>
                        <p class="text-gray-200 font-medium">{{ $order->created_at->format('d-m-Y H.i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Pelanggan</p>
                        <p class="text-gray-200 font-medium">{{ $order->address->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Alamat</p>
                        <p class="text-gray-200 font-medium">{{ $order->address->alamat }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm mb-1">WhatsApp</p>
                        <p class="text-gray-200 font-medium">{{ $order->address->whatsapp }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Status</p>
                        @php
                            $statusColors = [
                                'Menunggu Konfirmasi' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                                'Dikonfirmasi' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                                'Dijemput' => 'bg-purple-500/20 text-purple-400 border-purple-500/30',
                                'Diproses' => 'bg-cyan-500/20 text-cyan-400 border-cyan-500/30',
                                'Diantar' => 'bg-orange-500/20 text-orange-400 border-orange-500/30',
                                'Selesai' => 'bg-green-500/20 text-green-400 border-green-500/30',
                                'Menunggu Pembayaran' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                                'Gagal' => 'bg-red-500/20 text-red-400 border-red-500/30',
                            ];
                            $statusClass = $statusColors[$order->status] ?? 'bg-gray-500/20 text-gray-400 border-gray-500/30';
                        @endphp
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full border {{ $statusClass }}">
                            {{ $order->status }}
                        </span>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Jadwal Penjemputan</p>
                        @php
                            $startTime = strtotime($order->jadwal_penjemputan);
                            $endTime = strtotime('+1 hour', $startTime);
                        @endphp
                        <p class="text-gray-200 font-medium">{{ date('d-m-Y H.i', $startTime) }}-{{ date('H.i', $endTime) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Jadwal Pengantaran</p>
                        <p class="text-gray-200 font-medium">{{ $order->jadwal_pengantaran->format('d-m-Y') }} 15.00-21.00</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Metode Pembayaran</p>
                        <p class="text-gray-200 font-medium">{{ $order->metode_pembayaran }}</p>
                    </div>
                </div>
            </div>

            <!-- Order Details Card -->
            <div class="bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-md shadow-xl border border-purple-500/20 rounded-xl overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent mb-4">Detail Laundry</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-purple-500/30">
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Jenis Laundry</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Jumlah</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Harga</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-purple-500/10">
                                @php 
                                    $total = 0;
                                    $hasPakaianBelumDitimbang = false;
                                @endphp
                                @foreach($order->orderDetails as $detail)
                                    <tr class="hover:bg-gradient-to-r hover:from-cyan-500/5 hover:to-purple-500/5 transition-all duration-300">
                                        <td class="px-6 py-4 text-gray-300">
                                            {{ $detail->jenis_laundry }}
                                            @if(strpos($detail->jenis_laundry, 'Pakaian') !== false)
                                                @if($detail->jumlah > 0)
                                                    <br><span class="text-sm text-green-400">✓ Sudah ditimbang</span>
                                                @else
                                                    <br><span class="text-sm text-yellow-400">Akan ditimbang saat penjemputan</span>
                                                    @php $hasPakaianBelumDitimbang = true; @endphp
                                                @endif
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-gray-300">
                                            @if(strpos($detail->jenis_laundry, 'Pakaian') !== false)
                                                @if($detail->jumlah > 0)
                                                    {{ $detail->jumlah }} Kg
                                                @else
                                                    <span class="text-gray-500">-</span>
                                                @endif
                                            @else
                                                {{ $detail->jumlah }} {{ $laundryTypes->firstWhere('nama_jenis', $detail->jenis_laundry)->satuan ?? '' }}
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-gray-300">
                                            @if($detail->harga > 0)
                                                Rp {{ number_format($detail->harga, 0, ',', '.') }}
                                                @php $total += $detail->harga; @endphp
                                            @else
                                                <span class="text-gray-500">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="border-t border-purple-500/30">
                                <tr>
                                    <td colspan="2" class="px-6 py-4 text-right font-bold text-cyan-400">Total:</td>
                                    <td class="px-6 py-4 font-bold text-green-400">Rp {{ number_format($total, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @if($hasPakaianBelumDitimbang)
                        <div class="mt-4 p-3 bg-yellow-500/10 border border-yellow-500/30 rounded-lg">
                            <p class="text-sm text-yellow-400 italic">
                                * Total harga belum termasuk pakaian yang belum ditimbang. Harga akan diperbarui setelah penimbangan.
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Payment Button -->
            @if(in_array($order->status, ['Diantar', 'Gagal', 'Menunggu Pembayaran']))
                <div class="flex justify-end">
                    @if($order->metode_pembayaran == 'Payment Gateway (Non Tunai)' || $order->status == 'Menunggu Pembayaran')
                        <button id="pay-button" class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-purple-500 text-white font-semibold rounded-lg shadow-lg hover:shadow-cyan-500/50 transform hover:scale-105 transition-all duration-300">
                            Lanjutkan Pembayaran
                        </button>
                    @elseif($order->metode_pembayaran == 'Belum Dipilih')
                        <button id="pay-button" class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-purple-500 text-white font-semibold rounded-lg shadow-lg hover:shadow-cyan-500/50 transform hover:scale-105 transition-all duration-300">
                            Bayar Sekarang
                        </button>
                    @endif
                </div>
            @endif
        </div>
    </div>
    @if($order->status == 'Diantar')
        <div id="paymentModal" class="fixed z-50 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-slate-900/90 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-gradient-to-br from-slate-800 to-slate-900 border border-purple-500/30 rounded-xl text-left overflow-hidden shadow-2xl shadow-purple-500/20 transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="px-6 pt-6 pb-4">
                        <h3 class="text-xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent mb-4" id="modal-title">
                            Pilih Metode Pembayaran
                        </h3>
                        <div class="space-y-3">
                            <label class="flex items-center p-4 bg-slate-700/50 border border-purple-500/20 rounded-lg cursor-pointer hover:border-cyan-500/50 transition-all duration-300">
                                <input type="radio" class="form-radio text-cyan-500 focus:ring-cyan-500" name="payment_method" value="cod">
                                <span class="ml-3 text-gray-300 font-medium">Cash On Delivery (COD)</span>
                            </label>
                            <label class="flex items-center p-4 bg-slate-700/50 border border-purple-500/20 rounded-lg cursor-pointer hover:border-cyan-500/50 transition-all duration-300">
                                <input type="radio" class="form-radio text-cyan-500 focus:ring-cyan-500" name="payment_method" value="midtrans">
                                <span class="ml-3 text-gray-300 font-medium">Payment Gateway (Non Tunai)</span>
                            </label>
                        </div>
                    </div>
                    <div class="bg-slate-900/50 px-6 py-4 sm:flex sm:flex-row-reverse gap-3">
                        <button type="button" id="confirmPayment" class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-cyan-500 to-purple-500 text-white font-semibold rounded-lg shadow-lg hover:shadow-cyan-500/50 transform hover:scale-105 transition-all duration-300">
                            Konfirmasi
                        </button>
                        <button type="button" id="cancelPayment" class="mt-3 sm:mt-0 w-full sm:w-auto px-6 py-3 bg-slate-700 text-gray-300 font-semibold rounded-lg hover:bg-slate-600 transition-colors duration-300">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        const payButton = document.getElementById('pay-button');
        const paymentModal = document.getElementById('paymentModal');
        const confirmPayment = document.getElementById('confirmPayment');
        const cancelPayment = document.getElementById('cancelPayment');

        payButton.addEventListener('click', function() {
            @if($order->metode_pembayaran == 'Payment Gateway (Non Tunai)')
                processPayment('{{ $order->id_order }}', 'midtrans');
            @else
                paymentModal.classList.remove('hidden');
            @endif
        });

        cancelPayment.addEventListener('click', function() {
            paymentModal.classList.add('hidden');
        });

        confirmPayment.addEventListener('click', function() {
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
            processPayment('{{ $order->id_order }}', paymentMethod);
        });

        function processPayment(orderId, paymentMethod) {
            axios.post(`/orders/${orderId}/process-payment`, {
                payment_method: paymentMethod,
                _token: '{{ csrf_token() }}'
            })
            .then(function (response) {
                if (response.data.success) {
                    if (paymentMethod === 'cod') {
                        alert(response.data.message);
                        window.location.reload();
                    } else {
                        snap.pay(response.data.snap_token, {
                            onSuccess: function(result){
                                updateOrderStatus(orderId, 'Selesai');
                            },
                            onPending: function(result){
                                updateOrderStatus(orderId, 'Menunggu Pembayaran');
                            },
                            onError: function(result){
                                updateOrderStatus(orderId, 'Gagal');
                            },
                            onClose: function(){
                                checkPaymentStatus(orderId);
                            }
                        });
                    }
                } else {
                    alert('Terjadi kesalahan saat memproses permintaan.');
                }
            })
            .catch(function (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.');
            });

            paymentModal.classList.add('hidden');
        }

        function updateOrderStatus(orderId, status) {
            axios.post('/orders/update-status', {
                order_id: orderId,
                status: status,
                _token: '{{ csrf_token() }}'
            })
            .then(function (response) {
                if (response.data.success) {
                    window.location.reload();
                } else {
                    alert('Gagal memperbarui status pembayaran.');
                }
            })
            .catch(function (error) {
                console.error('Error updating order status:', error);
                alert('Terjadi kesalahan saat memperbarui status pembayaran.');
            });
        }

        function checkPaymentStatus(orderId) {
            axios.get(`/orders/${orderId}/check-payment-status`)
            .then(function (response) {
                if (response.data.status === 'Selesai') {
                    alert('Pembayaran berhasil!');
                    window.location.reload();
                } else {
                    alert('Status pembayaran: ' + response.data.status);
                }
            })
            .catch(function (error) {
                console.error('Error checking payment status:', error);
                alert('Terjadi kesalahan saat memeriksa status pembayaran.');
            });
        }
    </script>
</x-app-layout>