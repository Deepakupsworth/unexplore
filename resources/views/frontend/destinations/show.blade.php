@extends('frontend.layout')
@section('content')

    @php
        $currentCity = $city;

        use Illuminate\Support\Str;

        $videoUrl = $currentCity->video_url ?? null;

    @endphp
    <!-- 1. DESTINATION DETAILS BANNER SECTION  -->
    <section class="hero-banner dest-details-banner">
        {{-- <video class="hero-banner__video" autoplay muted loop playsinline poster="../assets/hero-banner-bg.png">
            <source src="{{ asset('frontend/assets/videos/seekers-entry-video.mp4') }}" type="video/mp4">
            {{ __('common.video_not_supported') }}
        </video> --}}

        @if ($videoUrl)
            {{-- Any other video URL (MP4, CDN, S3, etc.) --}}
            <video class="hero-banner__video" autoplay muted loop playsinline>
                <source src="{{ $videoUrl }}">
                {{ __('common.video_not_supported') }}
            </video>
        @elseif ($currentCity->thumb_image)
            {{-- Thumbnail fallback --}}
            <img class="hero-banner__image" src="{{ asset('storage/' . $currentCity->thumb_image) }}"
                alt="{{ $currentCity->translation?->name ?? 'Banner' }}">
        @else
            {{-- Final fallback --}}
            <video class="hero-banner__video" autoplay muted loop playsinline
                poster="{{ asset('frontend/assets/hero-banner-bg.png') }}">
                <source src="{{ asset('frontend/assets/videos/seekers-entry-video.mp4') }}">
                {{ __('common.video_not_supported') }}
            </video>
        @endif

        <!-- <img class="hero-banner__image" src="../assets/hero-banner-bg.png" alt="Banner"> -->
        <div class="container">
            <div class="dest-details-banner__content">
                <h1>
                    {{ __('destination_details.banner.title_prefix') }}
                    <strong>{{ $city->translation->name }}</strong>
                </h1>

                <img src="{{ asset('frontend/assets/hero-banner-vision.png') }}" alt="Vision 2030"
                    class="dest-details-banner__vision d-none-sm d-none-md">

                <div class="dest-details-banner__btn-group">
                    @if($city->package_count > 0)
                    <a href="{{ route('packages.index', ['cities[]' => $city->id]) }}" class="btn btn-outline-light gap-1 rounded-pill">
                        {{ __('destination_details.banner.related_packages') }}
                        <strong>({{ $city->package_count }})</strong>
                    </a>
                    @endif
                    @if ($city?->gallery && $city?->gallery->count() > 0)
                        <button class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#galleryModal">
                            {{ __('destination_details.banner.see_images') }}</button>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- 2. DESTINATION DETAILS DESCRIPTION -->
    <section class="section-padding-md dest-details-description">
        <div class="container">
            <div class="section__header">
                <div class="section__header-content">
                    <h2 class="section__heading">
                        {{ __('destination_details.about.title_prefix') }}
                        {{ $city->translation->name }}
                    </h2>

                    <p class="section__description">
                        {!! $city->translation->about !!}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. DESTINATION DETAILS: TO DO THINGS -->
    @if ($things->count() > 0)
        <section class="dis-adventure section-padding-md">
            <div class="container">
                <div class="section__header">
                    <div class="section__header-content">
                        <h2 class="section__heading">
                            {{ __('destination_details.todo.title') }}
                        </h2>

                        <p class="section__description">
                            {{ __('destination_details.todo.description') }}
                        </p>
                    </div>

                    <div class="section__header-CTA">
                        <a href="{{ route('things.to.do') }}" class="btn btn-primary rounded-pill">
                            {{ __('common.view_all') }}
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </div>
                </div>

                <div class="dis-adventure__carousel swiper">
                    <div class="swiper-wrapper">
                        @foreach ($things as $thing)
                            <x-frontend.thing-card :thing="$thing" />
                        @endforeach
                    </div>
                    <div class="custom__carousel-pagination"></div>
                </div>
            </div>
        </section>
    @endif

    <!-- 4. DESTINATION DETAILS: UPCOMING EVENT -->
    @if ($events->count() > 0)
        <section class="upcoming-event section-padding-md">
            <div class="container">
                <div class="section__header">
                    <div class="section__header-content">
                        <h2 class="section__heading">
                            {{ __('destination_details.upcoming_events.title') }}
                        </h2>

                        <p class="section__description">
                            {{ __('destination_details.upcoming_events.description') }}
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
                        @foreach ($events as $event)
                            <x-frontend.event-card :event="$event" />
                        @endforeach
                    </div>
                    <div class="custom__carousel-pagination"></div>
                </div>
            </div>
        </section>
    @endif

    <!-- 5. DESTINATION DETAILS: STORIES & INSIGHT -->
    <section>
        <div class="stories-insight__head">
            <div class="container">
                <div class="section__header">
                    <div class="section__header-content">
                        <h2 class="section__heading">
                            {{ __('destination_details.stories.title') }}
                        </h2>

                        <p class="section__description">
                            {{ __('destination_details.stories.description') }}
                        </p>
                    </div>

                    <div class="section__header-CTA">
                        <a href="{{ route('things.to.do') }}" class="btn btn-primary rounded-pill">
                            {{ __('common.view_all') }}
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="stories-insight__content">
            <div class="stories-insight__content-bg"></div>
            <div class="container">
                <div class="stories-insight__carousel swiper">
                    <div class="swiper-wrapper">

                        <div class="stories-insight__carousel-item swiper-slide">
                            <img src="{{ asset('frontend/assets/stories-insight-1.png') }}" alt="Story Image"
                                class="img-fluid">
                            <div class="stories-insight__carousel-item-content">
                                <p class="text-light2">
                                    {{ __('destination_details.stories.category') }}
                                </p>
                                <p class="p-large text-black stories-insight__carousel-title">
                                    {{ __('destination_details.stories.title_sample') }}
                                </p>
                            </div>
                        </div>

                        <div class="stories-insight__carousel-item swiper-slide">
                            <img src="{{ asset('frontend/assets/stories-insight-1.png') }}" alt="Story Image"
                                class="img-fluid">
                            <div class="stories-insight__carousel-item-content">
                                <p class="text-light2">
                                    {{ __('destination_details.stories.category') }}
                                </p>
                                <p class="p-large text-black stories-insight__carousel-title">
                                    {{ __('destination_details.stories.title_sample') }}
                                </p>
                            </div>
                        </div>

                        <div class="stories-insight__carousel-item swiper-slide">
                            <img src="{{ asset('frontend/assets/stories-insight-1.png') }}" alt="Story Image"
                                class="img-fluid">
                            <div class="stories-insight__carousel-item-content">
                                <p class="text-light2">
                                    {{ __('destination_details.stories.category') }}
                                </p>
                                <p class="p-large text-black stories-insight__carousel-title">
                                    {{ __('destination_details.stories.title_sample') }}
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="stories-insight__carousel-navigation custom__carousel-navigation">
                        <div class="swiper-button-prev stories-insight__carousel-navigation-prev">
                            <i class="fa-solid fa-arrow-left"></i>
                        </div>
                        <div class="swiper-button-next stories-insight__carousel-navigation-next">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. DESTINATION DETAILS EXCLUSIVE OFFERS -->
    <section class="exclusive-offers section-padding-md">
        <div class="container">
            <div class="section__header">
                <div class="section__header-content">
                    <h2 class="section__heading">
                        {{ __('destination_details.exclusive_offers.title') }}
                    </h2>

                    <p class="section__description">
                        {{ __('destination_details.exclusive_offers.description') }}
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
                    @foreach ($packages as $package)
                        <div class="exclusive-offers__carousel-item swiper-slide">
                            <x-frontend.package-card :package="$package" />
                        </div>
                    @endforeach
                </div>
                <div class="custom__carousel-pagination"></div>
            </div>
        </div>
    </section>

    <!-- 7. DESTINATION DETAILS START EXPLORING -->
    @if($favouriteCities && $favouriteCities->count() > 0)
    <section class="section-padding-md">
        <div class="container">
            <div class="section__header">
                <div class="section__header-content">
                    <h2 class="section__heading">
                        <span class="fw-600">
                            {{ __('destination_details.start_exploring.title') }}
                        </span>
                    </h2>

                    <p class="section__description">
                        {{ __('destination_details.start_exploring.description') }}
                    </p>
                </div>

                <div class="section__header-CTA">
                    <a href="{{ route('destinations.index') }}" class="btn btn-primary rounded-pill">
                        {{ __('common.view_all') }}
                        <i class="fa-solid fa-angles-right"></i>
                    </a>
                </div>
            </div>

            <div class="row start-exploring__row gy-3">

                @foreach ($favouriteCities as $city)

                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('destinations.show', $city->slug) }}">
                            <div class="start-exploring__item">
                                <img src="{{ asset('storage/' . $city->thumb_image) }}" alt="Explore" class="img-fluid">
                                <div class="start-exploring__item-content">
                                    <p class="mb-1 p-large fw-600">
                                    {{$city?->translation?->name}}
                                    </p>
                                    <p class="p-small">
                                    {{$city?->translation?->tagline}}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>

                @endforeach
            </div>
        </div>
    </section>
    @endif
    @include('frontend.destinations.partials.destination-gallery-modal')
@endsection
