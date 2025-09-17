@extends('layouts.app')

@section('content')
<section class="bg-black text-white min-h-screen flex flex-col">
    <div class="flex-grow flex items-center justify-center">
        <div class="max-w-3xl w-full bg-gray-900 rounded-2xl p-8">
            @if($tiket)
                <h2 class="text-3xl font-bold mb-4">Detail Tiket</h2>

                <p><b>Kode Tiket:</b> {{ $tiket['kode_tiket'] }}</p>
                <p><b>Jenis Tiket:</b> {{ ucfirst($tiket['jenis_tiket']) }}</p>
                <p><b>Harga:</b> Rp {{ number_format($tiket['harga'],0,',','.') }}</p>
                <p><b>Status:</b> {{ ucfirst($tiket['status']) }}</p>

                @if($eventDetail)
                    <hr class="my-4 border-gray-700">
                    <h3 class="text-2xl font-bold mb-2">Detail Event</h3>
                    <p><b>Judul:</b> {{ $eventDetail['judul'] }}</p>
                    <p><b>Tanggal:</b> {{ \Carbon\Carbon::parse($eventDetail['tanggal'])->format('d F Y') }}</p>
                    <p><b>Kuota:</b> {{ $eventDetail['kuota'] }} peserta</p>
                    <p><b>Pembicara:</b> {{ $eventDetail['pembicara'] }}</p>
                @endif

                <a href="{{ route('frontend.tiket.index') }}"
                 class="mt-6 inline-block bg-[#F26417] hover:bg-orange-600 px-6 py-3 rounded-xl font-bold">
                    Beli Tiket
                </a>
            @else
                <p class="text-gray-400">Tiket tidak ditemukan.</p>
            @endif
        </div>
    </div>
</section>
@endsection
