@extends('frontend.layout')
@section('content')

<section class="checkout-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div
                        class="checkout-top-header d-flex flex-column flex-sm-row justify-content-between align-items-start">

                        <!-- LEFT BLOCK -->
                        <div>
                            <h1 class="fw-600 text-white mb-1 h3">Al-Bujairi Heritage Tourist Park</h1>

                            <div class="text-white d-flex align-items-center gap-3 my-2">
                                <p>2N Diriya</p>
                                <div class="dot primary-bg"></div>
                                <p>3D Jeddah</p>
                            </div>

                            <div class="text-white d-flex flex-wrap align-items-center gap-3">
                                <p class="p-small">Thu, Nov 13, 2025</p>
                                <span class="trip-badge p-micro rounded-pill">6D/5N</span>
                                <p class="p-small">Tue, Nov 18, 2025 / From Riyadh</p>
                                <span class="vertical-divider"></span>
                                <p class="p-small"><span class="fw-600">1 Room</span> - 3 Adults</p>
                            </div>
                        </div>
                        <!-- RIGHT BUTTON -->
                        <button class="btn btn-light rounded-pill customizable-btn mt-3 mt-sm-0 fw-500">
                            Customizable
                        </button>
                    </div>

                    <div class=" accordion accordion-flush mt-3 checkout-accordion" id="checkoutTravelDetails">
                        <div class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                            <div class="accordion-header" data-bs-toggle="collapse"
                                data-bs-target="#checkoutTravelCollapse" aria-expanded="true"
                                aria-controls="checkoutTravelCollapse">
                                <div class="d-flex gap-2 pkg-details__accordion-actions">
                                    <p class="fw-600">1. Traveller Details</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center gap-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="accordion-icon">
                                            <i class="fa-solid fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="checkoutTravelCollapse" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#checkoutTravelDetails">
                                <div class="accordion-body">

                                    <div class="d-flex gap-1 mb-3">
                                        <p class="fw-600">2 Travellers - </p>
                                        <div class="d-flex gap-2 p-small align-items-center">
                                            <p>1 Room </p>
                                            <div class="vertical-divider h-75"></div>
                                            <p>2 Adults</p>
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            class="d-flex justify-content-between align-items-center checkout-traveller-header">

                                            <!-- Left section -->
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="traveller-icon flex-center rounded-4">
                                                    <i class="fa-solid fa-user"></i>
                                                </div>

                                                <div>
                                                    <h6 class="fw-600 p">TRAVELLER 1</h6>
                                                    <div class="flex-center gap-1
                                                        <p class=" p-small fw-600">Tony stark</p>
                                                        <button class="p-0 border-0 bg-transparent text-danger">
                                                            <i class="fa-solid fa-circle-xmark"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Right section -->
                                            <div class="flex-center gap-3">
                                                <div class="flex-center gap-1 primary-text">
                                                    <button class=" p-0 border-0 bg-transparent primary-text">
                                                        <i class="fa-solid fa-circle-check"></i>
                                                    </button>
                                                    <p class="p-small fw-500">Traveller Added</p>
                                                </div>
                                                <button
                                                    class="btn btn-outline-primary add-traveller-btn rounded-pill border-1-5 fw-500"
                                                    data-bs-toggle="modal" data-bs-target="#travellerModal">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div
                                            class="d-flex justify-content-between align-items-center checkout-traveller-header">

                                            <!-- Left section -->
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="traveller-icon flex-center rounded-4">
                                                    <i class="fa-solid fa-user"></i>
                                                </div>

                                                <div>
                                                    <h6 class="fw-600 p">TRAVELLER 2</h6>
                                                    <p class="text-light2 p-small">*Adult – Should be above 18 years
                                                    </p>
                                                </div>
                                            </div>

                                            <!-- Right section -->
                                            <button
                                                class="btn btn-outline-primary add-traveller-btn rounded-pill border-1-5 fw-500"
                                                data-bs-toggle="modal" data-bs-target="#travellerModal">
                                                Add Traveller
                                            </button>
                                        </div>
                                        <hr>
                                    </div>

                                    <!-- Contact Details Section -->
                                    <div class="booking-contact">

                                        <p class="fw-600 mb-3">Please Enter Contact Details</p>

                                        <div class="row g-3 mb-4">
                                            <div class="col-md-4">
                                                <label class="form-label small mb-1">Email</label>
                                                <input type="email" class="form-control" placeholder="Noshad@gmail.com">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label small mb-1">Mobile Code</label>
                                                <input type="text" class="form-control" placeholder="Enter here">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label small mb-1">Mobile</label>
                                                <input type="text" class="form-control" placeholder="Enter here">
                                            </div>
                                        </div>

                                        <p class="fw-600 mb-2">Special Requests</p>

                                        <div class="mb-4">
                                            <label class="form-label small mb-1">Special Requests</label>
                                            <input type="text" class="form-control" placeholder="Enter here">
                                        </div>

                                        <!-- TCS Info Box -->
                                        <div class="checkout-tcs-box p-3 rounded-4">
                                            <p class="mb-2 fw-600 p-small">
                                                TCS (Tax Collected at Source) is mandatory for International Holiday
                                                Packages
                                            </p>
                                            <p class="mb-0 text-muted p-small">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                eiusmod
                                                tempor incididunt ut labore
                                                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                                exercitation ullamco laboris nisi ut
                                                aliquip ex ea commodo consequat. Duis aute irure dolor in
                                                reprehenderit
                                                in voluptate velit esse
                                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                                                cupidatat non proident, sunt in culpa
                                                qui officia deserunt mollit anim id est laborum
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion accordion-flush mt-3 checkout-accordion" id="checkoutPackageAddOn">
                        <div class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                            <div class="accordion-header" data-bs-toggle="collapse"
                                data-bs-target="#checkoutPackageAddOnCollapse" aria-expanded="true"
                                aria-controls="checkoutPackageAddOnCollapse">
                                <div class="d-flex gap-2 pkg-details__accordion-actions">
                                    <p class="fw-600">2. Package Add-Ons</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center gap-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="accordion-icon">
                                            <i class="fa-solid fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="checkoutPackageAddOnCollapse" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#checkoutPackageAddOn">
                                <div class="accordion-body">

                                    <!-- Header -->
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ asset('/frontend/assets/icons/medical.svg') }}" alt="Medical Insurance">
                                            <div>
                                                <p class="fw-600">Travel + Medical Insurance</p>
                                                <p class="text-light2 p-small">Secure your trip and travel worry
                                                    free</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="checkout-tcs-box p-3 rounded-4">
                                        <div
                                            class="d-flex justify-content-between align-items-start align-items-sm-center flex-column flex-sm-row gap-2">
                                            <div
                                                class="d-flex gap-3 align-items-start align-items-sm-center flex-column flex-sm-row">
                                                <div>
                                                    <p class="fw-600">$550K Travel Insurance</p>
                                                    <p class="text-light2 p-small">99% Claims Settled</p>
                                                </div>
                                                <span class="rounded-pill checkout-package-badge p-small">MOST
                                                    POPULAR</span>
                                            </div>
                                            <a href="#" class="fw-600 primary-text">View T&Cs</a>
                                        </div>
                                        <hr>
                                        <p class="fw-600 p-small mb-2">What's Included</p>
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div class="d-flex flex-column gap-1">
                                                <div class="d-flex gap-2 align-items-center">
                                                    <img src="{{ asset('/frontend/assets/icons/emergency.svg') }}" alt="Emergency Medical">
                                                    <span class="p-small">Emergency Medical Expenses –
                                                        <span class="fw-600">$500000</span></span>
                                                </div>
                                                <div class="d-flex gap-2 align-items-center">
                                                    <img src="{{ asset('/frontend/assets/icons/trip-cancel.svg') }}" alt="Trip Cancellation">
                                                    <span class="p-small">Trip Cancellation and/or Interruption  –
                                                        <span class="fw-600">$1250</span></span>
                                                </div>
                                                <div class="d-flex gap-2 align-items-center">
                                                    <img src="{{ asset('/frontend/assets/icons/baggage.svg') }}" alt="Baggage Delay">
                                                    <span class="p-small">Delay of Checked In Baggage –
                                                        <span class="fw-600">$125</span></span>
                                                </div>
                                                <a href="#" class="primary-text mt-2 p-small fw-500">View Benefits</a>
                                            </div>
                                            <div class="text-end">
                                                <p class="fw-600">+ $12,00</p>
                                                <p class="p-small text-light2">per person</p>
                                                <button
                                                    class="btn btn-outline-primary rounded-pill px-4 mt-3">Select</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion accordion-flush mt-3 checkout-accordion" id="checkoutItinerary">
                        <div class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                            <div class="accordion-header" data-bs-toggle="collapse"
                                data-bs-target="#checkoutItineraryOnCollapse" aria-expanded="true"
                                aria-controls="checkoutItineraryOnCollapse">
                                <div class="d-flex gap-2 pkg-details__accordion-actions">
                                    <p class="fw-600">3. Package Itinerary & Inclusions</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center gap-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="accordion-icon">
                                            <i class="fa-solid fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="checkoutItineraryOnCollapse" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#checkoutItinerary">
                                <div class="accordion-body">
                                    <p class="fw-600">Package Features</p>
                                    <div class="d-flex align-items-center gap-2">
                                        <p class="fw-600 mb-1">Itinerary:</p>
                                        <p class="p-small">2 Flights / 3 Hotels / 6 Transfers / 1 Activity</p>
                                    </div>
                                    <div class="pkg-details__content-wrapper">
                                        <div class="pkg-details__day-plan">
                                            <div class="pkg-details__day-plan-left">
                                                <div class="pkg-details__day-plan-header pkg-details__common-block">Day
                                                    Plan
                                                </div>
                                                <div
                                                    class="pkg-details__day-dates pkg-details__common-block d-flex gap-3 flex-column nav nav-tabs">
                                                    <div class="pkg-details__day-date-item rounded-pill active"
                                                        data-bs-toggle="tab" data-bs-target="#packageDay1" type="button"
                                                        role="tab" aria-controls="packageDay1" aria-selected="true">
                                                        <div class="dot"></div>
                                                        26 Nov, Sun
                                                    </div>
                                                    <div class="pkg-details__day-date-item rounded-pill"
                                                        data-bs-toggle="tab" data-bs-target="#packageDay2" type="button"
                                                        role="tab" aria-controls="packageDay2" aria-selected="true">
                                                        <div class="dot"></div>
                                                        27 Nov, Sun
                                                    </div>
                                                    <div class="pkg-details__day-date-item rounded-pill"
                                                        data-bs-toggle="tab" data-bs-target="#packageDay3" type="button"
                                                        role="tab" aria-controls="packageDay3" aria-selected="true">
                                                        <div class="dot"></div>
                                                        28 Nov, Sun
                                                    </div>
                                                    <div class="pkg-details__day-date-item rounded-pill"
                                                        data-bs-toggle="tab" data-bs-target="#packageDay4" type="button"
                                                        role="tab" aria-controls="packageDay4" aria-selected="true">
                                                        <div class="dot"></div>
                                                        29 Nov, Sun
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pkg-details__day-plan-right">
                                                <div class="tab-content">
                                                    <div class="tab-pane fade show active" id="packageDay1"
                                                        role="tabpanel" aria-labelledby="packageDay1">
                                                        <div
                                                            class="pkg-details__day-plan-header pkg-details__common-block">
                                                            <!-- <div class="badge"> Macca</div> -->
                                                            <p class="badge primary-bg">Day 1</p>
                                                            <p class="fw-600">Riyadh</p>
                                                        </div>
                                                        <div
                                                            class="pkg-details__day-plan-content pkg-details__common-block">
                                                            <!-- Flight -->
                                                            <div class="accordion accordion-flush" id="flightAccordion">
                                                                <div
                                                                    class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                                    <div class="accordion-header">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center gap-3">
                                                                            <div
                                                                                class="d-flex align-items-center gap-2">
                                                                                <div class="accordion-icon"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#flightCollapse"
                                                                                    aria-expanded="true"
                                                                                    aria-controls="flightCollapse">
                                                                                    <i
                                                                                        class="fa-solid fa-chevron-down"></i>
                                                                                </div>
                                                                                <p class="p-small fw-600">FLIGHT</p>
                                                                            </div>
                                                                            <div class="vertical-divider"></div>
                                                                            <p class="p-small">New Delhi to Riyadh</p>
                                                                            <div class="vertical-divider"></div>
                                                                            <p class="p-small">08h 30m</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex gap-2 pkg-details__accordion-actions">
                                                                            <button class="btn btn-dark btn-sm">
                                                                                <i class="fa-solid fa-trash-can"></i>
                                                                            </button>
                                                                            <button class="btn btn-primary btn-sm">
                                                                                <i class="fa-solid fa-pencil"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                    <div id="flightCollapse"
                                                                        class="accordion-collapse collapse show"
                                                                        aria-labelledby="headingOne"
                                                                        data-bs-parent="#flightAccordion">
                                                                        <div class="accordion-body">

                                                                            <!-- First Flight Segment -->
                                                                            <div class="pkg-details__flight-segment">
                                                                                <div
                                                                                    class="pkg-details__flight-box flex-shrink-0">
                                                                                    <img src="{{ asset('frontend/assets/airline-logo.png') }}" 
                                                                                        alt="Airline Logo" width="50">
                                                                                    <p class="p-small">GF-131</p>
                                                                                </div>

                                                                                <div class="w-100">
                                                                                    <div
                                                                                        class="d-flex justify-content-between align-items-center">
                                                                                        <div class="flex-shrink-0">
                                                                                            <p class="m-0 fw-600">04:55
                                                                                            </p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                Wed, 08
                                                                                                Oct</p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                New Delhi
                                                                                            </p>
                                                                                        </div>

                                                                                        <div
                                                                                            class="pkg-details__flight-duration-block mx-3">
                                                                                            <p
                                                                                                class="p-small pkg-details__flight-duration">
                                                                                                04h 00m</p>
                                                                                            <div
                                                                                                class="pkg-details__flight-point pkg-details__flight-departure flex-center">
                                                                                                <i
                                                                                                    class="fa-solid fa-plane"></i>
                                                                                            </div>
                                                                                            <div
                                                                                                class="pkg-details__flight-connector">
                                                                                            </div>
                                                                                            <div
                                                                                                class="pkg-details__flight-point pkg-details__flight-arrival flex-center">
                                                                                                <i
                                                                                                    class="fa-solid fa-plane"></i>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="flex-shrink-0">
                                                                                            <p class="m-0 fw-600">08:55
                                                                                            </p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                Wed, 08
                                                                                                Oct</p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                New Delhi
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="pkg-details__flight-box pkg-details__baggage-info flex-shrink-0">
                                                                                    <p class="p-small">
                                                                                        <i
                                                                                            class="fa-solid fa-briefcase"></i>
                                                                                        <strong>Cabin:</strong> 6 Kgs
                                                                                    </p>
                                                                                    <p class="p-small">
                                                                                        <i
                                                                                            class="fa-solid fa-suitcase-rolling"></i>
                                                                                        <strong>Check-in:</strong> 35
                                                                                        Kgs
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Layover Section -->
                                                                            <div
                                                                                class="text-center py-2 my-2 rounded p-small pkg-details__layover-info">
                                                                                04h 00m Layover in BAH, Baharain
                                                                            </div>

                                                                            <!-- Second Flight Segment -->
                                                                            <div class="pkg-details__flight-segment">
                                                                                <div
                                                                                    class="pkg-details__flight-box flex-shrink-0">
                                                                                    <img src="{{ asset('frontend/assets/airline-logo.png') }}" 
                                                                                        alt="Airline Logo" width="50">
                                                                                    <p class="p-small">GF-131</p>
                                                                                </div>

                                                                                <div class="w-100">
                                                                                    <div
                                                                                        class="d-flex justify-content-between align-items-center">
                                                                                        <div class="flex-shrink-0">
                                                                                            <p class="m-0 fw-600">04:55
                                                                                            </p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                Wed, 08
                                                                                                Oct</p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                New Delhi
                                                                                            </p>
                                                                                        </div>

                                                                                        <div
                                                                                            class="pkg-details__flight-duration-block mx-3">
                                                                                            <p
                                                                                                class="p-small pkg-details__flight-duration">
                                                                                                04h 00m</p>
                                                                                            <div
                                                                                                class="pkg-details__flight-point pkg-details__flight-departure flex-center">
                                                                                                <i
                                                                                                    class="fa-solid fa-plane"></i>
                                                                                            </div>
                                                                                            <div
                                                                                                class="pkg-details__flight-connector">
                                                                                            </div>
                                                                                            <div
                                                                                                class="pkg-details__flight-point pkg-details__flight-arrival flex-center">
                                                                                                <i
                                                                                                    class="fa-solid fa-plane"></i>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="flex-shrink-0">
                                                                                            <p class="m-0 fw-600">08:55
                                                                                            </p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                Wed, 08
                                                                                                Oct</p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                New Delhi
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="pkg-details__flight-box pkg-details__baggage-info flex-shrink-0">
                                                                                    <p class="p-small">
                                                                                        <i
                                                                                            class="fa-solid fa-briefcase"></i>
                                                                                        <strong>Cabin:</strong> 6 Kgs
                                                                                    </p>
                                                                                    <p class="p-small">
                                                                                        <i
                                                                                            class="fa-solid fa-suitcase-rolling"></i>
                                                                                        <strong>Check-in:</strong> 35
                                                                                        Kgs
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="accordion accordion-flush"
                                                                id="transferAccordion">
                                                                <div
                                                                    class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                                    <div class="accordion-header">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center gap-3">
                                                                            <div
                                                                                class="d-flex align-items-center gap-2">
                                                                                <div class="accordion-icon"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#transferCollapse"
                                                                                    aria-expanded="true"
                                                                                    aria-controls="transferCollapse">
                                                                                    <i
                                                                                        class="fa-solid fa-chevron-down"></i>
                                                                                </div>
                                                                                <p class="p-small fw-600">TRANSFER</p>
                                                                            </div>
                                                                            <div class="vertical-divider"></div>
                                                                            <p class="p-small">Airport to hotel in
                                                                                Riyadh</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex gap-2 pkg-details__accordion-actions">
                                                                            <button class="btn btn-dark btn-sm">
                                                                                <i class="fa-solid fa-trash-can"></i>
                                                                            </button>
                                                                            <button class="btn btn-primary btn-sm">
                                                                                <i class="fa-solid fa-pencil"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                    <div id="transferCollapse"
                                                                        class="accordion-collapse collapse show"
                                                                        aria-labelledby="headingOne"
                                                                        data-bs-parent="#transferAccordion">
                                                                        <div class="accordion-body">
                                                                            <div
                                                                                class="d-flex align-items-center gap-3">
                                                                                <img src="{{ asset('frontend/assets/transfer.png') }}"
                                                                                    alt="Transfer"
                                                                                    class="img-fluid pkg-details__tr-ht-img">
                                                                                <div>
                                                                                    <p class="fw-600">Private Transfer
                                                                                    </p>
                                                                                    <p class="p-small text-light2">Pick
                                                                                        up from
                                                                                        Riyadh
                                                                                        International Airport to Riyadh
                                                                                        City
                                                                                        Hotel by
                                                                                        private vehicle</p>
                                                                                    <p class="p-small text-light2 mt-2">
                                                                                        <i
                                                                                            class="fa-solid fa-location-dot p-small"></i>
                                                                                        Airport to Hotel
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="accordion accordion-flush" id="hotelAccordion">
                                                                <div
                                                                    class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                                    <div class="accordion-header">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center gap-3">
                                                                            <div
                                                                                class="d-flex align-items-center gap-2">
                                                                                <div class="accordion-icon"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#hotelCollapse"
                                                                                    aria-expanded="true"
                                                                                    aria-controls="hotelCollapse">
                                                                                    <i
                                                                                        class="fa-solid fa-chevron-down"></i>
                                                                                </div>
                                                                                <p class="p-small fw-600">HOTEL</p>
                                                                            </div>
                                                                            <div class="vertical-divider"></div>
                                                                            <p class="p-small">2 Nights</p>
                                                                            <div class="vertical-divider"></div>
                                                                            <p class="p-small">In Riyadh</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex gap-2 pkg-details__accordion-actions">
                                                                            <button class="btn btn-primary btn-sm">
                                                                                <i class="fa-solid fa-pencil"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                    <div id="hotelCollapse"
                                                                        class="accordion-collapse collapse show"
                                                                        aria-labelledby="headingOne"
                                                                        data-bs-parent="#hotelAccordion">
                                                                        <div class="accordion-body">
                                                                            <div
                                                                                class="d-flex align-items-center gap-3">
                                                                                <img src="{{ asset('frontend/assets/transfer.png') }}"
                                                                                    alt="Transfer"
                                                                                    class="img-fluid pkg-details__tr-ht-img">
                                                                                <div>
                                                                                    <div
                                                                                        class="pkg-details__star-ratings">
                                                                                        <i
                                                                                            class="fa-solid fa-star active"></i>
                                                                                        <i
                                                                                            class="fa-solid fa-star active"></i>
                                                                                        <i
                                                                                            class="fa-solid fa-star active"></i>
                                                                                        <i
                                                                                            class="fa-solid fa-star active"></i>
                                                                                        <i class="fa-solid fa-star"></i>
                                                                                    </div>
                                                                                    <p class="fw-600 my-1">Crowne Plaza
                                                                                        Riyadh
                                                                                        Palace
                                                                                    </p>
                                                                                    <p class="p-small text-light2">
                                                                                        <i
                                                                                            class="fa-solid fa-location-dot p-small"></i>
                                                                                        8 October - 10 October, 2 Nights
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="packageDay2" role="tabpanel"
                                                        aria-labelledby="packageDay2">
                                                        <div
                                                            class="pkg-details__day-plan-header pkg-details__common-block">
                                                            <!-- <div class="badge"> Macca</div> -->
                                                            <p class="badge primary-bg">Day 2</p>
                                                            <p class="fw-600">Riyadh</p>
                                                        </div>
                                                        <div
                                                            class="pkg-details__day-plan-content pkg-details__common-block">
                                                            <!-- Flight -->
                                                            <div class="accordion accordion-flush" id="flightAccordion">
                                                                <div
                                                                    class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                                    <div class="accordion-header">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center gap-3">
                                                                            <div
                                                                                class="d-flex align-items-center gap-2">
                                                                                <div class="accordion-icon"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#flightCollapse"
                                                                                    aria-expanded="true"
                                                                                    aria-controls="flightCollapse">
                                                                                    <i
                                                                                        class="fa-solid fa-chevron-down"></i>
                                                                                </div>
                                                                                <p class="p-small fw-600">FLIGHT</p>
                                                                            </div>
                                                                            <div class="vertical-divider"></div>
                                                                            <p class="p-small">New Delhi to Riyadh</p>
                                                                            <div class="vertical-divider"></div>
                                                                            <p class="p-small">08h 30m</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex gap-2 pkg-details__accordion-actions">
                                                                            <button class="btn btn-dark btn-sm">
                                                                                <i class="fa-solid fa-trash-can"></i>
                                                                            </button>
                                                                            <button class="btn btn-primary btn-sm">
                                                                                <i class="fa-solid fa-pencil"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                    <div id="flightCollapse"
                                                                        class="accordion-collapse collapse show"
                                                                        aria-labelledby="headingOne"
                                                                        data-bs-parent="#flightAccordion">
                                                                        <div class="accordion-body">

                                                                            <!-- First Flight Segment -->
                                                                            <div class="pkg-details__flight-segment">
                                                                                <div
                                                                                    class="pkg-details__flight-box flex-shrink-0">
                                                                                    <img src="{{ asset('frontend/assets/airline-logo.png') }}"
                                                                                        alt="Airline Logo" width="50">
                                                                                    <p class="p-small">GF-131</p>
                                                                                </div>

                                                                                <div class="w-100">
                                                                                    <div
                                                                                        class="d-flex justify-content-between align-items-center">
                                                                                        <div class="flex-shrink-0">
                                                                                            <p class="m-0 fw-600">04:55
                                                                                            </p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                Wed, 08
                                                                                                Oct</p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                New Delhi
                                                                                            </p>
                                                                                        </div>

                                                                                        <div
                                                                                            class="pkg-details__flight-duration-block mx-3">
                                                                                            <p
                                                                                                class="p-small pkg-details__flight-duration">
                                                                                                04h 00m</p>
                                                                                            <div
                                                                                                class="pkg-details__flight-point pkg-details__flight-departure flex-center">
                                                                                                <i
                                                                                                    class="fa-solid fa-plane"></i>
                                                                                            </div>
                                                                                            <div
                                                                                                class="pkg-details__flight-connector">
                                                                                            </div>
                                                                                            <div
                                                                                                class="pkg-details__flight-point pkg-details__flight-arrival flex-center">
                                                                                                <i
                                                                                                    class="fa-solid fa-plane"></i>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="flex-shrink-0">
                                                                                            <p class="m-0 fw-600">08:55
                                                                                            </p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                Wed, 08
                                                                                                Oct</p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                New Delhi
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="pkg-details__flight-box pkg-details__baggage-info flex-shrink-0">
                                                                                    <p class="p-small">
                                                                                        <i
                                                                                            class="fa-solid fa-briefcase"></i>
                                                                                        <strong>Cabin:</strong> 6 Kgs
                                                                                    </p>
                                                                                    <p class="p-small">
                                                                                        <i
                                                                                            class="fa-solid fa-suitcase-rolling"></i>
                                                                                        <strong>Check-in:</strong> 35
                                                                                        Kgs
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Layover Section -->
                                                                            <div
                                                                                class="text-center py-2 my-2 rounded p-small pkg-details__layover-info">
                                                                                04h 00m Layover in BAH, Baharain
                                                                            </div>

                                                                            <!-- Second Flight Segment -->
                                                                            <div class="pkg-details__flight-segment">
                                                                                <div
                                                                                    class="pkg-details__flight-box flex-shrink-0">
                                                                                    <img src="{{ asset('frontend/assets/airline-logo.png') }}"
                                                                                        alt="Airline Logo" width="50">
                                                                                    <p class="p-small">GF-131</p>
                                                                                </div>

                                                                                <div class="w-100">
                                                                                    <div
                                                                                        class="d-flex justify-content-between align-items-center">
                                                                                        <div class="flex-shrink-0">
                                                                                            <p class="m-0 fw-600">04:55
                                                                                            </p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                Wed, 08
                                                                                                Oct</p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                New Delhi
                                                                                            </p>
                                                                                        </div>

                                                                                        <div
                                                                                            class="pkg-details__flight-duration-block mx-3">
                                                                                            <p
                                                                                                class="p-small pkg-details__flight-duration">
                                                                                                04h 00m</p>
                                                                                            <div
                                                                                                class="pkg-details__flight-point pkg-details__flight-departure flex-center">
                                                                                                <i
                                                                                                    class="fa-solid fa-plane"></i>
                                                                                            </div>
                                                                                            <div
                                                                                                class="pkg-details__flight-connector">
                                                                                            </div>
                                                                                            <div
                                                                                                class="pkg-details__flight-point pkg-details__flight-arrival flex-center">
                                                                                                <i
                                                                                                    class="fa-solid fa-plane"></i>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="flex-shrink-0">
                                                                                            <p class="m-0 fw-600">08:55
                                                                                            </p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                Wed, 08
                                                                                                Oct</p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                New Delhi
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="pkg-details__flight-box pkg-details__baggage-info flex-shrink-0">
                                                                                    <p class="p-small">
                                                                                        <i
                                                                                            class="fa-solid fa-briefcase"></i>
                                                                                        <strong>Cabin:</strong> 6 Kgs
                                                                                    </p>
                                                                                    <p class="p-small">
                                                                                        <i
                                                                                            class="fa-solid fa-suitcase-rolling"></i>
                                                                                        <strong>Check-in:</strong> 35
                                                                                        Kgs
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="accordion accordion-flush"
                                                                id="transferAccordion">
                                                                <div
                                                                    class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                                    <div class="accordion-header">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center gap-3">
                                                                            <div
                                                                                class="d-flex align-items-center gap-2">
                                                                                <div class="accordion-icon"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#transferCollapse"
                                                                                    aria-expanded="true"
                                                                                    aria-controls="transferCollapse">
                                                                                    <i
                                                                                        class="fa-solid fa-chevron-down"></i>
                                                                                </div>
                                                                                <p class="p-small fw-600">TRANSFER</p>
                                                                            </div>
                                                                            <div class="vertical-divider"></div>
                                                                            <p class="p-small">Airport to hotel in
                                                                                Riyadh</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex gap-2 pkg-details__accordion-actions">
                                                                            <button class="btn btn-dark btn-sm">
                                                                                <i class="fa-solid fa-trash-can"></i>
                                                                            </button>
                                                                            <button class="btn btn-primary btn-sm">
                                                                                <i class="fa-solid fa-pencil"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                    <div id="transferCollapse"
                                                                        class="accordion-collapse collapse show"
                                                                        aria-labelledby="headingOne"
                                                                        data-bs-parent="#transferAccordion">
                                                                        <div class="accordion-body">
                                                                            <div
                                                                                class="d-flex align-items-center gap-3">
                                                                                <img src="{{ asset('frontend/assets/transfer.png') }}"
                                                                                    alt="Transfer"
                                                                                    class="img-fluid pkg-details__tr-ht-img">
                                                                                <div>
                                                                                    <p class="fw-600">Private Transfer
                                                                                    </p>
                                                                                    <p class="p-small text-light2">Pick
                                                                                        up from
                                                                                        Riyadh
                                                                                        International Airport to Riyadh
                                                                                        City
                                                                                        Hotel by
                                                                                        private vehicle</p>
                                                                                    <p class="p-small text-light2 mt-2">
                                                                                        <i
                                                                                            class="fa-solid fa-location-dot p-small"></i>
                                                                                        Airport to Hotel
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="accordion accordion-flush" id="hotelAccordion">
                                                                <div
                                                                    class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                                    <div class="accordion-header">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center gap-3">
                                                                            <div
                                                                                class="d-flex align-items-center gap-2">
                                                                                <div class="accordion-icon"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#hotelCollapse"
                                                                                    aria-expanded="true"
                                                                                    aria-controls="hotelCollapse">
                                                                                    <i
                                                                                        class="fa-solid fa-chevron-down"></i>
                                                                                </div>
                                                                                <p class="p-small fw-600">HOTEL</p>
                                                                            </div>
                                                                            <div class="vertical-divider"></div>
                                                                            <p class="p-small">2 Nights</p>
                                                                            <div class="vertical-divider"></div>
                                                                            <p class="p-small">In Riyadh</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex gap-2 pkg-details__accordion-actions">
                                                                            <button class="btn btn-primary btn-sm">
                                                                                <i class="fa-solid fa-pencil"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                    <div id="hotelCollapse"
                                                                        class="accordion-collapse collapse show"
                                                                        aria-labelledby="headingOne"
                                                                        data-bs-parent="#hotelAccordion">
                                                                        <div class="accordion-body">
                                                                            <div
                                                                                class="d-flex align-items-center gap-3">
                                                                                <img src="{{ asset('frontend/assets/transfer.png') }}"
                                                                                    alt="Transfer"
                                                                                    class="img-fluid pkg-details__tr-ht-img">
                                                                                <div>
                                                                                    <div
                                                                                        class="pkg-details__star-ratings">
                                                                                        <i
                                                                                            class="fa-solid fa-star active"></i>
                                                                                        <i
                                                                                            class="fa-solid fa-star active"></i>
                                                                                        <i
                                                                                            class="fa-solid fa-star active"></i>
                                                                                        <i
                                                                                            class="fa-solid fa-star active"></i>
                                                                                        <i class="fa-solid fa-star"></i>
                                                                                    </div>
                                                                                    <p class="fw-600 my-1">Crowne Plaza
                                                                                        Riyadh
                                                                                        Palace
                                                                                    </p>
                                                                                    <p class="p-small text-light2">
                                                                                        <i
                                                                                            class="fa-solid fa-location-dot p-small"></i>
                                                                                        8 October - 10 October, 2 Nights
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="packageDay3" role="tabpanel"
                                                        aria-labelledby="packageDay3">
                                                        <div
                                                            class="pkg-details__day-plan-header pkg-details__common-block">
                                                            <!-- <div class="badge"> Macca</div> -->
                                                            <p class="badge primary-bg">Day 3</p>
                                                            <p class="fw-600">Riyadh</p>
                                                        </div>
                                                        <div
                                                            class="pkg-details__day-plan-content pkg-details__common-block">
                                                            <!-- Flight -->
                                                            <div class="accordion accordion-flush" id="flightAccordion">
                                                                <div
                                                                    class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                                    <div class="accordion-header">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center gap-3">
                                                                            <div
                                                                                class="d-flex align-items-center gap-2">
                                                                                <div class="accordion-icon"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#flightCollapse"
                                                                                    aria-expanded="true"
                                                                                    aria-controls="flightCollapse">
                                                                                    <i
                                                                                        class="fa-solid fa-chevron-down"></i>
                                                                                </div>
                                                                                <p class="p-small fw-600">FLIGHT</p>
                                                                            </div>
                                                                            <div class="vertical-divider"></div>
                                                                            <p class="p-small">New Delhi to Riyadh</p>
                                                                            <div class="vertical-divider"></div>
                                                                            <p class="p-small">08h 30m</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex gap-2 pkg-details__accordion-actions">
                                                                            <button class="btn btn-dark btn-sm">
                                                                                <i class="fa-solid fa-trash-can"></i>
                                                                            </button>
                                                                            <button class="btn btn-primary btn-sm">
                                                                                <i class="fa-solid fa-pencil"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                    <div id="flightCollapse"
                                                                        class="accordion-collapse collapse show"
                                                                        aria-labelledby="headingOne"
                                                                        data-bs-parent="#flightAccordion">
                                                                        <div class="accordion-body">

                                                                            <!-- First Flight Segment -->
                                                                            <div class="pkg-details__flight-segment">
                                                                                <div
                                                                                    class="pkg-details__flight-box flex-shrink-0">
                                                                                    <img src="{{ asset('frontend/assets/airline-logo.png') }}"
                                                                                        alt="Airline Logo" width="50">
                                                                                    <p class="p-small">GF-131</p>
                                                                                </div>

                                                                                <div class="w-100">
                                                                                    <div
                                                                                        class="d-flex justify-content-between align-items-center">
                                                                                        <div class="flex-shrink-0">
                                                                                            <p class="m-0 fw-600">04:55
                                                                                            </p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                Wed, 08
                                                                                                Oct</p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                New Delhi
                                                                                            </p>
                                                                                        </div>

                                                                                        <div
                                                                                            class="pkg-details__flight-duration-block mx-3">
                                                                                            <p
                                                                                                class="p-small pkg-details__flight-duration">
                                                                                                04h 00m</p>
                                                                                            <div
                                                                                                class="pkg-details__flight-point pkg-details__flight-departure flex-center">
                                                                                                <i
                                                                                                    class="fa-solid fa-plane"></i>
                                                                                            </div>
                                                                                            <div
                                                                                                class="pkg-details__flight-connector">
                                                                                            </div>
                                                                                            <div
                                                                                                class="pkg-details__flight-point pkg-details__flight-arrival flex-center">
                                                                                                <i
                                                                                                    class="fa-solid fa-plane"></i>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="flex-shrink-0">
                                                                                            <p class="m-0 fw-600">08:55
                                                                                            </p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                Wed, 08
                                                                                                Oct</p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                New Delhi
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="pkg-details__flight-box pkg-details__baggage-info flex-shrink-0">
                                                                                    <p class="p-small">
                                                                                        <i
                                                                                            class="fa-solid fa-briefcase"></i>
                                                                                        <strong>Cabin:</strong> 6 Kgs
                                                                                    </p>
                                                                                    <p class="p-small">
                                                                                        <i
                                                                                            class="fa-solid fa-suitcase-rolling"></i>
                                                                                        <strong>Check-in:</strong> 35
                                                                                        Kgs
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Layover Section -->
                                                                            <div
                                                                                class="text-center py-2 my-2 rounded p-small pkg-details__layover-info">
                                                                                04h 00m Layover in BAH, Baharain
                                                                            </div>

                                                                            <!-- Second Flight Segment -->
                                                                            <div class="pkg-details__flight-segment">
                                                                                <div
                                                                                    class="pkg-details__flight-box flex-shrink-0">
                                                                                    <img src="{{ asset('frontend/assets/airline-logo.png') }}"
                                                                                        alt="Airline Logo" width="50">
                                                                                    <p class="p-small">GF-131</p>
                                                                                </div>

                                                                                <div class="w-100">
                                                                                    <div
                                                                                        class="d-flex justify-content-between align-items-center">
                                                                                        <div class="flex-shrink-0">
                                                                                            <p class="m-0 fw-600">04:55
                                                                                            </p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                Wed, 08
                                                                                                Oct</p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                New Delhi
                                                                                            </p>
                                                                                        </div>

                                                                                        <div
                                                                                            class="pkg-details__flight-duration-block mx-3">
                                                                                            <p
                                                                                                class="p-small pkg-details__flight-duration">
                                                                                                04h 00m</p>
                                                                                            <div
                                                                                                class="pkg-details__flight-point pkg-details__flight-departure flex-center">
                                                                                                <i
                                                                                                    class="fa-solid fa-plane"></i>
                                                                                            </div>
                                                                                            <div
                                                                                                class="pkg-details__flight-connector">
                                                                                            </div>
                                                                                            <div
                                                                                                class="pkg-details__flight-point pkg-details__flight-arrival flex-center">
                                                                                                <i
                                                                                                    class="fa-solid fa-plane"></i>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="flex-shrink-0">
                                                                                            <p class="m-0 fw-600">08:55
                                                                                            </p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                Wed, 08
                                                                                                Oct</p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                New Delhi
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="pkg-details__flight-box pkg-details__baggage-info flex-shrink-0">
                                                                                    <p class="p-small">
                                                                                        <i
                                                                                            class="fa-solid fa-briefcase"></i>
                                                                                        <strong>Cabin:</strong> 6 Kgs
                                                                                    </p>
                                                                                    <p class="p-small">
                                                                                        <i
                                                                                            class="fa-solid fa-suitcase-rolling"></i>
                                                                                        <strong>Check-in:</strong> 35
                                                                                        Kgs
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="accordion accordion-flush"
                                                                id="transferAccordion">
                                                                <div
                                                                    class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                                    <div class="accordion-header">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center gap-3">
                                                                            <div
                                                                                class="d-flex align-items-center gap-2">
                                                                                <div class="accordion-icon"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#transferCollapse"
                                                                                    aria-expanded="true"
                                                                                    aria-controls="transferCollapse">
                                                                                    <i
                                                                                        class="fa-solid fa-chevron-down"></i>
                                                                                </div>
                                                                                <p class="p-small fw-600">TRANSFER</p>
                                                                            </div>
                                                                            <div class="vertical-divider"></div>
                                                                            <p class="p-small">Airport to hotel in
                                                                                Riyadh</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex gap-2 pkg-details__accordion-actions">
                                                                            <button class="btn btn-dark btn-sm">
                                                                                <i class="fa-solid fa-trash-can"></i>
                                                                            </button>
                                                                            <button class="btn btn-primary btn-sm">
                                                                                <i class="fa-solid fa-pencil"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                    <div id="transferCollapse"
                                                                        class="accordion-collapse collapse show"
                                                                        aria-labelledby="headingOne"
                                                                        data-bs-parent="#transferAccordion">
                                                                        <div class="accordion-body">
                                                                            <div
                                                                                class="d-flex align-items-center gap-3">
                                                                                <img src="{{ asset('frontend/assets/transfer.png') }}"
                                                                                    alt="Transfer"
                                                                                    class="img-fluid pkg-details__tr-ht-img">
                                                                                <div>
                                                                                    <p class="fw-600">Private Transfer
                                                                                    </p>
                                                                                    <p class="p-small text-light2">Pick
                                                                                        up from
                                                                                        Riyadh
                                                                                        International Airport to Riyadh
                                                                                        City
                                                                                        Hotel by
                                                                                        private vehicle</p>
                                                                                    <p class="p-small text-light2 mt-2">
                                                                                        <i
                                                                                            class="fa-solid fa-location-dot p-small"></i>
                                                                                        Airport to Hotel
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="accordion accordion-flush" id="hotelAccordion">
                                                                <div
                                                                    class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                                    <div class="accordion-header">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center gap-3">
                                                                            <div
                                                                                class="d-flex align-items-center gap-2">
                                                                                <div class="accordion-icon"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#hotelCollapse"
                                                                                    aria-expanded="true"
                                                                                    aria-controls="hotelCollapse">
                                                                                    <i
                                                                                        class="fa-solid fa-chevron-down"></i>
                                                                                </div>
                                                                                <p class="p-small fw-600">HOTEL</p>
                                                                            </div>
                                                                            <div class="vertical-divider"></div>
                                                                            <p class="p-small">2 Nights</p>
                                                                            <div class="vertical-divider"></div>
                                                                            <p class="p-small">In Riyadh</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex gap-2 pkg-details__accordion-actions">
                                                                            <button class="btn btn-primary btn-sm">
                                                                                <i class="fa-solid fa-pencil"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                    <div id="hotelCollapse"
                                                                        class="accordion-collapse collapse show"
                                                                        aria-labelledby="headingOne"
                                                                        data-bs-parent="#hotelAccordion">
                                                                        <div class="accordion-body">
                                                                            <div
                                                                                class="d-flex align-items-center gap-3">
                                                                                <img src="{{ asset('frontend/assets/transfer.png') }}"
                                                                                    alt="Transfer"
                                                                                    class="img-fluid pkg-details__tr-ht-img">
                                                                                <div>
                                                                                    <div
                                                                                        class="pkg-details__star-ratings">
                                                                                        <i
                                                                                            class="fa-solid fa-star active"></i>
                                                                                        <i
                                                                                            class="fa-solid fa-star active"></i>
                                                                                        <i
                                                                                            class="fa-solid fa-star active"></i>
                                                                                        <i
                                                                                            class="fa-solid fa-star active"></i>
                                                                                        <i class="fa-solid fa-star"></i>
                                                                                    </div>
                                                                                    <p class="fw-600 my-1">Crowne Plaza
                                                                                        Riyadh
                                                                                        Palace
                                                                                    </p>
                                                                                    <p class="p-small text-light2">
                                                                                        <i
                                                                                            class="fa-solid fa-location-dot p-small"></i>
                                                                                        8 October - 10 October, 2 Nights
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="packageDay4" role="tabpanel"
                                                        aria-labelledby="packageDay4">
                                                        <div
                                                            class="pkg-details__day-plan-header pkg-details__common-block">
                                                            <!-- <div class="badge"> Macca</div> -->
                                                            <p class="badge primary-bg">Day 4</p>
                                                            <p class="fw-600">Riyadh</p>
                                                        </div>
                                                        <div
                                                            class="pkg-details__day-plan-content pkg-details__common-block">
                                                            <!-- Flight -->
                                                            <div class="accordion accordion-flush" id="flightAccordion">
                                                                <div
                                                                    class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                                    <div class="accordion-header">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center gap-3">
                                                                            <div
                                                                                class="d-flex align-items-center gap-2">
                                                                                <div class="accordion-icon"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#flightCollapse"
                                                                                    aria-expanded="true"
                                                                                    aria-controls="flightCollapse">
                                                                                    <i
                                                                                        class="fa-solid fa-chevron-down"></i>
                                                                                </div>
                                                                                <p class="p-small fw-600">FLIGHT</p>
                                                                            </div>
                                                                            <div class="vertical-divider"></div>
                                                                            <p class="p-small">New Delhi to Riyadh</p>
                                                                            <div class="vertical-divider"></div>
                                                                            <p class="p-small">08h 30m</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex gap-2 pkg-details__accordion-actions">
                                                                            <button class="btn btn-dark btn-sm">
                                                                                <i class="fa-solid fa-trash-can"></i>
                                                                            </button>
                                                                            <button class="btn btn-primary btn-sm">
                                                                                <i class="fa-solid fa-pencil"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                    <div id="flightCollapse"
                                                                        class="accordion-collapse collapse show"
                                                                        aria-labelledby="headingOne"
                                                                        data-bs-parent="#flightAccordion">
                                                                        <div class="accordion-body">

                                                                            <!-- First Flight Segment -->
                                                                            <div class="pkg-details__flight-segment">
                                                                                <div
                                                                                    class="pkg-details__flight-box flex-shrink-0">
                                                                                    <img src="{{ asset('frontend/assets/airline-logo.png') }}"
                                                                                        alt="Airline Logo" width="50">
                                                                                    <p class="p-small">GF-131</p>
                                                                                </div>

                                                                                <div class="w-100">
                                                                                    <div
                                                                                        class="d-flex justify-content-between align-items-center">
                                                                                        <div class="flex-shrink-0">
                                                                                            <p class="m-0 fw-600">04:55
                                                                                            </p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                Wed, 08
                                                                                                Oct</p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                New Delhi
                                                                                            </p>
                                                                                        </div>

                                                                                        <div
                                                                                            class="pkg-details__flight-duration-block mx-3">
                                                                                            <p
                                                                                                class="p-small pkg-details__flight-duration">
                                                                                                04h 00m</p>
                                                                                            <div
                                                                                                class="pkg-details__flight-point pkg-details__flight-departure flex-center">
                                                                                                <i
                                                                                                    class="fa-solid fa-plane"></i>
                                                                                            </div>
                                                                                            <div
                                                                                                class="pkg-details__flight-connector">
                                                                                            </div>
                                                                                            <div
                                                                                                class="pkg-details__flight-point pkg-details__flight-arrival flex-center">
                                                                                                <i
                                                                                                    class="fa-solid fa-plane"></i>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="flex-shrink-0">
                                                                                            <p class="m-0 fw-600">08:55
                                                                                            </p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                Wed, 08
                                                                                                Oct</p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                New Delhi
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="pkg-details__flight-box pkg-details__baggage-info flex-shrink-0">
                                                                                    <p class="p-small">
                                                                                        <i
                                                                                            class="fa-solid fa-briefcase"></i>
                                                                                        <strong>Cabin:</strong> 6 Kgs
                                                                                    </p>
                                                                                    <p class="p-small">
                                                                                        <i
                                                                                            class="fa-solid fa-suitcase-rolling"></i>
                                                                                        <strong>Check-in:</strong> 35
                                                                                        Kgs
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Layover Section -->
                                                                            <div
                                                                                class="text-center py-2 my-2 rounded p-small pkg-details__layover-info">
                                                                                04h 00m Layover in BAH, Baharain
                                                                            </div>

                                                                            <!-- Second Flight Segment -->
                                                                            <div class="pkg-details__flight-segment">
                                                                                <div
                                                                                    class="pkg-details__flight-box flex-shrink-0">
                                                                                    <img src="{{ asset('frontend/assets/airline-logo.png') }}"
                                                                                        alt="Airline Logo" width="50">
                                                                                    <p class="p-small">GF-131</p>
                                                                                </div>

                                                                                <div class="w-100">
                                                                                    <div
                                                                                        class="d-flex justify-content-between align-items-center">
                                                                                        <div class="flex-shrink-0">
                                                                                            <p class="m-0 fw-600">04:55
                                                                                            </p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                Wed, 08
                                                                                                Oct</p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                New Delhi
                                                                                            </p>
                                                                                        </div>

                                                                                        <div
                                                                                            class="pkg-details__flight-duration-block mx-3">
                                                                                            <p
                                                                                                class="p-small pkg-details__flight-duration">
                                                                                                04h 00m</p>
                                                                                            <div
                                                                                                class="pkg-details__flight-point pkg-details__flight-departure flex-center">
                                                                                                <i
                                                                                                    class="fa-solid fa-plane"></i>
                                                                                            </div>
                                                                                            <div
                                                                                                class="pkg-details__flight-connector">
                                                                                            </div>
                                                                                            <div
                                                                                                class="pkg-details__flight-point pkg-details__flight-arrival flex-center">
                                                                                                <i
                                                                                                    class="fa-solid fa-plane"></i>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="flex-shrink-0">
                                                                                            <p class="m-0 fw-600">08:55
                                                                                            </p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                Wed, 08
                                                                                                Oct</p>
                                                                                            <p
                                                                                                class="mb-0 text-muted p-small">
                                                                                                New Delhi
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="pkg-details__flight-box pkg-details__baggage-info flex-shrink-0">
                                                                                    <p class="p-small">
                                                                                        <i
                                                                                            class="fa-solid fa-briefcase"></i>
                                                                                        <strong>Cabin:</strong> 6 Kgs
                                                                                    </p>
                                                                                    <p class="p-small">
                                                                                        <i
                                                                                            class="fa-solid fa-suitcase-rolling"></i>
                                                                                        <strong>Check-in:</strong> 35
                                                                                        Kgs
                                                                                    </p>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="accordion accordion-flush"
                                                                id="transferAccordion">
                                                                <div
                                                                    class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                                    <div class="accordion-header">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center gap-3">
                                                                            <div
                                                                                class="d-flex align-items-center gap-2">
                                                                                <div class="accordion-icon"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#transferCollapse"
                                                                                    aria-expanded="true"
                                                                                    aria-controls="transferCollapse">
                                                                                    <i
                                                                                        class="fa-solid fa-chevron-down"></i>
                                                                                </div>
                                                                                <p class="p-small fw-600">TRANSFER</p>
                                                                            </div>
                                                                            <div class="vertical-divider"></div>
                                                                            <p class="p-small">Airport to hotel in
                                                                                Riyadh</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex gap-2 pkg-details__accordion-actions">
                                                                            <button class="btn btn-dark btn-sm">
                                                                                <i class="fa-solid fa-trash-can"></i>
                                                                            </button>
                                                                            <button class="btn btn-primary btn-sm">
                                                                                <i class="fa-solid fa-pencil"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                    <div id="transferCollapse"
                                                                        class="accordion-collapse collapse show"
                                                                        aria-labelledby="headingOne"
                                                                        data-bs-parent="#transferAccordion">
                                                                        <div class="accordion-body">
                                                                            <div
                                                                                class="d-flex align-items-center gap-3">
                                                                                <img src="{{ asset('/frontend/assets/transfer.png') }}"
                                                                                    alt="Transfer"
                                                                                    class="img-fluid pkg-details__tr-ht-img">
                                                                                <div>
                                                                                    <p class="fw-600">Private Transfer
                                                                                    </p>
                                                                                    <p class="p-small text-light2">Pick
                                                                                        up from
                                                                                        Riyadh
                                                                                        International Airport to Riyadh
                                                                                        City
                                                                                        Hotel by
                                                                                        private vehicle</p>
                                                                                    <p class="p-small text-light2 mt-2">
                                                                                        <i
                                                                                            class="fa-solid fa-location-dot p-small"></i>
                                                                                        Airport to Hotel
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="accordion accordion-flush" id="hotelAccordion">
                                                                <div
                                                                    class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                                    <div class="accordion-header">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center gap-3">
                                                                            <div
                                                                                class="d-flex align-items-center gap-2">
                                                                                <div class="accordion-icon"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#hotelCollapse"
                                                                                    aria-expanded="true"
                                                                                    aria-controls="hotelCollapse">
                                                                                    <i
                                                                                        class="fa-solid fa-chevron-down"></i>
                                                                                </div>
                                                                                <p class="p-small fw-600">HOTEL</p>
                                                                            </div>
                                                                            <div class="vertical-divider"></div>
                                                                            <p class="p-small">2 Nights</p>
                                                                            <div class="vertical-divider"></div>
                                                                            <p class="p-small">In Riyadh</p>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex gap-2 pkg-details__accordion-actions">
                                                                            <button class="btn btn-primary btn-sm">
                                                                                <i class="fa-solid fa-pencil"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                    <div id="hotelCollapse"
                                                                        class="accordion-collapse collapse show"
                                                                        aria-labelledby="headingOne"
                                                                        data-bs-parent="#hotelAccordion">
                                                                        <div class="accordion-body">
                                                                            <div
                                                                                class="d-flex align-items-center gap-3">
                                                                                <img src="{{ asset('/frontend/assets/transfer.png') }}"
                                                                                    alt="Transfer"
                                                                                    class="img-fluid pkg-details__tr-ht-img">
                                                                                <div>
                                                                                    <div
                                                                                        class="pkg-details__star-ratings">
                                                                                        <i
                                                                                            class="fa-solid fa-star active"></i>
                                                                                        <i
                                                                                            class="fa-solid fa-star active"></i>
                                                                                        <i
                                                                                            class="fa-solid fa-star active"></i>
                                                                                        <i
                                                                                            class="fa-solid fa-star active"></i>
                                                                                        <i class="fa-solid fa-star"></i>
                                                                                    </div>
                                                                                    <p class="fw-600 my-1">Crowne Plaza
                                                                                        Riyadh
                                                                                        Palace
                                                                                    </p>
                                                                                    <p class="p-small text-light2">
                                                                                        <i
                                                                                            class="fa-solid fa-location-dot p-small"></i>
                                                                                        8 October - 10 October, 2 Nights
                                                                                    </p>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion accordion-flush mt-3 checkout-accordion" id="checkoutCancellation">
                        <div class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                            <div class="accordion-header" data-bs-toggle="collapse"
                                data-bs-target="#checkoutCancellationCollapse" aria-expanded="true"
                                aria-controls="checkoutCancellationCollapse">
                                <div class="d-flex gap-2 pkg-details__accordion-actions">
                                    <p class="fw-600">4. Cancellation & Date Change</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center gap-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="accordion-icon">
                                            <i class="fa-solid fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="checkoutCancellationCollapse" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#checkoutCancellation">
                                <div class="accordion-body">

                                    <!-- Header -->
                                    <div class="mb-3">
                                        <p class="fw-600">Package Cancellation Policy</p>
                                        <p class="p-small text-danger">Cancellation not possible after booking</p>
                                    </div>
                                    <div>
                                        <p class="fw-600">Package Date Change Policy</p>
                                        <p class="p-small text-light2">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                            reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                            officia deserunt mollit anim id est laborum</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3">
                    <div class="card pkg-details__pricing-card checkout-pricing-card">

                        <p class="fw-500 mb-1">Grand Total - 3 Adults</p>
                        <div class="d-flex align-items-center gap-1 mb-2">
                            <img src="{{ asset('/frontend/assets/icons/riyal-primary.svg') }}" alt="Riyal">
                            <h5 class="text-success fw-bold">40,000</h5>
                            <span class="badge primary-bg rounded-pill fw-600">10% OFF</span>
                        </div>
                        <p class="fw-600">Pay Full Amount Now</p>
                        <hr>

                        <p class="fw-600 mb-2">Fare Breakup</p>
                        <div
                            class="pkg-details__additional-info-item p-2 d-flex align-items-start gap-2 mb-2 justify-content-between">
                            <div class="">
                                <p class="fw-600 p-small">Total Basic Cost</p>
                                <p class="p-small text-light2">10,250 x 3 Travellers</p>
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                <img src="{{ asset('/frontend/assets/icons/riyal-light.svg') }}" alt="Riyal">
                                <p class="fw-600 text-light2">60,000</p>
                            </div>
                        </div>

                        <div
                            class="pkg-details__additional-info-item p-2 d-flex align-items-start gap-2 mb-2 justify-content-between">
                            <div class="">
                                <p class="fw-600 p-small">Coupon Discount</p>
                                <p class="p-small text-light2">10,250 x 3 Travellers</p>
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                <img src="{{ asset('/frontend/assets/icons/riyal-light.svg') }}" alt="Riyal">
                                <p class="fw-600 text-light2">60,000</p>
                            </div>
                        </div>

                        <div
                            class="pkg-details__additional-info-item p-2 d-flex align-items-start gap-2 mb-2 justify-content-between">
                            <div class="">
                                <p class="fw-600 p-small">Total Basic Cost:</p>
                                <p class="p-small text-light2">10,250 x 3 Travellers</p>
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                <img src="{{ asset('/frontend/assets/icons/riyal-light.svg') }}" alt="Riyal">
                                <p class="fw-600 text-light2">60,000</p>
                            </div>
                        </div>

                        <div class="mt-3">
                            <p class="fw-600">Important Information</p>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" value="" id="tncCheck">
                                <label class="form-check-label p-micro" for="tncCheck">
                                    I confirm that I have read and I accept
                                    Cancellation Policy, User Agreement, Terms of
                                    Service and Privacy Policy of MakeMyTrip
                                </label>
                            </div>
                            <button class="btn btn-primary rounded-pill w-100 mt-2 justify-content-between">
                                Continue
                                <i class=" fa-solid fa-angles-right"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card pkg-details__pricing-card checkout-pricing-card mt-3">
                        <p class="fw-600">Coupons & Offers</p>
                        <div class="input-group mt-3 package-listing__search-bar checkout-pricing-card__search-bar">
                            <input type="text" class="form-control" placeholder="Enter Coupon Code"
                                aria-label="Browse Package, Location">
                            <button class="btn btn-primary btn-sm rounded-pill p-small" type="button">
                                Apply
                            </button>
                        </div>
                    </div>

                    <div class="checkout-coupon-section mb-3">
                        <div class="checkout-coupon-card d-flex mt-3">
                            <div class="checkout-coupon-left-strip d-flex justify-content-center align-items-center">
                                <p class="checkout-coupon-left-strip-label fw-600">10% OFF</p>
                            </div>
                            <div class="flex-grow-1 p-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="d-flex primary-text p-large gap-1 align-items-center">
                                            <p>-</p>
                                            <img src="{{ asset('/frontend/assets/icons/riyal-primary.svg') }}" alt="Riyal">
                                            <p>35,200</p>
                                        </div>

                                        <h6 class="fw-600 mb-1 p-large">FINFIRST25</h6>
                                    </div>
                                    <div class="checkout-offer-icon">
                                        <img src="{{ asset('/frontend/assets/icons/offer.svg') }}" alt="">
                                    </div>
                                </div>
                                <p class="text-muted p-small mb-3">Grab Your Discount Before It's Gone!</p>
                                <button class="btn apply-btn w-100 rounded-pill">Apply Code</button>
                            </div>
                        </div>
                        <div class="checkout-coupon-card d-flex mt-3">
                            <div class="checkout-coupon-left-strip d-flex justify-content-center align-items-center">
                                <p class="checkout-coupon-left-strip-label fw-600">10% OFF</p>
                            </div>
                            <div class="flex-grow-1 p-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="d-flex primary-text p-large gap-1 align-items-center">
                                            <p>-</p>
                                            <img src="{{ asset('/frontend/assets/icons/riyal-primary.svg') }}" alt="Riyal">
                                            <p>35,200</p>
                                        </div>

                                        <h6 class="fw-600 mb-1 p-large">FINFIRST25</h6>
                                    </div>
                                    <div class="checkout-offer-icon">
                                        <img src="{{ asset('/frontend/assets/icons/offer.svg') }}" alt="">
                                    </div>
                                </div>
                                <p class="text-muted p-small mb-3">Grab Your Discount Before It's Gone!</p>
                                <button class="btn apply-btn w-100 rounded-pill">Apply Code</button>
                            </div>
                        </div>
                        <div class="checkout-coupon-card d-flex mt-3">
                            <div class="checkout-coupon-left-strip d-flex justify-content-center align-items-center">
                                <p class="checkout-coupon-left-strip-label fw-600">10% OFF</p>
                            </div>
                            <div class="flex-grow-1 p-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="d-flex primary-text p-large gap-1 align-items-center">
                                            <p>-</p>
                                            <img src="{{ asset('/frontend/assets/icons/riyal-primary.svg') }}" alt="Riyal">
                                            <p>35,200</p>
                                        </div>

                                        <h6 class="fw-600 mb-1 p-large">FINFIRST25</h6>
                                    </div>
                                    <div class="checkout-offer-icon">
                                        <img src="{{ asset('/frontend/assets/icons/offer.svg') }}" alt="">
                                    </div>
                                </div>
                                <p class="text-muted p-small mb-3">Grab Your Discount Before It's Gone!</p>
                                <button class="btn apply-btn w-100 rounded-pill">Apply Code</button>
                            </div>
                        </div>
                        <div class="mt-3 text-center">
                            <a href="#" class="primary-text">+ 10 More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="travellerModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content traveller-modal">

                <!-- Header -->
                <div class="modal-header">
                    <div>
                        <h6 class="modal-title fw-600 p-large">Add Traveller Details</h6>
                        <p class="text-lihgt2 p-small mb-0">Traveller 2/2</p>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- Traveller Tabs -->
                    <div class="d-flex traveller-tabs gap-3 mb-3 flex-wrap">
                        <button class="btn btn-outline-secondary trav-btn d-flex gap-2 align-items-center active">
                            <div class="trav-btn__icon flex-center">
                                <i class=" fa-solid fa-user"></i>
                            </div>
                            <div>
                                <span class="fw-500">Adult:</span>
                                Traveller 1
                            </div>
                        </button>

                        <button class="btn btn-outline-secondary trav-btn d-flex gap-2 align-items-center">
                            <div class="trav-btn__icon flex-center">
                                <i class=" fa-solid fa-user"></i>
                            </div>
                            <div>
                                <span class="fw-500">Adult:</span>
                                Traveller 2
                            </div>
                        </button>

                        <button class="btn btn-outline-secondary trav-btn d-flex gap-2 align-items-center w-auto">
                            <div class="trav-btn__icon flex-center">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            <div>
                                <span class="fw-500">Add Traveller</span>
                            </div>
                        </button>
                    </div>

                    <!-- Instruction -->
                    <div class="mb-3">
                        <h6 class="fw-600 p">Mandatory Information</h6>
                        <p class="p-small text-light2">
                            <i class="fa-solid fa-circle-info"></i> Please Enter Mandatory Information
                        </p>

                    </div>

                    <!-- Form -->
                    <div class="row g-3">

                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">First Name *</label>
                            <input type="text" class="form-control" placeholder="Enter First Name">
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Last Name *</label>
                            <input type="text" class="form-control" placeholder="Enter Last Name">
                        </div>

                        <div class="col-md-6 col-lg-4 position-relative">
                            <label class="form-label">Date of Birth *</label>
                            <input type="text" class="form-control" placeholder="Select Date">
                            <i class="bi bi-calendar date-icon"></i>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Gender *</label>
                            <select class="form-select">
                                <option>Select</option>
                            </select>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Nationality *</label>
                            <select class="form-select">
                                <option>Select Country</option>
                            </select>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Passport Number *</label>
                            <input type="text" class="form-control" placeholder="Enter Passport Number">
                        </div>

                        <div class="col-md-6 col-lg-4 position-relative">
                            <label class="form-label">Passport Expiry Date *</label>
                            <input type="text" class="form-control" placeholder="Select Date">
                            <i class="bi bi-calendar date-icon"></i>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Passport issuing Country *</label>
                            <select class="form-select">
                                <option>Select country</option>
                            </select>
                        </div>

                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer traveller-footer">
                    <button class="btn btn-outline-secondary px-3 rounded-pill">Cancel</button>
                    <button class="btn btn-success px-3 rounded-pill">Confirm Details</button>
                </div>

            </div>
        </div>
    </div>

    @endsection