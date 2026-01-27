@extends('frontend.layout')
@section('content')

    <!-- 1. THINGS TO DO: BANNER  -->
    <section class="hero-banner things-to-do__banner hero-banner-fullscreen">
        <video class="hero-banner__video" autoplay muted loop playsinline poster="../assets/hero-banner-bg.png">
            <source src="{{ asset('frontend/assets/videos/seekers-entry-video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <!-- <img class="hero-banner__image" src="../assets/hero-banner-bg.png" alt="Banner"> -->
        <div class="container">
            <div class="dest-details-banner__content">
                <h1 class="text-white">Things to Do in <br> <strong>Saudi Arabia</strong></h1>
                <img src="{{ asset('frontend/assets/hero-banner-vision.png') }}" alt="Vision 2030"
                    class="dest-details-banner__vision d-none-sm d-none-md">
            </div>
        </div>
    </section>

    <!-- 2. THINGS TO DO: DISCOVER CATEGORIES -->
    <section class="section-padding">
        <div class="container">
            <div class="section__header">
                <div class="section__header-content">
                    <h2 class="section__heading">Discover Categories</h2>
                    <p class="section__description">Embark on unforgettable journeys and explore the hidden gems across
                        the heart of Saudi Arabia</p>
                </div>
                <div class="section__header-CTA">
                    <a href="#" class="btn btn-primary rounded-pill">
                        Grab it now
                        <i class="fa-solid fa-angles-right"></i>
                    </a>
                </div>
            </div>
            <div class="row mt-4 gy-3">
                @foreach ($categories as $cate)
                    <div class="col-md-6 col-lg-3 col-xl-3">
                        <div class="discover-category__item">
                            <img src="{{asset('storage/' . $cate->thumb_image)}}" alt="Category"
                                class="img-fluid">
                            {{-- <div class="badge carousel-badge">
                                <i class="fa-solid fa-location-dot"></i> Abha
                            </div> --}}
                            <div></div>
                            <div class="discover-category__item-content">
                                <p class="p-large discover-category__item-title">{{ $cate->translation->name }}</p>
                                <a href="{{route('things.to.do')}}" class="btn btn-outline-light rounded">Related To Do Things ({{ $cate->things_count }}) <i
                                        class="fa-solid fa-angles-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 3. THINGS TO DO: STORIES & INSIGHT -->
    <section>
        <div class="stories-insight__head">
            <div class="container">
                <div class="section__header">
                    <div class="section__header-content">
                        <h2 class="section__heading">Stories and Insights</h2>
                        <p class="section__description">Embark on unforgettable journeys and explore the hidden gems
                            across the heart of Saudi Arabia</p>
                    </div>
                    <div class="section__header-CTA">
                        <a href="#" class="btn btn-primary rounded-pill">
                            View All
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
                                <p class="text-light2">Culture & History, Art Gallery</p>
                                <p class="p-large text-black stories-insight__carousel-title">5 Must-Do Experiences in
                                    Jeddah</p>
                            </div>
                        </div>
                        <div class="stories-insight__carousel-item swiper-slide">
                            <img src="{{ asset('frontend/assets/stories-insight-1.png') }}" alt="Story Image"
                                class="img-fluid">
                            <div class="stories-insight__carousel-item-content">
                                <p class="text-light2">Culture & History, Art Gallery</p>
                                <p class="p-large text-black stories-insight__carousel-title">5 Must-Do Experiences in
                                    Jeddah</p>
                            </div>
                        </div>
                        <div class="stories-insight__carousel-item swiper-slide">
                            <img src="{{ asset('frontend/assets/stories-insight-1.png') }}" alt="Story Image"
                                class="img-fluid">
                            <div class="stories-insight__carousel-item-content">
                                <p class="text-light2">Culture & History, Art Gallery</p>
                                <p class="p-large text-black stories-insight__carousel-title">5 Must-Do Experiences in
                                    Jeddah</p>
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

    <!-- 4. THINGS TO DO: ATTRACTIONS MUST VISIT -->
    <section>
        <div class="container">
            <div class="section__header">
                <div class="section__header-content">
                    <h2 class="section__heading">Attractions Must Visit</h2>
                    <p class="section__description">Embark on unforgettable journeys and explore the hidden gems across
                        the heart of Saudi Arabia</p>
                </div>
                <div class="section__header-CTA">
                    <a href="#" class="btn btn-primary rounded-pill">
                        Grab it now
                        <i class="fa-solid fa-angles-right"></i>
                    </a>
                </div>
            </div>
            <div class="stories-insight__content attractions-must-visit__content mt-4">
                <div class="stories-insight__carousel swiper">
                    <div class="swiper-wrapper">
                        <div class="stories-insight__carousel-item swiper-slide">
                            <img src="{{ asset('frontend/assets/attraction-1.png') }}" alt="Story Image" class="img-fluid">
                            <div class="stories-insight__carousel-item-content">
                                <p class="text-light2">Culture & History, Art Gallery</p>
                                <p class="p-large text-black stories-insight__carousel-title">5 Must-Do Experiences in
                                    Jeddah</p>
                            </div>
                            <div class="attractions-must-visit__city">Riyadh</div>
                        </div>
                        <div class="stories-insight__carousel-item swiper-slide">
                            <img src="{{ asset('frontend/assets/stories-insight-1.png') }}" alt="Story Image"
                                class="img-fluid">
                            <div class="stories-insight__carousel-item-content">
                                <p class="text-light2">Culture & History, Art Gallery</p>
                                <p class="p-large text-black stories-insight__carousel-title">5 Must-Do Experiences in
                                    Jeddah</p>
                            </div>
                            <div class="attractions-must-visit__city">Riyadh</div>
                        </div>
                        <div class="stories-insight__carousel-item swiper-slide">
                            <img src="{{ asset('frontend/assets/stories-insight-1.png') }}" alt="Story Image"
                                class="img-fluid">
                            <div class="stories-insight__carousel-item-content">
                                <p class="text-light2">Culture & History, Art Gallery</p>
                                <p class="p-large text-black stories-insight__carousel-title">5 Must-Do Experiences in
                                    Jeddah</p>
                            </div>
                            <div class="attractions-must-visit__city">Riyadh</div>
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

    <!-- 5. UPCOMING EVENT -->
    <section class="upcoming-event section-padding pt-0">
        <div class="container">
            <div class="section__header">
                <div class="section__header-content">
                    <h2 class="section__heading">Upcoming Events</h2>
                    <p class="section__description">Embark on unforgettable journeys and explore the hidden gems across
                        the heart
                        of Saudi Arabia</p>
                </div>
                <div class="section__header-CTA">
                    <a href="{{ route('event.listing') }}" class="btn btn-primary rounded-pill">
                        View All
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

    <!-- 6. EXCLUSIVE OFFERS -->
    <section class="exclusive-offers section-padding pt-0">
        <div class="container">
            <div class="section__header">
                <div class="section__header-content">
                    <h2 class="section__heading">Discover exclusive offers</h2>
                    <p class="section__description">Embark on unforgettable journeys and explore the hidden gems across
                        the heart
                        of Saudi Arabia</p>
                </div>
                <div class="section__header-CTA">
                    <a href="{{route('packages.index')}}" class="btn btn-primary rounded-pill">
                        View All
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
@endsection
