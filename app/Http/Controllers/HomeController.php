<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function musik()
    {
        return view('home.musik');
    }

    public function kons()
    {
        return view('home.konferensi');
    }
}
