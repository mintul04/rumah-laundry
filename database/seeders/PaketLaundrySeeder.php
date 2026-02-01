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
        $paketLaundries = [
            [
                'nama_paket' => 'Cuci Regular',
                'harga' => 5000,
                'satuan' => 'kg',
                'waktu_pengerjaan' => '1-2 hari',
                'deskripsi' => 'Cuci dan kering standar',
            ],
            [
                'nama_paket' => 'Dry Cleaning',
                'harga' => 20000,
                'satuan' => 'pcs',
                'waktu_pengerjaan' => '1-2 hari',
                'deskripsi' => 'Cuci khusus pakaian formal atau sensitif',
            ],
            [
                'nama_paket' => 'Cuci + Setrika',
                'harga' => 7000,
                'satuan' => 'kg',
                'waktu_pengerjaan' => '1-2 hari',
                'deskripsi' => 'Cuci, kering, dan setrika',
            ],
            [
                'nama_paket' => 'Setrika Saja',
                'harga' => 3000,
                'satuan' => 'kg',
                'waktu_pengerjaan' => '1-2 hari',
                'deskripsi' => 'Setrika saja tanpa cuci',
            ],
            [
                'nama_paket' => 'Express',
                'harga' => 10000,
                'satuan' => 'kg',
                'waktu_pengerjaan' => '6-12 jam',
                'deskripsi' => 'Cuci dan setrika cepat (±6-12 jam)',
            ],
        ];


        foreach ($paketLaundries as $paket) {
            PaketLaundry::create($paket);
        }
    }
}
    // $paketLaundries = [
    //     [
    //         'nama_paket' => 'Cuci Komplit Standar',
    //         'harga' => 5000,
    //         'satuan' => 'kg',
    //         'waktu_pengerjaan' => 'regular',
    //         'deskripsi' => 'Cuci, kering, dan setrika',
    //     ],
    //     [
    //         'nama_paket' => 'Cuci Komplit Express',
    //         'harga' => 8000,
    //         'satuan' => 'kg',
    //         'waktu_pengerjaan' => 'express',
    //         'deskripsi' => 'Cuci express 3 jam selesai',
    //     ],
    //     [
    //         'nama_paket' => 'Cuci Kering',
    //         'harga' => 4000,
    //         'satuan' => 'kg',
    //         'waktu_pengerjaan' => 'ekonomi',
    //         'deskripsi' => 'Cuci dan kering tanpa setrika',
    //     ],
    //     [
    //         'nama_paket' => 'Setrika Saja',
    //         'harga' => 3000,
    //         'satuan' => 'kg',
    //         'waktu_pengerjaan' => 'ekonomi',
    //         'deskripsi' => 'Setrika saja tanpa cuci',
    //     ],
    //     [
    //         'nama_paket' => 'Cuci Kilat',
    //         'harga' => 10000,
    //         'satuan' => 'kg',
    //         'waktu_pengerjaan' => 'express',
    //         'deskripsi' => 'Cuci, kering, dan setrika dalam 1 jam',
    //     ],
    //     [
    //         'nama_paket' => 'Cuci Selimut',
    //         'harga' => 15000,
    //         'satuan' => 'pcs',
    //         'waktu_pengerjaan' => 'regular',
    //         'deskripsi' => 'Cuci selimut ukuran besar',
    //     ],
    //     [
    //         'nama_paket' => 'Cuci Bed Cover',
    //         'harga' => 12000,
    //         'satuan' => 'pcs',
    //         'waktu_pengerjaan' => 'regular',
    //         'deskripsi' => 'Cuci bed cover ukuran besar',
    //     ],
    //     [
    //         'nama_paket' => 'Cuci Karpet',
    //         'harga' => 25000,
    //         'satuan' => 'pcs',
    //         'waktu_pengerjaan' => 'ekonomi',
    //         'deskripsi' => 'Cuci karpet rumah',
    //     ],
    //     [
    //         'nama_paket' => 'Cuci Jas',
    //         'harga' => 20000,
    //         'satuan' => 'pcs',
    //         'waktu_pengerjaan' => 'regular',
    //         'deskripsi' => 'Cuci jas formal',
    //     ],
    //     [
    //         'nama_paket' => 'Cuci Sepatu',
    //         'harga' => 30000,
    //         'satuan' => 'pcs',
    //         'waktu_pengerjaan' => 'regular',
    //         'deskripsi' => 'Cuci sepatu sneakers',
    //     ],
    // ];