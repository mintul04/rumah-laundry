<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function dashboardAdmin()
    {
        return view('admin.dashboard');
    }

    public function loginProses(Request $request)
    {
        $validation = $request->only('name', 'password');

        if (Auth::attempt($validation)) {
            $request->session()->regenerate();
            return redirect()->route('layanan.index');
        }

        return back()->with('error', 'Password atau Username Salah');
    }

    public function registerProses(Request $request)
    {
        $validation = $request->validate([
            'name'       => 'required',
            'email'      => 'required',
            'password'   => 'required',
            'no_telepon' => 'required',
            'alamat'     => 'required',
        ]);

        $validation['password'] = Hash::make($request->password);
        User::create($validation);

        return redirect()->route('layanan.index');
    }
}
