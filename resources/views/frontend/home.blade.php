@php
    // JSON file path (inside app folder)
    $jsonPath = app_path('demojson.json');

    // Read & decode JSON safely
    $jsonData = [];
    if (file_exists($jsonPath)) {
        $jsonData = json_decode(file_get_contents($jsonPath), true);
    }

    // HOME PAGE DATA
    $home = $jsonData['home_page'] ?? [];

    $heroBanner = $home['heroBanner'] ?? [];
    $adventures = $home['adventures'] ?? [];
    $exclusiveOffers = $home['exclusive_offers'] ?? [];
    $upcomingEvents = $home['upcoming_events'] ?? [];
@endphp

<!-- <pre>{{ print_r($home, true) }}</pre> -->
{{-- @dd($things) --}}
@extends('frontend.layout')
@section('content')
<style>
.hero-banner__carousel .hero-banner__carousel-item>img{ border-radius: 10px;}
.explore-saudi__map {width: 250px;}
</style>
  <!-- HEADER -->
  <div id="header"></div>
  <!-- Page main content here -->
{{-- @dd($things) --}}
  <!-- 1. HERO BANNER SECTION  -->
  <section class="hero-banner">
    <video class="hero-banner__video" autoplay muted loop playsinline poster="{{ asset('frontend/assets/hero-banner-bg.png') }}">
      <source src="{{ asset('frontend/assets/Video_intro.mp4') }}" type="video/mp4">
      Your browser does not support the video tag.
    </video>
    <!-- <img class="hero-banner__image" src="../assets/hero-banner-bg.png" alt="Banner"> -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <div class="hero-banner__content">
            <h1 class="hero-banner__heading text-white">Unxplord <strong>the Kingdom</strong></h1>
            <h2 class="text-white h4">Beyond Maps. Beyond Ordinary.</h2>
            <p class="hero-banner__desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
              incididunt
              ut labore et dolore magna aliqua.</p>
            <button class="btn btn-light rounded-pill hero-banner__explore-btn">
              Explore Tours
              <i class="fa-solid fa-angles-right"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="hero-banner__bottom">
      <div class="container hero-banner__vision d-none-sm">
        <img src="{{ asset('frontend/assets/hero-banner-vision.png') }}" alt="Vision 2030" class="hero-banner__vision-img">
      </div>
      <div class="hero-banner__scroll-down d-none-sm">
        <div class="down-arrow">
          <i class="fa-solid fa-arrow-left"></i>
        </div>
        <p class="small">Scroll Down</p>
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
        @if(count($cities))
        @foreach($cities as $cites)
          <div class="hero-banner__carousel-item swiper-slide">
            <img src="{{ asset('storage/' . $cites->thumb_image) }}" alt="">
            <div class="hero-banner__carousel-item-content">
              <h6>{{ $cites->translation->name }} </h6>
              <p> {{ $cites->translation->tagline }}</p>
              {{-- <button class="btn btn-light btn-outline-light rounded-pill">
                <span class="small">Book Now</span>
              </button> --}}
            </div>
          </div>

          @endforeach
        @endif


        </div>
      </div>
    </div>
  </section>

  <!-- 2. PLAN TRIP SECTION  -->
  <section class="plan-trip section-padding">
    <div class="container">
      <div class="row gap-4-sm gap-4-md">
        <div class="col-sm-12 col-lg-6">
          <img src="{{ asset('frontend/assets/SM_1.png') }}" alt="Trip Plan" class="img-fluid plan-trip__image">
        </div>
        <div class="col-sm-12 col-lg-5">
          <div class="plan-trip__content">
            <div class="section__header">
              <div class="section__header-content">
                <h2 class="section__heading"><span class="fw-normal">Plan Your Trip With</span> Unxplord Saudi</h2>
                <p class="section__description">Discover Saudi Arabia like never before — from thrilling adventures and modern cities to ancient heritage and breathtaking landscapes. Let us help you plan a journey filled with unforgettable moments.</p>
              </div>
            </div>
            <div class="plan-trip__features">
              <div class="plan-trip__feature">
                <div class="plan-trip__feature-icon">
                  <img src="{{ asset('frontend/assets/icons/hidden-gems.svg') }}" alt="Hidden gems" class="img-fluid">
                </div>
                <div class="plan-trip__feature-text">
                  <h6 class="mb-1">Choose Your Destination</h6>
                  <p>Explore iconic cities, hidden gems, deserts, mountains, and coastal escapes across Saudi Arabia tailored to your travel style.</p>
                </div>
              </div>
              <div class="plan-trip__feature">
                <div class="plan-trip__feature-icon">
                  <img src="{{ asset('frontend/assets/icons/hidden-gems.svg') }}" alt="Hidden gems" class="img-fluid">
                </div>
                <div class="plan-trip__feature-text">
                  <h6 class="mb-1">Experience Culture & Adventure</h6>
                  <p>Enjoy cultural festivals, heritage sites, luxury shopping, motorsports, desert safaris, and Red Sea experiences in one journey.</p>
                </div>
              </div>
              <div class="plan-trip__feature">
                <div class="plan-trip__feature-icon">
                  <img src="{{ asset('frontend/assets/icons/hidden-gems.svg') }}" alt="Hidden gems" class="img-fluid">
                </div>
                <div class="plan-trip__feature-text">
                  <h6 class="mb-1">Travel With Confidence</h6>
                  <p>From planning to experiences, Unxplord Saudi ensures seamless travel with expert guidance, curated itineraries, and local insights.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-1 position-relative d-none-sm d-none-md">
          <h2 class="plan-trip__vertical-text">unxplord</h2>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. DISCOVER ADVENTURE SECTION  -->
  <section class="dis-adventure section-padding">
    <div class="container">
      <div class="section__header">
        <div class="section__header-content">
          <h2 class="section__heading">Discover Your Next Saudi Adventure</h2>
          <p class="section__description">Embark on unforgettable journeys and explore the hidden gems across the heart
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
        @foreach ($things as $thing)
            <x-frontend.thing-card :thing="$thing" />
        @endforeach
        </div>
        <div class="custom__carousel-pagination"></div>
      </div>
    </div>
  </section>

  <!-- 4. EXPLORE SAUDI -->
  <section class="explore-saudi">
    <div class="container">
      <div class="section-padding explore-saudi__container">
        <div class="row gap-4-sm gap-4-md">
          <div class="col-md-12 col-lg-6">
            <img src="{{ asset('frontend/assets/vertical-shot-people-riding-camels-sand-dune-desert.jpg') }}" alt="Explore Saudi" class="explore-saudi__image">
          </div>
          <div class="col-md-12 col-lg-6 explore-saudi__content">
            <div class="section__header">
              <div class="section__header-content">
                <h2 class="section__heading">Explore Saudi's diverse regions</h2>
              </div>
            </div>
            <ul class="nav nav-pills mt-3 explore-saudi__tabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="explore-saudi__riyad-tab" data-bs-toggle="pill"
                  data-bs-target="#explore-saudi__riyad-tab-content" type="button" role="tab"
                  aria-controls="explore-saudi__riyad-tab-content" aria-selected="true">Ar Riyad Region</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="explore-saudi__makkah-tab" data-bs-toggle="pill"
                  data-bs-target="#explore-saudi__makkah-tab-content" type="button" role="tab"
                  aria-controls="explore-saudi__makkah-tab-content" aria-selected="false">Jeddah Region</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="explore-saudi__madinah-tab" data-bs-toggle="pill"
                  data-bs-target="#explore-saudi__madinah-tab-content" type="button" role="tab"
                  aria-controls="explore-saudi__madinah-tab-content" aria-selected="false">AlUla Region</button>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="explore-saudi__riyad-tab-content" role="tabpanel"
                aria-labelledby="explore-saudi__riyad-tab">
                <div class="explore-saudi__tab-content">
                  <div class="explore-saudi__tab-content-map">
                    <img src="{{ asset('frontend/assets/city_map/Riyadh_map.svg') }}" alt="Explore Riyad" class="img-fluid explore-saudi__map">
                  </div>
                  <div class="explore-saudi__tab-content-info">
                    <h5 class="fw-bold">Ar Riyad Region</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
                    <a href="#" class="btn btn-primary rounded-pill">Explore Riyadh <i
                        class="fa-solid fa-angles-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="explore-saudi__makkah-tab-content" role="tabpanel"
                aria-labelledby="explore-saudi__makkah-tab">
                <div class="explore-saudi__tab-content">
                  <div class="explore-saudi__tab-content-map">
                    <img src="{{ asset('frontend/assets/city_map/Jeddah.svg') }}" alt="Explore Riyad" class="img-fluid explore-saudi__map">
                  </div>
                  <div class="explore-saudi__tab-content-info">
                    <h5 class="fw-bold">Jeddah Region</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
                    <a href="#" class="btn btn-primary rounded-pill">Explore Riyadh <i
                        class="fa-solid fa-angles-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="explore-saudi__madinah-tab-content" role="tabpanel"
                aria-labelledby="explore-saudi__madinah-tab">
                <div class="explore-saudi__tab-content">
                  <div class="explore-saudi__tab-content-map">
                    <img src="{{ asset('frontend/assets/city_map/AIYIA_Tabuk.svg') }}" alt="Explore Riyad" class="img-fluid explore-saudi__map">
                  </div>
                  <div class="explore-saudi__tab-content-info">
                    <h5 class="fw-bold">AlUla Region</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
                    <a href="#" class="btn btn-primary rounded-pill">Explore AlUlas <i
                        class="fa-solid fa-angles-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <img src="{{ asset('frontend/assets/explore-saudi-bg.png') }}" alt="Explore Saudi" class="explore-saudi__bg">
      </div>
    </div>
  </section>

  <!-- 5. EXCLUSIVE OFFERS -->
  <section class="exclusive-offers section-padding">
    <div class="container">
      <div class="section__header">
        <div class="section__header-content">
          <h2 class="section__heading">Discover exclusive offers</h2>
          <p class="section__description">Embark on unforgettable journeys and explore the hidden gems across the heart
            of Saudi Arabia</p>
        </div>
        <div class="section__header-CTA">
          <a href="{{ route('packages.index') }}" class="btn btn-primary rounded-pill">
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

  <!-- 6. VISA BANNER -->
  <section class="visa-banner d-flex align-items-center justify-content-center">
    <div class="visa-banner__content d-flex flex-column align-items-center gap-4">
      <h2 class="text-white fw-normal">Your <strong>Visa to Saudi</strong> Easier than ever</h2>
      <a href="#" class="btn btn-primary rounded-pill">Learn More <i class="fa-solid fa-angles-right"></i></a>
    </div>
  </section>

  <!-- 7. UPCOMING EVENT -->
  <section class="upcoming-event section-padding">
    <div class="container">
      <div class="section__header">
        <div class="section__header-content">
          <h2 class="section__heading">Upcoming Events</h2>
          <p class="section__description">Embark on unforgettable journeys and explore the hidden gems across the heart
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
            {{-- @dd($events) --}}
            @foreach ($events as $event)
            <x-frontend.event-card :event="$event" />
            {{-- <div class="upcoming-event__carousel-item swiper-slide">
                <div class="upcoming-event__carousel-item-img">
                    <img src="{{ asset('storage/' . $event->thumb->image_path) }}" alt="Event" class="img-fluid">
                    <div class="upcoming-event__carousel-item-dates">
                        <p>
                            @if ($event->start_date)
                                {{ \App\Helpers\DateHelper::badge($event->start_date) }}
                            @endif

                        </p>
                        <div class="vertical-divider"></div>
                        <p>
                            @if ($event->end_date)
                                <span class="date-badge">
                                    {{ \App\Helpers\DateHelper::badge($event->end_date) }}
                                </span>
                            @endif
                        </p>

                    </div>
                </div>
                <div class="upcoming-event__carousel-item-info">
                    <button class="btn btn-primary rounded-pill btn-sm gap-1"><i class="fa-solid fa-location-dot"></i>
                        {{ \Illuminate\Support\Str::title(str_replace('-', ' ', $event->city->slug)) }}
                        | {{ \Illuminate\Support\Str::title(str_replace('-', ' ', $event->category->slug)) }}
                    </button>
                    <div class="d-flex justify-content-between mt-3">
                        <h5 class="fw-bold">{{ $event->translation->title }}</h5>
                        <a href="#" class="p-large">
                            <i class="fa-solid fa-arrow-right-long primary-text"></i>
                        </a>
                    </div>
                </div>
            </div> --}}
            @endforeach

        </div>
        <div class="custom__carousel-pagination"></div>
      </div>
    </div>
  </section>

  <!-- 8. KNOW BEFORE YOU GO -->
  <section class="know-before section-padding">
    <div class="container">
      <div class="section__header">
        <div class="section__header-content">
          <h2 class="section__heading">Know Before You go</h2>
        </div>
      </div>
      <div class="row mt-4 gy-4">
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
          <div class="know-before-card border-0 shadow-sm h-100 d-flex gap-3">
            <img src="{{ asset('frontend/assets/destinations/riyadh/5.jpg') }} " class="img-fluid" alt="About Saudi">
            <div class="card-body d-flex flex-column gap-1 justify-content-center p-0">
              <h5 class="fw-bold">About <br>Saudi</h5>
              <a href="#" class="primary-text fw-semibold p-large">Learn More</a>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
          <div class="know-before-card border-0 shadow-sm h-100 d-flex gap-3">
            <img src="{{ asset('frontend/assets/destinations/yanbu/5.jpg') }}" class="img-fluid" alt="About Saudi">
            <div class="card-body d-flex flex-column gap-1 justify-content-center p-0">
              <h5 class="fw-bold">Visa Regulations</h5>
              <a href="#" class="primary-text fw-semibold p-large">Learn More</a>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
          <div class="know-before-card border-0 shadow-sm h-100 d-flex gap-3">
            <img src="{{ asset('frontend/assets/destinations/alula/3.jpg') }}" class="img-fluid" alt="About Saudi">
            <div class="card-body d-flex flex-column gap-1 justify-content-center p-0">
              <h5 class="fw-bold">Travel Guide</h5>
              <a href="#" class="primary-text fw-semibold p-large">Learn More</a>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
          <div class="know-before-card border-0 shadow-sm h-100 d-flex gap-3">
            <img src="{{ asset('frontend/assets/destinations/hail/3.jpg') }}" class="img-fluid" alt="About Saudi">
            <div class="card-body d-flex flex-column gap-1 justify-content-center p-0">
              <h5 class="fw-bold">Getting Around</h5>
              <a href="#" class="primary-text fw-semibold p-large">Learn More</a>
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
              <h2 class="section__heading">News and Events</h2>
              <p class="section__description">Discover inspiring travel stories and valuable insights from across Saudi
                Arabia. From hidden cultural gems to modern attractions, explore real experiences that help you plan
                your journey better.</p>
            </div>
            <div class="section__header-CTA">
              <a href="#" class="btn btn-primary rounded-pill">
                View All
                <i class="fa-solid fa-angles-right"></i>
              </a>
            </div>
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
                  <img src="{{ asset('frontend/assets/news-event1.jpg') }}" alt="News" class="img-fluid">
                  <div class="news-event__carousel-item-info">
                    <div class="small news-event__carousel-item-date mb-2">
                      <i class="fa-solid fa-calendar"></i>
                      Nov 28 | 15:30
                    </div>
                    <h6>The Magic of Saudi Arabia’s Golden Dunes: A Cultural Desert Journey</h6>
                  </div>
                </div>
                <div class="news-event__carousel-item swiper-slide">
                  <img src="{{ asset('frontend/assets/news-event2.jpg') }}" alt="News" class="img-fluid">
                  <div class="news-event__carousel-item-info">
                    <div class="small news-event__carousel-item-date mb-2">
                      <i class="fa-solid fa-calendar"></i>
                      Nov 28 | 15:30
                    </div>
                    <h6>Stepping Into Luxury: A First Look at Red Sea’s Iconic Seaside Retreat</h6>
                  </div>
                </div>
                <div class="news-event__carousel-item swiper-slide">
                  <img src="{{ asset('frontend/assets/news-event3.jpg') }}" alt="News" class="img-fluid">
                  <div class="news-event__carousel-item-info">
                    <div class="small news-event__carousel-item-date mb-2">
                      <i class="fa-solid fa-calendar"></i>
                      Nov 28 | 15:30
                    </div>
                    <h6>A Romantic Escape at Shebara Island: Where Luxury Meets Serenity</h6>
                  </div>
                </div>
                <div class="news-event__carousel-item swiper-slide">
                  <img src="{{ asset('frontend/assets/news-event4.jpg') }}" alt="News" class="img-fluid">
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
                <div class="fw-light">Save up to 60% with</div> The Saudi Pass
              </h2>
            </div>
            <div class="section__header-CTA">
              <a href="#" class="btn btn-primary rounded-pill">
                Grab it now
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

  @endsection
