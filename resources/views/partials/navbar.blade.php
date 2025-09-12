<nav class="fixed top-0 left-0 w-full bg-black bg-opacity-90 text-white shadow-md z-50 py-3">
    <div class="flex items-center justify-between w-full px-6">
        
        {{-- Logo --}}
        <div class="flex items-center space-x-3 pl-0 ml-0">
            <img src="{{ asset('assets/images/logo/logo-only.png') }}" alt="Trickets Logo" class="w-30 h-20">
            <span class="text-3xl font-black text-[#F26417]">Trickets</span>
        </div>

        {{-- Menu Tengah --}}
        <ul class="hidden md:flex space-x-12 font-semibold text-lg">
            <li><a href="#" class="hover:text-[#F26417] transition-colors">HOME</a></li>
            <li><a href="#" class="hover:text-[#F26417] transition-colors">ABOUT US</a></li>
            <li><a href="#" class="hover:text-[#F26417] transition-colors">EVENT</a></li>
            <li><a href="#" class="hover:text-[#F26417] transition-colors">CONTACT</a></li>
        </ul>

        {{-- Actions --}}
        <div class="flex items-center space-x-6">
            <button class="hover:text-[#F26417] text-xl transition-colors">
                <i class="fas fa-search"></i>
            </button>
            <a href="#" class="btn-custom py-2 px-6">
                BELI TIKET
            </a>
        </div>
    </div>
</nav>