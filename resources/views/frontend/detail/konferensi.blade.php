@extends('layouts.app')

@section('content')

{{-- HERO --}}
@php
    $fotoEvent = $event['foto_event'] ?? null;
    $bgImage = $fotoEvent
        ? "http://192.168.100.65/projek-services/konferensi-service/storage/{$fotoEvent}"
        : asset('assets/images/no-image.png'); 
@endphp

<section class="relative h-[70vh] bg-cover bg-center flex items-end"
    style="background-image: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), url('{{ $bgImage }}');">
    <div class="container mx-auto px-6 pb-10 z-10">
        <h1 class="text-5xl lg:text-6xl font-extrabold text-white">
            {{ $event['judul'] ?? 'JUDUL KONFERENSI' }}
        </h1>
    </div>
</section>

{{-- DETAIL CONTENT --}}
<section class="bg-black text-white py-16 px-6 lg:px-20">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">

        {{-- MAIN CONTENT --}}
        <div class="lg:col-span-3 space-y-8">

            {{-- Event Info --}}
            <div class="flex flex-wrap items-center gap-4 text-lg font-semibold mt-4">
                <span class="bg-gray-800 text-white px-3 py-2 rounded-lg">
                    @if (!empty($event['tanggal']))
                        {{ \Carbon\Carbon::parse($event['tanggal'])->translatedFormat('d F Y') }}
                    @else
                        Tanggal belum ditentukan
                    @endif
                </span>

                <span class="bg-gray-800 text-white px-3 py-2 rounded-lg">
                    {{ $event['waktu_perform'] ?? $event['waktu'] ?? 'Waktu belum ditentukan' }}
                </span>

                <span class="bg-gray-800 text-white px-3 py-2 rounded-lg">
                    {{ $event['lokasi'] ?? 'Lokasi belum ditentukan' }}
                </span>

                <span class="bg-gray-800 text-white px-3 py-2 rounded-lg">
                    {{ $event['pembicara'] ?? 'Pembicara belum ditentukan' }}
                </span>
            </div>

            {{-- Deskripsi --}}
            <div>
                <h2 class="text-4xl font-bold mb-4">
                    {{ $event['judul'] ?? 'Judul Konferensi' }}
                </h2>
                <p class="text-gray-300 leading-relaxed whitespace-pre-line">
                    {!! nl2br(e($event['deskripsi'] ?? 'Deskripsi belum tersedia')) !!}
                </p>
            </div>

            {{-- Video --}}
            @php
                $videoUrl = $event['link_video'] ?? $event['video'] ?? null;
                $youtubeId = null;

                if ($videoUrl) {
                    if (preg_match('/youtu\.be\/([^?&]+)/', $videoUrl, $m)) {
                        $youtubeId = $m[1];
                    } elseif (preg_match('/v=([^?&]+)/', $videoUrl, $m)) {
                        $youtubeId = $m[1];
                    } elseif (preg_match('/embed\/([^?&]+)/', $videoUrl, $m)) {
                        $youtubeId = $m[1];
                    }
                }
            @endphp

            @if ($youtubeId)
                <div class="mt-8">
                    <iframe class="w-full h-[400px] rounded-xl"
                        src="https://www.youtube.com/embed/{{ $youtubeId }}"
                        frameborder="0" allowfullscreen></iframe>
                </div>
            @endif

        </div>

        {{-- SIDEBAR --}}
        <div class="bg-gray-900 p-6 rounded-xl space-y-6">
            <div class="text-center">
                <h3 class="text-xl font-bold">
                    {{ $konten['conference_sidebar_kuota_tanggal_title'] ?? 'Kuota & Tanggal' }}
                </h3>

                <div class="mt-4">
                    <p class="text-gray-400 mb-1">
                        {{ $konten['conference_sidebar_sisa_kuota_label'] ?? 'Sisa Kuota' }}
                    </p>
                    <p class="text-4xl font-extrabold text-[#F26417]">
                        {{ $event['kuota'] ?? 'Tidak diketahui' }}
                    </p>
                    <span class="text-sm text-gray-500">
                        {{ $konten['conference_sidebar_peserta_label'] ?? 'peserta' }}
                    </span>
                </div>

                <div class="mt-6">
                    <p class="text-gray-400 mb-1">
                        {{ $konten['conference_sidebar_tanggal_event_label'] ?? 'Tanggal Event' }}
                    </p>
                    <p class="text-lg font-semibold text-white">
                        @if (!empty($event['tanggal']))
                            {{ \Carbon\Carbon::parse($event['tanggal'])->translatedFormat('d F Y') }}
                        @else
                            Belum ditentukan
                        @endif
                    </p>
                </div>
            </div>

            {{-- Countdown --}}
            <div class="text-center bg-gray-800 p-4 rounded-lg">
                <h4 class="font-semibold mb-2">
                    {{ $konten['conference_countdown_title'] ?? 'Hitung Mundur' }}
                </h4>
                <div id="countdown" class="text-lg font-bold">
                    @if (!empty($event['tanggal']))
                        <!-- Countdown render by JS -->
                    @else
                        Tanggal belum ditentukan
                    @endif
                </div>
            </div>

            <a href="{{ route('frontend.tiket.show', $event['id'] ?? 0) }}"
                class="block w-full bg-[#F26417] hover:bg-orange-600 text-center py-3 rounded-lg font-bold text-white transition">
                BELI TIKET
            </a>
        </div>
    </div>
</section>

{{-- COUNTDOWN SCRIPT --}}
@if (!empty($event['tanggal']))
<script>
document.addEventListener("DOMContentLoaded", function() {
    const dateStr = "{{ \Carbon\Carbon::parse($event['tanggal'])->format('Y-m-d') }}";
    if (!dateStr) return;

    const eventDate = new Date(dateStr + "T00:00:00").getTime();
    const countdownEl = document.getElementById("countdown");

    const labelHari   = "{{ $konten['conference_countdown_label_hari'] ?? 'HARI' }}";
    const labelJam    = "{{ $konten['conference_countdown_label_jam'] ?? 'JAM' }}";
    const labelMenit  = "{{ $konten['conference_countdown_label_menit'] ?? 'MEN' }}";
    const labelDetik  = "{{ $konten['conference_countdown_label_detik'] ?? 'DET' }}";

    if (!isNaN(eventDate)) {
        const x = setInterval(function() {
            const now = new Date().getTime();
            const distance = eventDate - now;

            if (distance < -86400000) {
                clearInterval(x);
                countdownEl.innerHTML = "Event sudah berakhir!";
                return;
            }

            if (distance <= 0) {
                clearInterval(x);
                countdownEl.innerHTML = "Event sedang berlangsung!";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownEl.innerHTML =
                `${days} ${labelHari} ${hours} ${labelJam} ${minutes} ${labelMenit} ${seconds} ${labelDetik}`;
        }, 1000);
    } else {
        countdownEl.innerHTML = "-";
    }
});
</script>
@endif

@endsection
