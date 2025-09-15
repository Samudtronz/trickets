<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventDetailController extends Controller
{
    // Detail Musik (statis)
    public function musik()
    {
        return view('detail.musik');
    }

    // Detail Konferensi (statis)
    public function kons()
    {
        return view('detail.konferensi');
    }
}
