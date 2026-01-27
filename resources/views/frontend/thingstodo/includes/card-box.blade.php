@php $t = $thing->translation;
$cityName = $thing->city?->translationData?->name;
$categoryName = $thing->category?->translationData?->name;
@endphp
<div class="upcoming-event__carousel-item swiper-slide">
    <div class="upcoming-event__carousel-item-img">
        <img src="{{ asset('frontend/assets/things_to_do/upcoming_events/cultural_performances.jpg') }}" alt="Event" class="img-fluid">
        <!-- <div class="upcoming-event__carousel-item-dates">
            <p>25 Aug 2025</p>
            <div class="vertical-divider"></div>
            <p>28 Aug 2025</p>
        </div> -->
    </div>
    <div class="upcoming-event__carousel-item-info">
        <button class="btn btn-primary rounded-pill btn-sm gap-1"><i
                class="fa-solid fa-location-dot"></i> {{$cityName}}
            | {{$categoryName}}</button>
        <div class="d-flex justify-content-between mt-3">
            <h5 class="fw-bold">{{ $t?->name }}</h5>
            <a href="{{ route('things-to-do.show', ['slug' => $thing->slug]) }}" class="p-large">
                <i class="fa-solid fa-arrow-right-long primary-text"></i>
            </a>
        </div>
    </div>
</div>
