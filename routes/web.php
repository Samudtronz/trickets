<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KonferensiController;
use App\Http\Controllers\MusikController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AuthController;

// ===============================
// AUTH (Login / Logout)
// ===============================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===============================
// FRONTEND
// ===============================

// Halaman Welcome
Route::get('/', [FrontendController::class, 'welcome'])->name('frontend.welcome');

// Home Musik
Route::get('/home-musik', [MusikController::class, 'index'])->name('frontend.home.musik');

// Home Konferensi
Route::get('/home-konferensi', [KonferensiController::class, 'index'])->name('frontend.home.konferensi');

// ===============================
// DETAIL EVENT
// ===============================

// Detail Event Musik (dynamic)
Route::get('/event/musik/{id}', [MusikController::class, 'show'])->name('frontend.detail.musik');

// Detail Event Konferensi (dynamic)
Route::get('/home-konferensi/detail/{id}', [KonferensiController::class, 'show'])->name('frontend.detail.konferensi');

// ===============================
// TIKET
// ===============================

// Daftar tiket
Route::get('/tiket', [TiketController::class, 'index'])->name('frontend.tiket.index');

// Detail tiket
Route::get('/tiket/detail/{id}', [TiketController::class, 'show'])->name('frontend.tiket.show');
Route::get('/tiket/musikal/{id}', [TiketController::class, 'showMusikal'])->name('frontend.tiket.showmusikal');

// Halaman daftar semua event gabungan (konferensi + musik)
Route::get('/events', [EventController::class, 'index'])->name('frontend.events.index');

// Tiket berdasarkan event
Route::get('tiket/event/{event}', [TiketController::class, 'showByEvent'])
    ->name('frontend.tiket.showByEvent');

// ===============================
// BACKEND (Protected with Auth)
// ===============================
Route::prefix('/backend')->middleware('auth')->group(function () {
    Route::get('/', [FrontendController::class, 'edit'])->name('backend.edit');
    Route::put('/update', [FrontendController::class, 'update'])->name('backend.update');
});
