@extends('layouts.app')

@section('content')

<!--==============================
Tiket List Area  
==============================-->
<section class="bg-black text-white py-16 px-6 lg:px-20">
    <div class="text-center mb-12">
        <h2 class="text-4xl font-bold text-white">Pilih Tiket Kamu</h2>
    </div>

    {{-- REGULAR --}}
    <h3 class="text-2xl font-bold text-white mb-6"> Regular Ticket</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        {{-- Konferensi --}}
        <div class="bg-gray-900 rounded-2xl p-8">
            <h3 class="text-2xl font-bold">Konferensi Startup</h3>
            <p class="text-3xl font-extrabold text-[#F26417] mt-4">Rp 500.000</p>
            <ul class="mt-6 space-y-2 text-gray-300 text-sm">
                <li><b>Judul:</b> Inovasi Digital Startup</li>
                <li><b>Tanggal:</b> 22 Februari 2025</li>
                <li><b>Kuota:</b> 200 peserta</li>
                <li><b>Pembicara:</b> Faiz Yapping</li>
            </ul>
            <a href="{{ route('tiket.show') }}" class="mt-8 block text-center bg-[#F26417] py-3 rounded-xl font-bold text-white hover:bg-orange-600 transition">Beli Tiket</a>
        </div>

        {{-- Musik --}}
        <div class="bg-gray-900 rounded-2xl p-8">
            <h3 class="text-2xl font-bold">Musik Jazz Malam</h3>
            <p class="text-3xl font-extrabold text-[#F26417] mt-4">Rp 400.000</p>
            <ul class="mt-6 space-y-2 text-gray-300 text-sm">
                <li><b>Judul:</b> Jazz Under The Stars</li>
                <li><b>Tanggal:</b> 10 Maret 2025</li>
                <li><b>Kuota:</b> 500 penonton</li>
                <li><b>Genre:</b> Jazz</li>
            </ul>
            <a href="{{ route('tiket.show') }}" class="mt-8 block text-center bg-[#F26417] py-3 rounded-xl font-bold text-white hover:bg-orange-600 transition">Beli Tiket</a>
        </div>
    </div>

    {{-- BUSSINESS --}}
    <h3 class="text-2xl font-bold text-white mb-6"> Bussiness Ticket</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            {{-- Konferensi --}}
            <div class="bg-gray-900 rounded-2xl p-8">
                <h3 class="text-2xl font-bold">Konferensi Startup</h3>
                <p class="text-3xl font-extrabold text-[#F26417] mt-4">Rp 500.000</p>
                <ul class="mt-6 space-y-2 text-gray-300 text-sm">
                    <li><b>Judul:</b> Inovasi Digital Startup</li>
                    <li><b>Tanggal:</b> 22 Februari 2025</li>
                    <li><b>Kuota:</b> 200 peserta</li>
                    <li><b>Pembicara:</b> Faiz Yapping</li>
                </ul>
                <a href="{{ route('tiket.show') }}" class="mt-8 block text-center bg-[#F26417] py-3 rounded-xl font-bold text-white hover:bg-orange-600 transition">Beli Tiket</a>
            </div>

            {{-- Musik --}}
            <div class="bg-gray-900 rounded-2xl p-8">
                <h3 class="text-2xl font-bold">Musik Jazz Malam</h3>
                <p class="text-3xl font-extrabold text-[#F26417] mt-4">Rp 400.000</p>
                <ul class="mt-6 space-y-2 text-gray-300 text-sm">
                    <li><b>Judul:</b> Jazz Under The Stars</li>
                    <li><b>Tanggal:</b> 10 Maret 2025</li>
                    <li><b>Kuota:</b> 500 penonton</li>
                    <li><b>Genre:</b> Jazz</li>
                </ul>
                <a href="{{ route('tiket.show') }}" class="mt-8 block text-center bg-[#F26417] py-3 rounded-xl font-bold text-white hover:bg-orange-600 transition">Beli Tiket</a>
            </div>
    </div>

    {{-- VIP --}}
    <h3 class="text-2xl font-bold text-white mb-6">VIP Ticket</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        {{-- Konferensi --}}
        <div class="bg-gray-900 rounded-2xl p-8">
            <h3 class="text-2xl font-bold">Konferensi Startup</h3>
            <p class="text-3xl font-extrabold text-[#F26417] mt-4">Rp 500.000</p>
            <ul class="mt-6 space-y-2 text-gray-300 text-sm">
                <li><b>Judul:</b> Inovasi Digital Startup</li>
                <li><b>Tanggal:</b> 22 Februari 2025</li>
                <li><b>Kuota:</b> 200 peserta</li>
                <li><b>Pembicara:</b> Faiz Yapping</li>
            </ul>
            <a href="{{ route('tiket.show') }}" class="mt-8 block text-center bg-[#F26417] py-3 rounded-xl font-bold text-white hover:bg-orange-600 transition">Beli Tiket</a>
        </div>

        {{-- Musik --}}
        <div class="bg-gray-900 rounded-2xl p-8">
            <h3 class="text-2xl font-bold">Musik Jazz Malam</h3>
            <p class="text-3xl font-extrabold text-[#F26417] mt-4">Rp 400.000</p>
            <ul class="mt-6 space-y-2 text-gray-300 text-sm">
                <li><b>Judul:</b> Jazz Under The Stars</li>
                <li><b>Tanggal:</b> 10 Maret 2025</li>
                <li><b>Kuota:</b> 500 penonton</li>
                <li><b>Genre:</b> Jazz</li>
            </ul>
            <a href="{{ route('tiket.show') }}" class="mt-8 block text-center bg-[#F26417] py-3 rounded-xl font-bold text-white hover:bg-orange-600 transition">Beli Tiket</a>
        </div>
    </div>

</section>

@endsection
