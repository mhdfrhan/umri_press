<?php

use App\Http\Controllers\DashboardController;
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
    Route::get('/kontak', 'kontak')->name('kontak');
    Route::get('/artikel', 'artikel')->name('artikel');
});


Route::middleware(['auth'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');

        // buku
        Route::get('/dashboard/buku/semua-buku', 'semuaBuku')->name('semuaBuku');
        Route::get('/dashboard/buku/tambah-buku', 'tambahBuku')->name('tambahBuku');
        Route::get('/dashboard/buku/edit-buku/{slug}', 'editBuku')->name('editBuku');
        Route::get('/dashboard/buku/tempat-sampah', 'tempatSampah')->name('tempatSampah');

        // artikel
        Route::get('/dashboard/artikel/semua-artikel', 'semuaArtikel')->name('semuaArtikel');
        Route::get('/dashboard/artikel/tambah-artikel', 'tambahArtikel')->name('tambahArtikel');
    });
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
