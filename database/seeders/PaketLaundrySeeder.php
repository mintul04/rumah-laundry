<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PaketLaundrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // database/seeders/PaketLaundrySeeder.php
public function run()
{
    DB::table('paket_laundries')->insert([
        [
            'nama_paket' => 'Cuci Komplit Standar',
            'harga' => 5000,
            'waktu_pengerjaan' => 24, // 24 jam
            'deskripsi' => 'Cuci, kering, dan setrika',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nama_paket' => 'Cuci Komplit Express',
            'harga' => 8000,
            'waktu_pengerjaan' => 3, // 3 jam
            'deskripsi' => 'Cuci express 3 jam selesai',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nama_paket' => 'Cuci Kering',
            'harga' => 4000,
            'waktu_pengerjaan' => 12, // 12 jam
            'deskripsi' => 'Cuci dan kering tanpa setrika',
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ]);
}
}