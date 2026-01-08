<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function landingPage()
    {
        return view('frontend.landing-page', [
            'transaksi' => Transaksi::with('details')->get()
        ]);
    }

    public function cekStatus(Request $request)
    {
        $request->validate([
            'no_order' => 'required|string'
        ]);

        $transaksi = Transaksi::where('no_order', $request->no_order)->first();

        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Nomor order tidak ditemukan.'
            ]);
        }

        // Tentukan nama pelanggan dari berbagai sumber
        $nama_pelanggan = $transaksi->nama_pelanggan;

        // Jika nama kosong di transaksi, coba ambil dari relasi
        if (empty($nama_pelanggan) && $transaksi->pelanggan) {
            $nama_pelanggan = $transaksi->pelanggan->nama;
        } elseif (empty($nama_pelanggan) && $transaksi->user) {
            $nama_pelanggan = $transaksi->user->name;
        } elseif (empty($nama_pelanggan)) {
            $nama_pelanggan = 'Pelanggan'; // Fallback
        }

        return response()->json([
            'success' => true,
            'data' => [
                'no_order'        => $transaksi->no_order,
                'status_order'    => $transaksi->status_order,
                'nama_pelanggan'  => $nama_pelanggan,
                'tanggal_terima'  => Carbon::parse($transaksi->tanggal_terima)->format('d F Y'),
                'tanggal_selesai' => Carbon::parse($transaksi->tanggal_selesai)->format('d F Y'),
                'total'           => 'Rp ' . number_format($transaksi->total, 0, ',', '.'),
                'pembayaran'      => $transaksi->pembayaran
            ]
        ]);
    }
}
