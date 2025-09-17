<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MusikController extends Controller
{
    // Detail Musik (statis)
    public function index()
    {
        return view('frontend.home.musik');
    }

        public function show()
    {
        return view('frontend.detail.musik');
    }

}
