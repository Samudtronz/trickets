<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EventController extends Controller
{
    public function index()
    {
        // ==========================
        // Ambil data konferensi dari API
        // ==========================
        $konferensi = [];
        try {
            $response = Http::withHeaders([
                'X-GATEWAY-KONFERENSI' => config('services.konferensi_service.key'),
            ])->get(config('services.konferensi_service.url') . '/api/Userkonferensi');

            if ($response->successful()) {
                $json = $response->json();
                $konferensi = $json['data'] ?? [];
            }
        } catch (\Exception $e) {
            \Log::error('Gagal mengambil data konferensi', ['message' => $e->getMessage()]);
        }

        // ==========================
        // Musik hardcode
        // ==========================
        $musik = [
            [
                'judul' => 'Jazz Malam',
                'tanggal' => '2025-12-22',
                'lokasi' => 'Taman Budaya, Yogyakarta',
                'kuota' => 500,
                'genre' => 'Jazz',
                'foto' => asset('assets/images/events/musik1.jpg'),
            ],
            [
                'judul' => 'Rock Nation',
                'tanggal' => '2026-01-10',
                'lokasi' => 'Stadion Utama GBK',
                'kuota' => 1000,
                'genre' => 'Rock',
                'foto' => asset('assets/images/events/musik2.jpg'),
            ],
        ];

        // ==========================
        // Gabungkan konferensi + musik
        // ==========================
        $events = array_merge(
            array_map(fn($k) => [
                'judul' => $k['judul'] ?? 'Judul Konferensi',
                'tanggal' => $k['tanggal'] ?? null,
                'lokasi' => $k['lokasi'] ?? 'Lokasi belum ditentukan',
                'kuota' => $k['kuota'] ?? 0,
                'pembicara' => $k['pembicara'] ?? '-',
                'foto' => isset($k['foto_event']) 
                    ? "http://192.168.100.65/projek-services/konferensi-service/storage/{$k['foto_event']}" 
                    : asset('assets/images/events/fallback-konferensi.jpg'),
            ], $konferensi),
            $musik
        );

        return view('events.index', compact('events'));
    }
}
