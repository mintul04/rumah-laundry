<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\PaketLaundry;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Pesanan (Transaksi bulan ini)
        $totalPesanan = Transaksi::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Total Pelanggan (Dihitung dari transaksi - nama pelanggan unik)
        $totalPelanggan = Transaksi::select('nama_pelanggan')
            ->distinct()
            ->count('nama_pelanggan');

        // Total Layanan (Jumlah paket laundry)
        $totalPaket = PaketLaundry::count();

        // Pendapatan Bulan Ini (hanya yang sudah lunas)
        $pendapatanBulanIni = Transaksi::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->where('pembayaran', 'lunas')
            ->sum('total');

        // Format ke dalam Miliar/Million
        $pendapatanFormatted = $this->formatRupiah($pendapatanBulanIni);

        // Data untuk Grafik Pesanan (Mingguan)
        $ordersData = $this->getWeeklyOrdersData();

        // Data untuk Status Pesanan
        $statusData = $this->getStatusOrdersData();

        return view('admin.dashboard', [
            'totalPesanan'        => $totalPesanan,
            'totalPelanggan'      => $totalPelanggan,
            'totalPaket'          => $totalPaket,
            'pendapatanFormatted' => $pendapatanFormatted,
            'ordersData'          => $ordersData,
            'statusData'          => $statusData
        ]);
    }

    private function formatRupiah($amount)
    {
        if ($amount >= 1000000000) {
            return 'Rp ' . number_format($amount / 1000000000, 1) . 'M';
        } elseif ($amount >= 1000000) {
            return 'Rp ' . number_format($amount / 1000000, 1) . 'JT';
        } else {
            return 'Rp ' . number_format($amount, 0, ',', '.');
        }
    }

    private function getWeeklyOrdersData()
    {
        $now = Carbon::now();
        $data = [];

        for ($i = 3; $i >= 0; $i--) {
            $weekStart = $now->copy()->subWeeks($i)->startOfWeek();
            $weekEnd = $now->copy()->subWeeks($i)->endOfWeek();
            
            $count = Transaksi::whereBetween('created_at', [$weekStart, $weekEnd])->count();
            $data[] = $count;
        }

        return [
            'labels' => ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
            'data' => $data
        ];
    }

    private function getStatusOrdersData()
    {
        $selesai = Transaksi::where('status_order', 'selesai')->count();
        $diproses = Transaksi::where('status_order', 'diproses')->count();
        $baru = Transaksi::where('status_order', 'baru')->count();

        return [
            'labels' => ['Selesai', 'Proses', 'Menunggu'],
            'data' => [$selesai, $diproses, $baru],
            'colors' => ['#28a745', '#0066cc', '#ffc107']
        ];
    }
}