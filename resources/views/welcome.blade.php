@extends('layouts.app')

@section('content')
    <section class="relative h-screen flex items-center justify-start bg-cover bg-center" 
        style="background-image: url('{{ asset('assets/images/backgrounds/bg-welcome.png') }}');">
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-2xl">
                <div class="flex items-center space-x-4 mb-8">
                    <img src="{{ asset('assets/images/logo/logo-only.png') }}" alt="Trickets Logo" class="w-50 h-40">
                    <h1 class="text-6xl lg:text-7xl font-black text-[#F26417]">Trickets</h1>
                </div>

                <p class="uppercase tracking-widest text-[#F26417] font-bold mb-6 text-2xl lg:text-3xl">
                    UNFORGET, WITH US.
                </p>

                <p class="text-xl lg:text-2xl text-white leading-relaxed mb-10">
                    "Temukan dan pesan tiket event favoritmu dengan mudah, mulai dari konser, festival, hingga konferensi. Dengan platform yang cepat, aman, dan praktis, kamu bisa memastikan tempatmu hanya dengan beberapa klik."
                </p>

                <a href="{{ rand(0,1) ? route('home.konferensi') : route('home.musik') }}" 
                class="btn-custom text-lg lg:text-xl px-10 py-4">
                AYO MULAI
                </a>

            </div>
        </div>
    </section>
@endsection