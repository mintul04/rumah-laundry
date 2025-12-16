<?php

namespace Database\Seeders;

use App\Models\User;
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
    }
}
