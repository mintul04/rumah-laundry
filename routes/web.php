<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaketLaundryController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PesananController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route Resource untuk Paket Laundry
Route::resource('paket-laundry', PaketLaundryController::class);

// Route Resource untuk Pelanggan
Route::resource('pelanggan', PelangganController::class);

// Route Resource untuk Transaksi
Route::resource('transaksi', TransaksiController::class);
Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');



Route::resource('layanan', LayananController::class);
Route::get('dashboard-admin', [AuthController::class, 'dashboardAdmin'])->name('dashboard-admin');
Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store');
Route::get('/layanan/create', [LayananController::class, 'create'])->name('layanan.create');
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
// Pastikan route ada
// Route::get('/pesanan/create', [PesananController::class, 'create'])->name('pesanan.create');
// Route::post('/pesanan/store', [PesananController::class, 'store'])->name('pesanan.store');
// Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
