@extends('frontend.layout')
@section('content')

    <!-- 1. EVENT DETAILS: BANNER  -->
    <section class="hero-banner hero-banner-fullscreen">
        <video class="hero-banner__video" autoplay muted loop playsinline poster="{{ asset('frontend/assets/hero-banner-bg.png') }}">
            <source src="{{ asset('frontend/assets/videos/seekers-entry-video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <!-- <img class="hero-banner__image" src="../assets/hero-banner-bg.png" alt="Banner"> -->
        <div class="container">
            <div class="dest-details-banner__content flex-column gap-3 text-center">
                <h1 class="text-white w-100">Al-Turaif Traditions</h1>
                <h5>Get ready for an exceptional traditions journey.</h5>
            </div>
        </div>
    </section>

    <!-- 2. EVENT DETAILS: DESCRIPTION -->
    <section class="section-padding-md dest-details-description">
        <div class="container">
            <div class="section__header">
                <div class="section__header-content">
                    <h2 class="section__heading">About Al-Turaif Traditions</h2>
                    <p class="section__description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <p class="section__description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem
                        ipsum dolor sit amet, consectetur adipiscing </p>
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
                    <p class="p-large mb-2"><i class="fa-regular fa-calendar"></i> Event Date</p>
                    <h5 class="m-0 fw-bold">Sunday, 27 Sep 2025</h5>
                </div>

                <div class="event-divider"></div>

                <!-- Location -->
                <div class="event-info__block">
                    <p class="p-large mb-2"><i class="fa-solid fa-location-dot"></i> Location</p>
                    <h6 class="m-0 fw-bold">At Turaif</h6>
                </div>

                <div class="event-divider"></div>

                <!-- Price + Buttons -->
                <div class="d-flex align-items-center gap-3 justify-content-between w-100 event-info__block">
                    <div>
                        <p class="p-large mb-2">Starting from </p>
                        <h5 class="m-0 fw-bold">SAR 160</h5>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <!-- Wishlist -->
                        <button
                            class="btn btn-outline-light rounded-circle d-flex align-items-center justify-content-center heart-btn">
                            <i class="fa-regular fa-heart"></i>
                        </button>

                        <!-- Buy Tickets -->
                        <button class="btn btn-success d-flex align-items-center gap-5 px-4 py-3 rounded-pill">
                            Buy Tickets <i class="fa-solid fa-ticket"></i>
                        </button>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <section class="event-details__overview">
        <div class="container">
            <div class="d-flex justify-content-between flex-column flex-sm-row">
                <div class="py-3 event-details__overview-title flex-center">
                    <p class="p-large fw-bold primary-text">Overview</p>
                </div>
                <div class="d-flex align-items-center gap-4 py-3">
                    <p class="p-large fw-500">Do you like it? Share it</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="social-icon">
                            <img src="{{ asset('frontend/assets/icons/instagram.svg') }}" alt="">
                        </a>
                        <a href="#" class="social-icon">
                            <img src="{{ asset('frontend/assets/icons/facebook.svg') }}" alt="">
                        </a>
                        <a href="#" class="social-icon">
                            <img src="{{ asset('frontend/assets/icons/x.svg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding-md event-map-info offwhite-bg">
        <div class="container">
            <div class="row gy-3">
                <!-- Left: map (large) -->
                <div class="col-lg-8">
                    <div class="event-map__card position-relative">
                        <!-- use uploaded image path as src -->
                        <img class="rounded-5 img-fluid" src="{{ asset('frontend/assets/map.png') }}" alt="Map">

                        <!-- Get Directions button -->
                        <button class="event-map__card-btn btn btn-primary rounded-pill py-2 px-3">Get Directions</button>
                    </div>
                </div>

                <!-- Right: stacked info cards -->
                <div class="col-lg-4">
                    <!-- Information card -->
                    <div class="event-map__info-card rounded-5 mb-3">
                        <h6 class="fw-600 p-large mb-2">Information</h6>

                        <div class="event-map__info-card-row flex-v-center rounded-4 gap-1 mb-3">
                            <div class="icon primary-text flex-center"><i class="fa-solid fa-location-dot"></i></div>
                            <div>
                                <p class="text-light2 p-small">Location:</p>
                                <p class="p-large fw-600">At-Turaif, Riyadh</p>
                            </div>
                        </div>

                        <div class="event-map__info-card-row flex-v-center rounded-4 gap-1 mb-3">
                            <div class="icon primary-text flex-center"><i class="fa-solid fa-cake-candles"></i></div>
                            <div>
                                <p class="text-light2 p-small">Ages:</p>
                                <p class="p-large fw-600">All</p>
                            </div>
                        </div>

                        <div class="event-map__info-card-row flex-v-center rounded-4 gap-1">
                            <div class="icon primary-text flex-center"><i class="fa-regular fa-clock"></i></div>
                            <div>
                                <p class="text-light2 p-small">Time:</p>
                                <p class="p-large fw-600">Sun: 03:00 PM to 06:00 PM</p>
                            </div>
                        </div>
                    </div>

                    <!-- Weather card -->
                    <div class="event-map__info-card rounded-5 position-relative pb-5">
                        <p class="fw-600 p-large">Weather in Riyadh</p>
                        <p class="event-map__info-temp fw-bold">30.4°</p>
                        <div class="text-success event-map__info-weather-status">
                            <i class="fa-regular fa-moon"></i>
                            Clear
                        </div>
                        <div class="event-map__info-weather-decor"></div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="section-padding-md">
        <div class="container">
            <div class="section__header">
                <div class="section__header-content">
                    <h2 class="section__heading">Similar Events</h2>
                    <p class="section__description">Embark on unforgettable journeys and explore the hidden gems across the heart of Saudi Arabia</p>
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
                    <div class="upcoming-event__carousel-item swiper-slide">
                        <div class="upcoming-event__carousel-item-img">
                            <img src="{{ asset('frontend/assets/things_to_do/event_s/janadriyah_national_festival_in_riyadh.jpg') }}" alt="Event" class="img-fluid">
                            <div class="upcoming-event__carousel-item-dates">
                                <p>25 Aug 2025</p>
                                <div class="vertical-divider"></div>
                                <p>28 Aug 2025</p>
                            </div>
                        </div>
                        <div class="upcoming-event__carousel-item-info">
                            <button class="btn btn-primary rounded-pill btn-sm gap-1"><i
                                    class="fa-solid fa-location-dot"></i> Riyadh
                                | Business Events</button>
                            <div class="d-flex justify-content-between mt-3">
                                <h5 class="fw-bold">4 Days in Aseer</h5>
                                <a href="#" class="p-large">
                                    <i class="fa-solid fa-arrow-right-long primary-text"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="upcoming-event__carousel-item swiper-slide">
                        <div class="upcoming-event__carousel-item-img">
                            <img src="{{ asset('frontend/assets/things_to_do/event_s/mdlbeast_soundstorm_in_riyadh.jpg') }}" alt="Event" class="img-fluid">
                            <div class="upcoming-event__carousel-item-dates">
                                <p>25 Aug 2025</p>
                                <div class="vertical-divider"></div>
                                <p>28 Aug 2025</p>
                            </div>
                        </div>
                        <div class="upcoming-event__carousel-item-info">
                            <button class="btn btn-primary rounded-pill btn-sm gap-1"><i
                                    class="fa-solid fa-location-dot"></i> Riyadh
                                | Business Events</button>
                            <div class="d-flex justify-content-between mt-3">
                                <h5 class="fw-bold">4 Days in Riyadh</h5>
                                <a href="#" class="p-large">
                                    <i class="fa-solid fa-arrow-right-long primary-text"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="upcoming-event__carousel-item swiper-slide">
                        <div class="upcoming-event__carousel-item-img">
                            <img src="{{ asset('frontend/assets/things_to_do/event_s/red_sea_international_film_festival_in_jeddah.jpg') }}" alt="Event" class="img-fluid">
                            <div class="upcoming-event__carousel-item-dates">
                                <p>25 Aug 2025</p>
                                <div class="vertical-divider"></div>
                                <p>28 Aug 2025</p>
                            </div>
                        </div>
                        <div class="upcoming-event__carousel-item-info">
                            <button class="btn btn-primary rounded-pill btn-sm gap-1"><i
                                    class="fa-solid fa-location-dot"></i> Jeddah
                                | Business Events</button>
                            <div class="d-flex justify-content-between mt-3">
                                <h5 class="fw-bold">4 Days in Jeddah</h5>
                                <a href="#" class="p-large">
                                    <i class="fa-solid fa-arrow-right-long primary-text"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="upcoming-event__carousel-item swiper-slide">
                        <div class="upcoming-event__carousel-item-img">
                            <img src="{{ asset('frontend/assets/things_to_do/event_s/riyadh_season_festival_in_riyadh.jpg') }}" alt="Event" class="img-fluid">
                            <div class="upcoming-event__carousel-item-dates">
                                <p>25 Aug 2025</p>
                                <div class="vertical-divider"></div>
                                <p>28 Aug 2025</p>
                            </div>
                        </div>
                        <div class="upcoming-event__carousel-item-info">
                            <button class="btn btn-primary rounded-pill btn-sm gap-1"><i
                                    class="fa-solid fa-location-dot"></i> Riyadh
                                | Business Events</button>
                            <div class="d-flex justify-content-between mt-3">
                                <h5 class="fw-bold">4 Days in Riyadh</h5>
                                <a href="#" class="p-large">
                                    <i class="fa-solid fa-arrow-right-long primary-text"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="upcoming-event__carousel-item swiper-slide">
                        <div class="upcoming-event__carousel-item-img">
                            <img src="{{ asset('frontend/assets/things_to_do/event_s/Saudi_National_Day_in_Nationwide.jpg') }}" alt="Event" class="img-fluid">
                            <div class="upcoming-event__carousel-item-dates">
                                <p>25 Aug 2025</p>
                                <div class="vertical-divider"></div>
                                <p>28 Aug 2025</p>
                            </div>
                        </div>
                        <div class="upcoming-event__carousel-item-info">
                            <button class="btn btn-primary rounded-pill btn-sm gap-1"><i
                                    class="fa-solid fa-location-dot"></i> Riyadh
                                | Business Events</button>
                            <div class="d-flex justify-content-between mt-3">
                                <h5 class="fw-bold">4 Days in Riyadh</h5>
                                <a href="#" class="p-large">
                                    <i class="fa-solid fa-arrow-right-long primary-text"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="upcoming-event__carousel-item swiper-slide">
                        <div class="upcoming-event__carousel-item-img">
                            <img src="{{ asset('frontend/assets/things_to_do/event_s/winter_at_tantora_festival_in_alula.jpg') }}" alt="Event" class="img-fluid">
                            <div class="upcoming-event__carousel-item-dates">
                                <p>25 Aug 2025</p>
                                <div class="vertical-divider"></div>
                                <p>28 Aug 2025</p>
                            </div>
                        </div>
                        <div class="upcoming-event__carousel-item-info">
                            <button class="btn btn-primary rounded-pill btn-sm gap-1"><i
                                    class="fa-solid fa-location-dot"></i> Alula
                                | Business Events</button>
                            <div class="d-flex justify-content-between mt-3">
                                <h5 class="fw-bold">4 Days in Alula</h5>
                                <a href="#" class="p-large">
                                    <i class="fa-solid fa-arrow-right-long primary-text"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="custom__carousel-pagination"></div>
            </div>
        </div>
    </section>

    <section class="exclusive-offers section-padding-md">
        <div class="container">
            <div class="section__header">
                <div class="section__header-content">
                    <h2 class="section__heading">Related Packages</h2>
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
                    <div class="exclusive-offers__carousel-item swiper-slide">
                        <div class="exclusive-offers__carousel-item-img">
                            <img src="{{ asset('frontend/assets/destinations/alula/5.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> AlUla</div>
                        </div>
                        <div class="exclusive-offers__carousel-item-info">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bold">Heritage Escape</h6>
                                <span class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                            </div>
                            <p class="text-muted small mb-2">2N AlUla • 3D Jeddah</p>
                            <hr>
                            <ul class="exclusive-offers__carousel-features-list">
                                <li><span>Round Trip Flights</span></li>
                                <li><span>5 Star Hotels</span></li>
                                <li><span>Airport Transfers</span></li>
                                <li><span>5 Activities</span></li>
                                <li><span>Selected Meals</span></li>
                            </ul>

                            <!-- Price Box -->
                            <div class="exclusive-offers__carousel-price-box">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">Only for now</p>
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        <p class="fw-bold text-dark">40,000</p> /Person
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        8,332
                                    </div>
                                    <p class="text-muted small">Total Price: <img class="opacity-50"
                                            src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1,22,100</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="exclusive-offers__carousel-item swiper-slide">
                        <div class="exclusive-offers__carousel-item-img">
                            <img src="{{ asset('frontend/assets/destinations/riyadh/4.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Riyadh</div>
                        </div>
                        <div class="exclusive-offers__carousel-item-info">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bold">Cultural Journey</h6>
                                <span class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                            </div>
                            <p class="text-muted small mb-2">2N Riyadh • 3D Jeddah</p>
                            <hr>
                            <ul class="exclusive-offers__carousel-features-list">
                                <li>Round Trip Flights</li>
                                <li>5 Star Hotels</li>
                                <li>Airport Transfers</li>
                                <li>5 Activities</li>
                                <li>Selected Meals</li>
                            </ul>

                            <!-- Price Box -->
                            <div class="exclusive-offers__carousel-price-box">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">Only for now</p>
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        <p class="p-large fw-bold text-dark">40,000</p> /Person
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        8,332
                                    </div>
                                    <p class="text-muted small">Total Price: <img class="opacity-50"
                                            src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1,22,100</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="exclusive-offers__carousel-item swiper-slide">
                        <div class="exclusive-offers__carousel-item-img">
                            <img src="{{ asset('frontend/assets/destinations/kaec/4.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Diriyah</div>
                        </div>
                        <div class="exclusive-offers__carousel-item-info"> 
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bold">Luxury Getaway</h6>
                                <span class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                            </div>
                            <p class="text-muted small mb-2">2N Diriyah • 3D Jeddah</p>
                            <hr>
                            <ul class="exclusive-offers__carousel-features-list">
                                <li>Round Trip Flights</li>
                                <li>5 Star Hotels</li>
                                <li>Airport Transfers</li>
                                <li>5 Activities</li>
                                <li>Selected Meals</li>
                            </ul>

                            <!-- Price Box -->
                            <div class="exclusive-offers__carousel-price-box">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">Only for now</p>
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        <p class="p-large fw-bold text-dark">40,000</p> /Person
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        8,332
                                    </div>
                                    <p class="text-muted small">Total Price: <img class="opacity-50"
                                            src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1,22,100</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="exclusive-offers__carousel-item swiper-slide">
                        <div class="exclusive-offers__carousel-item-img">
                            <img src="{{ asset('frontend/assets/destinations/ai_baha/3.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Al Bahah</div>
                        </div>
                        <div class="exclusive-offers__carousel-item-info">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bold">Mountain Retreat</h6>
                                <span class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                            </div>
                            <p class="text-muted small mb-2">2N Al Bahah • 3D Jeddah</p>
                            <hr>
                            <ul class="exclusive-offers__carousel-features-list">
                                <li>Round Trip Flights</li>
                                <li>5 Star Hotels</li>
                                <li>Airport Transfers</li>
                                <li>5 Activities</li>
                                <li>Selected Meals</li>
                            </ul>

                            <!-- Price Box -->
                            <div class="exclusive-offers__carousel-price-box">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">Only for now</p>
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        <p class="p-large fw-bold text-dark">40,000</p> /Person
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        8,332
                                    </div>
                                    <p class="text-muted small">Total Price: <img class="opacity-50"
                                            src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1,22,100</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="exclusive-offers__carousel-item swiper-slide"> 
                        <div class="exclusive-offers__carousel-item-img">
                            <img src="{{ asset('frontend/assets/destinations/jazan/1.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Diriyah</div>
                        </div>
                        <div class="exclusive-offers__carousel-item-info">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bold">Coastal Escape</h6>
                                <span class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                            </div>
                            <p class="text-muted small mb-2">2N Diriyah • 3D Jeddah</p>
                            <hr>
                            <ul class="exclusive-offers__carousel-features-list">
                                <li>Round Trip Flights</li>
                                <li>5 Star Hotels</li>
                                <li>Airport Transfers</li>
                                <li>5 Activities</li>
                                <li>Selected Meals</li>
                            </ul>

                            <!-- Price Box -->
                            <div class="exclusive-offers__carousel-price-box">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">Only for now</p>
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        <p class="p-large fw-bold text-dark">40,000</p> /Person
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        8,332
                                    </div>
                                    <p class="text-muted small">Total Price: <img class="opacity-50"
                                            src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1,22,100</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="exclusive-offers__carousel-item swiper-slide">
                        <div class="exclusive-offers__carousel-item-img">
                            <img src="{{ asset('frontend/assets/destinations/najran/3.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Najran</div>
                        </div>
                        <div class="exclusive-offers__carousel-item-info">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bold">Heritage Adventure</h6>
                                <span class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                            </div>
                            <p class="text-muted small mb-2">2N Diriyah • 3D Jeddah</p>
                            <hr>
                            <ul class="exclusive-offers__carousel-features-list">
                                <li>Round Trip Flights</li>
                                <li>5 Star Hotels</li>
                                <li>Airport Transfers</li>
                                <li>5 Activities</li>
                                <li>Selected Meals</li>
                            </ul>

                            <!-- Price Box -->
                            <div class="exclusive-offers__carousel-price-box">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">Only for now</p>
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        <p class="p-large fw-bold text-dark">40,000</p> /Person
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        8,332
                                    </div>
                                    <p class="text-muted small">Total Price: <img class="opacity-50"
                                            src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1,22,100</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="custom__carousel-pagination"></div>
            </div>
        </div>
    </section>

@endsection