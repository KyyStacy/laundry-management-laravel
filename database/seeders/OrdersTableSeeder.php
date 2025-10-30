<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Order 1 - Status: Selesai
        $orderId1 = 'ORD-' . time() . '-001';
        DB::table('orders')->insert([
            'id_order' => $orderId1,
            'user_id' => 4, // Budi Santoso
            'address_id' => 1,
            'jadwal_penjemputan' => Carbon::now()->subDays(5)->setTime(9, 0),
            'jadwal_pengantaran' => Carbon::now()->subDays(3),
            'status' => 'Selesai',
            'metode_pembayaran' => 'Cash On Delivery (COD)',
            'snap_token' => null,
            'created_at' => Carbon::now()->subDays(5),
            'updated_at' => Carbon::now()->subDays(3),
        ]);

        DB::table('order_details')->insert([
            [
                'order_id' => $orderId1,
                'jenis_laundry' => 'Pakaian Reguler',
                'jumlah' => 5,
                'harga' => 30000,
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(4),
            ],
            [
                'order_id' => $orderId1,
                'jenis_laundry' => 'Selimut',
                'jumlah' => 2,
                'harga' => 40000,
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],
        ]);

        // Order 2 - Status: Diantar
        $orderId2 = 'ORD-' . time() . '-002';
        DB::table('orders')->insert([
            'id_order' => $orderId2,
            'user_id' => 5, // Siti Nurhaliza
            'address_id' => 3,
            'jadwal_penjemputan' => Carbon::now()->subDays(3)->setTime(14, 0),
            'jadwal_pengantaran' => Carbon::now(),
            'status' => 'Diantar',
            'metode_pembayaran' => 'Belum Dipilih',
            'snap_token' => null,
            'created_at' => Carbon::now()->subDays(3),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('order_details')->insert([
            [
                'order_id' => $orderId2,
                'jenis_laundry' => 'Pakaian Ekspress',
                'jumlah' => 3,
                'harga' => 27000,
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'order_id' => $orderId2,
                'jenis_laundry' => 'Sepatu',
                'jumlah' => 1,
                'harga' => 25000,
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3),
            ],
        ]);

        // Order 3 - Status: Diproses
        $orderId3 = 'ORD-' . time() . '-003';
        DB::table('orders')->insert([
            'id_order' => $orderId3,
            'user_id' => 6, // Ahmad Hidayat
            'address_id' => 4,
            'jadwal_penjemputan' => Carbon::now()->subDays(2)->setTime(10, 0),
            'jadwal_pengantaran' => Carbon::now()->addDays(1),
            'status' => 'Diproses',
            'metode_pembayaran' => 'Belum Dipilih',
            'snap_token' => null,
            'created_at' => Carbon::now()->subDays(2),
            'updated_at' => Carbon::now()->subHours(5),
        ]);

        DB::table('order_details')->insert([
            [
                'order_id' => $orderId3,
                'jenis_laundry' => 'Pakaian Reguler',
                'jumlah' => 8,
                'harga' => 48000,
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'order_id' => $orderId3,
                'jenis_laundry' => 'Boneka',
                'jumlah' => 3,
                'harga' => 30000,
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
        ]);

        // Order 4 - Status: Dijemput (baru dijemput, pakaian belum ditimbang)
        $orderId4 = 'ORD-' . time() . '-004';
        DB::table('orders')->insert([
            'id_order' => $orderId4,
            'user_id' => 4, // Budi Santoso (alamat kedua)
            'address_id' => 2,
            'jadwal_penjemputan' => Carbon::now()->subHours(2),
            'jadwal_pengantaran' => Carbon::now()->addDays(2),
            'status' => 'Dijemput',
            'metode_pembayaran' => 'Belum Dipilih',
            'snap_token' => null,
            'created_at' => Carbon::now()->subDays(1),
            'updated_at' => Carbon::now()->subHours(2),
        ]);

        DB::table('order_details')->insert([
            [
                'order_id' => $orderId4,
                'jenis_laundry' => 'Pakaian Reguler',
                'jumlah' => 0, // Belum ditimbang
                'harga' => 0,
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'order_id' => $orderId4,
                'jenis_laundry' => 'Tas',
                'jumlah' => 2,
                'harga' => 40000,
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1),
            ],
        ]);

        // Order 5 - Status: Dikonfirmasi (menunggu penjemputan)
        $orderId5 = 'ORD-' . time() . '-005';
        DB::table('orders')->insert([
            'id_order' => $orderId5,
            'user_id' => 5, // Siti Nurhaliza
            'address_id' => 3,
            'jadwal_penjemputan' => Carbon::now()->addHours(3),
            'jadwal_pengantaran' => Carbon::now()->addDays(3),
            'status' => 'Dikonfirmasi',
            'metode_pembayaran' => 'Belum Dipilih',
            'snap_token' => null,
            'created_at' => Carbon::now()->subHours(5),
            'updated_at' => Carbon::now()->subHours(4),
        ]);

        DB::table('order_details')->insert([
            [
                'order_id' => $orderId5,
                'jenis_laundry' => 'Pakaian Ekspress',
                'jumlah' => 0, // Belum ditimbang
                'harga' => 0,
                'created_at' => Carbon::now()->subHours(5),
                'updated_at' => Carbon::now()->subHours(5),
            ],
            [
                'order_id' => $orderId5,
                'jenis_laundry' => 'Sepatu',
                'jumlah' => 3,
                'harga' => 75000,
                'created_at' => Carbon::now()->subHours(5),
                'updated_at' => Carbon::now()->subHours(5),
            ],
        ]);

        // Order 6 - Status: Menunggu Konfirmasi (baru dibuat)
        $orderId6 = 'ORD-' . time() . '-006';
        DB::table('orders')->insert([
            'id_order' => $orderId6,
            'user_id' => 6, // Ahmad Hidayat
            'address_id' => 4,
            'jadwal_penjemputan' => Carbon::now()->addHours(6),
            'jadwal_pengantaran' => Carbon::now()->addDays(4),
            'status' => 'Menunggu Konfirmasi',
            'metode_pembayaran' => 'Belum Dipilih',
            'snap_token' => null,
            'created_at' => Carbon::now()->subMinutes(30),
            'updated_at' => Carbon::now()->subMinutes(30),
        ]);

        DB::table('order_details')->insert([
            [
                'order_id' => $orderId6,
                'jenis_laundry' => 'Pakaian Reguler',
                'jumlah' => 0, // Belum ditimbang
                'harga' => 0,
                'created_at' => Carbon::now()->subMinutes(30),
                'updated_at' => Carbon::now()->subMinutes(30),
            ],
        ]);

        // Order 7 - Status: Menunggu Pembayaran (sudah diantar, menunggu bayar via payment gateway)
        $orderId7 = 'ORD-' . time() . '-007';
        DB::table('orders')->insert([
            'id_order' => $orderId7,
            'user_id' => 4, // Budi Santoso
            'address_id' => 1,
            'jadwal_penjemputan' => Carbon::now()->subDays(4)->setTime(15, 0),
            'jadwal_pengantaran' => Carbon::now()->subDays(1),
            'status' => 'Menunggu Pembayaran',
            'metode_pembayaran' => 'Payment Gateway (Non Tunai)',
            'snap_token' => 'dummy-snap-token-' . time(),
            'created_at' => Carbon::now()->subDays(4),
            'updated_at' => Carbon::now()->subDays(1),
        ]);

        DB::table('order_details')->insert([
            [
                'order_id' => $orderId7,
                'jenis_laundry' => 'Pakaian Ekspress',
                'jumlah' => 10,
                'harga' => 90000,
                'created_at' => Carbon::now()->subDays(4),
                'updated_at' => Carbon::now()->subDays(3),
            ],
            [
                'order_id' => $orderId7,
                'jenis_laundry' => 'Selimut',
                'jumlah' => 1,
                'harga' => 20000,
                'created_at' => Carbon::now()->subDays(4),
                'updated_at' => Carbon::now()->subDays(4),
            ],
            [
                'order_id' => $orderId7,
                'jenis_laundry' => 'Boneka',
                'jumlah' => 2,
                'harga' => 20000,
                'created_at' => Carbon::now()->subDays(4),
                'updated_at' => Carbon::now()->subDays(4),
            ],
        ]);
    }
}

