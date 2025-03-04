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
        ]);
    }

    public function kirimNaskah()
    {
        return view('home.kirimNaskah', [
            'title' => 'Kirim Naskah',
        ]);
    }

    public function penjelasanLayanan()
    {
        return view('home.penjelasanLayanan', [
            'title' => 'Penjelasan Layanan',
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

        // update view count
        $article->increment('views');

        return view('home.detailArtikel', [
            'title' => $article->judul,
            'article' => $article,
        ]);
    }
}
