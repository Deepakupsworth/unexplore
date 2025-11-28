@extends('frontend.layout')
@section('content')

  <!-- HEADER -->
  <div id="header"></div>
  <!-- Page main content here -->

  <!-- 1. HERO BANNER SECTION  -->
  <section class="hero-banner">
    <video class="hero-banner__video" autoplay muted loop playsinline poster="{{ asset('frontend/assets/hero-banner-bg.png') }}">
      <source src="{{ asset('frontend/assets/videos/seekers-entry-video.mp4') }}" type="video/mp4"> 
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
          <div class="hero-banner__carousel-item swiper-slide">
            <img src="{{ asset('frontend/assets/hero-banner-carousel1.png') }}" alt="Carousel Image 1">
            <div class="hero-banner__carousel-item-content">
              <h6>Best of Riyadh</h6>
              <p>Experience the finest sights, flavors, and culture of Riyadh</p>
              <button class="btn btn-light btn-outline-light rounded-pill">
                <span class="small">Book Now</span>
              </button>
            </div>
          </div>
          <div class="hero-banner__carousel-item swiper-slide">
            <img src="{{ asset('frontend/assets/hero-banner-carousel1.png') }}" alt="Carousel Image 1">
            <div class="hero-banner__carousel-item-content">
              <h6>Best of Riyadh</h6>
              <p>Experience the finest sights, flavors, and culture of Riyadh</p>
              <button class="btn btn-light btn-outline-light rounded-pill">
                <span class="small">Book Now</span>
              </button>
            </div>
          </div>
          <div class="hero-banner__carousel-item swiper-slide">
            <img src="{{ asset('frontend/assets/hero-banner-carousel1.png') }}" alt="Carousel Image 1">
            <div class="hero-banner__carousel-item-content">
              <h6>Best of Riyadh</h6>
              <p>Experience the finest sights, flavors, and culture of Riyadh</p>
              <button class="btn btn-light btn-outline-light rounded-pill">
                <span class="small">Book Now</span>
              </button>
            </div>
          </div>
          <div class="hero-banner__carousel-item swiper-slide">
            <img src="{{ asset('frontend/assets/hero-banner-carousel1.png') }}" alt="Carousel Image 1">
            <div class="hero-banner__carousel-item-content">
              <h6>Best of Riyadh</h6>
              <p>Experience the finest sights, flavors, and culture of Riyadh</p>
              <button class="btn btn-light btn-outline-light rounded-pill">
                <span class="small">Book Now</span>
              </button>
            </div>
          </div>
          <div class="hero-banner__carousel-item swiper-slide">
            <img src="{{ asset('frontend/assets/hero-banner-carousel1.png') }}" alt="Carousel Image 1">
            <div class="hero-banner__carousel-item-content">
              <h6>Best of Riyadh</h6>
              <p>Experience the finest sights, flavors, and culture of Riyadh</p>
              <button class="btn btn-light btn-outline-light rounded-pill">
                <span class="small">Book Now</span>
              </button>
            </div>
          </div>
          <div class="hero-banner__carousel-item swiper-slide">
            <img src="{{ asset('frontend/assets/hero-banner-carousel1.png') }}" alt="Carousel Image 1">
            <div class="hero-banner__carousel-item-content">
              <h6>Best of Riyadh</h6>
              <p>Experience the finest sights, flavors, and culture of Riyadh</p>
              <button class="btn btn-light btn-outline-light rounded-pill">
                <span class="small">Book Now</span> 
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> 

  <!-- 2. PLAN TRIP SECTION  -->
  <section class="plan-trip section-padding">
    <div class="container">
      <div class="row gap-4-sm gap-4-md">
        <div class="col-sm-12 col-lg-6">
          <img src="{{ asset('frontend/assets/trip-plan.png') }}" alt="Trip Plan" class="img-fluid plan-trip__image">
        </div>
        <div class="col-sm-12 col-lg-5">
          <div class="plan-trip__content">
            <div class="section__header">
              <div class="section__header-content">
                <h2 class="section__heading"><span class="fw-normal">Plan Your Trip With</span> Unxplord Saudi</h2>
                <p class="section__description">There are many variations of passages of available but the majority have
                  suffered alteration in some form, by injected hum randomised words.</p>
              </div>
            </div>
            <div class="plan-trip__features">
              <div class="plan-trip__feature">
                <div class="plan-trip__feature-icon">
                  <img src="{{ asset('frontend/assets/icons/hidden-gems.svg') }}" alt="Hidden gems" class="img-fluid">
                </div>
                <div class="plan-trip__feature-text">
                  <h6 class="mb-1">Choose Your Destination</h6>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
                </div>
              </div>
              <div class="plan-trip__feature">
                <div class="plan-trip__feature-icon">
                  <img src="{{ asset('frontend/assets/icons/hidden-gems.svg') }}" alt="Hidden gems" class="img-fluid">
                </div>
                <div class="plan-trip__feature-text">
                  <h6 class="mb-1">Choose Your Destination</h6>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
                </div>
              </div>
              <div class="plan-trip__feature">
                <div class="plan-trip__feature-icon">
                  <img src="{{ asset('frontend/assets/icons/hidden-gems.svg') }}" alt="Hidden gems" class="img-fluid">
                </div>
                <div class="plan-trip__feature-text">
                  <h6 class="mb-1">Choose Your Destination</h6>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
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
          <div class="dis-adventure__carousel-item swiper-slide">
            <img src="{{ asset('frontend/assets/adventure1.png') }}" alt="Adventure Image 1" class="img-fluid">
            <div class="dis-adventure__carousel-item-content">
              <div class="dis-adventure__carousel-item-top">
                <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Macca</div>
              </div>
              <div class="dis-adventure__carousel-item-bottom">
                <h6>4 Days in Aseer: A Cultural and Scenic Escape Through Nature...</h6>
                <div class="dis-adventure__carousel-item-footer">
                  <p class="dis-adventure__carousel-riyal"><img src="{{ asset('frontend/assets/adventure1.png') }}" alt="Riyal"> 1500</p>
                  <a class="btn btn-outline-light rounded-pill">Book Now</a>
                </div>
              </div>
            </div>
          </div>
          <div class="dis-adventure__carousel-item swiper-slide">
            <img src="{{ asset('frontend/assets/adventure1.png') }}" alt="Adventure Image 1" class="img-fluid">
            <div class="dis-adventure__carousel-item-content">
              <div class="dis-adventure__carousel-item-top">
                <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Macca</div>
              </div>
              <div class="dis-adventure__carousel-item-bottom">
                <h6>4 Days in Aseer: A Cultural and Scenic Escape Through Nature...</h6>
                <div class="dis-adventure__carousel-item-footer">
                  <p class="dis-adventure__carousel-riyal"><img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1500</p>
                  <a class="btn btn-outline-light rounded-pill">Book Now</a>
                </div>
              </div>
            </div>
          </div>
          <div class="dis-adventure__carousel-item swiper-slide">
            <img src="{{ asset('frontend/assets/adventure1.png') }}" alt="Adventure Image 1" class="img-fluid">
            <div class="dis-adventure__carousel-item-content">
              <div class="dis-adventure__carousel-item-top">
                <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Macca</div>
              </div>
              <div class="dis-adventure__carousel-item-bottom">
                <h6>4 Days in Aseer: A Cultural and Scenic Escape Through Nature...</h6>
                <div class="dis-adventure__carousel-item-footer">
                  <p class="dis-adventure__carousel-riyal"><img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1500</p>
                  <a class="btn btn-outline-light rounded-pill">Book Now</a>
                </div>
              </div>
            </div>
          </div>
          <div class="dis-adventure__carousel-item swiper-slide">
            <img src="{{ asset('frontend/assets/adventure1.png') }}" alt="Adventure Image 1" class="img-fluid">
            <div class="dis-adventure__carousel-item-content">
              <div class="dis-adventure__carousel-item-top">
                <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Macca</div>
              </div>
              <div class="dis-adventure__carousel-item-bottom">
                <h6>4 Days in Aseer: A Cultural and Scenic Escape Through Nature...</h6>
                <div class="dis-adventure__carousel-item-footer">
                  <p class="dis-adventure__carousel-riyal"><img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1500</p>
                  <a class="btn btn-outline-light rounded-pill">Book Now</a>
                </div>
              </div>
            </div>
          </div>
          <div class="dis-adventure__carousel-item swiper-slide">
            <img src="{{ asset('frontend/assets/adventure1.png') }}" alt="Adventure Image 1" class="img-fluid">
            <div class="dis-adventure__carousel-item-content">
              <div class="dis-adventure__carousel-item-top">
                <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Macca</div>
              </div>
              <div class="dis-adventure__carousel-item-bottom">
                <h6>4 Days in Aseer: A Cultural and Scenic Escape Through Nature...</h6>
                <div class="dis-adventure__carousel-item-footer">
                  <p class="dis-adventure__carousel-riyal"><img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1500</p>
                  <a class="btn btn-outline-light rounded-pill">Book Now</a>
                </div>
              </div>
            </div>
          </div>
          <div class="dis-adventure__carousel-item swiper-slide">
            <img src="{{ asset('frontend/assets/adventure1.png') }}" alt="Adventure Image 1" class="img-fluid">
            <div class="dis-adventure__carousel-item-content">
              <div class="dis-adventure__carousel-item-top">
                <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Macca</div>
              </div>
              <div class="dis-adventure__carousel-item-bottom">
                <h6>4 Days in Aseer: A Cultural and Scenic Escape Through Nature...</h6>
                <div class="dis-adventure__carousel-item-footer">
                  <p class="dis-adventure__carousel-riyal"><img src="{{ ('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1500</p>
                  <a class="btn btn-outline-light rounded-pill">Book Now</a>
                </div>
              </div>
            </div>
          </div>
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
            <img src="{{ asset('frontend/assets/explore-saudi.png') }}" alt="Explore Saudi" class="explore-saudi__image">
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
                  aria-controls="explore-saudi__makkah-tab-content" aria-selected="false">Makkah Region</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="explore-saudi__madinah-tab" data-bs-toggle="pill"
                  data-bs-target="#explore-saudi__madinah-tab-content" type="button" role="tab"
                  aria-controls="explore-saudi__madinah-tab-content" aria-selected="false">Al Madinah Region</button>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="explore-saudi__riyad-tab-content" role="tabpanel"
                aria-labelledby="explore-saudi__riyad-tab">
                <div class="explore-saudi__tab-content">
                  <div class="explore-saudi__tab-content-map">
                    <img src="{{ asset('frontend/assets/explore-riyad-map.png') }}" alt="Explore Riyad" class="img-fluid explore-saudi__map">
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
                aria-labelledby="explore-saudi__makkah-tab">...
              </div>
              <div class="tab-pane fade" id="explore-saudi__madinah-tab-content" role="tabpanel"
                aria-labelledby="explore-saudi__madinah-tab">...
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
              <img src="{{ asset('frontend/assets/exclusive-offer.png') }}" alt="Exclusive Offer" class="img-fluid">
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
                    <img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                    <p class="fw-bold text-dark">40,000</p> /Person
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center gap-1 text-muted">
                    <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                    8,332
                  </div>
                  <p class="text-muted small">Total Price: <img class="opacity-50" src="../assets/icons/riyal.svg"
                      alt="Riyal"> 1,22,100</p>
                </div>
              </div>
            </div>
          </div>
          <div class="exclusive-offers__carousel-item swiper-slide">
            <div class="exclusive-offers__carousel-item-img">
              <img src="{{ asset('frontend/assets/exclusive-offer.png') }}" alt="Exclusive Offer" class="img-fluid">
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
                    <img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                    <p class="p-large fw-bold text-dark">40,000</p> /Person
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center gap-1 text-muted">
                    <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                    8,332
                  </div>
                  <p class="text-muted small">Total Price: <img class="opacity-50" src="{{ ('frontend/assets/icons/riyal.svg') }}"
                      alt="Riyal"> 1,22,100</p>
                </div>
              </div>
            </div>
          </div>
          <div class="exclusive-offers__carousel-item swiper-slide">
            <div class="exclusive-offers__carousel-item-img">
              <img src="{{ asset('frontend/assets/exclusive-offer.png') }}" alt="Exclusive Offer" class="img-fluid">
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
                    <img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                    <p class="p-large fw-bold text-dark">40,000</p> /Person
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center gap-1 text-muted">
                    <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                    8,332
                  </div>
                  <p class="text-muted small">Total Price: <img class="opacity-50" src="{{ ('frontend/assets/icons/riyal.svg') }}"
                      alt="Riyal"> 1,22,100</p>
                </div>
              </div>
            </div>
          </div>
          <div class="exclusive-offers__carousel-item swiper-slide">
            <div class="exclusive-offers__carousel-item-img">
              <img src="{{ asset('frontend/assets/exclusive-offer.png') }}" alt="Exclusive Offer" class="img-fluid">
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
                    <img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                    <p class="p-large fw-bold text-dark">40,000</p> /Person
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center gap-1 text-muted">
                    <img class="opacity-50" src="{{ ('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                    8,332
                  </div>
                  <p class="text-muted small">Total Price: <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}"
                      alt="Riyal"> 1,22,100</p>
                </div>
              </div>
            </div>
          </div>
          <div class="exclusive-offers__carousel-item swiper-slide">
            <div class="exclusive-offers__carousel-item-img">
              <img src="{{ asset('frontend/assets/exclusive-offer.png') }}" alt="Exclusive Offer" class="img-fluid">
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
                    <img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                    <p class="p-large fw-bold text-dark">40,000</p> /Person
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center gap-1 text-muted">
                    <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                    8,332
                  </div>
                  <p class="text-muted small">Total Price: <img class="opacity-50" src="{{ ('frontend/assets/icons/riyal.svg') }}"
                      alt="Riyal"> 1,22,100</p>
                </div>
              </div>
            </div>
          </div>
          <div class="exclusive-offers__carousel-item swiper-slide">
            <div class="exclusive-offers__carousel-item-img">
              <img src="{{ asset('frontend/assets/exclusive-offer.png') }}" alt="Exclusive Offer" class="img-fluid">
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
                    <img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                    <p class="p-large fw-bold text-dark">40,000</p> /Person
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center gap-1 text-muted">
                    <img class="opacity-50" src="../assets/icons/riyal.svg" alt="Riyal">
                    8,332
                  </div>
                  <p class="text-muted small">Total Price: <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}"
                      alt="Riyal"> 1,22,100</p>
                </div>
              </div>
            </div>
          </div>
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
              <img src="{{ asset('frontend/assets/event-1.png') }}" alt="Event" class="img-fluid">
              <div class="upcoming-event__carousel-item-dates">
                <p>25 Aug 2025</p>
                <div class="vertical-divider"></div>
                <p>28 Aug 2025</p>
              </div>
            </div>
            <div class="upcoming-event__carousel-item-info">
              <button class="btn btn-primary rounded-pill btn-sm gap-1"><i class="fa-solid fa-location-dot"></i> Riyadh
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
              <img src="{{ asset('frontend/assets/event-1.png') }}" alt="Event" class="img-fluid">
              <div class="upcoming-event__carousel-item-dates">
                <p>25 Aug 2025</p>
                <div class="vertical-divider"></div>
                <p>28 Aug 2025</p>
              </div>
            </div>
            <div class="upcoming-event__carousel-item-info">
              <button class="btn btn-primary rounded-pill btn-sm gap-1"><i class="fa-solid fa-location-dot"></i> Riyadh
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
              <img src="{{ asset('frontend/assets/event-1.png') }}" alt="Event" class="img-fluid">
              <div class="upcoming-event__carousel-item-dates">
                <p>25 Aug 2025</p>
                <div class="vertical-divider"></div>
                <p>28 Aug 2025</p>
              </div>
            </div>
            <div class="upcoming-event__carousel-item-info">
              <button class="btn btn-primary rounded-pill btn-sm gap-1"><i class="fa-solid fa-location-dot"></i> Riyadh
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
              <img src="{{ asset('frontend/assets/event-1.png') }}" alt="Event" class="img-fluid">
              <div class="upcoming-event__carousel-item-dates">
                <p>25 Aug 2025</p>
                <div class="vertical-divider"></div>
                <p>28 Aug 2025</p>
              </div>
            </div>
            <div class="upcoming-event__carousel-item-info">
              <button class="btn btn-primary rounded-pill btn-sm gap-1"><i class="fa-solid fa-location-dot"></i> Riyadh
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
              <img src="{{ asset('frontend/assets/event-1.png') }}" alt="Event" class="img-fluid">
              <div class="upcoming-event__carousel-item-dates">
                <p>25 Aug 2025</p>
                <div class="vertical-divider"></div>
                <p>28 Aug 2025</p>
              </div>
            </div>
            <div class="upcoming-event__carousel-item-info">
              <button class="btn btn-primary rounded-pill btn-sm gap-1"><i class="fa-solid fa-location-dot"></i> Riyadh
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
              <img src="{{ asset('frontend/assets/event-1.png') }}" alt="Event" class="img-fluid">
              <div class="upcoming-event__carousel-item-dates">
                <p>25 Aug 2025</p>
                <div class="vertical-divider"></div>
                <p>28 Aug 2025</p>
              </div>
            </div>
            <div class="upcoming-event__carousel-item-info">
              <button class="btn btn-primary rounded-pill btn-sm gap-1"><i class="fa-solid fa-location-dot"></i> Riyadh
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
            <img src="{{ asset('frontend/assets/know-saudi.png') }} " class="img-fluid" alt="About Saudi">
            <div class="card-body d-flex flex-column gap-1 justify-content-center p-0">
              <h5 class="fw-bold">About Saudi</h5>
              <a href="#" class="primary-text fw-semibold p-large">Learn More</a>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
          <div class="know-before-card border-0 shadow-sm h-100 d-flex gap-3">
            <img src="{{ asset('frontend/assets/know-saudi.png') }}" class="img-fluid" alt="About Saudi">
            <div class="card-body d-flex flex-column gap-1 justify-content-center p-0">
              <h5 class="fw-bold">About Saudi</h5>
              <a href="#" class="primary-text fw-semibold p-large">Learn More</a>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
          <div class="know-before-card border-0 shadow-sm h-100 d-flex gap-3">
            <img src="{{ asset('frontend/assets/know-saudi.png') }}" class="img-fluid" alt="About Saudi">
            <div class="card-body d-flex flex-column gap-1 justify-content-center p-0">
              <h5 class="fw-bold">About Saudi</h5>
              <a href="#" class="primary-text fw-semibold p-large">Learn More</a>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
          <div class="know-before-card border-0 shadow-sm h-100 d-flex gap-3">
            <img src="{{ asset('frontend/assets/know-saudi.png') }}" class="img-fluid" alt="About Saudi">
            <div class="card-body d-flex flex-column gap-1 justify-content-center p-0">
              <h5 class="fw-bold">About Saudi</h5>
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
                  <img src="{{ asset('frontend/assets/news-event.png') }}" alt="News" class="img-fluid">
                  <div class="news-event__carousel-item-info">
                    <div class="small news-event__carousel-item-date mb-2">
                      <i class="fa-solid fa-calendar"></i>
                      Nov 28 | 15:30
                    </div>
                    <h6>Event Ideas that Celebrate Culture, Community...</h6>
                  </div>
                </div>
                <div class="news-event__carousel-item swiper-slide">
                  <img src="{{ asset('frontend/assets/news-event.png') }}" alt="News" class="img-fluid">
                  <div class="news-event__carousel-item-info">
                    <div class="small news-event__carousel-item-date mb-2">
                      <i class="fa-solid fa-calendar"></i>
                      Nov 28 | 15:30
                    </div>
                    <h6>Event Ideas that Celebrate Culture, Community...</h6>
                  </div>
                </div>
                <div class="news-event__carousel-item swiper-slide">
                  <img src="{{ asset('frontend/assets/news-event.png') }}" alt="News" class="img-fluid">
                  <div class="news-event__carousel-item-info">
                    <div class="small news-event__carousel-item-date mb-2">
                      <i class="fa-solid fa-calendar"></i>
                      Nov 28 | 15:30
                    </div>
                    <h6>Event Ideas that Celebrate Culture, Community...</h6>
                  </div>
                </div>
                <div class="news-event__carousel-item swiper-slide">
                  <img src="{{ asset('frontend/assets/news-event.png') }}" alt="News" class="img-fluid">
                  <div class="news-event__carousel-item-info">
                    <div class="small news-event__carousel-item-date mb-2">
                      <i class="fa-solid fa-calendar"></i>
                      Nov 28 | 15:30
                    </div>
                    <h6>Event Ideas that Celebrate Culture, Community...</h6>
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