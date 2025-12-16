<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ManajemenUserController extends Controller
{
    // Tampilkan semua user
    public function index()
    {
        $user = User::latest()->get();
        return view('admin.manajemen-user.index', compact('user'));
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
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|unique:users|max:50',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,karyawan',
            'jenis_kelamin' => 'required|in:Laki - Laki,Perempuan',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = new User();
        $user->nama = $request->nama;
        $user->nama_lengkap = $request->nama_lengkap;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->jenis_kelamin = $request->jenis_kelamin;

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('manajemen-users', 'public');
            $user->foto = $fotoPath;
        }

        $user->save();

        return redirect()->route('manajemen-user.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    // Form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.manajemen-user.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);                

        $request->validate([
            'nama' => 'required|string|max:100',
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,karyawan',
            'jenis_kelamin' => 'required|in:Laki - Laki,Perempuan',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->nama = $request->nama;
        $user->nama_lengkap = $request->nama_lengkap;                                                                      
        $user->email = $request->email;     
        $user->role = $request->role;
        $user->jenis_kelamin = $request->jenis_kelamin;

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Update foto jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }
            $fotoPath = $request->file('foto')->store('manajemen-users', 'public');
            $user->foto = $fotoPath;
        }

        $user->save();

        return redirect()->route('manajemen-user.index')
            ->with('success', 'User berhasil diperbarui!'); 
    }

    // Hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Hapus foto jika ada
        if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
        }
        
        $user->delete();

        return redirect()->route('manajemen-user.index')
            ->with('success', 'User berhasil dihapus!');  
    }
}