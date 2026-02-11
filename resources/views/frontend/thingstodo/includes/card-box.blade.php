@php
    $t = $thing->translation;
    $cityName = $thing->city?->translationData?->name;
    $categoryName = $thing->category?->translationData?->name;
@endphp
<div class="upcoming-event__carousel-item swiper-slide position-relative">
    <div class="upcoming-event__carousel-item-img">
        <img src="{{ asset('storage/' . $thing->thumb->image_path) }}" alt="Event" class="img-fluid">
    </div>
    <div class="upcoming-event__carousel-item-info">
        <button class="btn btn-primary rounded-pill btn-sm gap-1"><i class="fa-solid fa-location-dot"></i>
            {{ $cityName }}
            | {{ $categoryName }}</button>
        <div class="d-flex justify-content-between mt-3">
            <h5 class="fw-bold text-ellipsis-1">{{ $t?->name }}</h5>
            <a href="{{ route('things-to-do.show', ['slug' => $thing->slug]) }}" class="p-large stretched-link">
                <i class="fa-solid fa-arrow-right-long primary-text"></i>
            </a>
        </div>
    </div>
</div>
