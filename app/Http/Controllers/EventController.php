<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EventController extends Controller
{
    public function index()
    {
        $konferensi     = [];
        $musikal        = [];
        $trending       = null;
        $popularEvents  = collect();

        // ======================
        // 1. Ambil data konferensi
        // ======================
        try {
            $dataKonferensi = Http::withHeaders([
                'gatewaykey' => config('services.konferensi_service.key')
            ])->get(config('services.konferensi_service.url') . 'api/Userkonferensi')
              ->json('data', []);

            if (!empty($dataKonferensi)) {
                $trendingItem = collect($dataKonferensi)->sortByDesc('kuota')->first();
                if ($trendingItem) {
                    $trending = [
                        'id'        => $trendingItem['id'],
                        'judul'     => $trendingItem['judul'] ?? '-',
                        'tanggal'   => $trendingItem['tanggal'] ?? now(),
                        'lokasi'    => $trendingItem['lokasi'] ?? '-',
                        'kuota'     => $trendingItem['kuota'] ?? 0,
                        'foto'      => isset($trendingItem['foto_event'])
                            ? url("http://192.168.100.65/projek-services/konferensi-service/storage/{$trendingItem['foto_event']}")
                            : asset('assets/images/no-image.png'),
                        'pembicara' => $trendingItem['pembicara'] ?? null,
                        'genre'     => null,
                        'tipe'      => 'konferensi',
                    ];
                }

                foreach ($dataKonferensi as $item) {
                    $konferensi[] = [
                        'id'        => $item['id'],
                        'judul'     => $item['judul'] ?? '-',
                        'tanggal'   => $item['tanggal'] ?? now(),
                        'lokasi'    => $item['lokasi'] ?? '-',
                        'kuota'     => $item['kuota'] ?? 0,
                        'foto'      => isset($item['foto_event'])
                            ? url("http://192.168.100.65/projek-services/konferensi-service/storage/{$item['foto_event']}")
                            : asset('assets/images/no-image.png'),
                        'pembicara' => $item['pembicara'] ?? null,
                        'genre'     => null,
                        'tipe'      => 'konferensi',
                    ];
                }
            }
        } catch (\Exception $e) {
            \Log::error('Gagal mengambil konferensi', ['message' => $e->getMessage()]);
        }

        // ======================
        // 2. Ambil data musikal
        // ======================
        try {
            $dataMusikal = Http::withHeaders([
                'gatewaykey' => 'musikal123'
            ])->get('http://192.168.100.69/musikal/api-gateway/api/musikal')
              ->json('data', []);

            if (!empty($dataMusikal)) {
                foreach ($dataMusikal as $item) {
                    $musikal[] = [
                        'id'      => $item['id'],
                        'judul'   => $item['judul'] ?? '-',
                        'tanggal' => $item['tanggal'] ?? now(),
                        'lokasi'  => $item['lokasi'] ?? '-',
                        'kuota'   => $item['kuota'] ?? 0,
                        'foto'    => $item['foto_event_url'] ?? asset('assets/images/no-image.png'),
                        'genre'   => $item['genre'] ?? null,
                        'tipe'    => 'musikal',
                    ];
                }

                if (!$trending && !empty($dataMusikal)) {
                    $trendingItem = collect($dataMusikal)->sortByDesc('kuota')->first();
                    if ($trendingItem) {
                        $trending = [
                            'id'      => $trendingItem['id'],
                            'judul'   => $trendingItem['judul'] ?? '-',
                            'tanggal' => $trendingItem['tanggal'] ?? now(),
                            'lokasi'  => $trendingItem['lokasi'] ?? '-',
                            'kuota'   => $trendingItem['kuota'] ?? 0,
                            'foto'    => $trendingItem['foto_event_url'] ?? asset('assets/images/no-image.png'),
                            'genre'   => $trendingItem['genre'] ?? null,
                            'tipe'    => 'musikal',
                        ];
                    }
                }
            }
        } catch (\Exception $e) {
            \Log::error('Gagal mengambil musikal', ['message' => $e->getMessage()]);
        }

        // ======================
        // 3. Gabungan event populer
        // ======================
        $popularEvents = collect(array_merge($konferensi, $musikal))
            ->sortByDesc('kuota')
            ->take(6);

        return view('frontend.events.index', [
            'konferensi'     => $konferensi,
            'musikal'        => $musikal,
            'trending'       => $trending,
            'popularEvents'  => $popularEvents,
        ]);
    }
}
