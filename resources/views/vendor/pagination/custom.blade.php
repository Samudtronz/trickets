@if ($paginator->hasPages())
    <nav class="flex items-center justify-center space-x-2" role="navigation" aria-label="Pagination Navigation">
        
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-800 text-gray-500 cursor-not-allowed">
                ‹
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-900 text-white hover:bg-primary-500 transition">
                ‹
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- Dots --}}
            @if (is_string($element))
                <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-900 text-white">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary-500 text-white font-bold">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-900 text-white hover:bg-primary-500 transition">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-900 text-white hover:bg-primary-500 transition">
                ›
            </a>
        @else
            <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-800 text-gray-500 cursor-not-allowed">
                ›
            </span>
        @endif
    </nav>
@endif
