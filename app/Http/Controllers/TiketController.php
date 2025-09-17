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
            $tiketResponse = Http::get(config('services.tiket_service.url') . '/api/Usertiket');
            $tiketData = $tiketResponse->successful() ? $tiketResponse->json()['data'] : [];

            $eventResponse = Http::get(config('services.konferensi_service.url') . '/api/Userkonferensi');
            $eventData = $eventResponse->successful() ? $eventResponse->json()['data'] : [];

            $eventMap = [];
            foreach ($eventData as $event) {
                $eventMap[$event['id']] = [
                    'judul' => $event['judul'] ?? '-',
                    'tanggal' => $event['tanggal'] ?? now(),
                    'kuota' => $event['kuota'] ?? 0,
                    'pembicara' => $event['pembicara'] ?? null,
                ];
            }

            foreach ($tiketData as $tiket) {
                $eventDetail = $eventMap[$tiket['id_event']] ?? [
                    'judul' => '-',
                    'tanggal' => now(),
                    'kuota' => 0,
                    'pembicara' => null,
                ];

                $tiketFull = array_merge($tiket, $eventDetail);

                $jenis = strtolower($tiket['jenis_tiket'] ?? 'regular');
                $mapJenis = ['regular' => 'regular', 'business' => 'business', 'vip' => 'VIP'];

                if (isset($mapJenis[$jenis])) {
                    $tickets[$mapJenis[$jenis]][] = $tiketFull;
                }
            }

        } catch (\Exception $e) {
            \Log::error('Gagal mengambil tiket/konferensi', ['message' => $e->getMessage()]);
        }

        return view('frontend.tiket.index', compact('tickets'));
    }

    public function show($id)
    {
        $tiket = null;
        $eventDetail = null;

        try {
            $tiketResponse = Http::get(config('services.tiket_service.url') . "/api/Usertiket/{$id}");
            if ($tiketResponse->successful()) {
                $tiket = $tiketResponse->json()['data'] ?? null;

                if ($tiket && !empty($tiket['id_event'])) {
                    $eventResponse = Http::get(config('services.konferensi_service.url') . "/api/Userkonferensi/{$tiket['id_event']}");
                    if ($eventResponse->successful()) {
                        $eventDetail = $eventResponse->json()['data'] ?? null;
                    }
                }
            }
        } catch (\Exception $e) {
            \Log::error('Gagal mengambil detail tiket', ['message' => $e->getMessage()]);
        }

        return view('frontend.tiket.show', compact('tiket', 'eventDetail'));
    }
}

