@extends('layouts.app')

@section('content')

<!--==============================
Tiket List Area  
==============================-->
<section class="bg-black text-white py-16 px-6 lg:px-20">
    <div class="text-center mb-12">
        <h2 class="text-4xl font-bold text-white">Pilih Tiket Kamu</h2>
    </div>

    @foreach(['regular','business','VIP'] as $type)
        <h3 class="text-2xl font-bold text-white mb-6">{{ ucfirst($type) }} Ticket</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">

            @foreach($tickets[$type] ?? [] as $tiket)
                <div class="relative bg-gray-900 rounded-2xl p-8">
                    {{-- Stiker SOLD --}}
                    @if($tiket['status'] === 'sold')
                        <div class="absolute inset-0 bg-black/70 flex items-center justify-center text-2xl font-bold text-red-500 rounded-2xl z-10">
                            SOLD
                        </div>
                    @endif

                    <h3 class="text-2xl font-bold">{{ $tiket['judul'] ?? '-' }}</h3>
                    <p class="text-3xl font-extrabold text-[#F26417] mt-4">Rp {{ number_format($tiket['harga'],0,',','.') }}</p>
                    <ul class="mt-6 space-y-2 text-gray-300 text-sm">
                        <li><b>Judul:</b> {{ $tiket['judul'] ?? '-' }}</li>
                        <li><b>Tanggal:</b> {{ \Carbon\Carbon::parse($tiket['tanggal'])->format('d F Y') }}</li>
                        <li><b>Kuota:</b> {{ $tiket['kuota'] ?? 0 }} peserta</li>
                        @if(isset($tiket['pembicara']))
                            <li><b>Pembicara:</b> {{ $tiket['pembicara'] }}</li>
                        @endif
                    </ul>

                    <a href="{{ route('frontend.tiket.show', $tiket['id']) }}"
                       class="mt-8 block text-center bg-[#F26417] py-3 rounded-xl font-bold text-white hover:bg-orange-600 transition
                       {{ $tiket['status'] === 'sold' ? 'pointer-events-none opacity-50' : '' }}">
                       Beli Tiket
                    </a>
                </div>
            @endforeach

            {{-- Jika tidak ada tiket --}}
            @if(empty($tickets[$type] ?? []))
                <p class="text-gray-400 col-span-3">Belum ada tiket untuk kategori ini.</p>
            @endif

        </div>
    @endforeach

</section>

@endsection
