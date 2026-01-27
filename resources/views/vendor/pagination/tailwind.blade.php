@if ($paginator->hasPages())
<div class="card rounded-md bg-white dark:bg-slate-800 shadow-base mt-6">
    <main class="card-body p-4">
        <ul class="pagination">

            {{-- Previous --}}
            <li>
                @if ($paginator->onFirstPage())
                    <button class="text-slate-600 prev-next-btn" disabled>Previous</button>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="prev-next-btn">Previous</a>
                @endif
            </li>

            {{-- Pages --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li><span class="page-link disabled">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li>
                            @if ($page == $paginator->currentPage())
                                <span class="page-link active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                            @endif
                        </li>
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            <li>
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="prev-next-btn">Next</a>
                @else
                    <button class="text-slate-600 prev-next-btn" disabled>Next</button>
                @endif
            </li>

        </ul>
    </main>
</div>
@endif
