@extends('frontend.layout')

@section('content')


<style>
    .selectable-card {
        cursor: pointer;
    }

    .selectable-card.active {
        border-color: #198754;
        background-color: #f6fffa;
    }


    .selectable-card-wrapper{
        cursor: pointer;
    }

    .selectable-card-wrapper.active {
        border-color: #198754;
        background-color: #f6fffa;
    }
</style>

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
    {{-- @dd($package) --}}
    @include('frontend.packages.partials.filter-bar', [
        'package' => $package
    ])
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
                                                                $sessionHotelIds = $sessionItems[$day->id]['hotel'] ?? null;

                                                                if ($sessionHotelIds) {
                                                                    // session exists → show selected
                                                                    $hotels = $allHotels->whereIn('id', array_values($sessionHotelIds));
                                                                } else {
                                                                    // first time → show package default
                                                                    $hotels = $day->items
                                                                        ->where('item_type', 'hotel')
                                                                        ->map(fn($i) => $i->hotel);
                                                                }

                                                                $slot = 0;
                                                            @endphp
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

                                                                                <!-- <button
                                                                                type="button"
                                                                                class="btn btn-primary btn-sm editDayItemsBtn"
                                                                                data-day-id="{{ $day->id }}"
                                                                                data-type="hotel"
                                     >
                                                                                <i class="fa-solid fa-pencil"></i>
                                                                            </button> -->




                                                                            </div>
                                                                        </div>

                                                                        <div id="hotelCollapse{{ $day->id }}"
                                                                            class="accordion-collapse collapse show"
                                                                            data-bs-parent="#hotelAccordion{{ $day->id }}">

                                                                            <div class="accordion-body"
                                                                                id="day-{{ $day->id }}-hotel-list">
                                                                                @php
                                                                                $hotel_slot = 0;
                                                                                 @endphp
                                                                                @foreach ($hotels as $index => $hotel)


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
                                                                                    <div class="day-item-slot d-flex position-relative"
                                                                                        data-day-id="{{ $day->id }}"
                                                                                        data-type="hotel"
                                                                                        data-index="{{ $hotel_slot  }}">
                                                                                    <div
                                                                                        class="day-item-wrapper"
                                                                                        data-day-id="{{ $day->id }}"
                                                                                        data-type="hotel"
                                                                                        data-item-id="{{ $hotel->id }}"
                                                                                        data-default-item-id="{{ $hotel->id }}"
                                                                                        data-index="{{ $hotel_slot }}"
                                                                                        >
                                                                                    <div
                                                                                        class="d-flex align-items-center gap-3 mb-3 ">
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
                                                                                 </div>
                                                                                 @if($package->package_type !== 'fixed')
                                                                                 <button
                                                                            type="button"
                                                                            class="btn btn-primary btn-sm position-absolute top-0 end-0 m-2 editDayItemsBtn"
                                                                            data-day-id="{{ $day->id }}"
                                                                            data-type="hotel"
                                                                            data-item-id="{{ $hotel->id }}"
                                                                            data-index="{{ $hotel_slot }}"
                                                                        >
                                                                            <i class="fa-solid fa-pencil"></i>
                                                                        </button>
                                                                        @endif
                                                            </div>
                                                            @php
                                                                                $hotel_slot++;
                                                                                 @endphp
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
                                                                                <!-- <button type="button"
                                                                                    class="btn btn-primary btn-sm editDayItemsBtn"
                                                                                    data-day-id="{{ $day->id }}"
                                                                                    data-type="todo"
                                                                                    data-selected="{{ $todos->pluck('id')->join(',') }}">
                                                                                    <i class="fa-solid fa-pencil"></i>
                                                                                </button> -->

                                                                            </div>
                                                                        </div>

                                                                        <div id="todoCollapse{{ $day->id }}"
                                                                            class="accordion-collapse collapse show"
                                                                            data-bs-parent="#todoAccordion{{ $day->id }}">

                                                                            <div class="accordion-body"
                                                                                id="day-{{ $day->id }}-todo-list">

                                                                                @php
                                                                                $todo_slot = 0;
                                                                                 @endphp

                                                                                @foreach ($todos as $index => $todo)
                                                                                <div class="day-item-slot d-flex position-relative"
                                                                                        data-day-id="{{ $day->id }}"
                                                                                        data-type="todo"
                                                                                        data-index="{{ $todo_slot  }}">
                                                                                <div
                                                                                        class="day-item-wrapper"
                                                                                        data-day-id="{{ $day->id }}"
                                                                                        data-type="todo"
                                                                                        data-item-id="{{ $todo->id }}"
                                                                                        data-index="{{ $todo_slot }}"
                                                                                    >
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
                                                                                </div>
                                                                                @if($package->package_type !== 'fixed')
                                                                                <button
                                                                            type="button"
                                                                            class="btn btn-primary btn-sm position-absolute top-0 end-0 m-2 editDayItemsBtn"
                                                                            data-day-id="{{ $day->id }}"
                                                                            data-type="todo"
                                                                            data-item-id="{{ $todo->id }}"
                                                                            data-index="{{ $todo_slot }}"
                                                                        >
                                                                            <i class="fa-solid fa-pencil"></i>
                                                                        </button>
                                                                        @endif
                                                                    </div>
                                                                    @php
                                                                                $todo_slot++;
                                                                                 @endphp

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
                                                                                <!-- <button type="button"
                                                                                    class="btn btn-primary btn-sm editDayItemsBtn"
                                                                                    data-day-id="{{ $day->id }}"
                                                                                    data-type="event"
                                                                                    data-selected="{{ $events->pluck('id')->join(',') }}">
                                                                                    <i class="fa-solid fa-pencil"></i>
                                                                                </button> -->

                                                                            </div>
                                                                        </div>

                                                                        <div id="eventCollapse{{ $day->id }}"
                                                                            class="accordion-collapse collapse show"
                                                                            data-bs-parent="#eventAccordion{{ $day->id }}">

                                                                            <div class="accordion-body"
                                                                                id="day-{{ $day->id }}-event-list">
                                                                                @php
                                                                                $event_slot = 0;
                                                                                 @endphp

                                                                                @foreach ($events as $index => $event)
                                                                                <div class="day-item-slot d-flex position-relative"
                                                                                        data-day-id="{{ $day->id }}"
                                                                                        data-type="event"
                                                                                        data-index="{{ $event_slot  }}">
                                                                                <div
                                                                                        class="day-item-wrapper"
                                                                                        data-day-id="{{ $day->id }}"
                                                                                        data-type="event"
                                                                                        data-item-id="{{ $event->id }}"
                                                                                        data-index="{{ $event_slot }}"
                                                                                    >
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
                                                                                </div>
                                                                                @if($package->package_type !== 'fixed')
                                                                                    <button
                                                                            type="button"
                                                                            class="btn btn-primary position-absolute top-0 end-0 m-2 editDayItemsBtn"
                                                                            data-day-id="{{ $day->id }}"
                                                                            data-type="event"
                                                                            data-item-id="{{ $event->id }}"
                                                                            data-index="{{ $event_slot }}"
                                                                        >
                                                                            <i class="fa-solid fa-pencil"></i>
                                                                        </button>
                                                                        @endif

                                                                        @php
                                                                                $event_slot++;
                                                                                 @endphp
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

                        {{-- <a href="{{route('checkout.view')}}" class="btn btn-primary justify-content-center pkg-details__book-now-btn my-2">
                            Book Now
                        </a> --}}

                        <form action="{{ route('checkout.init') }}" method="POST" id="packageCheckoutForm">

                            {{-- 🔒 CSRF not required for GET, but ok if POST --}}
                            @csrf
                            <input type="hidden" name="slug" value="{{ $package->slug }}">
                            <button
                                type="submit"
                                class="btn btn-primary justify-content-center pkg-details__book-now-btn my-2">
                                Book Now
                            </button>

                        </form>


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


    <div class="offcanvas offcanvas-end" id="dayItemModal" tabindex="-1">
            <div class="modal-header">
                <h5 class="modal-title" id="dayItemModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body side-drawer__booking-body">
                <div id="dayItemList" class="row g-3"></div>
            </div>
            <div class="offcanvas-footer border-top text-end p-3">
                <button id="saveDayItems" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="offcanvas">Save</button>
            </div>

</div>


    <!-- Modal -->
    <div class="modal fade" id="packageFilterModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex gap-2">
                        <button type="button" class="pkg-fil-modal__close-btn" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                        <h5 class="modal-title" id="exampleModalLabel">Edit Your Search</h5>
                    </div>
                </div>
                <div class="modal-body pkg-fil-modal-body">
                    <div class="row gx-2 mb-2">
                        <div class="col-6">
                            <div class="pkg-fil-bar__input-wrapper flex-center">
                                <label>Starting From</label>
                                <input type="text" value="" placeholder="Enter...">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pkg-fil-bar__input-wrapper flex-center">
                                <label>Going to</label>
                                <input type="text" value="" placeholder="Enter...">
                            </div>
                        </div>
                    </div>
                    <div class="pkg-fil-bar__input-wrapper flex-center mb-2">
                        <label>Starting Date</label>
                        <input type="date" value="" placeholder="Enter...">
                    </div>
                    <div class="pkg-fil-bar__input-wrapper flex-center">
                        <label>Starting From</label>
                        <div class="w-100 d-flex justify-content-between align-items-center gap-1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <p class="text-truncate">3 Adults, Economy</p>
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                        <div class="dropdown-menu travellers-dropdown p-3 shadow-lg">

                            <!-- Adults -->
                            <div class="traveller-row d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <strong>Adults</strong>
                                    <p class="text-muted small m-0">12+ Years</p>
                                </div>

                                <div class="traveller-counter d-flex align-items-center gap-2">
                                    <button class="traveller-counter-btn minus">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                    <span class="count">1</span>
                                    <button class="traveller-counter-btn plus">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Children -->
                            <div class="traveller-row d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <strong>Children</strong>
                                    <p class="text-muted small m-0">2–12 Years</p>
                                </div>

                                <div class="traveller-counter d-flex align-items-center gap-2">
                                    <button class="traveller-counter-btn minus">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                    <span class="count">1</span>
                                    <button class="traveller-counter-btn plus">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Infants -->
                            <div class="traveller-row d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <strong>Infants</strong>
                                    <p class="text-muted small m-0">Below 2 Years</p>
                                </div>

                                <div class="traveller-counter d-flex align-items-center gap-2">
                                    <button class="traveller-counter-btn minus">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                    <span class="count">1</span>
                                    <button class="traveller-counter-btn plus">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- Travel Classes -->
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                <span class="traveller-chip active">Economy</span>
                                <span class="traveller-chip">Business Class</span>
                                <span class="traveller-chip">First Class</span>
                                <span class="traveller-chip">Premium Economy</span>
                            </div>
                        </div>
                    </div>
                    <button
                        class="btn btn-primary mt-3 w-100 btn-lg justify-content-center rounded-pill">Search</button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')

<!-- <script>
document.addEventListener('DOMContentLoaded', () => {

    let activeSlot    = null; // stable container
    let activeWrapper = null; // replaceable
    let selectedClone = null;

    /* ================= OPEN MODAL ================= */
    document.addEventListener('click', e => {

        const btn = e.target.closest('.editDayItemsBtn');
        if (!btn) return;

        activeSlot = btn.closest('.day-item-slot');
        if (!activeSlot) return;

        activeWrapper = activeSlot.querySelector('.day-item-wrapper');
        if (!activeWrapper) return;

        const dayId  = activeSlot.dataset.dayId;
        const type   = activeSlot.dataset.type;
        const index  = activeSlot.dataset.index;
        const itemId = activeWrapper.dataset.itemId;

        const list = document.getElementById('dayItemList');
        list.innerHTML = '';
        selectedClone = null;

        /* CURRENT ITEM */
        const currentWrapper = activeWrapper.cloneNode(true);
        currentWrapper.dataset.index = index; // 🔒 FORCE SLOT INDEX

        const currentCard = document.createElement('div');
        currentCard.className = 'col-md-4 selectable-card-wrapper active';
        currentCard.appendChild(currentWrapper);

        selectedClone = currentWrapper.cloneNode(true);

        currentCard.onclick = () => {
            document.querySelectorAll('.selectable-card-wrapper')
                .forEach(c => c.classList.remove('active'));
            currentCard.classList.add('active');
            selectedClone = currentWrapper.cloneNode(true);
        };

        list.appendChild(currentCard);

        /* OPTIONS */
        fetch(`/package-day-option/${dayId}/${type}`)
            .then(r => r.json())
            .then(res => {

                res.data.forEach(item => {
                    const model = item[type];
                    if (!model || model.id == itemId) return;

                    const wrapper = activeWrapper.cloneNode(true);
                    wrapper.dataset.itemId = model.id;
                    wrapper.dataset.index  = index; // 🔒 FORCE SLOT INDEX

                    const img = wrapper.querySelector('img');
                    if (img && model.thumb?.image_path) {
                        img.src = `/storage/${model.thumb.image_path}`;
                    }

                    const title = wrapper.querySelector('.fw-600');
                    if (title) {
                        title.innerText =
                            model.translation?.name ||
                            model.translation?.title || '';
                    }

                    const card = document.createElement('div');
                    card.className = 'col-md-4 selectable-card-wrapper';
                    card.appendChild(wrapper);

                    card.onclick = () => {
                        document.querySelectorAll('.selectable-card-wrapper')
                            .forEach(c => c.classList.remove('active'));
                        card.classList.add('active');
                        selectedClone = wrapper.cloneNode(true);
                    };

                    list.appendChild(card);
                });

                new bootstrap.Modal(
                    document.getElementById('dayItemModal')
                ).show();
            });
    });

    /* ================= SAVE ================= */
    document.getElementById('saveDayItems').onclick = () => {

        if (!activeSlot || !selectedClone) return;

        const dayId  = activeSlot.dataset.dayId;
        const type   = activeSlot.dataset.type;
        const index  = activeSlot.dataset.index;
        const itemId = selectedClone.dataset.itemId;

        selectedClone.dataset.index = index; // 🔒 SAFETY LOCK

        const oldWrapper = activeSlot.querySelector('.day-item-wrapper');
        if (oldWrapper) oldWrapper.remove();

        activeSlot.prepend(selectedClone);

        const editBtn = activeSlot.querySelector('.editDayItemsBtn');
        if (editBtn) editBtn.dataset.itemId = itemId;

        fetch('/save-package-day-item-session', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                package_id: {{ $package->id }},
                day_id: dayId,
                type: type,
                index: index,
                item_id: itemId
            })
        });

        bootstrap.Modal.getInstance(
            document.getElementById('dayItemModal')
        ).hide();
    };
});
</script> -->

<!-- <script>
document.addEventListener('DOMContentLoaded', () => {

    let activeSlot    = null;
    let activeWrapper = null;
    let selectedClone = null;

    /* ================= OPEN MODAL ================= */
    document.addEventListener('click', e => {

        const btn = e.target.closest('.editDayItemsBtn');
        if (!btn) return;

        activeSlot = btn.closest('.day-item-slot');
        if (!activeSlot) return;

        activeWrapper = activeSlot.querySelector('.day-item-wrapper');
        if (!activeWrapper) return;

        const dayId  = activeSlot.dataset.dayId;
        const type   = activeSlot.dataset.type;
        const index  = activeSlot.dataset.index;
        const itemId = activeWrapper.dataset.itemId;

        const list = document.getElementById('dayItemList');
        list.innerHTML = '';
        selectedClone = null;

        /* ================= CURRENT ITEM ================= */
        const currentWrapper = activeWrapper.cloneNode(true);
        currentWrapper.dataset.index = index;

        const currentCard = document.createElement('div');
        currentCard.className = 'col-md-4 selectable-card-wrapper active';
        currentCard.appendChild(currentWrapper);

        selectedClone = currentWrapper.cloneNode(true);

        currentCard.onclick = () => {
            document.querySelectorAll('.selectable-card-wrapper')
                .forEach(c => c.classList.remove('active'));
            currentCard.classList.add('active');
            selectedClone = currentWrapper.cloneNode(true);
        };

        list.appendChild(currentCard);

        /* ================= FETCH OPTIONS ================= */
        fetch(`/package-day-option/${dayId}/${type}`)
            .then(r => r.json())
            .then(res => {

                res.data.forEach(option => {

                    const model = option[type];
                    if (!model) return;
                    if (model.id == itemId) return;

                    const wrapper = activeWrapper.cloneNode(true);
                    wrapper.dataset.itemId = model.id;
                    wrapper.dataset.index  = index;

                    /* image */
                    const img = wrapper.querySelector('img');
                    if (img && model.thumb?.image_path) {
                        img.src = `/storage/${model.thumb.image_path}`;
                    }

                    /* title */
                    const title = wrapper.querySelector('.fw-600');
                    if (title) {
                        title.innerText =
                            model.translation?.name ||
                            model.translation?.title || '';
                    }

                    /* ================= EXTRA PRICE (POPUP ONLY) ================= */
                    let priceEl = wrapper.querySelector('.extra-price');

                    if (!priceEl) {
                        priceEl = document.createElement('div');
                        priceEl.className = 'extra-price text-success fw-600 mt-1';
                        title.after(priceEl);
                    }

                    if (parseFloat(option.extra_price) > 0) {
                        priceEl.innerText = `+ ${option.extra_price}`;



                    } else {
                        priceEl.remove();
                    }

                    const card = document.createElement('div');
                    card.className = 'col-md-4 selectable-card-wrapper';
                    card.appendChild(wrapper);

                    card.onclick = () => {
                        document.querySelectorAll('.selectable-card-wrapper')
                            .forEach(c => c.classList.remove('active'));
                        card.classList.add('active');
                        selectedClone = wrapper.cloneNode(true);
                    };



                    list.appendChild(card);
                });

                new bootstrap.Modal(
                    document.getElementById('dayItemModal')
                ).show();
            });
    });

    /* ================= SAVE ================= */
    document.getElementById('saveDayItems').onclick = () => {

        if (!activeSlot || !selectedClone) return;

        const dayId  = activeSlot.dataset.dayId;
        const type   = activeSlot.dataset.type;
        const index  = activeSlot.dataset.index;
        const itemId = selectedClone.dataset.itemId;

        selectedClone.dataset.index = index;

        const oldWrapper = activeSlot.querySelector('.day-item-wrapper');
        if (oldWrapper) oldWrapper.remove();

        removeExtraPrice(selectedClone);

        activeSlot.prepend(selectedClone);

        const editBtn = activeSlot.querySelector('.editDayItemsBtn');
        if (editBtn) editBtn.dataset.itemId = itemId;

        fetch('/save-package-day-item-session', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                package_id: {{ $package->id }},
                day_id: dayId,
                type: type,
                index: index,
                item_id: itemId
            })
        });

        bootstrap.Modal.getInstance(
            document.getElementById('dayItemModal')
        ).hide();
    };
});

function removeExtraPrice(el) {
    const price = el.querySelector('.extra-price');
    if (price) price.remove();
}

function addExtraPrice(wrapper, price) {
    if (!price || price == 0) return;

    const priceEl = document.createElement('div');
    priceEl.className = 'extra-price text-success fw-bold mt-1';
    priceEl.innerText = `+ ₹${price}`;

    wrapper.appendChild(priceEl);
}
</script> -->

<script>
document.addEventListener('DOMContentLoaded', () => {

    let activeSlot    = null; // stable container
    let activeWrapper = null; // replaceable wrapper
    let selectedClone = null;

    /* =====================================================
       OPEN EDIT MODAL
    ===================================================== */
    document.addEventListener('click', e => {

        const btn = e.target.closest('.editDayItemsBtn');
        if (!btn) return;

        activeSlot = btn.closest('.day-item-slot');
        if (!activeSlot) return;

        activeWrapper = activeSlot.querySelector('.day-item-wrapper');
        if (!activeWrapper) return;

        const dayId  = activeSlot.dataset.dayId;
        const type   = activeSlot.dataset.type;
        const index  = activeSlot.dataset.index;
        const itemId = activeWrapper.dataset.itemId;

        const list = document.getElementById('dayItemList');
        list.innerHTML = '';
        selectedClone = null;

        /* ================= CURRENT ITEM ================= */
        const currentWrapper = activeWrapper.cloneNode(true);
        currentWrapper.dataset.index = index;

        // ❌ remove price from main clone (safety)
        currentWrapper.querySelectorAll('.extra-price').forEach(p => p.remove());
        currentWrapper.querySelectorAll('input[name="extra_price"]').forEach(i => i.remove());

        const currentCard = document.createElement('div');
        currentCard.className = 'selectable-card-wrapper active';
        currentCard.appendChild(currentWrapper);

        selectedClone = currentWrapper.cloneNode(true);

        currentCard.onclick = () => {
            document.querySelectorAll('.selectable-card-wrapper')
                .forEach(c => c.classList.remove('active'));
            currentCard.classList.add('active');
            selectedClone = currentWrapper.cloneNode(true);
        };

        list.appendChild(currentCard);

        /* ================= OPTIONS ================= */
        fetch(`/package-day-option/${dayId}/${type}`)
            .then(r => r.json())
            .then(res => {

                res.data.forEach(option => {

                    const model = option[type];
                    if (!model || model.id == itemId) return;

                    const wrapper = activeWrapper.cloneNode(true);
                    wrapper.dataset.itemId = model.id;
                    wrapper.dataset.index  = index;

                    /* image */
                    const img = wrapper.querySelector('img');
                    if (img && model.thumb?.image_path) {
                        img.src = `/storage/${model.thumb.image_path}`;
                    }

                    /* title */
                    const title = wrapper.querySelector('.fw-600');
                    if (title) {
                        title.innerText =
                            model.translation?.name ||
                            model.translation?.title || '';
                    }

                    /* ================= EXTRA PRICE (POPUP ONLY) ================= */
                    wrapper.querySelectorAll('.extra-price').forEach(p => p.remove());
                    wrapper.querySelectorAll('input[name="extra_price"]').forEach(i => i.remove());

                    const extraPrice = parseFloat(option.extra_price || 0);

                    if (extraPrice > 0) {

                        /* visible price (popup only) */
                        const priceEl = document.createElement('div');
                        priceEl.className = 'extra-price text-success fw-600 mt-1';
                        priceEl.innerText = `+ ${extraPrice}`;
                        title.after(priceEl);

                        /* hidden input (for calculation later) */
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type  = 'hidden';
                        hiddenInput.name  = 'extra_price';
                        hiddenInput.value = extraPrice;
                        wrapper.appendChild(hiddenInput);
                    }

                    const card = document.createElement('div');
                    card.className = 'col-md-12 selectable-card-wrapper';
                    card.appendChild(wrapper);

                    card.onclick = () => {
                        document.querySelectorAll('.selectable-card-wrapper')
                            .forEach(c => c.classList.remove('active'));
                        card.classList.add('active');
                        selectedClone = wrapper.cloneNode(true);
                    };

                    list.appendChild(card);
                });

                // new bootstrap.Modal(
                //     document.getElementById('dayItemModal')
                // ).show();

                new bootstrap.Offcanvas(
    document.getElementById('dayItemModal')
).show();
            });
    });

    /* =====================================================
       SAVE SELECTION
    ===================================================== */
    document.getElementById('saveDayItems').onclick = () => {

        if (!activeSlot || !selectedClone) return;

        const dayId  = activeSlot.dataset.dayId;
        const type   = activeSlot.dataset.type;
        const index  = activeSlot.dataset.index;
        const itemId = selectedClone.dataset.itemId;

        /* 🔒 lock index */
        selectedClone.dataset.index = index;

        /* ❌ REMOVE price text from MAIN list */
        selectedClone.querySelectorAll('.extra-price').forEach(p => p.remove());

        /* replace wrapper only */
        const oldWrapper = activeSlot.querySelector('.day-item-wrapper');
        if (oldWrapper) oldWrapper.remove();

        activeSlot.prepend(selectedClone);

        /* update edit button */
        const editBtn = activeSlot.querySelector('.editDayItemsBtn');
        if (editBtn) editBtn.dataset.itemId = itemId;

        /* SAVE TO SESSION */
        fetch('/save-package-day-item-session', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                package_id: {{ $package->id }},
                day_id: dayId,
                type: type,
                index: index,
                item_id: itemId
            })
        });

        // bootstrap.Modal.getInstance(
        //     document.getElementById('dayItemModal')
        // ).hide();

        bootstrap.Offcanvas.getInstance(
            document.getElementById('dayItemModal')
        ).hide();
    };
});
</script>
<script>
document.addEventListener('click', function (e) {
    if (e.target.closest('.travellers-dropdown')) {
        e.stopPropagation();
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.travellers-dropdown').forEach(dropdown => {

        dropdown.addEventListener('click', e => {
            const btn = e.target.closest('.traveller-counter-btn');
            if (!btn) return;

            e.preventDefault();
            e.stopPropagation();

            const counter = btn.closest('.traveller-counter');
            const countEl = counter.querySelector('.count');

            let count = parseInt(countEl.innerText) || 0;

            if (btn.classList.contains('plus')) {
                count++;
            }

            if (btn.classList.contains('minus') && count > 0) {
                count--;
            }

            countEl.innerText = count;

            updateTravellerSummary(dropdown);
        });

    });

    function updateTravellerSummary(dropdown) {
        const rows = dropdown.querySelectorAll('.traveller-row');
        let adults = 0, children = 0, infants = 0;

        rows.forEach(row => {
            const label = row.querySelector('strong').innerText.toLowerCase();
            const count = parseInt(row.querySelector('.count').innerText) || 0;

            if (label.includes('adult')) adults = count;
            if (label.includes('child')) children = count;
            if (label.includes('infant')) infants = count;
        });

        const text = `${adults} Adults${children ? ', ' + children + ' Children' : ''}${infants ? ', ' + infants + ' Infants' : ''}`;

        // Update visible text
        document.querySelectorAll('[data-bs-toggle="dropdown"] p')
            .forEach(p => p.innerText = text);
    }

});
</script>
<script>
document.addEventListener('click', e => {
    const chip = e.target.closest('.traveller-chip');
    if (!chip) return;

    chip.closest('.travellers-dropdown')
        .querySelectorAll('.traveller-chip')
        .forEach(c => c.classList.remove('active'));

    chip.classList.add('active');
});
</script>

    @endpush
@endsection
