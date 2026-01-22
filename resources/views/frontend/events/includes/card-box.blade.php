@php $t = $event->translation; 
$cityName = $event->city?->translationData?->name;
$categoryName = $event->category?->translationData?->name;
$start_date = \Carbon\Carbon::parse($event->start_date)->format('d M Y');
$end_date = \Carbon\Carbon::parse($event->end_date)->format('d M Y');
@endphp
<div class="upcoming-event__carousel-item swiper-slide">
    <div class="upcoming-event__carousel-item-img">
        <img src="{{ asset('frontend/assets/things_to_do/upcoming_events/cultural_performances.jpg') }}" alt="Event" class="img-fluid">
        <div class="upcoming-event__carousel-item-dates">
            <p>{{$start_date }}</p>
            <div class="vertical-divider"></div>
            <p>{{$end_date}}</p>
        </div>
    </div>
    <div class="upcoming-event__carousel-item-info">
        <button class="btn btn-primary rounded-pill btn-sm gap-1"><i
                class="fa-solid fa-location-dot"></i> {{$cityName}}
            | {{$categoryName}}</button>
        <div class="d-flex justify-content-between mt-3">
            <h5 class="fw-bold">{{ $t?->title }}</h5>
            <a href="{{ route('event.show', ['slug' => $event->slug]) }}" class="p-large">
                <i class="fa-solid fa-arrow-right-long primary-text"></i>
            </a>
        </div>
    </div>
</div>