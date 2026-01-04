<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\PaketLaundry;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Factory;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paketLaundries = PaketLaundry::all();
        if ($paketLaundries->isEmpty()) {
            $this->command->warn('Tidak ada data paket_laundries. Seeder transaksi dibatalkan.');
            return;
        }

        $faker = Factory::create('id_ID');

        for ($i = 0; $i < 20; $i++) {
            // Tanggal terima: acak dalam 30 hari terakhir
            $tanggalTerima = Carbon::now()->subDays(rand(0, 30));
            // Tanggal selesai: 2–5 hari setelah tanggal terima
            $tanggalSelesai = (clone $tanggalTerima)->addDays(rand(2, 5));

            // Status pembayaran acak
            $pembayaran = $faker->randomElement(['lunas', 'belum_lunas', 'dp']);
            $jumlahDp = $pembayaran === 'dp' ? round(rand(10000, 100000) / 100) * 100 : null;

            $transaksi = Transaksi::create([
                'no_order' => (function () {
                    $prefix = 'ORD-';
                    $latest = Transaksi::latest('id')->first();
                    $nextNumber = $latest ? (int) substr($latest->no_order, strlen($prefix)) + 1 : 1;
                    return $prefix . sprintf('%06d', $nextNumber);
                })(),
                'id_pelanggan' => rand(0, 10),
                'tanggal_terima' => $tanggalTerima,
                'tanggal_selesai' => $tanggalSelesai,
                'pembayaran' => $pembayaran,
                'jumlah_dp' => $jumlahDp,
                'status_order' => $faker->randomElement(['baru', 'diproses', 'selesai', 'diambil']),
                'total' => 0, // Akan diupdate setelah detail dibuat
            ]);

            // Buat 1–3 detail transaksi
            $totalTransaksi = 0;
            $jumlahItem = rand(1, 3);

            for ($j = 0; $j < $jumlahItem; $j++) {
                $paket = $paketLaundries->random();
                $berat = rand(1, 10) + ($faker->boolean(30) ? 0.5 : 0); // Misal: 3, 5.5, 8 kg
                $subtotal = round($paket->harga * $berat); // harga dari paket_laundries

                $transaksi->details()->create([
                    'paket_id' => $paket->id,
                    'berat' => $berat,
                    'subtotal' => $subtotal,
                ]);

                $totalTransaksi += $subtotal;
            }

            // Update total transaksi
            $transaksi->update(['total' => $totalTransaksi]);
        }

    }
}
