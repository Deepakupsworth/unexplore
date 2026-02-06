@extends('frontend.layout')
@section('content')
 <!-- 1. ABOUT US: BANNER -->
 <section class="package-listing__banner">
    <div class="container">
        <div
            class="text-center justify-content-center package-listing__banner-content product-banner align-items-center">
            <h1 class="h2 fw-bold text-white m-0">Products</h1>
            <p class="p-large">Every package is designed to bring you the comfort, convenience and exclusive rewards
                you deserve.
            </p>
        </div>
    </div>
</section>

<section class="product-section section-padding-md">
    <div class="container">
        <div class="row g-4 align-items-center">

            <div class="col-lg-6">
                <div class="product-section__image-section">
                    <!-- Left: Thumbnails -->
                    <div class="d-flex flex-md-column gap-3 product-section__thumbnails">
                        <img src="{{ asset('frontend/assets/product-1_1.png')}}" class="img-fluid" alt="">
                        <img src="{{ asset('frontend/assets/product-1_2.png')}}" class="img-fluid" alt="">
                        <img src="{{ asset('frontend/assets/product-1_3.png')}}" class="img-fluid" alt="">
                    </div>

                    <!-- Middle: Large Image -->
                    <div class="text-center">
                        <img src="{{ asset('frontend/assets/product-1-main.png')}}" class="img-fluid product-section__main-img" alt="">
                    </div>
                </div>
            </div>


            <!-- Right: Product Details -->
            <div class="col-lg-6 product-section__details">
                <div class="product-section__details-content">
                    <h3 class="fw-600 text-black">Saudi Arabia T-shirt</h3>
                    <p class="mb-3 fw-600 product-section__details-sub-title text-dark">
                        Saudi T-shirt: Elegance and pride in national identity
                    </p>

                    <ul class="text-light2 mb-4 product-section__details-list">
                        <li>A modern T-shirt with a special design and drawing expressing the National Day
                            (September
                            23) and is distinguished by its</li>
                        <li>Wonderful, exclusive shape, in which the quality of the fabric and the cotton material
                            were
                            carefully chosen and fit different</li>
                        <li>Sizes and are attractive in shape, dress and distinctive design at the Two Million
                            store.
                        </li>
                    </ul>

                    <!-- Quantity Selector -->
                    <div class="mb-4 d-flex align-items-center gap-2">
                        <p class="fw-600 p-xl">Quantity</p>

                        <div class="input-group product-section__details-quantity">
                            <button class="btn btn-outline-secondary">−</button>
                            <input type="text" class="text-center" value="2">
                            <button class="btn btn-outline-secondary">+</button>
                        </div>
                    </div>

                    <!-- Buy Button -->
                    <button class="btn btn-primary btn-lg rounded-pill product-section__details-buy fw-500">
                        Buy Now
                        <i class="fa-solid fa-angles-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

</section>

<section class="product-section section-padding-md">
    <div class="container">
        <div class="row g-4 align-items-center product-reverse">

            <!-- Right: Product Details -->
            <div class="col-lg-6 product-section__details">
                <div class="product-section__details-content left">
                    <h3 class="fw-600 text-black">Saudi Arabia T-shirt</h3>
                    <p class="mb-3 fw-600 product-section__details-sub-title text-dark">
                        Saudi T-shirt: Elegance and pride in national identity
                    </p>

                    <ul class="text-light2 mb-4 product-section__details-list">
                        <li>A modern T-shirt with a special design and drawing expressing the National Day
                            (September
                            23) and is distinguished by its</li>
                        <li>Wonderful, exclusive shape, in which the quality of the fabric and the cotton material
                            were
                            carefully chosen and fit different</li>
                        <li>Sizes and are attractive in shape, dress and distinctive design at the Two Million
                            store.
                        </li>
                    </ul>

                    <!-- Quantity Selector -->
                    <div class="mb-4 d-flex align-items-center gap-2">
                        <p class="fw-600 p-xl">Quantity</p>

                        <div class="input-group product-section__details-quantity">
                            <button class="btn btn-outline-secondary">−</button>
                            <input type="text" class="text-center" value="2">
                            <button class="btn btn-outline-secondary">+</button>
                        </div>
                    </div>

                    <!-- Buy Button -->
                    <button class="btn btn-primary btn-lg rounded-pill product-section__details-buy fw-500">
                        Buy Now
                        <i class="fa-solid fa-angles-right"></i>
                    </button>
                </div>

            </div>

            <div class="col-lg-6">
                <div class="product-section__image-section product-section__image-section-right">
                    <!-- Left: Thumbnails -->
                    <div class="d-flex flex-md-column gap-3 product-section__thumbnails">
                        <img src="{{ asset('frontend/assets/product-1_1.png')}}" class="img-fluid" alt="">
                        <img src="{{ asset('frontend/assets/product-1_2.png')}}" class="img-fluid" alt="">
                        <img src="{{ asset('frontend/assets/product-1_3.png')}}" class="img-fluid" alt="">
                    </div>

                    <!-- Middle: Large Image -->
                    <div class="text-center">
                        <img src="{{ asset('frontend/assets/product-1-main.png')}}" class="img-fluid product-section__main-img" alt="">
                    </div>
                </div>
            </div>

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
                    <img src="{{ asset('frontend/assets/start-explore-1.png')}}" alt="Explore" class="img-fluid">
                    <div class="start-exploring__item-content">
                        <p class="mb-1 p-large fw-600">Diriyah</p>
                        <p class="p-small">A City Embracing Saudi History</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="start-exploring__item">
                    <img src="{{ asset('frontend/assets/start-explore-1.png')}}" alt="Explore" class="img-fluid">
                    <div class="start-exploring__item-content">
                        <p class="mb-1 p-large fw-600">Diriyah</p>
                        <p class="p-small">A City Embracing Saudi History</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="start-exploring__item">
                    <img src="{{ asset('frontend/assets/start-explore-1.png')}}" alt="Explore" class="img-fluid">
                    <div class="start-exploring__item-content">
                        <p class="mb-1 p-large fw-600">Diriyah</p>
                        <p class="p-small">A City Embracing Saudi History</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="start-exploring__item">
                    <img src="{{ asset('frontend/assets/start-explore-1.png')}}" alt="Explore" class="img-fluid">
                    <div class="start-exploring__item-content">
                        <p class="mb-1 p-large fw-600">Diriyah</p>
                        <p class="p-small">A City Embracing Saudi History</p>
                    </div>
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
                        <img src="{{ asset('frontend/assets/exclusive-offer.png')}}" alt="Exclusive Offer" class="img-fluid">
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
                                    <img src="{{ asset('frontend/assets/icons/riyal.svg')}}" alt="Riyal">
                                    <p class="fw-bold text-dark">40,000</p> /Person
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-1 text-muted">
                                    <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg')}}" alt="Riyal">
                                    8,332
                                </div>
                                <p class="text-muted small">Total Price: <img class="opacity-50"
                                        src="{{ asset('frontend/assets/icons/riyal.svg')}}" alt="Riyal"> 1,22,100</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="exclusive-offers__carousel-item swiper-slide">
                    <div class="exclusive-offers__carousel-item-img">
                        <img src="{{ asset('frontend/assets/exclusive-offer.png')}}" alt="Exclusive Offer" class="img-fluid">
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
                                    <img src="{{ asset('frontend/assets/icons/riyal.svg')}}" alt="Riyal">
                                    <p class="p-large fw-bold text-dark">40,000</p> /Person
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-1 text-muted">
                                    <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg')}}" alt="Riyal">
                                    8,332
                                </div>
                                <p class="text-muted small">Total Price: <img class="opacity-50"
                                        src="{{ asset('frontend/assets/icons/riyal.svg')}}" alt="Riyal"> 1,22,100</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="exclusive-offers__carousel-item swiper-slide">
                    <div class="exclusive-offers__carousel-item-img">
                        <img src="{{ asset('frontend/assets/exclusive-offer.png')}}" alt="Exclusive Offer" class="img-fluid">
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
                                    <img src="{{ asset('frontend/assets/icons/riyal.svg')}}" alt="Riyal">
                                    <p class="p-large fw-bold text-dark">40,000</p> /Person
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-1 text-muted">
                                    <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg')}}" alt="Riyal">
                                    8,332
                                </div>
                                <p class="text-muted small">Total Price: <img class="opacity-50"
                                        src="{{ asset('frontend/assets/icons/riyal.svg')}}" alt="Riyal"> 1,22,100</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="exclusive-offers__carousel-item swiper-slide">
                    <div class="exclusive-offers__carousel-item-img">
                        <img src="{{ asset('frontend/assets/exclusive-offer.png')}}" alt="Exclusive Offer" class="img-fluid">
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
                                    <img src="{{ asset('frontend/assets/icons/riyal.svg')}}" alt="Riyal">
                                    <p class="p-large fw-bold text-dark">40,000</p> /Person
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-1 text-muted">
                                    <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg')}}" alt="Riyal">
                                    8,332
                                </div>
                                <p class="text-muted small">Total Price: <img class="opacity-50"
                                        src="{{ asset('frontend/assets/icons/riyal.svg')}}" alt="Riyal"> 1,22,100</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="exclusive-offers__carousel-item swiper-slide">
                    <div class="exclusive-offers__carousel-item-img">
                        <img src="{{ asset('frontend/assets/exclusive-offer.png')}}" alt="Exclusive Offer" class="img-fluid">
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
                                    <img src="{{ asset('frontend/assets/icons/riyal.svg')}}" alt="Riyal">
                                    <p class="p-large fw-bold text-dark">40,000</p> /Person
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-1 text-muted">
                                    <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg')}}" alt="Riyal">
                                    8,332
                                </div>
                                <p class="text-muted small">Total Price: <img class="opacity-50"
                                        src="{{ asset('frontend/assets/icons/riyal.svg')}}" alt="Riyal"> 1,22,100</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="exclusive-offers__carousel-item swiper-slide">
                    <div class="exclusive-offers__carousel-item-img">
                        <img src="{{ asset('frontend/assets/exclusive-offer.png')}}" alt="Exclusive Offer" class="img-fluid">
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
                                    <img src="{{ asset('frontend/assets/icons/riyal.svg')}}" alt="Riyal">
                                    <p class="p-large fw-bold text-dark">40,000</p> /Person
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-1 text-muted">
                                    <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg')}}" alt="Riyal">
                                    8,332
                                </div>
                                <p class="text-muted small">Total Price: <img class="opacity-50"
                                        src="{{ asset('frontend/assets/icons/riyal.svg')}}" alt="Riyal"> 1,22,100</p>
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
