<?php

namespace App\Http\Controllers;

use App\Exports\LaporanTransaksiExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // AMBIL DATA DARI DATABASE
        // Perbaikan: Ganti 'tanggal_transaksi' dengan 'tanggal_terima' karena kolom itu yang ada
        $transaksis = Transaksi::orderBy('tanggal_terima', 'desc')
            ->orderBy('tanggal_selesai', 'desc')
            ->get();

        // Hitung statistik dari database
        $totalTransactions = $transaksis->count();
        $totalPendapatan = $transaksis->sum('total');
        $rataRata = $totalTransactions > 0 ? $totalPendapatan / $totalTransactions : 0;

        // Hitung pelanggan aktif (unik)
        $pelangganAktif = $transaksis->unique('nama_pelanggan')->count();

        // Analisis per tanggal penerimaan (tanggal_terima)
        // Perbaikan: Gunakan 'tanggal_terima' sebagai pengganti 'tanggal_transaksi'
        $transaksiPerTanggal = $transaksis->groupBy('tanggal_terima')
            ->map(function ($items) {
                return [
                    'jumlah' => $items->count(),
                    'total' => $items->sum('total')
                ];
            })
            ->sortByDesc('total'); // Urutkan berdasarkan total, bukan jumlah jika tidak disebutkan

        // Analisis status pembayaran
        $statusPembayaran = $transaksis->groupBy('pembayaran')
            ->map(function ($items) {
                return $items->count();
            });

        // Ambil 7 pelanggan teratas berdasarkan jumlah transaksi
        $topCustomers = $transaksis
            ->groupBy('nama_pelanggan')
            ->sortByDesc(function ($items) {
                return $items->count();
            })
            ->take(7);

        // Ambil data transaksi per tanggal (sudah diperbaiki sebelumnya)
        // (Tidak perlu didefinisikan ulang, cukup gunakan $transaksiPerTanggal di atas)

        // Kirim data ke view
        return view('admin.laporan.index', [
            'transactions' => $transaksis,
            'totalTransactions' => $totalTransactions,
            'totalPendapatan' => $totalPendapatan,
            'rataRata' => $rataRata,
            'pelangganAktif' => $pelangganAktif, // Jika ingin menampilkan jumlah pelanggan unik
            'transaksiPerTanggal' => $transaksiPerTanggal,
            'statusPembayaran' => $statusPembayaran,
            'topCustomers' => $topCustomers,
            'periode' => date('F Y')
        ]);
    }

    public function exportLaporanPdf(Request $request) // Tambahkan Request $request jika Anda ingin filter
    {
        // Ambil data yang sama seperti di fungsi index
        // Kita bisa menambahkan filter berdasarkan request jika diperlukan
        $transaksis = Transaksi::orderBy('tanggal_terima', 'desc')
            ->orderBy('tanggal_selesai', 'desc')
            ->get();

        $totalTransactions = $transaksis->count();
        $totalPendapatan = $transaksis->sum('total');
        $rataRata = $totalTransactions > 0 ? $totalPendapatan / $totalTransactions : 0;
        $pelangganAktif = $transaksis->unique('nama_pelanggan')->count();

        $transaksiPerTanggal = $transaksis->groupBy('tanggal_terima') // Gunakan tanggal_terima
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

        $topCustomers = $transaksis
            ->groupBy('nama_pelanggan')
            ->sortByDesc(function ($items) {
                return $items->count();
            })
            ->take(7);

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