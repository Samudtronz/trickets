<?php

namespace App\Http\Controllers;

use App\Models\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{
    // Halaman welcome (frontend)
    public function welcome()
    {
        $keys = ['home_title', 'home_tagline', 'home_description', 'home_background', 'home_logo'];
        $konten = Frontend::whereIn('key', $keys)->pluck('value', 'key')->toArray();

        // Tambahkan helper URL untuk background dan logo
        $konten['home_background_url'] = !empty($konten['home_background'])
            ? asset('storage/' . $konten['home_background'])
            : asset('assets/images/backgrounds/bg-welcome.png');

        $konten['home_logo_url'] = !empty($konten['home_logo'])
            ? asset('storage/' . $konten['home_logo'])
            : asset('assets/images/logo/logo-only.png');
            // Footer dinamis
        $footerKeys = ['footer_logo', 'footer_brand', 'footer_description', 'footer_copyright'];
        $footer = Frontend::whereIn('key', $footerKeys)->pluck('value', 'key')->toArray();

        // fallback jika kosong
        $konten['home_background'] = $konten['home_background'] ?? 'assets/images/backgrounds/bg-welcome.png';
        $konten['home_logo'] = $konten['home_logo'] ?? 'assets/images/logo/logo-only.png';
        $konten['footer_logo'] = $konten['footer_logo'] ?? 'assets/images/logo/logo-only.png';
        $konten['footer_brand'] = $konten['footer_brand'] ?? 'Trickets';
        $konten['footer_description'] = $konten['footer_description'] ?? 'Platform sederhana untuk mengelola event dan tiket. Pesan tiket mudah, cepat, dan aman.';
        $konten['footer_copyright'] = $konten['footer_copyright'] ?? 'All rights reserved.';

        $konten['home_background_url'] = asset('storage/'.$konten['home_background']);
        $konten['home_logo_url'] = asset('storage/'.$konten['home_logo']);
        $konten['footer_logo_url'] = asset('storage/'.$konten['footer_logo']);

        return view('frontend.welcome', compact('konten', 'footer'));
    }

    // Edit konten (backend)
    public function edit()
    {
        $keys = [
            // Home
            'home_title', 'home_tagline', 'home_description', 'home_background', 'home_logo',
            // Conference
            'conference_event_subtitle', 'conference_event_trending_text', 'trending_conference_title',
            'trending_conference_countdown_hari', 'trending_conference_countdown_jam',
            'trending_conference_countdown_menit', 'trending_conference_countdown_detik', 'conference_event_list',
            // Musical
            'musical_event_subtitle', 'musical_event_trending_text', 'trending_musical_title',
            'trending_musical_countdown_hari', 'trending_musical_countdown_jam',
            'trending_musical_countdown_menit', 'trending_musical_countdown_detik', 'musical_event_list',
            // Sidebar & Countdown Show (Conference)
            'conference_sidebar_kuota_tanggal_title', 'conference_sidebar_sisa_kuota_label',
            'conference_sidebar_peserta_label', 'conference_sidebar_tanggal_event_label',
            'conference_countdown_title', 'conference_countdown_label_hari',
            'conference_countdown_label_jam', 'conference_countdown_label_menit',
            'conference_countdown_label_detik',
            // Sidebar & Countdown Show (Musical)
            'musical_sidebar_kuota_tanggal_title', 'musical_sidebar_sisa_kuota_label',
            'musical_sidebar_peserta_label', 'musical_sidebar_tanggal_event_label',
            'musical_countdown_title', 'musical_countdown_label_hari',
            'musical_countdown_label_jam', 'musical_countdown_label_menit',
            'musical_countdown_label_detik',
            // Navbar
            'navbar_logo', 'navbar_brand',
            //Footer
            'footer_logo', 'footer_brand', 'footer_description', 'footer_copyright',
        ];

        $konten = Frontend::whereIn('key', $keys)->pluck('value', 'key');

        return view('backend.edit', compact('konten'));
    }

    public function update(Request $request)
    {
        $keys = [
            // Home
            'home_title', 'home_tagline', 'home_description', 'home_background', 'home_logo',
            // Conference
            'conference_event_subtitle', 'conference_event_trending_text', 'trending_conference_title',
            'trending_conference_countdown_hari', 'trending_conference_countdown_jam',
            'trending_conference_countdown_menit', 'trending_conference_countdown_detik', 'conference_event_list',
            // Musical
            'musical_event_subtitle', 'musical_event_trending_text', 'trending_musical_title',
            'trending_musical_countdown_hari', 'trending_musical_countdown_jam',
            'trending_musical_countdown_menit', 'trending_musical_countdown_detik', 'musical_event_list',
            // Sidebar & Countdown Show (Conference)
            'conference_sidebar_kuota_tanggal_title', 'conference_sidebar_sisa_kuota_label',
            'conference_sidebar_peserta_label', 'conference_sidebar_tanggal_event_label',
            'conference_countdown_title', 'conference_countdown_label_hari',
            'conference_countdown_label_jam', 'conference_countdown_label_menit',
            'conference_countdown_label_detik',
            // Sidebar & Countdown Show (Musical)
            'musical_sidebar_kuota_tanggal_title', 'musical_sidebar_sisa_kuota_label',
            'musical_sidebar_peserta_label', 'musical_sidebar_tanggal_event_label',
            'musical_countdown_title', 'musical_countdown_label_hari',
            'musical_countdown_label_jam', 'musical_countdown_label_menit',
            'musical_countdown_label_detik',
            // Navbar
            'navbar_logo', 'navbar_brand',
            //Footer
            'footer_logo', 'footer_brand', 'footer_description', 'footer_copyright',
        ];

        $konten = Frontend::whereIn('key',$keys)->pluck('value','key')->toArray();

        foreach($keys as $key){
            if($request->hasFile($key)){
                $file = $request->file($key);
                $extension = $file->getClientOriginalExtension();

                // Folder tujuan
                if($key === 'home_background'){
                    $folder = 'public/assets/images/backgrounds';
                } elseif(in_array($key,['home_logo','footer_logo'])){
                    $folder = 'public/assets/images/logo';
                }

                // Nama file
                if($key === 'home_logo'){
                    $filename = 'home_logo.'.$extension;
                } elseif($key === 'footer_logo'){
                    $filename = 'footer_logo.'.$extension;
                } elseif($key === 'home_background'){
                    $filename = 'home_background.'.$extension;
                } else {
                    $filename = $key.'_'.time().'.'.$extension;
                }

                // Hapus file lama
                if(!empty($konten[$key]) && Storage::exists($konten[$key])){
                    Storage::delete($konten[$key]);
                }

                // Simpan file
                $path = $file->storeAs($folder,$filename);
                $value = str_replace('public/','',$path);

            } else {
                $value = $request->input($key) ?? ($konten[$key] ?? null);
            }

            Frontend::updateOrCreate(['key'=>$key],['value'=>$value]);
        }

            return redirect()->back()->with('success', 'Konten berhasil diperbarui');
    }

}
