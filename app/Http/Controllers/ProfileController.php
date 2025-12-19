<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profile
     */
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    /**
     * Menampilkan form edit profile
     */

    /**
     * Update data profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only(['nama', 'nama_lengkap', 'email', 'foto']);

        // Handle upload foto
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && Storage::exists('public/avatar/' . $user->foto)) {
                Storage::delete('public/avatar/' . $user->foto);
            }

            $foto = $request->file('foto');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $path = $foto->store('avatar', 'public');
            $data['foto'] = $path;
        }

        User::where('id', $user->id)->update($data);

        return redirect()->route('profile.index')
            ->with('success', 'Profile berhasil diperbarui.');
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->with("error", 'Password saat ini salah.');
        }

        User::where('id', $user->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('profile.index')
            ->with("success", 'Password berhasil diperbarui.');
    }

    /**
     * Delete account
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->with('error', 'Password salah.');
        }

        // Hapus foto jika ada
        if ($user->foto) {
            Storage::delete('public/avatar/' . $user->foto);
        }

        Auth::logout();

        return redirect('/')
            ->with('success', 'Akun berhasil dihapus.');
    }
}