<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = [];
        $trending = null;

        $apiKonferensi = 'http://192.168.100.65/projek-services/gateway-service/api/Userkonferensi';
        try {
            $response = Http::get($apiKonferensi);

            if ($response->successful()) {
                $dataKonferensi = $response->json()['data'] ?? [];

                // Cari trending berdasarkan kuota tertinggi
                if (!empty($dataKonferensi)) {
                    $trendingItem = collect($dataKonferensi)->sortByDesc('kuota')->first();
                    if ($trendingItem) {
                        $trending = [
                            'id' => $trendingItem['id'],
                            'judul' => $trendingItem['judul'] ?? '-',
                            'tanggal' => $trendingItem['tanggal'] ?? now(),
                            'lokasi' => $trendingItem['lokasi'] ?? '-',
                            'kuota' => $trendingItem['kuota'] ?? 0,
                            'foto' => isset($trendingItem['foto_event']) 
                                ? url("http://192.168.100.65/projek-services/konferensi-service/storage/{$trendingItem['foto_event']}")
                                : 'assets/images/no-image.png',
                            'pembicara' => $trendingItem['pembicara'] ?? null,
                            'genre' => null,
                        ];
                    }

                    // Buat list event tanpa trending
                    foreach ($dataKonferensi as $item) {
                        $events[] = [
                            'id' => $item['id'], // penting untuk detail link
                            'judul' => $item['judul'] ?? '-',
                            'tanggal' => $item['tanggal'] ?? now(),
                            'lokasi' => $item['lokasi'] ?? '-',
                            'kuota' => $item['kuota'] ?? 0,
                            'foto' => isset($item['foto_event']) 
                                ? url("http://192.168.100.65/projek-services/konferensi-service/storage/{$item['foto_event']}")
                                : 'assets/images/no-image.png',
                            'pembicara' => $item['pembicara'] ?? null,
                            'genre' => null, // musik masih kosong
                        ];
                    }

                }
            }
        } catch (\Exception $e) {
            \Log::error('Gagal mengambil konferensi', ['message' => $e->getMessage()]);
        }

        return view('events.index', compact('events', 'trending'));
    }
}