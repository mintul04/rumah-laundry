<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\PaketLaundry;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pastikan menggunakan with() untuk memuat relasi
        $transaksis = Transaksi::with(['pelanggan' => function ($query) {
            $query->select('id', 'nama_pelanggan'); // hanya ambil field yang diperlukan
        }])->latest()->get();

        return view('admin.transaksi.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggan = Pelanggan::all();
        $pakets = PaketLaundry::all();

        $lastOrder = Transaksi::latest()->first();
        $lastOrderNumber = $lastOrder ? intval(substr($lastOrder->no_order, 2)) : 0;

        return view('admin.transaksi.create', compact('pelanggan', 'pakets', 'lastOrderNumber'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'tanggal_transaksi' => 'required|date',
            'pembayaran' => 'required|in:lunas,belum_lunas,dp',
            'status_order' => 'required|in:baru,diproses,selesai,diambil',
            'total' => 'required|numeric|min:0'
        ]);

        // Jika validasi gagal, kembalikan ke halaman form dengan pesan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data ke database
        Transaksi::create([
            'no_order' => Transaksi::generateNoOrder(),
            'pelanggan_id' => $request->pelanggan_id,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'pembayaran' => $request->pembayaran,
            'status_order' => $request->status_order,
            'total' => $request->total,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $transaksi = Transaksi::findOrFail($id);
        $pelanggans = Pelanggan::all();
        return view('admin.transaksi.edit', compact('transaksi', 'pelanggans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'tanggal_transaksi' => 'required|date',
            'pembayaran' => 'required|in:lunas,belum lunas,dp',
            'status_order' => 'required|in:baru,diproses,selesai,diambil'
        ]);

        $transaksi->update($validated);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diupdate!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus data dari database
        Transaksi::findOrFail($id)->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }
}
