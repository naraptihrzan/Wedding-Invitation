<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingController;
use App\Http\Controllers\RsvpController;
use App\Http\Controllers\VoucherScanController;
use App\Http\Controllers\VoucherRedeemController;

use App\Http\Controllers\DashboardController; // ← TAMBAH INI


// ---------------------------
// Landing Page (Tamu Umum)
// ---------------------------
Route::get('/', [LandingController::class, 'index'])->name('landing');


// ---------------------------
// RSVP Page (Tamu)
// ---------------------------
Route::post('/rsvp', [RsvpController::class, 'store'])->name('rsvp.store');

Route::get('/test-qr', function () {
    return QrCode::size(300)->generate('HELLO WORLD');
});


// ---------------------------
// Dashboard Admin
// ---------------------------
Route::middleware(['auth', 'verified'])->group(function () {

    // HAPUS dashboard default dari Breeze
    // Route::get('/dashboard', function () { return view('dashboard'); });

    // GANTI dengan dashboard controller (CRUD)
    Route::resource('/dashboardadmin', DashboardController::class);

    // Scan Voucher Page (Admin)
    Route::get('/admin/voucher/scan', [VoucherScanController::class, 'index'])
        ->name('voucher.scan');

    // Redeem Voucher API (Admin)
    Route::post('/voucher/redeem', [VoucherRedeemController::class, 'redeem'])
        ->name('voucher.redeem');

    // Profile (default Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ---------------------------
// Auth Routes (Breeze)
// ---------------------------
require __DIR__.'/auth.php';


