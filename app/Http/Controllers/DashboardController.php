<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'title' => 'Dashboard',
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
}
