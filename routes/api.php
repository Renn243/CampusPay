<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\admin\AdminTransaksiController;
use App\Http\Controllers\admin\AdminMahasiswaController;


Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:api', 'role:mahasiswa'])->group(function () {
    Route::get('/users', [MahasiswaController::class, 'get']);
    Route::put('/users', [MahasiswaController::class, 'update']);

    Route::get('/pembayaran', [TransaksiController::class, 'index']);
    Route::get('/pembayaran/{id_transaksi}', [TransaksiController::class, 'show']);
    Route::put('/pembayaran/{id_transaksi}', [TransaksiController::class, 'transaksiWithMidtrans']); // untuk bayar
    Route::post('/pembayaran/{id_transaksi}/cek-status', [TransaksiController::class, 'updateStatusTransaksi']);
});

Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::post('/register', [AuthController::class, 'register']);

    //untuk submenu pembayaran
    Route::get('/all-transaksi', [AdminTransaksiController::class, 'index']);
    Route::get('/transaksi/{id}', [AdminTransaksiController::class, 'show']);
    Route::put('/transaksi/{id}', [AdminTransaksiController::class, 'updateStatusPembayaran']);

    //untuk subMenu ListMahasiswa
    Route::get('/all-mahasiswa', [AdminMahasiswaController::class, 'index']);
    Route::get('/mahasiswa/{id}', [AdminMahasiswaController::class, 'show']);
    Route::put('/mahasiswa/{id}', [AdminMahasiswaController::class, 'updateProfileMahasiswa']);

    Route::get('/tagihan',          [TagihanController::class, 'index']);
    Route::get('/tagihan/{id}',     [TagihanController::class, 'show']);
    Route::post('/tagihan',          [TagihanController::class, 'store']);
    Route::put('/tagihan/{id}',     [TagihanController::class, 'update']);
    Route::delete('/tagihan/{id}',     [TagihanController::class, 'destroy']);
});
