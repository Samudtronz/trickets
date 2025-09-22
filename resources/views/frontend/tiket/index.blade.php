@extends('layouts.app')

@section('content')

{{-- Ticket Section --}}
<section class="relative bg-gradient-to-b from-[#0d0d0d] via-black to-[#1a1a1a] text-white pt-40 pb-20 px-6 lg:px-20 space-y-28">

    {{-- Pattern overlay biar nggak polos --}}
    <div class="absolute inset-0 bg-[url('/images/pattern.svg')] opacity-5 pointer-events-none"></div>

    {{-- Section Title --}}
    <div class="relative z-10 text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-wide text-white relative inline-block">
            <span class="px-6 py-2 border-y-2 border-[#F26417]">
                 Pilih Tiket Kamu
            </span>
        </h1>
        <p class="text-gray-400 text-lg max-w-2xl mx-auto mt-6">
            Temukan tiket terbaik & jadilah bagian dari event impianmu dengan pengalaman tak terlupakan.
        </p>
    </div>

    @php
        $events = [
            [
                'customTitle' => 'Musikal Spektakuler',
                'tickets' => $ticketsMusikal ?? [],
                'extraField' => 'genre',
                'extraLabel' => 'Genre'
            ],
            [
                'customTitle' => 'Konferensi Inspiratif',
                'tickets' => $ticketsKonferensi ?? [],
                'extraField' => 'pembicara',
                'extraLabel' => 'Pembicara'
            ]
        ];
        $types = ['regular','business','VIP'];
    @endphp

    @foreach($events as $index => $event)
        <div class="relative z-10 space-y-12">
            {{-- Judul Event Style Kotak Orange --}}
            <div class="flex items-center gap-3">
                <span class="w-6 h-6 bg-[#F26417] rounded-sm shadow-lg"></span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-white tracking-wide">
                    {{ $event['customTitle'] }}
                </h2>
            </div>

            {{-- Ticket Types --}}
            @foreach($types as $type)
                <div>
                    <h3 class="text-2xl font-bold mb-6 text-[#F26417] tracking-wide">
                        {{ ucfirst($type) }} Ticket
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mb-12">
                        @forelse(($event['tickets'][$type] ?? []) as $tiket)

                            @php
                                $isExpired = !empty($tiket['tanggal']) && \Carbon\Carbon::parse($tiket['tanggal'])->isPast();
                            @endphp

                            {{-- Card --}}
                            <div class="relative group bg-gradient-to-br from-white/10 to-white/5 
                                backdrop-blur-xl border border-white/10 rounded-3xl p-8 
                                shadow-lg hover:shadow-[0_0_50px_rgba(242,100,23,0.8)] 
                                hover:-translate-y-3 transition-all duration-500">

                                {{-- Status Badge --}}
                                @if(($tiket['status'] ?? '') === 'sold')
                                    <div class="absolute top-4 right-4 bg-red-600 text-white px-3 py-1 rounded-full font-bold text-sm uppercase shadow-lg animate-pulse">
                                        SOLD
                                    </div>
                                @elseif($isExpired)
                                    <div class="absolute top-4 right-4 bg-gray-500 text-white px-3 py-1 rounded-full font-bold text-sm uppercase shadow-lg animate-pulse">
                                        TIMEOUT
                                    </div>
                                @elseif(($tiket['status'] ?? '') === 'hot')
                                    <div class="absolute top-4 right-4 bg-yellow-400 text-black px-3 py-1 rounded-full font-bold text-sm uppercase shadow-lg animate-bounce">
                                        HOT
                                    </div>
                                @endif

                                {{-- Judul --}}
                                <h3 class="text-xl md:text-2xl font-semibold text-white mb-3">
                                    {{ $tiket['judul'] ?? '-' }}
                                </h3>

                                {{-- Harga --}}
                                <p class="text-2xl md:text-3xl font-extrabold text-[#F26417] mb-4">
                                    Rp {{ number_format($tiket['harga'] ?? 0, 0, ',', '.') }}
                                </p>

                                {{-- Detail --}}
                                <ul class="space-y-2 text-gray-300 text-sm md:text-base leading-relaxed">
                                    <li><b>Tanggal:</b> 
                                        {{ isset($tiket['tanggal']) ? \Carbon\Carbon::parse($tiket['tanggal'])->translatedFormat('d F Y') : '-' }}
                                    </li>
                                    <li><b>Kuota:</b> {{ $tiket['kuota'] ?? 0 }} peserta</li>
                                    <li><b>{{ $event['extraLabel'] }}:</b> {{ $tiket[$event['extraField']] ?? '-' }}</li>
                                </ul>

                                {{-- Tombol --}}
                                @if($event['customTitle'] === 'Musikal Spektakuler')
                                    <a href="{{ route('frontend.tiket.showmusikal', $tiket['id']) }}"
                                       class="mt-8 block text-center bg-gradient-to-r from-[#F26417] to-[#FF7A00] py-3 rounded-xl font-bold text-white shadow-md hover:scale-105 transition
                                       {{ ($tiket['status'] ?? '') === 'sold' || $isExpired ? 'pointer-events-none opacity-50' : '' }}">
                                       {{ $isExpired ? 'TIDAK TERSEDIA' : 'Beli Tiket' }}
                                    </a>
                                @elseif($event['customTitle'] === 'Konferensi Inspiratif')
                                    <a href="{{ route('frontend.tiket.show', $tiket['id']) }}"
                                       class="mt-8 block text-center bg-gradient-to-r from-[#F26417] to-[#FF7A00] py-3 rounded-xl font-bold text-white shadow-md hover:scale-105 transition
                                       {{ ($tiket['status'] ?? '') === 'sold' || $isExpired ? 'pointer-events-none opacity-50' : '' }}">
                                       {{ $isExpired ? 'TIDAK TERSEDIA' : 'Beli Tiket' }}
                                    </a>
                                @endif
                            </div>
                        @empty
                            <p class="text-gray-400 col-span-3">Belum ada tiket {{ ucfirst($type) }}.</p>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Divider antar event --}}
        @if($index < count($events)-1)
            <div class="relative z-10 w-full h-px bg-gradient-to-r from-transparent via-[#F26417] to-transparent opacity-60 my-12"></div>
        @endif
    @endforeach

</section>
@endsection
