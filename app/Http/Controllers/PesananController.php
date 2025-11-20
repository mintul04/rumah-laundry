<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Layanan;

use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pesanan.data', [
            'pesanan' => Pesanan::with('layanan')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $layanan = Layanan::all(); // ambil semua layanan

        return view('admin.pesanan.form', [
            'layanan' => $layanan
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // DEBUG: Lihat data yang dikirim
    logger('Data dari form:', $request->all());
    $request->validate([
        'kode_pesanan' => 'required|unique:pesanans,kode_pesanan',
        'nama_layanan' => 'required|string|max:100',
        'nama_paket'   => 'required|string|max:100',
        'harga'        => 'required|numeric|min:0', // Pastikan ini 'harga' bukan 'total_harga'
    ]);
    // ...
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
