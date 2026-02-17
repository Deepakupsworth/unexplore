@php
    /**
|--------------------------------------------------------------------------
| LIVE BOOKING DATA (DB is Source of Truth)
|--------------------------------------------------------------------------
*/
    $daysPayload = $booking->days
        ->map(function ($day) {
            return [
                'day_number' => $day->day_number,
                'city_name' => $day->city_name,
                'items' => $day->dayItems
                    ->map(function ($item) {
                        return [
                            'item_type' => $item->item_type,
                            'title' => $item->title,
                            'image_path' => $item->meta_json['image_path'] ?? null,
                            'start_time' => $item->start_time,
                            'end_time' => $item->end_time,
                            'extra_price' => (float) $item->extra_price,
                        ];
                    })
                    ->values(),
            ];
        })
        ->values();

    /* ---------- Route text ---------- */
    $cityRouteText = "{$booking->package->duration_nights}N / {$booking->package->duration_days}D";

    /* ---------- Item counts ---------- */
    $groupedItems = collect($daysPayload)->flatMap(fn($day) => $day['items'])->groupBy('item_type');

    /* ---------- First city ---------- */
    $firstCityName = $booking->days->first()?->city_name;

    /* ---------- Thumb ---------- */
    $thumbPath = $booking?->snapshot?->snapshot_json['thumb']['image_path'] ?? 'defaults/package.jpg';
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

                {{-- TITLE --}}
                <div class="d-flex justify-content-between mb-1">
                    <h6 class="fw-bold">
                        {{ $booking->package?->translation?->title ?? '' }}
                    </h6>
                    <span class="badge carousel-badge-outline rounded-pill">
                        {{ $booking->snapshot?->snapshot_json['package']['duration_nights'] ?? 0 }}N /
                        {{ $booking->snapshot?->snapshot_json['package']['duration_days'] ?? 0 }}D
                    </span>
                </div>

                {{-- ROUTE --}}
                <p class="text-muted small mb-2">
                    {{ $cityRouteText }}
                </p>

                <hr>

                {{-- FEATURES --}}
                <ul class="exclusive-offers__carousel-features-list">

                    @if ($groupedItems->has('hotel'))
                        <li><span>{{ $groupedItems['hotel']->count() }} Hotels</span></li>
                    @endif

                    @if ($groupedItems->has('event'))
                        <li><span>{{ $groupedItems['event']->count() }} Activities</span></li>
                    @endif

                    @if ($groupedItems->has('todo'))
                        <li><span>{{ $groupedItems['todo']->count() }} Things To Do</span></li>
                    @endif

                    @if ($groupedItems->has('transport'))
                        <li><span>{{ $groupedItems['transport']->count() }} Transport</span></li>
                    @endif

                </ul>

                {{-- BUTTON --}}
                <div class="exclusive-offers__carousel-price-box ps-0 d-flex justify-content-between">
                    <div class="badge carousel-badge py-2 px-3 rounded-start-0 {{ $badgeClass }}">
                        {{ $label }}
                    </div>

                    <button
                        class="btn btn-outline-primary user-bookings__view-details-btn gap-0 px-2 rounded-pill fw-500"
                        data-bs-toggle="offcanvas" data-bs-target="#viewBookingDetailsSideDrawer"
                        data-label="{{ $label }}" data-badge-class="{{ $badgeClass }}"
                        data-thumb="{{ asset('storage/' . $thumbPath) }}"
                        data-title="{{ $booking->package?->translation?->title }}" data-route="{{ $cityRouteText }}"
                        data-total="{{ number_format($booking->booking_total_amount) }}"
                        data-travellers="{{ $booking->total_person }}"
                        data-date="{{ \Carbon\Carbon::parse($booking->created_at)->format('d M, Y') }}"
                        data-days='@json($daysPayload)'
                        data-currency-icon="{{ asset(currency_icon_path($booking->booking_currency, 'light')) }}"
                        data-payments='@json($booking->payments)'>
                        View Details
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
