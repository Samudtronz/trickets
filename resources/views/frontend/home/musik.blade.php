@extends('layouts.app')

@section('content')

{{-- HERO SECTION --}}
<section class="relative h-[90vh] flex items-center justify-start bg-cover bg-center"
    style="background-image: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), 
        url('{{ $trending['foto_event_url'] ?? asset('assets/images/backgrounds/coachella.png') }}');">

    <div class="container mx-auto px-6 relative z-10 animate-fade-in-up">
        <div class="max-w-2xl space-y-6">
            @if (!empty($trending))
                <h3 class="text-white text-lg font-semibold">{{ $konten['musical_event_trending_text'] ?? 'EVENT TRENDING :' }}</h3>
                <h1 class="text-6xl lg:text-7xl font-black text-white">{{ $trending['judul'] ?? '-' }}</h1>
                <p class="text-3xl font-extrabold text-primary-500">{{ $konten['trending_musical_title'] ?? 'MUSICAL EVENT' }}</p>

                {{-- Tanggal & Lokasi --}}
                <div class="flex items-center space-x-3 text-white text-lg">
                    <i class="fa-solid fa-calendar-days text-primary-500"></i>
                    <span>
                        {{ !empty($trending['tanggal']) ? \Carbon\Carbon::parse($trending['tanggal'])->translatedFormat('d F Y') : '-' }} 
                        / {{ $trending['lokasi'] ?? '-' }}
                    </span>
                </div>

                {{-- Tombol --}}
                <div class="flex space-x-4 pt-6">
                    <a href="{{ route('frontend.tiket.showmusikal', $trending['id'] ?? 0) }}" 
                       class="btn-custom">
                       BELI TIKET
                    </a>
                    <a href="{{ route('frontend.detail.musik', $trending['id'] ?? 0) }}" 
                        class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-full font-bold hover:bg-white hover:text-black transition">
                        DETAIL EVENT
                    </a>
                </div>
            @else
                <h1 class="text-4xl lg:text-5xl font-black text-white">Belum ada event trending tersedia</h1>
            @endif
        </div>
    </div>
</section>

{{-- COUNTDOWN --}}
<section class="bg-black py-8">
    @php
        $countdownKeys = [
            'trending_musical_countdown_hari' ?? ' hari',
            'trending_musical_countdown_jam' ?? ' jam ',
            'trending_musical_countdown_menit' ?? 'menit' ,
            'trending_musical_countdown_detik' ??  'detik',
        ];
    @endphp

    <div class="flex justify-center gap-6" id="countdown">
        @foreach ($countdownKeys as $key)
            <div class="bg-gray-800 text-center rounded-full w-28 h-28 flex flex-col items-center justify-center">
                <span class="time text-3xl font-extrabold text-primary-500">00</span>
                <span class="text-white text-sm font-semibold">
                    {{ $konten[$key] ?? strtoupper(str_replace('trending_musical_countdown_', '', $key)) }}
                </span>
            </div>
        @endforeach
    </div>
</section>

{{-- Include daftar event --}}
@include('frontend.event-lists.musik')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let eventDate = new Date("{{ !empty($trending['tanggal']) 
            ? \Carbon\Carbon::parse($trending['tanggal'])->format('Y-m-d H:i:s')
            : '' }}").getTime();

        if (!eventDate) return;

        let countdownEl = document.getElementById("countdown");
        let timeSpans = countdownEl.querySelectorAll(".time");

        setInterval(function () {
            let now = new Date().getTime();
            let distance = eventDate - now;

            if (distance < 0) {
                timeSpans.forEach(el => el.innerText = "00");
                return;
            }

            let days = Math.floor(distance / (1000 * 60 * 60 * 24));
            let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);

            timeSpans[0].innerText = days.toString().padStart(2, '0');
            timeSpans[1].innerText = hours.toString().padStart(2, '0');
            timeSpans[2].innerText = minutes.toString().padStart(2, '0');
            timeSpans[3].innerText = seconds.toString().padStart(2, '0');
        }, 1000);
    });
</script>

@endsection
