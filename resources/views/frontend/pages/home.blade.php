@extends('frontend.layout')

@section('title','Explore Saudi Arabia | Travel Guide, Destinations & Experiences | Unxplord Saudi')

@section('meta_description', 'Discover Saudi Arabia’s top destinations, travel guides, cultural highlights, events, and curated experiences. Plan your perfect trip with Unxplord Saudi.')
@section('content')
    <style>
        .hero-banner__carousel .hero-banner__carousel-item>img {
            border-radius: 10px;
        }

        .explore-saudi__map {
            width: 250px;
        }

        </style>
        <style>

.hero-search-wrapper {
    position: relative;
    margin-top: 40px;
}

.hb-card,
.booking-card,
.hero-search-wrapper {
    overflow: visible !important;
}

/* TABS */
.booking-tabs {
    background: #ffffff;
    display: inline-flex;
    padding: 8px;
    border-radius: 50px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    margin-bottom: -25px;
    position: relative;
    z-index: 2;
}

.booking-tabs .tab-btn {
    flex: 1;
    border: none;
    background: transparent;
    padding: 10px 18px;
    border-radius: 50px;
    font-weight: 500;
    color: #666;
    cursor: pointer;
}

.booking-tabs .tab-btn.active {
    background: #169754;
    color: #fff;
}

/* CENTERED CARD */
.booking-card {
    background: #ffffff;

    padding: 35px;
    border-radius: 20px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.1);
}

/* FLEX ROW */
.booking-row {
    display: flex;
    align-items: center;
    gap: 20px;
}

/* FIELD */
.hb-field {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 8px;
    position: relative;

}

/* LABEL */
.hb-label {
    font-size: 13px;
    font-weight: 600;
    color: #7a7a7a;
    display: flex;
    align-items: center;
}

/* INPUT PILL */
.hb-input-pill {
    background: #f4f4f4;
    padding: 14px 22px;
    border-radius: 50px;
    position: relative;


}


.hb-input-pill input,
.hb-input-pill select {
    border: none;
    background: transparent;
    outline: none;
    width: 100%;
    font-size: 14px;
}

/* SEARCH BUTTON */
.hb-search-btn {
    background:
    #169754;
    color: #fff;
    border: none;
    padding: 16px 35px;
    border-radius: 50px;
    font-weight: 600;
}

/* COMING */
.coming-box {
    text-align: center;
    padding: 60px 0;
}

/* TAB LOGIC */
.tab-content { display: none; }
.tab-content.active { display: block; }

.hb-input-pill .travellers-dropdown
    {
        width:85% !important;
    }
    </style>
    <style>
        /* ============================= */
/* MOBILE RESPONSIVE */
/* ============================= */

@media (max-width: 992px) {

/* Reduce top overlap */
.hero-search-wrapper {
    /* margin-top: -40px; */
    margin-top: 15px;
}

/* Tabs scrollable */
.booking-tabs {
    width: 100%;
    overflow-x: auto;
    border-radius: 15px;
    padding: 8px;
    gap: 10px;
}

.booking-tabs .tab-btn {
    flex: 0 0 auto;
    white-space: nowrap;
    padding: 8px 16px;
    font-size: 14px;
}

/* Card padding smaller */
.booking-card {
    padding: 25px 15px;
    border-radius: 15px;
    position: relative;
    /* z-index: 100; */
}

/* Stack fields vertically */
.booking-row {
    flex-direction: column;
    align-items: stretch;
    gap: 15px;
}

.hb-field {
    width: 100%;
    position: relative;
}

/* Input pills full width */
.hb-input-pill {
    padding: 12px 18px;
}

/* Search button full width */
.hb-search-btn {
    width: 100%;
    padding: 14px;
    border-radius: 50px;
}

.booking-tabs::-webkit-scrollbar {
    display: none;
}
.booking-tabs {
    scrollbar-width: none;
}
.hb-input-pill select {
        position: relative;

    }

    .hb-input-pill .travellers-dropdown
    {
        width:75% !important;
    }

}


.city-suggestion-box {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background: #ffffff;
    border-radius: 15px;
    margin-top: 8px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    max-height: 250px;
    overflow-y: auto;
    z-index: 9999;
    padding: 10px 0;
}

.city-suggestion-box div {
    padding: 10px 20px;
    cursor: pointer;
    transition: 0.2s;
}

.city-suggestion-box div:hover {
    background: #f2f2f2;
}

.city-suggestion-box::-webkit-scrollbar {
    width: 5px;
}

.city-suggestion-box::-webkit-scrollbar-thumb {
    background: #ddd;
    border-radius: 10px;
}
        </style>
    <!-- HEADER -->
    <div id="header"></div>
    <!-- Page main content here -->

    <!-- 1. HERO BANNER SECTION  -->
    <section class="hero-banner">
        <video class="hero-banner__video" autoplay muted loop playsinline
            poster="{{ asset('frontend/assets/hero-banner-bg.png') }}">
            <source src="{{ asset('frontend/assets/Video_intro.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <!-- <img class="hero-banner__image" src="../assets/hero-banner-bg.png" alt="Banner"> -->
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="hero-banner__content">
                        <?php /**<x-frontend.hero-search /> **/?>
                        <h1 class="hero-banner__heading text-white">{!! __('home.hero.title') !!}</h1>
                        <h2 class="text-white h4">{{ __('home.hero.subtitle') }}</h2>
                        <p class="hero-banner__desc"> {{ __('home.hero.description') }}</p>
                        <a href="{{ route('packages.index') }}" class="text-decoration-none">
                        <button class="btn btn-light rounded-pill hero-banner__explore-btn">
                            {{ __('home.hero.explore_btn') }}
                            <i class="fa-solid fa-angles-right"></i>
                        </button>
                    </a>

                    </div>
                </div>

            </div>
        </div>

        <div class="hero-banner__bottom">
            <div class="container hero-banner__vision d-none-sm">
                <img src="{{ asset('frontend/assets/hero-banner-vision.png') }}" alt="Vision 2030"
                    class="hero-banner__vision-img">
            </div>
            <div class="hero-banner__scroll-down d-none-sm">
                <div class="down-arrow">
                    <a href="#plan-trip" class="text-decoration-none text-white"><i class="fa-solid fa-arrow-left"></i></a>
                </div>
                <p class="small">{{ __('home.hero.scroll') }}</p>
            </div>
            <div class="hero-banner__carousel swiper">
                <div class="hero-banner__carousel-pagination">
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button">
                        <div class="swiper-button-prev">
                            <i class="fa-solid fa-arrow-left"></i>
                        </div>
                        <div class="swiper-button-next">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
                <div class="swiper-wrapper">
                    @if (count($cities))
                        @foreach ($cities as $cites)
                            <div class="hero-banner__carousel-item swiper-slide">
                                <img src="{{ asset('storage/' . $cites->thumb_image) }}" alt="">
                                <div class="hero-banner__carousel-item-content">
                                    <h6>{{ $cites->translation->name }}</h6>
                                    <p>{{ $cites->translation->tagline }}</p>
                                    <a href="{{ route('destinations.show', $cites->slug) }}" class="text-white nav-link">
                                        <button class="btn btn-light btn-outline-light rounded-pill">

                                            <span class="small">{{ __('home.hero.view_now') }}</span>
                                        </button>
                                    </a>
                                </div>
                                {{-- <div class="hero-banner__carousel-item-content">
                                    <h6>{{ $cites->translation->name }} </h6>
                                    <p> {{ $cites->translation->tagline }}</p>
                                    <a href="{{ route('destinations.show', $cites->slug) }}"
                                        class="btn btn-outline-light rounded-pill">
                                        <span class="small">{{ __('home.hero.view_now') }}</span>
                                    </a>
                                </div> --}}
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>


    </section>
    <div class="hero-search-wrapper">

    <div class="container">

        <!-- TABS -->
        <div class="booking-tabs">
            <button class="tab-btn active" data-tab="package">Package</button>
            <button class="tab-btn" data-tab="flight">Flights</button>
            <button class="tab-btn" data-tab="hotel">Hotels</button>
            <button class="tab-btn" data-tab="event">Events</button>
        </div>

        <!-- SEARCH CARD -->
        <div class="booking-card">

            <div class="tab-content active" id="package">
            <form method="GET" action="{{route('packages.index')}}">
                <div class="booking-row">

                        <div class="hb-field">
                                <span class="hb-label">
                                    <i class="fa-solid fa-location-dot me-2"></i>{{__('home.filter.destination')}}
                                </span>
                                <div class="hb-input-pill">
                                   
                                <input required type="text" id="citySearchInput" class="search-input-new"
                                    placeholder="{{__('home.filter.destination.label')}}"
                                    autocomplete="off">
                                    <input type="hidden" name="cities[]"  id="cityIdInput">


                                    <!-- <input type="text" placeholder="Yogyakarta"> -->
                                </div>
                                <div id="citySuggestionBox" class="city-suggestion-box d-none"></div>
                        </div>

                        <div class="hb-field">
                            <span class="hb-label">
                                <i class="fa-solid fa-user me-2"></i>{{__('package.pricing.person')}}
                            </span>
                            <div class="hb-input-pill">
                                <div class="w-100 d-flex justify-content-between align-items-center gap-1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <p class="text-truncate traveller-summary">3 Adults, Economy</p>
                                    <i class="fa-solid fa-angle-down"></i>
                                </div>
                                <div class="dropdown-menu travellers-dropdown p-3 shadow-lg" id="travellerComponent">

                                    <!-- Adults -->
                                    <div class="traveller-row d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <strong>{{__('package.traveller.adults')}}</strong>
                                            <p class="text-muted small m-0">{{__('package.traveller.adults_age')}}</p>
                                        </div>

                                        <div class="traveller-counter d-flex align-items-center gap-2">
                                            <button type="button" class="traveller-counter-btn minus">
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                            <span class="count" data-type="adults">1</span>
                                            <input type="hidden" name="adult" id="home_adults" value="1">
                                            <button type="button" class="traveller-counter-btn plus">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Children -->
                                    <div class="traveller-row d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <strong>{{__('package.traveller.children')}}</strong>
                                            <p class="text-muted small m-0">{{__('package.traveller.children_age')}}</p>
                                        </div>

                                        <div class="traveller-counter d-flex align-items-center gap-2">
                                            <button type="button" class="traveller-counter-btn minus">
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                            <span class="count" data-type="children">0</span>
                                            <input type="hidden" name="children" id="home_children" value="0">
                                            <button type="button" class="traveller-counter-btn plus">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>

                        <div class="hb-field">
                            <span class="hb-label">
                                <i class="fa-solid fa-calendar me-2"></i>{{__('package.modal.starting_date')}}
                            </span>
                            <div class="hb-input-pill">
                                <input type="date" name="start_date" min="{{date('y-m-d')}}">
                            </div>
                        </div>
                        <div class="hb-field">
                            <span class="hb-label">

                            </span>
                            <div class="mt-1">
                            <button class="hb-search-btn">
                            {{__('packages.filters.search')}}
                            </button>
                            </div>
                        </div>


                </div>

                                </form>



            </div>

            <div class="tab-content" id="flight">
                <div class="coming-box">Flights Coming Soon </div>
            </div>
            <div class="tab-content" id="hotel">
                <div class="coming-box">Hotels Coming Soon </div>
            </div>
            <div class="tab-content" id="event">
                <div class="coming-box">Events Coming Soon </div>
            </div>

        </div>

    </div>
</div>
    <!-- 2. PLAN TRIP SECTION  -->
    <section class="plan-trip section-padding" id="plan-trip">
        <div class="container">
            <div class="row gap-4-sm gap-4-md">
                <div class="col-sm-12 col-lg-6">
                    <img src="{{ asset('frontend/assets/SM_1.png') }}" alt="Trip Plan" class="img-fluid plan-trip__image">
                </div>
                <div class="col-sm-12 col-lg-5">
                    <div class="plan-trip__content">
                        <div class="section__header">
                            <div class="section__header-content">
                                <h2 class="section__heading"><span
                                        class="fw-normal">{{ __('home.plan.title_light') }} </span> {{__('home.plan.title_bold')}}
                                </h2>
                                <p class="section__description">{{ __('home.plan.description') }}</p>
                            </div>
                        </div>
                        <div class="plan-trip__features">
                            <div class="plan-trip__feature">
                                <div class="plan-trip__feature-icon d-flex justify-content-center">
                                    <img width="55%" src="{{ asset('frontend/assets/icons/__Choose Your Destination.svg') }}" alt="Hidden gems"
                                        class="img-fluid">
                                </div>
                                <div class="plan-trip__feature-text">
                                    <h6 class="mb-1">{{ __('home.plan.feature1.title') }}</h6>
                                    <p>{{ __('home.plan.feature1.desc') }}</p>
                                </div>
                            </div>
                            <div class="plan-trip__feature">
                                <div class="plan-trip__feature-icon  d-flex justify-content-center">
                                    <img width="55%" src="{{ asset('frontend/assets/icons/__Experience Culture & Adventure.svg') }}" alt="Hidden gems"
                                        class="img-fluid">
                                </div>
                                <div class="plan-trip__feature-text">
                                    <h6 class="mb-1">{{ __('home.plan.feature2.title') }}</h6>
                                    <p>{{ __('home.plan.feature2.desc') }}</p>
                                </div>
                            </div>
                            <div class="plan-trip__feature">
                                <div class="plan-trip__feature-icon  d-flex justify-content-center">
                                    <img width="55%" src="{{ asset('frontend/assets/icons/__Travel With Confidence.svg') }}" alt="Hidden gems"
                                        class="img-fluid">
                                </div>
                                <div class="plan-trip__feature-text">
                                    <h6 class="mb-1">{{ __('home.plan.feature3.title') }}</h6>
                                    <p>{{ __('home.plan.feature3.desc') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 position-relative d-none-sm d-none-md">
                    <h2 class="plan-trip__vertical-text">{{ __('home.plan.vertical_text') }}</h2>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. DISCOVER ADVENTURE SECTION  -->
    @if ($things->count() > 0)
        <section class="dis-adventure section-padding">
            <div class="container">
                <div class="section__header">
                    <div class="section__header-content">
                        <h2 class="section__heading">{!! __('home.exclusive.title') !!}</h2>
                        <p class="section__description">{{ __('home.exclusive.description') }}</p>
                    </div>
                    <div class="section__header-CTA">
                        <a href="{{ route('things.to.do') }}" class="btn btn-primary rounded-pill">
                            {{ __('home.exclusive.view_all') }}
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

    <!-- 4. EXPLORE SAUDI -->
    <section class="explore-saudi">
        <div class="container">
            <div class="section-padding explore-saudi__container">
                <div class="row gap-4-sm gap-4-md">
                    <div class="col-md-12 col-lg-6">
                        <img src="{{ asset('frontend/assets/explore__image1.jpg') }}"
                            alt="Explore Saudi" class="explore-saudi__image" id="exploreMainImage">
                    </div>
                    <div class="col-md-12 col-lg-6 explore-saudi__content">
                        <div class="section__header">
                            <div class="section__header-content">
                                <h2 class="section__heading"> {{ __('home.explore.title') }}</h2>
                            </div>
                        </div>
                        <ul class="nav nav-pills mt-3 explore-saudi__tabs" role="tablist">
                            <li class="nav-item" role="presentation">

                                <button class="nav-link active" id="explore-saudi__madinah-tab" data-bs-toggle="pill"
                                    data-bs-target="#explore-saudi__madinah-tab-content" type="button" role="tab"
                                    aria-controls="explore-saudi__madinah-tab-content"
                                    aria-selected="false" data-image="{{ asset('frontend/assets/explore__image1.jpg') }}">{{ __('home.explore.tab.alula') }}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="explore-saudi__riyad-tab" data-bs-toggle="pill"
                                    data-bs-target="#explore-saudi__riyad-tab-content" type="button" role="tab"
                                    aria-controls="explore-saudi__riyad-tab-content"
                                    aria-selected="true"
                                    data-image="{{ asset('frontend/assets/explore__image2.jpg') }}"
                                    >{{ __('home.explore.tab.riyadh') }}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="explore-saudi__makkah-tab" data-bs-toggle="pill"
                                    data-bs-target="#explore-saudi__makkah-tab-content" type="button" role="tab"
                                    aria-controls="explore-saudi__makkah-tab-content" aria-selected="false" data-image="{{ asset('frontend/assets/explore__image3.jpg') }}">
                                    {{ __('home.explore.tab.jeddah') }}</button>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="explore-saudi__madinah-tab-content" role="tabpanel"
                                aria-labelledby="explore-saudi__madinah-tab">
                                <div class="explore-saudi__tab-content">
                                    <div class="explore-saudi__tab-content-map">
                                        <img src="{{ asset('frontend/assets/city_map/AIYIA_Tabuk.svg') }}"
                                            alt="Explore Riyad" class="img-fluid explore-saudi__map">
                                    </div>
                                    <div class="explore-saudi__tab-content-info">
                                        <h5 class="fw-bold">{{ __('home.explore.alula.title') }}</h5>
                                        <p>{{ __('home.explore.alula.desc') }}</p>
                                        <a href="{{ route('destinations.show', 'alula') }}"
                                            class="btn btn-primary rounded-pill">{{ __('home.explore.alula.btn') }} <i
                                                class="fa-solid fa-angles-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="explore-saudi__riyad-tab-content" role="tabpanel"
                                aria-labelledby="explore-saudi__riyad-tab">
                                <div class="explore-saudi__tab-content">
                                    <div class="explore-saudi__tab-content-map">
                                        <img src="{{ asset('frontend/assets/city_map/Riyadh_map.svg') }}"
                                            alt="Explore Riyad" class="img-fluid explore-saudi__map">
                                    </div>
                                    <div class="explore-saudi__tab-content-info">
                                        <h5 class="fw-bold">{{ __('home.explore.riyadh.title') }}</h5>
                                        <p>{{ __('home.explore.riyadh.desc') }}</p>
                                        <a href="{{ route('destinations.show', 'riyadh') }}" class="btn btn-primary rounded-pill">
                                            {{ __('home.explore.riyadh.btn') }} <i
                                                class="fa-solid fa-angles-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="explore-saudi__makkah-tab-content" role="tabpanel"
                                aria-labelledby="explore-saudi__makkah-tab">
                                <div class="explore-saudi__tab-content">
                                    <div class="explore-saudi__tab-content-map">
                                        <img src="{{ asset('frontend/assets/city_map/Jeddah.svg') }}" alt="Explore Riyad"
                                            class="img-fluid explore-saudi__map">
                                    </div>
                                    <div class="explore-saudi__tab-content-info">
                                        <h5 class="fw-bold">{{ __('home.explore.jeddah.title') }}</h5>
                                        <p>{{ __('home.explore.jeddah.desc') }}</p>
                                        <a href="{{ route('destinations.show', 'jeddah') }}" class="btn btn-primary rounded-pill">
                                            {{ __('home.explore.jeddah.btn') }} <i
                                                class="fa-solid fa-angles-right"></i></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <img src="{{ asset('frontend/assets/explore-saudi-bg.png') }}" alt="Explore Saudi"
                    class="explore-saudi__bg">
            </div>
        </div>
    </section>

    <!-- 5. EXCLUSIVE OFFERS -->
    @if ($packages->count() > 0)
        <section class="exclusive-offers section-padding">
            <div class="container">
                <div class="section__header">
                    <div class="section__header-content">
                        <h2 class="section__heading">{!! __('destination_details.exclusive_offers.title') !!}</h2>
                        <p class="section__description">{{ __('home.plan.description') }}</p>
                    </div>
                    <div class="section__header-CTA">
                        <a href="{{ route('packages.index') }}" class="btn btn-primary rounded-pill">
                            {{ __('home.exclusive.view_all') }}
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
    @endif
    <!-- 6. VISA BANNER -->
    <section class="visa-banner d-flex align-items-center justify-content-center">
        <div class="visa-banner__content d-flex flex-column align-items-center gap-4">
            <h2 class="text-white fw-normal">{!! __('home.visa.title') !!}</h2>
            <a href="{{route('packages.index')}}" class="btn btn-primary rounded-pill">{{ __('home.visa.learn_more') }} <i
                    class="fa-solid fa-angles-right"></i></a>
        </div>
    </section>
    @if ($events->count() > 0)
        <!-- 7. UPCOMING EVENT -->
        <section class="upcoming-event section-padding">
            <div class="container">
                <div class="section__header">
                    <div class="section__header-content">
                        <h2 class="section__heading"> {!! __('home.events.title') !!}</h2>
                        <p class="section__description">{{ __('home.events.description') }}</p>
                    </div>
                    <div class="section__header-CTA">
                        <a href="{{ route('event.listing') }}" class="btn btn-primary rounded-pill">
                            {{ __('home.events.view_all') }}
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
    <!-- 8. KNOW BEFORE YOU GO -->
    <section class="know-before section-padding">
        <div class="container">
            <div class="section__header">
                <div class="section__header-content">
                    <h2 class="section__heading">{{ __('home.know.title') }}</h2>
                </div>
            </div>
            <div class="row mt-4 gy-4">
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="know-before-card border-0 shadow-sm h-100 d-flex gap-3">
                        <img src="{{ asset('frontend/assets/destinations/riyadh/5.jpg') }} " class="img-fluid"
                            alt="About Saudi">
                        <div class="card-body d-flex flex-column gap-1 justify-content-center p-0">
                            <h5 class="fw-bold">{!! __('home.know.about') !!}</h5>
                            <a href="{{ route('info.about-saudi') }}"
                                class="primary-text fw-semibold p-large text-decoration-none">{{ __('home.know.learn_more') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="know-before-card border-0 shadow-sm h-100 d-flex gap-3">
                        <img src="{{ asset('frontend/assets/destinations/yanbu/5.jpg') }}" class="img-fluid"
                            alt="About Saudi">
                        <div class="card-body d-flex flex-column gap-1 justify-content-center p-0">
                            <h5 class="fw-bold">{{ __('home.know.visa') }}</h5>
                            <a href="{{ route('info.visa-regulations') }}"
                                class="primary-text fw-semibold p-large text-decoration-none">{{ __('home.know.learn_more') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="know-before-card border-0 shadow-sm h-100 d-flex gap-3">
                        <img src="{{ asset('frontend/assets/destinations/alula/3.jpg') }}" class="img-fluid"
                            alt="About Saudi">
                        <div class="card-body d-flex flex-column gap-1 justify-content-center p-0">
                            <h5 class="fw-bold">{{ __('home.know.guide') }}</h5>
                            <a href="{{ route('info.travel-guide') }}"
                                class="primary-text fw-semibold p-large text-decoration-none">{{ __('home.know.learn_more') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="know-before-card border-0 shadow-sm h-100 d-flex gap-3">
                        <img src="{{ asset('frontend/assets/destinations/hail/3.jpg') }}" class="img-fluid"
                            alt="About Saudi">
                        <div class="card-body d-flex flex-column gap-1 justify-content-center p-0">
                            <h5 class="fw-bold">{{ __('home.know.transport') }}</h5>
                            <a href="{{ route('info.getting-around') }}" class="primary-text fw-semibold p-large text-decoration-none">
                                {{ __('home.know.learn_more') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. NEWS EVENT -->
    <section class="news-event section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4 d-flex align-items-center">
                    <div class="section__header flex-column align-items-start gap-4">
                        <div class="section__header-content">
                            <h2 class="section__heading">{!!__('home.news.title') !!}</h2>
                            <p class="section__description">{{ __('home.news.description') }}</p>
                        </div>
                        {{-- <div class="section__header-CTA">
                            <a href="#" class="btn btn-primary rounded-pill">
                                {{ __('home.news.view_all') }}
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </div> --}}
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="news-event__carousel-container">
                        <div class="news-event__carousel-prev">
                            <i class="fa-solid fa-arrow-left"></i>
                        </div>
                        <div class="news-event__carousel swiper">
                            <div class="news-event__carousel-wrapper swiper-wrapper">
                                <div class="news-event__carousel-item swiper-slide">
                                    <img src="{{ asset('frontend/assets/news-event1.jpg') }}" alt="News"
                                        class="img-fluid">
                                    <div class="news-event__carousel-item-info">
                                        <div class="small news-event__carousel-item-date mb-2">
                                            <i class="fa-solid fa-calendar"></i>
                                            Nov 28 | 15:30
                                        </div>
                                        <h6>The Magic of Saudi Arabia’s Golden Dunes: A Cultural Desert Journey</h6>
                                    </div>
                                </div>
                                <div class="news-event__carousel-item swiper-slide">
                                    <img src="{{ asset('frontend/assets/news-event2.jpg') }}" alt="News"
                                        class="img-fluid">
                                    <div class="news-event__carousel-item-info">
                                        <div class="small news-event__carousel-item-date mb-2">
                                            <i class="fa-solid fa-calendar"></i>
                                            Nov 28 | 15:30
                                        </div>
                                        <h6>Stepping Into Luxury: A First Look at Red Sea’s Iconic Seaside Retreat</h6>
                                    </div>
                                </div>
                                <div class="news-event__carousel-item swiper-slide">
                                    <img src="{{ asset('frontend/assets/news-event3.jpg') }}" alt="News"
                                        class="img-fluid">
                                    <div class="news-event__carousel-item-info">
                                        <div class="small news-event__carousel-item-date mb-2">
                                            <i class="fa-solid fa-calendar"></i>
                                            Nov 28 | 15:30
                                        </div>
                                        <h6>A Romantic Escape at Shebara Island: Where Luxury Meets Serenity</h6>
                                    </div>
                                </div>
                                <div class="news-event__carousel-item swiper-slide">
                                    <img src="{{ asset('frontend/assets/news-event4.jpg') }}" alt="News"
                                        class="img-fluid">
                                    <div class="news-event__carousel-item-info">
                                        <div class="small news-event__carousel-item-date mb-2">
                                            <i class="fa-solid fa-calendar"></i>
                                            Nov 28 | 15:30
                                        </div>
                                        <h6>Desert Sunsets & Adventure: The Ultimate Arabian Sand Dune..</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="news-event__carousel-next">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-md-8">
                    <div class="news-event__carousel-container">

                        <div class="news-event__carousel-prev">
                            <i class="fa-solid fa-arrow-left"></i>
                        </div>

                        <div class="news-event__carousel swiper">
                            <div class="news-event__carousel-wrapper swiper-wrapper">

                                @forelse($blogs as $blog)
                                    @php
                                        $title = $blog->translation?->title ?? '—';
                                        $image = $blog->thumb?->image_path
                                            ? asset('storage/' . $blog->thumb->image_path)
                                            : asset('frontend/assets/news-event1.jpg');
                                    @endphp

                                    <div class="news-event__carousel-item swiper-slide">
                                        <a class="text-decoration-none text-dark" href="{{ route('blogs.detail', $blog->slug) }}">

                                            <img src="{{ $image }}"
                                                 alt="{{ $title }}"
                                                 class="img-fluid">

                                            <div class="news-event__carousel-item-info">

                                                <div class="small news-event__carousel-item-date mb-2">
                                                    <i class="fa-solid fa-calendar"></i>
                                                    {{ optional($blog->published_at)->format('M d | H:i') }}
                                                </div>

                                                <h6>{{ Str::limit($title, 80) }}</h6>

                                            </div>
                                        </a>
                                    </div>

                                @empty
                                    <div class="p-4 text-center">
                                        No blogs found
                                    </div>
                                @endforelse

                            </div>
                        </div>

                        <div class="news-event__carousel-next">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>

                    </div>
                </div> --}}
            </div>
        </div>
    </section>

    <!-- 10. SAUDI PASS BOTTOM BANNER -->
    <section class="saudi-pass-banner section-padding">
        <div class="container">
            <div class="row saudi-pass-banner__container mx-0">
                <div class="col-md-6 d-flex align-items-center">
                    <div class="saudi-pass-banner__left-decor d-none-sm d-none-md">
                        <img src="{{ asset('frontend/assets/saudi-pass-left.png') }}" alt="img">
                    </div>
                    <div class="section__header flex-column align-items-start gap-4">
                        <div class="section__header-content">
                            <h2 class="section__heading text-white">
                                <div class="fw-light"> {{ __('home.pass.light') }}</div> {{ __('home.pass.bold') }}
                            </h2>
                        </div>
                        <div class="section__header-CTA">
                            <a href="{{route('packages.index')}}" class="btn btn-primary rounded-pill">
                                {{ __('home.pass.cta') }}
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 position-relative saudi-pass-banner__image-container">
                    <img src="{{ asset('frontend/assets/saudi-pass-banner.png') }}" alt="Saudi Banner Image"
                        class="img-fluid saudi-pass-banner__image">
                    <div class="saudi-pass-banner__shadow"></div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mainImage = document.getElementById('exploreMainImage');

            document.querySelectorAll('.explore-saudi__tabs .nav-link').forEach(tab => {
                tab.addEventListener('shown.bs.tab', function (event) {
                    const newImage = event.target.getAttribute('data-image');
                    if (newImage) {
                        mainImage.src = newImage;
                    }
                });
            });
        });
    </script>
    <script>
document.querySelectorAll('.tab-btn').forEach(button => {
    button.addEventListener('click', function() {

        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');

        let tab = this.getAttribute('data-tab');

        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.remove('active');
        });

        document.getElementById(tab).classList.add('active');
    });
});
</script>

<script>
    const input = document.getElementById('citySearchInput');
const box = document.getElementById('citySuggestionBox');
const form = input.closest('form');

let debounceTimer;

// 🔥 fetch helper
function fetchCities(query = '') {
    fetch('/cities/search?q=' + encodeURIComponent(query))
        .then(res => res.json())
        .then(renderCities)
        .catch(() => box.classList.add('d-none'));
}

// ✅ show default cities on focus
input.addEventListener('focus', function () {
    fetchCities(); // first 20 cities
});

// ✅ typing search
input.addEventListener('input', function () {
    const query = this.value.trim();

    clearTimeout(debounceTimer);

    if (query.length < 2) {
        fetchCities(); // show default again
        return;
    }

    debounceTimer = setTimeout(() => {
        fetchCities(query);
    }, 300);
});

// ✅ render
function renderCities(cities) {
    if (!cities || !cities.length) {
        box.innerHTML = `<div class="city-suggestion-item">No destinations found</div>`;
        box.classList.remove('d-none');
        return;
    }

    box.innerHTML = cities.map(city => `
        <div class="city-suggestion-item"
             data-name="${city.name}" data-id="${city.id}">
            <span>${city.name}</span>
        </div>
    `).join('');

    box.classList.remove('d-none');
}

// 🚀 select city
box.addEventListener('click', function (e) {
    const item = e.target.closest('.city-suggestion-item');
    if (!item) return;

    input.value = item.dataset.name;
    document.getElementById("cityIdInput").value = item.dataset.id;

    box.classList.add('d-none');
});

// ✅ outside click
document.addEventListener('click', function (e) {
    if (!e.target.closest('.search-input-wrap')) {
        box.classList.add('d-none');
    }
});
    // const input = document.getElementById('citySearchInput');
    // const box = document.getElementById('citySuggestionBox');
    // const form = input.closest('form');

    // let debounceTimer;

    // // 🔥 fetch helper
    // function fetchCities(query = '') {
    //     fetch('/cities/search?q=' + encodeURIComponent(query))
    //         .then(res => res.json())
    //         .then(renderCities)
    //         .catch(() => box.classList.add('d-none'));
    // }

    // // ✅ typing → only after 2 chars
    // input.addEventListener('input', function () {
    //     const query = this.value.trim();

    //     clearTimeout(debounceTimer);

    //     if (query.length < 2) {
    //         box.classList.add('d-none');
    //         return;
    //     }

    //     debounceTimer = setTimeout(() => {
    //         fetchCities();
    //     }, 300);
    // });

    // // ✅ render
    // function renderCities(cities) {
    //     if (!cities || !cities.length) {
    //         box.innerHTML = `<div class="city-suggestion-item">No destinations found</div>`;
    //         box.classList.remove('d-none');
    //         return;
    //     }

    //     box.innerHTML = cities.map(city => `
    //         <div class="city-suggestion-item"
    //              data-name="${city.name}" data-id="${city.id}">
    //             <span>${city.name}</span>
    //         </div>
    //     `).join('');

    //     box.classList.remove('d-none');
    // }

    // // 🚀 ✅ CLICK → FILL + AUTO SUBMIT
    // box.addEventListener('click', function (e) {
    //     const item = e.target.closest('.city-suggestion-item');
    //     if (!item) return;

    //     // fill input
    //     input.value = item.dataset.name;

    //     // Store ID in hidden input
    // document.getElementById("cityIdInput").value = item.dataset.id;
    //     console.log(item);

    //     // hide dropdown
    //     box.classList.add('d-none');

    //     // 🔥 small delay for smooth UX
    //     // setTimeout(() => {
    //     //     form.submit();
    //     // }, 150);
    // });

    // // ✅ outside click
    // document.addEventListener('click', function (e) {
    //     if (!e.target.closest('.search-input-wrap')) {
    //         box.classList.add('d-none');
    //     }
    // });
    </script>
<script>
(function () {

    const wrapper = document.getElementById("travellerComponent");
    if (!wrapper) return;

    const summaryEl = document.querySelector(".traveller-summary");

    const adultsSpan = wrapper.querySelector('[data-type="adults"]');
    const childrenSpan = wrapper.querySelector('[data-type="children"]');

    const adultsInput = document.getElementById("home_adults");
    const childrenInput = document.getElementById("home_children");

    function updateSummary() {

        const adults = parseInt(adultsSpan.innerText);
        const children = parseInt(childrenSpan.innerText);

        // 🔥 Update hidden inputs
        adultsInput.value = adults;
        childrenInput.value = children;

        let text = adults + " Adult" + (adults > 1 ? "s" : "");

        if (children > 0) {
            text += ", " + children + " Child" + (children > 1 ? "ren" : "");
        }

        summaryEl.innerText = text;
    }

    wrapper.querySelectorAll(".traveller-counter-btn").forEach(btn => {

        btn.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();

            const countEl = this.parentElement.querySelector(".count");
            const type = countEl.dataset.type;

            let count = parseInt(countEl.innerText);

            if (this.classList.contains("plus")) {
                count++;
            } else {
                if (type === "adults" && count <= 1) return;
                if (type === "children" && count <= 0) return;
                count--;
            }

            countEl.innerText = count;
            updateSummary();
        });

    });

    // Update on page load
    updateSummary();

})();
</script>

 
    @endpush

@endsection
