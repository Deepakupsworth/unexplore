@extends('frontend.layout')
@section('content')

    <!-- 1. DESTINATION DETAILS BANNER SECTION  -->
    <section class="hero-banner dest-details-banner">
        <video class="hero-banner__video" autoplay muted loop playsinline poster="../assets/hero-banner-bg.png">
            <source src="{{ asset('frontend/assets/videos/seekers-entry-video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <!-- <img class="hero-banner__image" src="../assets/hero-banner-bg.png" alt="Banner"> -->
        <div class="container">
            <div class="dest-details-banner__content">
                <h1>Things to Do in <strong>Jeddah</strong></h1>
                <img src="{{ asset('frontend/assets/hero-banner-vision.png') }}" alt="Vision 2030"
                    class="dest-details-banner__vision d-none-sm d-none-md">
                <div class="dest-details-banner__btn-group">
                    <button class="btn btn-outline-light gap-1 rounded-pill">Related Packages
                        <strong>(20)</strong></button>
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
                    <h2 class="section__heading">About Jeddah</h2>
                    <p class="section__description">Steeped in heritage yet bursting with modern flair, Jeddah
                        effortlessly blends its captivating past with a dynamic present. Explore the UNESCO-listed
                        streets of Al Balad, where centuries-old architecture tells stories of trade, tradition, and
                        culture. Indulge in world-class shopping experiences at the Mall of Arabia and the prestigious
                        Red Sea Mall, home to international brands and vibrant local boutiques.</p>
                    <p class="section__description">Breathe in the refreshing sea breeze along the iconic Jeddah
                        Corniche, or dive beneath the waves into crystal-clear waters to explore some of the Red Sea’s
                        most vibrant coral reefs. As night falls, gaze upon the breathtaking spectacle of the King Fahd
                        Fountain, illuminating the sky as it propels water an astonishing 312 meters upward, making it
                        the tallest fountain in the world. <br />
                        Whether seeking adventure, culture, or relaxation, Jeddah promises an unforgettable experience
                        on the shores of the Red Sea</p>
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
                    <div class="dis-adventure__carousel-item swiper-slide">
                        <img src="{{ asset('frontend/assets/destinations/asser/4.jpg') }}" alt="Adventure Image 1" class="img-fluid">
                        <div class="dis-adventure__carousel-item-content">
                            <div class="dis-adventure__carousel-item-top">
                                <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Asser</div>
                            </div>
                            <div class="dis-adventure__carousel-item-bottom">
                                <h6>4 Days in Aseer: A Cultural and Scenic Escape Through Nature...</h6>
                                <div class="dis-adventure__carousel-item-footer">
                                    <a class="btn btn-outline-light rounded-pill">Related packages (20)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dis-adventure__carousel-item swiper-slide">
                        <img src="{{ asset('frontend/assets/destinations/diriyah/4.jpg') }}" alt="Adventure Image 1" class="img-fluid">
                        <div class="dis-adventure__carousel-item-content">
                            <div class="dis-adventure__carousel-item-top">
                                <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Diriyah</div>
                            </div>
                            <div class="dis-adventure__carousel-item-bottom">
                                <h6>4 Days in Diriyah: A Cultural and Scenic Escape Through Nature...</h6>
                                <div class="dis-adventure__carousel-item-footer">
                                    <a class="btn btn-outline-light rounded-pill">Related packages (20)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dis-adventure__carousel-item swiper-slide">
                        <img src="{{ asset('frontend/assets/destinations/eastern_province/2.jpg') }}" alt="Adventure Image 1" class="img-fluid">
                        <div class="dis-adventure__carousel-item-content">
                            <div class="dis-adventure__carousel-item-top">
                                <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Eastern Province</div>
                            </div>
                            <div class="dis-adventure__carousel-item-bottom">
                                <h6>4 Days in Eastern Province: A Cultural and Scenic Escape Through Nature...</h6>
                                <div class="dis-adventure__carousel-item-footer">
                                    <a class="btn btn-outline-light rounded-pill">Related packages (20)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dis-adventure__carousel-item swiper-slide">
                        <img src="{{ asset('frontend/assets/destinations/hail/1.jpg') }}" alt="Adventure Image 1" class="img-fluid">
                        <div class="dis-adventure__carousel-item-content">
                            <div class="dis-adventure__carousel-item-top">
                                <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Hail</div>
                            </div>
                            <div class="dis-adventure__carousel-item-bottom">
                                <h6>4 Days in Hail: A Cultural and Scenic Escape Through Nature...</h6>
                                <div class="dis-adventure__carousel-item-footer">
                                    <a class="btn btn-outline-light rounded-pill">Related packages (20)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dis-adventure__carousel-item swiper-slide">
                        <img src="{{ asset('frontend/assets/destinations/jazan/1.jpg') }}" alt="Adventure Image 1" class="img-fluid">
                        <div class="dis-adventure__carousel-item-content">
                            <div class="dis-adventure__carousel-item-top">
                                <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Jazan</div>
                            </div>
                            <div class="dis-adventure__carousel-item-bottom">
                                <h6>4 Days in Jazan: A Cultural and Scenic Escape Through Nature...</h6>
                                <div class="dis-adventure__carousel-item-footer">
                                    <a class="btn btn-outline-light rounded-pill">Related packages (20)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dis-adventure__carousel-item swiper-slide">
                        <img src="{{ asset('frontend/assets/destinations/kaec/1.jpg') }}" alt="Adventure Image 1" class="img-fluid">
                        <div class="dis-adventure__carousel-item-content">
                            <div class="dis-adventure__carousel-item-top">
                                <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Kaec</div>
                            </div>
                            <div class="dis-adventure__carousel-item-bottom">
                                <h6>4 Days in Kaec: A Cultural and Scenic Escape Through Nature...</h6>
                                <div class="dis-adventure__carousel-item-footer">
                                    <a class="btn btn-outline-light rounded-pill">Related packages (20)</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                <h5 class="fw-bold">4 Days in Aseer</h5>
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
                        <div class="stories-insight__carousel-item swiper-slide">
                            <img src="{{ asset('frontend/assets/things_to_do/at_turaif_in_diriyah.jpg') }}" alt="Story Image" class="img-fluid">
                            <div class="stories-insight__carousel-item-content">
                                <p class="text-light2">Culture & History, Art Gallery</p>
                                <p class="p-large text-black stories-insight__carousel-title">5 Must-Do Experiences in
                                Diriyah</p>
                            </div>
                        </div>
                        <div class="stories-insight__carousel-item swiper-slide">
                            <img src="{{ asset('frontend/assets/things_to_do/hegra_in_alula.jpg') }}" alt="Story Image" class="img-fluid">
                            <div class="stories-insight__carousel-item-content">
                                <p class="text-light2">Culture & History, Art Gallery</p>
                                <p class="p-large text-black stories-insight__carousel-title">5 Must-Do Experiences in
                                    Alula</p>
                            </div>
                        </div>
                        <div class="stories-insight__carousel-item swiper-slide">
                            <img src="{{ asset('frontend/assets/things_to_do/riyadh_front-& -boulevard_city.jpg') }}" alt="Story Image" class="img-fluid">
                            <div class="stories-insight__carousel-item-content">
                                <p class="text-light2">Culture & History, Art Gallery</p>
                                <p class="p-large text-black stories-insight__carousel-title">5 Must-Do Experiences in
                                Riyadh</p>
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
                            <img src="{{ asset('frontend/assets/destinations/hail/3.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i>  Hail</div>
                        </div>
                        <div class="exclusive-offers__carousel-item-info">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bold">Ha’il Adventure</h6>
                                <span class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                            </div>
                            <p class="text-muted small mb-2">2N Hail • 3D Jeddah</p>
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
                            <img src="{{ asset('frontend/assets/destinations/jazan/1.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i>  Jazan</div>
                        </div>
                        <div class="exclusive-offers__carousel-item-info"> 
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bold">Best of Jazan </h6>
                                <span class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                            </div>
                            <p class="text-muted small mb-2">2N  Jazan • 3D Jeddah</p>
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
                            <img src="{{ asset('frontend/assets/destinations/kaec/2.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i>  kaec</div>
                        </div>
                        <div class="exclusive-offers__carousel-item-info">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bold">KAEC Luxury </h6>
                                <span class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                            </div>
                            <p class="text-muted small mb-2">2N KAEC • 3D Jeddah</p>
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
                            <img src="{{ asset('frontend/assets/destinations/madinah/2.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i>  Madinah</div>
                        </div>
                        <div class="exclusive-offers__carousel-item-info">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bold">Madinah Peaceful </h6>
                                <span class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                            </div>
                            <p class="text-muted small mb-2">2N Madinah • 3D Jeddah</p>
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
                            <img src="{{ asset('frontend/assets/destinations/makkah/1.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i>  Makkah</div>
                        </div>
                        <div class="exclusive-offers__carousel-item-info">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bold">Spiritual Journey</h6>
                                <span class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                            </div>
                            <p class="text-muted small mb-2">2N Makkah • 3D Jeddah</p>
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
                                            src="../assets/icons/riyal.svg" alt="Riyal"> 1,22,100</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="exclusive-offers__carousel-item swiper-slide">
                        <div class="exclusive-offers__carousel-item-img">
                            <img src="{{ asset('frontend/assets/destinations/najran/1.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i>  Najran</div>
                        </div>
                        <div class="exclusive-offers__carousel-item-info">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bold">Heritage Escape</h6>
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
                                            src="../assets/icons/riyal.svg" alt="Riyal"> 1,22,100</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
                <div class="col-md-6 col-lg-3">
                    <div class="start-exploring__item">
                        <img src="{{ asset('frontend/assets/destinations/riyadh/6.jpg') }}" alt="Explore" class="img-fluid">
                        <div class="start-exploring__item-content">
                            <p class="mb-1 p-large fw-600">Riyadh</p>
                            <p class="p-small">Where Modern Vision Meets Deep Heritage</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="start-exploring__item">
                        <img src="{{ asset('frontend/assets/destinations/jeddah/2.jpg') }}" alt="Explore" class="img-fluid">
                        <div class="start-exploring__item-content">
                            <p class="mb-1 p-large fw-600">Jeddah</p>
                            <p class="p-small">The Gateway to the Red Sea’s Vibrant Culture</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="start-exploring__item">
                        <img src="{{ asset('frontend/assets/destinations/alula/3.jpg') }}" alt="Explore" class="img-fluid">
                        <div class="start-exploring__item-content">
                            <p class="mb-1 p-large fw-600">AlUla</p>
                            <p class="p-small">A Timeless Oasis of Nature and Ancient Wonders</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="start-exploring__item">
                        <img src="{{ asset('frontend/assets/destinations/ai_baha/4.jpg') }}" alt="Explore" class="img-fluid">
                        <div class="start-exploring__item-content">
                            <p class="mb-1 p-large fw-600">Abha</p>
                            <p class="p-small">The Mountain City of Cool Breezes and Scenic Beauty</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection 