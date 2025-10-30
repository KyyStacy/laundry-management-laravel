<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaundryTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('laundry_types')->insert([
            ['nama_jenis' => 'Sprei (Sprei + Sarung Bantal)', 'satuan' => 'Set', 'harga_per_satuan' => 15000],
            ['nama_jenis' => 'Sprei', 'satuan' => 'Pcs', 'harga_per_satuan' => 10000],
            ['nama_jenis' => 'Bedcover (Single)', 'satuan' => 'Set', 'harga_per_satuan' => 25000],
            ['nama_jenis' => 'Bedcover (Queen)', 'satuan' => 'Set', 'harga_per_satuan' => 35000],
            ['nama_jenis' => 'Bedcover (King)', 'satuan' => 'Set', 'harga_per_satuan' => 40000],
            ['nama_jenis' => 'Boneka (Sedang)', 'satuan' => 'Pcs', 'harga_per_satuan' => 30000],
            ['nama_jenis' => 'Boneka (Jumbo)', 'satuan' => 'Pcs', 'harga_per_satuan' => 40000],
            ['nama_jenis' => 'Wearpack (Celana + Baju)', 'satuan' => 'Set', 'harga_per_satuan' => 20000],
            ['nama_jenis' => 'Wearpack', 'satuan' => 'Pcs', 'harga_per_satuan' => 10000],
            ['nama_jenis' => 'Selimut Bulu', 'satuan' => 'Pcs', 'harga_per_satuan' => 15000],
            ['nama_jenis' => 'Sajadah', 'satuan' => 'Pcs', 'harga_per_satuan' => 15000],
            ['nama_jenis' => 'Jas', 'satuan' => 'Set', 'harga_per_satuan' => 30000],
            ['nama_jenis' => 'Jaket Jeans', 'satuan' => 'Pcs', 'harga_per_satuan' => 15000],
            ['nama_jenis' => 'Sepatu', 'satuan' => 'Pasang', 'harga_per_satuan' => 25000],
        ]);
    }
}
