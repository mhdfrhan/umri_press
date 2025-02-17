<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'title' => 'Home',
        ]);
    }

    public function team()
    {
        return view('home.team', [
            'title' => 'Team',
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

    public function harga()
    {
        return view('home.harga', [
            'title' => 'Harga',
        ]);
    }

    public function tokoBuku()
    {
        return view('home.tokoBuku', [
            'title' => 'Toko Buku',
        ]);
    }
}
