@extends('frontend.layout')
@section('content')
    {{-- @dd($event) --}}
    @php
        use Illuminate\Support\Str;
        $currentEvent = $event;
        $videoUrl = $currentEvent->video_url ?? null;
    @endphp

    <!-- 1. EVENT DETAILS: BANNER  -->
    <section class="hero-banner hero-banner-fullscreen">
        {{-- YouTube / Vimeo --}}
        {{-- @if ($videoUrl && Str::contains($videoUrl, ['youtube', 'youtu.be', 'vimeo']))
        <iframe
            class="hero-banner__video"
            src="{{ $videoUrl }}"
            frameborder="0"
            allow="autoplay; fullscreen"
            allowfullscreen>
        </iframe>
        @endif --}}

        @if ($videoUrl)
            {{-- MP4 Video --}}
            <video class="hero-banner__video" autoplay muted loop playsinline
                poster="{{ asset('frontend/assets/hero-banner-bg.png') }}">
                <source src="{{ $videoUrl }}" type="video/mp4">
                {{ __('common.video_not_supported') }}
            </video>
        @elseif ($event->thumb)

            {{-- Thumbnail Image --}}
            <img class="hero-banner__image" src="{{ asset('storage/' .$event->thumb->image_path) }}"
                alt="{{ $event->translation?->title ?? 'Banner' }}">
        @else
            {{-- Default Fallback Video --}}
            <video class="hero-banner__video" autoplay muted loop playsinline
                poster="{{ asset('frontend/assets/hero-banner-bg.png') }}">
                <source src="{{ asset('frontend/assets/videos/seekers-entry-video.mp4') }}" type="video/mp4">
                {{ __('common.video_not_supported') }}
            </video>
        @endif


        <!-- <img class="hero-banner__image" src="../assets/hero-banner-bg.png" alt="Banner"> -->
        <div class="container">
            <div class="dest-details-banner__content flex-column gap-3 text-center">
                <h1 class="text-white w-100">{{ $event->translation->title }}</h1>
                <h5>{{ $event->translation->sub_title }}.</h5>

                <div class="dest-details-banner__btn-group">
                    @if ($currentEvent?->gallery && $currentEvent?->gallery->count() > 0)
                        <button class="btn btn-primary rounded-pill" data-bs-toggle="modal"
                            data-bs-target="#eventGalleryModal">{{ __('thing_detail.banner.see_images') }}</button>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- 2. EVENT DETAILS: DESCRIPTION -->
    <section class="section-padding-md dest-details-description">
        <div class="container">
            <div class="section__header">
                <div class="section__header-content">
                    <h2 class="section__heading">{{ $event->translation->title }}</h2>
                    <p class="section__description">
                        {!! $event->translation->description !!}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. EVENT DETAILS: EVENT INFO -->
    <section class="event-info-section section-padding-md pt-0">
        <div class="container">
            <div class="event-info-wrapper d-flex align-items-center text-white">

                <!-- Event Date -->
                <div class="event-info__block">
                    <p class="p-large mb-2">
                        <i class="fa-regular fa-calendar"></i>
                        {{ __('event_details.info.event_date') }}
                    </p>
                    <h5 class="m-0 fw-bold">
                        {{ \App\Helpers\DateHelper::format($event->start_date) }}
                    </h5>
                </div>

                <div class="event-divider"></div>

                <!-- Location -->
                <div class="event-info__block">
                    <p class="p-large mb-2">
                        <i class="fa-solid fa-location-dot"></i>
                        {{ __('event_details.info.location') }}
                    </p>
                    <h6 class="m-0 fw-bold">{{ $event->location }}</h6>
                </div>

                <div class="event-divider"></div>

                <!-- Price + Buttons -->
                <div class="d-flex align-items-center gap-3 justify-content-between w-100 event-info__block">
                    <div>
                        <p class="p-large mb-2">
                            {{ __('event_details.info.starting_from') }}
                        </p>
                        <h5 class="m-0 fw-bold">
                            {{ \App\Helpers\DateHelper::format($event->start_date) }}
                        </h5>
                    </div>

                    {{-- <div class="d-flex align-items-center gap-3">
                        <button
                            class="btn btn-outline-light rounded-circle d-flex align-items-center justify-content-center heart-btn">
                            <i class="fa-regular fa-heart"></i>
                        </button>

                        <button class="btn btn-success d-flex align-items-center gap-5 px-4 py-3 rounded-pill">
                            Buy Tickets <i class="fa-solid fa-ticket"></i>
                        </button>
                    </div> --}}
                </div>

            </div>
        </div>
    </section>

    <section class="event-details__overview">
        <div class="container">
            <div class="d-flex justify-content-between flex-column flex-sm-row">
                <div class="py-3 event-details__overview-title flex-center">
                    <p class="p-large fw-bold primary-text">
                        {{ __('event_details.overview.title') }}
                    </p>
                </div>

                <div class="d-flex align-items-center gap-4 py-3">
                    <p class="p-large fw-500">
                        {{ __('event_details.overview.share_text') }}
                    </p>
                    <div class="d-flex gap-3">
                        
                        <x-share-links a-class="social-icon" icon-size="icon-sm" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding-md event-map-info offwhite-bg">
        <div class="container">
            <div class="row gy-3">
                <div class="col-lg-8">
                    @php
                        $lat = $event->latitude;
                        $lng = $event->longitude;
                    @endphp

                    @if ($lat && $lng)
                        <div class="event-map__card position-relative rounded-5 overflow-hidden">

                            {{-- Google Map --}}
                            <iframe width="100%" height="500" style="border:0;" loading="lazy" allowfullscreen
                                referrerpolicy="no-referrer-when-downgrade"
                                src="https://www.google.com/maps?q={{ $lat }},{{ $lng }}&hl=en&z=14&output=embed">
                            </iframe>

                            {{-- Get Directions --}}
                            <a href="https://www.google.com/maps/dir/?api=1&destination={{ $lat }},{{ $lng }}"
                                target="_blank"
                                class="event-map__card-btn btn btn-primary rounded-pill py-2 px-3 position-absolute bottom-0 end-0 m-3">
                                {{ __('event_details.map.get_directions') }}
                            </a>

                        </div>
                    @endif
                </div>

                <div class="col-lg-4">

                    <!-- Information card -->
                    <div class="event-map__info-card rounded-5 mb-3">
                        <h6 class="fw-600 p-large mb-2">
                            {{ __('event_details.info_card.title') }}
                        </h6>

                        <div class="event-map__info-card-row flex-v-center rounded-4 gap-1 mb-3">
                            <div class="icon primary-text flex-center">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <p class="text-light2 p-small">
                                    {{ __('event_details.info_card.location_label') }}
                                </p>
                                <p class="p-large fw-600">{{ $event->location }}</p>
                            </div>
                        </div>

                        <div class="event-map__info-card-row flex-v-center rounded-4 gap-1">
                            <div class="icon primary-text flex-center">
                                <i class="fa-regular fa-clock"></i>
                            </div>
                            <div>
                                <p class="text-light2 p-small">
                                    {{ __('event_details.info_card.time_label') }}
                                </p>
                                <p class="p-large fw-600">
                                    {{ $event->opening_days }} :
                                    {{ \App\Helpers\TimeHelper::range($event->opening_time, $event->closing_time) }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Weather card -->
                    <div class="event-map__info-card rounded-5 position-relative pb-5">
                        <p class="fw-600 p-large">
                            {{ __('event_details.weather.title') }}
                        </p>
                        <p class="event-map__info-temp fw-bold">30.4°</p>
                        <div class="text-success event-map__info-weather-status">
                            <i class="fa-regular fa-moon"></i>
                            {{ __('event_details.weather.status') }}
                        </div>
                        <div class="event-map__info-weather-decor"></div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    @if ($similarEvents->count() > 0)
        <section class="section-padding-md">
            <div class="container">
                <div class="section__header">
                    <div class="section__header-content">
                        <h2 class="section__heading">
                            {{ __('event_details.similar.title') }}
                        </h2>
                        <p class="section__description">
                            {{ __('event_details.similar.description') }}
                        </p>
                    </div>
                    <div class="section__header-CTA">
                        <a href="{{ route('event.listing') }}" class="btn btn-primary rounded-pill">
                            {{ __('common.view_all') }}
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </div>
                </div>

                <div class="upcoming-event__carousel swiper">
                    <div class="upcoming-event__carousel-wrapper swiper-wrapper">
                        @foreach ($similarEvents as $event)
                            <x-frontend.event-card :event="$event" />
                        @endforeach
                    </div>
                    <div class="custom__carousel-pagination"></div>
                </div>
            </div>
        </section>
    @endif
    @if ($relatedPackages->count() > 0)
        <section class="exclusive-offers section-padding-md">
            <div class="container">
                <div class="section__header">
                    <div class="section__header-content">
                        <h2 class="section__heading">
                            {{ __('event_details.related_packages.title') }}
                        </h2>
                        <p class="section__description">
                            {{ __('event_details.related_packages.description') }}
                        </p>
                    </div>
                    <div class="section__header-CTA">
                        <a href="{{ route('packages.index') }}" class="btn btn-primary rounded-pill">
                            {{ __('common.view_all') }}
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </div>
                </div>

                <div class="exclusive-offers__carousel swiper">
                    <div class="swiper-wrapper">
                        @foreach ($relatedPackages as $package)
                            <div class="exclusive-offers__carousel-item swiper-slide">
                                <x-frontend.package-card :package="$package" />
                            </div>
                        @endforeach
                    </div>
                    <div class="custom__carousel-pagination"></div>
                </div>
            </div>
        </section>
    @endif

    @include('frontend.events.partials.event-gallery-modal')
@endsection
