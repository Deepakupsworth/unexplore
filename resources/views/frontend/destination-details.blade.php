@extends('frontend.layout')
@section('content')

@php
    $jsonPath = app_path('demojson.json');

    $jsonData = [];
    if (file_exists($jsonPath)) {
        $jsonData = json_decode(file_get_contents($jsonPath), true);
    }

    $destination = $jsonData['destination-details'] ?? [];
    $discover_adventure = $destination['discover_adventure'] ?? []; 
    $upcoming_events = $destination['upcoming_events'] ?? []; 
    $start_exploring = $destination['start_exploring'] ?? []; 
    
    //Stories and Insights
    $Things_to_do = $jsonData['Things_to_do'] ?? [];
    $section2 = $Things_to_do['section2'] ?? [];

    // Discover exclusive offers DATA
    $home = $jsonData['home_page'] ?? [];
    $exclusiveOffers = $home['exclusive_offers'] ?? [];

@endphp


    <!-- 1. DESTINATION DETAILS BANNER SECTION  -->
    <section class="hero-banner dest-details-banner">
        <video class="hero-banner__video" autoplay muted loop playsinline poster="../assets/hero-banner-bg.png">
            <source src="{{ asset('frontend/assets/videos/seekers-entry-video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <!-- <img class="hero-banner__image" src="../assets/hero-banner-bg.png" alt="Banner"> -->
        <div class="container">
            <div class="dest-details-banner__content">
                <h1>Things to Do in <strong>{{ $destinationsss['city'] }}</strong></h1>
                <img src="{{ asset('frontend/assets/hero-banner-vision.png') }}" alt="Vision 2030"
                    class="dest-details-banner__vision d-none-sm d-none-md">
                <div class="dest-details-banner__btn-group">
                    <button class="btn btn-outline-light gap-1 rounded-pill">Related Packages
                        <strong>({{ $destinationsss ['related_packages'] ?? '' }})</strong></button> 
                    <button class="btn btn-primary rounded-pill">See Images</button>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. DESTINATION DETAILS DESCRIPTION -->
    <section class="section-padding-md dest-details-description">
        <div class="container">
            <div class="section__header">
                <div class="section__header-content">
                    <h2 class="section__heading">{{ $destinationsss ['about_title'] ?? '' }}</h2>
                    <p class="section__description">{{ implode(' ', $destinationsss['about_description']) }}</p> 
                    <!-- <p class="section__description">Breathe in the refreshing sea breeze along the iconic Jeddah
                        Corniche, or dive beneath the waves into crystal-clear waters to explore some of the Red Sea’s
                        most vibrant coral reefs. As night falls, gaze upon the breathtaking spectacle of the King Fahd
                        Fountain, illuminating the sky as it propels water an astonishing 312 meters upward, making it
                        the tallest fountain in the world. <br />
                        Whether seeking adventure, culture, or relaxation, Jeddah promises an unforgettable experience
                        on the shores of the Red Sea</p> -->
                </div>
            </div>
        </div>
    </section>

    <!-- 3. DESTINATION DETAILS: TO DO THINGS -->
    <section class="dis-adventure section-padding-md">
        <div class="container">
            <div class="section__header">
                <div class="section__header-content">
                    <h2 class="section__heading">To Do Things</h2>
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
            <div class="dis-adventure__carousel swiper">
                <div class="swiper-wrapper">
                @if(count($discover_adventure))
                @foreach($discover_adventure as $discover)
                    <div class="dis-adventure__carousel-item swiper-slide">
                        <img src="{{ asset(ltrim($discover['image'], '/')) }}" alt="Adventure Image 1" class="img-fluid">
                        <div class="dis-adventure__carousel-item-content">
                            <div class="dis-adventure__carousel-item-top">
                                <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> {{ $discover['city'] }}</div>
                            </div>
                            <div class="dis-adventure__carousel-item-bottom">
                                <h6> {{ $discover['title'] }} </h6>
                                <div class="dis-adventure__carousel-item-footer">
                                    <a class="btn btn-outline-light rounded-pill">Related packages ({{ $discover['related_packages'] }})</a>
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

    <!-- 4. DESTINATION DETAILS: UPCOMING EVENT -->
    <section class="upcoming-event section-padding-md">
        <div class="container">
            <div class="section__header">
                <div class="section__header-content">
                    <h2 class="section__heading">Upcoming Events</h2>
                    <p class="section__description">Embark on unforgettable journeys and explore the hidden gems across
                        the heart of Saudi Arabia</p>
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
               
                @foreach($upcoming_events as $event)
                    <div class="upcoming-event__carousel-item swiper-slide">
                        <div class="upcoming-event__carousel-item-img">
                            <img src="{{ asset($event['image']) }}" alt="Event" class="img-fluid"> 
                            <div class="upcoming-event__carousel-item-dates">
                                <p>{{ $event['start_date'] }}</p>
                                <div class="vertical-divider"></div>
                                <p>{{ $event['end_date'] }}</p>
                            </div>
                        </div>
                        <div class="upcoming-event__carousel-item-info">
                            <button class="btn btn-primary rounded-pill btn-sm gap-1"><i
                                    class="fa-solid fa-location-dot"></i> {{ $event['city'] }}
                                | {{ $event['category'] }}</button>
                            <div class="d-flex justify-content-between mt-3">
                                <h5 class="fw-bold">{{ $event['title'] }} </h5>
                                <a href="#" class="p-large">
                                    <i class="fa-solid fa-arrow-right-long primary-text"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                </div>
                <div class="custom__carousel-pagination"></div>
            </div>
        </div>
    </section>

    <!-- 5. DESTINATION DETAILS: STORIES & INSIGHT -->
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
                            <img src="{{ asset(ltrim($stories['city_image'], '/')) }}" alt="Story Image" class="img-fluid">
                            <div class="stories-insight__carousel-item-content">
                                <p class="text-light2">{{ $stories['sub_title'] }} </p>
                                <p class="p-large text-black stories-insight__carousel-title">{{ $stories['title'] }}</p>
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

    <!-- 6. DESTINATION DETAILS EXCLUSIVE OFFERS -->
    <section class="exclusive-offers section-padding-md">
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
                @if(count($exclusiveOffers))
                @foreach($exclusiveOffers as $offer)
                    <div class="exclusive-offers__carousel-item swiper-slide">
                        <div class="exclusive-offers__carousel-item-img">
                            <img src="{{ asset($offer['image']) }}" alt="Exclusive Offer" class="img-fluid"> 
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> {{ $offer['location'] }}</div>
                        </div>
                        <div class="exclusive-offers__carousel-item-info">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bold">{{ $offer['title'] }}</h6>
                                <span class="badge carousel-badge-outline rounded-pill">{{ $offer['duration_badge'] }}</span>
                            </div>  
                            <p class="text-muted small mb-2">{{ $offer['route'] }}</p>
                            <hr>
                            <ul class="exclusive-offers__carousel-features-list">
                            @foreach($offer['features'] as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                            </ul>

                            <!-- Price Box -->
                            <div class="exclusive-offers__carousel-price-box">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">Only for now</p>
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        <p class="fw-bold text-dark">{{ $offer['price_per_person'] }}</p> /Person
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        {{ $offer['emi_price'] }}
                                    </div>
                                    <p class="text-muted small">Total Price: <img class="opacity-50"
                                            src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> {{ $offer['total_price'] }}</p>
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

    <!-- 7. DESTINATION DETAILS START EXPLORING -->
    <section class="section-padding-md">
        <div class="container">
            <div class="section__header">
                <div class="section__header-content">
                    <h2 class="section__heading"><span class="fw-600">Start exploring</span></h2>
                    <p class="section__description">Unlock unforgettable experiences as you explore the beauty, culture, and heritage of Saudi Arabia.</p>
                </div>
                <div class="section__header-CTA">
                    <a href="#" class="btn btn-primary rounded-pill">
                        View All
                        <i class="fa-solid fa-angles-right"></i>
                    </a>
                </div>
            </div>
            <div class="row start-exploring__row gy-3">
            @if(count($start_exploring))
            @foreach($start_exploring as $exploring) 
                <div class="col-md-6 col-lg-3">
                    <div class="start-exploring__item">
                        <img src="{{ asset($exploring['image']) }}" alt="Explore" class="img-fluid">
                        <div class="start-exploring__item-content">
                            <p class="mb-1 p-large fw-600"> {{ $exploring['title'] }}</p>
                            <p class="p-small">{{ $exploring['subtitle'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            @endif     
               
            </div>
        </div>
    </section>
    
@endsection 