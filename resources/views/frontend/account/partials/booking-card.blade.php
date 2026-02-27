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
<style>
    /* Make the card stretch */
.booking-package-card {
    height: 100%;
    display: flex;
    flex-direction: column;
}

/* Info section takes remaining space */
.exclusive-offers__carousel-item-info {
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* Footer always at bottom */
.card-actions {
    margin-top: auto;
    gap: 12px;
}
/* Fixed height for title + badge row */
.title-row {
    align-items: flex-start; /* ❗ stops badge stretching */
}

.duration-badge {
    flex-shrink: 0;
    height: 36px;
    min-width: 80px;
}
.user-bookings__view-details-btn {
    padding: 8px 16px;         /* desktop */
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
    </style>
<div class="col-md-6 col-lg-6 col-xl-4">
    <div class="exclusive-offers__carousel-item user-bookings__card h-100 booking-package-card">

        <div class="exclusive-offers__carousel-item-img">
            <img src="{{ asset('storage/' . $thumbPath) }}">

            <div class="badge carousel-badge">
                <i class="fa-solid fa-location-dot"></i>
                {{ $firstCityName }}
            </div>
        </div>

        <div class="exclusive-offers__carousel-item-info d-flex flex-column h-100">

{{-- TITLE --}}
<div class="d-flex justify-content-between mb-1 title-row">
    <h6 class="fw-bold package-title">
    {{ \Illuminate\Support\Str::limit(strip_tags($booking->package?->translation?->title), 50) }}
    </h6>

    <span class="badge carousel-badge-outline rounded-pill duration-badge">
        {{ $booking->snapshot?->snapshot_json['package']['duration_nights'] ?? 0 }}N /
        {{ $booking->snapshot?->snapshot_json['package']['duration_days'] ?? 0 }}D
    </span>
</div>

<hr>

{{-- FEATURES --}}
<ul class="exclusive-offers__carousel-features-list">
    @if ($groupedItems->has('hotel'))
        <li><span>{{ $groupedItems['hotel']->count() }} {{ __('booking.hotels') }}</span></li>
    @endif
    @if ($groupedItems->has('event'))
        <li><span>{{ $groupedItems['event']->count() }} {{ __('booking.activities') }}</span></li>
    @endif
    @if ($groupedItems->has('todo'))
        <li><span>{{ $groupedItems['todo']->count() }} {{ __('booking.things_to_do') }}</span></li>
    @endif
    @if ($groupedItems->has('transport'))
        <li><span>{{ $groupedItems['transport']->count() }} {{ __('booking.transport') }}</span></li>
    @endif
</ul>

{{-- FOOTER (NOW WORKS) --}}
<div class="exclusive-offers__carousel-price-box ps-0 d-flex card-actions">
    <div class="badge carousel-badge py-2 px-3 rounded-start-0 {{ $badgeClass }}">
        {{ $label }}
    </div>


    <button
                        class="btn btn-outline-primary user-bookings__view-details-btn gap-0 px-2 rounded-pill fw-500"
                        data-bs-toggle="offcanvas" data-bs-target="#viewBookingDetailsSideDrawer"
                        data-label="{{ $label }}" data-badge-class="{{ $badgeClass }}"
                        data-thumb="{{ asset('storage/' . $thumbPath) }}"
                        data-title="{{ $booking->package?->translation?->title }}" data-route="{{ $cityRouteText }}"
                        data-total="{{ number_format((float) $booking->booking_total_amount, 2) }}"
                        data-travellers="{{ $booking->total_person }}"
                        data-date="{{ \Carbon\Carbon::parse($booking->created_at)->format('d M, Y') }}"
                        data-days='@json($daysPayload)'
                        data-currency-icon="{{ asset(currency_icon_path($booking->booking_currency, 'light')) }}"
                        data-payments='@json($booking->payments)'>
                        {{ __('booking.view_details') }}
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
</div>

</div>
    </div>
</div>
