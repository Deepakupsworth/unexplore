@extends('frontend.layout')
@section('content')
    <!-- 1. THING TO DO NATURE: BANNER SECTION  -->
    <section class="hero-banner hero-banner-fullscreen">
        <video class="hero-banner__video" autoplay muted loop playsinline poster="../assets/hero-banner-bg.png">
            <source src="{{ asset('frontend/assets/videos/seekers-entry-video.mp4')}}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <!-- <img class="hero-banner__image" src="../assets/hero-banner-bg.png" alt="Banner"> -->
        <div class="container">
            <div class="dest-details-banner__content">
                <h1 class="text-white">Discover Elite <strong>Golf Experiences</strong></h1>
                <img src="{{ asset('frontend/assets/hero-banner-vision.png')}}" alt="Vision 2030"
                    class="dest-details-banner__vision d-none-sm d-none-md">
            </div>
        </div>
    </section>

    <!-- Golf Locations -->
    <section class="section-padding-md">
        <div class="container">
            <div class="golf-locations__carousel swiper">
                <div class="swiper-wrapper">
                    <div class="golf-locations__item swiper-slide">
                        <img class="img-fluid" src="{{ asset('frontend/assets/contact-office1.png')}}" alt="Golf">
                        <div class="golf-locations__item-content">
                            <p class="p-large fw-600">Algarve Golf Club</p>
                            <p class="p-small">Portugal, Europe</p>
                        </div>
                    </div>
                    <div class="golf-locations__item swiper-slide">
                        <img class="img-fluid" src="{{ asset('frontend/assets/contact-office1.png')}}" alt="Golf">
                        <div class="golf-locations__item-content">
                            <p class="p-large fw-600">Costa del Sol Golf Club</p>
                            <p class="p-small">Bali, Asia</p>
                        </div>
                    </div>
                    <div class="golf-locations__item swiper-slide">
                        <img class="img-fluid" src="{{ asset('frontend/assets/contact-office1.png')}}" alt="Golf">
                        <div class="golf-locations__item-content">
                            <p class="p-large fw-600">Emirates Golf Club</p>
                            <p class="p-small">Dubai, UAE</p>
                        </div>
                    </div>
                    <div class="golf-locations__item swiper-slide">
                        <img class="img-fluid" src="{{ asset('frontend/assets/contact-office1.png')}}" alt="Golf">
                        <div class="golf-locations__item-content">
                            <p class="p-large fw-600">Emirates Golf Club</p>
                            <p class="p-small">Arizona, USA</p>
                        </div>
                    </div>
                    <div class="golf-locations__item swiper-slide">
                        <img class="img-fluid" src="{{ asset('frontend/assets/contact-office1.png')}}" alt="Golf">
                        <div class="golf-locations__item-content">
                            <p class="p-large fw-600">Emirates Golf Club</p>
                            <p class="p-small">Dubai, UAE</p>
                        </div>
                    </div>
                </div>
                <div class="custom__carousel-pagination golf-locations__carousel-pagination"></div>
            </div>
        </div>
    </section>

    <section class="golf-booking-cta section-padding">
        <div class="container">
            <div class="golf-booking-cta__content">
                <h2 class="section__heading mb-3 h1 fw-bold">Ready to Tee Off?</h2>
                <p class="section__description mb-4">Book your exclusive golf experience with us today and
                    enjoy
                    unparalleled service and unforgettable moments on the greens.</p>
                <a href="#" class="btn btn-primary rounded-pill w-fit btn-lg">
                    Book Now
                    <i class="fa-solid fa-angles-right"></i>
                </a>
            </div>
        </div>
    </section>

    <section class="news-event section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-3 d-flex align-items-center">
                    <div class="section__header flex-column align-items-start gap-4">
                        <div class="section__header-content">
                            <h2 class="section__heading">Latest News</h2>
                            <p class="section__description">Discover inspiring travel stories and valuable insights from
                                across Saudi
                                Arabia.</p>
                        </div>
                        <div class="section__header-CTA">
                            <a href="#" class="btn btn-primary rounded-pill">
                                View All
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="news-event__carousel-container">
                        <div class="news-event__carousel-prev">
                            <i class="fa-solid fa-arrow-left"></i>
                        </div>
                        <div class="news-event__carousel swiper">
                            <div class="news-event__carousel-wrapper swiper-wrapper">
                                <div class="news-event__carousel-item swiper-slide">
                                    <img src="{{ asset('frontend/assets/golf.webp')}}" alt="News" class="img-fluid">
                                    <div class="news-event__carousel-item-info">
                                        <div class="small news-event__carousel-item-date mb-2">
                                            <i class="fa-solid fa-calendar"></i>
                                            Nov 28 | 15:30
                                        </div>
                                        <h6>Event Ideas that Celebrate Culture, Community...</h6>
                                    </div>
                                </div>
                                <div class="news-event__carousel-item swiper-slide">
                                    <img src="{{ asset('frontend/assets/golf.webp')}}" alt="News" class="img-fluid">
                                    <div class="news-event__carousel-item-info">
                                        <div class="small news-event__carousel-item-date mb-2">
                                            <i class="fa-solid fa-calendar"></i>
                                            Nov 28 | 15:30
                                        </div>
                                        <h6>Event Ideas that Celebrate Culture, Community...</h6>
                                    </div>
                                </div>
                                <div class="news-event__carousel-item swiper-slide">
                                    <img src="{{ asset('frontend/assets/golf.webp')}}" alt="News" class="img-fluid">
                                    <div class="news-event__carousel-item-info">
                                        <div class="small news-event__carousel-item-date mb-2">
                                            <i class="fa-solid fa-calendar"></i>
                                            Nov 28 | 15:30
                                        </div>
                                        <h6>Event Ideas that Celebrate Culture, Community...</h6>
                                    </div>
                                </div>
                                <div class="news-event__carousel-item swiper-slide">
                                    <img src="{{ asset('frontend/assets/golf.webp')}}" alt="News" class="img-fluid">
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

    <section class="golf-highlights section-padding-md">
        <div class="container">
            <div class="section__header align-items-start gap-4 mb-4">
                <div class="section__header-content">
                    <h2 class="section__heading">Photos: LIV Golf 2025</h2>
                    <p class="section__description">Discover inspiring travel stories and valuable insights from across
                        Saudi</p>
                </div>
                <!-- <div class="section__header-CTA">
                    <a href="#" class="btn btn-primary rounded-pill">
                        View All
                        <i class="fa-solid fa-angles-right"></i>
                    </a>
                </div> -->
            </div>
            <div class="golf-highlights__carousel swiper">
                <div class="swiper-wrapper">
                    <div class="golf-highlights__item swiper-slide">
                        <img class="img-fluid" src=".{{ asset('frontend/assets/golf-highlight.webp')}}" alt="Highlight">
                        <div class="golf-highlights__item-content">
                            <div class="badge carousel-badge">Macca</div>
                            <p class="p-large mt-2 fw-600">Photos: Ryder Cup Day 3</p>
                        </div>
                    </div>
                    <div class="golf-highlights__item swiper-slide">
                        <img class="img-fluid" src="{{ asset('frontend/assets/golf-highlight.webp')}}" alt="Highlight">
                        <div class="golf-highlights__item-content">
                            <div class="badge carousel-badge">Macca</div>
                            <p class="p-large mt-2 fw-600">Photos: LIV Golf Michigan Team Championship, Finals</p>
                        </div>
                    </div>
                    <div class="golf-highlights__item swiper-slide">
                        <img class="img-fluid" src="{{ asset('frontend/assets/golf-highlight.webp')}}" alt="Highlight">
                        <div class="golf-highlights__item-content">
                            <div class="badge carousel-badge">Macca</div>
                            <p class="p-large mt-2 fw-600">LIV Golf Indianapolis 2025 Celebrity Guests </p>
                        </div>
                    </div>
                    <div class="golf-highlights__item swiper-slide">
                        <img class="img-fluid" src="{{ asset('frontend/assets/golf-highlight.webp')}}" alt="Highlight">
                        <div class="golf-highlights__item-content">
                            <div class="badge carousel-badge">Macca</div>
                            <p class="p-large mt-2 fw-600">Photos: 2025 Individual Championship ring</p>
                        </div>
                    </div>
                    <div class="golf-highlights__item swiper-slide">
                        <img class="img-fluid" src="{{ asset('frontend/assets/golf-highlight.webp')}}" alt="Highlight">
                        <div class="golf-highlights__item-content">
                            <div class="badge carousel-badge">Macca</div>
                            <p class="p-large mt-2 fw-600">Photos: LIV Golf Chicago, Rd. 3</p>
                        </div>
                    </div>
                </div>
                <div class="custom__carousel-pagination golf-highlights__carousel-pagination"></div>
            </div>
        </div>
    </section>

    <section class="gold-usp section-padding-md">
        <div class="container">
            <div class="section__header align-items-start gap-4 mb-4 justify-content-center">
                <div class="section__header-content text-center">
                    <h4 class="section__heading mb-2">We're always going the extra yard for golfers.</h4>
                    <p class="section__description">Discover inspiring travel stories and valuable insights from across
                        Saudi</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="golf-usp__item text-center p-2">
                        <img src="{{ asset('frontend/assets/icons/golf-usp-1.svg')}}" alt="USP" class="mb-3">
                        <p class="p-large fw-600 my-2 text-light2">Dedicated Golf Experts</p>
                        <p class="p-small text-light2">Unrivalled golf travel expertise on over 3500 destinations in 24
                            countries.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="golf-usp__item text-center p-2">
                        <img src="{{ asset('frontend/assets/icons/golf-usp-2.svg')}}" alt="USP" class="mb-3">
                        <p class="p-large fw-600 my-2 text-light2">Value You Can Trust</p>
                        <p class="p-small text-light2">Unrivalled golf travel expertise on over 3500 destinations in 24
                            countries.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="golf-usp__item text-center p-2">
                        <img src="{{ asset('frontend/assets/icons/golf-usp-3.svg')}}" alt="USP" class="mb-3">
                        <p class="p-large fw-600 my-2 text-light2">Personalised Service</p>
                        <p class="p-small text-light2">Unrivalled golf travel expertise on over 3500 destinations in 24
                            countries.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="golf-usp__item text-center p-2">
                        <img src="{{ asset('frontend/assets/icons/golf-usp-1.svg')}}" alt="USP" class="mb-3">
                        <p class="p-large fw-600 my-2 text-light2">Best in Industry Protection</p>
                        <p class="p-small text-light2">Unrivalled golf travel expertise on over 3500 destinations in 24
                            countries.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
