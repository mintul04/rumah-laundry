<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PelangganController extends Controller
{
    public function cari(Request $request)
    {
        $q = $request->query('q');
        $pelanggans = Pelanggan::where('nama', 'LIKE', "%{$q}%")
            ->orWhere('no_telp', 'LIKE', "%{$q}%")
            ->take(5)
            ->get(['id', 'nama', 'no_telp']);

        return response()->json($pelanggans);
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
        ], [
            'no_telp.size' => 'Nomor WhatsApp harus 11-12 digit (dimulai 08).',
            'no_telp.unique' => 'Nomor WhatsApp sudah terdaftar.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Nomor telepon sudah terdaftar.'], 422);
        }

        // Normalisasi no_telp (62xxxx)
        $normalized = preg_replace('/[^0-9]/', '', $request->no_telp);
        if (str_starts_with($normalized, '0')) {
            $normalized = '62' . substr($normalized, 1);
        } elseif (!str_starts_with($normalized, '62')) {
            $normalized = '62' . $normalized;
        }
        $request->merge(['no_telp' => $normalized]);

        $pelanggan = Pelanggan::create([
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
        ]);

        return response()->json([
            'id' => $pelanggan->id,
            'nama' => $pelanggan->nama,
            'no_telp' => $pelanggan->no_telp,
        ]);
    }
}
