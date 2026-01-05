<?php

namespace App\Http\Controllers;

use App\Exports\LaporanTransaksiExport;
use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $transaksis = Transaksi::latest()->paginate(10);

        // Hitung statistik dari database
        $totalTransactions = Transaksi::count();
        $totalPendapatan = Transaksi::sum('total');
        $rataRata = $totalTransactions > 0 ? $totalPendapatan / $totalTransactions : 0;

        // Hitung pelanggan aktif: minimal 4 transaksi dalam 30 hari terakhir
        $pelangganAktif = Pelanggan::whereHas('transaksi', function ($q) {
            $q->where('tanggal_terima', '>=', Carbon::now()->subDays(30));
        })
            ->withCount('transaksi')
            ->having('transaksi_count', '>', 2)
            ->count();

        // Analisis per tanggal penerimaan (tanggal_terima)
        $transaksiPerTanggal = $transaksis->groupBy('tanggal_terima')
            ->map(function ($items) {
                return [
                    'jumlah' => $items->count(),
                    'total' => $items->sum('total')
                ];
            })
            ->sortByDesc('total');

        // Analisis status pembayaran
        $statusPembayaran = $transaksis->groupBy('pembayaran')
            ->map(function ($items) {
                return $items->count();
            });

        // Ambil 7 pelanggan teratas berdasarkan jumlah transaksi
        $topCustomers = Pelanggan::withCount('transaksi')
            ->withSum('transaksi', 'total')
            ->orderByDesc('transaksi_count')
            ->take(7)
            ->get()
            ->map(function ($pelanggan) {
                return [
                    'nama' => $pelanggan->nama,
                    'jumlah' => $pelanggan->transaksi_count,
                    'total' => $pelanggan->transaksi_sum_total
                ];
            });

        return view('admin.laporan.index', [
            'transactions' => $transaksis,
            'totalTransactions' => $totalTransactions,
            'totalPendapatan' => $totalPendapatan,
            'rataRata' => $rataRata,
            'pelangganAktif' => $pelangganAktif, // Jika ingin menampilkan jumlah pelanggan unik
            'transaksiPerTanggal' => $transaksiPerTanggal,
            'statusPembayaran' => $statusPembayaran,
            'topCustomers' => $topCustomers,
            'periode' => Carbon::now()->isoFormat('MMMM YYYY')
        ]);
    }

    public function exportLaporanPdf(Request $request)
    {
        $transaksis = Transaksi::orderBy('tanggal_terima', 'desc')
            ->orderBy('tanggal_selesai', 'desc')
            ->get();

        $totalTransactions = $transaksis->count();
        $totalPendapatan = $transaksis->sum('total');
        $rataRata = $totalTransactions > 0 ? $totalPendapatan / $totalTransactions : 0;
        $pelangganAktif = $transaksis->unique('nama_pelanggan')->count();

        $transaksiPerTanggal = $transaksis->groupBy('tanggal_terima')
            ->map(function ($items) {
                return [
                    'jumlah' => $items->count(),
                    'total' => $items->sum('total')
                ];
            })
            ->sortByDesc('total');

        $statusPembayaran = $transaksis->groupBy('pembayaran')
            ->map(function ($items) {
                return $items->count();
            });

        $topCustomers = Pelanggan::withCount('transaksi')
            ->withSum('transaksi', 'total')
            ->orderByDesc('transaksi_count')
            ->take(7)
            ->get()
            ->map(function ($pelanggan) {
                return [
                    'nama' => $pelanggan->nama,
                    'jumlah' => $pelanggan->transaksi_count,
                    'total' => $pelanggan->transaksi_sum_total
                ];
            });

        // Buat view PDF
        $pdf = Pdf::loadView('admin.laporan.pdf.laporan-pdf', [
            'transactions' => $transaksis,
            'totalTransactions' => $totalTransactions,
            'totalPendapatan' => $totalPendapatan,
            'rataRata' => $rataRata,
            'pelangganAktif' => $pelangganAktif,
            'transaksiPerTanggal' => $transaksiPerTanggal,
            'statusPembayaran' => $statusPembayaran,
            'topCustomers' => $topCustomers,
            'periode' => Carbon::now()->locale('id')->isoFormat('MMMM YYYY') // Gunakan Carbon untuk format
        ]);

        // Download PDF
        return $pdf->download('laporan_transaksi_laundry_' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    public function exportLaporanExcel(Request $request) // Tambahkan Request $request jika Anda ingin filter
    {
        // Kita akan menggunakan class export untuk logika pengambilan data
        return Excel::download(new LaporanTransaksiExport, 'laporan_transaksi_laundry_' . Carbon::now()->format('Y-m-d') . '.xlsx');
    }
}