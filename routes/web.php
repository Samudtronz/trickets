<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventDetailController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\EventController;


Route::get('/welcome', function () {
    return view('welcome');
});

// Halaman Home Musik
Route::get('/home-musik', [HomeController::class, 'musik'])->name('home.musik');

// Halaman Home Konferensi
Route::get('/home-konferensi', [HomeController::class, 'kons'])->name('home.konferensi');

// Detail Event Musik
Route::get('/event/musik/', [EventDetailController::class, 'musik'])->name('detail.musik');

// Detail Event Konferensi
Route::get('/event/konferensi/', [EventDetailController::class, 'kons'])->name('detail.konferensi');

//TIKET
// Daftar tiket
Route::get('/tiket', [TiketController::class, 'index'])->name('tiket.index');

// Detail tiket
Route::get('/tiket/detail', [TiketController::class, 'show'])->name('tiket.show');

// Daftar semua event
Route::get('/events', [EventController::class, 'index'])->name('events.index');
