@if ($paginator->hasPages())
    <nav class="flex justify-end mt-6 space-x-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 bg-gray-300 text-gray-500 rounded-full cursor-not-allowed">←</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 bg-slate-700 text-white rounded-full hover:bg-blue-700">←</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-4 py-2 text-gray-500">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-4 py-2 bg-slate-700 text-white rounded-full">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-4 py-2 bg-gray-100 hover:bg-blue-100 rounded-full">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 bg-slate-700 text-white rounded-full hover:bg-blue-700">→</a>
        @else
            <span class="px-4 py-2 bg-gray-300 text-gray-500 rounded-full cursor-not-allowed">→</span>
        @endif
    </nav>
@endif
