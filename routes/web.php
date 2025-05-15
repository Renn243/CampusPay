<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.beranda');
})->name('beranda');

Route::get('/pembayaran', function () {
    return view('pages.pembayaran');
})->name('pembayaran');

Route::get('/riwayat', function () {
    return view('pages.riwayat');
})->name('riwayat');

Route::get('/detailPembayaran', function () {
    return view('pages.detailPembayaran');
})->name('detailPembayaran');

Route::get('/profile', function () {
    return view('pages.profile');
})->name('profile');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/register', function () {
    return view('pages.register');
})->name('register');
