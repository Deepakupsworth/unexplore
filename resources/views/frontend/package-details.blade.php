@extends('frontend.layout')
@section('content')

    <section>
        <div class="container">
            <div class="pkg-details__wrapper mb-3">
                <div class="pkg-details">
                    <!-- PACKAGE DETAILS: BANNER -->

                    <div class="pkg-details__banner pkg-details__banner-parent-carousel-wrapper swiper m-0 p-0">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ asset('frontend/assets/package-details-banner.png') }}" alt="Package Details Banner 1"
                                    class="img-fluid w-100">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('frontend/assets/package-banner.png') }}" alt="Package Details Banner 1"
                                    class="img-fluid w-100">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('frontend/assets/about-saudi.png') }}" alt="Package Details Banner 1"
                                    class="img-fluid w-100">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('frontend/assets/adventure1.png') }}" alt="Package Details Banner 1"
                                    class="img-fluid w-100">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('frontend/assets/destination-banner-item.png') }}" alt="Package Details Banner 1"
                                    class="img-fluid w-100">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('frontend/assets/exclusive-offer.png') }}" alt="Package Details Banner 1"
                                    class="img-fluid w-100">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('frontend/assets/explore-destination1.png') }}" alt="Package Details Banner 1"
                                    class="img-fluid w-100">
                            </div>
                        </div>
                        <div class="swiper-button-next pkg-details__banner-next">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                        <div class="swiper-button-prev pkg-details__banner-prev">
                            <i class="fa-solid fa-arrow-left"></i>
                        </div>
                        <div class="pkg-details__banner-carousel-wrapper">
                            <div class="pkg-details__banner-carousel swiper">
                                <div class="swiper-wrapper">
                                    <div class="pkg-details__banner-carousel-item swiper-slide">
                                        <img src="{{ asset('frontend/assets/package-details-banner.png') }}" alt="Package Details Banner 1"
                                            class="img-fluid w-100">
                                    </div>
                                    <div class="pkg-details__banner-carousel-item swiper-slide">
                                        <img src="{{ asset('frontend/assets/package-banner.png') }}" alt="Package Details Banner 2"
                                            class="img-fluid w-100">
                                    </div>
                                    <div class="pkg-details__banner-carousel-item swiper-slide">
                                        <img src="{{ asset('frontend/assets/about-saudi.png') }}" alt="Package Details Banner 3"
                                            class="img-fluid w-100">
                                    </div>
                                    <div class="pkg-details__banner-carousel-item swiper-slide">
                                        <img src="{{ asset('frontend/assets/adventure1.png') }}" alt="Package Details Banner 3"
                                            class="img-fluid w-100">
                                    </div>
                                    <div class="pkg-details__banner-carousel-item swiper-slide">
                                        <img src="{{ asset('frontend/assets/destination-banner-item.png') }}" alt="Package Details Banner 3"
                                            class="img-fluid w-100">
                                    </div>
                                    <div class="pkg-details__banner-carousel-item swiper-slide">
                                        <img src="{{ asset('frontend/assets/exclusive-offer.png') }}" alt="Package Details Banner 3"
                                            class="img-fluid w-100">
                                    </div>
                                    <div class="pkg-details__banner-carousel-item swiper-slide">
                                        <img src="{{ asset('frontend/assets/explore-destination1.png') }}" alt="Package Details Banner 3"
                                            class="img-fluid w-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- PACKAGE DETAILS: HEADER -->
                    <div class="section__header mt-4">
                        <div class="section__header-content">
                            <h2 class="section__heading">Al-Bujairi Heritage Tourist Park</h2>
                            <div class="section__description d-flex gap-2 align-items-center">
                                <p>2N Diriya </p>
                                <div class="dot"></div>
                                <p>3D Jeddah</p>
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-pills mt-3 pkg-details__tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pkg-details__overview-tab" data-bs-toggle="pill"
                                data-bs-target="#explore-saudi__overview-tab-content" type="button" role="tab"
                                aria-controls="explore-saudi__overview-tab-content" aria-selected="true">Overview</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pkg-details__additional-tab" data-bs-toggle="pill"
                                data-bs-target="#explore-saudi__additional-tab-content" type="button" role="tab"
                                aria-controls="explore-saudi__additional-tab-content" aria-selected="false">Additional
                                Info</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active mt-4" id="explore-saudi__overview-tab-content"
                            role="tabpanel" aria-labelledby="pkg-details__overview-tab">
                            <div class="pkg-details__content-wrapper">
                                <div class="pkg-details__day-plan">
                                    <div class="pkg-details__day-plan-left">
                                        <div class="pkg-details__day-plan-header pkg-details__common-block">Day Plan
                                        </div>
                                        <div
                                            class="pkg-details__day-dates pkg-details__common-block d-flex gap-3 flex-column nav nav-tabs">
                                            <div class="pkg-details__day-date-item rounded-pill active"
                                                data-bs-toggle="tab" data-bs-target="#packageDay1" type="button"
                                                role="tab" aria-controls="packageDay1" aria-selected="true">
                                                <div class="dot"></div>
                                                26 Nov, Sun
                                            </div>
                                            <div class="pkg-details__day-date-item rounded-pill" data-bs-toggle="tab"
                                                data-bs-target="#packageDay2" type="button" role="tab"
                                                aria-controls="packageDay2" aria-selected="true">
                                                <div class="dot"></div>
                                                27 Nov, Sun
                                            </div>
                                            <div class="pkg-details__day-date-item rounded-pill" data-bs-toggle="tab"
                                                data-bs-target="#packageDay3" type="button" role="tab"
                                                aria-controls="packageDay3" aria-selected="true">
                                                <div class="dot"></div>
                                                28 Nov, Sun
                                            </div>
                                            <div class="pkg-details__day-date-item rounded-pill" data-bs-toggle="tab"
                                                data-bs-target="#packageDay4" type="button" role="tab"
                                                aria-controls="packageDay4" aria-selected="true">
                                                <div class="dot"></div>
                                                29 Nov, Sun
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pkg-details__day-plan-right">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="packageDay1" role="tabpanel"
                                                aria-labelledby="packageDay1">
                                                <div class="pkg-details__day-plan-header pkg-details__common-block">
                                                    <!-- <div class="badge"> Macca</div> -->
                                                    <p class="badge primary-bg">Day 1</p>
                                                    <p class="fw-600">Riyadh</p>
                                                </div>
                                                <div class="pkg-details__day-plan-content pkg-details__common-block">
                                                    <!-- Flight -->
                                                    <div class="accordion accordion-flush" id="flightAccordion">
                                                        <div
                                                            class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                            <div class="accordion-header">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-3">
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <div class="accordion-icon"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#flightCollapse"
                                                                            aria-expanded="true"
                                                                            aria-controls="flightCollapse">
                                                                            <i class="fa-solid fa-chevron-down"></i>
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
                                                                                    <p class="m-0 fw-600">04:55</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        Wed, 08
                                                                                        Oct</p>
                                                                                    <p class="mb-0 text-muted p-small">
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
                                                                                    <p class="m-0 fw-600">08:55</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        Wed, 08
                                                                                        Oct</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        New Delhi
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div
                                                                            class="pkg-details__flight-box pkg-details__baggage-info flex-shrink-0">
                                                                            <p class="p-small">
                                                                                <i class="fa-solid fa-briefcase"></i>
                                                                                <strong>Cabin:</strong> 6 Kgs
                                                                            </p>
                                                                            <p class="p-small">
                                                                                <i
                                                                                    class="fa-solid fa-suitcase-rolling"></i>
                                                                                <strong>Check-in:</strong> 35 Kgs
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
                                                                                    <p class="m-0 fw-600">04:55</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        Wed, 08
                                                                                        Oct</p>
                                                                                    <p class="mb-0 text-muted p-small">
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
                                                                                    <p class="m-0 fw-600">08:55</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        Wed, 08
                                                                                        Oct</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        New Delhi
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div
                                                                            class="pkg-details__flight-box pkg-details__baggage-info flex-shrink-0">
                                                                            <p class="p-small">
                                                                                <i class="fa-solid fa-briefcase"></i>
                                                                                <strong>Cabin:</strong> 6 Kgs
                                                                            </p>
                                                                            <p class="p-small">
                                                                                <i
                                                                                    class="fa-solid fa-suitcase-rolling"></i>
                                                                                <strong>Check-in:</strong> 35 Kgs
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion accordion-flush" id="transferAccordion">
                                                        <div
                                                            class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                            <div class="accordion-header">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-3">
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <div class="accordion-icon"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#transferCollapse"
                                                                            aria-expanded="true"
                                                                            aria-controls="transferCollapse">
                                                                            <i class="fa-solid fa-chevron-down"></i>
                                                                        </div>
                                                                        <p class="p-small fw-600">TRANSFER</p>
                                                                    </div>
                                                                    <div class="vertical-divider"></div>
                                                                    <p class="p-small">Airport to hotel in Riyadh</p>
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
                                                                    <div class="d-flex align-items-center gap-3">
                                                                        <img src="{{ asset('frontend/assets/transfer.png') }}" alt="Transfer"
                                                                            class="img-fluid pkg-details__tr-ht-img">
                                                                        <div>
                                                                            <p class="fw-600">Private Transfer</p>
                                                                            <p class="p-small text-light2">Pick up from
                                                                                Riyadh
                                                                                International Airport to Riyadh City
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
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <div class="accordion-icon"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#hotelCollapse"
                                                                            aria-expanded="true"
                                                                            aria-controls="hotelCollapse">
                                                                            <i class="fa-solid fa-chevron-down"></i>
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
                                                                    <div class="d-flex align-items-center gap-3">
                                                                        <img src="{{ asset('frontend/assets/transfer.png') }}" alt="Transfer"
                                                                            class="img-fluid pkg-details__tr-ht-img">
                                                                        <div>
                                                                            <div class="pkg-details__star-ratings">
                                                                                <i class="fa-solid fa-star active"></i>
                                                                                <i class="fa-solid fa-star active"></i>
                                                                                <i class="fa-solid fa-star active"></i>
                                                                                <i class="fa-solid fa-star active"></i>
                                                                                <i class="fa-solid fa-star"></i>
                                                                            </div>
                                                                            <p class="fw-600 my-1">Crowne Plaza Riyadh
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
                                                <div class="pkg-details__day-plan-header pkg-details__common-block">
                                                    <!-- <div class="badge"> Macca</div> -->
                                                    <p class="badge primary-bg">Day 2</p>
                                                    <p class="fw-600">Riyadh</p>
                                                </div>
                                                <div class="pkg-details__day-plan-content pkg-details__common-block">
                                                    <!-- Flight -->
                                                    <div class="accordion accordion-flush" id="flightAccordion">
                                                        <div
                                                            class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                            <div class="accordion-header">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-3">
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <div class="accordion-icon"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#flightCollapse"
                                                                            aria-expanded="true"
                                                                            aria-controls="flightCollapse">
                                                                            <i class="fa-solid fa-chevron-down"></i>
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
                                                                                    <p class="m-0 fw-600">04:55</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        Wed, 08
                                                                                        Oct</p>
                                                                                    <p class="mb-0 text-muted p-small">
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
                                                                                    <p class="m-0 fw-600">08:55</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        Wed, 08
                                                                                        Oct</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        New Delhi
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div
                                                                            class="pkg-details__flight-box pkg-details__baggage-info flex-shrink-0">
                                                                            <p class="p-small">
                                                                                <i class="fa-solid fa-briefcase"></i>
                                                                                <strong>Cabin:</strong> 6 Kgs
                                                                            </p>
                                                                            <p class="p-small">
                                                                                <i
                                                                                    class="fa-solid fa-suitcase-rolling"></i>
                                                                                <strong>Check-in:</strong> 35 Kgs
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
                                                                                    <p class="m-0 fw-600">04:55</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        Wed, 08
                                                                                        Oct</p>
                                                                                    <p class="mb-0 text-muted p-small">
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
                                                                                    <p class="m-0 fw-600">08:55</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        Wed, 08
                                                                                        Oct</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        New Delhi
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div
                                                                            class="pkg-details__flight-box pkg-details__baggage-info flex-shrink-0">
                                                                            <p class="p-small">
                                                                                <i class="fa-solid fa-briefcase"></i>
                                                                                <strong>Cabin:</strong> 6 Kgs
                                                                            </p>
                                                                            <p class="p-small">
                                                                                <i
                                                                                    class="fa-solid fa-suitcase-rolling"></i>
                                                                                <strong>Check-in:</strong> 35 Kgs
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion accordion-flush" id="transferAccordion">
                                                        <div
                                                            class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                            <div class="accordion-header">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-3">
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <div class="accordion-icon"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#transferCollapse"
                                                                            aria-expanded="true"
                                                                            aria-controls="transferCollapse">
                                                                            <i class="fa-solid fa-chevron-down"></i>
                                                                        </div>
                                                                        <p class="p-small fw-600">TRANSFER</p>
                                                                    </div>
                                                                    <div class="vertical-divider"></div>
                                                                    <p class="p-small">Airport to hotel in Riyadh</p>
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
                                                                    <div class="d-flex align-items-center gap-3">
                                                                        <img src="{{ asset('frontend/assets/transfer.png') }}" alt="Transfer"
                                                                            class="img-fluid pkg-details__tr-ht-img">
                                                                        <div>
                                                                            <p class="fw-600">Private Transfer</p>
                                                                            <p class="p-small text-light2">Pick up from
                                                                                Riyadh
                                                                                International Airport to Riyadh City
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
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <div class="accordion-icon"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#hotelCollapse"
                                                                            aria-expanded="true"
                                                                            aria-controls="hotelCollapse">
                                                                            <i class="fa-solid fa-chevron-down"></i>
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
                                                                    <div class="d-flex align-items-center gap-3">
                                                                        <img src="{{ asset('frontend/assets/transfer.png') }}" alt="Transfer"
                                                                            class="img-fluid pkg-details__tr-ht-img">
                                                                        <div>
                                                                            <div class="pkg-details__star-ratings">
                                                                                <i class="fa-solid fa-star active"></i>
                                                                                <i class="fa-solid fa-star active"></i>
                                                                                <i class="fa-solid fa-star active"></i>
                                                                                <i class="fa-solid fa-star active"></i>
                                                                                <i class="fa-solid fa-star"></i>
                                                                            </div>
                                                                            <p class="fw-600 my-1">Crowne Plaza Riyadh
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
                                                <div class="pkg-details__day-plan-header pkg-details__common-block">
                                                    <!-- <div class="badge"> Macca</div> -->
                                                    <p class="badge primary-bg">Day 3</p>
                                                    <p class="fw-600">Riyadh</p>
                                                </div>
                                                <div class="pkg-details__day-plan-content pkg-details__common-block">
                                                    <!-- Flight -->
                                                    <div class="accordion accordion-flush" id="flightAccordion">
                                                        <div
                                                            class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                            <div class="accordion-header">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-3">
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <div class="accordion-icon"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#flightCollapse"
                                                                            aria-expanded="true"
                                                                            aria-controls="flightCollapse">
                                                                            <i class="fa-solid fa-chevron-down"></i>
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
                                                                                    <p class="m-0 fw-600">04:55</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        Wed, 08
                                                                                        Oct</p>
                                                                                    <p class="mb-0 text-muted p-small">
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
                                                                                    <p class="m-0 fw-600">08:55</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        Wed, 08
                                                                                        Oct</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        New Delhi
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div
                                                                            class="pkg-details__flight-box pkg-details__baggage-info flex-shrink-0">
                                                                            <p class="p-small">
                                                                                <i class="fa-solid fa-briefcase"></i>
                                                                                <strong>Cabin:</strong> 6 Kgs
                                                                            </p>
                                                                            <p class="p-small">
                                                                                <i
                                                                                    class="fa-solid fa-suitcase-rolling"></i>
                                                                                <strong>Check-in:</strong> 35 Kgs
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
                                                                                    <p class="m-0 fw-600">04:55</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        Wed, 08
                                                                                        Oct</p>
                                                                                    <p class="mb-0 text-muted p-small">
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
                                                                                    <p class="m-0 fw-600">08:55</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        Wed, 08
                                                                                        Oct</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        New Delhi
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div
                                                                            class="pkg-details__flight-box pkg-details__baggage-info flex-shrink-0">
                                                                            <p class="p-small">
                                                                                <i class="fa-solid fa-briefcase"></i>
                                                                                <strong>Cabin:</strong> 6 Kgs
                                                                            </p>
                                                                            <p class="p-small">
                                                                                <i
                                                                                    class="fa-solid fa-suitcase-rolling"></i>
                                                                                <strong>Check-in:</strong> 35 Kgs
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion accordion-flush" id="transferAccordion">
                                                        <div
                                                            class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                            <div class="accordion-header">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-3">
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <div class="accordion-icon"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#transferCollapse"
                                                                            aria-expanded="true"
                                                                            aria-controls="transferCollapse">
                                                                            <i class="fa-solid fa-chevron-down"></i>
                                                                        </div>
                                                                        <p class="p-small fw-600">TRANSFER</p>
                                                                    </div>
                                                                    <div class="vertical-divider"></div>
                                                                    <p class="p-small">Airport to hotel in Riyadh</p>
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
                                                                    <div class="d-flex align-items-center gap-3">
                                                                        <img src="{{ asset('frontend/assets/transfer.png') }}" alt="Transfer"
                                                                            class="img-fluid pkg-details__tr-ht-img">
                                                                        <div>
                                                                            <p class="fw-600">Private Transfer</p>
                                                                            <p class="p-small text-light2">Pick up from
                                                                                Riyadh
                                                                                International Airport to Riyadh City
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
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <div class="accordion-icon"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#hotelCollapse"
                                                                            aria-expanded="true"
                                                                            aria-controls="hotelCollapse">
                                                                            <i class="fa-solid fa-chevron-down"></i>
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
                                                                    <div class="d-flex align-items-center gap-3">
                                                                        <img src="{{ asset('frontend/assets/transfer.png') }}" alt="Transfer"
                                                                            class="img-fluid pkg-details__tr-ht-img">
                                                                        <div>
                                                                            <div class="pkg-details__star-ratings">
                                                                                <i class="fa-solid fa-star active"></i>
                                                                                <i class="fa-solid fa-star active"></i>
                                                                                <i class="fa-solid fa-star active"></i>
                                                                                <i class="fa-solid fa-star active"></i>
                                                                                <i class="fa-solid fa-star"></i>
                                                                            </div>
                                                                            <p class="fw-600 my-1">Crowne Plaza Riyadh
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
                                                <div class="pkg-details__day-plan-header pkg-details__common-block">
                                                    <!-- <div class="badge"> Macca</div> -->
                                                    <p class="badge primary-bg">Day 4</p>
                                                    <p class="fw-600">Riyadh</p>
                                                </div>
                                                <div class="pkg-details__day-plan-content pkg-details__common-block">
                                                    <!-- Flight -->
                                                    <div class="accordion accordion-flush" id="flightAccordion">
                                                        <div
                                                            class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                            <div class="accordion-header">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-3">
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <div class="accordion-icon"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#flightCollapse"
                                                                            aria-expanded="true"
                                                                            aria-controls="flightCollapse">
                                                                            <i class="fa-solid fa-chevron-down"></i>
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
                                                                                    <p class="m-0 fw-600">04:55</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        Wed, 08
                                                                                        Oct</p>
                                                                                    <p class="mb-0 text-muted p-small">
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
                                                                                    <p class="m-0 fw-600">08:55</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        Wed, 08
                                                                                        Oct</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        New Delhi
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div
                                                                            class="pkg-details__flight-box pkg-details__baggage-info flex-shrink-0">
                                                                            <p class="p-small">
                                                                                <i class="fa-solid fa-briefcase"></i>
                                                                                <strong>Cabin:</strong> 6 Kgs
                                                                            </p>
                                                                            <p class="p-small">
                                                                                <i
                                                                                    class="fa-solid fa-suitcase-rolling"></i>
                                                                                <strong>Check-in:</strong> 35 Kgs
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
                                                                                    <p class="m-0 fw-600">04:55</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        Wed, 08
                                                                                        Oct</p>
                                                                                    <p class="mb-0 text-muted p-small">
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
                                                                                    <p class="m-0 fw-600">08:55</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        Wed, 08
                                                                                        Oct</p>
                                                                                    <p class="mb-0 text-muted p-small">
                                                                                        New Delhi
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div
                                                                            class="pkg-details__flight-box pkg-details__baggage-info flex-shrink-0">
                                                                            <p class="p-small">
                                                                                <i class="fa-solid fa-briefcase"></i>
                                                                                <strong>Cabin:</strong> 6 Kgs
                                                                            </p>
                                                                            <p class="p-small">
                                                                                <i
                                                                                    class="fa-solid fa-suitcase-rolling"></i>
                                                                                <strong>Check-in:</strong> 35 Kgs
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion accordion-flush" id="transferAccordion">
                                                        <div
                                                            class="accordion-item border rounded mb-3 pkg-details__accordion-item">
                                                            <div class="accordion-header">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-3">
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <div class="accordion-icon"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#transferCollapse"
                                                                            aria-expanded="true"
                                                                            aria-controls="transferCollapse">
                                                                            <i class="fa-solid fa-chevron-down"></i>
                                                                        </div>
                                                                        <p class="p-small fw-600">TRANSFER</p>
                                                                    </div>
                                                                    <div class="vertical-divider"></div>
                                                                    <p class="p-small">Airport to hotel in Riyadh</p>
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
                                                                    <div class="d-flex align-items-center gap-3">
                                                                        <img src="{{ asset('frontend/assets/transfer.png') }}" alt="Transfer"
                                                                            class="img-fluid pkg-details__tr-ht-img">
                                                                        <div>
                                                                            <p class="fw-600">Private Transfer</p>
                                                                            <p class="p-small text-light2">Pick up from
                                                                                Riyadh
                                                                                International Airport to Riyadh City
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
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <div class="accordion-icon"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#hotelCollapse"
                                                                            aria-expanded="true"
                                                                            aria-controls="hotelCollapse">
                                                                            <i class="fa-solid fa-chevron-down"></i>
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
                                                                    <div class="d-flex align-items-center gap-3">
                                                                        <img src="{{ asset('frontend/assets/transfer.png') }}" alt="Transfer"
                                                                            class="img-fluid pkg-details__tr-ht-img">
                                                                        <div>
                                                                            <div class="pkg-details__star-ratings">
                                                                                <i class="fa-solid fa-star active"></i>
                                                                                <i class="fa-solid fa-star active"></i>
                                                                                <i class="fa-solid fa-star active"></i>
                                                                                <i class="fa-solid fa-star active"></i>
                                                                                <i class="fa-solid fa-star"></i>
                                                                            </div>
                                                                            <p class="fw-600 my-1">Crowne Plaza Riyadh
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

                            <div class="pkg-details__content-wrapper mt-4">
                                <p class="p-large fw-bold">Overview</p>
                                <ul class="mt-1 ps-4 text-light2">
                                    <li>Immerse in the breathtaking beauty and rich heritage of Abha with a three-day
                                        Saudi Arabia tour</li>
                                    <li>Explore key attractions like Al Dabab Walkway, Historic Green Mountain & Ottoman
                                        Bridge on a full-day city tour.</li>
                                    <li>Discover Abha's oldest neighborhood, Al Basta, and the cultural hub of Al
                                        Muftaha village, known for art, history, and local crafts.</li>
                                    <li>Venture to Mount Soudah and Rijal Almaa and indulge in hiking, bird watching and
                                        adventure activities.</li>
                                    <li>Delve into the traditions of Bani Mazen Coffee Farms, known for their family
                                        legacy of coffee growing.</li>
                                    <li>Guided tours, hotel stays and breakfast are included.</li>
                                    <li>Visa fees and personal expenses are not included.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="explore-saudi__additional-tab-content" role="tabpanel"
                            aria-labelledby="pkg-details__additional-tab">
                            <div class="pkg-details__content-wrapper mt-4">
                                <p class="p-large fw-bold">Additional Info</p>
                                <div class="pkg-details__additional-info mt-3">
                                    <div class="pkg-details__additional-info-item">
                                        <p class="fw-bold pkg-details__additional-info-item-header">Travel Validity</p>
                                        <ul class="pkg-details__additional-info-item-list m-0">
                                            <li>The deal is valid for travel till 30th September 2025.</li>
                                        </ul>
                                    </div>
                                    <div class="pkg-details__additional-info-item">
                                        <p class="fw-bold pkg-details__additional-info-item-header">Easy Cancellation
                                        </p>
                                        <ul class="pkg-details__additional-info-item-list m-0">
                                            <li>* 31 and More Days prior to the Departure Date: Booking Amount is
                                                Non-Refundable. * 30 to 16 Days prior to the Departure Date: 75% of the
                                                full Tour cost. * 15 Days prior to the Departure Date: 100% of the full
                                                Tour cost.</li>
                                        </ul>
                                    </div>
                                    <div class="pkg-details__additional-info-item">
                                        <p class="fw-bold pkg-details__additional-info-item-header">Guaranteed Dates</p>
                                        <ul class="pkg-details__additional-info-item-list m-0">
                                            <li>The</li>
                                        </ul>
                                    </div>
                                    <div class="pkg-details__additional-info-item">
                                        <p class="fw-bold pkg-details__additional-info-item-header">Travel</p>
                                        <ul class="pkg-details__additional-info-item-list m-0">
                                            <li>Your selected travel dates are guaranteed. In the unlikely event of
                                                seats sold out, we guarantee +/- 1/2 days from your preferred dates.
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="pkg-details__additional-info-item">
                                        <p class="fw-bold pkg-details__additional-info-item-header">High Season</p>
                                        <ul class="pkg-details__additional-info-item-list m-0">
                                            <li>Prices can fluctuate during peak season dates.</li>
                                        </ul>
                                    </div>
                                    <div class="pkg-details__additional-info-item">
                                        <p class="fw-bold pkg-details__additional-info-item-header">Visa Easy</p>
                                        <ul class="pkg-details__additional-info-item-list m-0">
                                            <li>Visa assistance will be provided by our visa specialists.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pkg-details__pricing">
                    <div class="card pkg-details__pricing-card">

                        <p class="fw-500">Starting from</p>
                        <div class="d-flex align-items-center gap-1">
                            <img src="{{ asset('frontend/assets/icons/riyal-light.svg') }}" alt="Riyal">
                            <p class="text-decoration-line-through fw-600 text-light2">60,000</p>
                        </div>

                        <div class="d-flex align-items-center gap-1">
                            <img src="{{ asset('frontend/assets/icons/riyal-primary.svg') }}" alt="Riyal">
                            <h5 class="text-success fw-bold">40,000</h5>
                            <p class="text-light2 fw-500">Per Person</p>
                        </div>

                        <button class="btn btn-primary justify-content-center pkg-details__book-now-btn my-2">
                            Book Now
                        </button>

                        <div class="fw-500 text-light2 d-flex align-items-center gap-1">
                            <p>Total Price: </p>
                            <img src="{{ asset('frontend/assets/icons/riyal-light.svg') }}" alt="Riyal">
                            <p>1,22,100</p>
                        </div>

                        <!-- Decorative line -->
                        <div class="pkg-details__decorative-line my-3">
                            <img src="{{ asset('frontend/assets/decorative-line.png') }}" alt="Decorative Line" class="img-fluid w-100">
                        </div>

                        <!-- Duration -->
                        <div class="pkg-details__additional-info-item py-2 px-3 d-flex align-items-center gap-2 mb-2">
                            <i class="fa-solid fa-clock primary-text"></i>
                            <div class="">
                                <p class="text-light2">Duration:</p>
                                <p class="fw-600 p-large">2 Nights & 3 Days</p>
                            </div>
                        </div>

                        <!-- Places to Visit -->
                        <div class="pkg-details__additional-info-item py-2 px-3 d-flex align-items-center gap-2 mt-2">
                            <i class="fa-solid fa-location-dot primary-text"></i>
                            <div class="">
                                <p class="text-light2">Places to Visit:</p>
                                <p class="fw-600 p-large">2N Bujairi</p>
                            </div>
                        </div>
                    </div>

                    <div class="card pkg-details__pricing-card mt-3">
                        <p class="p-large">Do you have questions or need more information?</p>
                        <button
                            class="btn btn-outline-secondary rounded-pill fw-600 mt-3 pkg-details__get-more-help-btn">
                            Get More Help
                        </button>
                    </div>

                    <div class="mt-4">
                        <p>Share</p>
                        <div class="mt-2 pkg-details__share-icons">
                            
                            <x-share-links a-class="flex-center" icon-size="icon-sm" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
