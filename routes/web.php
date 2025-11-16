<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayananController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('layanan', LayananController::class);
Route::get('dashboard-admin', [AuthController::class, 'dashboardAdmin'])->name('dashboard-admin');