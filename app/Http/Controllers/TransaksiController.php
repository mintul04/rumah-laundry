<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\PaketLaundry;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pastikan menggunakan with() untuk memuat relasi
        $transaksis = Transaksi::latest()->get();

        return view('admin.transaksi.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pakets = PaketLaundry::all();

        $lastOrderNumber = Transaksi::generateNoOrder();

        return view('admin.transaksi.create', compact('pakets', 'lastOrderNumber'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'nama_pelanggan' => 'required|string|max:255',
            'tanggal_transaksi' => 'required|date',
            'pembayaran' => 'required|in:lunas,dp',
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
            'nama_pelanggan' => $request->nama_pelanggan,
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
    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // Data dummy untuk detail produk (sesuaikan dengan struktur database Anda)
        $detailProduk = [
            (object) [
                'nama_produk' => 'Cuci Setrika Reguler',
                'harga' => 10000,
                'jumlah' => 2,
                'subtotal' => 20000
            ]
        ];

        return view('admin.transaksi.detail-transaksi', compact('transaksi', 'detailProduk'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //edit', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
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

    public function updateStatus(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status_order' => [
                'required',
                'string',
                Rule::in(['diproses', 'selesai', 'diambil']), // 'baru' dihapus sesuai permintaan
            ],
        ]);

        // Temukan transaksi
        $transaksi = Transaksi::findOrFail($id);

        // Update status
        $transaksi->update([
            'status_order' => $request->status_order,
        ]);

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Status transaksi berhasil diperbarui.');
    }
}
