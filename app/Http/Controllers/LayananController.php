<?php

namespace App\Http\Controllers;

use App\Models\Layanan;


use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layanan = Layanan::all();
        return view('admin.layanan.data', compact('layanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layanan.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_layanan' => 'required|string',
            'nama_layanan' => 'required|string|max:255',
        ]);

        // Gunakan only() untuk memastikan field yang diambil
        layanan::create($request->only(['id_layanan', 'nama_layanan']));

        return redirect()->route('layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan');
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
        $layanan = Layanan::findOrFail($id);
        return view('admin.layanan.form', compact('layanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_layanan' => 'required|string',
            'nama_layanan' => 'required|string|max:255',
        ]);

        $layanan = Layanan::findOrFail($id);

        $layanan->update([
            'id_layanan' => $request->id_layanan,
            'nama_layanan' => $request->nama_layanan,
        ]);

        return redirect()->route('layanan.index')
            ->with('success', 'Layanan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
