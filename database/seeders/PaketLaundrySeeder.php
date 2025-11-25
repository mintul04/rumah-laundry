<?php

namespace Database\Seeders;

use App\Models\PaketLaundry;
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
    PaketLaundry::create([
        'nama_paket' => 'Cuci Komplit Standar',
        'harga' => 5000,
        'satuan' => 'kg',
        'waktu_pengerjaan' => 'regular',
        'deskripsi' => 'Cuci, kering, dan setrika',
    ]);
    PaketLaundry::create([
        'nama_paket' => 'Cuci Komplit Express',
        'harga' => 8000,
        'satuan' => 'kg',
        'waktu_pengerjaan' => 'express',
        'deskripsi' => 'Cuci express 3 jam selesai',
    ]);
    PaketLaundry::create([
        'nama_paket' => 'Cuci Kering',
        'harga' => 4000,
        'satuan' => 'kg',
        'waktu_pengerjaan' => 'ekonomi',
        'deskripsi' => 'Cuci dan kering tanpa setrika',
    ]);
    PaketLaundry::create([
        'nama_paket' => 'Setrika Saja',
        'harga' => 3000,
        'satuan' => 'kg',
        'waktu_pengerjaan' => 'ekonomi',
        'deskripsi' => 'Setrika saja tanpa cuci',
    ]);
    PaketLaundry::create([
        'nama_paket' => 'Cuci Kilat',
        'harga' => 10000,
        'satuan' => 'kg',
        'waktu_pengerjaan' => 'express',
        'deskripsi' => 'Cuci, kering, dan setrika dalam 1 jam',
    ]);
    PaketLaundry::create([
        'nama_paket' => 'Cuci Selimut',
        'harga' => 15000,
        'satuan' => 'pcs',
        'waktu_pengerjaan' => 'regular',
        'deskripsi' => 'Cuci selimut ukuran besar',
    ]);
    PaketLaundry::create([
        'nama_paket' => 'Cuci Bed Cover',
        'harga' => 12000,
        'satuan' => 'pcs',
        'waktu_pengerjaan' => 'regular',
        'deskripsi' => 'Cuci bed cover ukuran besar',
    ]);
    PaketLaundry::create([
        'nama_paket' => 'Cuci Karpet',
        'harga' => 25000,
        'satuan' => 'pcs',
        'waktu_pengerjaan' => 'ekonomi',
        'deskripsi' => 'Cuci karpet rumah',
    ]);
    PaketLaundry::create([
        'nama_paket' => 'Cuci Jas',
        'harga' => 20000,
        'satuan' => 'pcs',
        'waktu_pengerjaan' => 'regular',
        'deskripsi' => 'Cuci jas formal',
    ]);
    PaketLaundry::create([
        'nama_paket' => 'Cuci Sepatu',
        'harga' => 30000,
        'satuan' => 'pcs',
        'waktu_pengerjaan' => 'regular',
        'deskripsi' => 'Cuci sepatu sneakers',
    ]);

    // DB::table('paket_laundries')->insert([
    //     [
    //         'nama_paket' => 'Cuci Komplit Standar',
    //         'harga' => 5000,
    //         'waktu_pengerjaan' => 24, // 24 jam
    //         'deskripsi' => 'Cuci, kering, dan setrika',
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ],
    //     [
    //         'nama_paket' => 'Cuci Komplit Express',
    //         'harga' => 8000,
    //         'waktu_pengerjaan' => 3, // 3 jam
    //         'deskripsi' => 'Cuci express 3 jam selesai',
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ],
    //     [
    //         'nama_paket' => 'Cuci Kering',
    //         'harga' => 4000,
    //         'waktu_pengerjaan' => 12, // 12 jam
    //         'deskripsi' => 'Cuci dan kering tanpa setrika',
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ]
    // ]);
}
}