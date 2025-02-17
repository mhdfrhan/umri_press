<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/tentang/tim', 'team')->name('team');
    Route::get('/layanan/daftar-jadi-penulis-buku', 'daftarPenulis')->name('daftarPenulis');
    Route::get('/layanan/kirim-naskah', 'kirimNaskah')->name('kirimNaskah');
    Route::get('/harga', 'harga')->name('harga');
    Route::get('/toko-buku', 'tokoBuku')->name('tokoBuku');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
