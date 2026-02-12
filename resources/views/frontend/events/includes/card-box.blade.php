@php
    $t = $event->translation;
    $cityName = $event->city?->translationData?->name;
    $categoryNames = $event->eventCategories->pluck('category.translationData.name')->filter()->implode(', ');

    $start_date = $event?->start_date ? \Carbon\Carbon::parse($event->start_date)->format('d M Y') : null;

    $end_date = $event?->end_date ? \Carbon\Carbon::parse($event->end_date)->format('d M Y') : null;
@endphp

<div class="upcoming-event__carousel-item swiper-slide position-relative">
    <div class="upcoming-event__carousel-item-img">
        <img src="{{ asset('storage/' . $event->thumb->image_path) }}" alt="Event" class="img-fluid">

        <div class="upcoming-event__carousel-item-dates">
            @if ($start_date)
                <p>{{ $start_date }}</p>
            @endif

            @if ($start_date && $end_date)
                <div class="vertical-divider"></div>
            @endif

            @if ($end_date)
                <p>{{ $end_date }}</p>
            @endif
        </div>

    </div>
    <div class="upcoming-event__carousel-item-info">
        <button class="btn btn-primary rounded-pill btn-sm gap-1 text-ellipsis-1"><i class="fa-solid fa-location-dot"></i>
            {{ $cityName }}
            @if ($categoryNames)
                | {{ $categoryNames }}
            @endif
        </button>
        <div class="d-flex justify-content-between mt-3">
            <h5 class="fw-bold text-ellipsis-1">{{ $t?->title }}</h5>
            <a href="{{ route('event.show', ['slug' => $event->slug]) }}" class="p-large stretched-link">
                <i class="fa-solid fa-arrow-right-long primary-text"></i>
            </a>
        </div>
    </div>
</div>
