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
            'nama_laundry' => 'Rumah Laundry',
            'email_laundry' => 'info@rumahlaundry.com',
            'alamat_laundry' => 'Jl. Laundry No. 123, Jakarta',
            'nama_pemilik' => 'amanda',
            'logo' => 'logos/logo.jpg',
        ]);
    }
}
