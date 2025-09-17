<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TiketController extends Controller
{
    public function index()
    {
        $tickets = [
            'regular' => [],
            'business' => [],
            'VIP' => [],
        ];

        try {
            // Ambil semua tiket konferensi
            $tiketResponse = Http::get('http://192.168.100.65/projek-services/gateway-service/api/Usertiket');
            $tiketData = $tiketResponse->successful() ? $tiketResponse->json()['data'] : [];

            // Ambil semua event konferensi
            $eventResponse = Http::get('http://192.168.100.65/projek-services/gateway-service/api/Userkonferensi');
            $eventData = $eventResponse->successful() ? $eventResponse->json()['data'] : [];

            // Buat map id_event => event_detail
            $eventMap = [];
            foreach ($eventData as $event) {
                $eventMap[$event['id']] = [
                    'judul' => $event['judul'] ?? '-',
                    'tanggal' => $event['tanggal'] ?? now(),
                    'kuota' => $event['kuota'] ?? 0,
                    'pembicara' => $event['pembicara'] ?? null,
                ];
            }

            // Loop tiket
            foreach ($tiketData as $tiket) {
                $eventDetail = $eventMap[$tiket['id_event']] ?? [
                    'judul' => '-',
                    'tanggal' => now(),
                    'kuota' => 0,
                    'pembicara' => null,
                ];

                $tiketFull = array_merge($tiket, $eventDetail);

                $jenis = strtolower($tiket['jenis_tiket'] ?? 'regular');
                if (in_array($jenis, ['regular', 'business', 'vip'])) {
                    $tickets[$jenis][] = $tiketFull;
                }
            }

        } catch (\Exception $e) {
            \Log::error('Gagal mengambil tiket/konferensi', ['message' => $e->getMessage()]);
        }

        return view('tiket.index', compact('tickets'));
    }

    
    public function show($id)
    {
        $tiket = null;
        $eventDetail = null;

        try {
            // Ambil tiket berdasarkan id
            $tiketResponse = Http::get("http://192.168.100.65/projek-services/gateway-service/api/Usertiket/{$id}");
            if ($tiketResponse->successful()) {
                $tiket = $tiketResponse->json()['data'] ?? null;

                if ($tiket && !empty($tiket['id_event'])) {
                    // Ambil detail event
                    $eventResponse = Http::get("http://192.168.100.65/projek-services/gateway-service/api/Userkonferensi/{$tiket['id_event']}");
                    if ($eventResponse->successful()) {
                        $eventDetail = $eventResponse->json()['data'] ?? null;
                    }
                }
            }
        } catch (\Exception $e) {
            \Log::error('Gagal mengambil detail tiket', ['message' => $e->getMessage()]);
        }

        return view('tiket.show', compact('tiket', 'eventDetail'));
    }
}
