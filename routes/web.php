<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RsvpController;
use App\Http\Controllers\VoucherScanController;
use App\Http\Controllers\VoucherRedeemController; // <-- TAMBAHKAN INI


Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Halaman RSVP untuk Tamu
Route::get('/rsvp', [RsvpController::class, 'index'])->name('rsvp.index');
Route::post('/rsvp', [RsvpController::class, 'store'])->name('rsvp.store');

// Halaman Dashboard (contoh)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Halaman Scanner dan API untuk Staf Merchandise (Wajib Login)
Route::middleware(['auth'])->group(function () {
    // Rute Halaman Scanner
    Route::get('/admin/voucher/scan', [VoucherScanController::class, 'index'])->name('voucher.scan');

    // API Endpoint untuk memvalidasi QR Code
    // Dipindahkan dari api.php agar bisa menggunakan session auth ('web')
    Route::post('/voucher/redeem', [VoucherRedeemController::class, 'redeem'])->name('voucher.redeem');
});

// Rute Autentikasi Bawaan Breeze (biarkan di top level)
require __DIR__.'/auth.php';
