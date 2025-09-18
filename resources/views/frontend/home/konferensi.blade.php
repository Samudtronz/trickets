@extends('layouts.app')

@section('content')

{{-- HERO SECTION --}}
@if($trending && is_array($trending))
<section class="relative h-[90vh] flex items-center justify-start bg-cover bg-center"
    style="background-image: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), url('http://192.168.100.65/projek-services/konferensi-service/storage/{{ $trending['foto_event'] ?? 'assets/images/backgrounds/no-images.png' }}');">
    <div class="container mx-auto px-6 relative z-10 animate-fade-in-up">
        <div class="max-w-2xl space-y-6">
            <h3 class="text-white text-lg font-semibold">EVENT TRENDING :</h3>
            <h1 class="text-6xl lg:text-7xl font-black text-white">{{ $trending['judul'] ?? '-' }}</h1>
            <p class="text-3xl font-extrabold text-primary-500">CONFERENCE EVENT</p>

            <div class="flex items-center space-x-3 text-white text-lg">
                <i class="fa-solid fa-calendar-days text-primary-500"></i>
                <span>
                    {{ isset($trending['tanggal']) ? \Carbon\Carbon::parse($trending['tanggal'])->format('d F, Y') : '-' }}
                    / {{ $trending['lokasi'] ?? '-' }}
                </span>
            </div>

            <div class="flex space-x-4 pt-6">
                @if(isset($trending['id']))
                    <a href="{{ route('frontend.tiket.showByEvent', $trending['id']) }}" class="btn-custom">
                        BELI TIKET
                    </a>
                    <a href="{{ route('frontend.detail.konferensi', $trending['id']) }}"
                       class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-full font-bold hover:bg-white hover:text-black transition">
                        DETAIL EVENT
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
@else
<section class="relative h-[90vh] flex items-center justify-center bg-black text-white">
    <h1 class="text-4xl font-bold">Belum ada event trending tersedia</h1>
</section>
@endif

{{-- COUNTDOWN --}}
@if($trending && isset($trending['tanggal']))
<section class="bg-black py-8">
    <div id="countdown" class="flex justify-center gap-6"></div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const eventDateStr = "{{ \Carbon\Carbon::parse($trending['tanggal'])->format('Y-m-d') ?? '' }}";
    if (!eventDateStr) return;

    const eventDate = new Date(eventDateStr + "T00:00:00").getTime();
    const countdown = document.getElementById("countdown");

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = eventDate - now;

        if (distance < 0) {
            countdown.innerHTML = `<div class="text-white text-2xl font-bold">Event sudah dimulai 🎉</div>`;
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        countdown.innerHTML = `
            <div class="bg-gray-800 text-center rounded-full w-28 h-28 flex flex-col items-center justify-center">
                <span class="text-3xl font-extrabold text-primary-500">${days}</span>
                <span class="text-white text-sm font-semibold">HARI</span>
            </div>
            <div class="bg-gray-800 text-center rounded-full w-28 h-28 flex flex-col items-center justify-center">
                <span class="text-3xl font-extrabold text-primary-500">${hours}</span>
                <span class="text-white text-sm font-semibold">JAM</span>
            </div>
            <div class="bg-gray-800 text-center rounded-full w-28 h-28 flex flex-col items-center justify-center">
                <span class="text-3xl font-extrabold text-primary-500">${minutes}</span>
                <span class="text-white text-sm font-semibold">MENIT</span>
            </div>
            <div class="bg-gray-800 text-center rounded-full w-28 h-28 flex flex-col items-center justify-center">
                <span class="text-3xl font-extrabold text-primary-500">${seconds}</span>
                <span class="text-white text-sm font-semibold">DETIK</span>
            </div>
        `;
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
});
</script>
@endif

{{-- DAFTAR EVENT --}}
<section class="bg-black py-16 px-6 lg:px-20">
    <h2 class="text-3xl font-extrabold text-white mb-10">Daftar Event Konferensi</h2>

    <div id="event-list">
        @include('partials.event-list', ['events' => $events])
    </div>
</section>

{{-- AJAX pagination --}}
<script>
document.addEventListener("click", function(e) {
    if (e.target.closest(".pagination a")) {
        e.preventDefault();
        let url = e.target.closest(".pagination a").getAttribute("href");

        fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } })
            .then(res => res.text())
            .then(html => {
                document.querySelector("#event-list").innerHTML = html;
                window.history.pushState({}, "", url);
            })
            .catch(err => console.error("Pagination error:", err));
    }
});
</script>

@endsection
