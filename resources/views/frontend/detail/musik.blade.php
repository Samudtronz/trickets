@extends('layouts.app')

@section('content')

{{-- HERO --}}
<section class="relative h-[70vh] bg-cover bg-center flex items-end"
    style="background-image: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), url('{{ $event->banner ?? asset('assets/images/backgrounds/coachella.png') }}');">

    <div class="absolute inset-0"></div>
    <div class="container mx-auto px-6 pb-10 z-10">
        <h1 class="text-5xl lg:text-6xl font-extrabold text-white">{{ $event->title ?? 'Nama Event' }}</h1>
    </div>
</section>

{{-- DETAIL CONTENT --}}
<section class="bg-black text-white py-16 px-6 lg:px-20">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">

        {{-- MAIN CONTENT --}}
        <div class="lg:col-span-3 space-y-8">
            
            {{-- Event Info --}}
           <div class="flex items-center gap-4 text-lg font-semibold mt-4">
            <span class="bg-gray-800 text-white px-4 py-2 rounded-lg flex items-center">
                📅 Tanggal Event
            </span>
            <span class="bg-gray-800 text-white px-4 py-2 rounded-lg flex items-center">
                ⏰ Waktu Event
            </span>
            <span class="bg-gray-800 text-white px-4 py-2 rounded-lg flex items-center">
                📍 Lokasi Event
            </span>
            <span class="bg-gray-800 text-white px-4 py-2 rounded-lg flex items-center">
                🎶 Genre Event
            </span>
            </div>


            {{-- Deskripsi --}}
            <div>
                <h2 class="text-4xl font-bold mb-4">{{ $event->title ?? 'Judul Event' }}</h2>
                <p class="text-gray-300 leading-relaxed">
                    {{ $event->deskripsi ?? 'Deskripsi event akan ditampilkan di sini. Tambahkan informasi detail agar pengunjung tahu lebih banyak.' }}
                </p>
            </div>

            {{-- Video --}}
            @if (!empty($event->video_url))
                <div class="mt-8">
                    <iframe class="w-full h-[400px] rounded-xl"
                        src="https://www.youtube.com/embed/{{ $event->video_url }}"
                        frameborder="0" allowfullscreen>
                    </iframe>
                </div>
            @endif

        </div>

        {{-- SIDEBAR --}}
        <div class="bg-gray-900 p-6 rounded-xl space-y-6">
            <div class="text-center">
                <h3 class="text-xl font-bold">Kuota</h3>
                <p class="text-3xl font-extrabold text-primary-500 mt-2">
                    Rp {{ number_format($event->harga ?? 0, 0, ',', '.') }}
                </p>
                <p class="text-gray-400 mt-1">Sisa Kuota: {{ $event->kuota ?? '-' }}</p>
            </div>

            <a href="#" class="block w-full bg-primary-500 hover:bg-primary-600 text-center py-3 rounded-lg font-bold text-white transition">
                BELI TIKET
            </a>
        </div>
    </div>
</section>

@endsection
