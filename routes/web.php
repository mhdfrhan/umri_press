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
    Route::get('/detail-buku/{slug}', 'detailBuku')->name('detailBuku');
    Route::get('/kontak', 'kontak')->name('kontak');
    Route::get('/artikel', 'artikel')->name('artikel');
    Route::get('/artikel/{slug}', 'detailArtikel')->name('detailArtikel');
    Route::get('/penjelasan-layanan', 'penjelasanLayanan')->name('penjelasanLayanan');
    Route::get('/progress-isbn', 'progressISBN')->name('progressISBN');
    Route::get('/tentang-kami', 'tentangKami')->name('tentangKami');
});


Route::middleware(['auth'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');

        
        // buku
        Route::get('/dashboard/buku/semua-buku', 'semuaBuku')->name('semuaBuku');
        Route::get('/dashboard/buku/tambah-buku', 'tambahBuku')->name('tambahBuku');
        Route::get('/dashboard/buku/edit-buku/{slug}', 'editBuku')->name('editBuku');
        Route::get('/dashboard/buku/tempat-sampah', 'tempatSampah')->name('tempatSampah');

        // kategori buku
        Route::get('/dashboard/buku/kategori/semua-kategori', 'semuaKategori')->name('semuaKategori');

        // authors
        Route::get('/dashboard/authors/semua-authors', 'semuaAuthors')->name('semuaAuthors');

        // artikel
        Route::get('/dashboard/artikel/semua-artikel', 'semuaArtikel')->name('semuaArtikel');
        Route::get('/dashboard/artikel/tambah-artikel', 'tambahArtikel')->name('tambahArtikel');
        Route::get('/dashboard/artikel/edit-artikel/{slug}', 'editArtikel')->name('editArtikel');
        Route::get('/dashboard/artikel/tempat-sampah', 'tempatSampahArtikel')->name('tempatSampahArtikel');

        // kategori artikel
        Route::get('/dashboard/artikel/kategori/semua-kategori', 'kategoriArtikel')->name('kategoriArtikel');

        // tim
        Route::get('/dashboard/tim/semua-tim', 'semuaTim')->name('semuaTim');
        Route::get('/dashboard/tim/tambah-tim', 'tambahTim')->name('tambahTim');
        Route::get('/dashboard/tim/edit-tim/{slug}', 'editTim')->name('editTim');
        Route::get('/dashboard/tim/tempat-sampah', 'tempatSampahTim')->name('tempatSampahTim');

        // harga paket
        Route::get('/dashboard/harga-paket/semua-paket', 'semuaPaket')->name('semuaPaket');
        Route::get('/dashboard/harga-paket/tambah-paket', 'tambahPaket')->name('tambahPaket');
        Route::get('/dashboard/harga-paket/edit-paket/{slug}', 'editPaket')->name('editPaket');
        Route::get('/dashboard/harga-paket/tempat-sampah', 'tempatSampahPaket')->name('tempatSampahPaket');

        // users
        Route::get('/dashboard/users/semua-users', 'semuaUsers')->name('semuaUsers');

        // pengaturan
        Route::get('/dashboard/pengaturan', 'pengaturanWeb')->name('pengaturanWeb');
    });
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
