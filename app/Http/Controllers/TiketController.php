<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TiketController extends Controller
{
    public function index()
    {
        $ticketsMusikal = [
            'regular' => [],
            'business' => [],
            'VIP' => []
        ];

        $ticketsKonferensi = [
            'regular' => [],
            'business' => [],
            'VIP' => []
        ];

        try {
            // ====== AMBIL TIKET MUSIKAL ======
            $ticketResponse = Http::withHeaders([
                'X-GATEWAY-KEY' => 'tiket123'
            ])->get('http://192.168.100.69/musikal/api-gateway/api/tiket');

            $allTicketsMusikal = collect($ticketResponse->json()['data'] ?? []);

            $eventResponse = Http::withHeaders([
                'X-GATEWAY-KEY' => 'tiket123'
            ])->get('http://192.168.100.69/musikal/api-gateway/api/musikal');

            $allEventsMusikal = collect($eventResponse->json()['data'] ?? []);

            foreach ($allTicketsMusikal as $ticket) {
                $eventDetail = $allEventsMusikal->firstWhere('id', $ticket['id_event']) ?? [];
                $tiketFull = array_merge($ticket, $eventDetail, ['jenis_event' => 'musikal']);

                $jenis = strtolower($ticket['jenis_tiket'] ?? 'regular');
                $mapJenis = ['regular' => 'regular', 'business' => 'business', 'vip' => 'VIP'];
                if (isset($mapJenis[$jenis])) {
                    $ticketsMusikal[$mapJenis[$jenis]][] = $tiketFull;
                }
            }

            // ====== AMBIL TIKET KONFERENSI ======
            $tiketData = Http::withHeaders([
                'gatewaykey' => config('services.tiketSamud_service.key'),
            ])->get(config('services.tiketSamud_service.url') . 'api/Usertiket')->json('data', []);

            $eventData = Http::withHeaders([
                'gatewaykey' => config('services.konferensi_service.key'),
            ])->get(config('services.konferensi_service.url') . 'api/Userkonferensi')->json('data', []);

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
                $eventDetail = $eventMap[$tiket['id_event']] ?? [];
                $tiketFull = array_merge($tiket, $eventDetail, ['jenis_event' => 'konferensi']);

                $jenis = strtolower($tiket['jenis_tiket'] ?? 'regular');
                $mapJenis = ['regular' => 'regular', 'business' => 'business', 'vip' => 'VIP'];
                if (isset($mapJenis[$jenis])) {
                    $ticketsKonferensi[$mapJenis[$jenis]][] = $tiketFull;
                }
            }

        } catch (\Exception $e) {
            \Log::error('Gagal mengambil tiket gabungan', ['message' => $e->getMessage()]);
        }

        return view('frontend.tiket.index', compact('ticketsMusikal', 'ticketsKonferensi'));
    }

    public function show($id)
    {
        $tiket = null;
        $eventDetail = null;

        try {
            $tiket = Http::withHeaders(['gatewaykey' => config('services.tiketSamud_service.key')])
                ->get(config('services.tiketSamud_service.url') . "api/Usertiket/{$id}")
                ->json('data', null);

            if ($tiket && !empty($tiket['id_event'])) {
                $eventDetail = Http::withHeaders(['gatewaykey' => config('services.konferensi_service.key')])
                    ->get(config('services.konferensi_service.url') . "api/Userkonferensi/{$tiket['id_event']}")
                    ->json('data', null);
            }

        } catch (\Exception $e) {
            \Log::error('Gagal mengambil detail tiket', ['message' => $e->getMessage()]);
        }

        return view('frontend.tiket.show', compact('tiket', 'eventDetail'));
    }

    public function showByEvent($eventId)
    {
        $tiket = null;
        $eventDetail = null;

        try {
            $tiketData = Http::withHeaders([
                'gatewaykey' => config('services.tiketSamud_service.key')
            ])->get(config('services.tiketSamud_service.url') . "api/Usertiket")
                ->json('data', []);

            if (!is_array($tiketData)) $tiketData = [];

            foreach ($tiketData as $item) {
                if (is_array($item) && isset($item['id_event']) && $item['id_event'] == $eventId) {
                    $tiket = $item;
                    break;
                }
            }

            $eventDetail = Http::withHeaders([
                'gatewaykey' => config('services.konferensi_service.key')
            ])->get(config('services.konferensi_service.url') . "api/Userkonferensi/{$eventId}")
                ->json('data', null);

            if (!is_array($eventDetail)) $eventDetail = null;

        } catch (\Exception $e) {
            \Log::error('Gagal mengambil tiket/event', ['message' => $e->getMessage()]);
        }

        return view('frontend.tiket.show', compact('tiket', 'eventDetail'));
    }

     public function showMusikal($id)
    {
        $event = null;
        $tiket = null;

        try {
            // Ambil semua tiket
            $ticketResponse = Http::withHeaders([
                'X-GATEWAY-KEY' => 'tiket123'
            ])->get('http://192.168.100.69/musikal/api-gateway/api/tiket');

            $allTickets = collect($ticketResponse->json()['data'] ?? []);
            $tiket = $allTickets->firstWhere('id_event', (int)$id);

            // Ambil semua event
            $eventResponse = Http::withHeaders([
                'X-GATEWAY-KEY' => 'tiket123'
            ])->get('http://192.168.100.69/musikal/api-gateway/api/musikal');

            $allEvents = collect($eventResponse->json()['data'] ?? []);
            $event = $allEvents->firstWhere('id', (int)$id);

            if (!$event) {
                $event = [
                    'id' => 0,
                    'judul' => 'Event Tidak Ditemukan',
                    'deskripsi' => 'Data event tidak tersedia',
                    'banner' => asset('assets/images/backgrounds/coachella.png'),
                    'link_video' => null,
                    'harga' => 0,
                    'kuota' => 0,
                    'tanggal' => null,
                ];
            }

        } catch (\Exception $e) {
            \Log::error('Gagal mengambil event/tiket musikal', ['message' => $e->getMessage()]);
            $event = [
                'id' => 0,
                'judul' => 'Terjadi Kesalahan',
                'deskripsi' => 'Tidak bisa mengambil data event',
                'banner' => asset('assets/images/backgrounds/coachella.png'),
                'link_video' => null,
                'harga' => 0,
                'kuota' => 0,
                'tanggal' => null,
            ];
        }

        return view('frontend.tiket.showmusikal', compact('event', 'tiket'));
    }
}
