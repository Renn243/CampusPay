<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\mahasiswa\PembayaranController;
use App\Http\Controllers\admin\AdminTransaksiController;
use App\Http\Controllers\admin\AdminMahasiswaController;
use App\Http\Controllers\admin\AdminPengumumanController;
use App\Http\Controllers\mahasiswa\DashboardController;

// Route redirect
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect('/admin');
        } elseif ($user->role === 'mahasiswa') {
            return redirect('/beranda');
        } else {
            return redirect('/login');
        }
    } else {
        return redirect('/login');
    }
});

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Route mahasiswa
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::view('/beranda', 'pages.mahasiswa.beranda')->name('beranda');
    Route::get('/beranda', [DashboardController::class, 'indexBeranda'])->name('beranda');
    Route::get('/pembayaran', [PembayaranController::class, 'indexPembayaran'])->name('pembayaran');
    Route::post('/pembayaran/{id_transaksi}', [PembayaranController::class, 'transaksiWithMidtrans'])->name('pembayaranMidtrans');
    Route::post('/pembayaran/updateStatus/{id_transaksi}', [PembayaranController::class, 'updateStatusTransaksi']);
    Route::post('/riwayat/uploadBukti/{id_transaksi}/{id_tagihan}', [PembayaranController::class, 'uploadBuktiPembayaran'])->name('uploadBukti');
    Route::get('/riwayat', [PembayaranController::class, 'index'])->name('riwayat');
    Route::get('/riwayat/{id}', [PembayaranController::class, 'show'])->name('detailPembayaran');
    Route::get('/profile', [MahasiswaController::class, 'get'])->name('profile');
    Route::put('/profile', [MahasiswaController::class, 'updateMahasiswa'])->name('updateProfile');
    Route::put('/profile/password', [MahasiswaController::class, 'updateAkun'])->name('updatePassword');
});

// Route admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Transaksi
    Route::get('/pembayaran', [AdminTransaksiController::class, 'index'])->name('listPembayaran');
    Route::get('/pembayaran/{id_transaksi}/{id_tagihan}', [AdminTransaksiController::class, 'show'])->name('detailPembayaran');
    Route::post('/pembayaran/terima/{id}', [AdminTransaksiController::class, 'updateStatusPembayaran'])->name('updateStatusPembayaran');
    Route::post('/pembayaran/tolak/{id}', [AdminTransaksiController::class, 'updateStatusPembayaranTolak'])->name('updateStatusPembayaranTolak');

    // Mahasiswa
    Route::get('/mahasiswa', [AdminMahasiswaController::class, 'index'])->name('listMahasiswa');
    Route::post('/mahasiswa', [AuthController::class, 'register'])->name('register');
    Route::get('/mahasiswa/{id}', [AdminMahasiswaController::class, 'show'])->name('detailMahasiswa');
    Route::put('/mahasiswa/{id}', [AdminMahasiswaController::class, 'updateProfileMahasiswa'])->name('updateProfileMahasiswa');

    // Tagihan
    Route::get('/tagihan', [TagihanController::class, 'index'])->name('listTagihan');
    Route::post('/tagihan', [TagihanController::class, 'store'])->name('tambahTagihan');
    Route::delete('/tagihan/{id}', [TagihanController::class, 'destroy'])->name('deleteTagihan');
    Route::put('/tagihan/{id}', [TagihanController::class, 'update'])->name('updateTagihan');

    // Pengumuman
    Route::get('/pengumuman', [AdminPengumumanController::class, 'index'])->name('listPengumuman');
    Route::get('/detailPengumuman/{id}', [AdminPengumumanController::class, 'show'])->name('detailPengumuman');
    Route::post('/pengumuman', [AdminPengumumanController::class, 'store'])->name('tambahPengumuman');
    Route::put('/pengumuman/{id}', [AdminPengumumanController::class, 'update'])->name('editPengumuman');
    Route::delete('/pengumuman/{id}', [AdminPengumumanController::class, 'destroy'])->name('deletePengumuman');
});

Route::get('/logout', function () {
    Auth::logout();
    session()->flush();
    return redirect('/login');
})->name('logout');
