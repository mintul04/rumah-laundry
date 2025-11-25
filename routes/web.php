<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PaketLaundryController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PesananController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'landingPage'])->name('landing-page');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-proses', [AuthController::class, 'loginProses'])->name('loginProses');

// Route Resource untuk Paket Laundry
Route::resource('paket-laundry', PaketLaundryController::class);

// Route Resource untuk Transaksi
Route::resource('transaksi', TransaksiController::class);
// Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');

Route::get('dashboard-admin', [AuthController::class, 'dashboardAdmin'])->name('dashboard-admin');
// Pastikan route ada
// Route::get('/pesanan/create', [PesananController::class, 'create'])->name('pesanan.create');
// Route::post('/pesanan/store', [PesananController::class, 'store'])->name('pesanan.store');
// Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
