@extends('frontend.layout')
@section('content')
    <script>
        window.CHECKOUT = {
            adults: 2,
            travellers: @json($travellers)
        };
    </script>
    <section class="checkout-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div
                        class="checkout-top-header d-flex flex-column flex-sm-row justify-content-between align-items-start">

                        <!-- LEFT BLOCK -->
                        <div>
                            <h1 class="fw-600 text-white mb-1 h3">Al-Bujairi Heritage Tourist Park</h1>

                            <div class="text-white d-flex align-items-center gap-3 my-2">
                                <p>2N Diriya</p>
                                <div class="dot primary-bg"></div>
                                <p>3D Jeddah</p>
                            </div>

                            <div class="text-white d-flex flex-wrap align-items-center gap-3">
                                <p class="p-small">Thu, Nov 13, 2025</p>
                                <span class="trip-badge p-micro rounded-pill">6D/5N</span>
                                <p class="p-small">Tue, Nov 18, 2025 / From Riyadh</p>
                                <span class="vertical-divider"></span>
                                <p class="p-small"><span class="fw-600">1 Room</span> - 3 Adults</p>
                            </div>
                        </div>
                        <!-- RIGHT BUTTON -->
                        <button class="btn btn-light rounded-pill customizable-btn mt-3 mt-sm-0 fw-500">
                            Customizable
                        </button>
                    </div>

                    <div class=" accordion accordion-flush mt-3 checkout-accordion" id="checkoutTravelDetails">
                        <div class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                            <div class="accordion-header" data-bs-toggle="collapse" data-bs-target="#checkoutTravelCollapse"
                                aria-expanded="true" aria-controls="checkoutTravelCollapse">
                                <div class="d-flex gap-2 pkg-details__accordion-actions">
                                    <p class="fw-600">1. Traveller Details</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center gap-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="accordion-icon">
                                            <i class="fa-solid fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="checkoutTravelCollapse" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#checkoutTravelDetails">

                                <div class="accordion-body">

                                    {{-- 🔹 HEADER COUNTS --}}
                                    <div class="d-flex gap-1 mb-3">
                                        <p class="fw-600">
                                            {{ $travellers->count() }} Travellers -
                                        </p>
                                        <div class="d-flex gap-2 p-small align-items-center">
                                            <p>1 Room</p>
                                            <div class="vertical-divider h-75"></div>
                                            <p>{{ $travellers->where('type', 'adult')->count() }} Adults</p>
                                        </div>
                                    </div>

                                    {{-- 🔹 TRAVELLER LIST --}}
                                    <div>
                                        @forelse($travellers as $index => $traveller)
                                            <div
                                                class="d-flex justify-content-between align-items-center checkout-traveller-header">

                                                <!-- LEFT -->
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="traveller-icon flex-center rounded-4">
                                                        <i class="fa-solid fa-user"></i>
                                                    </div>

                                                    <div>
                                                        <h6 class="fw-600 p">TRAVELLER {{ $index + 1 }}</h6>

                                                        <div class="d-flex align-items-center gap-2">
                                                            <p class="p-small fw-600 mb-0">
                                                                {{ $traveller->first_name }} {{ $traveller->last_name }}
                                                            </p>

                                                            {{-- DELETE --}}
                                                            <button type="button"
                                                                class="p-0 border-0 bg-transparent text-danger delete-traveller-btn"
                                                                data-id="{{ $traveller->id }}" title="Delete Traveller">
                                                                <i class="fa-solid fa-circle-xmark"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- RIGHT -->
                                                <div class="flex-center gap-3">
                                                    <div class="flex-center gap-1 text-success">
                                                        <i class="fa-solid fa-circle-check"></i>
                                                        <p class="p-small fw-500 mb-0">Traveller Added</p>
                                                    </div>

                                                    <button
                                                        class="btn btn-outline-primary add-traveller-btn rounded-pill border-1-5 fw-500"
                                                        data-bs-toggle="modal" data-bs-target="#travellerModal"
                                                        data-traveller-id="{{ $traveller->id }}">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>

                                            <hr>

                                        @empty
                                            {{-- 🔥 NO TRAVELLER CASE --}}
                                            <div
                                                class="d-flex justify-content-between align-items-center checkout-traveller-header">

                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="traveller-icon flex-center rounded-4">
                                                        <i class="fa-solid fa-user"></i>
                                                    </div>

                                                    <div>
                                                        <h6 class="fw-600 p mb-1">No Traveller Added</h6>
                                                        <p class="text-light2 p-small mb-0">
                                                            Please add traveller details to continue
                                                        </p>
                                                    </div>
                                                </div>

                                                <button
                                                    class="btn btn-outline-primary add-traveller-btn rounded-pill border-1-5 fw-500"
                                                    data-bs-toggle="modal" data-bs-target="#travellerModal">
                                                    Add Traveller
                                                </button>
                                            </div>
                                        @endforelse
                                    </div>

                                    {{-- 🔹 CONTACT DETAILS (UNCHANGED) --}}
                                    <div class="booking-contact mt-4">

                                        <p class="fw-600 mb-3">Please Enter Contact Details</p>

                                        <div class="row g-3 mb-4">
                                            <div class="col-md-4">
                                                <label class="form-label small mb-1">Email</label>
                                                <input type="email" class="form-control" placeholder="Enter email">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label small mb-1">Mobile Code</label>
                                                <input type="text" class="form-control" placeholder="Enter here">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label small mb-1">Mobile</label>
                                                <input type="text" class="form-control" placeholder="Enter here">
                                            </div>
                                        </div>

                                        <p class="fw-600 mb-2">Special Requests</p>

                                        <div class="mb-4">
                                            <label class="form-label small mb-1">Special Requests</label>
                                            <input type="text" class="form-control" placeholder="Enter here">
                                        </div>

                                        <div class="checkout-tcs-box p-3 rounded-4">
                                            <p class="mb-2 fw-600 p-small">
                                                TCS (Tax Collected at Source) is mandatory for International Holiday
                                                Packages
                                            </p>
                                            <p class="mb-0 text-muted p-small">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut
                                                labore et dolore magna aliqua.
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="accordion accordion-flush mt-3 checkout-accordion" id="checkoutPackageAddOn">
                        <div class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                            <div class="accordion-header" data-bs-toggle="collapse"
                                data-bs-target="#checkoutPackageAddOnCollapse" aria-expanded="true"
                                aria-controls="checkoutPackageAddOnCollapse">
                                <div class="d-flex gap-2 pkg-details__accordion-actions">
                                    <p class="fw-600">2. Package Add-Ons</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center gap-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="accordion-icon">
                                            <i class="fa-solid fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="checkoutPackageAddOnCollapse" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#checkoutPackageAddOn">
                                <div class="accordion-body">

                                    <!-- Header -->
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ asset('/frontend/assets/icons/medical.svg') }}"
                                                alt="Medical Insurance">
                                            <div>
                                                <p class="fw-600">Travel + Medical Insurance</p>
                                                <p class="text-light2 p-small">Secure your trip and travel worry
                                                    free</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="checkout-tcs-box p-3 rounded-4">
                                        <div
                                            class="d-flex justify-content-between align-items-start align-items-sm-center flex-column flex-sm-row gap-2">
                                            <div
                                                class="d-flex gap-3 align-items-start align-items-sm-center flex-column flex-sm-row">
                                                <div>
                                                    <p class="fw-600">$550K Travel Insurance</p>
                                                    <p class="text-light2 p-small">99% Claims Settled</p>
                                                </div>
                                                <span class="rounded-pill checkout-package-badge p-small">MOST
                                                    POPULAR</span>
                                            </div>
                                            <a href="#" class="fw-600 primary-text">View T&Cs</a>
                                        </div>
                                        <hr>
                                        <p class="fw-600 p-small mb-2">What's Included</p>
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div class="d-flex flex-column gap-1">
                                                <div class="d-flex gap-2 align-items-center">
                                                    <img src="{{ asset('/frontend/assets/icons/emergency.svg') }}"
                                                        alt="Emergency Medical">
                                                    <span class="p-small">Emergency Medical Expenses –
                                                        <span class="fw-600">$500000</span></span>
                                                </div>
                                                <div class="d-flex gap-2 align-items-center">
                                                    <img src="{{ asset('/frontend/assets/icons/trip-cancel.svg') }}"
                                                        alt="Trip Cancellation">
                                                    <span class="p-small">Trip Cancellation and/or Interruption  –
                                                        <span class="fw-600">$1250</span></span>
                                                </div>
                                                <div class="d-flex gap-2 align-items-center">
                                                    <img src="{{ asset('/frontend/assets/icons/baggage.svg') }}"
                                                        alt="Baggage Delay">
                                                    <span class="p-small">Delay of Checked In Baggage –
                                                        <span class="fw-600">$125</span></span>
                                                </div>
                                                <a href="#" class="primary-text mt-2 p-small fw-500">View
                                                    Benefits</a>
                                            </div>
                                            <div class="text-end">
                                                <p class="fw-600">+ $12,00</p>
                                                <p class="p-small text-light2">per person</p>
                                                <button
                                                    class="btn btn-outline-primary rounded-pill px-4 mt-3">Select</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion accordion-flush mt-3 checkout-accordion" id="checkoutItinerary">
                        <div class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                            <div class="accordion-header" data-bs-toggle="collapse"
                                data-bs-target="#checkoutItineraryOnCollapse" aria-expanded="true"
                                aria-controls="checkoutItineraryOnCollapse">
                                <div class="d-flex gap-2 pkg-details__accordion-actions">
                                    <p class="fw-600">3. Package Itinerary & Inclusions</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center gap-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="accordion-icon">
                                            <i class="fa-solid fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="checkoutItineraryOnCollapse" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#checkoutItinerary">
                                <div class="accordion-body">
                                    <p class="fw-600">Package Features</p>
                                    <div class="d-flex align-items-center gap-2">
                                        <p class="fw-600 mb-1">Itinerary:</p>
                                        <p class="p-small">2 Flights / 3 Hotels / 6 Transfers / 1 Activity</p>
                                    </div>
                                    <div class="pkg-details__content-wrapper">
                                        <div class="pkg-details__day-plan">
                                            <div class="pkg-details__day-plan-left">
                                                <div class="pkg-details__day-plan-header pkg-details__common-block">Day
                                                    Plan
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
                                                            <div
                                                                class="pkg-details__day-plan-header pkg-details__common-block">
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

                                                                                                        <p
                                                                                                            class="fw-600 my-1">
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
                                                                                            </div>

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
                                                                                        <p class="p-small fw-600">ToDo
                                                                                            Thing
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
                                                                                                <div
                                                                                                    class="d-flex gap-3 mb-3">
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
                                                                                            </div>

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
                                                                                        <p class="p-small fw-600">Events
                                                                                        </p>
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
                                                                                                <div
                                                                                                    class="d-flex gap-3 mb-3">
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
                                                                                            </div>

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
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion accordion-flush mt-3 checkout-accordion" id="checkoutCancellation">
                        <div class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                            <div class="accordion-header" data-bs-toggle="collapse"
                                data-bs-target="#checkoutCancellationCollapse" aria-expanded="true"
                                aria-controls="checkoutCancellationCollapse">
                                <div class="d-flex gap-2 pkg-details__accordion-actions">
                                    <p class="fw-600">4. Cancellation & Date Change</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center gap-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="accordion-icon">
                                            <i class="fa-solid fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="checkoutCancellationCollapse" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#checkoutCancellation">
                                <div class="accordion-body">

                                    <!-- Header -->
                                    <div class="mb-3">
                                        <p class="fw-600">Package Cancellation Policy</p>
                                        <p class="p-small text-danger">Cancellation not possible after booking</p>
                                    </div>
                                    <div>
                                        <p class="fw-600">Package Date Change Policy</p>
                                        <p class="p-small text-light2">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                            reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                            officia deserunt mollit anim id est laborum</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3">
                    <div class="card pkg-details__pricing-card checkout-pricing-card">

                        <p class="fw-500 mb-1">Grand Total - 3 Adults</p>
                        <div class="d-flex align-items-center gap-1 mb-2">
                            <img src="{{ asset('/frontend/assets/icons/riyal-primary.svg') }}" alt="Riyal">
                            <h5 class="text-success fw-bold">40,000</h5>
                            <span class="badge primary-bg rounded-pill fw-600">10% OFF</span>
                        </div>
                        <p class="fw-600">Pay Full Amount Now</p>
                        <hr>

                        <p class="fw-600 mb-2">Fare Breakup</p>
                        <div
                            class="pkg-details__additional-info-item p-2 d-flex align-items-start gap-2 mb-2 justify-content-between">
                            <div class="">
                                <p class="fw-600 p-small">Total Basic Cost</p>
                                <p class="p-small text-light2">10,250 x 3 Travellers</p>
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                <img src="{{ asset('/frontend/assets/icons/riyal-light.svg') }}" alt="Riyal">
                                <p class="fw-600 text-light2">60,000</p>
                            </div>
                        </div>

                        <div
                            class="pkg-details__additional-info-item p-2 d-flex align-items-start gap-2 mb-2 justify-content-between">
                            <div class="">
                                <p class="fw-600 p-small">Coupon Discount</p>
                                <p class="p-small text-light2">10,250 x 3 Travellers</p>
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                <img src="{{ asset('/frontend/assets/icons/riyal-light.svg') }}" alt="Riyal">
                                <p class="fw-600 text-light2">60,000</p>
                            </div>
                        </div>

                        <div
                            class="pkg-details__additional-info-item p-2 d-flex align-items-start gap-2 mb-2 justify-content-between">
                            <div class="">
                                <p class="fw-600 p-small">Total Basic Cost:</p>
                                <p class="p-small text-light2">10,250 x 3 Travellers</p>
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                <img src="{{ asset('/frontend/assets/icons/riyal-light.svg') }}" alt="Riyal">
                                <p class="fw-600 text-light2">60,000</p>
                            </div>
                        </div>

                        <div class="mt-3">
                            <p class="fw-600">Important Information</p>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" value="" id="tncCheck">
                                <label class="form-check-label p-micro" for="tncCheck">
                                    I confirm that I have read and I accept
                                    Cancellation Policy, User Agreement, Terms of
                                    Service and Privacy Policy of MakeMyTrip
                                </label>
                            </div>
                            <button class="btn btn-primary rounded-pill w-100 mt-2 justify-content-between">
                                Continue
                                <i class=" fa-solid fa-angles-right"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card pkg-details__pricing-card checkout-pricing-card mt-3">
                        <p class="fw-600">Coupons & Offers</p>
                        <div class="input-group mt-3 package-listing__search-bar checkout-pricing-card__search-bar">
                            <input type="text" class="form-control" placeholder="Enter Coupon Code"
                                aria-label="Browse Package, Location">
                            <button class="btn btn-primary btn-sm rounded-pill p-small" type="button">
                                Apply
                            </button>
                        </div>
                    </div>

                    <div class="checkout-coupon-section mb-3">
                        <div class="checkout-coupon-card d-flex mt-3">
                            <div class="checkout-coupon-left-strip d-flex justify-content-center align-items-center">
                                <p class="checkout-coupon-left-strip-label fw-600">10% OFF</p>
                            </div>
                            <div class="flex-grow-1 p-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="d-flex primary-text p-large gap-1 align-items-center">
                                            <p>-</p>
                                            <img src="{{ asset('/frontend/assets/icons/riyal-primary.svg') }}"
                                                alt="Riyal">
                                            <p>35,200</p>
                                        </div>

                                        <h6 class="fw-600 mb-1 p-large">FINFIRST25</h6>
                                    </div>
                                    <div class="checkout-offer-icon">
                                        <img src="{{ asset('/frontend/assets/icons/offer.svg') }}" alt="">
                                    </div>
                                </div>
                                <p class="text-muted p-small mb-3">Grab Your Discount Before It's Gone!</p>
                                <button class="btn apply-btn w-100 rounded-pill">Apply Code</button>
                            </div>
                        </div>
                        <div class="checkout-coupon-card d-flex mt-3">
                            <div class="checkout-coupon-left-strip d-flex justify-content-center align-items-center">
                                <p class="checkout-coupon-left-strip-label fw-600">10% OFF</p>
                            </div>
                            <div class="flex-grow-1 p-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="d-flex primary-text p-large gap-1 align-items-center">
                                            <p>-</p>
                                            <img src="{{ asset('/frontend/assets/icons/riyal-primary.svg') }}"
                                                alt="Riyal">
                                            <p>35,200</p>
                                        </div>

                                        <h6 class="fw-600 mb-1 p-large">FINFIRST25</h6>
                                    </div>
                                    <div class="checkout-offer-icon">
                                        <img src="{{ asset('/frontend/assets/icons/offer.svg') }}" alt="">
                                    </div>
                                </div>
                                <p class="text-muted p-small mb-3">Grab Your Discount Before It's Gone!</p>
                                <button class="btn apply-btn w-100 rounded-pill">Apply Code</button>
                            </div>
                        </div>
                        <div class="checkout-coupon-card d-flex mt-3">
                            <div class="checkout-coupon-left-strip d-flex justify-content-center align-items-center">
                                <p class="checkout-coupon-left-strip-label fw-600">10% OFF</p>
                            </div>
                            <div class="flex-grow-1 p-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="d-flex primary-text p-large gap-1 align-items-center">
                                            <p>-</p>
                                            <img src="{{ asset('/frontend/assets/icons/riyal-primary.svg') }}"
                                                alt="Riyal">
                                            <p>35,200</p>
                                        </div>

                                        <h6 class="fw-600 mb-1 p-large">FINFIRST25</h6>
                                    </div>
                                    <div class="checkout-offer-icon">
                                        <img src="{{ asset('/frontend/assets/icons/offer.svg') }}" alt="">
                                    </div>
                                </div>
                                <p class="text-muted p-small mb-3">Grab Your Discount Before It's Gone!</p>
                                <button class="btn apply-btn w-100 rounded-pill">Apply Code</button>
                            </div>
                        </div>
                        <div class="mt-3 text-center">
                            <a href="#" class="primary-text">+ 10 More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="travellerModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content traveller-modal">

                <!-- HEADER -->
                <div class="modal-header">
                    <div>
                        <h6 class="modal-title fw-600 p-large">
                            Add Traveller Details
                        </h6>
                        <p class="text-light2 p-small mb-0">
                            Traveller {{ max(1, $travellers->count()) }}/{{ max(1, $travellers->count()) }}
                        </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form method="POST" id="travellerForm">

                    @csrf

                    <input type="hidden" name="traveller_id" id="traveller_id">

                    <div class="modal-body">

                        <!-- TABS -->
                        <div class="d-flex traveller-tabs gap-3 mb-3 flex-wrap">

                            @foreach ($travellers as $index => $traveller)
                                <button type="button"
                                    class="btn btn-outline-secondary trav-btn d-flex gap-2 align-items-center {{ $index === 0 ? 'active' : '' }}"
                                    data-id="{{ $traveller->id }}" data-first="{{ $traveller->first_name }}"
                                    data-last="{{ $traveller->last_name }}" data-dob="{{ $traveller->dob }}"
                                    data-gender="{{ $traveller->gender }}" data-country="{{ $traveller->country }}"
                                    data-type="{{ $traveller->type }}">

                                    <div class="trav-btn__icon flex-center">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <div>
                                        <span class="fw-500">
                                            {{ ucfirst($traveller->type) }}:
                                        </span>
                                        Traveller {{ $index + 1 }}
                                    </div>
                                </button>
                            @endforeach

                            <button type="button"
                                class="btn btn-outline-secondary trav-btn d-flex gap-2 align-items-center w-auto"
                                id="addTravellerTab">

                                <div class="trav-btn__icon flex-center">
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                                <div>
                                    <span class="fw-500">Add Traveller</span>
                                </div>
                            </button>
                        </div>

                        <!-- INFO -->
                        <div class="mb-3">
                            <h6 class="fw-600 p">Mandatory Information</h6>
                            <p class="p-small text-light2">
                                <i class="fa-solid fa-circle-info"></i>
                                Please Enter Mandatory Information
                            </p>
                        </div>

                        <!-- FORM -->
                        <div class="row g-3">

                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">First Name *</label>
                                <input type="text" name="first_name" id="first_name" class="form-control">
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">Last Name *</label>
                                <input type="text" name="last_name" id="last_name" class="form-control">
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">Date of Birth *</label>
                                <input type="date" name="dob" id="dob" class="form-control">
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">Gender *</label>
                                <select name="gender" id="gender" class="form-select">
                                    <option value="">Select</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">Country *</label>
                                <input type="text" name="country" id="country" class="form-control">
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">Traveller Type *</label>
                                <select name="type" id="type" class="form-select">
                                    <option value="">Select Type</option>
                                    <option value="adult">Adult</option>
                                    <option value="child">Child</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer traveller-footer">
                        <button type="button" class="btn btn-outline-secondary px-3 rounded-pill"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-success px-3 rounded-pill">
                            Confirm Details
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const modal = document.getElementById('travellerModal');
            const form = modal.querySelector('form');

            const fields = {
                traveller_id: document.getElementById('traveller_id'),
                first_name: document.getElementById('first_name'),
                last_name: document.getElementById('last_name'),
                dob: document.getElementById('dob'),
                gender: document.getElementById('gender'),
                country: document.getElementById('country'),
                type: document.getElementById('type'),
            };

            /* ---------------------------------
               FILL FORM FROM BUTTON DATA
            --------------------------------- */
            function fillFormFromButton(btn) {
                fields.traveller_id.value = btn.dataset.id || '';
                fields.first_name.value = btn.dataset.first || '';
                fields.last_name.value = btn.dataset.last || '';
                fields.dob.value = btn.dataset.dob || '';
                fields.gender.value = btn.dataset.gender || '';
                fields.country.value = btn.dataset.country || '';
                fields.type.value = btn.dataset.type || '';

                setActive(btn);
            }

            /* ---------------------------------
               ACTIVE TAB HANDLER
            --------------------------------- */
            function setActive(activeBtn) {
                modal.querySelectorAll('.trav-btn').forEach(btn =>
                    btn.classList.remove('active')
                );
                activeBtn.classList.add('active');
            }

            /* ---------------------------------
               TAB CLICK (EVENT DELEGATION)
            --------------------------------- */
            modal.addEventListener('click', e => {
                const btn = e.target.closest('.trav-btn[data-id]');
                if (!btn) return;

                e.preventDefault();
                fillFormFromButton(btn);
            });

            /* ---------------------------------
               ADD TRAVELLER
            --------------------------------- */
            const addBtn = document.getElementById('addTravellerTab');
            if (addBtn) {
                addBtn.addEventListener('click', () => {
                    form.reset();
                    fields.traveller_id.value = '';
                    setActive(addBtn);
                });
            }

            /* ---------------------------------
               🔥 CRITICAL FIX (FIRST OPEN ISSUE)
               Modal open hote hi active tab click
            --------------------------------- */
            modal.addEventListener('shown.bs.modal', () => {

                const firstBtn =
                    modal.querySelector('.trav-btn.active[data-id]') ||
                    modal.querySelector('.trav-btn[data-id]');

                if (firstBtn) {
                    firstBtn.click(); // ✅ THIS FIXES FIRST TIME ISSUE
                }
            });

            /* ---------------------------------
               FORM SUBMIT (AJAX, NO JQUERY)
            --------------------------------- */
            form.addEventListener('submit', async e => {
                e.preventDefault();

                const travellerId = fields.traveller_id.value;
                const isUpdate = travellerId !== '';

                const url = isUpdate ?
                    `/account/travellers/${travellerId}` :
                    `/account/travellers`;

                try {
                    const res = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: new FormData(form)
                    });

                    if (!res.ok) throw new Error('Request failed');

                    // ✅ PAGE RELOAD AS REQUESTED
                    window.location.reload();

                } catch (err) {
                    alert('Something went wrong. Please try again.');
                    console.error(err);
                }
            });

            /* ===============================
               DELETE TRAVELLER
            =============================== */
            document.addEventListener('click', async e => {

                const delBtn = e.target.closest('.delete-traveller-btn');
                if (!delBtn) return;

                const travellerId = delBtn.dataset.id;
                if (!travellerId) return;

                if (!confirm('Are you sure you want to delete this traveller?')) return;

                try {
                    const res = await fetch(`/account/travellers/${travellerId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        }
                    });

                    if (!res.ok) throw new Error();
                    location.reload();

                } catch {
                    alert('Unable to delete traveller');
                }
            });

        });
    </script>
@endsection
