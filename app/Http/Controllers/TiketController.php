<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TiketController extends Controller
{
    // Halaman daftar tiket
    public function index()
    {
        // statis dulu
        return view('tiket.index');
    }

    // Halaman detail tiket
    public function show()
    {
        // statis dulu
        return view('tiket.show');
    }
}
