<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class KonferensiController extends Controller
{
    private string $baseUrl;
    private array $headers;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.konferensi_service.url'), '/') . '/';
        $this->headers = [
            'gatewaykey' => config('services.konferensi_service.key'),
        ];
    }

    public function index(Request $request)
    {
        try {
            $response = Http::withHeaders($this->headers)
                ->get($this->baseUrl . 'api/Userkonferensi');
         
            if ($response->successful()) {
                $json = $response->json();
                $data = $json['data'] ?? [];

                $trending = collect($data)->sortByDesc('kuota')->first();
                $trending = is_array($trending) ? $trending : null;

                $eventsCollection = collect($data)
                    ->reject(fn($item) => $trending && $item['id'] == ($trending['id'] ?? null))
                    ->sortByDesc('tanggal')
                    ->values();

                // pagination manual
                $perPage = 5;
                $currentPage = $request->input('page', 1);
                $pagedData = $eventsCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();

                $events = new LengthAwarePaginator(
                    $pagedData,
                    $eventsCollection->count(),
                    $perPage,
                    $currentPage,
                    ['path' => $request->url(), 'query' => $request->query()]
                );
            } else {
                $trending = null;
                $events = new LengthAwarePaginator([], 0, 5, 1);
            }
        } catch (\Exception $e) {
            \Log::error('Gagal mengambil konferensi', ['message' => $e->getMessage()]);
            $trending = null;
            $events = new LengthAwarePaginator([], 0, 5, 1);
        }

        if ($request->ajax()) {
            return view('home.partials.event-list', compact('events'))->render();
        }

        return view('frontend.home.konferensi', compact('trending', 'events'));
    }

    public function show($id)
    {
        $event = null;

        try {
            $response = Http::withHeaders([
                'gatewaykey' => config('services.konferensi_service.key'),
            ])->get(config('services.konferensi_service.url') . "api/Userkonferensi/{$id}");

            // Ambil data jika API sukses
            if ($response->successful()) {
                $event = $response->json();
                $event = is_array($event) ? $event : null;
            }

        } catch (\Exception $e) {
            \Log::error('Gagal mengambil detail konferensi', [
                'id' => $id,
                'message' => $e->getMessage()
            ]);
        }

        // Render view, event bisa null kalau gagal
        return view('frontend.detail.konferensi', compact('event'));
    }

}