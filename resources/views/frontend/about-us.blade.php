@extends('frontend.layout')
@section('content')
<!-- 1. ABOUT US: BANNER -->
   <section class="package-listing__banner about-us__banner">
        <div class="container">
            <div
                class="text-center justify-content-center package-listing__banner-content contact-us-banner align-items-center">
                <h1 class="h2 fw-bold text-white m-0">About Unxplord Saudi!</h1>
                <p>Visit Saudi is the official digital gateway to explore the Kingdom’s rich cultural heritage, stunning
                    landscapes, and authentic hospitality.</p>
            </div>
        </div>
    </section>

    <section class="section-padding-md">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-7">
                    <div class="section__header">
                        <div class="section__header-content">
                            <h2 class="section__heading">About Us</h2>
                            <p class="section__description p-large">Visit Saudi is the official digital gateway to
                                explore the
                                Kingdom’s rich cultural heritage, stunning landscapes, and authentic hospitality.</p>
                        </div>
                    </div>
                    <div class="row mt-5 gy-4">
                        <div class="col-md-6 col-lg-6">
                            <div class="contact-us__content-block rounded-5">
                                <h5 class="mb-2 fw-600">1. <br> Who We Are</h5>
                                <p>Visit Saudi is the official digital gateway to explore the Kingdom’s rich cultural.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="contact-us__content-block rounded-5">
                                <h5 class="mb-2 fw-600">2. <br> Vision</h5>
                                <p>Visit Saudi is the official digital gateway to explore the Kingdom’s rich cultural.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="contact-us__content-block rounded-5">
                                <h5 class="mb-2 fw-600">3. <br> Mission</h5>
                                <p>Visit Saudi is the official digital gateway to explore the Kingdom’s rich cultural.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="contact-us__content-block rounded-5">
                                <h5 class="mb-2 fw-600">4. <br> Strategic Objectives</h5>
                                <p>Visit Saudi is the official digital gateway to explore the Kingdom’s rich cultural.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="row about-us__img-wrapper">
                        <div class="col-6 about-us__img-left">
                            <div>
                                <img class="img-fluid rounded-5" src="{{ asset('frontend/assets/about-us1.png') }}" alt="About us">
                            </div>
                            <div class="mt-4">
                                <img class="img-fluid rounded-5" src="{{ asset('frontend/assets/about-us2.png') }}" alt="About us">
                            </div>
                        </div>
                        <div class="col-6 about-us__img-right">
                            <div>
                                <img class="img-fluid rounded-5" src="{{ asset('frontend/assets/about-us3.png') }}" alt="About us">
                            </div>
                            <div class="mt-4">
                                <img class="img-fluid rounded-5" src="{{ asset('frontend/assets/about-us4.png') }}" alt="About us">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding-md contact-us__offer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section__header">
                        <div class="section__header-content">
                            <h2 class="section__heading">What do we Offer?</h2>
                            <p class="section__description p-large">Visit Saudi is the official digital gateway to
                                explore the
                                Kingdom’s rich cultural heritage, stunning landscapes, and authentic hospitality.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row contact-us__offer-box-wrapper">
                <div class="col-md-6 col-lg-4">
                    <div class="contact-us__offer-box">
                        <div class="contact-us__offer-box-icon flex-center rounded-4 mb-1 primary-text">
                            <i class="fa-regular fa-building"></i>
                        </div>
                        <h5 class="fw-600">Book Hotels</h5>
                        <p>Find the best deals for hotels across Saudi Arabia from more than +70 sources. We provide
                            latest reviews, pictures and travel tips that helps you understand each hotel better.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="contact-us__offer-box">
                        <div class="contact-us__offer-box-icon flex-center rounded-4 mb-1 primary-text">
                            <i class="fa-solid fa-utensils"></i>
                        </div>
                        <h5 class="fw-600">Meet Restaurants</h5>
                        <p>Saudi Arabia has some amazing restaurants. Our restaurant search facility provides an
                            overview of restaurants in different cities. Your can filter search results based on cuisine
                            and restaurant type.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="contact-us__offer-box">
                        <div class="contact-us__offer-box-icon flex-center rounded-4 mb-1 primary-text">
                            <i class="fa-solid fa-route"></i>
                        </div>
                        <h5 class="fw-600">Discover Destinations</h5>
                        <p>Find the best deals for hotels across Saudi Arabia from more than +70 sources. We provide
                            latest reviews, pictures and travel tips that helps you understand each hotel better.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding-md">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section__header">
                        <div class="section__header-content">
                            <h2 class="section__heading">Our Values</h2>
                            <p class="section__description p-large">Visit Saudi is the official digital gateway to
                                explore the Kingdom’s rich cultural heritage, stunning landscapes, and authentic
                                hospitality.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4 gy-4">
                <div class="col-lg-6">
                    <div class="contact-us__content-block contact-us__our-values-box rounded-4 py-3 position-relative">
                        <p class="p-large primary-text fw-600">Authenticity</p>
                        <p class="p-large">We show the real Saudi Arabia, not a marketing fantasy.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-us__content-block contact-us__our-values-box rounded-4 py-3 position-relative">
                        <p class="p-large primary-text fw-600">Transparency</p>
                        <p class="p-large">Clear, honest information — nothing hidden.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-us__content-block contact-us__our-values-box rounded-4 py-3 position-relative">
                        <p class="p-large primary-text fw-600">Respect</p>
                        <p class="p-large">Cultural sensitivity is part of every guide and recommendation.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-us__content-block contact-us__our-values-box rounded-4 py-3 position-relative">
                        <p class="p-large primary-text fw-600">Innovation</p>
                        <p class="p-large">Smart tools and digital experiences that make travel easier.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                            <img src="{{ asset('/frontend/assets/exclusive-offer.png') }}" alt="Exclusive Offer" class="img-fluid">
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Macca</div>
                        </div>
                        <div class="exclusive-offers__carousel-item-info">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bold">Bujairi Terrace</h6>
                                <span class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                            </div>
                            <p class="text-muted small mb-2">2N Diriyah • 3D Jeddah</p>
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
                                        <img src="{{ asset('/frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        <p class="fw-bold text-dark">40,000</p> /Person
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img class="opacity-50" src="{{ asset('/frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        8,332
                                    </div>
                                    <p class="text-muted small">Total Price: <img class="opacity-50"
                                            src="{{ asset('/frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1,22,100</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="exclusive-offers__carousel-item swiper-slide">
                        <div class="exclusive-offers__carousel-item-img">
                            <img src="{{ asset('/frontend/assets/exclusive-offer.png') }}" alt="Exclusive Offer" class="img-fluid">
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Macca</div>
                        </div>
                        <div class="exclusive-offers__carousel-item-info">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bold">Bujairi Terrace</h6>
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
                                        <img src="{{ asset('/frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        <p class="p-large fw-bold text-dark">40,000</p> /Person
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img class="opacity-50" src="{{ asset('/frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        8,332
                                    </div>
                                    <p class="text-muted small">Total Price: <img class="opacity-50"
                                            src="{{ asset('/frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1,22,100</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="exclusive-offers__carousel-item swiper-slide">
                        <div class="exclusive-offers__carousel-item-img">
                            <img src="{{ asset('/frontend/assets/exclusive-offer.png') }}" alt="Exclusive Offer" class="img-fluid">
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Macca</div>
                        </div>
                        <div class="exclusive-offers__carousel-item-info">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bold">Bujairi Terrace</h6>
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
                                        <img src="{{ asset('/frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        <p class="p-large fw-bold text-dark">40,000</p> /Person
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img class="opacity-50" src="{{ asset('/frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        8,332
                                    </div>
                                    <p class="text-muted small">Total Price: <img class="opacity-50"
                                            src="{{ asset('/frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1,22,100</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="exclusive-offers__carousel-item swiper-slide">
                        <div class="exclusive-offers__carousel-item-img">
                            <img src="{{ asset('/frontend/assets/exclusive-offer.png') }}" alt="Exclusive Offer" class="img-fluid">
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Macca</div>
                        </div>
                        <div class="exclusive-offers__carousel-item-info">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bold">Bujairi Terrace</h6>
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
                                        <img src="{{ asset('/frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        <p class="p-large fw-bold text-dark">40,000</p> /Person
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img class="opacity-50" src="{{ asset('/frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        8,332
                                    </div>
                                    <p class="text-muted small">Total Price: <img class="opacity-50"
                                            src="{{ asset('/frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1,22,100</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="exclusive-offers__carousel-item swiper-slide">
                        <div class="exclusive-offers__carousel-item-img">
                            <img src="{{ asset('/frontend/assets/exclusive-offer.png') }}" alt="Exclusive Offer" class="img-fluid">
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Macca</div>
                        </div>
                        <div class="exclusive-offers__carousel-item-info">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bold">Bujairi Terrace</h6>
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
                                        <img src="{{ asset('/frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        <p class="p-large fw-bold text-dark">40,000</p> /Person
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img class="opacity-50" src="{{ asset('/frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        8,332
                                    </div>
                                    <p class="text-muted small">Total Price: <img class="opacity-50"
                                            src="{{ asset('/frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1,22,100</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="exclusive-offers__carousel-item swiper-slide">
                        <div class="exclusive-offers__carousel-item-img">
                            <img src="{{ asset('/frontend/assets/exclusive-offer.png') }}" alt="Exclusive Offer" class="img-fluid">
                            <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Macca</div>
                        </div>
                        <div class="exclusive-offers__carousel-item-info">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bold">Bujairi Terrace</h6>
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
                                        <img src="{{ asset('/frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        <p class="p-large fw-bold text-dark">40,000</p> /Person
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <img class="opacity-50" src="{{ asset('/frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                        8,332
                                    </div>
                                    <p class="text-muted small">Total Price: <img class="opacity-50"
                                            src="{{ asset('/frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1,22,100</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="custom__carousel-pagination"></div>
            </div>
        </div>
    </section>

    <section class="section-padding-md">
        <div class="container">
            <div class="section__header">
                <div class="section__header-content">
                    <h2 class="section__heading"><span class="fw-600">Start exploring</span></h2>
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
            <div class="row start-exploring__row gy-3">
                <div class="col-md-6 col-lg-3">
                    <div class="start-exploring__item">
                        <img src="{{ asset('/frontend/assets/start-explore-1.png') }}" alt="Explore" class="img-fluid">
                        <div class="start-exploring__item-content">
                            <p class="mb-1 p-large fw-600">Riyadh</p>
                            <p class="p-small">A Modern Capital Shaping the Future</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="start-exploring__item">
                        <img src="{{ asset('/frontend/assets/start-explore-1.png') }}" alt="Explore" class="img-fluid">
                        <div class="start-exploring__item-content">
                            <p class="mb-1 p-large fw-600">Jeddah</p>
                            <p class="p-small">A Coastal City Full of Life and Culture</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="start-exploring__item">
                        <img src="{{ asset('/frontend/assets/start-explore-1.png') }}" alt="Explore" class="img-fluid">
                        <div class="start-exploring__item-content">
                            <p class="mb-1 p-large fw-600">Makkah</p>
                            <p class="p-small">A Sacred City Welcoming Millions</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="start-exploring__item">
                        <img src="{{ asset('/frontend/assets/start-explore-1.png') }}" alt="Explore" class="img-fluid">
                        <div class="start-exploring__item-content">
                            <p class="mb-1 p-large fw-600">Madinah</p>
                            <p class="p-small">A Peaceful City of Spiritual Serenity</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endsection