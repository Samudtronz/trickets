@extends('layouts.app')

@section('content')

{{-- HERO SECTION --}}
<section class="relative h-[90vh] flex items-center justify-start bg-cover bg-center"
    style="background-image: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), 
        url('{{ $trending['foto_event_url'] ?? asset('assets/images/backgrounds/coachella.png') }}');">

    <div class="container mx-auto px-6 relative z-10 animate-fade-in-up">
        <div class="max-w-2xl space-y-6">
            @if (!empty($trending))
                <h3 class="text-white text-lg font-semibold">EVENT TRENDING :</h3>
                <h1 class="text-6xl lg:text-7xl font-black text-white">{{ $trending['judul'] ?? '-' }}</h1>
                <p class="text-3xl font-extrabold text-primary-500">MUSICAL EVENT</p>

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
                    <a href="{{ route('frontend.tiket.showByEvent', $trending['id'] ?? 0) }}" 
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
    <div class="flex justify-center gap-6" id="countdown">
        @foreach (['HARI','JAM','MENIT','DETIK'] as $label)
            <div class="bg-gray-800 text-center rounded-full w-28 h-28 flex flex-col items-center justify-center">
                <span class="time text-3xl font-extrabold text-primary-500">00</span>
                <span class="text-white text-sm font-semibold">{{ $label }}</span>
            </div>
        @endforeach
    </div>
</section>

{{-- DAFTAR EVENT --}}
<section class="bg-black py-16 px-6 lg:px-20">
    <h2 class="text-3xl font-extrabold text-white mb-10 flex items-center">
        <span class="text-primary-500 mr-3 text-4xl">▮</span> Daftar Event Musikal
    </h2>

    <div class="space-y-6">
        @forelse ($events as $event)
            <div class="bg-gray-900 rounded-xl p-6 flex items-center justify-between">
                {{-- Thumbnail --}}
                <div class="flex items-center space-x-6">
                    <div class="bg-gray-700 w-32 h-24 rounded-lg overflow-hidden">
                        <img src="{{ $event['foto_event_url'] ?? asset('assets/images/no-image.png') }}" 
                             alt="{{ $event['judul'] ?? 'Event' }}" 
                             class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">{{ $event['judul'] ?? '-' }}</h3>
                        <p class="text-sm text-gray-400 flex items-center">
                            <i class="fa-solid fa-location-dot text-primary-500 mr-2"></i> {{ $event['lokasi'] ?? '-' }}
                        </p>
                        <p class="text-sm text-gray-400 flex items-center">
                            <i class="fa-solid fa-clock text-primary-500 mr-2"></i> 
                            {{ $event['waktu_perform'] ?? '-' }}, 
                            {{ !empty($event['tanggal']) ? \Carbon\Carbon::parse($event['tanggal'])->translatedFormat('d F Y') : '-' }}
                        </p>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex space-x-3">
                    <a href="{{ route('frontend.tiket.showByEvent', $event['id'] ?? 0) }}" 
                       class="bg-primary-500 text-white px-5 py-2 rounded-lg font-bold hover:bg-primary-600 transition">
                       Beli Tiket
                    </a>
                    <a href="{{ route('frontend.detail.musik', $event['id'] ?? 0) }}" 
                       class="bg-blue-600 text-white px-5 py-2 rounded-lg font-bold hover:bg-blue-700 transition">
                       Detail Event
                    </a>
                </div>
            </div>
        @empty
            <p class="text-gray-400">Belum ada event musikal tersedia.</p>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="flex justify-center mt-10">
        {{ $events->links() }}
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Ambil datetime dari kolom `tanggal`
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
