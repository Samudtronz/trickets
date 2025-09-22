<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Frontend;

class FrontendSeeder extends Seeder
{
    public function run()
    {
        $defaults = [
            // 'home_title' => 'Trickets',
            // 'home_tagline' => 'UNFORGET, WITH US.',
            // 'home_description' => 'Temukan dan pesan tiket event favoritmu dengan mudah, mulai dari konser, festival, hingga konferensi. Dengan platform yang cepat, aman, dan praktis, kamu bisa memastikan tempatmu hanya dengan beberapa klik.',
            // 'home_background' => '',
            // 'home_logo' => '',
            //    // Konferensi Trending
            // 'conference_event_trending_text'         => 'EVENT TRENDING:', 
            // 'trending_conference_title'               => 'CONFERENCE EVENT',
            // 'trending_conference_countdown_hari'     => 'HARI',
            // 'trending_conference_countdown_jam'      => 'JAM',
            // 'trending_conference_countdown_menit'    => 'MENIT',
            // 'trending_conference_countdown_detik'    => 'DETIK',
            // 'conference_event_list'                   => 'Daftar event konferensi',

            // // Musik Trending
            // 'musical_event_trending_text'         => 'EVENT TRENDING:', 
            // 'trending_musical_title'                  => 'MUSICAL EVENT',
            // 'trending_musical_countdown_hari'        => 'HARI',
            // 'trending_musical_countdown_jam'         => 'JAM',
            // 'trending_musical_countdown_menit'       => 'MENIT',
            // 'trending_musical_countdown_detik'       => 'DETIK',
            // 'musical_event_list'                      => 'Daftar event musikal',

            //  // Sidebar show
            // 'conference_sidebar_kuota_tanggal_title' => 'Kuota & Tanggal',
            // 'conference_sidebar_sisa_kuota_label' => 'Sisa Kuota',
            // 'conference_sidebar_peserta_label' => 'peserta',
            // 'conference_sidebar_tanggal_event_label' => 'Tanggal Event',
            // 'conference_countdown_title' => 'Hitung Mundur',
            // 'conference_countdown_label_hari' => 'HARI',
            // 'conference_countdown_label_jam' => 'JAM',
            // 'conference_countdown_label_menit' => 'MEN',
            // 'conference_countdown_label_detik' => 'DET',

            // // Musical Sidebar & Countdown (untuk show)
            // 'musical_sidebar_kuota_tanggal_title'   => 'Kuota & Tanggal',
            // 'musical_sidebar_sisa_kuota_label'      => 'Sisa Kuota',
            // 'musical_sidebar_peserta_label'         => 'peserta',
            // 'musical_sidebar_tanggal_event_label'   => 'Tanggal Event',
            // 'musical_countdown_title'               => 'Hitung Mundur',
            // 'musical_countdown_label_hari'          => 'HARI',
            // 'musical_countdown_label_jam'           => 'JAM',
            // 'musical_countdown_label_menit'         => 'MEN',
            // 'musical_countdown_label_detik'         => 'DET',

            // //navbar
            // 'navbar_brand'         => 'Trickets',
            // 'navbar_logo'         => '',

            // Footer
            // 'footer_logo' => 'assets/images/logo/logo-only.png',
            // 'footer_brand' => 'Trickets',
            // 'footer_description' => 'Platform sederhana untuk mengelola event dan tiket. Pesan tiket mudah, cepat, dan aman.',
            // 'footer_copyright' => 'All rights reserved.'\

            // Tiket
            // 'ticket_section_title'   => 'Pilih Tiket Kamu',
            // 'ticket_section_subtitle'   => 'Temukan tiket terbaik & jadilah bagian dari event impianmu dengan pengalaman tak terlupakan.',
            // 'ticket_musikal_title'   => 'Musikal Spektakuler',
            // 'ticket_konferensi_title'   => 'Konferensi Inspiratif'

            // Event List
            // 'events_musikal_title'  => 'Event Musikal',
            // 'events_konferensi_title' => 'Event Konferensi',
        ];

            foreach ($defaults as $key => $value) {
            Frontend::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

    }
}