<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use Illuminate\Support\Facades\Route;

// ─── Public Routes ────────────────────────────────────────────────────────────
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

// ─── Auth Routes ──────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ─── Customer Routes ──────────────────────────────────────────────────────────
Route::middleware(['auth', 'customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerDashboard::class, 'index'])->name('dashboard');
    
    // Tahap 4 - Sistem Reservasi UI Routes
    Route::get('/lapangan', [App\Http\Controllers\Customer\LapanganController::class, 'index'])->name('lapangan');
    Route::get('/booking/{id?}', [App\Http\Controllers\Customer\ReservasiController::class, 'booking'])->name('booking');
    Route::post('/booking', [App\Http\Controllers\Customer\ReservasiController::class, 'store'])->name('booking.store');
    Route::get('/pembayaran/{id?}', [App\Http\Controllers\Customer\ReservasiController::class, 'pembayaran'])->name('pembayaran');
    Route::post('/pembayaran/{id}', [App\Http\Controllers\Customer\ReservasiController::class, 'prosesPembayaran'])->name('pembayaran.proses');
    Route::get('/riwayat', [App\Http\Controllers\Customer\ReservasiController::class, 'riwayat'])->name('riwayat');
    Route::get('/support', [App\Http\Controllers\Customer\SupportController::class, 'index'])->name('support');
    Route::get('/feedback', [App\Http\Controllers\Customer\FeedbackController::class, 'index'])->name('feedback');
    Route::post('/feedback', [App\Http\Controllers\Customer\FeedbackController::class, 'store'])->name('feedback.store');
});

// ─── Admin Routes ─────────────────────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Manajemen Lapangan (CRUD)
    Route::resource('/lapangan', App\Http\Controllers\Admin\LapanganController::class)->except(['show']);

    // Manajemen Reservasi
    Route::get('/reservasi', [App\Http\Controllers\Admin\ReservasiController::class, 'index'])->name('reservasi.index');
    Route::patch('/reservasi/{reservasi}/status', [App\Http\Controllers\Admin\ReservasiController::class, 'updateStatus'])->name('reservasi.updateStatus');
});
