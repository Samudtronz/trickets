<section class="bg-black py-16 px-6 lg:px-20">
    <h2 class="text-3xl font-extrabold text-white mb-10">{{ $konten['musical_event_list'] ?? 'Daftar Event Musikal' }}</h2>

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
                    @if(!empty($event['id']))
                        <a href="{{ route('frontend.tiket.showmusikal', $event['id']) }}" 
                           class="bg-primary-500 text-white px-5 py-2 rounded-lg font-bold hover:bg-primary-600 transition">
                           Beli Tiket
                        </a>
                    @else
                        <span class="bg-gray-600 text-white px-5 py-2 rounded-lg font-bold cursor-not-allowed">
                           Tiket Belum Ada
                        </span>
                    @endif
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
    @if ($events->hasPages())
        <div class="flex justify-center mt-10">
            {!! $events->links('vendor.pagination.custom') !!}
        </div>
    @endif
</section>
