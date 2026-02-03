@php
    $selectedTypes = (array) request('package_type', []);
    $total = $packages->total();
@endphp

@php
    $sortOptions = [
        'popular' => 'Popular',
        'newest' => 'Newest',
        'price_asc' => 'Price: Low → High',
        'price_desc' => 'Price: High → Low',
    ];

    $currentSort = request('sort', 'popular');
@endphp

{{-- ================= HEADER TABS ================= --}}
<div class="package-listing__results-header d-flex gap-4 align-items-center">

    {{-- ALL --}}
    <a href="{{ route('packages.index') }}"
        class="{{ empty($selectedTypes) ? 'primary-text fw-600 text-decoration-none' : '' }}">
        All Packages ({{ $total }})
    </a>

    {{-- PACKAGE TYPES --}}
    @foreach ($packageTypes as $type => $count)
        <a href="#" class="package-type-tag {{ in_array($type, $selectedTypes) ? 'primary-text fw-600' : '' }}"
            data-type="{{ $type }}">
            {{ ucfirst($type) }} ({{ $count }})
        </a>
    @endforeach

</div>

{{-- ================= APPLIED FILTERS + SORT ================= --}}
<div class="package-listing__results-applied-list d-flex align-items-center mt-2">

    {{-- FILTER TAGS --}}
    <div class="d-flex gap-2 flex-wrap">

        @foreach ($selectedTypes as $type)
            <div class="package-listing__results-applied-fil success">
                <p class="p-small">{{ ucfirst($type) }}</p>
                <button data-type="{{ $type }}"
                    class="package-listing__results-del-button text-success remove-type">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endforeach

        @if (count($selectedTypes))
            <div class="package-listing__results-applied-fil danger">
                <p class="p-small">Clear All</p>
                <a href="{{ route('packages.index') }}"
                    class="package-listing__results-del-button text-danger clear-all">
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            </div>
        @endif

    </div>

    {{-- SORT --}}
    <div class="dropdown ms-auto">
        <button class="btn dropdown-toggle" data-bs-toggle="dropdown">
            Sort by:
            <strong>{{ $sortOptions[$currentSort] ?? 'Popular' }}</strong>
        </button>

        <ul class="dropdown-menu">
            @foreach ($sortOptions as $key => $label)
                <li>
                    <a href="#" class="dropdown-item sort-option {{ $currentSort === $key ? 'active' : '' }}"
                        data-sort="{{ $key }}">
                        {{ $label }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

</div>
