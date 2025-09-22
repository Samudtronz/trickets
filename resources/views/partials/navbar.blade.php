<!-- Pastikan Alpine.js ada -->
<script src="https://unpkg.com/alpinejs" defer></script>

<nav class="fixed top-0 left-0 w-full bg-black bg-opacity-90 text-white shadow-md z-50 py-3">
    <div class="flex items-center justify-between w-full px-6">
        
        {{-- Logo --}}
        <div class="flex items-center space-x-3">
            <img src="{{ asset('storage/' . ($konten['navbar_logo'] ?? 'assets/images/logo/default.png')) }}"
                alt="{{ $konten['navbar_brand'] ?? 'Trickets' }} Logo"
                class="w-30 h-20">
            <span class="text-3xl font-black text-[#F26417]">
                {{ $konten['navbar_brand'] ?? 'Trickets' }}
            </span>
        </div>

        <!-- Menu -->
        <ul class="flex space-x-8 font-semibold text-lg relative">
            <!-- HOME Dropdown -->
            <li class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-1 hover:text-[#F26417] transition">
                    <span>HOME</span>
                    <span class="text-[#F26417] font-bold">+</span>
                </button>

                <!-- Dropdown -->
                <ul x-show="open"
                    @click.away="open = false"
                    x-transition
                    class="absolute bg-black text-white mt-2 w-48 shadow-lg border border-gray-700">
                    <li>
                        <a href="{{ route('frontend.home.musik') }}"
                           class="block px-4 py-2 hover:bg-[#F26417] transition">
                            Trickets Musik
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.home.konferensi') }}"
                           class="block px-4 py-2 hover:bg-[#F26417] transition">
                            Trickets Konferensi
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('frontend.events.index') }}" class="hover:text-[#F26417] transition">EVENT</a>
            </li>
        </ul>

        {{-- Actions --}}
        <div class="flex items-center space-x-6" x-data="{ searchOpen: false }">
            <!-- Search Button -->
            <button @click="searchOpen = true" class="hover:text-[#F26417] text-xl transition-colors">
                <i class="fas fa-search"></i>
            </button>

            <!-- Search Modal -->
            <div x-show="searchOpen"
                x-transition
                @click.away="searchOpen = false"
                class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50">
                <div class="bg-gray-900 rounded-xl shadow-lg p-6 w-96">
                    <div class="relative w-full">
                        <input type="text" id="eventSearch" placeholder="Cari event..."
                            class="w-full px-4 py-2 rounded-lg bg-black/60 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#F26417]" />

                        <div id="searchResults"
                            class="absolute top-full mt-2 w-full bg-black/90 rounded-lg shadow-lg hidden max-h-96 overflow-y-auto z-50">
                        </div>
                    </div>
                    <button @click="searchOpen = false" class="mt-3 text-gray-400 hover:text-[#F26417]">
                        Tutup
                    </button>
                </div>
            </div>

            <!-- Beli Tiket -->
            <a href="{{ route('frontend.tiket.index') }}" class="btn-custom py-2 px-6">
                BELI TIKET
            </a>
        </div>
    </div>
</nav>
