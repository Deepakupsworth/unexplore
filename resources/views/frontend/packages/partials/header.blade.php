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
    <div class="package-listing__results-applied-fil {{ empty($selectedTypes) ? 'success' : '' }}">
        <a href="{{ route('packages.index') }}" class="text-decoration-none">
            <p class="p-small {{ empty($selectedTypes) ? 'text-success' : '' }}">{{ __('header.all_packages') }}</p>
            {{-- ({{ $total }}) --}}
        </a>
    </div>

    {{-- PACKAGE TYPES --}}
    @foreach ($packageTypes as $type => $count)

    <div class="package-listing__results-applied-fil {{ in_array($type, $selectedTypes) ? 'success' : '' }}">
        <a href="#" class="text-decoration-none package-type-tag" data-type="{{ $type }}">
            <p class="p-small {{ in_array($type, $selectedTypes) ? 'text-success' : '' }}">
                {{ $type === 'customized'
                    ? __('packages.filters.customizable')
                    : __('packages.filters.non_customizable') }}
                ({{ $count }})
            </p>
        </a>
    </div>
@endforeach


</div>

{{-- ================= APPLIED FILTERS + SORT ================= --}}
<div class="package-listing__results-applied-list d-flex align-items-center mt-2">

    {{-- FILTER TAGS --}}
    {{-- <div class="d-flex gap-2 flex-wrap">

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
                <p class="p-small">{{__('common.clearAll')}}</p>
                <a href="{{ route('packages.index') }}"
                    class="package-listing__results-del-button text-danger clear-all">
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            </div>
        @endif

    </div> --}}

    {{-- SORT --}}
    <div class="dropdown">
        <button class="btn dropdown-toggle" data-bs-toggle="dropdown">
            {{ __('package.sort.label') }}
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
