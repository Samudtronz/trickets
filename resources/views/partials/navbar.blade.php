<!-- Pastikan Alpine.js ada -->
<script src="https://unpkg.com/alpinejs" defer></script>

<nav class="fixed top-0 left-0 w-full bg-black bg-opacity-90 text-white shadow-md z-50 py-3">
    <div class="flex items-center justify-between w-full px-6">
        
        {{-- Logo --}}
        <div class="flex items-center space-x-3 pl-0 ml-0">
            <img src="{{ asset('assets/images/logo/logo-only.png') }}" alt="Trickets Logo" class="w-30 h-20">
            <span class="text-3xl font-black text-[#F26417]">Trickets</span>
        </div>

        <!-- Menu -->
        <ul class="flex space-x-8 font-semibold text-lg relative">
        
            <!-- HOME Dropdown -->
            <li class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-1 hover:text-[#F26417] transition">
                    <span>HOME</span>
                    <span class="text-[#F26417] font-bold">+</span>
                </button>

                <!-- Dropdown (toggle) -->
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
            <li><a href="{{ route('frontend.events.index') }}" class="hover:text-[#F26417] transition">EVENT</a></li>
        </ul>

        {{-- Actions --}}
        <div class="flex items-center space-x-6">
            <button class="hover:text-[#F26417] text-xl transition-colors">
                <i class="fas fa-search"></i>
            </button>
            <a href="{{ route('frontend.tiket.index') }}" class="btn-custom py-2 px-6">
                BELI TIKET
            </a>
        </div>
    </div>
</nav>