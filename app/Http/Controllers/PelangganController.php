<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggans = Pelanggan::latest()->get();
        return view('admin.pelanggan.index', compact('pelanggans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email'          => 'required|email|unique:pelanggans,email',
            'tanggal_lahir'  => 'required|date',
            'pekerjaan'      => 'nullable|string|max:255',
            'telepon'        => 'required|string|max:20',
            'alamat'         => 'required|string',
            'jenis_kelamin'  => 'nullable|in:L,P',
        ]);

        // Simpan data
        Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'email'          => $request->email,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'pekerjaan'      => $request->pekerjaan,
            'telepon'        => $request->telepon,
            'alamat'         => $request->alamat,
            'jenis_kelamin'  => $request->jenis_kelamin,
        ]);

        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil ditambahkan!');
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
        $pelanggan = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email'          => 'required|email|unique:pelanggans,email,' . $id,
            'tanggal_lahir'  => 'required|date',
            'pekerjaan'      => 'nullable|string|max:255',
            'telepon'        => 'required|string|max:20',
            'alamat'         => 'required|string',
            'jenis_kelamin'  => 'nullable|in:L,P',
        ]);

        // Update data
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'email'          => $request->email,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'pekerjaan'      => $request->pekerjaan,
            'telepon'        => $request->telepon,
            'alamat'         => $request->alamat,
            'jenis_kelamin'  => $request->jenis_kelamin,
        ]);

        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus data
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil dihapus!');
    }
}
