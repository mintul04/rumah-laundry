<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PaketLaundryController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;

use Illuminate\Support\Facades\Route;

//Route Auth
Route::get('/', [LandingPageController::class, 'landingPage'])->name('landing-page');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-proses', [AuthController::class, 'loginProses'])->name('loginProses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Resource untuk Paket Laundry
Route::resource('paket-laundry', PaketLaundryController::class);

// Route Resource untuk Transaksi
Route::resource('transaksi', TransaksiController::class);
Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::put('/transaksi/{id}/update-status', [TransaksiController::class, 'updateStatus'])->name('transaksi.update-status');

// Route untuk Laporan
Route::prefix('admin')->name('admin.')->group(function () {
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    
    // // Route untuk export PDF
    // Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPDF'])->name('laporan.export.pdf');
    
    // // Route untuk export Excel
    // Route::get('/laporan/export-excel', [LaporanController::class, 'exportExcel'])->name('laporan.export.excel');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('dashboard-admin', [AuthController::class, 'dashboardAdmin'])->name('dashboard-admin');
// Pastikan route ada
// Route::get('/pesanan/create', [PesananController::class, 'create'])->name('pesanan.create');
// Route::post('/pesanan/store', [PesananController::class, 'store'])->name('pesanan.store');
// Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
