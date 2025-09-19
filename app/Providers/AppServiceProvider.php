<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Frontend; // gunakan model yang benar

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Ambil data frontend dari DB
        $konten = Frontend::pluck('value', 'key')->toArray();

        // Bagikan ke semua view
        View::share('konten', $konten);
    }
}
