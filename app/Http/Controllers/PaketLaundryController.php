<?php

namespace App\Http\Controllers;

use App\Models\PaketLaundry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PaketLaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paketLaundries = PaketLaundry::latest()->get();
        return view('admin.paket-laundry.index', compact('paketLaundries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.paket-laundry.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi data input
    $validator = Validator::make($request->all(), [
        'nama_paket' => 'required|string|max:255', // Ganti 'jenis_paket' menjadi 'nama_paket'
        'harga' => 'required|numeric|min:0',
        'waktu_pengerjaan' => 'required|string|max:255',
        'deskripsi' => 'required|string'
    ]);

    // Jika validasi gagal
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Simpan data ke database
    PaketLaundry::create([
        'nama_paket' => $request->nama_paket, // Ganti 'jenis_paket' menjadi 'nama_paket'
        'harga' => $request->harga,
        'waktu_pengerjaan' => $request->waktu_pengerjaan,
        'deskripsi' => $request->deskripsi
    ]);

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('paket-laundry.index')
        ->with('success', 'Paket laundry berhasil ditambahkan!');
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
