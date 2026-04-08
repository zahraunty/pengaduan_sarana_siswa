<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\SiswaController;

// Rute Guest
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Rute Auth
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AspirasiController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::post('/admin/aspirasi/update/{id}', [AspirasiController::class, 'updateAspirasi'])->name('admin.update');
    });

    // Siswa
    Route::middleware('role:siswa')->group(function () {
    Route::get('/siswa/dashboard', [AspirasiController::class, 'siswaDashboard'])->name('siswa.dashboard');
    Route::post('/siswa/kirim', [AspirasiController::class, 'storeAspirasi'])->name('siswa.store');
    });

    Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/kategori', [AspirasiController::class, 'indexKategori'])->name('admin.kategori.index');
    Route::post('/admin/kategori', [AspirasiController::class, 'storeKategori'])->name('admin.kategori.store');
    Route::delete('/admin/kategori/{id}', [AspirasiController::class, 'destroyKategori'])->name('admin.kategori.destroy');
});

Route::post('/siswa/feedback/{id}', [SiswaController::class, 'updateFeedback'])->name('siswa.feedback');
Route::post('/siswa/feedback/{id}', 'SiswaController@store');
Route::post('/siswa/feedback/{id}', [SiswaController::class, 'feedback'])->name('siswa.feedback');
});