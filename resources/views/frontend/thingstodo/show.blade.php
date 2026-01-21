@extends('frontend.layout')
@section('content')

  <!-- 1. THING TO DO NATURE: BANNER SECTION  -->
  <section class="hero-banner hero-banner-fullscreen">
    <video class="hero-banner__video" autoplay muted loop playsinline poster="{{ asset('frontend/assets/hero-banner-bg.png') }}">
      <source src="{{ asset('frontend/assets/videos/seekers-entry-video.mp4') }}" type="video/mp4">
      Your browser does not support the video tag.
    </video>
    <!-- <img class="hero-banner__image" src="../assets/hero-banner-bg.png" alt="Banner"> -->
    <div class="container">
      <div class="dest-details-banner__content">
        <h1 class="text-white"><strong>{{ $things_to_doss ['region'] ?? '' }}</strong> Reserve</h1> 
        <img src="{{ asset('frontend/assets/hero-banner-vision.png') }}" alt="Vision 2030"
          class="dest-details-banner__vision d-none-sm d-none-md">
        <div class="dest-details-banner__btn-group">
          <button class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#galleryModal">See Images</button>
        </div>
      </div>
    </div>
  </section>

  <!-- 2. THING TO DO NATURE: DESCRIPTION -->
  <section class="section-padding things-to-do-nature__details">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="section__header mb-5">
            <div class="section__header-content">
              <h2 class="section__heading">{{ $things_to_doss ['about_section'] ['heading'] ?? '' }} </h2>
              <p class="section__description"> {{ $things_to_doss['about_section'] ['description'] ?? '' }}  </p>
              
            </div>
          </div>
          <div class="section__header mb-5">
            <div class="section__header-content">
              <h4 class="section__heading primary-text">{{ $things_to_doss ['nature_beauty'] ['heading'] ?? '' }}</h4>
              <p class="section__description">{{ $things_to_doss['nature_beauty'] ['description'] ?? '' }} </p>
            </div>
          </div>
          <div class="section__header">
            <div class="section__header-content">
              <h4 class="section__heading primary-text">{{ $things_to_doss ['facilities_and_services'] ['heading'] ?? '' }}</h4> 
              <p class="section__description">{{ $things_to_doss ['facilities_and_services'] ['description'] ?? '' }}</p> 
              <ul>
                @foreach($things_to_doss ['facilities_and_services'] ['facilities'] as $facility)
                  <li>{{ $facility }}</li>
                @endforeach
               
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="event-map__info-card rounded-5 mb-3">
            <h6 class="fw-600 p-large mb-2">Information</h6>

            <div class="event-map__info-card-row flex-v-center rounded-4 gap-1 mb-3">
              <div class="icon primary-text flex-center"><i class="fa-solid fa-location-dot"></i></div>
              <div>
                <p class="text-light2 p-small">Location:</p>
                <p class="p-large fw-600">{{ $things_to_doss['information'] ['location'] ?? '' }}</p>
              </div>
            </div>

            <div class="event-map__info-card-row flex-v-center rounded-4 gap-1 mb-3">
              <div class="icon primary-text flex-center"><i class="fa-solid fa-cake-candles"></i></div>
              <div>
                <p class="text-light2 p-small">Ages:</p>
                <p class="p-large fw-600">{{ $things_to_doss['information'] ['ages'] ?? '' }}</p>
              </div>
            </div>

            <div class="event-map__info-card-row flex-v-center rounded-4 gap-1">
              <div class="icon primary-text flex-center"><i class="fa-regular fa-clock"></i></div>
              <div>
                <p class="text-light2 p-small">Time:</p>
                <p class="p-large fw-600">{{ $things_to_doss['information'] ['time'] ?? '' }}</p>
              </div>
            </div>
          </div>
          <div class="event-map__card position-relative">
            <!-- use uploaded image path as src -->
            <img class="rounded-5 img-fluid" src="{{ asset('frontend/assets/map.png') }}" alt="Map">

            <!-- Get Directions button -->
            <button class="event-map__card-btn btn btn-primary rounded-pill py-2 px-3">
              Get Directions
              <i class="fa-solid fa-angles-right"></i>
            </button>
          </div>
          <div class="event-map__info-card">
            <p class="fw-500">Share</p>
            <div class="d-flex gap-3 mt-2">
              <a href="#" class="social-icon">
                <img src="{{ asset('frontend/assets/icons/instagram.svg') }}" alt="">
              </a>
              <a href="#" class="social-icon">
                <img src="{{ asset('frontend/assets/icons/facebook.svg') }}" alt="">
              </a>
              <a href="#" class="social-icon">
                <img src="{{ asset('frontend/assets/icons/x.svg') }}" alt="">
              </a>
              <a href="#" class="social-icon">
                <img src="{{ asset('frontend/assets/icons/share.svg') }}" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. THING TO DO NATURE: CONTENT -->
  <section class="py-3 things-to-do-nature__about">
    <div class="container">
      <div class="things-to-do-nature__about-content">
        <div class="row gy-3">
          <div class="col-lg-5">
            <div class="things-to-do-nature__about-img-wrapper">
           
            
            <img class="img-fluid things-to-do-nature__about-img" src="{{ asset($things_to_doss['about_blocks']['image']) }}" alt="">
    
            
              <img class="things-to-do-nature__about-img-strip" src="{{ asset('frontend/assets/vertical-strip.png') }}" alt="">
            </div>
          </div>
          <div class="col-lg-7">
            <div class="things-to-do-nature__about-text">
              <div class="section__header">
                <div class="section__header-content gap-3">
                  <h3 class="section__heading">{{ $things_to_doss['about_blocks'] ['title'] ?? '' }} </h3>
                  <ul>
                  @foreach($things_to_doss['about_blocks']['points'] as $block)
                  <li>{{ $block}}</li>
                @endforeach
                    
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. THING TO DO NATURE: CONTENT -->
  <section class="py-3 things-to-do-nature__about">
    <div class="container">
      <div class="things-to-do-nature__about-content">
        <div class="row">
          <div class="col-lg-7">
            <div class="things-to-do-nature__about-text">
              <div class="section__header">
                <div class="section__header-content gap-3">
                  <h3 class="section__heading">{{ $things_to_doss['additional_blocks'] ['title'] ?? '' }}</h3>
                  <ul>
                  @foreach($things_to_doss['additional_blocks']['points'] as $block)
                  <li>{{ $block}}</li>
                @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="things-to-do-nature__about-img-wrapper">
              <img class="img-fluid things-to-do-nature__about-img" src="{{ asset($things_to_doss['additional_blocks']['image']) }}" alt="">
              <img class="things-to-do-nature__about-img-strip right" src="{{ asset('frontend/assets/vertical-strip.png') }}" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. THING TO DO NATURE: NATURE ADVENTURE -->
  <section class="section-padding-md">
    <div class="container">
      <div class="things-to-do-nature__adventure-wrapper">
        <div class="section__header flex-column align-items-start gap-4">
          <div class="section__header-content">
            <h2 class="section__heading text-white">Take on your own nature adventure</h2>
            <p class="section__description text-white">Embark on unforgettable journeys and explore the hidden gems
              across the heart of Saudi Arabia</p>
          </div>
          <div class="section__header-CTA">
            <a href="#" class="btn btn-primary rounded-pill btn-lg">
              Plan your adventure
              <i class="fa-solid fa-angles-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 6. THING TO DO NATURE: SIMILAR TO DO THINGS -->
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
            <img src="{{ asset('frontend/assets/destinations/yanbu/4.jpg') }}" alt="Adventure Image 1" class="img-fluid">
            <div class="dis-adventure__carousel-item-content">
              <div class="dis-adventure__carousel-item-top">
                <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Yanbu</div>
              </div>
              <div class="dis-adventure__carousel-item-bottom">
                <h6>4 Days in Yanbu: A Cultural and Scenic Escape Through Nature...</h6>
                <div class="dis-adventure__carousel-item-footer">
                  <a class="btn btn-outline-light rounded-pill">Related packages (20)</a>
                </div>
              </div>
            </div>
          </div>
          <div class="dis-adventure__carousel-item swiper-slide">
            <img src="{{ asset('frontend/assets/destinations/tabuk/2.jpg') }}" alt="Adventure Image 1" class="img-fluid">
            <div class="dis-adventure__carousel-item-content">
              <div class="dis-adventure__carousel-item-top">
                <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Tabuk</div>
              </div>
              <div class="dis-adventure__carousel-item-bottom">
                <h6>4 Days in Tabuk: A Cultural and Scenic Escape Through Nature...</h6>
                <div class="dis-adventure__carousel-item-footer">
                  <a class="btn btn-outline-light rounded-pill">Related packages (20)</a>
                </div>
              </div>
            </div>
          </div>
          <div class="dis-adventure__carousel-item swiper-slide">
            <img src="{{ asset('frontend/assets/destinations/qassim/3.jpg') }}" alt="Adventure Image 1" class="img-fluid">
            <div class="dis-adventure__carousel-item-content">
              <div class="dis-adventure__carousel-item-top">
                <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Qassim</div>
              </div>
              <div class="dis-adventure__carousel-item-bottom">
                <h6>4 Days in Qassim: A Cultural and Scenic Escape Through Nature...</h6>
                <div class="dis-adventure__carousel-item-footer">
                  <a class="btn btn-outline-light rounded-pill">Related packages (20)</a>
                </div>
              </div>
            </div>
          </div>
          <div class="dis-adventure__carousel-item swiper-slide">
            <img src="{{ asset('frontend/assets/destinations/najran/1.jpg') }}" alt="Adventure Image 1" class="img-fluid">
            <div class="dis-adventure__carousel-item-content">
              <div class="dis-adventure__carousel-item-top">
                <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Najran</div>
              </div>
              <div class="dis-adventure__carousel-item-bottom">
                <h6>4 Days in Najran: A Cultural and Scenic Escape Through Nature...</h6>
                <div class="dis-adventure__carousel-item-footer">
                  <a class="btn btn-outline-light rounded-pill">Related packages (20)</a>
                </div>
              </div>
            </div>
          </div>
          <div class="dis-adventure__carousel-item swiper-slide">
            <img src="{{ asset('frontend/assets/destinations/hail/5.jpg') }}" alt="Adventure Image 1" class="img-fluid">
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
            <img src="{{ asset('frontend/assets/destinations/asser/2.jpg') }}" alt="Adventure Image 1" class="img-fluid">
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
        </div>
        <div class="custom__carousel-pagination"></div>
      </div>
    </div>
  </section>

  <!-- 7. THING TO DO NATURE: RELATED PACKAGES -->
  <section class="upcoming-event section-padding-md">
    <div class="container">
      <div class="section__header">
        <div class="section__header-content">
          <h2 class="section__heading">Related Packages</h2>
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
              <img src="{{ asset('frontend/assets/things_to_do/upcoming_events/riyadh_session.jpg') }}" alt="Event" class="img-fluid">
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
                <h5 class="fw-bold">4 Days in Riyadh</h5>
                <a href="#" class="p-large">
                  <i class="fa-solid fa-arrow-right-long primary-text"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="upcoming-event__carousel-item swiper-slide">
            <div class="upcoming-event__carousel-item-img">
              <img src="{{ asset('frontend/assets/things_to_do/upcoming_events/diriyah_season.jpg') }}" alt="Event" class="img-fluid">
              <div class="upcoming-event__carousel-item-dates">
                <p>25 Aug 2025</p>
                <div class="vertical-divider"></div>
                <p>28 Aug 2025</p>
              </div>
            </div>
            <div class="upcoming-event__carousel-item-info">
              <button class="btn btn-primary rounded-pill btn-sm gap-1"><i class="fa-solid fa-location-dot"></i> Diriyah
                | Business Events</button>
              <div class="d-flex justify-content-between mt-3">
                <h5 class="fw-bold">4 Days in Diriyah</h5>
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
              <img src="{{ asset('frontend/assets/things_to_do/event_s/red_sea_international_film_festival_in_jeddah.jpg') }}" alt="Event" class="img-fluid">
              <div class="upcoming-event__carousel-item-dates">
                <p>25 Aug 2025</p>
                <div class="vertical-divider"></div>
                <p>28 Aug 2025</p>
              </div>
            </div>
            <div class="upcoming-event__carousel-item-info">
              <button class="btn btn-primary rounded-pill btn-sm gap-1"><i class="fa-solid fa-location-dot"></i> Jeddah
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
              <img src="{{ asset('frontend/assets/things_to_do/event_s/Saudi_National_Day_in_Nationwide.jpg') }}" alt="Event" class="img-fluid">
              <div class="upcoming-event__carousel-item-dates">
                <p>25 Aug 2025</p>
                <div class="vertical-divider"></div>
                <p>28 Aug 2025</p>
              </div>
            </div>
            <div class="upcoming-event__carousel-item-info">
              <button class="btn btn-primary rounded-pill btn-sm gap-1"><i class="fa-solid fa-location-dot"></i> Nationwide
                | Business Events</button>
              <div class="d-flex justify-content-between mt-3">
                <h5 class="fw-bold">4 Days Nationwide</h5>
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

  <div class="modal fade gallery-modal" id="galleryModal" tabindex="-1" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content bg-transparent border-0">

        <!-- Close Button -->
        <button type="button" class="btn-close gallery-close" data-bs-dismiss="modal"></button>

        <div class="pkg-details__banner gallery-modal-parent-carousel-wrapper swiper m-0 p-0">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img src="../assets/package-details-banner.png" alt="Package Details Banner 1" class="img-fluid w-100">
            </div>
            <div class="swiper-slide">
              <img src="../assets/package-banner.png" alt="Package Details Banner 1" class="img-fluid w-100">
            </div>
            <div class="swiper-slide">
              <img src="../assets/about-saudi.png" alt="Package Details Banner 1" class="img-fluid w-100">
            </div>
            <div class="swiper-slide">
              <img src="../assets/adventure1.png" alt="Package Details Banner 1" class="img-fluid w-100">
            </div>
            <div class="swiper-slide">
              <img src="../assets/destination-banner-item.png" alt="Package Details Banner 1" class="img-fluid w-100">
            </div>
            <div class="swiper-slide">
              <img src="../assets/exclusive-offer.png" alt="Package Details Banner 1" class="img-fluid w-100">
            </div>
            <div class="swiper-slide">
              <img src="../assets/explore-destination1.png" alt="Package Details Banner 1" class="img-fluid w-100">
            </div>
          </div>
          <div class="gallery-swiper-pagination"></div>
        </div>
        <div class="position-relative mt-4 gallery-modal-carousel-container">
          <div class="gallery-modal-carousel-wrapper swiper">
            <div class="swiper-wrapper">
              <div class="pkg-details__banner-carousel-item swiper-slide">
                <img src="../assets/package-details-banner.png" alt="Package Details Banner 1" class="img-fluid w-100">
              </div>
              <div class="pkg-details__banner-carousel-item swiper-slide">
                <img src="../assets/package-banner.png" alt="Package Details Banner 2" class="img-fluid w-100">
              </div>
              <div class="pkg-details__banner-carousel-item swiper-slide">
                <img src="../assets/about-saudi.png" alt="Package Details Banner 3" class="img-fluid w-100">
              </div>
              <div class="pkg-details__banner-carousel-item swiper-slide">
                <img src="../assets/adventure1.png" alt="Package Details Banner 3" class="img-fluid w-100">
              </div>
              <div class="pkg-details__banner-carousel-item swiper-slide">
                <img src="../assets/destination-banner-item.png" alt="Package Details Banner 3" class="img-fluid w-100">
              </div>
              <div class="pkg-details__banner-carousel-item swiper-slide">
                <img src="../assets/exclusive-offer.png" alt="Package Details Banner 3" class="img-fluid w-100">
              </div>
              <div class="pkg-details__banner-carousel-item swiper-slide">
                <img src="../assets/explore-destination1.png" alt="Package Details Banner 3" class="img-fluid w-100">
              </div>
            </div>
          </div>
          <div class="swiper-button-next gallery-carousel__next">
            <i class="fa-solid fa-arrow-right"></i>
          </div>
          <div class="swiper-button-prev gallery-carousel__prev">
            <i class="fa-solid fa-arrow-left"></i>
          </div>
        </div>

        <!-- Main Image -->
        <!-- <div class="gallery-main">
          <img id="galleryMainImg" src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=1200"
            class="img-fluid">
        </div> -->

        <!-- Thumbnails + Arrows -->
        <!-- <div class="gallery-thumbs-wrapper">

          <button class="gallery-arrow" id="prevImg">&#10094;</button>

          <div class="gallery-thumbs">
            <img class="thumb active" src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=300">
            <img class="thumb" src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=300">
            <img class="thumb" src="https://images.unsplash.com/photo-1519681393784-d120267933ba?w=300">
            <img class="thumb" src="https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=300">
            <img class="thumb" src="https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=300">
          </div>

          <button class="gallery-arrow" id="nextImg">&#10095;</button>
        </div> -->

      </div>
    </div>
  </div>

  @endsection