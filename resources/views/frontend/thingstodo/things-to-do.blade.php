@extends('frontend.layout')

@section('title', $thing->translation?->name)
@section('meta_description',\Illuminate\Support\Str::limit(strip_tags($thing?->translation?->about), 160))

@section('content')
    @php
        use Illuminate\Support\Str;
        $currentThing = $thing;

        $videoUrl = $currentThing->video_url ?? null;

    @endphp
    <!-- 1. THING TO DO NATURE: BANNER SECTION  -->
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
            {{-- Any other video URL (MP4, CDN, S3, etc.) --}}
            <video class="hero-banner__video" autoplay muted loop playsinline>
                <source src="{{ $videoUrl }}">
                {{ __('common.video_not_supported') }}
            </video>
        @elseif ($thing->thumb)
            {{-- Thumbnail fallback --}}
            <img class="hero-banner__image" src="{{ asset('storage/' . $thing->thumb->image_path) }}"
                alt="{{ $thing->translation?->name ?? 'Banner' }}">
        @else
            {{-- Final fallback --}}
            <video class="hero-banner__video" autoplay muted loop playsinline
                poster="{{ asset('frontend/assets/hero-banner-bg.png') }}">
                <source src="{{ asset('frontend/assets/videos/seekers-entry-video.mp4') }}">
                {{ __('common.video_not_supported') }}
            </video>
        @endif

        <div class="container">
            <div class="dest-details-banner__content">
                <h1 class="text-white"><strong>{{ $thing->translation->name }}</strong></h1>
                <img src="{{ asset('frontend/assets/hero-banner-vision.png') }}" alt="Vision 2030"
                    class="dest-details-banner__vision d-none-sm d-none-md">
                <div class="dest-details-banner__btn-group">
                    @if($thing->package_count > 0)
                        <a href="{{ route('packages.index', ['todo_id' => $thing->id]) }}"
                        class="btn btn-outline-light gap-1 rounded-pill">
                            {{ __('destination_details.banner.related_packages') }}
                            <strong>({{ $thing->package_count }})</strong>
                        </a>
                    @endif

                    @if ($currentThing?->gallery && $currentThing?->gallery->count() > 0)
                        <button class="btn btn-primary rounded-pill" data-bs-toggle="modal"
                            data-bs-target="#galleryModal">{{ __('thing_detail.banner.see_images') }}</button>
                    @endif
                </div>
            </div>
        </div>
    </section>
    {{-- @dd($thing->package_count ) --}}


    <!-- 2. THING TO DO NATURE: DESCRIPTION -->
    <section class="section-padding things-to-do-nature__details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section__header mb-5">
                        <div class="section__header-content">
                            <h2 class="section__heading"> {{ $thing->translation->name }}</h2>
                            <p class="section__description">
                                {!! $thing->translation->about !!}
                            </p>

                        </div>
                    </div>
                    {{-- <div class="section__header mb-5">
            <div class="section__header-content">
              <h4 class="section__heading primary-text">Nature and Beauty</h4>
              <p class="section__description">Steeped in heritage yet bursting with modern flair, Jeddah effortlessly
                blends its captivating past with a dynamic present. Explore the UNESCO-listed streets of Al Balad, where
                centuries-old architecture tells stories of trade, tradition, and culture. Indulge in world-class
                shopping experiences at the Mall of Arabia and the prestigious Red Sea Mall, home to international
                brands and vibrant local boutiques.</p>
            </div>
          </div> --}}

                </div>
                <div class="col-lg-4">
                    <div class="event-map__info-card rounded-5 mb-3">
                        <h6 class="fw-600 p-large mb-2">{{ __('thing_detail.info.title') }}</h6>

                        <div class="event-map__info-card-row flex-v-center rounded-4 gap-1 mb-3">
                            <div class="icon primary-text flex-center"><i class="fa-solid fa-location-dot"></i></div>
                            <div>
                                <p class="text-light2 p-small">{{ __('thing_detail.info.location_label') }}</p>
                                <p class="p-large fw-600">{{ $thing->location }}</p>
                            </div>
                        </div>

                        {{-- <div class="event-map__info-card-row flex-v-center rounded-4 gap-1 mb-3">
                            <div class="icon primary-text flex-center"><i class="fa-solid fa-cake-candles"></i></div>
                            <div>
                                <p class="text-light2 p-small">{{ __('thing_detail.info.ages_label') }}</p>
                                <p class="p-large fw-600">{{ __('thing_detail.info.ages_all') }}</p>
                            </div>
                        </div> --}}

                        <div class="event-map__info-card-row flex-v-center rounded-4 gap-1">
                            <div class="icon primary-text flex-center"><i class="fa-regular fa-clock"></i></div>
                            <div>
                                <p class="text-light2 p-small">{{ __('thing_detail.info.time_label') }}</p>
                                {{-- <p class="p-large fw-600">Sun:
                                    {{ \App\Helpers\TimeHelper::range($thing->opening_time, $thing->closing_time) }}</p> --}}
                                <p class="p-large fw-600">
                                    {{ \App\Helpers\TimeHelper::range($thing->opening_time, $thing->closing_time) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="event-map__card position-relative">

                        @php
                            $lat = $thing->latitude;
                            $lng = $thing->longitude;
                        @endphp
                        <!-- use uploaded image path as src -->

                        {{-- Google Map --}}
                        <iframe width="100%" height="350" style="border:0;" loading="lazy" allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps?q={{ $lat }},{{ $lng }}&hl=en&z=14&output=embed">
                        </iframe>

                        {{-- Get Directions --}}
                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $lat }},{{ $lng }}"
                            target="_blank" class="event-map__card-btn btn btn-primary rounded-pill py-2 px-3">
                            {{ __('thing_detail.map.get_directions') }}
                        </a>
                    </div>
                    {{-- <div class="event-map__info-card">
                        <p class="fw-500">Share</p>
                        <div class="d-flex gap-3 mt-2">

                            <x-share-links a-class="social-icon" icon-size="icon-sm" />
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- 3. THING TO DO NATURE: CONTENT -->
    {{-- <section class="py-3 things-to-do-nature__about">
        <div class="container">
            <div class="things-to-do-nature__about-content">
                <div class="row gy-3">
                    <div class="col-lg-5">
                        <div class="things-to-do-nature__about-img-wrapper">
                            <img class="img-fluid things-to-do-nature__about-img" src="../assets/thing-to-do.png"
                                alt="">
                            <img class="things-to-do-nature__about-img-strip" src="../assets/vertical-strip.png"
                                alt="">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="things-to-do-nature__about-text">
                            <div class="section__header">
                                <div class="section__header-content gap-3">
                                    <h3 class="section__heading">About Al-Didhan Reserve</h3>
                                    <ul>
                                        <li>Steeped in heritage yet bursting with modern flair, Jeddah effortlessly blends
                                            its captivating
                                            past with a dynamic present. </li>
                                        <li>Breathe in the refreshing sea breeze along the iconic Jeddah Corniche, or dive
                                            beneath the waves
                                            into crystal-clear waters to explore some of the Red Sea’s most vibrant coral
                                            reefs. </li>
                                        <li>Explore the UNESCO-listed streets of Al Balad, where centuries-old architecture
                                            tells stories of
                                            trade, tradition, and culture.</li>
                                        <li>Indulge in world-class shopping experiences at the Mall of Arabia and the
                                            prestigious Red Sea
                                            Mall, home to international brands and vibrant local boutiques.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- 4. THING TO DO NATURE: CONTENT -->
    {{-- <section class="py-3 things-to-do-nature__about">
        <div class="container">
            <div class="things-to-do-nature__about-content">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="things-to-do-nature__about-text">
                            <div class="section__header">
                                <div class="section__header-content gap-3">
                                    <h3 class="section__heading">About Al-Didhan Reserve</h3>
                                    <ul>
                                        <li>Steeped in heritage yet bursting with modern flair, Jeddah effortlessly blends
                                            its captivating
                                            past with a dynamic present. </li>
                                        <li>Breathe in the refreshing sea breeze along the iconic Jeddah Corniche, or dive
                                            beneath the waves
                                            into crystal-clear waters to explore some of the Red Sea’s most vibrant coral
                                            reefs. </li>
                                        <li>Explore the UNESCO-listed streets of Al Balad, where centuries-old architecture
                                            tells stories of
                                            trade, tradition, and culture.</li>
                                        <li>Indulge in world-class shopping experiences at the Mall of Arabia and the
                                            prestigious Red Sea
                                            Mall, home to international brands and vibrant local boutiques.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="things-to-do-nature__about-img-wrapper">
                            <img class="img-fluid things-to-do-nature__about-img" src="../assets/thing-to-do.png"
                                alt="">
                            <img class="things-to-do-nature__about-img-strip right" src="../assets/vertical-strip.png"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- 5. THING TO DO NATURE: NATURE ADVENTURE -->
    <section class="section-padding-md">
        <div class="container">
            <div class="things-to-do-nature__adventure-wrapper">
                <div class="section__header flex-column align-items-start gap-4">
                    <div class="section__header-content">
                        <h2 class="section__heading text-white">{{ __('thing_detail.adventure.title') }}</h2>
                        <p class="section__description text-white">{{ __('thing_detail.adventure.description') }}</p>
                    </div>
                    <div class="section__header-CTA">
                        <a href="#" class="btn btn-primary rounded-pill btn-lg">
                            >{{ __('common.view_all') }}

                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. THING TO DO NATURE: SIMILAR TO DO THINGS -->
    <section class="dis-adventure section-padding-md">
        <div class="container">
            <div class="section__header">
                <div class="section__header-content">
                    <h2 class="section__heading">{{ __('thing_detail.similar.title') }}</h2>
                    <p class="section__description">{{ __('thing_detail.similar.description') }}</p>
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

    <!-- 7. THING TO DO NATURE: RELATED PACKAGES -->
    <section class="upcoming-event section-padding-md">
        <div class="container">
            <div class="section__header">
                <div class="section__header-content">
                    <h2 class="section__heading"> {{ __('thing_detail.related_packages.title') }}</h2>
                    <p class="section__description"> {{ __('thing_detail.related_packages.description') }}</p>
                </div>
                <div class="section__header-CTA">
                    <a href="{{ route('packages.index') }}" class="btn btn-primary rounded-pill">
                        {{ __('common.view_all') }}
                        <i class="fa-solid fa-angles-right"></i>
                    </a>
                </div>
            </div>
            <div class="upcoming-event__carousel swiper">
                <div class="upcoming-event__carousel-wrapper swiper-wrapper">
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

    <div class="modal fade gallery-modal" id="galleryModal" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-transparent border-0">

                <!-- Close Button -->
                <button type="button" class="btn-close gallery-close" data-bs-dismiss="modal"></button>

                <div class="pkg-details__banner gallery-modal-parent-carousel-wrapper swiper m-0 p-0">
                    <div class="swiper-wrapper">
                        @foreach ($currentThing->gallery as $img)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $img->image_path) }}" alt="Gallery Image"
                                    class="img-fluid w-100">
                            </div>
                        @endforeach
                    </div>
                    <div class="gallery-swiper-pagination"></div>
                </div>
                <div class="position-relative mt-4 gallery-modal-carousel-container">
                    <div class="gallery-modal-carousel-wrapper swiper">
                        <div class="swiper-wrapper gap-2">
                            @foreach ($currentThing->gallery as $img)
                                <div class="pkg-details__banner-carousel-item swiper-slide">
                                    <img src="{{ asset('storage/' . $img->image_path) }}" alt="Gallery Image"
                                        class="img-fluid w-100 mr-2">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-button-next gallery-carousel__next">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                    <div class="swiper-button-prev gallery-carousel__prev">
                        <i class="fa-solid fa-arrow-left"></i>
                    </div>
                </div>

                <!-- Main Image -->
                <!-- <div class="gallery-main">
                              <img id="galleryMainImg" src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=1200"
                                class="img-fluid">
                            </div> -->

                <!-- Thumbnails + Arrows -->
                <!-- <div class="gallery-thumbs-wrapper">

                              <button class="gallery-arrow" id="prevImg">&#10094;</button>

                              <div class="gallery-thumbs">
                                <img class="thumb active" src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=300">
                                <img class="thumb" src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=300">
                                <img class="thumb" src="https://images.unsplash.com/photo-1519681393784-d120267933ba?w=300">
                                <img class="thumb" src="https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=300">
                                <img class="thumb" src="https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=300">
                              </div>

                              <button class="gallery-arrow" id="nextImg">&#10095;</button>
                            </div> -->

            </div>
        </div>
    </div>

@endsection
