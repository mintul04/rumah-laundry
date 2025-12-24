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

        // Data untuk Status Pesanan
        $statusData = $this->getStatusOrdersData();

        // Data untuk Penjualan 7 Hari Terakhir
        $salesLast7Days = $this->getSalesLast7Days();

        return view('admin.dashboard', [
            'totalPesanan'        => $totalPesanan,
            'totalPelanggan'      => $totalPelanggan,
            'totalPaket'          => $totalPaket,
            'pendapatanFormatted' => $pendapatanFormatted,
            'statusData'          => $statusData,
            'salesLast7Days'      => $salesLast7Days
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
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subDays(6);
        
        $dates = [];
        $sales = [];
        $orderCounts = [];
        
        // Nama hari dalam bahasa Indonesia singkat
        $daysInIndonesian = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        
        // Cek apakah ada data transaksi di database
        $hasData = Transaksi::count() > 0;
        
        for ($i = 0; $i < 7; $i++) {
            $date = $startDate->copy()->addDays($i);
            
            // Format: Sen, 23
            $dayName = $daysInIndonesian[$date->dayOfWeek];
            $dates[] = $dayName . ', ' . $date->format('j');
            
            if ($hasData) {
                // Total pendapatan per hari (hanya yang lunas)
                $total = Transaksi::whereDate('created_at', $date->format('Y-m-d'))
                    ->where('pembayaran', 'lunas')
                    ->sum('total');
                
                // Jumlah pesanan per hari
                $orderCount = Transaksi::whereDate('created_at', $date->format('Y-m-d'))
                    ->count();
            } else {
                // Data dummy untuk development/demo
                // Pattern: random dengan trend naik turun
                $baseSales = [1500000, 1800000, 2200000, 1900000, 2500000, 2100000, 1700000];
                $baseOrders = [8, 10, 12, 9, 14, 11, 7];
                
                $total = $baseSales[$i] + rand(-200000, 200000);
                $orderCount = $baseOrders[$i] + rand(-2, 2);
            }
            
            $sales[] = $total;
            $orderCounts[] = $orderCount;
        }

        // Format total pendapatan
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
            'has_data' => $hasData
        ];
    }
}