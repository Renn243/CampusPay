<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\mahasiswa\PembayaranController;
use App\Http\Controllers\admin\AdminTransaksiController;
use App\Http\Controllers\admin\AdminMahasiswaController;
use App\Http\Controllers\admin\AdminPengumumanController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// route mahasiswa
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {

    Route::view('/beranda', 'pages.mahasiswa.beranda')->name('beranda');
    Route::view('/pembayaran', 'pages.mahasiswa.pembayaran')->name('pembayaran');
    Route::get('/riwayat', [PembayaranController::class, 'index'])->name('riwayat');
    Route::view('/riwayat/{id}', [PembayaranController::class, 'show'])->name('detailPembayaran');
    Route::get('/profile', [MahasiswaController::class, 'get'])->name('profile');
});

// route admin  
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // halaman statis
    Route::view('/dashboard', 'pages.admin.dashboard')->name('dashboard');

    // Transaksi
    Route::get('/pembayaran', [AdminTransaksiController::class, 'index'])->name('listPembayaran');
    Route::get('/pembayaran/{id}', [AdminTransaksiController::class, 'show'])->name('detailPembayaran');
    Route::post('/pembayaran/{id}', [AdminTransaksiController::class, 'updateStatusPembayaran'])->name('updateStatusPembayaran');

    // Mahasiswa
    Route::get('/mahasiswa', [AdminMahasiswaController::class, 'index'])->name('listMahasiswa');
    Route::post('/mahasiswa', [AuthController::class, 'register'])->name('register');
    Route::get('/mahasiswa/{id}', [AdminMahasiswaController::class, 'show'])->name('detailMahasiswa');
    Route::put('/mahasiswa/{id}', [AdminMahasiswaController::class, 'updateProfileMahasiswa'])->name('updateProfileMahasiswa');

    // Tagihan
    Route::get('/tagihan', [TagihanController::class, 'index'])->name('listTagihan');
    Route::post('/tagihan', [TagihanController::class, 'store'])->name('tambahTagihan');
    Route::delete('/tagihan/{id}', [TagihanController::class, 'destroy'])->name('deleteTagihan');
    // Route::get('/tagihan/{id}', [TagihanController::class, 'show'])->name('detailTagihan');
    Route::put('/tagihan/{id}', [TagihanController::class, 'update'])->name('updateTagihan');

    // Pengumuman
    Route::get('/pengumuman', [AdminPengumumanController::class, 'index'])->name('listPengumuman');
    Route::get('/detailPengumuman/{id}', [AdminPengumumanController::class, 'show'])->name('detailPengumuman');
    Route::post('/pengumuman', [AdminPengumumanController::class, 'store'])->name('tambahPengumuman');
    Route::put('/pengumuman/{id}', [AdminPengumumanController::class, 'update'])->name('editPengumuman');
    Route::delete('/pengumuman/{id}', [AdminPengumumanController::class, 'destroy'])->name('deletePengumuman');
});
