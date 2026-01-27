@extends('frontend.layout')
<style>
    .selectable-card {
        cursor: pointer;
    }

    .selectable-card.active {
        border-color: #198754;
        background-color: #f6fffa;
    }
</style>
@section('content')
    @php

        $t = $package->translations->first();
        $price = $package->price;
        $persons = request('persons', 1);

        $totalPrice = ($price?->per_person_price ?? 0) * $persons;

        $cities = $package->cities->pluck('city.translations.0.name')->filter()->implode(' • ');

        $gallery = $package->gallery ?? collect();

        $coverImage =
            $package->thumb?->image_path ??
            (optional($gallery->first())->image_path ?? 'frontend/assets/package-details-banner.png');

        use Carbon\Carbon;

        $startDate = Carbon::parse($package->start_date); // MUST EXIST
        $endDate = $startDate->copy()->addDays($package->duration_nights);
    @endphp
    <section>
        <div class="container">
            <div class="gallery-wrapper swiper">
                <div class="swiper-wrapper  gallery-grid">
                    <!-- LEFT LARGE IMAGE -->
                    <div class="gallery-item gallery-item--large swiper-slide open-gallery">
                        <img class="img-fluid" src="{{ asset('storage/' . $package->thumb->image_path) }}" alt="">
                        <button class="view-gallery-btn" data-bs-toggle="modal" data-bs-target="#galleryModal">
                            <i class="fa-regular fa-image"></i>
                            VIEW GALLERY →
                        </button>
                    </div>

                    <!-- RIGHT GRID -->
                    <div class="gallery-middle swiper-slide">
                        <div class="d-flex flex-column gap-2">
                            <div class="gallery-item full open-gallery" data-open-tab="galleryTabsActivities"
                                data-bs-toggle="modal" data-bs-target="#galleryModal">
                                <img class="img-fluid" src="{{ asset('frontend/assets/package-banner.png') }}"
                                    alt="">
                                <p class="p-small">Activities & Sightseeing</p>
                            </div>
                        </div>

                        <div class="d-flex flex-column gap-2">
                            <div class="gallery-item half">
                                <!-- <img class="img-fluid" src="../assets/package-banner.png" alt=""> -->
                                <video controls>
                                    <source src="{{ asset('frontend/assets/videos/seekers-entry-video.mp4') }}"
                                        type="video/mp4">
                                </video>
                            </div>

                            <div class="gallery-item half open-gallery" data-open-tab="galleryTabsHighlights"
                                data-bs-toggle="modal" data-bs-target="#galleryModal">
                                <img class="img-fluid" src="{{ asset('frontend/assets/about-saudi.png') }}" alt="">
                                <p class="p-small">Package Highlights</p>
                            </div>

                        </div>
                    </div>

                    <div class="gallery-item gallery-item--large swiper-slide open-gallery"
                        data-open-tab="galleryTabsProperty" data-bs-toggle="modal" data-bs-target="#galleryModal">
                        <img class="img-fluid" src="{{ asset('frontend/assets/package-details-banner.png') }}"
                            alt="">
                        <p class="p-small">Property photos</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="pkg-details__wrapper mb-3">

                <div class="pkg-details">

                    {{-- HEADER --}}
                    <div class="section__header mt-4">
                        <div class="section__header-content">
                            <h2 class="section__heading">
                                {{ $t->title }}
                            </h2>

                            <div class="section__description d-flex gap-2 align-items-center">
                                <p>{{ $t->sub_title }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- TABS --}}
                    <ul class="nav nav-pills mt-3 pkg-details__tabs">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pkg-details__overview-tab" data-bs-toggle="pill"
                                data-bs-target="#explore-saudi__overview-tab-content" type="button" role="tab"
                                aria-controls="explore-saudi__overview-tab-content" aria-selected="true">Overview</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pkg-details__additional-tab" data-bs-toggle="pill"
                                data-bs-target="#explore-saudi__additional-tab-content" type="button" role="tab"
                                aria-controls="explore-saudi__additional-tab-content" aria-selected="false">Additional
                                Info</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-content">
                            <div class="tab-pane fade show active mt-4" id="explore-saudi__overview-tab-content"
                                role="tabpanel" aria-labelledby="pkg-details__overview-tab">
                                <div class="pkg-details__content-wrapper">
                                    <div class="pkg-details__day-plan">
                                        <div class="pkg-details__day-plan-left">
                                            <div class="pkg-details__day-plan-header pkg-details__common-block">Day Plan
                                            </div>
                                            <div class="pkg-details__day-dates-wrapper">
                                                <div
                                                    class="pkg-details__day-dates pkg-details__common-block d-flex gap-3 flex-column nav nav-tabs">
                                                    @foreach ($package->days as $day)
                                                        <div class="pkg-details__day-date-item rounded-pill {{ $loop->first ? 'active' : '' }}"
                                                            data-bs-toggle="tab"
                                                            data-bs-target="#day{{ $day->day_number }}">
                                                            <div class="dot"></div>
                                                            Day {{ $day->day_number }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pkg-details__day-plan-right">
                                            <div class="tab-content">

                                                @foreach ($package->days as $day)
                                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                                        id="day{{ $day->day_number }}">

                                                        {{-- Day Header --}}
                                                        <div class="pkg-details__day-plan-header pkg-details__common-block">
                                                            <p class="badge primary-bg">Day {{ $day->day_number }}</p>
                                                            <p class="fw-600">
                                                                {{ $day->city?->translations?->first()?->name }}
                                                            </p>
                                                        </div>

                                                        <div
                                                            class="pkg-details__day-plan-content pkg-details__common-block">

                                                            {{-- ================= HOTEL ================= --}}
                                                            @php
                                                                $sessionHotelIds =
                                                                    $sessionItems[$day->id]['hotel'] ?? null;

                                                                $hotels = $sessionHotelIds
                                                                    ? $allHotels->whereIn('id', $sessionHotelIds)
                                                                    : $day->items
                                                                        ->where('item_type', 'hotel')
                                                                        ->map(fn($i) => $i->hotel);
                                                            @endphp
                                                            {{-- @dd($hotels) --}}

                                                            @if ($hotels->count())
                                                                <div class="accordion accordion-flush mb-3"
                                                                    id="hotelAccordion{{ $day->id }}">
                                                                    <div
                                                                        class="accordion-item border rounded pkg-details__accordion-item">

                                                                        <div class="accordion-header">
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-center">
                                                                                <div
                                                                                    class="d-flex align-items-center gap-2">
                                                                                    <div class="accordion-icon"
                                                                                        data-bs-toggle="collapse"
                                                                                        data-bs-target="#hotelCollapse{{ $day->id }}">
                                                                                        <i
                                                                                            class="fa-solid fa-chevron-down"></i>
                                                                                    </div>
                                                                                    <p class="p-small fw-600">Hotel</p>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="d-flex gap-2 pkg-details__accordion-actions">
                                                                                <button type="button"
                                                                                    class="btn btn-primary btn-sm editDayItemsBtn"
                                                                                    data-day-id="{{ $day->id }}"
                                                                                    data-type="hotel"
                                                                                    data-selected="{{ $hotels->pluck('id')->join(',') }}"
>
                                                                                    <i class="fa-solid fa-pencil"></i>
                                                                                </button>

                                                                            </div>
                                                                        </div>

                                                                        <div id="hotelCollapse{{ $day->id }}"
                                                                            class="accordion-collapse collapse show"
                                                                            data-bs-parent="#hotelAccordion{{ $day->id }}">

                                                                            <div class="accordion-body"
                                                                                id="day-{{ $day->id }}-hotel-list">

                                                                                @foreach ($hotels as $hotel)
                                                                                    @php
                                                                                        $hotelImage = $hotel?->thumb
                                                                                            ? asset(
                                                                                                'storage/' .
                                                                                                    $hotel->thumb
                                                                                                        ->image_path,
                                                                                            )
                                                                                            : asset(
                                                                                                'frontend/assets/hotel-placeholder.jpg',
                                                                                            );
                                                                                    @endphp

                                                                                    <div
                                                                                        class="d-flex align-items-center gap-3 mb-3">
                                                                                        <img src="{{ $hotelImage }}"
                                                                                            class="pkg-details__tr-ht-img">

                                                                                        <div>
                                                                                            <div
                                                                                                class="pkg-details__star-ratings">
                                                                                                @for ($i = 1; $i <= 5; $i++)
                                                                                                    <i
                                                                                                        class="fa-solid fa-star {{ $i <= $hotel->star_rating ? 'active' : 'text-muted' }}"></i>
                                                                                                @endfor
                                                                                            </div>

                                                                                            <p class="fw-600 my-1">
                                                                                                {{ $hotel->translation?->name }}
                                                                                            </p>

                                                                                            <p class="p-small text-light2">
                                                                                                <i
                                                                                                    class="fa-solid fa-location-dot"></i>
                                                                                                {{ $hotel->location }}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach

                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            @endif

                                                            {{-- ================= TODO ================= --}}
                                                            @php
                                                                $sessionTodoIds =
                                                                    $sessionItems[$day->id]['todo'] ?? null;

                                                                $todos = $sessionTodoIds
                                                                    ? $allTodos->whereIn('id', $sessionTodoIds)
                                                                    : $day->items->where('item_type', 'todo')->map
                                                                        ->todo;
                                                            @endphp

                                                            @if ($todos->count())
                                                                <div class="accordion accordion-flush mb-3"
                                                                    id="todoAccordion{{ $day->id }}">
                                                                    <div
                                                                        class="accordion-item border rounded pkg-details__accordion-item">

                                                                        <div class="accordion-header">
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-center">
                                                                                <div
                                                                                    class="d-flex align-items-center gap-2">
                                                                                    <div class="accordion-icon"
                                                                                        data-bs-toggle="collapse"
                                                                                        data-bs-target="#todoCollapse{{ $day->id }}">
                                                                                        <i
                                                                                            class="fa-solid fa-chevron-down"></i>
                                                                                    </div>
                                                                                    <p class="p-small fw-600">ToDo Thing
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="d-flex gap-2 pkg-details__accordion-actions">
                                                                                <button type="button"
                                                                                    class="btn btn-primary btn-sm editDayItemsBtn"
                                                                                    data-day-id="{{ $day->id }}"
                                                                                    data-type="todo"
                                                                                    data-selected="{{ $todos->pluck('id')->join(',') }}">
                                                                                    <i class="fa-solid fa-pencil"></i>
                                                                                </button>

                                                                            </div>
                                                                        </div>

                                                                        <div id="todoCollapse{{ $day->id }}"
                                                                            class="accordion-collapse collapse show"
                                                                            data-bs-parent="#todoAccordion{{ $day->id }}">

                                                                            <div class="accordion-body"
                                                                                id="day-{{ $day->id }}-todo-list">

                                                                                @foreach ($todos as $todo)
                                                                                    <div class="d-flex gap-3 mb-3">
                                                                                        <img src="{{ $todo->thumb ? asset('storage/' . $todo->thumb->image_path) : asset('frontend/assets/hotel-placeholder.jpg') }}"
                                                                                            class="pkg-details__tr-ht-img">

                                                                                        <div>
                                                                                            <p class="fw-600">
                                                                                                {{ $todo->translation->name }}
                                                                                            </p>
                                                                                            <p class="p-small text-light2">
                                                                                                <i class="fa fa-clock"></i>
                                                                                                {{ $todo->opening_time }} -
                                                                                                {{ $todo->closing_time }}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            @endif

                                                            {{-- ================= EVENT ================= --}}
                                                            @php
                                                                $sessionEventIds =
                                                                    $sessionItems[$day->id]['event'] ?? null;

                                                                $events = $sessionEventIds
                                                                    ? $allEvents->whereIn('id', $sessionEventIds)
                                                                    : $day->items->where('item_type', 'event')->map
                                                                        ->event;
                                                            @endphp

                                                            @if ($events->count())
                                                                <div class="accordion accordion-flush mb-3"
                                                                    id="eventAccordion{{ $day->id }}">
                                                                    <div
                                                                        class="accordion-item border rounded pkg-details__accordion-item">

                                                                        <div class="accordion-header">
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-center">
                                                                                <div
                                                                                    class="d-flex align-items-center gap-2">
                                                                                    <div class="accordion-icon"
                                                                                        data-bs-toggle="collapse"
                                                                                        data-bs-target="#eventCollapse{{ $day->id }}">
                                                                                        <i
                                                                                            class="fa-solid fa-chevron-down"></i>
                                                                                    </div>
                                                                                    <p class="p-small fw-600">Events</p>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="d-flex gap-2 pkg-details__accordion-actions">
                                                                                <button type="button"
                                                                                    class="btn btn-primary btn-sm editDayItemsBtn"
                                                                                    data-day-id="{{ $day->id }}"
                                                                                    data-type="event"
                                                                                    data-selected="{{ $events->pluck('id')->join(',') }}">
                                                                                    <i class="fa-solid fa-pencil"></i>
                                                                                </button>

                                                                            </div>
                                                                        </div>

                                                                        <div id="eventCollapse{{ $day->id }}"
                                                                            class="accordion-collapse collapse show"
                                                                            data-bs-parent="#eventAccordion{{ $day->id }}">

                                                                            <div class="accordion-body"
                                                                                id="day-{{ $day->id }}-event-list">

                                                                                @foreach ($events as $event)
                                                                                    <div class="d-flex gap-3 mb-3">
                                                                                        <img src="{{ $event->thumb ? asset('storage/' . $event->thumb->image_path) : asset('frontend/assets/hotel-placeholder.jpg') }}"
                                                                                            class="pkg-details__tr-ht-img">

                                                                                        <div>
                                                                                            <p class="fw-600">
                                                                                                {{ $event->translation->title }}
                                                                                            </p>
                                                                                            <p class="p-small text-light2">
                                                                                                <i
                                                                                                    class="fa fa-calendar"></i>
                                                                                                {{ \App\Helpers\DateHelper::format($event->start_date) }}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="pkg-details__content-wrapper mt-4">
                                    @php
                                        $translation = $package->translations
                                            ->where('language_code', app()->getLocale())
                                            ->first();
                                    @endphp

                                    @if ($translation && $translation->description)
                                        {!! $translation->description !!}
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="explore-saudi__additional-tab-content" role="tabpanel"
                                aria-labelledby="pkg-details__additional-tab">
                                <div class="pkg-details__content-wrapper mt-4">
                                    <p class="p-large fw-bold">Additional Info</p>
                                    <div class="pkg-details__additional-info mt-3">


                                        @foreach ($package->infos as $info)
                                            <div class="pkg-details__additional-info-item">
                                                <p class="fw-bold pkg-details__additional-info-item-header">
                                                    {{ $info->translation->title }}</p>
                                                {{-- <ul class="pkg-details__additional-info-item-list m-0">
                                                    <li>The deal is valid for travel till 30th September 2025.</li>
                                                </ul> --}}
                                                {!! $info->translation->content !!}

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade mt-4" id="additional">
                            {!! $t->additional_info ?? '' !!}
                        </div>

                    </div>
                </div>


                <div class="pkg-details__pricing mt-4">
                    <div class="card pkg-details__pricing-card">
                        @if ($package->price->discount_price)
                            <p class="fw-500">Starting from</p>
                            <div class="d-flex align-items-center gap-1">
                                <img src="{{ asset('frontend/assets/icons/riyal-light.svg') }}" alt="Riyal">
                                <p class="text-decoration-line-through fw-600 text-light2">
                                    {{ $package->price->discount_price }}</p>
                            </div>
                        @endif

                        <div class="d-flex align-items-center gap-1">
                            <img src="{{ asset('frontend/assets/icons/riyal-primary.svg') }}" alt="Riyal">
                            <h5 class="text-success fw-bold">{{ $package->price->per_person_price }}</h5>
                            <p class="text-light2 fw-500">Per Person</p>
                        </div>

                        <button class="btn btn-primary justify-content-center pkg-details__book-now-btn my-2">
                            Book Now
                        </button>

                        <div class="fw-500 text-light2 d-flex align-items-center gap-1">
                            <p>Total Price: </p>
                            <img src="{{ asset('frontend/assets/icons/riyal-light.svg') }}" alt="Riyal">
                            <p>{{ $package->price->original_price }}</p>
                        </div>

                        <!-- Decorative line -->
                        <div class="pkg-details__decorative-line my-3">
                            <img src="{{ asset('frontend/assets/decorative-line.png') }}" alt="Decorative Line"
                                class="img-fluid w-100">
                        </div>

                        <!-- Duration -->
                        <div class="pkg-details__additional-info-item py-2 px-3 d-flex align-items-center gap-2 mb-2">
                            <i class="fa-solid fa-clock primary-text"></i>
                            <div class="">
                                <p class="text-light2">Duration:</p>
                                <p class="fw-600 p-large">{{ $package->duration_nights }} Nights &
                                    {{ $package->duration_days }} Days</p>
                            </div>
                        </div>

                        <!-- Places to Visit -->
                        <div class="pkg-details__additional-info-item py-2 px-3 d-flex align-items-center gap-2 mt-2">
                            <i class="fa-solid fa-location-dot primary-text"></i>
                            <div class="">
                                <p class="text-light2">Places to Visit:</p>
                                <p class="fw-600 p-large">2N Bujairi</p>
                            </div>
                        </div>
                    </div>

                    <div class="card pkg-details__pricing-card mt-3">
                        <p class="p-large">Do you have questions or need more information?</p>
                        <button class="btn btn-outline-secondary rounded-pill fw-600 mt-3 pkg-details__get-more-help-btn">
                            Get More Help
                        </button>
                    </div>

                    <div class="mt-4">
                        <p>Share</p>
                        <div class="mt-2 pkg-details__share-icons">
                            <a href="#" class="flex-center">
                                <img src="{{ asset('frontend/assets/icons/instagram.svg') }}" alt="Instagram">
                            </a>
                            <a href="#" class="flex-center">
                                <img src="{{ asset('frontend/assets/icons/facebook.svg') }}" alt="Facebook">
                            </a>
                            <a href="#" class="flex-center">
                                <img src="{{ asset('frontend/assets/icons/facebook.svg') }}" alt="Facebook">
                            </a>
                            <a href="#" class="flex-center">
                                <img src="{{ asset('frontend/assets/icons/x.svg') }}" alt="X">
                            </a>
                            <a href="#" class="flex-center">
                                <img src="{{ asset('frontend/assets/icons/share.svg') }}" alt="Share">
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- VIEW GALLERY MODAL -->
    <div class="modal fade" id="galleryModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content gallery-modal">
                <div class="container">
                    <!-- HEADER -->
                    <div class="modal-header border-0 px-0 pt-5 pb-0">
                        <h4 class="fw-bold mb-0">Andaman with Freebies</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="gallery-sticky-header pt-4">
                        <!-- CATEGORY TABS -->
                        <ul class="nav nav-tabs gallery-tabs" id="galleryTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-target="galleryTabsDestination" type="button"
                                    role="tab">
                                    Around the Destination
                                    <small class="d-block text-light2 fw-normal">9 Photos</small>
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-target="galleryTabsProperty" type="button"
                                    role="tab">
                                    Property Photos
                                    <small class="d-block text-light2 fw-normal">170 Photos</small>
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-target="galleryTabsActivities" type="button"
                                    role="tab">
                                    Activities & Sightseeing
                                    <small class="d-block text-light2 fw-normal">20 Photos</small>
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-target="galleryTabsHighlights" type="button"
                                    role="tab">
                                    Package Highlights
                                    <small class="d-block text-light2 fw-normal">3 Photos</small>
                                </button>
                            </li>
                        </ul>

                        <hr class="my-3">

                        <!-- FILTER PILLS -->
                        <!-- PILLS FOR TAB 1 -->
                        <div class="gallery-section-pills" data-tab="galleryTabsDestination">
                            <button class="filter-pill active" data-section="video">Video</button>
                            <button class="filter-pill" data-section="port-blair">Port Blair</button>
                            <button class="filter-pill" data-section="havelock">Havelock</button>
                            <button class="filter-pill" data-section="neil">Neil Island</button>
                        </div>

                        <!-- PILLS FOR TAB 2 -->
                        <div class="gallery-section-pills d-none" data-tab="galleryTabsProperty">
                            <button class="filter-pill active" data-section="rooms">Rooms</button>
                            <button class="filter-pill" data-section="lobby">Lobby</button>
                        </div>

                        <!-- PILLS FOR TAB 3 -->
                        <div class="gallery-section-pills d-none" data-tab="galleryTabsActivities">
                            <button class="filter-pill active" data-section="scuba">Scuba</button>
                            <button class="filter-pill" data-section="sightseeing">Sightseeing</button>
                            <button class="filter-pill" data-section="boat">Boat Ride</button>
                        </div>

                        <!-- PILLS FOR TAB 4 -->
                        <div class="gallery-section-pills d-none" data-tab="galleryTabsHighlights">
                            <button class="filter-pill active" data-section="meals">Meals</button>
                            <button class="filter-pill" data-section="hotel">Hotel</button>
                        </div>

                        <hr class="my-3">
                    </div>

                    <!-- CONTENT -->
                    <div class="modal-body px-0 pt-0 gallery-tab-content-wrapper">
                        <div class="gallery-tab-content active" id="galleryTabsDestination">
                            <div class="gallery-modal-section" data-section="video">
                                <!-- VIDEO SECTION -->
                                <h5 class="fw-bold">Around the Destination</h5>
                                <p class="text-muted small mt-1 mb-3">Video</p>

                                <div class="gallery-video mb-4">
                                    <video controls>
                                        <source src="../assets/videos/seekers-entry-video.mp4" type="video/mp4">
                                    </video>
                                </div>
                            </div>

                            <div class="gallery-modal-section" data-section="port-blair">
                                <!-- IMAGE GRID PLACEHOLDER -->
                                <h5 class="fw-bold">Around the Destination</h5>
                                <p class="text-muted small mt-1 mb-3">Port Blair</p>

                                <div class="gallery-image-grid">
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="{{ asset('frontend/assets/attraction-1.png') }}"
                                            alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="{{ asset('frontend/assets/attraction-1.png') }}"
                                            alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="{{ asset('frontend/assets/attraction-1.png') }}"
                                            alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="{{ asset('frontend/assets/attraction-1.png') }}"
                                            alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="gallery-modal-section" data-section="havelock">
                                <!-- IMAGE GRID PLACEHOLDER -->
                                <h5 class="fw-bold">Around the Destination</h5>
                                <p class="text-muted small mt-1 mb-3">Havelock</p>

                                <div class="three-gallery-image">
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="{{ asset('frontend/assets/attraction-1.png') }}"
                                            alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="{{ asset('frontend/assets/attraction-1.png') }}"
                                            alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="{{ asset('frontend/assets/attraction-1.png') }}"
                                            alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="gallery-modal-section" data-section="neil">
                                <!-- IMAGE GRID PLACEHOLDER -->
                                <h5 class="fw-bold">Around the Destination</h5>
                                <p class="text-muted small mt-1 mb-3">Port Blair</p>

                                <div class="five-gallery-image">
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="{{ asset('frontend/assets/attraction-1.png') }}"
                                            alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="{{ asset('frontend/assets/attraction-1.png') }}"
                                            alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="{{ asset('frontend/assets/attraction-1.png') }}"
                                            alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="{{ asset('frontend/assets/attraction-1.png') }}"
                                            alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="{{ asset('frontend/assets/attraction-1.png') }}"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="gallery-tab-content" id="galleryTabsProperty">
                            <div class="gallery-modal-section" data-section="rooms">
                                <!-- VIDEO SECTION -->
                                <h5 class="fw-bold">Around the Destination</h5>
                                <p class="text-muted small mt-1 mb-3">Video</p>

                                <div class="gallery-video mb-4">
                                    <video controls>
                                        <source src="{{ asset('frontend/assets/videos/seekers-entry-video.mp4') }}"
                                            type="video/mp4">
                                    </video>
                                </div>
                            </div>

                            <div class="gallery-modal-section" data-section="lobby">
                                <!-- IMAGE GRID PLACEHOLDER -->
                                <h5 class="fw-bold">Around the Destination</h5>
                                <p class="text-muted small mt-1 mb-3">Lobby</p>

                                <div class="gallery-image-grid">
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="{{ asset('frontend/assets/attraction-1.png') }}"
                                            alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="{{ asset('frontend/assets/attraction-1.png') }}"
                                            alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="{{ asset('frontend/assets/attraction-1.png') }}"
                                            alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="{{ asset('frontend/assets/attraction-1.png') }}"
                                            alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="{{ asset('frontend/assets/attraction-1.png') }}"
                                            alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="{{ asset('frontend/assets/attraction-1.png') }}"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="gallery-tab-content" id="galleryTabsActivities">
                            <div class="gallery-modal-section" data-section="scuba">
                                <!-- VIDEO SECTION -->
                                <h5 class="fw-bold">Around the Destination</h5>
                                <p class="text-muted small mt-1 mb-3">Video</p>

                                <div class="gallery-video mb-4">
                                    <video controls>
                                        <source src="../assets/videos/seekers-entry-video.mp4" type="video/mp4">
                                    </video>
                                </div>
                            </div>

                            <div class="gallery-modal-section" data-section="sightseeing">
                                <!-- IMAGE GRID PLACEHOLDER -->
                                <h5 class="fw-bold">Around the Destination</h5>
                                <p class="text-muted small mt-1 mb-3">Lobby</p>

                                <div class="gallery-image-grid">
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="../assets/attraction-1.png" alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="../assets/attraction-1.png" alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="../assets/attraction-1.png" alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="../assets/attraction-1.png" alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="../assets/attraction-1.png" alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="../assets/attraction-1.png" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="gallery-modal-section" data-section="boat">
                                <!-- IMAGE GRID PLACEHOLDER -->
                                <h5 class="fw-bold">Around the Destination</h5>
                                <p class="text-muted small mt-1 mb-3">Lobby</p>

                                <div class="gallery-image-grid">
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="../assets/attraction-1.png" alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="../assets/attraction-1.png" alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="../assets/attraction-1.png" alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="../assets/attraction-1.png" alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="../assets/attraction-1.png" alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="../assets/attraction-1.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="gallery-tab-content" id="galleryTabsHighlights">
                            <div class="gallery-modal-section" data-section="meals">
                                <!-- VIDEO SECTION -->
                                <h5 class="fw-bold">Around the Destination</h5>
                                <p class="text-muted small mt-1 mb-3">Video</p>

                                <div class="gallery-video mb-4">
                                    <video controls>
                                        <source src="../assets/videos/seekers-entry-video.mp4" type="video/mp4">
                                    </video>
                                </div>
                            </div>

                            <div class="gallery-modal-section" data-section="hotel">
                                <!-- IMAGE GRID PLACEHOLDER -->
                                <h5 class=" fw-bold">Around the Destination</h5>
                                <p class="text-muted small mt-1 mb-3">Lobby</p>

                                <div class="gallery-image-grid">
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="../assets/attraction-1.png" alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="../assets/attraction-1.png" alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="../assets/attraction-1.png" alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="../assets/attraction-1.png" alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="../assets/attraction-1.png" alt="">
                                    </div>
                                    <div class="gallery-img-box">
                                        <img class="img-fluid" src="../assets/attraction-1.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editDayItemsModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Day Items</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="editDayItemsForm">
                        @csrf
                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                        <input type="hidden" name="day_id" id="modalDayId">
                        <input type="hidden" name="item_type" id="modalItemType">

                        <div class="row g-3" id="modalItemsWrapper"></div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="saveDayItemsBtn">Save</button>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            /* ===========================
               GLOBAL DATA
            =========================== */
            window.allItems = {
                hotel: @json($allHotels),
                todo: @json($allTodos),
                event: @json($allEvents),
            };

            /* ===========================
               HELPERS
            =========================== */
            function getImage(item) {
                return item?.thumb?.image_path ?
                    `/storage/${item.thumb.image_path}` :
                    '/frontend/assets/hotel-placeholder.jpg';
            }

            function getTitle(item) {
                return (
                    item?.translation?.name ||
                    item?.translation?.title ||
                    item?.translations?.[0]?.name ||
                    item?.translations?.[0]?.title ||
                    'N/A'
                );
            }

            /* ===========================
               CARD TEMPLATE (RADIO)
            =========================== */
            function cardTemplate(item, checked, meta) {
                return `
    <div class="col-md-6">
      <div class="border rounded p-2 d-flex gap-3 selectable-card ${checked ? 'active' : ''}">
        <input type="radio"
               name="items[]"
               value="${item.id}"
               class="d-none"
               ${checked ? 'checked' : ''}>

        <img src="${getImage(item)}" class="pkg-details__tr-ht-img">

        <div class="flex-grow-1">
          <p class="fw-600 mb-1">${getTitle(item)}</p>
          <p class="p-small text-light2">${meta}</p>
        </div>

        <div class="radio-icon">
          <i class="fa-regular fa-circle ${checked ? 'd-none' : ''}"></i>
          <i class="fa-solid fa-circle-dot text-success ${checked ? '' : 'd-none'}"></i>
        </div>
      </div>
    </div>`;
            }


            function hotelCard(item, checked, group) {
                return cardTemplate(
                    item,
                    checked,
                    `<i class="fa fa-location-dot"></i> ${item.location ?? ''}`,
                    group
                );
            }

            function todoCard(item, checked, group) {
                return cardTemplate(
                    item,
                    checked,
                    `<i class="fa fa-clock"></i> ${item.opening_time} - ${item.closing_time}`,
                    group
                );
            }

            function eventCard(item, checked, group) {
                return cardTemplate(
                    item,
                    checked,
                    `<i class="fa fa-calendar"></i> ${item.start_date}`,
                    group
                );
            }

            /* ===========================
               MAIN LOGIC
            =========================== */
            document.addEventListener('DOMContentLoaded', () => {

                const modalEl = document.getElementById('editDayItemsModal');
                const modal = new bootstrap.Modal(modalEl);

                /* ---------- OPEN MODAL ---------- */
                document.querySelectorAll('.editDayItemsBtn').forEach(btn => {
    btn.addEventListener('click', () => {

        const type  = btn.dataset.type;
        const dayId = btn.dataset.dayId;

        // ✅ FIX IS HERE
        const selected = btn.dataset.selected
            ? btn.dataset.selected.split(',').map(id => parseInt(id))
            : [];

        const groupName = `day_${dayId}_${type}`;

        modalDayId.value    = dayId;
        modalItemType.value = type;
        modalItemsWrapper.innerHTML = '';

        window.allItems[type].forEach(item => {
            const checked = selected.includes(item.id);

            if (type === 'hotel')
                modalItemsWrapper.innerHTML += hotelCard(item, checked, groupName);

            if (type === 'todo')
                modalItemsWrapper.innerHTML += todoCard(item, checked, groupName);

            if (type === 'event')
                modalItemsWrapper.innerHTML += eventCard(item, checked, groupName);
        });

        modal.show();
    });
});


                /* ---------- RADIO CLICK (MODAL SCOPE ONLY) ---------- */
                modalEl.addEventListener('click', e => {
                    const card = e.target.closest('.selectable-card');
                    if (!card) return;

                    const wrapper = card.closest('#modalItemsWrapper');

                    wrapper.querySelectorAll('.selectable-card').forEach(c => {
                        c.classList.remove('active');
                        c.querySelector('input[type="radio"]').checked = false;
                        c.querySelector('.fa-circle').classList.remove('d-none');
                        c.querySelector('.fa-circle-dot').classList.add('d-none');
                    });

                    card.classList.add('active');
                    card.querySelector('input[type="radio"]').checked = true;
                    card.querySelector('.fa-circle').classList.add('d-none');
                    card.querySelector('.fa-circle-dot').classList.remove('d-none');
                });

                /* ---------- SAVE ---------- */
                saveDayItemsBtn.addEventListener('click', () => {
                    fetch("{{ route('package.day.items.session') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: new FormData(editDayItemsForm)
                        })
                        .then(res => res.json())
                        .then(() => location.reload());
                });

            });
        </script>
    @endpush
@endsection
