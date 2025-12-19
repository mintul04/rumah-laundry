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
        return view('profile.index', compact('user'));
    }

    /**
     * Menampilkan form edit profile
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update data profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only(['name', 'email', 'phone', 'address', 'bio']);

        // Handle upload avatar
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar && Storage::exists('public/avatars/' . $user->avatar)) {
                Storage::delete('public/avatars/' . $user->avatar);
            }
            
            $avatar = $request->file('avatar');
            $filename = time() . '_' . $avatar->getClientOriginalName();
            $avatar->storeAs('public/avatars', $filename);
            $data['avatar'] = $filename;
        }

        User::update($data);

        return redirect()->route('admin.profile.index')
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

        // Verifikasi password saat ini
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->with("error", 'Password saat ini salah.');
        }

        // Update password
        User::update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('admin.profile.index')
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

        // Hapus avatar jika ada
        if ($user->avatar) {
            Storage::delete('public/avatars/' . $user->avatar);
        }

        Auth::logout();


        return redirect('/')
            ->with('success', 'Akun berhasil dihapus.');
    }
}