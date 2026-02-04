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


        .selectable-card-wrapper {
            cursor: pointer;
        }

        .selectable-card-wrapper.active {
            border-color: #198754;
            background-color: #f6fffa;
        }
    </style>
    @php

        $t = $package->translation;
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

        <script>
            window.PRICE_STATE = {
                persons: {
                    adults: {{ $package->base_persons }},
                    children: 0
                },
                extras: {
                    dayItems: 0
                }
            };
        </script>

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

                                <?php
                                //print_r($finalArray['todo'][0]['thumb']);die;
                                $imagePathToDo = match (true) {
                                    !empty($finalArray['todo'][0]['thumb']) => asset('storage/' . $finalArray['todo'][0]['thumb']->image_path),

                                    !empty($finalArray['event'][0]['thumb']) => asset('storage/' . $finalArray['event'][0]['thumb']->image_path),

                                    !empty($finalArray['hotel'][0]['thumb']) => asset('storage/' . $finalArray['hotel'][0]['thumb']->image_path),

                                    !empty($package->thumb) => asset('storage/' . $package->thumb->image_path),

                                    default => asset('frontend/assets/package-banner.png'),
                                };
                                ?>




                                <img class="img-fluid" src="{{ $imagePathToDo }}" alt="">
                                <p class="p-small">Activities & Sightseeing</p>
                            </div>
                        </div>

                        <div class="d-flex flex-column gap-2">
                            @php
                                $imagePathEvent = match (true) {
                                    !empty($finalArray['event'][0]['thumb']) => asset(
                                        'storage/' . $finalArray['event'][0]['thumb']->image_path,
                                    ),

                                    !empty($finalArray['todo'][0]['thumb']) => asset(
                                        'storage/' . $finalArray['todo'][0]['thumb']->image_path,
                                    ),

                                    !empty($finalArray['hotel'][0]['thumb']) => asset(
                                        'storage/' . $finalArray['hotel'][0]['thumb']->image_path,
                                    ),

                                    !empty($package->thumb) => asset('storage/' . $package->thumb->image_path),

                                    default => asset('frontend/assets/package-banner.png'),
                                };

                                $videoUrl = match (true) {
                                    !empty($finalArray['event'][0]['video_url']) => $finalArray['event'][0][
                                        'video_url'
                                    ],

                                    default => null,
                                };
                            @endphp


                            @if ($videoUrl)
                                <div class="gallery-item half">

                                    <video controls>
                                        <source src="{{ $videoUrl }}" type="video/mp4">
                                    </video>
                                </div>

                                <div class="gallery-item  half open-gallery" data-open-tab="galleryTabsHighlights"
                                    data-bs-toggle="modal" data-bs-target="#galleryModal">
                                    <img class="img-fluid" src="{{ $imagePathEvent }}" alt="">
                                    <p class="p-small">Events</p>
                                </div>
                            @else
                                <div class="gallery-item full open-gallery" data-open-tab="galleryTabsActivities"
                                    data-bs-toggle="modal" data-bs-target="#galleryModal">
                                    <img class="img-fluid" src="{{ $imagePathEvent }}" alt="">
                                    <p class="p-small">Events</p>
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="gallery-item gallery-item--large swiper-slide open-gallery"
                        data-open-tab="galleryTabsProperty" data-bs-toggle="modal" data-bs-target="#galleryModal">
                        @php
                            $imagePathHotel = match (true) {
                                !empty($finalArray['hotel'][0]['thumb']) => asset(
                                    'storage/' . $finalArray['hotel'][0]['thumb']->image_path,
                                ),

                                !empty($finalArray['event'][0]['thumb']) => asset(
                                    'storage/' . $finalArray['event'][0]['thumb']->image_path,
                                ),

                                !empty($finalArray['todo'][0]['thumb']) => asset(
                                    'storage/' . $finalArray['todo'][0]['thumb']->image_path,
                                ),

                                !empty($package->thumb) => asset('storage/' . $package->thumb->image_path),

                                default => asset('frontend/assets/package-banner.png'),
                            };
                        @endphp



                        <img class="img-fluid" src="{{ $imagePathHotel }}" alt="">
                        <p class="p-small">Hotels</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- @dd($package) --}}
    @include('frontend.packages.partials.filter-bar', [
        'package' => $package,
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
                                                                $sessionHotelIds =
                                                                    $sessionItems[$day->id]['hotel'] ?? null;

                                                                if ($sessionHotelIds) {
                                                                    // session exists → show selected
                                                                    $hotels = $allHotels->whereIn(
                                                                        'id',
                                                                        array_values($sessionHotelIds),
                                                                    );
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
                                                                                        data-index="{{ $hotel_slot }}">
                                                                                        <div class="day-item-wrapper"
                                                                                            data-day-id="{{ $day->id }}"
                                                                                            data-type="hotel"
                                                                                            data-item-id="{{ $hotel->id }}"
                                                                                            data-default-item-id="{{ $hotel->id }}"
                                                                                            data-index="{{ $hotel_slot }}">
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

                                                                                                    <p
                                                                                                        class="p-small text-light2">
                                                                                                        <i
                                                                                                            class="fa-solid fa-location-dot"></i>
                                                                                                        {{ $hotel->location }}
                                                                                                    </p>
                                                                                                </div>
                                                                                            </div>
                                                                                            <input type="hidden"
                                                                                                name="extra_price"
                                                                                                value="{{ $dayWiseOptions[$day->id]['hotel'][$hotel->id]['extra_price'] ?? 0 }}">
                                                                                        </div>
                                                                                        @if ($package->package_type !== 'fixed')
                                                                                            <button type="button"
                                                                                                class="btn btn-primary btn-sm position-absolute top-0 end-0 m-2 editDayItemsBtn"
                                                                                                data-day-id="{{ $day->id }}"
                                                                                                data-type="hotel"
                                                                                                data-item-id="{{ $hotel->id }}"
                                                                                                data-index="{{ $hotel_slot }}">
                                                                                                <i
                                                                                                    class="fa-solid fa-pencil"></i>
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
                                                                                        data-index="{{ $todo_slot }}">
                                                                                        <div class="day-item-wrapper"
                                                                                            data-day-id="{{ $day->id }}"
                                                                                            data-type="todo"
                                                                                            data-item-id="{{ $todo->id }}"
                                                                                            data-index="{{ $todo_slot }}">
                                                                                            <div class="d-flex gap-3 mb-3">
                                                                                                <img src="{{ $todo->thumb ? asset('storage/' . $todo->thumb->image_path) : asset('frontend/assets/hotel-placeholder.jpg') }}"
                                                                                                    class="pkg-details__tr-ht-img">

                                                                                                <div>
                                                                                                    <p class="fw-600">
                                                                                                        {{ $todo->translation->name }}
                                                                                                    </p>
                                                                                                    <p
                                                                                                        class="p-small text-light2">
                                                                                                        <i
                                                                                                            class="fa fa-clock"></i>
                                                                                                        {{ $todo->opening_time }}
                                                                                                        -
                                                                                                        {{ $todo->closing_time }}
                                                                                                    </p>
                                                                                                </div>
                                                                                            </div>
                                                                                            <input type="hidden"
                                                                                                name="extra_price"
                                                                                                value="{{ $dayWiseOptions[$day->id]['todo'][$todo->id]['extra_price'] ?? 0 }}">

                                                                                        </div>
                                                                                        @if ($package->package_type !== 'fixed')
                                                                                            <button type="button"
                                                                                                class="btn btn-primary btn-sm position-absolute top-0 end-0 m-2 editDayItemsBtn"
                                                                                                data-day-id="{{ $day->id }}"
                                                                                                data-type="todo"
                                                                                                data-item-id="{{ $todo->id }}"
                                                                                                data-index="{{ $todo_slot }}">
                                                                                                <i
                                                                                                    class="fa-solid fa-pencil"></i>
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
                                                                                        data-index="{{ $event_slot }}">
                                                                                        <div class="day-item-wrapper"
                                                                                            data-day-id="{{ $day->id }}"
                                                                                            data-type="event"
                                                                                            data-item-id="{{ $event->id }}"
                                                                                            data-index="{{ $event_slot }}">
                                                                                            <div class="d-flex gap-3 mb-3">
                                                                                                <img src="{{ $event->thumb ? asset('storage/' . $event->thumb->image_path) : asset('frontend/assets/hotel-placeholder.jpg') }}"
                                                                                                    class="pkg-details__tr-ht-img">

                                                                                                <div>
                                                                                                    <p class="fw-600">
                                                                                                        {{ $event->translation->title }}
                                                                                                    </p>
                                                                                                    <p
                                                                                                        class="p-small text-light2">
                                                                                                        <i
                                                                                                            class="fa fa-calendar"></i>
                                                                                                        {{ \App\Helpers\DateHelper::format($event->start_date) }}
                                                                                                    </p>
                                                                                                </div>
                                                                                            </div>
                                                                                            <input type="hidden"
                                                                                                name="extra_price"
                                                                                                value="{{ $dayWiseOptions[$day->id]['event'][$event->id]['extra_price'] ?? 0 }}">

                                                                                        </div>
                                                                                        @if ($package->package_type !== 'fixed')
                                                                                            <button type="button"
                                                                                                class="btn btn-primary position-absolute top-0 end-0 m-2 editDayItemsBtn"
                                                                                                data-day-id="{{ $day->id }}"
                                                                                                data-type="event"
                                                                                                data-item-id="{{ $event->id }}"
                                                                                                data-index="{{ $event_slot }}">
                                                                                                <i
                                                                                                    class="fa-solid fa-pencil"></i>
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


                                                            {{-- ================= TRANSPORT ================= --}}
                                                            @php
                                                                $sessionTransportIds =
                                                                    $sessionItems[$day->id]['transport'] ?? null;

                                                                if ($sessionTransportIds) {
                                                                    // session exists → show selected
                                                                    $transports = $allTransports->whereIn(
                                                                        'id',
                                                                        array_values($sessionTransportIds),
                                                                    );
                                                                } else {
                                                                    // first time → show package default
                                                                    $transports = $day->items
                                                                        ->where('item_type', 'transport')
                                                                        ->map(fn($i) => $i->transport);
                                                                }

                                                            @endphp

                                                            @if ($transports->count())
                                                                <div class="accordion accordion-flush mb-3"
                                                                    id="transportAccordion{{ $day->id }}">

                                                                    <div
                                                                        class="accordion-item border rounded pkg-details__accordion-item">

                                                                        <div class="accordion-header">
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-center">
                                                                                <div
                                                                                    class="d-flex align-items-center gap-2">
                                                                                    <div class="accordion-icon"
                                                                                        data-bs-toggle="collapse"
                                                                                        data-bs-target="#transportCollapse{{ $day->id }}">
                                                                                        <i
                                                                                            class="fa-solid fa-chevron-down"></i>
                                                                                    </div>
                                                                                    <p class="p-small fw-600">Transport</p>
                                                                                </div>
                                                                            </div>

                                                                            <div
                                                                                class="d-flex gap-2 pkg-details__accordion-actions">
                                                                                {{-- edit button if needed --}}
                                                                            </div>
                                                                        </div>

                                                                        <div id="transportCollapse{{ $day->id }}"
                                                                            class="accordion-collapse collapse show"
                                                                            data-bs-parent="#transportAccordion{{ $day->id }}">

                                                                            <div class="accordion-body"
                                                                                id="day-{{ $day->id }}-transport-list">

                                                                                @php
                                                                                    $transport_slot = 0;
                                                                                @endphp

                                                                                @foreach ($transports as $index => $transport)
                                                                                    <div class="day-item-slot d-flex position-relative"
                                                                                        data-day-id="{{ $day->id }}"
                                                                                        data-type="transport"
                                                                                        data-index="{{ $transport_slot }}">

                                                                                        <div class="day-item-wrapper"
                                                                                            data-day-id="{{ $day->id }}"
                                                                                            data-type="transport"
                                                                                            data-item-id="{{ $transport->id }}"
                                                                                            data-index="{{ $transport_slot }}">

                                                                                            <div class="d-flex gap-3 mb-3">
                                                                                                <img src="{{ $transport->thumb
                                                                                                    ? asset('storage/' . $transport->thumb->image_path)
                                                                                                    : asset('frontend/assets/transport-placeholder.jpg') }}"
                                                                                                    class="pkg-details__tr-ht-img">

                                                                                                <div>
                                                                                                    <p class="fw-600">
                                                                                                        {{ $transport->translation->name }}
                                                                                                    </p>

                                                                                                </div>
                                                                                            </div>

                                                                                            <input type="hidden"
                                                                                                name="extra_price"
                                                                                                value="{{ $dayWiseOptions[$day->id]['transport'][$transport->id]['extra_price'] ?? 0 }}">
                                                                                        </div>

                                                                                        @if ($package->package_type !== 'fixed')
                                                                                            <button type="button"
                                                                                                class="btn btn-primary position-absolute top-0 end-0 m-2 editDayItemsBtn"
                                                                                                data-day-id="{{ $day->id }}"
                                                                                                data-type="transport"
                                                                                                data-item-id="{{ $transport->id }}"
                                                                                                data-index="{{ $transport_slot }}">
                                                                                                <i
                                                                                                    class="fa-solid fa-pencil"></i>
                                                                                            </button>
                                                                                        @endif

                                                                                        @php $transport_slot++; @endphp
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

                            <input type="hidden" name="day_items_extra" id="dayItemsExtraInput"
                                form="packageCheckoutForm">
                            <button type="submit"
                                class="btn btn-primary justify-content-center pkg-details__book-now-btn my-2">
                                Book Now
                            </button>

                        </form>


                        <div class="fw-500 text-light2 d-flex align-items-center gap-1">
                            <p>Total Price: </p>
                            <img src="{{ asset('frontend/assets/icons/riyal-light.svg') }}" alt="Riyal">
                            <p id="liveTotalPrice">{{ $package->price->original_price }}</p>

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

                            <div>
                                <p class="text-light2 mb-0">Places to Visit:</p>

                                <p class="fw-600 p-large mb-0" style="font-size: 15px">
                                    @foreach ($places as $place)
                                        {{ $place['nights'] }}N {{ $place['city'] }}
                                        @if (!$loop->last)
                                .
                                        @endif
                                    @endforeach
                                </p>
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




    <div class="offcanvas offcanvas-end" id="dayItemModal" tabindex="-1">
        <div class="modal-header">
            <h5 class="modal-title" id="dayItemModalTitle"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body side-drawer__booking-body">
            <div id="dayItemList" class="row g-3"></div>
        </div>
        <div class="offcanvas-footer border-top text-end p-3">
            <button id="saveDayItems" class="btn btn-outline-secondary rounded-pill"
                data-bs-dismiss="offcanvas">Save</button>
        </div>

    </div>


    @include('frontend.packages.partials.gallery-modal-content')

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
                    <button class="btn btn-primary mt-3 w-100 btn-lg justify-content-center rounded-pill">Search</button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {

                let activeSlot = null; // stable container
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

                    const dayId = activeSlot.dataset.dayId;
                    const type = activeSlot.dataset.type;
                    const index = activeSlot.dataset.index;
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
                                wrapper.dataset.index = index;

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
                                wrapper.querySelectorAll('input[name="extra_price"]').forEach(i => i
                                    .remove());

                                const extraPrice = parseFloat(option.extra_price || 0);

                                if (extraPrice > 0) {

                                    /* visible price (popup only) */
                                    const priceEl = document.createElement('div');
                                    priceEl.className = 'extra-price text-success fw-600 mt-1';
                                    priceEl.innerText = `+ ${extraPrice}`;
                                    title.after(priceEl);

                                    /* hidden input (for calculation later) */
                                    const hiddenInput = document.createElement('input');
                                    hiddenInput.type = 'hidden';
                                    hiddenInput.name = 'extra_price';
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

                    const dayId = activeSlot.dataset.dayId;
                    const type = activeSlot.dataset.type;
                    const index = activeSlot.dataset.index;
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

                    let totalExtra = 0;

                    document.querySelectorAll(
                        '.day-item-slot > .day-item-wrapper:first-child'
                    ).forEach(wrapper => {

                        const input = wrapper.querySelector('input[name="extra_price"]');
                        if (!input) return;

                        const value = parseFloat(input.value || 0);

                        // 🔒 only count if actually extra
                        if (value > 0) {
                            totalExtra += value;
                        }
                    });


                    console.log('Total Extra Price from Day Items:', totalExtra);

                    window.PRICE_STATE.extras.dayItems = totalExtra;

                    updatePricing();


                    bootstrap.Offcanvas.getInstance(
                        document.getElementById('dayItemModal')
                    ).hide();
                };

                syncDayItemExtrasFromDOM();
                updatePricing();
            });
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const dropdownEl = document.querySelector('.pkg-fil-bar__input-wrapper.dropdown');

                dropdownEl.addEventListener('hidden.bs.dropdown', function() {

                    // 🔥 DROPDOWN CLOSED
                    // alert('close time');

                    storeTravellerSession();
                });

            });
        </script>


        <script>
            document.addEventListener('click', function(e) {
                if (e.target.closest('.travellers-dropdown')) {

                    e.stopPropagation();
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
        <script>
            function storeTravellerSession() {
                console.log('testing');

                fetch('/store-traveller-session', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        adults: document.getElementById('adultCount')?.innerText ?? 0,
                        children: document.getElementById('childCount')?.innerText ?? 0,
                        date: document.getElementById('startDateInput')?.value ?? null,
                        filter_package_unique_id: '{{ $package->id }}'
                    })
                });
            }
        </script>








        <script>
            function updatePricing() {
                // alert('Updating pricing...');
                /* ================= CONFIG & STATE ================= */
                const pkg = window.PACKAGE;
                const state = window.PRICE_STATE;

                const adults = state.persons.adults;
                const children = state.persons.children;

                /* ================= BASE PRICE ================= */
                const basePrice = pkg.originalPrice;

                /* ================= EXTRA ADULT ================= */
                const extraAdults =
                    Math.max(0, adults - pkg.basePersons);

                let extraAdultPerPrice = 0;

                pkg.extraAdultRules.forEach(rule => {
                    if (extraAdults >= rule.person_number) {
                        extraAdultPerPrice = rule.price;
                    }
                });

                const extraAdultTotal =
                    extraAdults * extraAdultPerPrice;

                /* ================= CHILD PRICE ================= */
                let childPerPrice = 0;
                let childTotal = 0;

                if (children && pkg.childRules.length) {

                    const rule = pkg.childRules[0];

                    childPerPrice =
                        rule.type === 'fixed' ?
                        rule.value :
                        (pkg.pricePerPerson * rule.value) / 100;

                    childTotal = childPerPrice * children;
                }

                /* ================= DAY ITEM EXTRA ================= */
                const dayItemExtra =
                    parseFloat(state.extras.dayItems || 0);

                /* ================= FINAL TOTAL ================= */
                const finalTotal =
                    basePrice +
                    extraAdultTotal +
                    childTotal +
                    dayItemExtra;

                /* ================= UPDATE RIGHT PRICE UI ================= */
                const priceEl = document.getElementById('liveTotalPrice');
                if (priceEl) {
                    priceEl.innerText = finalTotal.toFixed(2);
                }

                /* ================= UPDATE HIDDEN INPUTS ================= */
                document.getElementById('adultsInput').value = adults;
                document.getElementById('childrenInput').value = children;
                document.getElementById('totalPersonsInput').value =
                    adults + children;

                document.getElementById('basePriceInput').value = basePrice;

                document.getElementById('extraAdultsInput').value = extraAdults;
                document.getElementById('extraAdultPerPriceInput').value =
                    extraAdultPerPrice;
                document.getElementById('extraAdultTotalPriceInput').value =
                    extraAdultTotal;

                document.getElementById('childPerPriceInput').value =
                    childPerPrice;
                document.getElementById('childTotalPriceInput').value =
                    childTotal;

                document.getElementById('finalTotalInput').value =
                    finalTotal;

                /* ================= HIDDEN INPUTS ================= */
                document.getElementById('dayItemsExtraInput').value =
                    dayItemExtra;

                /* ================= DEBUG (OPTIONAL) ================= */
                console.log({
                    basePrice,
                    extraAdultTotal,
                    childTotal,
                    dayItemExtra,
                    finalTotal
                });
            }
        </script>

        <script>
            function syncDayItemExtrasFromDOM() {
                let totalExtra = 0;

                document.querySelectorAll(
                    '.day-item-slot > .day-item-wrapper:first-child input[name="extra_price"]'
                ).forEach(input => {
                    const value = parseFloat(input.value || 0);
                    if (value > 0) {
                        totalExtra += value;
                    }
                });

                window.PRICE_STATE.extras.dayItems = totalExtra;
            }
        </script>
    @endpush
@endsection
