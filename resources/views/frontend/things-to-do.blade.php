@extends('frontend.layout')
@section('content')
@php
    $jsonPath = app_path('demojson.json');

    $jsonData = [];
    if (file_exists($jsonPath)) {
        $jsonData = json_decode(file_get_contents($jsonPath), true);
    }

    $Things_to_do = $jsonData['Things_to_do'] ?? [];
    $section1 = $Things_to_do['section1'] ?? [];
    $section2 = $Things_to_do['section2'] ?? [];
    $section3 = $Things_to_do['section3'] ?? [];
    $section4 = $Things_to_do['section4'] ?? [];
    $section5 = $Things_to_do['section5'] ?? [];
@endphp

    <!-- 1. THINGS TO DO: BANNER  -->
    <section class="hero-banner things-to-do__banner hero-banner-fullscreen">
        <video class="hero-banner__video" autoplay muted loop playsinline poster="{{ asset('frontend/assets/hero-banner-bg.png') }}">
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
            @if(count($section1))
            @foreach($section1 as $discover)
                <div class="col-md-6 col-lg-3 col-xl-3">
                    <div class="discover-category__item">
                        <img src="{{ asset(ltrim($discover['image'], '/')) }}" alt="Category" class="img-fluid">
                        <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> {{ $discover['city_name'] }}</div>
                        <div class="discover-category__item-content"> 
                            <p class="p-large discover-category__item-title">{{ $discover['title'] }} </p>
                            <button class="btn btn-outline-light">Related packages ({{ $discover['package_count'] }}) <i
                                    class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif

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
                    @if(count($section2))
                    @foreach($section2 as $stories)      
                    <div class="stories-insight__carousel-item swiper-slide">
                            <a href=""> <img src="{{ asset(ltrim($stories['city_image'], '/')) }}" alt="Story Image" class="img-fluid"> </a>
                            <div class="stories-insight__carousel-item-content">
                                <p class="text-light2">{{ $stories['sub_title'] }} </p>
                                <p class="p-large text-black stories-insight__carousel-title"> {{ $stories['title'] }}</p>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        
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
                    @if(count($section3))
                    @foreach($section3 as $visit)
                        <div class="stories-insight__carousel-item swiper-slide">
                            <img src="{{ asset(ltrim($visit['city_image'], '/')) }}" alt="Story Image" class="img-fluid">
                            <div class="stories-insight__carousel-item-content">
                                <p class="text-light2">{{ $visit['sub_title'] }} </p>
                                <p class="p-large text-black stories-insight__carousel-title">{{ $visit['title'] }}  </p>
                            </div>
                            <div class="attractions-must-visit__city">{{ $visit['city'] }} </div>
                        </div>
                        @endforeach
                        @endif 
                        <div class="stories-insight__carousel-item swiper-slide">
                            <img src="{{ asset('frontend/assets/things_to_do/edge_of_the_world_in_riyadh.jpg') }}" alt="Story Image" class="img-fluid">
                            <div class="stories-insight__carousel-item-content">
                                <p class="text-light2">Culture & History, Art Gallery</p>
                                <p class="p-large text-black stories-insight__carousel-title">5 Must-Do Experiences in
                                    Riyadh</p>
                            </div>
                            <div class="attractions-must-visit__city">Riyadh</div>
                        </div>
                        <div class="stories-insight__carousel-item swiper-slide">
                            <img src="{{ asset('frontend/assets/things_to_do/hegra_(madain-saleh)_alula.jpg') }}" alt="Story Image" class="img-fluid">
                            <div class="stories-insight__carousel-item-content">
                                <p class="text-light2">Culture & History, Art Gallery</p>
                                <p class="p-large text-black stories-insight__carousel-title">5 Must-Do Experiences in
                                    Alula</p>
                            </div>
                            <div class="attractions-must-visit__city">Alula</div>
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
                    <a href="#" class="btn btn-primary rounded-pill">
                        View All
                        <i class="fa-solid fa-angles-right"></i>
                    </a>
                </div>
            </div>
            <div class="upcoming-event__carousel swiper">
                <div class="upcoming-event__carousel-wrapper swiper-wrapper">
                @if(count($section4))
                @foreach($section4 as $upcomingeevent)
                    <div class="upcoming-event__carousel-item swiper-slide">
                        <div class="upcoming-event__carousel-item-img">
                            <img src="{{ asset(ltrim($upcomingeevent['image'], '/')) }}" alt="Event" class="img-fluid">
                            <div class="upcoming-event__carousel-item-dates">
                                <p>{{ $upcomingeevent['start_date'] }}</p>
                                <div class="vertical-divider"></div>
                                <p>{{ $upcomingeevent['end_date'] }}</p>
                            </div>
                        </div>
                        <div class="upcoming-event__carousel-item-info">
                            <button class="btn btn-primary rounded-pill btn-sm gap-1"><i
                                    class="fa-solid fa-location-dot"></i> {{ $upcomingeevent['location'] }}
                                | {{ $upcomingeevent['category'] }}</button>
                            <div class="d-flex justify-content-between mt-3">
                                <h5 class="fw-bold">{{ $upcomingeevent['title'] }}</h5>
                                <a href="#" class="p-large">
                                    <i class="fa-solid fa-arrow-right-long primary-text"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
                    
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
                    <a href="#" class="btn btn-primary rounded-pill">
                        View All
                        <i class="fa-solid fa-angles-right"></i>
                    </a>
                </div>
            </div>
            <div class="exclusive-offers__carousel swiper">
                <div class="swiper-wrapper">
                @if(count($section5))
                @foreach($section5 as $offers)
                    <div class="exclusive-offers__carousel-item swiper-slide"> 
                        <div class="exclusive-offers__carousel-item-img">
                            <img src="{{ asset(ltrim($offers['image'], '/')) }}" alt="Exclusive Offer" class="img-fluid">
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i>  {{ $offers['city_name'] }} </div>
                        </div>
                        <div class="exclusive-offers__carousel-item-info">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bold"> {{ $offers['title'] }} </h6>
                                <span class="badge carousel-badge-outline rounded-pill">{{ $offers['package_days'] }}</span>
                            </div>
                            <p class="text-muted small mb-2">{{ $offers['city_days'] }}</p>
                            <hr>
                            <ul class="exclusive-offers__carousel-features-list">
                            @foreach($offers['details_points'] as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                            </ul>

                            <!-- Price Box -->
                            <div class="exclusive-offers__carousel-price-box">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">Only for now</p>
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        <p class="fw-bold text-dark">{{ $offers['price_per_person'] }}</p> /Person 
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        {{ $offers['offer_price'] }}
                                    </div>
                                    <p class="text-muted small">Total Price: <img class="opacity-50"
                                            src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> {{ $offers['total_price'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif 
                </div>
                <div class="custom__carousel-pagination"></div>
            </div>
        </div>
    </section>

   @endsection