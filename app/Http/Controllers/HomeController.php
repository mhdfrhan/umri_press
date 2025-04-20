<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Buku;
use App\Models\PaketPenerbit;
use App\Models\Pengaturan;
use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $latestArticles = Artikel::with(['kategori', 'user'])
            ->where('status', 'publish')
            ->latest()
            ->take(3)
            ->get();
        return view('home.index', [
            'title' => 'Home',
            'latestArticles' => $latestArticles,
            'settings' => Pengaturan::pluck('value', 'key')
        ]);
    }

    public function tentangKami()
    {
        return view('home.tentangKami', [
            'title' => 'Tentang Kami',
        ]);
    }

    public function team()
    {
        return view('home.team', [
            'title' => 'Team',
            'teamMembers' => Tim::orderBy('position')->get()
        ]);
    }

    public function daftarPenulis()
    {
        return view('home.daftarPenulis', [
            'title' => 'Daftar Penulis',
            'settings' => Pengaturan::pluck('value', 'key')
        ]);
    }

    public function kirimNaskah()
    {
        $settings = Pengaturan::pluck('value', 'key');
        return view('home.kirimNaskah', [
            'title' => 'Kirim Naskah',
            'settings' => $settings
        ]);
    }

    public function penjelasanLayanan()
    {
        $packages = PaketPenerbit::where('active', true)
        ->orderBy('position')
        ->get();

        return view('home.penjelasanLayanan', [
            'title' => 'Penjelasan Layanan',
            'packages' => $packages,
        ]);
    }

    public function harga()
    {
        $packages = PaketPenerbit::where('active', true)
            ->orderBy('position')
            ->get();
        return view('home.harga', [
            'title' => 'Harga',
            'packages' => $packages,
        ]);
    }

    public function tokoBuku()
    {
        return view('home.tokoBuku', [
            'title' => 'Toko Buku',
        ]);
    }

    public function kontak()
    {
        return view('home.kontak', [
            'title' => 'Kontak',
        ]);
    }

    public function artikel()
    {
        return view('home.artikel', [
            'title' => 'Artikel',
        ]);
    }

    public function detailArtikel($slug)
    {
        $article = Artikel::with(['kategori', 'user'])
            ->where('slug', $slug)
            ->where('status', 'publish')
            ->first();

        if (!$article) {
            return redirect()->route('home');
        }

        $article->increment('views');

        return view('home.detailArtikel', [
            'title' => $article->judul,
            'article' => $article,
        ]);
    }

    public function progressISBN()
    {
        return view('home.progressISBN', [
            'title' => 'Lihat Progress ISBN',
        ]);
    }
}
