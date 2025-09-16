<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KonferensiController;
use App\Http\Controllers\MusikController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;

// Halaman Welcome
Route::get('/welcome', function () {
    return view('welcome');
});

// ===============================
// HOME PAGES
// ===============================

// Home Musik
Route::get('/home-musik', [MusikController::class, 'index'])->name('home.musik');

// Home Konferensi
Route::get('/home-konferensi', [KonferensiController::class, 'index'])->name('home.konferensi');

// ===============================
// DETAIL EVENT
// ===============================

// Detail Event Musik (hardcode)
Route::get('/event/musik', [MusikController::class, 'show'])->name('detail.musik');

// Detail Event Konferensi (dynamic API)
Route::get('/home-konferensi/detail/{id}', [KonferensiController::class, 'show'])->name('detail.konferensi');

// ===============================
// TIKET
// ===============================

// Daftar tiket
Route::get('/tiket', [TiketController::class, 'index'])->name('tiket.index');

// Detail tiket
Route::get('/tiket/detail', [TiketController::class, 'show'])->name('tiket.show');

// ===============================
// GABUNGAN EVENT
// ===============================

// Halaman daftar semua event gabungan (konferensi + musik)
Route::get('/events', [EventController::class, 'index'])->name('events.index');
