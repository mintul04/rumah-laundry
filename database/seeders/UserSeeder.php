<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');
        // Admin
        User::create([
            'nama' => 'Admin',
            'nama_lengkap' => 'Admin Gilang',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Karyawan
        User::create([
            'nama' => 'Karyawan',
            'nama_lengkap' => 'Karyawan Manda',
            'email' => 'karyawan@gmail.com',
            'password' => Hash::make('karyawan123'),
            'role' => 'karyawan',
        ]);

        // Pelanggan
        Pelanggan::create([
            'nama' => 'Amanda',
            'no_telp' => '6285601398636',
        ]);
        Pelanggan::create([
            'nama' => 'Gilang',
            'no_telp' => '6287870327957',
        ]);

        for ($i=1; $i < 10; $i++) { 
            Pelanggan::create([
                'nama'    => $faker->name,
                'no_telp' => $faker->phoneNumber,
            ]);
        }
    }
}
