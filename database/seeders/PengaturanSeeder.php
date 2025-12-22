<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengaturan::create([
            'nama_laundry'    => 'RumahLaundry',
            'email_laundry'   => 'info@rumahlaundry.com',
            'alamat_laundry'  => 'Jl. Laundry No. 123, Jakarta',
            'nama_pemilik'    => 'amanda',
            'telepon_laundry' => 6281234567890,
        ]);
    }
}
