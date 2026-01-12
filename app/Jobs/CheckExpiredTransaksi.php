<?php

namespace App\Jobs;

use App\Models\PaketLaundry;
use App\Models\Transaksi;
use App\Services\FonnteService; // Pastikan path sesuai
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CheckExpiredTransaksi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(FonnteService $fonnteService): void
    {
        // Ambil transaksi yang memenuhi kriteria (jangan langsung update)
        $transaksis = Transaksi::with('pelanggan', 'details')
            ->where('status_order', 'selesai')
            ->whereNotNull('jatuh_tempo_at')
            ->where('jatuh_tempo_at', '<=', now()->subDays(4))
            ->get();

        foreach ($transaksis as $transaksi) {
            $transaksi->update(['status_order' => 'kadaluarsa']);

            $namaPelanggan = $transaksi->pelanggan?->nama ?? 'Pelanggan';
            $noTelp = $transaksi->pelanggan?->no_telp ?? null;

            if (!$noTelp)
                continue;

            $daftarPesanan = '';
            foreach ($transaksi->details as $item) {
                $paket = PaketLaundry::find($item['paket_id']);
                $daftarPesanan .= '• ' . $paket->nama_paket . ' (' . $item['berat'] . " " . $paket['satuan'] . ")\n";
            }

            $totalAwal = $transaksi->total;
            $dpText = $transaksi->dp > 0
                ? "DP: Rp " . number_format($transaksi->dp, 0, ',', '.') . "\n"
                : '';

            $hari_terlambat = max(
                0,
                Carbon::parse($transaksi->jatuh_tempo_at)
                    ->startOfDay()
                    ->diffInDays(now()->startOfDay(), false),
            );

            if ($hari_terlambat >= 4) {
                $total_denda = 35000;
            } else {
                $total_denda = $hari_terlambat * 5000;
            }

            $totalAkhir = $totalAwal + $total_denda;
            $textDenda = $transaksi->total_denda > 0
                ? "Total denda: Rp " . number_format($transaksi->total_denda, 0, ',', '.') . "\n"
                : '';

            $message =
                "Halo *{$namaPelanggan}* 👋\n\n" .
                "⚠️ *Pemberitahuan Penting*\n\n" .
                "Pesanan laundry Anda di *RumahLaundry* telah *melewati batas waktu pengambilan*.\n\n" .
                "🧺 *Detail Pesanan*\n" .
                $daftarPesanan . "\n" .
                "Total awal: Rp " . number_format($totalAwal, 0, ',', '.') . "\n" .
                $textDenda .
                "Total tagihan: Rp " . number_format($totalAkhir, 0, ',', '.') . "\n" .
                $dpText .
                "\n❗ Status pesanan kini menjadi *KADALUARSA*.\n" .
                "\n Tolong segera *diambil*.\n" .
                "Silakan hubungi kami segera jika ini kesalahan.\n\n" .
                "Terima kasih 🙏\n" .
                "*RumahLaundry*";

            // Kirim via Fonnte
            $fonnteService->send($noTelp, $message);
        }
    }
}