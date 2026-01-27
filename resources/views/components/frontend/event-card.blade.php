@props(['event'])

<div class="upcoming-event__carousel-item swiper-slide">
    <div class="upcoming-event__carousel-item-img">
        <img src="{{ asset('storage/' . $event?->thumb?->image_path) }}" alt="Event" class="img-fluid">
        <div class="upcoming-event__carousel-item-dates">
            <p>
                @if ($event->start_date)
                    {{ \App\Helpers\DateHelper::badge($event->start_date) }}
                @endif

            </p>
            <div class="vertical-divider"></div>
            <p>
                @if ($event->end_date)
                    <span class="date-badge">
                        {{ \App\Helpers\DateHelper::badge($event->end_date) }}
                    </span>
                @endif
            </p>

        </div>
    </div>
    <div class="upcoming-event__carousel-item-info">
        <button class="btn btn-primary rounded-pill btn-sm gap-1"><i class="fa-solid fa-location-dot"></i>
            {{ \Illuminate\Support\Str::title(str_replace('-', ' ', $event->city->slug)) }}
            | {{ \Illuminate\Support\Str::title(str_replace('-', ' ', $event->category->slug)) }}
        </button>
        <div class="d-flex justify-content-between mt-3">
            <h5 class="fw-bold">{{ $event->translation->title }}</h5>
            <a href="{{route('event.show',$event->slug)}}" class="p-large">
                <i class="fa-solid fa-arrow-right-long primary-text"></i>
            </a>
        </div>
    </div>
</div>
