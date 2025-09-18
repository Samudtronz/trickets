<div class="space-y-6">
    @forelse ($events as $event)
        <div class="bg-gray-900 rounded-xl p-6 flex items-center justify-between">
            <div class="flex items-center space-x-6">
               <img src="{{ $event['foto_event'] 
                ? 'http://192.168.100.65/projek-services/konferensi-service/storage/' . $event['foto_event'] 
                : asset('assets/images/backgrounds/no-images.png') }}"
                alt="{{ $event['judul'] ?? 'Event' }}"
                class="w-32 h-24 rounded-lg object-cover">
                <div>
                    <h3 class="text-xl font-bold text-white">{{ $event['judul'] }}</h3>
                    <p class="text-sm text-gray-400"><i class="fa-solid fa-location-dot text-primary-500 mr-2"></i> {{ $event['lokasi'] }}</p>
                    <p class="text-sm text-gray-400"><i class="fa-solid fa-clock text-primary-500 mr-2"></i> {{ \Carbon\Carbon::parse($event['tanggal'])->format('d M Y') }}</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('frontend.tiket.showByEvent', $event['id']) }}" class="btn-custom">
                    BELI TIKET
                </a>
                <a href="{{ route('frontend.detail.konferensi', $event['id']) }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg font-bold">Detail Event</a>
            </div>
        </div>
    @empty
        <p class="text-white">Belum ada event konferensi tersedia.</p>
    @endforelse
</div>

@if(method_exists($events, 'links'))
    <div class="flex justify-center mt-10 pagination">
        {{ $events->links('pagination::tailwind') }}
    </div>
@endif