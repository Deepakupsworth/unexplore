@extends('frontend.layout')

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
                                                        <div class="pkg-details__day-plan-header pkg-details__common-block">
                                                            <!-- <div class="badge"> Macca</div> -->
                                                            <p class="badge primary-bg">Day {{ $day->day_number }}</p>
                                                            <p class="fw-600">
                                                                {{ $day->city?->translations?->first()?->name }}</p>
                                                        </div>

                                                        <div
                                                            class="pkg-details__day-plan-content pkg-details__common-block">

                                                            @foreach ($day->items->where('item_type', 'hotel') as $item)
                                                                {{-- @dd($item) --}}
                                                                <div class="accordion accordion-flush" id="hotelAccordion">
                                                                    <div
                                                                        class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                                        <div class="accordion-header">
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-center gap-3">
                                                                                <div
                                                                                    class="d-flex align-items-center gap-2">
                                                                                    <div class="accordion-icon"
                                                                                        data-bs-toggle="collapse"
                                                                                        data-bs-target="#hotelCollapse"
                                                                                        aria-expanded="true"
                                                                                        aria-controls="hotelCollapse">
                                                                                        <i
                                                                                            class="fa-solid fa-chevron-down"></i>
                                                                                    </div>
                                                                                    <p class="p-small fw-600">HOTEL</p>
                                                                                </div>
                                                                                {{-- <div class="vertical-divider"></div> --}}
                                                                                {{-- <p class="p-small">2 Nights</p> --}}
                                                                                {{-- <div class="vertical-divider"></div>
                                                                                <p class="p-small">In Riyadh</p> --}}
                                                                            </div>
                                                                            <div
                                                                                class="d-flex gap-2 pkg-details__accordion-actions">
                                                                                <button class="btn btn-primary btn-sm">
                                                                                    <i class="fa-solid fa-pencil"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>

                                                                        <div id="hotelCollapse"
                                                                            class="accordion-collapse collapse show"
                                                                            aria-labelledby="headingOne"
                                                                            data-bs-parent="#hotelAccordion">
                                                                            <div class="accordion-body">
                                                                                @php

                                                                                    $hotelImage = $item->hotel->thumb
                                                                                        ? asset(
                                                                                            'storage/' .
                                                                                                $item->hotel->thumb
                                                                                                    ->image_path,
                                                                                        )
                                                                                        : asset(
                                                                                            'frontend/assets/hotel-placeholder.jpg',
                                                                                        );
                                                                                @endphp
                                                                                {{-- @dd($item->hotel) --}}
                                                                                <div
                                                                                    class="d-flex align-items-center gap-3">
                                                                                    <img src="{{ $hotelImage }}"
                                                                                        alt="Transfer"
                                                                                        class="img-fluid pkg-details__tr-ht-img">

                                                                                    <div>
                                                                                        <div
                                                                                            class="pkg-details__star-ratings">

                                                                                            @for ($i = 1; $i <= 5; $i++)
                                                                                                <i
                                                                                                    class="fa-solid fa-star {{ $i <= $item->hotel->star_rating ? 'active' : 'text-muted' }}"></i>
                                                                                            @endfor

                                                                                        </div>
                                                                                        <p class="fw-600 my-1">
                                                                                            {{ $item->hotel->translation->name }}</p>
                                                                                        <p class="p-small text-light2">
                                                                                            <i
                                                                                                class="fa-solid fa-location-dot p-small"></i>
                                                                                                        {{ $item->hotel->location}}

                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach

                                                            @foreach ($day->items->where('item_type', 'todo') as $item)

                                                                <div class="accordion accordion-flush" id="todoAccordion">
                                                                    <div
                                                                        class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                                        <div class="accordion-header">
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-center gap-3">
                                                                                <div
                                                                                    class="d-flex align-items-center gap-2">
                                                                                    <div class="accordion-icon"
                                                                                        data-bs-toggle="collapse"
                                                                                        data-bs-target="#hotelCollapse"
                                                                                        aria-expanded="true"
                                                                                        aria-controls="hotelCollapse">
                                                                                        <i
                                                                                            class="fa-solid fa-chevron-down"></i>
                                                                                    </div>
                                                                                    <p class="p-small fw-600">ToDo Thing
                                                                                    </p>
                                                                                </div>
                                                                                {{-- <div class="vertical-divider"></div> --}}
                                                                                {{-- <p class="p-small">2 Nights</p> --}}
                                                                                {{-- <div class="vertical-divider"></div>
                                                                                <p class="p-small">In Riyadh</p> --}}
                                                                            </div>
                                                                            <div
                                                                                class="d-flex gap-2 pkg-details__accordion-actions">
                                                                                <button class="btn btn-primary btn-sm">
                                                                                    <i class="fa-solid fa-pencil"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>

                                                                        <div id="hotelCollapse"
                                                                            class="accordion-collapse collapse show"
                                                                            aria-labelledby="headingOne"
                                                                            data-bs-parent="#todoAccordion">
                                                                            <div class="accordion-body">


                                                                                <div
                                                                                    class="d-flex align-items-center gap-3">
                                                                                    <img src="{{ asset('storage/' . $item->todo->thumb->image_path) }}"
                                                                                        alt="Transfer"
                                                                                        class="img-fluid pkg-details__tr-ht-img">


                                                                                    <div>


                                                                                        <p class="fw-600 my-1">
                                                                                            {{ $item->todo->translation->name }}
                                                                                        </p>
                                                                                        <p class="p-small text-light2">
                                                                                            <i
                                                                                                class="fa-solid fa-location-dot p-small"></i>

                                                                                                {{ \App\Helpers\TimeHelper::range($item->todo->opening_time, $item->todo->closing_time) }}


                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach



                                                            @foreach ($day->items->where('item_type', 'event') as $item)
                                                                    {{-- @dd($item) --}}
                                                                <div class="accordion accordion-flush" id="eventAccordion">
                                                                    <div
                                                                        class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                                        <div class="accordion-header">
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-center gap-3">
                                                                                <div
                                                                                    class="d-flex align-items-center gap-2">
                                                                                    <div class="accordion-icon"
                                                                                        data-bs-toggle="collapse"
                                                                                        data-bs-target="#eventlCollapse"
                                                                                        aria-expanded="true"
                                                                                        aria-controls="eventlCollapse">
                                                                                        <i
                                                                                            class="fa-solid fa-chevron-down"></i>
                                                                                    </div>
                                                                                    <p class="p-small fw-600">Events
                                                                                    </p>
                                                                                </div>
                                                                                {{-- <div class="vertical-divider"></div> --}}
                                                                                {{-- <p class="p-small">2 Nights</p> --}}
                                                                                {{-- <div class="vertical-divider"></div>
                                                                                <p class="p-small">In Riyadh</p> --}}
                                                                            </div>
                                                                            <div
                                                                                class="d-flex gap-2 pkg-details__accordion-actions">
                                                                                <button class="btn btn-primary btn-sm">
                                                                                    <i class="fa-solid fa-pencil"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>

                                                                        <div id="eventCollapse"
                                                                            class="accordion-collapse collapse show"
                                                                            aria-labelledby="headingOne"
                                                                            data-bs-parent="#eventAccordion">
                                                                            <div class="accordion-body">


                                                                                <div
                                                                                    class="d-flex align-items-center gap-3">
                                                                                    <img src="{{ asset('storage/' . $item->event->thumb->image_path) }}"
                                                                                        alt="Transfer"
                                                                                        class="img-fluid pkg-details__tr-ht-img">

                                                                                    <div>

                                                                                        <p class="fw-600 my-1">
                                                                                            {{ $item->event->translation->title }}
                                                                                        </p>
                                                                                        <p class="p-small text-light2">
                                                                                            <i
                                                                                                class="fa-solid fa-location-dot p-small"></i>
                                                                                                {{-- {{$item->event->day}} --}}
                                                                                                {{\App\Helpers\DateHelper::format($item->event->start_date)}} <br/>
                                                                                                {{ \App\Helpers\TimeHelper::range($item->event->opening_time, $item->event->closing_time) }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach

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
@endsection
