<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function index(Request $request)
{
    // AMBIL DATA DARI DATABASE
    $transaksis = Transaksi::orderBy('tanggal_terima', 'desc')
        ->orderBy('tanggal_selesai', 'desc')
        ->get();
    
    // Hitung statistik dari database
    $totalTransactions = $transaksis->count(); // GANTI: $totalTransaksi -> $totalTransactions
    $totalPendapatan = $transaksis->sum('total');
    $rataRata = $totalTransactions > 0 ? $totalPendapatan / $totalTransactions : 0;
    
    // Hitung pelanggan aktif (unik)
    $pelangganAktif = $transaksis->unique('nama_pelanggan')->count();
    
    // Analisis per tanggal
    $transaksiPerTanggal = $transaksis->groupBy('tanggal_transaksi')
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

        $topCustomers = $transaksis
    ->groupBy('nama_pelanggan')
    ->sortByDesc(function ($items) {
        return $items->count();
    })
    ->take(7);

    $transaksiPerTanggal = $transaksis->groupBy('tanggal_transaksi')
    ->map(function ($items) {
        return [
            'jumlah' => $items->count(),
            'total' => $items->sum('total')
        ];
    })
    ->sortByDesc('total');

    
    // Kirim data ke view - PASTIKAN NAMA VARIABLE SAMA DENGAN DI VIEW
    return view('admin.laporan.index', [
        'transactions' => $transaksis, // atau 'transaksis' sesuai view
        'totalTransactions' => $totalTransactions, // NAMA INI HARUS SAMA DENGAN VIEW
        'totalPendapatan' => $totalPendapatan,
        'rataRata' => $rataRata,
        'pelangganAktif' => $pelangganAktif,
        'transaksiPerTanggal' => $transaksiPerTanggal,
        'statusPembayaran' => $statusPembayaran,
        'topCustomers' => $topCustomers, 
        'periode' => date('F Y')
    ]);
}
}