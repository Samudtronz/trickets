<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EventController extends Controller
{
    public function index()
    {
        $events = [];
        $trending = null;

        try {
            $data = Http::withHeaders(['gatewaykey'=>config('services.konferensi_service.key')])
                ->get(config('services.konferensi_service.url').'api/Userkonferensi')
                ->json('data', []);

            if(!empty($data)) {
                $trendingItem = collect($data)->sortByDesc('kuota')->first();
                if($trendingItem) {
                    $trending = [
                        'id'=>$trendingItem['id'],
                        'judul'=>$trendingItem['judul']??'-',
                        'tanggal'=>$trendingItem['tanggal']??now(),
                        'lokasi'=>$trendingItem['lokasi']??'-',
                        'kuota'=>$trendingItem['kuota']??0,
                        'foto'=> isset($trendingItem['foto_event'])? url("http://192.168.100.65/projek-services/konferensi-service/storage/{$trendingItem['foto_event']}") : 'assets/images/no-image.png',
                        'pembicara'=>$trendingItem['pembicara']??null,
                        'genre'=>null
                    ];
                }

                foreach($data as $item) {
                    $events[] = [
                        'id'=>$item['id'],
                        'judul'=>$item['judul']??'-',
                        'tanggal'=>$item['tanggal']??now(),
                        'lokasi'=>$item['lokasi']??'-',
                        'kuota'=>$item['kuota']??0,
                        'foto'=> isset($item['foto_event'])? url("http://192.168.100.65/projek-services/konferensi-service/storage/{$item['foto_event']}") : 'assets/images/no-image.png',
                        'pembicara'=>$item['pembicara']??null,
                        'genre'=>null
                    ];
                }
            }
        } catch (\Exception $e) {
            \Log::error('Gagal mengambil konferensi',['message'=>$e->getMessage()]);
        }

        return view('frontend.events.index', compact('events','trending'));
    }
}
