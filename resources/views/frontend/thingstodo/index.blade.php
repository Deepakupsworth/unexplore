@extends('frontend.layout')
@section('content')
    {{-- @dd($things) --}}
    <!-- 1. TO DO THING SEARCH: BANNER -->
    <section class="package-listing__banner">
        <div class="container">
            <div class="package-listing__banner-content text-center">
                <h1 class="package-listing__banner-heading h2">{{ __('things.banner.title') }}</h1>
                <p>{{ __('things.banner.description') }}</p>
            </div>
        </div>
    </section>

    <!-- 2. TO DO THING SEARCH -->
    <section class="package-listing to-do-things-search">
        <div class="container">
            <div class="package-listing__filters">
                <div class="package-listing__filter-section">
                    <div class="package-listing__filter-section-header">
                        <h6>{{ __('things.filters.title') }}</h6>
                    </div>
                    <div class="package-listing__filter-items">
                        <div class="package-listing__filter-item">
                            <p class="p-large package-listing__filter-title">{{ __('things.filters.search.title') }}</p>
                            <div class="input-group mb-3 package-listing__search-bar">
                                <input type="text" class="form-control"
                                    placeholder="{{ __('things.filters.search.placeholder') }}"
                                    aria-label="Browse Package, Location">
                                <button class="btn" type="button">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="package-listing__filter-item accordion" id="packagesAccordion">
                            <div class="accordion-item">
                                <p class="accordion-header p-large package-listing__filter-title">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapsePackages" aria-expanded="true"
                                        aria-controls="collapsePackages">
                                        {{ __('things.filters.type') }}
                                    </button>
                                </p>
                                <div id="collapsePackages" class="accordion-collapse collapse show"
                                    data-bs-parent="#packagesAccordion">
                                    <div class="accordion-body">
                                        <div class="package-listing__budget-filter-list">

                                            <!-- Things To Do -->
                                            <a href="{{ route('things.to.do') }}" class="text-decoration-none">
                                                <div
                                                    class="package-listing__budget-filter-option package-listing__budget-button
                                                    {{ request()->routeIs('things.to.do') ? 'active' : '' }}">
                                                    <label>
                                                        <!-- <input type="checkbox" aria-label="Things To Do" /> -->
                                                        <span
                                                            class="option-text">{{ __('things.results.sort.thingToDo') }}</span>
                                                    </label>
                                                </div>
                                            </a>

                                            <!-- Events -->
                                            <a href="{{ route('event.listing') }}" class="text-decoration-none">
                                                <div
                                                    class="package-listing__budget-filter-option package-listing__budget-button
                                                    {{ request()->routeIs('event.listing') ? 'active' : '' }}">
                                                    <label>
                                                        <!-- <input type="checkbox" aria-label="Events" /> -->
                                                        <span
                                                            class="option-text">{{ __('things.filters.type.events') }}</span>
                                                    </label>
                                                </div>
                                            </a>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>

                        <div class="package-listing__filter-item accordion" id="categoryAccordion">
                            <div class="accordion-item">
                                <p class="accordion-header p-large package-listing__filter-title">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseCategory" aria-expanded="true"
                                        aria-controls="collapseCategory">
                                        {{ __('things.filters.categories') }}
                                    </button>
                                </p>

                                <div id="collapseCategory" class="accordion-collapse collapse show"
                                    data-bs-parent="#categoryAccordion">
                                    <div class="accordion-body">
                                        <div class="package-listing__budget-filter-list">
                                            @foreach ($categories as $category)
                                                <div class="package-listing__budget-filter-option">
                                                    <label>
                                                        <input type="checkbox" name="categories[]"
                                                            value="{{ $category->id }}"
                                                            {{ in_array($category->id, (array) request('categories')) ? 'checked' : '' }} />

                                                        <span class="package-listing__budget-custom-checkbox"
                                                            aria-hidden="true"></span>

                                                        <span class="option-text">
                                                            {{ $category->translationData?->name }}
                                                        </span>
                                                    </label>

                                                    <span class="package-listing__budget-count">
                                                        ({{ $category->things_count }})
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="package-listing__filter-item accordion" id="destinationAccordion">
                            <div class="accordion-item">
                                <p class="accordion-header p-large package-listing__filter-title">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseDestination" aria-expanded="true"
                                        aria-controls="collapseDestination">
                                        {{ __('things.filters.destinations') }}
                                    </button>
                                </p>

                                <!-- <div class="input-group mb-3 package-listing__search-bar">
                                            <input type="text" class="form-control"
                                                placeholder="Browse Package, Locations"
                                                aria-label="Browse Package, Location">
                                            <button class="btn" type="button">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </button>
                                        </div> -->

                                <div id="collapseDestination" class="accordion-collapse collapse show"
                                    data-bs-parent="#destinationAccordion">
                                    <div class="accordion-body">
                                        <div class="package-listing__budget-filter-list">
                                            @foreach ($cities as $city)
                                                <div class="package-listing__budget-filter-option">
                                                    <label>
                                                        <input type="checkbox" name="cities[]" value="{{ $city->id }}"
                                                            {{ in_array($city->id, (array) request('cities')) ? 'checked' : '' }}>

                                                        <span class="package-listing__budget-custom-checkbox"
                                                            aria-hidden="true"></span>

                                                        <span class="option-text">
                                                            {{ $city->translationData?->name }}
                                                        </span>
                                                    </label>

                                                    <span class="package-listing__budget-count">
                                                        ({{ $city->things_count }})
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- <div class="package-listing__filter-item accordion" id="packagesAccordion">
                                <div class="accordion-item">
                                    <p class="accordion-header p-large package-listing__filter-title">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapsePackages" aria-expanded="true"
                                            aria-controls="collapsePackages">
                                            Seasons
                                        </button>
                                    </p>
                                    <div id="collapsePackages" class="accordion-collapse collapse show"
                                        data-bs-parent="#packagesAccordion">
                                        <div class="accordion-body">
                                            <div class="package-listing__budget-filter-list">
                                                <div
                                                    class="package-listing__budget-filter-option package-listing__budget-button active">
                                                    <label>
                                                        <input type="checkbox" aria-label="Saudi Arabia" />
                                                        <span class="option-text">Riyadh Season</span>
                                                    </label>
                                                </div>
                                                <div
                                                    class="package-listing__budget-filter-option package-listing__budget-button">
                                                    <label>
                                                        <input type="checkbox" aria-label="Saudi Arabia" />
                                                        <span class="option-text">Jeddah Season</span>
                                                    </label>
                                                </div>
                                                <div
                                                    class="package-listing__budget-filter-option package-listing__budget-button">
                                                    <label>
                                                        <input type="checkbox" aria-label="Saudi Arabia" />
                                                        <span class="option-text">Diriyah Season 2024 - 2025</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr> -->
                        <!-- <div class="package-listing__filter-item accordion" id="citiesAccordion">
                                <div class="accordion-item">
                                    <p class="accordion-header p-large package-listing__filter-title">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseCities" aria-expanded="true"
                                            aria-controls="collapseCities">
                                            Dates
                                        </button>
                                    </p>
                                </div>
                            </div> -->
                    </div>
                </div>
                <div class="package-listing__results">
                    <div class="package-listing__results-header gap-2">

                        {{-- ALL --}}
                        <a href="{{ route('things.to.do') }}" class="text-decoration-none">
                            <div
                                class="package-listing__results-applied-fil
                                {{ empty(request('categories')) ? 'success' : '' }}">
                                <p class="p-small">All To Do Things</p>
                            </div>
                        </a> @foreach ($categories as $category)
                        <a href="{{ route('things.to.do') }}?categories[]={{ $category->id }}"
                            style="text-decoration: none;">
                            <div
                                class="package-listing__results-applied-fil {{ in_array($category->id, (array) request('categories')) ? 'success' : '' }} ">
                                <p class="p-small"> {{ $category->translationData?->name }}</p>
                            </div>
                        </a>
                        @endforeach
                        <!-- <div class="package-listing__results-applied-fil">
                                <p class="p-small">Entertainment</p>
                            </div>
                            <div class="package-listing__results-applied-fil">
                                <p class="p-small">Culture & History</p>
                            </div> -->
                    </div>
                    <div class="package-listing__results-applied-list">
                        <div class="d-flex gap-2">
                            <!-- <div class="package-listing__results-applied-fil success">
                                    <p class="p-small">Customizable</p>
                                    <button class="package-listing__results-del-button"><i
                                            class="fa-solid fa-xmark"></i></button>
                                </div>
                                <div class="package-listing__results-applied-fil danger">
                                    <p class="p-small">Clear All</p>
                                    <button class="package-listing__results-del-button"><i
                                            class="fa-solid fa-trash-can"></i></button>
                                </div> -->
                        </div>
                        <div class="dropdown package-listing__results-sort-dropdown">
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span class="label"> {{ __('things.results.sort.label') }}</span>
                                <span class="package-listing__results-sort-option fw-600" id="currentSortLabel">
                                    {{ __('things.results.sort.popular') }}
                                </span>
                            </button>

                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="#"
                                        data-sort="popular">{{ __('things.results.sort.popular') }}</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#"
                                        data-sort="newest">{{ __('things.results.sort.newest') }}</a>
                                </li>
                                <!-- <li>
                <a class="dropdown-item" href="#" data-sort="price_low">Price: Low to High</a>
            </li>
            <li>
                <a class="dropdown-item" href="#" data-sort="price_high">Price: High to Low</a>
            </li> -->
                            </ul>
                        </div>

                    </div>
                    <div class="package-listing__results-list">
                        <div class="row gy-4 gx-3" id="thingsList">

                            @include('frontend.thingstodo.partials.list', ['things' => $things])


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        //   let typingTimer;

        //     function applyFilters() {

        //         const search = document.querySelector(
        //             'input[placeholder*="Browse"]'
        //         )?.value || '';

        //         const cities = [...document.querySelectorAll('input[name="cities[]"]:checked')]
        //             .map(el => el.value);

        //         const categories = [...document.querySelectorAll('input[name="categories[]"]:checked')]
        //             .map(el => el.value);

        //         const params = new URLSearchParams();

        //         if (search.length >= 3) {
        //             params.append('search', search);
        //         }

        //         cities.forEach(id => params.append('cities[]', id));
        //         categories.forEach(id => params.append('categories[]', id));

        //         fetch(`{{ route('to.do.things.filter') }}?${params.toString()}`, {
        //         headers: {
        //                 'X-Requested-With': 'XMLHttpRequest'
        //             }
        //         })
        //         .then(res => res.text())
        //         .then(html => {
        //             document.getElementById('thingsList').innerHTML = html;
        //         });
        //     }

        //     /* 🔎 Search after 3 chars (debounced) */
        //     document.querySelectorAll('input[type="text"]').forEach(input => {
        //         input.addEventListener('keyup', () => {
        //             clearTimeout(typingTimer);
        //             if (input.value.length >= 3 || input.value.length === 0) {
        //                 typingTimer = setTimeout(applyFilters, 400);
        //             }
        //         });
        //     });

        //     /* ☑ Checkbox filters */
        //     document.querySelectorAll('input[type="checkbox"]').forEach(cb => {
        //         cb.addEventListener('change', applyFilters);
        //     });


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

            /* ✅ Apply sort ONLY if user selected */
            if (currentSort) {
                params.set('sort', currentSort);
            }

            /* Update browser URL */
            const newUrl =
                `${window.location.pathname}${params.toString() ? '?' + params.toString() : ''}`;
            window.history.pushState({}, '', newUrl);

            /* AJAX call */
            fetch(`{{ route('to.do.things.filter') }}?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.text())
                .then(html => {
                    document.getElementById('thingsList').innerHTML = html;
                });
        }

        /* 🔎 Search (debounced, min 3 chars) */
        document.querySelectorAll('input[type="text"]').forEach(input => {
            input.addEventListener('keyup', () => {
                clearTimeout(typingTimer);
                if (input.value.length >= 3 || input.value.length === 0) {
                    typingTimer = setTimeout(applyFilters, 400);
                }
            });
        });

        /* ☑ Checkbox filters */
        document.querySelectorAll('input[type="checkbox"]').forEach(cb => {
            cb.addEventListener('change', applyFilters);
        });
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
