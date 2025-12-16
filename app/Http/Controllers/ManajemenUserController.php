<?php

namespace App\Http\Controllers;

use App\Models\ManajemenUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ManajemenUserController extends Controller
{
    // Tampilkan semua user
    public function index()
    {
        $manajemenUsers = ManajemenUser::all();
        return view('admin.manajemen-user.index', compact('manajemenUsers'));
    }

    // Form tambah user
    public function create()
    {
        return view('admin.manajemen-user.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|unique:manajemen_users|max:50',
            'email' => 'nullable|email|unique:manajemen_users',
            'password' => 'required|string|min:6',
            'level' => 'required|in:admin,karyawan',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $manajemenUser = new ManajemenUser();
        $manajemenUser->nama = $request->nama;
        $manajemenUser->username = $request->username;
        $manajemenUser->email = $request->email;
        $manajemenUser->password = Hash::make($request->password);
        $manajemenUser->level = $request->level;
        $manajemenUser->jenis_kelamin = $request->jenis_kelamin;

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('manajemen-users', 'public');
            $manajemenUser->foto = $fotoPath;
        }

        $manajemenUser->save();

        return redirect()->route('manajemen-user.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    // Form edit user
    public function edit($id)
    {
        $manajemenUser = ManajemenUser::findOrFail($id);
        return view('admin.manajemen-user.edit', compact('manajemenUser'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $manajemenUser = ManajemenUser::findOrFail($id);                

        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:manajemen_users,username,' . $id,
            'email' => 'nullable|email|unique:manajemen_users,email,' . $id,
            'level' => 'required|in:admin,karyawan',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $manajemenUser->nama = $request->nama;                                                                      
        $manajemenUser->username = $request->username;
        $manajemenUser->email = $request->email;
        $manajemenUser->level = $request->level;
        $manajemenUser->jenis_kelamin = $request->jenis_kelamin;

        // Update password jika diisi
        if ($request->filled('password')) {
            $manajemenUser->password = Hash::make($request->password);
        }

        // Update foto jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($manajemenUser->foto && Storage::disk('public')->exists($manajemenUser->foto)) {
                Storage::disk('public')->delete($manajemenUser->foto);
            }
            $fotoPath = $request->file('foto')->store('manajemen-users', 'public');
            $manajemenUser->foto = $fotoPath;
        }

        $manajemenUser->save();

        return redirect()->route('manajemen-user.index')
            ->with('success', 'User berhasil diperbarui!'); 
    }

    // Hapus user
    public function destroy($id)
    {
        $manajemenUser = ManajemenUser::findOrFail($id);
        
        // Hapus foto jika ada
        if ($manajemenUser->foto && Storage::disk('public')->exists($manajemenUser->foto)) {
            Storage::disk('public')->delete($manajemenUser->foto);
        }
        
        $manajemenUser->delete();

        return redirect()->route('manajemen-user.index')
            ->with('success', 'User berhasil dihapus!');  
    }
}