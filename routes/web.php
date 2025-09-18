<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KonferensiController;
use App\Http\Controllers\MusikController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontendController;

// Halaman Welcome
Route::get('/', [FrontendController::class, 'welcome'])->name('frontend.welcome');


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

// Detail Event Musik (dynamic dari API Gateway /musikal/{id})
Route::get('/event/musik/{id}', [MusikController::class, 'show'])->name('frontend.detail.musik');

// Detail Event Konferensi (dynamic dari API Gateway /home-konferensi/{id})
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

Route::get('tiket/event/{event}', [TiketController::class, 'showByEvent'])
    ->name('frontend.tiket.showByEvent');
Route::get('/tiket/musikal/{id}', [TiketController::class, 'showMusikal'])
    ->name('frontend.tiket.showMusikal');



Route::prefix('/backend')->group(function () {
    Route::get('/', [FrontendController::class, 'edit'])->name('backend.edit');
    Route::put('/update', [FrontendController::class, 'update'])->name('backend.update');
});