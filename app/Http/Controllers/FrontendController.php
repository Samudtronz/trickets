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
        $keys = [
            'home_title', 'home_tagline', 'home_description', 'home_background', 'home_logo',
            'navbar_logo', 'navbar_brand', // <-- tambahkan ini
            'footer_logo', 'footer_brand', 'footer_description', 'footer_copyright'
        ];

        $konten = Frontend::whereIn('key', $keys)->pluck('value', 'key')->toArray();

        // fallback
        $konten['home_background'] = $konten['home_background'] ?? 'assets/images/backgrounds/bg-welcome.png';
        $konten['home_logo']       = $konten['home_logo'] ?? 'assets/images/logo/logo-only.png';
        $konten['navbar_logo']     = $konten['navbar_logo'] ?? 'assets/images/logo/logo-only.png'; // default
        $konten['navbar_brand']    = $konten['navbar_brand'] ?? 'Trickets'; // default
        $konten['footer_logo']     = $konten['footer_logo'] ?? 'assets/images/logo/logo-only.png';
        $konten['footer_brand']    = $konten['footer_brand'] ?? 'Trickets';
        $konten['footer_description'] = $konten['footer_description'] ?? 'Platform sederhana untuk mengelola event dan tiket. Pesan tiket mudah, cepat, dan aman.';
        $konten['footer_copyright']   = $konten['footer_copyright'] ?? 'All rights reserved.';

        // URL untuk render
        $konten['home_background_url'] = asset('storage/' . $konten['home_background']);
        $konten['home_logo_url']       = asset('storage/' . $konten['home_logo']);
        $konten['navbar_logo_url']     = asset('storage/' . $konten['navbar_logo']);
        $konten['footer_logo_url']     = asset('storage/' . $konten['footer_logo']);

        return view('frontend.welcome', compact('konten'));
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

            // Ticket Section
            'ticket_section_title', 'ticket_section_subtitle',
            'ticket_musikal_title', 'ticket_konferensi_title',

            // Event Section
             'events_musikal_title',
             'events_konferensi_title', 

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
        //dd($request->all());

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

            // Ticket Section
            'ticket_section_title', 'ticket_section_subtitle',
            'ticket_musikal_title', 'ticket_konferensi_title',

            // Event Section
             'events_musikal_title',
             'events_konferensi_title', 

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

       foreach ($keys as $key) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $extension = $file->getClientOriginalExtension();

                // Folder tujuan
                if ($key === 'home_background') {
                    $folder = 'assets/images/backgrounds';
                } elseif (in_array($key, ['home_logo', 'footer_logo', 'navbar_logo'])) {
                    $folder = 'assets/images/logo';
                } else {
                    $folder = 'assets/images/other';
                }

                // Nama file khusus
                if (in_array($key, ['home_logo', 'footer_logo', 'home_background', 'navbar_logo'])) {
                    $filename = $key . '.' . $extension;
                } else {
                    $filename = $key . '_' . time() . '.' . $extension;
                }

                // Hapus file lama (kalau ada)
                if (!empty($konten[$key]) && Storage::exists('public/' . $konten[$key])) {
                    Storage::delete('public/' . $konten[$key]);
                }

                // Simpan file baru
                $path = $file->storeAs('public/' . $folder, $filename);

                // Simpan path RELATIF ke DB (tanpa "public/")
                $value = str_replace('public/', '', $path);
            } else {
                // Pakai input text, kalau kosong → pakai lama
                $value = $request->input($key, $konten[$key] ?? null);
            }

            Frontend::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->back()->with('success', 'Konten berhasil diperbarui');
    }
    

}
