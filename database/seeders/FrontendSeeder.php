<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Frontend;

class FrontendSeeder extends Seeder
{
    public function run()
    {
        $defaults = [
            'home_title' => 'Trickets',
            'home_tagline' => 'UNFORGET, WITH US.',
            'home_description' => 'Temukan dan pesan tiket event favoritmu dengan mudah, mulai dari konser, festival, hingga konferensi. Dengan platform yang cepat, aman, dan praktis, kamu bisa memastikan tempatmu hanya dengan beberapa klik.',
            'home_background' => 'assets/images/backgrounds/bg-welcome.png',
            'home_logo' => 'assets/images/logo/logo-only.png',
        ];

        foreach ($defaults as $key => $value) {
            Frontend::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
