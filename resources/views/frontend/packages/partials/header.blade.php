@php
    $selectedTypes = (array) request('package_type', []);
    $total = $packages->total();
@endphp

{{-- ================= HEADER TABS ================= --}}
<div class="package-listing__results-header d-flex gap-4 align-items-center">

    {{-- ALL --}}
    <a href="{{ route('packages.index') }}"
       class="{{ empty($selectedTypes) ? 'primary-text fw-600 text-decoration-none' : '' }}">
        All Packages ({{ $total }})
    </a>

    {{-- PACKAGE TYPES --}}
    @foreach($packageTypes as $type => $count)
        <a href="{{ request()->fullUrlWithQuery([
            'package_type' => [$type]
        ]) }}"
           class="{{ in_array($type, $selectedTypes) ? 'primary-text fw-600 text-decoration-none' : 'text-decoration-none' }}">
            {{ ucfirst($type) }} ({{ $count }})
        </a>
    @endforeach

</div>

{{-- ================= APPLIED FILTERS + SORT ================= --}}
<div class="package-listing__results-applied-list d-flex align-items-center mt-2">

    {{-- FILTER TAGS --}}
    <div class="d-flex gap-2 flex-wrap">

        @foreach($selectedTypes as $type)
            <div class="package-listing__results-applied-fil success">
                <p class="p-small">{{ ucfirst($type) }}</p>
                <a href="{{ route('packages.index') }}"
                   class="package-listing__results-del-button text-success">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </div>
        @endforeach

        @if(count($selectedTypes))
            <div class="package-listing__results-applied-fil danger">
                <p class="p-small">Clear All</p>
                <a href="{{ route('packages.index') }}"
                   class="package-listing__results-del-button text-danger">
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            </div>
        @endif

    </div>

    {{-- SORT --}}
    <div class="dropdown ms-auto">
        <button class="btn dropdown-toggle" data-bs-toggle="dropdown">
            Sort by: <strong>{{ ucfirst(request('sort','popular')) }}</strong>
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item sort-option" data-sort="popular" href="#">Popular</a></li>
            <li><a class="dropdown-item sort-option" data-sort="newest" href="#">Newest</a></li>
            <li><a class="dropdown-item sort-option" data-sort="price_asc" href="#">Price: Low → High</a></li>
            <li><a class="dropdown-item sort-option" data-sort="price_desc" href="#">Price: High → Low</a></li>
        </ul>
    </div>

</div>

<input type="hidden" name="sort" value="{{ request('sort') }}">
