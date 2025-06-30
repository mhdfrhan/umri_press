<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Buku;
use App\Models\PaketPenerbit;
use App\Models\Tim;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'totalBuku' => Buku::count(),
            'totalArtikel' => Artikel::count(),
            'totalPaket' => PaketPenerbit::count(),
            'totalTim' => Tim::count(),
            'recentBooks' => Buku::latest()->take(5)->get(),
            'recentArticles' => Artikel::latest()->take(5)->get(),
        ]);
    }

    public function semuaKategori()
    {
        return view('dashboard.kategori.semua-kategori', [
            'title' => 'Semua Kategori',
        ]);
    }

    public function semuaBuku()
    {
        return view('dashboard.buku.semua-buku', [
            'title' => 'Semua Buku',
        ]);
    }

    public function tambahBuku()
    {
        return view('dashboard.buku.tambah-buku', [
            'title' => 'Tambah Buku',
        ]);
    }

    public function editBuku($slug)
    {
        $buku = Buku::where('slug', $slug)->first();
        if (!$buku) {
            return redirect()->route('semuaBuku');
        }

        return view('dashboard.buku.edit-buku', [
            'title' => 'Edit Buku',
            'buku' => $buku,
        ]);
    }

    public function semuaAuthors()
    {
        return view('dashboard.authors.semua-authors', [
            'title' => 'Semua Authors',
        ]);
    }

    public function tempatSampah()
    {
        return view('dashboard.buku.tempat-sampah', [
            'title' => 'Tempat Sampah',
        ]);
    }

    public function semuaArtikel()
    {
        return view('dashboard.artikel.semua-artikel', [
            'title' => 'Semua Artikel',
        ]);
    }

    public function tambahArtikel()
    {
        return view('dashboard.artikel.tambah-artikel', [
            'title' => 'Tambah Artikel',
        ]);
    }

    public function editArtikel($slug)
    {
        $artikel = Artikel::where('slug', $slug)->first();
        if (!$artikel) {
            return redirect()->route('semuaArtikel');
        }

        return view('dashboard.artikel.edit-artikel', [
            'title' => 'Edit Artikel',
            'artikel' => $artikel,
        ]);
    }

    public function tempatSampahArtikel()
    {
        return view('dashboard.artikel.tempat-sampah', [
            'title' => 'Tempat Sampah Artikel',
        ]);
    }

    public function kategoriArtikel()
    {
        return view('dashboard.artikel.kategori', [
            'title' => 'Kategori Artikel',
        ]);
    }

    public function semuaTim()
    {
        return view('dashboard.tim.semua-tim', [
            'title' => 'Semua Tim',
        ]);
    }

    public function tambahTim()
    {
        return view('dashboard.tim.tambah-tim', [
            'title' => 'Tambah Tim',
        ]);
    }

    public function editTim($slug)
    {
        return view('dashboard.tim.edit-tim', [
            'title' => 'Edit Tim',
            'slug' => $slug
        ]);
    }

    public function tempatSampahTim()
    {
        return view('dashboard.tim.tempat-sampah', [
            'title' => 'Tempat Sampah Tim',
        ]);
    }

    public function semuaPaket()
    {
        return view('dashboard.harga.semua-paket', [
            'title' => 'Semua Paket',
        ]);
    }

    public function tambahPaket()
    {
        return view('dashboard.harga.tambah-paket', [
            'title' => 'Tambah Paket',
        ]);
    }

    public function editPaket($slug)
    {
        return view('dashboard.harga.edit-paket', [
            'title' => 'Edit Paket',
            'slug' => $slug
        ]);
    }

    public function tempatSampahPaket()
    {
        return view('dashboard.harga.tempat-sampah', [
            'title' => 'Tempat Sampah Paket',
        ]);
    }

    public function semuaUsers()
    {
        return view('dashboard.users.semua-users', [
            'title' => 'Semua Users',
        ]);
    }

    public function pengaturanWeb()
    {
        return view('dashboard.pengaturan', [
            'title' => 'Pengaturan Web',
        ]);
    }

    public function semuaKomentar()
    {
        return view('dashboard.komentar.semua-komentar', [
            'title' => 'Semua Komentar',
        ]);
    }
}
