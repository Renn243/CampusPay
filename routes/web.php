<?php

use Illuminate\Support\Facades\Route;

// route mahasiswa
Route::get('/', function () {
    return view('pages.mahasiswa.beranda');
})->name('beranda');

Route::get('/pembayaran', function () {
    return view('pages.mahasiswa.pembayaran');
})->name('pembayaran');

Route::get('/riwayat', function () {
    return view('pages.mahasiswa.riwayat');
})->name('riwayat');

Route::get('/detailPembayaran', function () {
    return view('pages.mahasiswa.detailPembayaran');
})->name('detailPembayaran');

Route::get('/profile', function () {
    return view('pages.mahasiswa.profile');
})->name('profile');

Route::get('/login', function () {
    return view('pages.mahasiswa.login');
})->name('login');

Route::get('/loginAdmin', function () {
    return view('pages.admin.loginAdmin');
})->name('loginAdmin');


// route admin
Route::get('/admin/dashboard', function () {
    return view('pages.admin.dashboard');
})->name('dashboard');

Route::get('/admin/mahasiswa', function () {
    return view('pages.admin.mahasiswa');
})->name('mahasiswa');

Route::get('/admin/detailMahasiswa', function () {
    return view('pages.admin.detailMahasiswa');
})->name('detailMahasiswa');

Route::get('/admin/pembayaran', function () {
    return view('pages.admin.pembayaran');
})->name('pembayaran');

Route::get('/admin/detailPembayaran', function () {
    return view('pages.admin.detailPembayaran');
})->name('detailPembayaran');

Route::get('/admin/pengumuman', function () {
    return view('pages.admin.pengumuman');
})->name('detailPengumuman');

Route::get('/admin/detailPengumuman', function () {
    return view('pages.admin.detailPengumuman');
})->name('detailPengumuman');

Route::get('/admin/tagihan', function () {
    return view('pages.admin.tagihan');
})->name('tagihan');
