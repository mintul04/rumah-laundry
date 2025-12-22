<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PengaturanController extends Controller
{
    public function index()
    {
        $pengaturan = Pengaturan::first();
        return view('admin.pengaturan.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_laundry' => 'required|string|max:255',
            'telepon_laundry' => 'required|string|max:255',
            'email_laundry' => 'required|email',
            'alamat_laundry' => 'required|string',
            'nama_pemilik' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pengaturan = Pengaturan::firstOrNew([]);

        // Handle upload logo
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($pengaturan->logo && Storage::disk('public')->exists($pengaturan->logo)) {
                Storage::disk('public')->delete($pengaturan->logo);
            }

            // Simpan logo baru
            $logoPath = $request->file('logo')->store('logo', 'public');
            $pengaturan->logo = $logoPath;
        }

        //formatInternasionalTelepon
        $telepon = preg_replace('/[^\d]/', '', $request->telepon_laundry);
        if (substr($telepon, 0, 1) === '0') {
            $telepon = '62' . substr($telepon, 1);
        }
        $pengaturan->telepon_laundry = $telepon;

        // Update data lainnya
        $pengaturan->nama_laundry = $request->nama_laundry;
        $pengaturan->email_laundry = $request->email_laundry;
        $pengaturan->alamat_laundry = $request->alamat_laundry;
        $pengaturan->nama_pemilik = $request->nama_pemilik;
        $pengaturan->save();

        return redirect()->route('pengaturan.index')
            ->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
