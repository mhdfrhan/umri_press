<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function semuaBuku()
    {
        return view('dashboard.buku.semua-buku');
    }

    public function tambahBuku()
    {
        return view('dashboard.buku.tambah-buku');
    }

    public function semuaArtikel()
    {
        return view('dashboard.artikel.semua-artikel');
    }

    public function tambahArtikel()
    {
        return view('dashboard.artikel.tambah-artikel');
    }
}
