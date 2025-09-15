@extends('layouts.app')

@section('content')

{{-- HERO SECTION --}}
<section class="relative h-[90vh] flex items-center justify-start bg-cover bg-center"
    style="background-image: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), url('{{ asset('assets/images/backgrounds/ted-talk.png') }}');">

    <div class="container mx-auto px-6 relative z-10 animate-fade-in-up">
        <div class="max-w-2xl space-y-6">
            <h3 class="text-white text-lg font-semibold">EVENT TRENDING :</h3>
            <h1 class="text-6xl lg:text-7xl font-black text-white">TED TALK</h1>
            <p class="text-3xl font-extrabold text-primary-500">CONFERENCE EVENT</p>

            {{-- Tanggal & Lokasi --}}
            <div class="flex items-center space-x-3 text-white text-lg">
                <i class="fa-solid fa-calendar-days text-primary-500"></i>
                <span>22 Februari, 2022 / Pekanbaru</span>
            </div>

            {{-- Tombol --}}
            <div class="flex space-x-4 pt-6">
                <a href="#" class="btn-custom">BELI TIKET</a>
                <a href="{{ route('detail.konferensi') }}" 
                class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-full font-bold hover:bg-white hover:text-black transition">
                    DETAIL EVENT
                </a>
            </div>
        </div>
    </div>
</section>

{{-- COUNTDOWN --}}
<section class="bg-black py-8">
    <div class="flex justify-center gap-6">
        @foreach (['HARI','JAM','MENIT','DETIK'] as $label)
            <div class="bg-gray-800 text-center rounded-full w-28 h-28 flex flex-col items-center justify-center">
                <span class="text-3xl font-extrabold text-primary-500">00</span>
                <span class="text-white text-sm font-semibold">{{ $label }}</span>
            </div>
        @endforeach
    </div>
</section>

{{-- DAFTAR EVENT --}}
<section class="bg-black py-16 px-6 lg:px-20">
    <h2 class="text-3xl font-extrabold text-white mb-10 flex items-center">
        <span class="text-primary-500 mr-3 text-4xl">▮</span> Daftar Event Konferensi
    </h2>

    <div class="space-y-6">
        {{-- Event Card --}}
        @foreach ([
            ['title' => 'Faiz Yapping', 'lokasi' => 'Badan Standardisasi Nasional', 'waktu' => '10:00 AM – 10:01 AM, 22 Februari 2022'],
            ['title' => 'Steven Here', 'lokasi' => 'Badan Standardisasi Nasional', 'waktu' => '10:00 AM – 10:01 AM, 22 Februari 2022'],
            ['title' => 'Podcast Roblox Farhat', 'lokasi' => 'Badan Standardisasi Nasional', 'waktu' => '10:00 AM – 10:01 AM, 22 Februari 2022'],
        ] as $event)
            <div class="bg-gray-900 rounded-xl p-6 flex items-center justify-between">
                {{-- Thumbnail --}}
                <div class="flex items-center space-x-6">
                    <div class="bg-gray-700 w-32 h-24 rounded-lg"></div>
                    <div>
                        <h3 class="text-xl font-bold text-white">{{ $event['title'] }}</h3>
                        <p class="text-sm text-gray-400 flex items-center">
                            <i class="fa-solid fa-location-dot text-primary-500 mr-2"></i> {{ $event['lokasi'] }}
                        </p>
                        <p class="text-sm text-gray-400 flex items-center">
                            <i class="fa-solid fa-clock text-primary-500 mr-2"></i> {{ $event['waktu'] }}
                        </p>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex space-x-3">
                    <a href="#" class="bg-primary-500 text-white px-5 py-2 rounded-lg font-bold hover:bg-primary-600 transition">
                        Beli Tiket
                    </a>
                    <a href="#" class="bg-blue-600 text-white px-5 py-2 rounded-lg font-bold hover:bg-blue-700 transition">
                        Detail Event
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="flex justify-center mt-10">
        <ul class="flex space-x-2 text-white">
            <li><a href="#" class="bg-primary-500 px-4 py-2 rounded">1</a></li>
            <li><a href="#" class="bg-gray-800 px-4 py-2 rounded">2</a></li>
            <li><a href="#" class="bg-gray-800 px-4 py-2 rounded">3</a></li>
            <li><span class="px-4 py-2">...</span></li>
        </ul>
    </div>
</section>

@endsection