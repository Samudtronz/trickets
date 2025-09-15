@extends('layouts.app')

@section('content')

<!--==============================
Daftar Event Gabungan  
==============================-->
<section class="bg-black text-white py-16 px-6 lg:px-20">
    <h2 class="text-3xl font-extrabold text-white mb-10 flex items-center">
        <span class="text-[#F26417] mr-3 text-4xl">▮</span> Daftar Event Gabungan
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <!-- Konferensi 1 -->
        <div class="bg-gray-900 p-6 rounded-xl space-y-3">
            <img src="{{ asset('assets/images/events/konferensi1.jpg') }}" 
                 alt="Tech Conference 2025" 
                 class="w-full h-40 object-cover rounded-lg mb-4">
            <h4 class="text-xl font-bold">Tech Conference 2025</h4>
            <p class="text-gray-400">📅 20 Oktober 2025</p>
            <p class="text-gray-400">📍 Jakarta Convention Center</p>
            <p class="text-gray-400">👥 Kuota: 300</p>
            <p class="text-gray-400">🎤 Pembicara: Andi Pratama</p>
            <a href="{{ route('tiket.show') }}" 
               class="mt-4 inline-block bg-[#F26417] hover:bg-orange-600 px-4 py-2 rounded-lg font-bold">
               Beli Tiket
            </a>
        </div>

        <!-- Konferensi 2 -->
        <div class="bg-gray-900 p-6 rounded-xl space-y-3">
            <img src="{{ asset('assets/images/events/konferensi2.jpg') }}" 
                 alt="Startup Summit" 
                 class="w-full h-40 object-cover rounded-lg mb-4">
            <h4 class="text-xl font-bold">Startup Summit</h4>
            <p class="text-gray-400">📅 15 November 2025</p>
            <p class="text-gray-400">📍 Bandung Convention Hall</p>
            <p class="text-gray-400">👥 Kuota: 150</p>
            <p class="text-gray-400">🎤 Pembicara: Budi Santoso</p>
            <a href="{{ route('tiket.show') }}" 
               class="mt-4 inline-block bg-[#F26417] hover:bg-orange-600 px-4 py-2 rounded-lg font-bold">
               Beli Tiket
            </a>
        </div>

        <!-- Musik 1 -->
        <div class="bg-gray-900 p-6 rounded-xl space-y-3">
            <img src="{{ asset('assets/images/events/musik1.jpg') }}" 
                 alt="Jazz Malam" 
                 class="w-full h-40 object-cover rounded-lg mb-4">
            <h4 class="text-xl font-bold">Jazz Malam</h4>
            <p class="text-gray-400">📅 22 Desember 2025</p>
            <p class="text-gray-400">📍 Taman Budaya, Yogyakarta</p>
            <p class="text-gray-400">👥 Kuota: 500</p>
            <p class="text-gray-400">🎵 Genre: Jazz</p>
            <a href="{{ route('tiket.show') }}" 
               class="mt-4 inline-block bg-[#F26417] hover:bg-orange-600 px-4 py-2 rounded-lg font-bold">
               Beli Tiket
            </a>
        </div>

        <!-- Musik 2 -->
        <div class="bg-gray-900 p-6 rounded-xl space-y-3">
            <img src="{{ asset('assets/images/events/musik2.jpg') }}" 
                 alt="Rock Nation" 
                 class="w-full h-40 object-cover rounded-lg mb-4">
            <h4 class="text-xl font-bold">Rock Nation</h4>
            <p class="text-gray-400">📅 10 Januari 2026</p>
            <p class="text-gray-400">📍 Stadion Utama GBK</p>
            <p class="text-gray-400">👥 Kuota: 1000</p>
            <p class="text-gray-400">🎵 Genre: Rock</p>
            <a href="{{ route('tiket.show') }}" 
               class="mt-4 inline-block bg-[#F26417] hover:bg-orange-600 px-4 py-2 rounded-lg font-bold">
               Beli Tiket
            </a>
        </div>

    </div>
</section>

@endsection