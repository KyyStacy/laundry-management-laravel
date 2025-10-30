<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('addresses')->insert([
            [
                'user_id' => 4, // Budi Santoso
                'name' => 'Budi Santoso',
                'whatsapp' => '081234567890',
                'alamat' => 'Jl. Malioboro No. 123, Yogyakarta',
                'latitude' => -7.7828,
                'longitude' => 110.3670,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4, // Budi Santoso - alamat kedua
                'name' => 'Budi Santoso (Kantor)',
                'whatsapp' => '081234567890',
                'alamat' => 'Jl. Solo No. 45, Yogyakarta',
                'latitude' => -7.7956,
                'longitude' => 110.3695,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5, // Siti Nurhaliza
                'name' => 'Siti Nurhaliza',
                'whatsapp' => '082345678901',
                'alamat' => 'Jl. Kaliurang Km 5, Sleman, Yogyakarta',
                'latitude' => -7.7520,
                'longitude' => 110.3800,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 6, // Ahmad Hidayat
                'name' => 'Ahmad Hidayat',
                'whatsapp' => '083456789012',
                'alamat' => 'Jl. Affandi No. 78, Yogyakarta',
                'latitude' => -7.7700,
                'longitude' => 110.3900,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

