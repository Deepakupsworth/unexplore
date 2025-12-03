@extends('frontend.layout')
@section('content')

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
                <div class="col-md-6 col-lg-3 col-xl-3">
                    <div class="discover-category__item">
                        <img src="{{ asset('frontend/assets/things_to_do/nature/al_watan_park_in_riyad.jpg') }}" alt="Category" class="img-fluid">
                        <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Riyad</div>
                        <div class="discover-category__item-content">
                            <p class="p-large discover-category__item-title">AI Watan Park</p>
                            <button class="btn btn-outline-light">Related packages (20) <i
                                    class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-3">
                    <div class="discover-category__item">
                        <img src="{{ asset('frontend/assets/things_to_do/nature/ibex_reserve_area_in_riyad.jpg') }}" alt="Category" class="img-fluid">
                        <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Riyad</div>
                        <div class="discover-category__item-content">
                            <p class="p-large discover-category__item-title">IBEX Reserve Area</p>
                            <button class="btn btn-outline-light">Related packages (20) <i
                                    class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-3">
                    <div class="discover-category__item">
                        <img src="{{ asset('frontend/assets/things_to_do/nature/joud_camp_in_aseer.jpg') }}" alt="Category" class="img-fluid">
                        <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Aseer</div>
                        <div class="discover-category__item-content">
                            <p class="p-large discover-category__item-title">Joud Camp</p>
                            <button class="btn btn-outline-light">Related packages (20) <i
                                    class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-3">
                    <div class="discover-category__item">
                        <img src="{{ asset('frontend/assets/things_to_do/nature/jubal_shada_reserve_area_in_al_baha.jpg') }}" alt="Category" class="img-fluid">
                        <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> AI Baha</div>
                        <div class="discover-category__item-content">
                            <p class="p-large discover-category__item-title">Jubal Shada Reserve Area</p>
                            <button class="btn btn-outline-light">Related packages (20) <i
                                    class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>
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
                            <img src="{{ asset('frontend/assets/things_to_do/at_turaif_in_diriyah.jpg') }}" alt="Story Image" class="img-fluid">
                            <div class="stories-insight__carousel-item-content">
                                <p class="text-light2">Modern Culture, Heritage Landmarks</p>
                                <p class="p-large text-black stories-insight__carousel-title">Top Attractions You Must Explore in Diriyah</p>
                            </div>
                        </div>
                        <div class="stories-insight__carousel-item swiper-slide">
                            <img src="{{ asset('frontend/assets/things_to_do/hegra_in_alula.jpg') }}" alt="Story Image" class="img-fluid">
                            <div class="stories-insight__carousel-item-content">
                                <p class="text-light2">Ancient Wonders, Natural Landscapes</p>
                                <p class="p-large text-black stories-insight__carousel-title">Unforgettable Hidden Gems to Discover in AlUla</p>
                            </div>
                        </div>
                        <div class="stories-insight__carousel-item swiper-slide">
                            <img src="{{ asset('frontend/assets/things_to_do/riyadh_front-& -boulevard_city.jpg') }}" alt="Story Image" class="img-fluid">
                            <div class="stories-insight__carousel-item-content">
                                <p class="text-light2">Mountain Escapes, Local Traditions</p>
                                <p class="p-large text-black stories-insight__carousel-title">Best Experiences to Enjoy in Riyadh Scenic Highlands</p>
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
                            <img src="{{ asset('frontend/assets/things_to_do/al_balad_(jeddah)_in_saudi_arabia.jpg') }}" alt="Story Image" class="img-fluid">
                            <div class="stories-insight__carousel-item-content">
                                <p class="text-light2">Culture & History, Art Gallery</p>
                                <p class="p-large text-black stories-insight__carousel-title">5 Must-Do Experiences in
                                    Jeddah</p>
                            </div>
                            <div class="attractions-must-visit__city">Jeddah</div>
                        </div>
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
                                <h5 class="fw-bold">4 Days in Aseer</h5>
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
                                    class="fa-solid fa-location-dot"></i> Riyadh
                                | Business Events</button>
                            <div class="d-flex justify-content-between mt-3">
                                <h5 class="fw-bold">4 Days in jeddah</h5>
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
                                <h5 class="fw-bold">4 Days in Aseer</h5>
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
                                <h5 class="fw-bold">4 Days in Aseer</h5>
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
                    <div class="exclusive-offers__carousel-item swiper-slide">
                        <div class="exclusive-offers__carousel-item-img">
                            <img src="{{ asset('frontend/assets/destinations/alula/5.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> AlUla</div>
                        </div>
                        <div class="exclusive-offers__carousel-item-info">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bold"> Heritage Escape</h6>
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
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> KAEC</div>
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
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Al Bahah                            </div>
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
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Jazan</div>
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
                            <p class="text-muted small mb-2">2N Najran • 3D Jeddah</p>
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