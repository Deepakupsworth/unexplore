@extends('frontend.layout')
@section('title','Saudi Arabia Events | Concerts, Exhibitions & Festivals')

@section('meta_description', 'Discover upcoming events in Saudi Arabia including concerts, exhibitions, sports, and cultural festivals in Riyadh, Jeddah, AlUla and more. Plan your visit today.')
@section('content')

<style>
  @media (max-width: 768px) {

        body.filter-open {
            overflow: hidden;
            height: 100vh;
        }

        .package-listing__filter-section {
            position: fixed;
            inset: 0;
            background: #fff;
            z-index: 9999;

            display: none;              /* 🔥 hidden by default */
            flex-direction: column;
        }

        .package-listing__filter-section.active {
            display: flex;              /* 🔥 show only when active */
        }

        .filter-header,
        .filter-footer {
            flex-shrink: 0;
        }

        .filter-body {
            flex: 1;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }
        .filtet-mob-button{
            margin: 25px 0px -18px 5px;
        }
}
</style>

    <!-- 1. EVENTS SEARCH: BANNER -->
    <section class="package-listing__banner">
        <div class="container">
            <div class="package-listing__banner-content text-center">
                <h1 class="package-listing__banner-heading h2">{{ __('events.explore_events') }}</h1>
                <p>{{ __('events.discover_events_saudi') }}</p>
            </div>
        </div>

    </section>

    <!-- 2. EVENTS SEARCH -->
    <section class="package-listing to-do-things-search">
        <div class="container">


        <div class="filtet-mob-button"> <button class="btn btn-outline-primary d-md-none mb-3" id="openFilters">
                {{ __('common.filters') }}
            </button></div>
            <div class="package-listing__filters">




                <!-- LEFT FILTERS -->
                <div class="package-listing__filter-section">


                    <div class="package-listing__filter-section-header d-md-none d-flex justify-content-between align-items-center mb-3 filter-header">
                        <h6>{{ __('common.filters') }}</h6>

                    <button class="btn btn-sm btn-outline-secondary" id="closeFilters">
                        ✕
                    </button>

                    </div>

                    <div class="package-listing__filter-items filter-body">

                        <!-- SEARCH -->
                        <div class="package-listing__filter-item">
                            <p class="p-large package-listing__filter-title">{{ __('common.search') }}</p>
                            <div class="input-group mb-3 package-listing__search-bar">
                                <input type="text" class="form-control" placeholder="{{ __('events.browse_event_locations') }}" id="eventSearchInput">
                                <button class="btn" type="button" id="eventSearchBtn">
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
                                        {{ __('events.type') }}
                                    </button>
                                </p>

                                <div class="accordion-body">
                                    <div class="package-listing__budget-filter-list">

                                        <!-- Things To Do -->
                                        <a href="{{ route('things.to.do') }}" class="text-decoration-none">
                                            <div
                                                class="package-listing__budget-filter-option package-listing__budget-button">
                                                <label>
                                                    <span class="option-text">{{ __('events.things_to_do') }}                                                    </span>
                                                </label>
                                            </div>
                                        </a>

                                        <!-- Events -->
                                        <a href="{{ route('event.listing') }}" class="text-decoration-none">
                                            <div
                                                class="package-listing__budget-filter-option package-listing__budget-button active">
                                                <label>
                                                    <span class="option-text">{{ __('events.events') }}</span>
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
                                        {{ __('common.categories') }}
                                    </button>
                                </p>

                                <div class="accordion-body">
                                    <div class="package-listing__budget-filter-list">
                                        @foreach ($categories as $category)
                                            <div class="package-listing__budget-filter-option">
                                                <label>
                                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
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
                                        {{ __('common.destinations') }}
                                    </button>
                                </p>

                                <div class="accordion-body">
                                    <div class="package-listing__budget-filter-list">
                                        @foreach ($cities as $city)
                                            <div class="package-listing__budget-filter-option">
                                                <label>
                                                    <input type="checkbox" name="cities[]" value="{{ $city->id }}"
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

                        <hr />
                        <!-- EVENT DATE -->
                        <div class="package-listing__filter-item accordion">
                            <div class="accordion-item">
                                <p class="accordion-header p-large package-listing__filter-title">
                                    <button class="accordion-button" type="button">
                                        {{ __('events.event_date') }}
                                    </button>
                                </p>

                                <div class="accordion-body">
                                    <div class=" input-group package-listing__date-filter">


                                        <!-- FROM -->
                                        <label class="date-label w-100">
                                            {{ __('common.from') }}

                                            <input type="date" name="event_date_from"
                                                value="{{ request('event_date_from') }}" min="<?php echo date('Y-m-d'); ?>"
                                                class="form-control w-100">
                                        </label>

                                        <!-- TO -->
                                        <label class="date-label mt-2 w-100">
                                            {{ __('common.to') }}
                                            <input type="date" name="event_date_to"
                                                value="{{ request('event_date_to') }}" min="<?php echo date('Y-m-d'); ?>"
                                                class="form-control w-100">
                                        </label>


                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>
                    <div class="d-md-none position-sticky bottom-0 bg-white pt-3 pb-2 border-top filter-footer">
                            <button class="btn btn-success w-100" id="applyFilters">
                                {{__('common.apply_filters') }}
                            </button>
                        </div>
                </div>
                <!-- RIGHT RESULTS -->
                <div class="package-listing__results pb-4">

                    <!-- APPLIED CATEGORY PILLS -->
                    <div class="package-listing__results-header gap-2">
                        {{-- ALL --}}
                        <a href="{{ route('event.listing') }}" class="text-decoration-none">
                            <div
                                class="package-listing__results-applied-fil
                                {{ empty(request('categories')) ? 'success' : '' }}">
                                <p class="p-small">{{ __('events.all_events') }} </p>
                            </div>
                        </a>

                        @foreach ($categories as $category)
                            <a href="{{ route('event.listing') }}?categories[]={{ $category->id }}"
                                class="text-decoration-none">
                                <div
                                    class="package-listing__results-applied-fil
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
                                <span class="label">{{ __('common.sort_by') }}</span>
                                <span class="package-listing__results-sort-option fw-600" id="currentSortLabel">{{ __('common.none') }}</span>
                            </button>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" data-sort="popular">{{ __('common.popular') }}</a></li>
                                <li><a class="dropdown-item" href="#" data-sort="newest">{{ __('common.newest') }}</a></li>
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

            const search = document.getElementById('eventSearchInput')?.value || '';

            const cities = [...document.querySelectorAll('input[name="cities[]"]:checked')]
                .map(el => el.value);

            const categories = [...document.querySelectorAll('input[name="categories[]"]:checked')]
                .map(el => el.value);

            const event_date_to = document.querySelector('input[name="event_date_to"]')?.value || '';
            const event_date_from = document.querySelector('input[name="event_date_from"]')?.value || '';


            const params = new URLSearchParams();

            if (search.length >= 3) {
                params.set('search', search);
            }

            // set / remove params
            if (event_date_from) {
                params.set('event_date_from', event_date_from);
            } else {
                params.delete('event_date_from');
            }

            if (event_date_to) {
                params.set('event_date_to', event_date_to);
            } else {
                params.delete('event_date_to');
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
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
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

        //date filter
        document.querySelectorAll('input[type="date"]').forEach(input => {
            input.addEventListener('change', applyFilters);
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


<!-- chekc movi;e -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const filter   = document.querySelector('.package-listing__filter-section');
    const openBtn  = document.getElementById('openFilters');
    const closeBtn = document.getElementById('closeFilters');
    const applyBtn = document.getElementById('applyFilters');
    const searchBtn = document.getElementById('eventSearchBtn');

    function openFilter() {
        if (window.innerWidth > 768) return;
        filter.classList.add('active');
        document.body.classList.add('filter-open');
    }

    function closeFilter() {
        filter.classList.remove('active');
        document.body.classList.remove('filter-open');
    }

    openBtn?.addEventListener('click', openFilter);
    closeBtn?.addEventListener('click', closeFilter);
    applyBtn?.addEventListener('click', closeFilter);
    searchBtn?.addEventListener('click', closeFilter);
});
</script>
@endpush
