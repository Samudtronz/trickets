@extends('layouts.app')

@section('content')

<section class="bg-black text-white py-16 px-6 lg:px-20 space-y-20">

    {{-- ========== HASIL PENCARIAN ========== --}}
    @if(isset($searchQuery))
        <div>
            <h2 class="text-3xl font-extrabold text-white mb-8">
                🔍 Hasil Pencarian: 
                <span class="text-[#F26417]">{{ $searchQuery }}</span>
            </h2>

            @if($popularEvents->isEmpty())
                <p class="text-gray-400">Tidak ada event yang cocok.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($popularEvents as $event)
                        <div class="bg-gray-900 p-6 rounded-xl shadow-md hover:shadow-lg transition">
                            {{-- Foto --}}
                            <img src="{{ $event['foto'] ?? asset('assets/images/no-image.png') }}"
                                alt="{{ $event['judul'] ?? 'Event' }}"
                                class="w-full h-40 object-cover rounded-lg mb-4">

                            {{-- Info --}}
                            <h4 class="text-xl font-bold">{{ $event['judul'] ?? '-' }}</h4>
                            <p class="text-gray-400">
                                📅 {{ !empty($event['tanggal']) ? \Carbon\Carbon::parse($event['tanggal'])->format('d F Y') : '-' }}
                            </p>
                            <p class="text-gray-400">📍 {{ $event['lokasi'] ?? '-' }}</p>
                            
                            @if($event['tipe'] == 'konferensi')
                                <p class="text-gray-400">🎤 Pembicara: {{ $event['pembicara'] ?? '-' }}</p>
                            @else
                                <p class="text-gray-400">🎵 Genre: {{ $event['genre'] ?? '-' }}</p>
                            @endif

                            {{-- Tombol --}}
                            <a href="{{ $event['tipe'] == 'musikal' 
                                    ? route('frontend.detail.musik', $event['id']) 
                                    : route('frontend.detail.konferensi', $event['id']) }}"
                                class="mt-4 inline-block bg-[#F26417] hover:bg-orange-600 px-4 py-2 rounded-lg font-bold">
                                Lihat Detail
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @else

        {{-- ========== PALING POPULER (HERO SLIDER) ========== --}}
        @if(!empty($popularEvents) && count($popularEvents) > 0)
        <div>
            <h2 class="text-3xl font-extrabold text-white mb-8 flex items-center">
                <span class="text-[#F26417] mr-3 text-4xl">🔥</span> Paling Populer
            </h2>

            <div class="swiper heroSwiper rounded-2xl overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach($popularEvents as $event)
                    <div class="swiper-slide relative">
                        {{-- Background image --}}
                        <img src="{{ $event['foto'] ?? asset('assets/images/no-image.png') }}"
                             alt="{{ $event['judul'] ?? 'Event' }}"
                             class="w-full h-[450px] object-cover">

                        {{-- Overlay Info --}}
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-6">
                            <h3 class="text-2xl font-bold">{{ $event['judul'] ?? '-' }}</h3>
                            <p class="text-gray-300">
                                📅 {{ !empty($event['tanggal']) ? \Carbon\Carbon::parse($event['tanggal'])->format('d F Y') : '-' }} <br>
                                📍 {{ $event['lokasi'] ?? '-' }}
                            </p>

                            @if(!empty($event['pembicara']))
                                <p class="text-gray-300">🎤 Pembicara: {{ $event['pembicara'] }}</p>
                            @elseif(!empty($event['genre']))
                                <p class="text-gray-300">🎵 Genre: {{ $event['genre'] }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Controls --}}
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        @endif

        {{-- ========== KONFERENSI ========== --}}
        <div>
            <h2 class="text-3xl font-extrabold text-white mb-10 flex items-center">
                <span class="text-[#F26417] mr-3 text-4xl">▮</span> Event Konferensi
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($konferensi as $event)
                    <div class="bg-gray-900 p-6 rounded-xl shadow-md hover:shadow-lg transition">
                        <img src="{{ $event['foto'] ?? asset('assets/images/no-image.png') }}"
                             alt="{{ $event['judul'] ?? 'Event' }}"
                             class="w-full h-40 object-cover rounded-lg mb-4">

                        <h4 class="text-xl font-bold">{{ $event['judul'] ?? '-' }}</h4>
                        <p class="text-gray-400">
                            📅 {{ !empty($event['tanggal']) ? \Carbon\Carbon::parse($event['tanggal'])->format('d F Y') : '-' }}
                        </p>
                        <p class="text-gray-400">📍 {{ $event['lokasi'] ?? '-' }}</p>
                        <p class="text-gray-400">👥 Kuota: {{ $event['kuota'] ?? 0 }}</p>
                        <p class="text-gray-400">🎤 Pembicara: {{ $event['pembicara'] ?? '-' }}</p>

                        <a href="{{ route('frontend.detail.konferensi', $event['id']) }}"
                           class="mt-4 inline-block bg-[#F26417] hover:bg-orange-600 px-4 py-2 rounded-lg font-bold">
                            Beli Tiket
                        </a>
                    </div>
                @empty
                    <p class="text-gray-400">Tidak ada konferensi tersedia.</p>
                @endforelse
            </div>
        </div>

        {{-- ========== MUSIKAL ========== --}}
        <div>
            <h2 class="text-3xl font-extrabold text-white mb-10 flex items-center">
                <span class="text-[#F26417] mr-3 text-4xl">▮</span> Event Musikal
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($musikal as $event)
                    <div class="bg-gray-900 p-6 rounded-xl shadow-md hover:shadow-lg transition">
                        <img src="{{ $event['foto'] ?? asset('assets/images/no-image.png') }}"
                             alt="{{ $event['judul'] ?? 'Event' }}"
                             class="w-full h-40 object-cover rounded-lg mb-4">

                        <h4 class="text-xl font-bold">{{ $event['judul'] ?? '-' }}</h4>
                        <p class="text-gray-400">
                            📅 {{ !empty($event['tanggal']) ? \Carbon\Carbon::parse($event['tanggal'])->format('d F Y') : '-' }}
                        </p>
                        <p class="text-gray-400">📍 {{ $event['lokasi'] ?? '-' }}</p>
                        <p class="text-gray-400">👥 Kuota: {{ $event['kuota'] ?? 0 }}</p>
                        <p class="text-gray-400">🎵 Genre: {{ $event['genre'] ?? '-' }}</p>

                        <a href="{{ route('frontend.detail.musik', $event['id']) }}"
                           class="mt-4 inline-block bg-[#F26417] hover:bg-orange-600 px-4 py-2 rounded-lg font-bold">
                            Beli Tiket
                        </a>
                    </div>
                @empty
                    <p class="text-gray-400">Tidak ada musikal tersedia.</p>
                @endforelse
            </div>
        </div>
    @endif

</section>

{{-- SwiperJS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
new Swiper(".heroSwiper", {
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    effect: "fade",
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});
</script>

@endsection
