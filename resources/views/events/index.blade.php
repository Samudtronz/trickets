@extends('layouts.app')

@section('content')

<section class="bg-black text-white py-16 px-6 lg:px-20">
    <h2 class="text-3xl font-extrabold text-white mb-10 flex items-center">
        <span class="text-[#F26417] mr-3 text-4xl">▮</span> Daftar Event Gabungan
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach($events as $event)
        <div class="bg-gray-900 p-6 rounded-xl space-y-3">
            <img src="{{ $event['foto'] }}" 
                 alt="{{ $event['judul'] }}" 
                 class="w-full h-40 object-cover rounded-lg mb-4">
            <h4 class="text-xl font-bold">{{ $event['judul'] }}</h4>
            <p class="text-gray-400">📅 {{ \Carbon\Carbon::parse($event['tanggal'])->format('d F Y') }}</p>
            <p class="text-gray-400">📍 {{ $event['lokasi'] }}</p>
            <p class="text-gray-400">👥 Kuota: {{ $event['kuota'] }}</p>
            
            @if(isset($event['pembicara']))
                <p class="text-gray-400">🎤 Pembicara: {{ $event['pembicara'] }}</p>
            @elseif(isset($event['genre']))
                <p class="text-gray-400">🎵 Genre: {{ $event['genre'] }}</p>
            @endif

           <a href="{{ route('detail.konferensi', $event['id']) }}" 
                class="mt-4 inline-block bg-[#F26417] hover:bg-orange-600 px-4 py-2 rounded-lg font-bold">
                Beli Tiket
            </a>

        </div>
        @endforeach

    </div>
</section>

@endsection
