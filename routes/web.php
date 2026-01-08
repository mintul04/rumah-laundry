<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PaketLaundryController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ManajemenUserController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProfileController;


use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', [LandingPageController::class, 'landingPage'])->name('landing-page');
Route::post('/cek-status', [LandingPageController::class, 'cekStatus'])->name('cek.status');

// Authentication
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-proses', [AuthController::class, 'loginProses'])->name('loginProses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Panel
// Dashboard Admin
Route::middleware('auth')->get('/dashboard-admin', [DashboardController::class, 'index'])->name('dashboard-admin');
// User Profile
Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::put('/update', [ProfileController::class, 'update'])->name('update');
    Route::post('/password', [ProfileController::class, 'updatePassword'])->name('password');
});

// Paket Laundry
Route::middleware('auth')->resource('paket-laundry', PaketLaundryController::class);

// Transaksi
Route::middleware('auth')->group(function () {
    Route::resource('transaksi', TransaksiController::class);
    Route::put('/transaksi/{id}/update-status', [TransaksiController::class, 'updateStatus'])->name('transaksi.update-status');
    Route::put('/transaksi/{id}/update-pembayaran', [TransaksiController::class, 'updatePembayaran'])->name('transaksi.update-pembayaran');
    // export invoice PDF
    Route::get('/transaksi/invoice/preview/{id}', [TransaksiController::class, 'previewInvoice'])->name('preview.invoice.pdf');
    Route::get('/invoice/export-pdf/{id}', [TransaksiController::class, 'exportInvoicePdf'])->name('export.invoice.pdf');
});

// Laporan
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    // export PDF
    Route::get('/laporan/export-pdf', [LaporanController::class, 'exportLaporanPdf'])->name('laporan.export.pdf');
    // export Excel
    Route::get('/laporan/export-excel', [LaporanController::class, 'exportLaporanExcel'])->name('laporan.export.excel');
});

// User
Route::middleware('auth')->resource('manajemen-user', ManajemenUserController::class);
// Pengaturan
Route::middleware('auth')->group(function () {
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::put('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
});

// Pelanggan
Route::get('/pelanggan/cari', [PelangganController::class, 'cari'])->name('pelanggan.cari');
Route::post('/pelanggan', [PelangganController::class, 'simpan'])->name('pelanggan.store');