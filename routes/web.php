<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\admin\AdminTransaksiController;
use App\Http\Controllers\admin\AdminMahasiswaController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::view('/', 'pages.mahasiswa.beranda')->name('beranda');
Route::view('/pembayaran', 'pages.mahasiswa.pembayaran')->name('pembayaran');
Route::view('/riwayat', 'pages.mahasiswa.riwayat')->name('riwayat');
Route::view('/detailPembayaran', 'pages.mahasiswa.detailPembayaran')->name('detailPembayaran');
Route::view('/profile', 'pages.mahasiswa.profile')->name('profile');

// route mahasiswa
// Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
// });

// route admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // halaman statis
    Route::view('/dashboard', 'pages.admin.dashboard')->name('dashboard');
    Route::view('/pengumuman', 'pages.admin.pengumuman')->name('pengumuman');
    Route::view('/detailPengumuman', 'pages.admin.detailPengumuman')->name('detailPengumuman');

    // Transaksi Admin
    Route::get('/pembayaran', [AdminTransaksiController::class, 'index'])->name('listPembayaran');
    Route::get('/pembayaran/{id}', [AdminTransaksiController::class, 'show'])->name('detailPembayaran');
    Route::post('/pembayaran/{id}', [AdminTransaksiController::class, 'updateStatusPembayaran'])->name('updateStatusPembayaran');

    // Mahasiswa Admin
    Route::get('/mahasiswa', [AdminMahasiswaController::class, 'index'])->name('listMahasiswa');
    Route::post('/mahasiswa', [AuthController::class, 'register'])->name('register');
    Route::get('/mahasiswa/{id}', [AdminMahasiswaController::class, 'show'])->name('detailMahasiswa');
    Route::put('/mahasiswa/{id}', [AdminMahasiswaController::class, 'updateProfileMahasiswa'])->name('updateProfileMahasiswa');

    // Tagihan Admin
    Route::get('/tagihan', [TagihanController::class, 'index'])->name('listTagihan');
    Route::post('/tagihan', [TagihanController::class, 'store'])->name('tambahTagihan');
    Route::delete('/tagihan/{id}', [TagihanController::class, 'destroy'])->name('deleteTagihan');
    Route::get('/tagihan/{id}', [TagihanController::class, 'show'])->name('detailTagihan');
    Route::put('/tagihan/{id}', [TagihanController::class, 'update'])->name('updateTagihan');
});
