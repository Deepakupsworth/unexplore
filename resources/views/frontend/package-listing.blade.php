@extends('frontend.layout')
@section('content')

<!-- <section class="mb-0 package-filter-bar-section">
        <div class="container">
            <div class="package-filter-bar package-filter-bar__desktop d-flex flex-wrap align-items-center gap-2 justify-content-between">
                <div class="d-flex gap-2">
                    <div class="pkg-fil-bar__input-wrapper flex-center">
                        <label>Starting From</label>
                        <input type="text" value="" placeholder="Enter...">
                    </div>

                    <div class="pkg-fil-bar__input-wrapper flex-center">
                        <label>Starting From</label>
                        <input type="text" value="" placeholder="Enter...">
                    </div>

                    <div class="pkg-fil-bar__input-wrapper flex-center">
                        <label>Starting From</label>
                        <input type="date" value="" placeholder="Enter...">
                    </div>

                    <div class="pkg-fil-bar__input-wrapper flex-center dropdown">
                        <label>Starting From</label>
                        <div class="w-100 d-flex justify-content-between align-items-center text-white gap-1" data-bs-toggle="dropdown" aria-expanded="false">
                            <p class="text-truncate">3 Adults, Economy</p>
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                        <div class="dropdown-menu travellers-dropdown p-3 shadow-lg"> -->

                            <!-- Adults -->
                            <!-- <div class="traveller-row d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <strong>Adults</strong>
                                    <p class="text-muted small m-0">12+ Years</p>
                                </div>

                                <div class="traveller-counter d-flex align-items-center gap-2">
                                    <button class="traveller-counter-btn minus">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                    <span class="count">1</span>
                                    <button class="traveller-counter-btn plus">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div> -->

                            <!-- Children -->
                            <!-- <div class="traveller-row d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <strong>Children</strong>
                                    <p class="text-muted small m-0">2–12 Years</p>
                                </div>

                                <div class="traveller-counter d-flex align-items-center gap-2">
                                    <button class="traveller-counter-btn minus">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                    <span class="count">1</span>
                                    <button class="traveller-counter-btn plus">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div> -->

                            <!-- Infants -->
                            <!-- <div class="traveller-row d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <strong>Infants</strong>
                                    <p class="text-muted small m-0">Below 2 Years</p>
                                </div>

                                <div class="traveller-counter d-flex align-items-center gap-2">
                                    <button class="traveller-counter-btn minus">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                    <span class="count">1</span>
                                    <button class="traveller-counter-btn plus">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div> -->
                            <!-- Travel Classes -->
                            <!-- <div class="d-flex flex-wrap gap-2 mt-2">
                                <span class="traveller-chip active">Economy</span>
                                <span class="traveller-chip">Business Class</span>
                                <span class="traveller-chip">First Class</span>
                                <span class="traveller-chip">Premium Economy</span>
                            </div>
                        </div>
                    </div> -->

                    <!-- Search Button -->
                    <!-- <button class="btn btn-dark pkg-fil-bar__search-btn px-4 rounded-pill">Search</button>
                </div> -->

                <!-- Explore More Button -->
                <!-- <button class="btn btn-light pkg-fil-bar__explore-btn flex-v-center gap-3">
                    Explore More <i class="fa-solid fa-angles-right"></i>
                </button>
            </div>
            <div class="w-100 text-start package-filter-bar__mobile mb-2">
                <p class="f-14">Riyadh to</p>
                <h4 class="fw-bold">Jeddah</h4>
                <div class="d-flex align-items-center gap-2">
                    <p class="f-14">25 Dec 2025, 2 Adults, 1 Room</p>
                    <div class="primary-text" id="package-filter-bar-edit-btn" data-bs-toggle="modal" data-bs-target="#packageFilterModal">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                </div>
            </div>
        </div>
</section> -->


    <!-- 1. PACKAGE LISTING BANNER -->
    <section class="package-listing__banner">
        <div class="container">
            <div class="package-listing__banner-content text-center">
                <h1 class="package-listing__banner-heading h2">Explore Packages</h1>
                <p>Discover the full range of amazing things to see and do across Saudi.</p>
            </div>
        </div>
    </section>

    <!-- 2. PACKAGE LISTING -->
    <section class="package-listing">
        <div class="container">
            <div class="package-listing__filters">
                <div class="package-listing__filter-section">
                    <div class="package-listing__filter-section-header">
                        <h6>Filters</h6>
                    </div>
                    <div class="package-listing__filter-items">
                        <div class="package-listing__filter-item">
                            <p class="p-large package-listing__filter-title">Search</p>
                            <div class="input-group mb-3 package-listing__search-bar">
                                <input type="text" class="form-control" placeholder="Browse Package, Locations"
                                    aria-label="Browse Package, Location">
                                <button class="btn" type="button">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="package-listing__filter-item accordion" id="flightAccordion">
                            <div class="accordion-item">
                                <p class="accordion-header p-large package-listing__filter-title">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFlight" aria-expanded="true"
                                        aria-controls="collapseFlight">
                                        Flights
                                    </button>
                                </p>
                                <div id="collapseFlight" class="accordion-collapse collapse show"
                                    data-bs-parent="#flightAccordion">
                                    <div class="accordion-body">
                                        <div class="package-listing__filter-btn-group">
                                            <button class="btn btn-light" type="button">With Flight (2)</button>
                                            <button class="btn btn-light" type="button">Without Flight (2)</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="package-listing__filter-item accordion" id="budgetAccordion">
                            <div class="accordion-item">
                                <p class="accordion-header p-large package-listing__filter-title">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseBudget" aria-expanded="true"
                                        aria-controls="collapseBudget">
                                        Budget (per person)
                                    </button>
                                </p>
                                <div id="collapseBudget" class="accordion-collapse collapse show"
                                    data-bs-parent="#budgetAccordion">
                                    <div class="accordion-body">
                                        <div class="package-listing__budget-filter-list">
                                            <div class="package-listing__budget-filter-option">
                                                <label>
                                                    <input type="checkbox" aria-label="Less than 80,000" />
                                                    <span class="package-listing__budget-custom-checkbox"
                                                        aria-hidden="true"></span>
                                                    <span class="option-text">&lt; ₹80,000</span>
                                                </label>
                                                <span class="package-listing__budget-count">(2)</span>
                                            </div>

                                            <div class="package-listing__budget-filter-option">
                                                <label>
                                                    <input type="checkbox" aria-label="80,000 to 90,000" />
                                                    <span class="package-listing__budget-custom-checkbox"
                                                        aria-hidden="true"></span>
                                                    <span class="option-text">₹80,000 – ₹90,000</span>
                                                </label>
                                                <span class="package-listing__budget-count">(2)</span>
                                            </div>

                                            <div class="package-listing__budget-filter-option">
                                                <label>
                                                    <input type="checkbox" aria-label="90,000 to 100,000" />
                                                    <span class="package-listing__budget-custom-checkbox"
                                                        aria-hidden="true"></span>
                                                    <span class="option-text">₹90,000 – ₹1,00,000</span>
                                                </label>
                                                <span class="package-listing__budget-count">(2)</span>
                                            </div>

                                            <div class="package-listing__budget-filter-option">
                                                <label>
                                                    <input type="checkbox" aria-label="100,000 to 110,000" />
                                                    <span class="package-listing__budget-custom-checkbox"
                                                        aria-hidden="true"></span>
                                                    <span class="option-text">₹1,00,000 – ₹1,10,000</span>
                                                </label>
                                                <span class="package-listing__budget-count">(2)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="package-listing__filter-item accordion" id="ratingAccordion">
                            <div class="accordion-item">
                                <p class="accordion-header p-large package-listing__filter-title">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseRating" aria-expanded="true"
                                        aria-controls="collapseRating">
                                        Hotel Category
                                    </button>
                                </p>
                                <div id="collapseRating" class="accordion-collapse collapse show"
                                    data-bs-parent="#ratingAccordion">
                                    <div class="accordion-body">
                                        <div class="package-listing__budget-filter-list">
                                            <div class="package-listing__budget-filter-option">
                                                <label>
                                                    <input type="checkbox" aria-label="3★ & above" />
                                                    <span class="package-listing__budget-custom-checkbox"
                                                        aria-hidden="true"></span>
                                                    <span class="option-text">3★ & above</span>
                                                </label>
                                            </div>

                                            <div class="package-listing__budget-filter-option">
                                                <label>
                                                    <input type="checkbox" aria-label="4★ & above" />
                                                    <span class="package-listing__budget-custom-checkbox"
                                                        aria-hidden="true"></span>
                                                    <span class="option-text">4★ & above</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="package-listing__filter-item accordion" id="citiesAccordion">
                            <div class="accordion-item">
                                <p class="accordion-header p-large package-listing__filter-title">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseCities" aria-expanded="true"
                                        aria-controls="collapseCities">
                                        Cities
                                    </button>
                                </p>
                                <div id="collapseCities" class="accordion-collapse collapse show"
                                    data-bs-parent="#citiesAccordion">
                                    <div class="accordion-body">
                                        <div class="input-group mb-3 package-listing__search-bar">
                                            <input type="text" class="form-control" placeholder="Search"
                                                aria-label="Search">
                                            <button class="btn" type="button">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </button>
                                        </div>
                                        <div class="package-listing__budget-filter-list">
                                            <div class="package-listing__budget-filter-option">
                                                <label>
                                                    <input type="checkbox" aria-label="Saudi Arabia" />
                                                    <span class="package-listing__budget-custom-checkbox"
                                                        aria-hidden="true"></span>
                                                    <span class="option-text">Saudi Arabia</span>
                                                </label>
                                                <span class="package-listing__budget-count">(2)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="package-listing__filter-item accordion" id="packagesAccordion">
                            <div class="accordion-item">
                                <p class="accordion-header p-large package-listing__filter-title">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapsePackages" aria-expanded="true"
                                        aria-controls="collapsePackages">
                                        Package Type
                                    </button>
                                </p>
                                <div id="collapsePackages" class="accordion-collapse collapse show"
                                    data-bs-parent="#packagesAccordion">
                                    <div class="accordion-body">
                                        <div class="package-listing__budget-filter-list">
                                            <div
                                                class="package-listing__budget-filter-option package-listing__budget-button active">
                                                <label>
                                                    <input type="checkbox" aria-label="Saudi Arabia" checked />
                                                    <span class="option-text">Customizable</span>
                                                </label>
                                                <span class="package-listing__budget-count">(2)</span>
                                            </div>
                                            <div
                                                class="package-listing__budget-filter-option package-listing__budget-button">
                                                <label>
                                                    <input type="checkbox" aria-label="Saudi Arabia" />
                                                    <span class="option-text">Group Package</span>
                                                </label>
                                                <span class="package-listing__budget-count">(0)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="package-listing__results">
                    <div class="package-listing__results-header">
                        <p class="primary-text">All Packages (2)</p>
                        <p>Group Tours (4)</p>
                    </div>
                    <div class="package-listing__results-applied-list">
                        <div class="d-flex gap-2 flex-wrap" id="package-listing__applied-filters">
                            <div class="package-listing__results-applied-fil success">
                                <p class="p-small">Customizable</p>
                                <button class="package-listing__results-del-button clear-package"><i
                                        class="fa-solid fa-xmark"></i></button>
                            </div>
                            <div class="package-listing__results-applied-fil danger">
                                <p class="p-small">Clear All</p>
                                <button class="package-listing__results-del-button" id="clear-all-package-filter"><i
                                        class="fa-solid fa-trash-can"></i></button>
                            </div>
                        </div>
                        <div class="dropdown package-listing__results-sort-dropdown ms-auto">
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span class="label">Sort by:</span> <span
                                    class="package-listing__results-sort-option fw-600">Popular</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Popular</a></li>
                                <li><a class="dropdown-item" href="#">Newest</a></li>
                                <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
                                <li><a class="dropdown-item" href="#">Price: High to Low</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="package-listing__results-list">
                        <div class="row gy-4 gx-3">
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="exclusive-offers__carousel-item">
                                    <div class="exclusive-offers__carousel-item-img">
                                        <img src="{{ asset('frontend/assets/destinations/hail/3.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                                        <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Hail
                                        </div>
                                    </div>
                                    <div class="exclusive-offers__carousel-item-info">
                                        <div class="d-flex justify-content-between mb-1">
                                            <h6 class="fw-bold">Ha’il Adventure </h6>
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
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="exclusive-offers__carousel-item">
                                    <div class="exclusive-offers__carousel-item-img">
                                        <img src="{{ asset('frontend/assets//destinations/jazan/1.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                                        <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Jazan
                                        </div>
                                    </div>
                                    <div class="exclusive-offers__carousel-item-info">
                                        <div class="d-flex justify-content-between mb-1">
                                            <h6 class="fw-bold">Best of Jazan </h6>
                                            <span class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                                        </div>
                                        <p class="text-muted small mb-2">2N Jazan • 3D Jeddah</p>
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
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="exclusive-offers__carousel-item">
                                    <div class="exclusive-offers__carousel-item-img">
                                        <img src="{{ asset('frontend/assets/destinations/kaec/2.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                                        <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> KAEC
                                        </div>
                                    </div>
                                    <div class="exclusive-offers__carousel-item-info">
                                        <div class="d-flex justify-content-between mb-1">
                                            <h6 class="fw-bold">KAEC Luxury </h6>
                                            <span class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                                        </div>
                                        <p class="text-muted small mb-2">2N KAEC • 3D Jeddah</p>
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
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="exclusive-offers__carousel-item">
                                    <div class="exclusive-offers__carousel-item-img">
                                        <img src="{{ asset('frontend/assets/destinations/madinah/2.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                                        <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Madinah
                                        </div>
                                    </div>
                                    <div class="exclusive-offers__carousel-item-info">
                                        <div class="d-flex justify-content-between mb-1">
                                            <h6 class="fw-bold">Madinah Peaceful </h6>
                                            <span class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                                        </div>
                                        <p class="text-muted small mb-2">2N Madinah • 3D Jeddah</p>
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
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="exclusive-offers__carousel-item">
                                    <div class="exclusive-offers__carousel-item-img">
                                        <img src="{{ asset('frontend/assets/destinations/makkah/1.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                                        <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i> Makkha
                                        </div>
                                    </div>
                                    <div class="exclusive-offers__carousel-item-info">
                                        <div class="d-flex justify-content-between mb-1">
                                            <h6 class="fw-bold">Spiritual Journey</h6>
                                            <span class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                                        </div>
                                        <p class="text-muted small mb-2">2N Makkha • 3D Jeddah</p>
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
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="exclusive-offers__carousel-item">
                                    <div class="exclusive-offers__carousel-item-img">
                                        <img src="{{ asset('frontend/assets/destinations/najran/1.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                                        <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i>  Najran
                                        </div>
                                    </div>
                                    <div class="exclusive-offers__carousel-item-info">
                                        <div class="d-flex justify-content-between mb-1">
                                            <h6 class="fw-bold">Heritage Escape</h6>
                                            <span class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                                        </div>
                                        <p class="text-muted small mb-2">2N  Najran • 3D Jeddah</p>
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
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="exclusive-offers__carousel-item">
                                    <div class="exclusive-offers__carousel-item-img">
                                        <img src="{{ asset('frontend/assets/destinations/alula/5.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                                        <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i>  AlUla
                                        </div>
                                    </div>
                                    <div class="exclusive-offers__carousel-item-info">
                                        <div class="d-flex justify-content-between mb-1">
                                            <h6 class="fw-bold">Heritage Escape</h6>
                                            <span class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                                        </div>
                                        <p class="text-muted small mb-2">2N  AlUla • 3D Jeddah</p>
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
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="exclusive-offers__carousel-item">
                                    <div class="exclusive-offers__carousel-item-img">
                                        <img src="{{ asset('frontend/assets/destinations/riyadh/4.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                                        <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i>  Riyadh
                                        </div>
                                    </div>
                                    <div class="exclusive-offers__carousel-item-info">
                                        <div class="d-flex justify-content-between mb-1">
                                            <h6 class="fw-bold">Cultural Journey</h6>
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
                                                <p class="text-muted small">Total Price: <img class="opacity-50"
                                                        src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1,22,100</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="exclusive-offers__carousel-item">
                                    <div class="exclusive-offers__carousel-item-img">
                                        <img src="{{ asset('frontend/assets/destinations/kaec/4.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                                        <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i>  Diriyah
                                        </div>
                                    </div>
                                    <div class="exclusive-offers__carousel-item-info">
                                        <div class="d-flex justify-content-between mb-1">
                                            <h6 class="fw-bold">Luxury Getaway</h6>
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
                                                <p class="text-muted small">Total Price: <img class="opacity-50"
                                                        src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1,22,100</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="exclusive-offers__carousel-item">
                                    <div class="exclusive-offers__carousel-item-img">
                                        <img src="{{ asset('frontend/assets/destinations/ai_baha/3.jpg') }}" alt="Exclusive Offer" class="img-fluid">
                                        <div class="badge carousel-badge"><i class="fa-solid fa-location-dot"></i>  Al Bahah
                                        </div>
                                    </div>
                                    <div class="exclusive-offers__carousel-item-info">
                                        <div class="d-flex justify-content-between mb-1">
                                            <h6 class="fw-bold">Mountain Retreat</h6>
                                            <span class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                                        </div>
                                        <p class="text-muted small mb-2">2N Al Bahah • 3D Jeddah</p>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  @endsection