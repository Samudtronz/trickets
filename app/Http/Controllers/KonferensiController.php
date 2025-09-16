<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KonferensiController extends Controller
{
    public function index(Request $request)
    {
        $apiUrl = 'http://192.168.100.65/projek-services/gateway-service/api/Userkonferensi';

        try {
            $response = Http::get($apiUrl);

            if ($response->successful()) {
                $json = $response->json();
                $data = $json['data'] ?? [];

                $trending = collect($data)->sortByDesc('kuota')->first();

                $eventsCollection = collect($data)
                    ->reject(fn($item) => $trending && $item['id'] == $trending['id'])
                    ->sortByDesc('tanggal')
                    ->values();

                // pagination manual
                $perPage = 5;
                $currentPage = $request->input('page', 1);
                $pagedData = $eventsCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();

                $events = new \Illuminate\Pagination\LengthAwarePaginator(
                    $pagedData,
                    $eventsCollection->count(),
                    $perPage,
                    $currentPage,
                    ['path' => $request->url(), 'query' => $request->query()]
                );
            } else {
                $trending = null;
                $events = collect([]);
            }
        } catch (\Exception $e) {
            \Log::error('Gagal mengambil konferensi', ['message' => $e->getMessage()]);
            $trending = null;
            $events = collect([]);
        }

        // kalau request via AJAX → render partial
        if ($request->ajax()) {
            return view('home.partials.event-list', compact('events'))->render();
        }

        

        return view('home.konferensi', compact('trending', 'events'));
    }

    public function show($id)
    {
        $apiUrl = 'http://192.168.100.65/projek-services/gateway-service/api/Userkonferensi/' . $id;

        try {
            $response = Http::get($apiUrl);

            if ($response->successful()) {
                $event = $response->json();

                // pastikan event punya ID, kalau tidak berarti kosong
                if (!empty($event['id'])) {
                    return view('detail.konferensi', compact('event'));
                }
            }

            return view('detail.konferensi', ['event' => null]);
        } catch (\Exception $e) {
            \Log::error('Gagal mengambil detail konferensi', [
                'message' => $e->getMessage()
            ]);

            //dd($event);
            
            return view('detail.konferensi', ['event' => null]);
        }
    }

}