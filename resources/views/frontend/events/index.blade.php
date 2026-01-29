@extends('frontend.layout')

@section('content')

<!-- 1. EVENTS SEARCH: BANNER -->
<section class="package-listing__banner">
    <div class="container">
        <div class="package-listing__banner-content text-center">
            <h1 class="package-listing__banner-heading h2">
                {{ __('events.banner.title') }}
            </h1>
            <p>{{ __('events.banner.description') }}</p>
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
                    <h6>{{ __('events.filters.title') }}</h6>
                </div>

                <div class="package-listing__filter-items">

                    <!-- SEARCH -->
                    <div class="package-listing__filter-item">
                        <p class="p-large package-listing__filter-title">
                            {{ __('events.filters.search') }}
                        </p>
                        <div class="input-group mb-3 package-listing__search-bar">
                            <input type="text"
                                   class="form-control"
                                   placeholder="{{ __('events.filters.search_placeholder') }}">
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
                                    {{ __('events.filters.type') }}
                                </button>
                            </p>

                            <div class="accordion-body">
                                <div class="package-listing__budget-filter-list">

                                    <!-- Things To Do -->
                                    <a href="{{ route('things.to.do') }}" class="text-decoration-none">
                                        <div class="package-listing__budget-filter-option package-listing__budget-button">
                                            <label>
                                                <span class="option-text">
                                                    {{ __('events.filters.type_things') }}
                                                </span>
                                            </label>
                                        </div>
                                    </a>

                                    <!-- Events -->
                                    <a href="{{ route('event.listing') }}" class="text-decoration-none">
                                        <div class="package-listing__budget-filter-option package-listing__budget-button active">
                                            <label>
                                                <span class="option-text">
                                                    {{ __('events.filters.type_events') }}
                                                </span>
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
                                    {{ __('events.filters.categories') }}
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
                                    {{ __('events.filters.destinations') }}
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
                            <span class="label">{{ __('events.sort.label') }}</span>
                            <span class="package-listing__results-sort-option fw-600"
                                  id="currentSortLabel">
                                {{ __('events.sort.none') }}
                            </span>
                        </button>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="#" data-sort="popular">
                                    {{ __('events.sort.popular') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" data-sort="newest">
                                    {{ __('events.sort.newest') }}
                                </a>
                            </li>
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
