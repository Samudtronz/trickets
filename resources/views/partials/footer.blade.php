<footer class="bg-black text-gray-300">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
        
        {{-- About --}}
        <div>
            {{-- Logo --}}
            <div class="flex items-center space-x-3">
                <img src="{{ asset('storage/' . $konten['footer_logo']) }}"                
                alt="{{ $konten['footer_brand'] }} Logo" class="w-30 h-20">
                <span class="text-3xl font-black text-[#F26417]">{{ $konten['footer_brand'] }}</span>
            </div>
            {{-- Description --}}
            <p class="text-sm leading-6 mt-3 md:mt-0 text-center md:text-left">
                {{ $konten['footer_description'] }}
            </p>
        </div>

        {{-- Quick Links --}}
        <div>
            <ul class="space-y-2 text-sm">
                <li class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-1 hover:text-[#F26417] transition">
                        <span>home</span>
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
                <li><a href="{{ route('frontend.events.index') }}" class="hover:text-white transition">Events</a></li>
            </ul>
            <ul>
                <li><a href="{{ route('frontend.tiket.index') }}" class="hover:text-white transition">Tiket</a></li>
            </ul>
        </div>

    </div>

    {{-- Copyright --}}
    <div class="border-t border-gray-700 text-center py-4 text-sm">
        <p>&copy; {{ date('Y') }} <span class="font-black text-[#F26417]">{{ $konten['footer_brand'] }}</span> {{ $konten['footer_copyright'] }}</p>
    </div>
</footer>
