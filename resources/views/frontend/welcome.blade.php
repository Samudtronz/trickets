@extends('layouts.app')

@section('content')
    <section class="relative h-screen flex items-center justify-start bg-cover bg-center" 
        style="background-image: url('{{ $konten['home_background_url'] }}');">
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-2xl">
                <div class="flex items-center space-x-4 mb-8">
                    <img src="{{ $konten['home_logo_url'] }}" 
                         alt="Trickets Logo" class="w-50 h-40">
                    <h1 class="text-6xl lg:text-7xl font-black text-[#F26417]">
                        {{ $konten['home_title'] ?? 'Trickets' }}
                    </h1>
                </div>

                <p class="uppercase tracking-widest text-[#F26417] font-bold mb-6 text-2xl lg:text-3xl">
                    {{ $konten['home_tagline'] ?? 'UNFORGET, WITH US.' }}
                </p>

                <p class="text-xl lg:text-2xl text-white leading-relaxed mb-10">
                    {{ $konten['home_description'] ?? 'Temukan dan pesan tiket event favoritmu...' }}
                </p>

                <a href="{{ rand(0,1) ? route('frontend.home.konferensi') : route('frontend.home.musik') }}" 
                   class="btn-custom text-lg lg:text-xl px-10 py-4">
                    AYO MULAI
                </a>
            </div>
        </div>
    </section>
@endsection
