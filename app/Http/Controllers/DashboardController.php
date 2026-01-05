<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\PaketLaundry;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Pesanan (Transaksi bulan ini)
        $totalPesanan = Transaksi::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Total Pelanggan (Dihitung dari transaksi - nama pelanggan unik)
        $totalPelanggan = Pelanggan::count();

        // Total Layanan (Jumlah paket laundry)
        $totalPaket = PaketLaundry::count();

        // Pendapatan Bulan Ini (hanya yang sudah lunas)
        $pendapatanBulanIni = Transaksi::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->where('pembayaran', 'lunas')
            ->sum('total');

        // Format ke dalam Miliar/Million
        $pendapatanFormatted = $this->formatRupiah($pendapatanBulanIni);

        // Data untuk Status Pesanan
        $statusData = $this->getStatusOrdersData();

        // Data untuk Penjualan 7 Hari Terakhir
        $salesLast7Days = $this->getSalesLast7Days();

        // 5 paket paling laris (1 bulan terakhir)
        $topPaketLaris = $this->getTopPaketLaris();

        return view('admin.dashboard', [
            'totalPesanan' => $totalPesanan,
            'totalPelanggan' => $totalPelanggan,
            'totalPaket' => $totalPaket,
            'pendapatanFormatted' => $pendapatanFormatted,
            'statusData' => $statusData,
            'salesLast7Days' => $salesLast7Days,
            'topPaketLaris' => $topPaketLaris,
        ]);
    }

    private function formatRupiah($amount)
    {
        if ($amount >= 1000000000) {
            return 'Rp ' . number_format($amount / 1000000000, 1) . 'M';
        } elseif ($amount >= 1000000) {
            return 'Rp ' . number_format($amount / 1000000, 1) . 'JT';
        } elseif ($amount >= 1000) {
            return 'Rp ' . number_format($amount / 1000, 0) . 'RB';
        } else {
            return 'Rp ' . number_format($amount, 0, ',', '.');
        }
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

    /**
     * Get sales data for the last 7 days
     */
    private function getSalesLast7Days()
    {
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subDays(6);

        $dates = [];
        $sales = [];
        $orderCounts = [];

        // Nama hari dalam bahasa Indonesia
        $daysInIndonesian = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];

        for ($i = 0; $i < 7; $i++) {
            $currentDate = $startDate->copy()->addDays($i);
            $dayName = $daysInIndonesian[$currentDate->dayOfWeek];
            $dates[] = $dayName . ', ' . $currentDate->format('j');

            // Pendapatan hanya dari transaksi yang **lunas**
            $dailySales = Transaksi::whereDate('created_at', $currentDate->format('Y-m-d'))
                ->where('pembayaran', 'lunas')
                ->sum('total');

            // Jumlah pesanan (semua status)
            $dailyOrders = Transaksi::whereDate('created_at', $currentDate->format('Y-m-d'))
                ->count();

            $sales[] = (int) $dailySales;
            $orderCounts[] = (int) $dailyOrders;
        }

        $totalSales = array_sum($sales);
        $totalOrders = array_sum($orderCounts);
        $averageSales = $totalSales > 0 ? $totalSales / 7 : 0;

        return [
            'labels' => $dates,
            'sales' => $sales,
            'order_counts' => $orderCounts,
            'total_sales' => $totalSales,
            'total_sales_formatted' => $this->formatRupiah($totalSales),
            'total_orders' => $totalOrders,
            'average_sales' => $this->formatRupiah($averageSales),
            'has_data' => true // Karena kita selalu pakai data riil
        ];
    }

    /**
     * Ambil 5 paket laundry paling laris dalam 1 bulan terakhir
     */
    private function getTopPaketLaris()
    {
        return PaketLaundry::select(
            'paket_laundries.id',
            'paket_laundries.nama_paket',
            DB::raw('SUM(transaksi_details.subtotal) as total_pendapatan')
        )
            ->join('transaksi_details', 'paket_laundries.id', '=', 'transaksi_details.paket_id')
            ->join('transaksis', 'transaksi_details.transaksi_id', '=', 'transaksis.id')
            ->whereBetween('transaksis.created_at', [
                Carbon::now()->subMonth()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])
            ->groupBy('paket_laundries.id', 'paket_laundries.nama_paket')
            ->orderByRaw('SUM(transaksi_details.subtotal) DESC')
            ->limit(5)
            ->get();
    }
}