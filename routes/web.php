<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KonferensiController;
use App\Http\Controllers\MusikController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;

// Halaman Welcome
Route::get('/', function () {
    return view('frontend.welcome');
});

// ===============================
// HOME PAGES
// ===============================

// Home Musik
Route::get('/home-musik', [MusikController::class, 'index'])->name('frontend.home.musik');

// Home Konferensi
Route::get('/home-konferensi', [KonferensiController::class, 'index'])->name('frontend.home.konferensi');

// ===============================
// DETAIL EVENT
// ===============================

// Detail Event Musik (dynamic)
Route::get('/event/musik', [MusikController::class, 'show'])->name('frontend.detail.musik');

// Detail Event Konferensi (dynamic API)
Route::get('/home-konferensi/detail/{id}', [KonferensiController::class, 'show'])->name('frontend.detail.konferensi');

// ===============================
// TIKET
// ===============================

// Daftar tiket
Route::get('/tiket', [TiketController::class, 'index'])->name('frontend.tiket.index');

// Detail tiket
Route::get('/tiket/detail/{id}', [TiketController::class, 'show'])->name('frontend.tiket.show');

// Halaman daftar semua event gabungan (konferensi + musik)
Route::get('/events', [EventController::class, 'index'])->name('frontend.events.index');
