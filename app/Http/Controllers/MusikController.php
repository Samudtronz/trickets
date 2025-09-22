<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Exception;

class MusikController extends Controller
{
    protected string $apiUrl;
    protected array $headers;

    public function __construct()
    {
        $this->apiUrl = "http://192.168.100.69/musikal/api-gateway/api/musikal";
        $this->headers = [
            'X-GATEWAY-KEY' => 'musikal123'
        ];
    }

    /**
     * Home Musik (Hero + Trending + Countdown + event list)
     */
   public function index(Request $request)
{
    $trending = null;
    $events = new LengthAwarePaginator([], 0, 4, 1);

    try {
        $response = Http::withHeaders($this->headers)->get($this->apiUrl);

        if ($response->successful()) {
            $allEvents = collect($response->json()['data'] ?? []);

            // trending = kuota terbesar
            $trending = $allEvents->sortByDesc('kuota')->first();

            // ambil semua event selain trending, urut berdasarkan tanggal desc
            $eventsCollection = $allEvents
                ->reject(fn($item) => $trending && (($item['id'] ?? null) == ($trending['id'] ?? null)))
                ->sortByDesc('tanggal')
                ->values();

            // pagination manual (4 per page)
            $perPage = 4;
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $pagedData = $eventsCollection->forPage($currentPage, $perPage);

            $events = new LengthAwarePaginator(
                $pagedData,
                $eventsCollection->count(),
                $perPage,
                $currentPage,
                [
                    'path'  => $request->url(),
                    'query' => $request->query(),
                ]
            );
        }
    } catch (Exception $e) {
        Log::error('MusikController@index error: ' . $e->getMessage());
    }

    return view('frontend.home.musik', compact('trending', 'events'));
}


    /**
     * Detail Event Musik
     */
    public function show($id)
    {
        try {
            $response = Http::withHeaders($this->headers)->get("{$this->apiUrl}/{$id}");

            if ($response->successful()) {
                $event = $response->json()['data'] ?? null;
                if (!$event) {
                    $event = $this->fallbackEvent("Event Tidak Ditemukan", "Data event tidak tersedia");
                }
            } else {
                $event = $this->fallbackEvent("Event Tidak Tersedia", "API sedang bermasalah, coba lagi nanti.");
            }
        } catch (Exception $e) {
            Log::error("MusikController@show error: {$e->getMessage()}");
            $event = $this->fallbackEvent("Event Tidak Tersedia", "API sedang bermasalah, coba lagi nanti.");
        }

        return view('frontend.detail.musik', compact('event'));
    }

    private function fallbackEvent($judul, $deskripsi)
    {
        return [
            'id' => 0,
            'judul' => $judul,
            'deskripsi' => $deskripsi,
            'lokasi' => null,
            'tanggal' => null,
            'waktu_perform' => null,
            'kuota' => 0,
            'link_video' => null,
            'genre' => null,
            'foto_event_url' => asset('assets/images/backgrounds/coachella.png'),
        ];
    }
}
