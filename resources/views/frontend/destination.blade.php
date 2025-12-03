
@extends('frontend.layout')
@section('content')

    <!-- 1. DESTINATION BANNER SECTION  -->
    <section class="hero-banner dest-banner">
        <video class="hero-banner__video" autoplay muted loop playsinline poster="../assets/hero-banner-bg.png">
            <source src="{{ asset('frontend/assets/videos/seekers-entry-video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <!-- <img class="hero-banner__image" src="../assets/hero-banner-bg.png" alt="Banner"> -->
        <div class="container-fluid">
            <div class="dest-banner__carousel swiper">
                <div class="swiper-wrapper">
                    <div class="dest-banner__carousel-item swiper-slide">
                        <div class="position-relative">
                            <img src="{{ asset('frontend/assets/destinations/alula/2.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="dest-banner__carousel-item-content">
                            <p class="p-small">Nature, Culture & History, Beaut & Relax</p>
                            <div class="d-flex justify-content-between mt-1">
                                <h6 class="dest-banner__carousel-item-title">AlUla</h6>
                                <a href="#">Packages (20)</a>
                            </div>
                        </div>
                    </div>
                    <div class="dest-banner__carousel-item swiper-slide">
                        <div class="position-relative">
                            <img src="{{ asset('frontend/assets/destinations/jeddah/2.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="dest-banner__carousel-item-content">
                            <p class="p-small">Nature, Culture & History, Shopping </p>
                            <div class="d-flex justify-content-between mt-1">
                                <h6 class="dest-banner__carousel-item-title">Jeddah</h6>
                                <a href="#">Packages (20)</a>
                            </div>
                        </div>
                    </div>
                    <div class="dest-banner__carousel-item swiper-slide">
                        <div class="position-relative">
                            <img src="{{ asset('frontend/assets/destinations/ai-ahsa/4.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="dest-banner__carousel-item-content">
                            <p class="p-small">Nature, Culture & History, Shopping</p>
                            <div class="d-flex justify-content-between mt-1">
                                <h6 class="dest-banner__carousel-item-title">Al Ahsa</h6>
                                <a href="#">Packages (20)</a>
                            </div>
                        </div>
                    </div>
                    <div class="dest-banner__carousel-item swiper-slide">
                        <div class="position-relative">
                            <img src="{{ asset('frontend/assets/destinations/eastern_province/1.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="dest-banner__carousel-item-content">
                            <p class="p-small">Nature, Shopping, Culture & History</p>
                            <div class="d-flex justify-content-between mt-1">
                                <h6 class="dest-banner__carousel-item-title">Eastern Province</h6>
                                <a href="#">Packages (20)</a>
                            </div>
                        </div>
                    </div>
                    <div class="dest-banner__carousel-item swiper-slide">
                        <div class="position-relative">
                            <img src="{{ asset('frontend/assets/destinations/riyadh/2.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="dest-banner__carousel-item-content">
                            <p class="p-small">Culture & History, Nature, Shopping</p>
                            <div class="d-flex justify-content-between mt-1">
                                <h6 class="dest-banner__carousel-item-title">Riyadh</h6>
                                <a href="#">Packages (20)</a>
                            </div>
                        </div>
                    </div>
                    <div class="dest-banner__carousel-item swiper-slide">
                        <div class="position-relative">
                            <img src="{{ asset('frontend/assets/destinations/makkah/1.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="dest-banner__carousel-item-content">
                            <p class="p-small">Historic site, Shopping, Religious Site </p>
                            <div class="d-flex justify-content-between mt-1">
                                <h6 class="dest-banner__carousel-item-title">Makkah</h6>
                                <a href="#">Packages (20)</a>
                            </div>
                        </div>
                    </div>
                    <div class="dest-banner__carousel-item swiper-slide">
                        <div class="position-relative">
                            <img src="{{ asset('frontend/assets/destinations/madinah/2.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="dest-banner__carousel-item-content">
                            <p class="p-small">Culture & History, Nature, Adventure</p>
                            <div class="d-flex justify-content-between mt-1">
                                <h6 class="dest-banner__carousel-item-title">Madinah</h6>
                                <a href="#">Packages (20)</a>
                            </div>
                        </div>
                    </div>
                    <div class="dest-banner__carousel-item swiper-slide">
                        <div class="position-relative">
                            <img src="{{ asset('frontend/assets/destinations/kaec/5.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="dest-banner__carousel-item-content">
                            <p class="p-small">Sports, Entertainment, Nature</p>
                            <div class="d-flex justify-content-between mt-1">
                                <h6 class="dest-banner__carousel-item-title">KAEC</h6>
                                <a href="#">Packages (20)</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. EXPLORE DESTINATIONS -->
    <section class="explore-destinations section-padding">
        <div class="container">
            <div class="section__header">
                <div class="section__header-content">
                    <h2 class="section__heading">Explore More Destinations</h2>
                    <p class="section__description">Embark on unforgettable journeys and explore the hidden gems across the heart of Saudi Arabia</p>
                </div>
            </div>
            <div class="row gy-xl-5 gy-lg-3 gy-3 gx-4 explore-destinations__items">
                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset('frontend/assets/destinations/alula/1.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">Nature, Culture & History</p>
                                <h5 class="explore-destinations__item-description">AlUla</h5>
                            </div>
                            <button class="btn btn-outline-primary rounded-pill">Packages (20) <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset('frontend/assets/destinations/jeddah/2.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">Nature, Culture & History</p>
                                <h5 class="explore-destinations__item-description">Jeddah</h5>
                            </div>
                            <button class="btn btn-outline-primary rounded-pill">Packages (20) <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset('frontend/assets/destinations/riyadh/2.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">Culture & History, Nature</p>
                                <h5 class="explore-destinations__item-description">Riyadh</h5> 
                            </div>
                            <button class="btn btn-outline-primary rounded-pill">Packages (20) <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset('frontend/assets/destinations/asser/1.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">Nature, Culture & History</p>
                                <h5 class="explore-destinations__item-description">Aseer</h5>
                            </div>
                            <button class="btn btn-outline-primary rounded-pill">Packages (20) <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset('frontend/assets/destinations/ai-ahsa/4.jpg') }}" alt="Destination"> 
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">Nature, Culture & History</p>
                                <h5 class="explore-destinations__item-description">Al Ahsa</h5>
                            </div>
                            <button class="btn btn-outline-primary rounded-pill">Packages (20) <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset('frontend/assets/destinations/the_red_sea/1.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">Nature, Luxury</p>
                                <h5 class="explore-destinations__item-description">The Red Sea</h5>
                            </div>
                            <button class="btn btn-outline-primary rounded-pill">Packages (20) <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset('frontend/assets/destinations/kaec/2.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">Sports, Entertainment</p>
                                <h5 class="explore-destinations__item-description">KAEC</h5>
                            </div>
                            <button class="btn btn-outline-primary rounded-pill">Packages (20) <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset('frontend/assets/destinations/makkah/5.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">Historic site, Shopping</p>
                                <h5 class="explore-destinations__item-description">Makkah</h5>
                            </div>
                            <button class="btn btn-outline-primary rounded-pill">Packages (20) <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset('frontend/assets/destinations/madinah/2.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">Culture & History, Nature</p>
                                <h5 class="explore-destinations__item-description">Madinah</h5>
                            </div>
                            <button class="btn btn-outline-primary rounded-pill">Packages (20) <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset('frontend/assets/destinations/taif/1.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">Culture & History, Nature</p>
                                <h5 class="explore-destinations__item-description">Taif</h5>
                            </div>
                            <button class="btn btn-outline-primary rounded-pill">Packages (20) <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset('frontend/assets/destinations/eastern_province/1.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">Nature</p>
                                <h5 class="explore-destinations__item-description">Eastern Province</h5>
                            </div>
                            <button class="btn btn-outline-primary rounded-pill">Packages (20) <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset('frontend/assets/destinations/diriyah/2.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">Culture & History</p>
                                <h5 class="explore-destinations__item-description">Diriyah</h5>
                            </div>
                            <button class="btn btn-outline-primary rounded-pill">Packages (20) <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset('frontend/assets/destinations/tabuk/3.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">Culture & History</p>
                                <h5 class="explore-destinations__item-description">Tabuk</h5>
                            </div>
                            <button class="btn btn-outline-primary rounded-pill">Packages (20) <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset('frontend/assets/destinations/yanbu/1.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">Nature, Beaches</p>
                                <h5 class="explore-destinations__item-description">Yanbu</h5>
                            </div>
                            <button class="btn btn-outline-primary rounded-pill">Packages (20) <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset('frontend/assets/destinations/ai_baha/1.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">Adventure, Natures</p>
                                <h5 class="explore-destinations__item-description">Al Baha</h5>
                            </div>
                            <button class="btn btn-outline-primary rounded-pill">Packages (20) <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset('frontend/assets/destinations/jazan/1.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">Culture & History</p>
                                <h5 class="explore-destinations__item-description">Jazan</h5>
                            </div>
                            <button class="btn btn-outline-primary rounded-pill">Packages (20) <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset('frontend/assets/destinations/hail/1.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">Nature, Adventure</p>
                                <h5 class="explore-destinations__item-description">Hail</h5>
                            </div>
                            <button class="btn btn-outline-primary rounded-pill">Packages (20) <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset('frontend/assets/destinations/ai_jubail/1.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">Nature, Sports</p>
                                <h5 class="explore-destinations__item-description">Al Jubail
                                </h5>
                            </div>
                            <button class="btn btn-outline-primary rounded-pill">Packages (20) <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset('frontend/assets/destinations/najran/3.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">Culture & History</p>
                                <h5 class="explore-destinations__item-description">Najran
                                </h5>
                            </div>
                            <button class="btn btn-outline-primary rounded-pill">Packages (20) <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset('frontend/assets/destinations/qassim/1.jpg') }}" alt="Destination">
                            <button class="btn btn-outline-light dest__explore-btn">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">Culture & History</p>
                                <h5 class="explore-destinations__item-description">Qassim
                                </h5>
                            </div>
                            <button class="btn btn-outline-primary rounded-pill">Packages (20) <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endsection