@extends('frontend.layout')
@section('content')

    <!-- 1. TO DO THING SEARCH: BANNER -->
    <section class="package-listing__banner">
        <div class="container">
            <div class="package-listing__banner-content text-center">
                <h1 class="package-listing__banner-heading h2">Explore Packages</h1>
                <p>Discover the full range of amazing things to see and do across Saudi.</p>
            </div>
        </div>
    </section>

    <!-- 2. TO DO THING SEARCH -->
    <section class="package-listing to-do-things-search">
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
                        <div class="package-listing__filter-item accordion" id="packagesAccordion">
                            <div class="accordion-item">
                                <p class="accordion-header p-large package-listing__filter-title">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapsePackages" aria-expanded="true"
                                        aria-controls="collapsePackages">
                                        Type
                                    </button>
                                </p>
                                <div id="collapsePackages" class="accordion-collapse collapse show"
                                    data-bs-parent="#packagesAccordion">
                                    <div class="accordion-body">
                                        <div class="package-listing__budget-filter-list">
                                            <div
                                                class="package-listing__budget-filter-option package-listing__budget-button active">
                                                <label>
                                                    <input type="checkbox" aria-label="Saudi Arabia" />
                                                    <span class="option-text">All Things To Do</span>
                                                </label>
                                                <span class="package-listing__budget-count">(10)</span>
                                            </div>
                                            <div
                                                class="package-listing__budget-filter-option package-listing__budget-button">
                                                <label>
                                                    <input type="checkbox" aria-label="Saudi Arabia" />
                                                    <span class="option-text">Attractions</span>
                                                </label>
                                            </div>
                                            <div
                                                class="package-listing__budget-filter-option package-listing__budget-button">
                                                <label>
                                                    <input type="checkbox" aria-label="Saudi Arabia" />
                                                    <span class="option-text">Events</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="package-listing__filter-item accordion" id="destinationAccordion">
                            <div class="accordion-item">
                                <p class="accordion-header p-large package-listing__filter-title">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseDestination" aria-expanded="true"
                                        aria-controls="collapseDestination">
                                        Destinations
                                    </button>
                                </p>
                                <div class="input-group mb-3 package-listing__search-bar">
                                    <input type="text" class="form-control" placeholder="Browse Package, Locations"
                                        aria-label="Browse Package, Location">
                                    <button class="btn" type="button">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                                <div id="collapseDestination" class="accordion-collapse collapse show"
                                    data-bs-parent="#destinationAccordion">
                                    <div class="accordion-body">
                                        <div class="package-listing__budget-filter-list">
                                            <div class="package-listing__budget-filter-option">
                                                <label>
                                                    <input type="checkbox" aria-label="Less than 80,000" />
                                                    <span class="package-listing__budget-custom-checkbox"
                                                        aria-hidden="true"></span>
                                                    <span class="option-text">Riyadh</span>
                                                </label>
                                                <span class="package-listing__budget-count">(2)</span>
                                            </div>

                                            <div class="package-listing__budget-filter-option">
                                                <label>
                                                    <input type="checkbox" aria-label="80,000 to 90,000" />
                                                    <span class="package-listing__budget-custom-checkbox"
                                                        aria-hidden="true"></span>
                                                    <span class="option-text">Jeddah</span>
                                                </label>
                                                <span class="package-listing__budget-count">(2)</span>
                                            </div>

                                            <div class="package-listing__budget-filter-option">
                                                <label>
                                                    <input type="checkbox" aria-label="90,000 to 100,000" />
                                                    <span class="package-listing__budget-custom-checkbox"
                                                        aria-hidden="true"></span>
                                                    <span class="option-text">Macca</span>
                                                </label>
                                                <span class="package-listing__budget-count">(2)</span>
                                            </div>

                                            <div class="package-listing__budget-filter-option">
                                                <label>
                                                    <input type="checkbox" aria-label="100,000 to 110,000" />
                                                    <span class="package-listing__budget-custom-checkbox"
                                                        aria-hidden="true"></span>
                                                    <span class="option-text">Aseer</span>
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
                                        Seasons
                                    </button>
                                </p>
                                <div id="collapsePackages" class="accordion-collapse collapse show"
                                    data-bs-parent="#packagesAccordion">
                                    <div class="accordion-body">
                                        <div class="package-listing__budget-filter-list">
                                            <div
                                                class="package-listing__budget-filter-option package-listing__budget-button active">
                                                <label>
                                                    <input type="checkbox" aria-label="Saudi Arabia" />
                                                    <span class="option-text">Riyadh Season</span>
                                                </label>
                                            </div>
                                            <div
                                                class="package-listing__budget-filter-option package-listing__budget-button">
                                                <label>
                                                    <input type="checkbox" aria-label="Saudi Arabia" />
                                                    <span class="option-text">Jeddah Season</span>
                                                </label>
                                            </div>
                                            <div
                                                class="package-listing__budget-filter-option package-listing__budget-button">
                                                <label>
                                                    <input type="checkbox" aria-label="Saudi Arabia" />
                                                    <span class="option-text">Diriyah Season 2024 - 2025</span>
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
                                        Dates
                                    </button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="package-listing__results">
                    <div class="package-listing__results-header gap-2">
                        <div class="package-listing__results-applied-fil success">
                            <p class="p-small">Nature</p>
                        </div>
                        <div class="package-listing__results-applied-fil">
                            <p class="p-small">Entertainment</p>
                        </div>
                        <div class="package-listing__results-applied-fil">
                            <p class="p-small">Culture & History</p>
                        </div>
                    </div>
                    <div class="package-listing__results-applied-list">
                        <div class="d-flex gap-2">
                            <div class="package-listing__results-applied-fil success">
                                <p class="p-small">Customizable</p>
                                <button class="package-listing__results-del-button"><i
                                        class="fa-solid fa-xmark"></i></button>
                            </div>
                            <div class="package-listing__results-applied-fil danger">
                                <p class="p-small">Clear All</p>
                                <button class="package-listing__results-del-button"><i
                                        class="fa-solid fa-trash-can"></i></button>
                            </div>
                        </div>
                        <div class="dropdown package-listing__results-sort-dropdown">
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
                            <div class="col-md-6 col-lg-6 col-xl-4">
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
                            <div class="col-md-6 col-lg-6 col-xl-4">
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
                            <div class="col-md-6 col-lg-6 col-xl-4">
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
                            <div class="col-md-6 col-lg-6 col-xl-4">
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
                            <div class="col-md-6 col-lg-6 col-xl-4">
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
                            <div class="col-md-6 col-lg-6 col-xl-4">
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
                            <div class="col-md-6 col-lg-6 col-xl-4">
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
                            <div class="col-md-6 col-lg-6 col-xl-4">
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
                            <div class="col-md-6 col-lg-6 col-xl-4">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  @endsection