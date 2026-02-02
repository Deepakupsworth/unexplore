@extends('frontend.layout')

@section('content')

<!-- 1. EVENTS SEARCH: BANNER -->
<section class="package-listing__banner">
    <div class="container">
        <div class="package-listing__banner-content text-center">
            <h1 class="package-listing__banner-heading h2">Explore Events</h1>
            <p>Discover upcoming events happening across Saudi.</p>
        </div>
    </div>
</section>

<!-- 2. EVENTS SEARCH -->
<section class="package-listing to-do-things-search">
    <div class="container">
        <div class="package-listing__filters">
            <!-- LEFT FILTERS -->
            <div class="package-listing__filter-section">
                <div class="package-listing__filter-section-header">
                    <h6>Filters</h6>
                </div>

                <div class="package-listing__filter-items">

                    <!-- SEARCH -->
                    <div class="package-listing__filter-item">
                        <p class="p-large package-listing__filter-title">Search</p>
                        <div class="input-group mb-3 package-listing__search-bar">
                            <input type="text"
                                   class="form-control"
                                   placeholder="Browse Event, Locations">
                            <button class="btn" type="button">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>

                    <hr>

                    <!-- TYPE SWITCH -->
                    <div class="package-listing__filter-item accordion">
                        <div class="accordion-item">
                            <p class="accordion-header p-large package-listing__filter-title">
                                <button class="accordion-button" type="button">
                                    Type
                                </button>
                            </p>

                            <div class="accordion-body">
                                <div class="package-listing__budget-filter-list">

                                    <!-- Things To Do -->
                                    <a href="{{ route('things.to.do') }}" class="text-decoration-none">
                                        <div class="package-listing__budget-filter-option package-listing__budget-button">
                                            <label>
                                                <span class="option-text">Things To Do</span>
                                            </label>
                                        </div>
                                    </a>

                                    <!-- Events -->
                                    <a href="{{ route('event.listing') }}" class="text-decoration-none">
                                        <div class="package-listing__budget-filter-option package-listing__budget-button active">
                                            <label>
                                                <span class="option-text">Events</span>
                                            </label>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- CATEGORIES -->
                    <div class="package-listing__filter-item accordion">
                        <div class="accordion-item">
                            <p class="accordion-header p-large package-listing__filter-title">
                                <button class="accordion-button" type="button">
                                    Categories
                                </button>
                            </p>

                            <div class="accordion-body">
                                <div class="package-listing__budget-filter-list">
                                    @foreach($categories as $category)
                                        <div class="package-listing__budget-filter-option">
                                            <label>
                                                <input type="checkbox"
                                                       name="categories[]"
                                                       value="{{ $category->id }}"
                                                       {{ in_array($category->id, (array) request('categories')) ? 'checked' : '' }}>

                                                <span class="package-listing__budget-custom-checkbox"></span>

                                                <span class="option-text">
                                                    {{ $category->translationData?->name }}
                                                </span>
                                            </label>

                                            <span class="package-listing__budget-count">
                                                ({{ $category->events_count }})
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- DESTINATIONS -->
                    <div class="package-listing__filter-item accordion">
                        <div class="accordion-item">
                            <p class="accordion-header p-large package-listing__filter-title">
                                <button class="accordion-button" type="button">
                                    Destinations
                                </button>
                            </p>

                            <div class="accordion-body">
                                <div class="package-listing__budget-filter-list">
                                    @foreach($cities as $city)
                                        <div class="package-listing__budget-filter-option">
                                            <label>
                                                <input type="checkbox"
                                                       name="cities[]"
                                                       value="{{ $city->id }}"
                                                       {{ in_array($city->id, (array) request('cities')) ? 'checked' : '' }}>

                                                <span class="package-listing__budget-custom-checkbox"></span>

                                                <span class="option-text">
                                                    {{ $city->translationData?->name }}
                                                </span>
                                            </label>

                                            <span class="package-listing__budget-count">
                                                ({{ $city->events_count }})
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- RIGHT RESULTS -->
            <div class="package-listing__results">

                <!-- APPLIED CATEGORY PILLS -->
                <div class="package-listing__results-header gap-2">
                    @foreach($categories as $category)
                        <a href="{{ route('event.listing') }}?categories[]={{ $category->id }}"
                           class="text-decoration-none">
                            <div class="package-listing__results-applied-fil
                                {{ in_array($category->id, (array) request('categories')) ? 'success' : '' }}">
                                <p class="p-small">{{ $category->translationData?->name }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- SORT -->
                <div class="package-listing__results-applied-list">
                    <div class="dropdown package-listing__results-sort-dropdown">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <span class="label">Sort by:</span>
                            <span class="package-listing__results-sort-option fw-600"
                                  id="currentSortLabel">None</span>
                        </button>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" data-sort="popular">Popular</a></li>
                            <li><a class="dropdown-item" href="#" data-sort="newest">Newest</a></li>
                        </ul>
                    </div>
                </div>

                <!-- EVENTS LIST -->
                <div class="package-listing__results-list">
                    <div class="row gy-4 gx-3" id="eventsList">
                        @include('frontend.events.partials.list', ['events' => $events])
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
let typingTimer;
let currentSort = null;

function applyFilters() {

    const search =
        document.querySelector('input[placeholder*="Browse"]')?.value || '';

    const cities = [...document.querySelectorAll('input[name="cities[]"]:checked')]
        .map(el => el.value);

    const categories = [...document.querySelectorAll('input[name="categories[]"]:checked')]
        .map(el => el.value);

    const params = new URLSearchParams();

    if (search.length >= 3) {
        params.set('search', search);
    }

    cities.forEach(id => params.append('cities[]', id));
    categories.forEach(id => params.append('categories[]', id));

    if (currentSort) {
        params.set('sort', currentSort);
    }

    const newUrl =
        `${window.location.pathname}${params.toString() ? '?' + params.toString() : ''}`;
    window.history.pushState({}, '', newUrl);

    fetch(`{{ route('events.filter') }}?${params.toString()}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => res.text())
    .then(html => {
        document.getElementById('eventsList').innerHTML = html;
    });
}

/* Search */
document.querySelectorAll('input[type="text"]').forEach(input => {
    input.addEventListener('keyup', () => {
        clearTimeout(typingTimer);
        if (input.value.length >= 3 || input.value.length === 0) {
            typingTimer = setTimeout(applyFilters, 400);
        }
    });
});

/* Checkbox filters */
document.querySelectorAll('input[type="checkbox"]').forEach(cb => {
    cb.addEventListener('change', applyFilters);
});

/* Sort */
document.querySelectorAll('.dropdown-item[data-sort]').forEach(item => {
    item.addEventListener('click', e => {
        e.preventDefault();
        currentSort = item.dataset.sort;
        document.getElementById('currentSortLabel').textContent = item.textContent;
        applyFilters();
    });
});
</script>
@endpush