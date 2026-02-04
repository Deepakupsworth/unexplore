@php
    /**
     |--------------------------------------------------------------------------
     | SNAPSHOT BASED DATA (Single Source of Truth)
     |--------------------------------------------------------------------------
     */

    // Snapshot days
    $snapshotDays = collect(
        $booking->snapshot->snapshot_json['package']['days'] ?? []
    );

    // ---------- City stats (for route text) ----------
    $cityStats = $snapshotDays
        ->groupBy(fn($day) => $day['city']['translation']['name'] ?? null)
        ->filter(fn($group, $city) => !empty($city))
        ->map(fn($cityDays) => [
            'days' => $cityDays->count(),
            'nights' => max(0, $cityDays->count() - 1),
        ]);

    $cityRouteText = $cityStats
        ->map(fn($stat, $city) => "{$stat['nights']}N {$city}")
        ->implode(' • ');

    // ---------- Items (hotel / event / todo / transport) ----------
    $snapshotItems = $snapshotDays
        ->flatMap(fn ($day) => collect($day['items'] ?? []));

    $groupedItems = $snapshotItems->groupBy('item_type');

    // ---------- City badge (image overlay) ----------
    $cities = $snapshotDays
        ->pluck('city.translation.name')
        ->filter()
        ->unique()
        ->values();

    $firstCityName = $cities->first();
    $extraCitiesCount = max(0, $cities->count() - 1);
@endphp

@php
    $thumbPath =
        isset($booking->snapshot->snapshot_json['thumb']) &&
        isset($booking->snapshot->snapshot_json['thumb']['image_path'])
            ? $booking->snapshot->snapshot_json['thumb']['image_path']
            : 'defaults/package.jpg';
@endphp


<div class="col-md-6 col-lg-6 col-xl-4">
    <div class="exclusive-offers__carousel-item user-bookings__card h-100">

        <div class="exclusive-offers__carousel-item-img">

            <img src="{{ asset('storage/' . $thumbPath) }}">

            <div class="badge carousel-badge">
                <i class="fa-solid fa-location-dot"></i>
                {{ $firstCityName }}
            </div>
        </div>
        <div class="exclusive-offers__carousel-item-info d-flex flex-column justify-content-between h-100">

            <div>
                <div class="d-flex justify-content-between mb-1">
                    <h6 class="fw-bold">
                        {{ $booking->package?->translation?->title ?? '' }}
                    </h6>
                    <span
                        class="badge carousel-badge-outline rounded-pill">{{ $booking->snapshot?->snapshot_json['package']['duration_nights'] }}N/{{ $booking->snapshot?->snapshot_json['package']['duration_days'] }}D</span>
                </div>

                <p class="text-muted small mb-2">
                    @foreach ($cityStats as $city => $stat)
                        {{ $stat['nights'] }}N {{ $city }}
                        @if (!$loop->last)
                            •
                        @endif
                    @endforeach
                </p>

                <hr>

                <ul class="exclusive-offers__carousel-features-list">

                    @if($groupedItems->has('hotel'))
                        <li><span>{{ $groupedItems['hotel']->count() }} Hotels</span></li>
                    @endif

                    @if($groupedItems->has('event'))
                        <li><span>{{ $groupedItems['event']->count() }} Activities</span></li>
                    @endif

                    @if($groupedItems->has('todo'))
                        <li><span>{{ $groupedItems['todo']->count() }} Things To Do</span></li>
                    @endif

                    @if($groupedItems->has('transport'))
                        <li>
                            <span>{{ $groupedItems['transport']->count() }} Transport</span>
                        </li>
                    @endif

                </ul>


                <div class="exclusive-offers__carousel-price-box ps-0 d-flex justify-content-between">
                    <div class="badge carousel-badge py-2 px-3 rounded-start-0 {{ $badgeClass }}">{{ $label }}
                    </div>
                    <button href="#"
                        class="btn btn-outline-primary user-bookings__view-details-btn gap-0 px-2 rounded-pill fw-500"
                        data-bs-toggle="offcanvas" data-bs-target="#viewBookingDetailsSideDrawer"
                        data-label="{{ $label }}"
                        data-thumb="{{ asset('storage/' . $thumbPath) }}"
                        data-title="{{ $booking->package?->translation?->title }}"
                        data-route="{{ $cityRouteText }}"
                        data-total="{{ number_format($booking->booking_total_amount) }}"
                        data-travellers="{{ $booking->total_person }}"
                        data-date="{{ \Carbon\Carbon::parse($booking->created_at)->format('d M, Y') }}"
                        data-days='@json($booking->snapshot->snapshot_json["package"]["days"] ?? [])'>
                        View Details
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="offcanvas offcanvas-end view-booking-detail-side-drawer" tabindex="-1" id="viewBookingDetailsSideDrawer"
    aria-labelledby="viewBookingDetailsSideDrawerLabel">
    <div class="offcanvas-header side-drawer__header">
        <p class="offcanvas-title fw-600" id="viewBookingDetailsSideDrawerLabel">Booking Details</p>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body side-drawer__booking-body">
        <div class="booking-card mb-3 position-relative">
            <span class="badge-upcoming rounded-pill p-small" id="drawerLabel"></span>
            <img id="thumbImage" src="" class="booking-image" alt="Booking Image">
        </div>
        <!-- Title -->
        <h6 class="fw-600 p-large text-black" id="bookingTitle"></h6>
        <p class="text-light2 mb-3" id="bookingRoute"></p>


        <!-- Amenities -->
        <div class="mb-4 text-light2 p-small fw-500 side-drawer__booking-amenities" id="drawerAmenities">

        </div>

        <hr>

        <!-- Booking Details -->
        <p class="fw-600 text-black mb-3">Booking Details</p>
        <div class="d-flex gap-3 mb-2">
            <img src="{{ asset('frontend/assets/icons/drag-vertical.svg') }}" alt="Vertical Drag Icon">
            <div class="booking-details__item">
                <span class="booking-details__item-title">Date</span>
                <span class="fw-500 d-flex gap-3">
                    <span class="text-black fw-600">:</span>
                    <span id="bookingDate"></span>
                </span>
            </div>
        </div>
        <div class="d-flex gap-3 mb-2">
            <img src="{{ asset('frontend/assets/icons/drag-vertical.svg') }}" alt="Vertical Drag Icon">
            <div class="booking-details__item">
                <span class="booking-details__item-title">Total Amount</span>
                <span class="fw-500 d-flex gap-3">
                    <span class="text-black fw-600">:</span>
                    ₹<span id="bookingTotal"></span>
                </span>

            </div>
        </div>
        {{-- <div class="d-flex gap-3 mb-2">
            <img src="{{ asset('frontend/assets/icons/drag-vertical.svg') }}" alt="Vertical Drag Icon">
            <div class="booking-details__item">
                <span class="booking-details__item-title">Payment Type</span>
                <span class="fw-500 d-flex gap-3"><span class="text-black fw-600">:</span>Bank Transfer</span>
            </div>
        </div>
        <div class="d-flex gap-3 mb-2">
            <img src="{{ asset('frontend/assets/icons/drag-vertical.svg') }}" alt="Vertical Drag Icon">
            <div class="booking-details__item">
                <span class="booking-details__item-title">Transaction ID</span>
                <span class="fw-500 d-flex gap-3"><span class="text-black fw-600">:</span>#15569745569</span>
            </div>
        </div>
        <button class="btn btn-outline-secondary mt-3 text-black rounded-4">
            <i class="fa-solid fa-receipt"></i> Download Invoice
        </button> --}}
    </div>

    <div class="offcanvas-footer border-top text-end p-3">
        <button class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="offcanvas">Cancel</button>
    </div>
</div>

