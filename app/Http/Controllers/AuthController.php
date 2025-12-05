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

    public function login(){
        return view('auth.login');
    }

    public function loginProses(Request $request)
    {
        $validation = $request->only('email', 'password');

        if (Auth::attempt($validation)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard-admin');
        }

        return back()->with('error', 'Password atau Username Salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
