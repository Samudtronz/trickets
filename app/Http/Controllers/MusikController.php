<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class MusikController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua event dari API
        $response = Http::withHeaders([
            'X-GATEWAY-KEY' => 'musikal123'
        ])->get('http://192.168.100.69/musikal/api-gateway/api/musikal');

        $trending = null;
        $events   = new LengthAwarePaginator([], 0, 5, 1);

        if ($response->successful()) {
            $allEvents = collect($response->json()['data'] ?? []);

            // trending = kuota terbesar
            $trending = $allEvents->sortByDesc('kuota')->first();

            // event lain selain trending
            $eventsCollection = $allEvents->reject(fn($item) => $trending && $item['id'] == $trending['id'])
                                          ->sortByDesc('tanggal')
                                          ->values();

            // pagination manual
            $perPage     = 5;
            $currentPage = $request->input('page', 1);
            $pagedData   = $eventsCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();

            $events = new LengthAwarePaginator(
                $pagedData,
                $eventsCollection->count(),
                $perPage,
                $currentPage,
                ['path' => $request->url(), 'query' => $request->query()]
            );
        }

        return view('frontend.home.musik', compact('trending', 'events'));
    }

    public function show($id)
    {
        // Ambil detail event dari API
        $response = Http::withHeaders([
            'X-GATEWAY-KEY' => 'musikal123'
        ])->get("http://192.168.100.69/musikal/api-gateway/api/musikal/{$id}");

        if ($response->successful()) {
            $event = $response->json()['data'] ?? null;

            if (!$event) {
                $event = [
                    'id'        => 0,
                    'judul'     => 'Event Tidak Ditemukan',
                    'deskripsi' => 'Data event tidak tersedia',
                    'lokasi'    => null,
                    'tanggal'   => null,
                    'waktu_perform' => null,
                    'kuota'     => 0,
                    'link_video'=> null,
                    'genre'     => null,
                    'foto_event_url' => asset('assets/images/backgrounds/coachella.png')
                ];
            }
        } else {
            $event = [
                'id'        => 0,
                'judul'     => 'Event Tidak Tersedia',
                'deskripsi' => 'API sedang bermasalah, coba lagi nanti.',
                'lokasi'    => null,
                'tanggal'   => null,
                'waktu_perform' => null,
                'kuota'     => 0,
                'link_video'=> null,
                'genre'     => null,
                'foto_event_url' => asset('assets/images/backgrounds/coachella.png')
            ];
        }

        return view('frontend.detail.musik', compact('event'));
    }
}
