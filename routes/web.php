<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PaketLaundryController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ManajemenUserController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;


use Illuminate\Support\Facades\Route;

//Route Auth
Route::get('/', [LandingPageController::class, 'landingPage'])->name('landing-page');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-proses', [AuthController::class, 'loginProses'])->name('loginProses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// PROFILE ROUTES
Route::middleware('auth')
    ->prefix('profile')
    ->name('profile.')
    ->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
        Route::post('/password', [ProfileController::class, 'updatePassword'])->name('password');
    });

// Route Resource untuk Paket Laundry
Route::middleware('auth')->resource('paket-laundry', PaketLaundryController::class);

// Route Resource untuk Transaksi
Route::middleware('auth')->group(function () {
    Route::resource('transaksi', TransaksiController::class);
    Route::put('/transaksi/{id}/update-status', [TransaksiController::class, 'updateStatus'])
        ->name('transaksi.update-status');
    Route::put('/transaksi/{id}/update-pembayaran', [TransaksiController::class, 'updatePembayaran'])
        ->name('transaksi.update-pembayaran');
    // Route untuk export invoice PDF Transaksi
    Route::get('/invoice/export-pdf/{id}', [TransaksiController::class, 'exportInvoicePdf'])
        ->name('export.invoice.pdf');
});

// Route untuk Laporan
Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        // Route untuk export PDF
        Route::get('/laporan/export-pdf', [LaporanController::class, 'exportLaporanPdf'])
            ->name('laporan.export.pdf');
        // Route untuk export Excel
        Route::get('/laporan/export-excel', [LaporanController::class, 'exportLaporanExcel'])
            ->name('laporan.export.excel');
    });

// manajemen_user
Route::middleware('auth')->resource('manajemen-user', ManajemenUserController::class);

// pengaturan
Route::middleware('auth')->group(function () {
    Route::get('/pengaturan', [PengaturanController::class, 'index'])
        ->name('pengaturan.index');

    Route::put('/pengaturan', [PengaturanController::class, 'update'])
        ->name('pengaturan.update');
});

// dashboard-admin
Route::middleware('auth')
    ->get('/dashboard-admin', [DashboardController::class, 'index'])
    ->name('dashboard-admin');

Route::post('/cek-status', [LandingPageController::class, 'cekStatus'])->name('cek.status');
