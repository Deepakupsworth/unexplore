<div class="user-profile__details-content">
                            <div class="user-profile__details-header white-bg p-3">
                                <p class="p-large fw-600 mb-1">My Bookings</p>
                                <p class="text-light2">Here you can view all your bookings and packages along with their
                                    current status.</p>
                            </div>
                            <div class="white-bg p-3 user-profile__details-body">
                                <div class="user-profile__box white-bg">
                                    <div class="user-profile__details-header px-2 pt-2">
                                        <nav class="user-bookings__nav">
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                                    data-bs-target="#nav-home" type="button" role="tab"
                                                    aria-controls="nav-home" aria-selected="true">Upcoming</button>
                                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                                    data-bs-target="#nav-profile" type="button" role="tab"
                                                    aria-controls="nav-profile" aria-selected="false">Canceled</button>
                                                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                                    data-bs-target="#nav-contact" type="button" role="tab"
                                                    aria-controls="nav-contact" aria-selected="false">Completed</button>
                                            </div>
                                        </nav>
                                    </div>
                                    <div class="p-3">
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                                aria-labelledby="nav-home-tab">
                                                <div class="row gy-3">
                                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                                        <div
                                                            class="exclusive-offers__carousel-item swiper-slide user-bookings__card">
                                                            <div class="exclusive-offers__carousel-item-img">
                                                                <img src="{{ asset('frontend/assets/exclusive-offer.png') }}"
                                                                    alt="Exclusive Offer" class="img-fluid">
                                                                <div class="badge carousel-badge"><i
                                                                        class="fa-solid fa-location-dot"></i> Macca
                                                                </div>
                                                            </div>
                                                            <div class="exclusive-offers__carousel-item-info">
                                                                <div class="d-flex justify-content-between mb-1">
                                                                    <h6 class="fw-bold">Bujairi Terrace</h6>
                                                                    <span
                                                                        class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                                                                </div>
                                                                <p class="text-muted small mb-2">2N Diriyah • 3D Jeddah
                                                                </p>
                                                                <hr>
                                                                <ul class="exclusive-offers__carousel-features-list">
                                                                    <li><span>Round Trip Flights</span></li>
                                                                    <li><span>5 Star Hotels</span></li>
                                                                    <li><span>Airport Transfers</span></li>
                                                                    <li><span>5 Activities</span></li>
                                                                    <li><span>Selected Meals</span></li>
                                                                </ul>

                                                                <!-- Price Box -->
                                                                <div
                                                                    class="exclusive-offers__carousel-price-box ps-0 d-flex justify-content-between">
                                                                    <div
                                                                        class="badge carousel-badge py-2 px-3 rounded-start-0">
                                                                        Upcoming
                                                                    </div>
                                                                    <button href="#"
                                                                        class="btn btn-outline-primary user-bookings__view-details-btn gap-0 px-2 rounded-pill fw-500"
                                                                        data-bs-toggle="offcanvas"
                                                                        data-bs-target="#viewBookingDetailsSideDrawer"
                                                                        aria-controls="sideDrawer">
                                                                        View Details
                                                                        <i class="fa-solid fa-chevron-right"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                                        <div
                                                            class="exclusive-offers__carousel-item swiper-slide user-bookings__card">
                                                            <div class="exclusive-offers__carousel-item-img">
                                                                <img src="{{ asset('frontend/assets/exclusive-offer.png') }}"
                                                                    alt="Exclusive Offer" class="img-fluid">
                                                                <div class="badge carousel-badge"><i
                                                                        class="fa-solid fa-location-dot"></i> Macca
                                                                </div>
                                                            </div>
                                                            <div class="exclusive-offers__carousel-item-info">
                                                                <div class="d-flex justify-content-between mb-1">
                                                                    <h6 class="fw-bold">Bujairi Terrace</h6>
                                                                    <span
                                                                        class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                                                                </div>
                                                                <p class="text-muted small mb-2">2N Diriyah • 3D Jeddah
                                                                </p>
                                                                <hr>
                                                                <ul class="exclusive-offers__carousel-features-list">
                                                                    <li><span>Round Trip Flights</span></li>
                                                                    <li><span>5 Star Hotels</span></li>
                                                                    <li><span>Airport Transfers</span></li>
                                                                    <li><span>5 Activities</span></li>
                                                                    <li><span>Selected Meals</span></li>
                                                                </ul>

                                                                <!-- Price Box -->
                                                                <div
                                                                    class="exclusive-offers__carousel-price-box ps-0 d-flex justify-content-between">
                                                                    <div
                                                                        class="badge carousel-badge py-2 px-3 rounded-start-0 bg-danger">
                                                                        Cancelled
                                                                    </div>
                                                                    <button href="#"
                                                                        class="btn btn-outline-primary user-bookings__view-details-btn gap-0 px-2 rounded-pill fw-500"
                                                                        data-bs-toggle="offcanvas"
                                                                        data-bs-target="#viewBookingDetailsSideDrawer"
                                                                        aria-controls="sideDrawer">
                                                                        View Details
                                                                        <i class="fa-solid fa-chevron-right"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                                        <div
                                                            class="exclusive-offers__carousel-item swiper-slide user-bookings__card">
                                                            <div class="exclusive-offers__carousel-item-img">
                                                                <img src="{{ asset('frontend/assets/exclusive-offer.png') }}"
                                                                    alt="Exclusive Offer" class="img-fluid">
                                                                <div class="badge carousel-badge"><i
                                                                        class="fa-solid fa-location-dot"></i> Macca
                                                                </div>
                                                            </div>
                                                            <div class="exclusive-offers__carousel-item-info">
                                                                <div class="d-flex justify-content-between mb-1">
                                                                    <h6 class="fw-bold">Bujairi Terrace</h6>
                                                                    <span
                                                                        class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                                                                </div>
                                                                <p class="text-muted small mb-2">2N Diriyah • 3D Jeddah
                                                                </p>
                                                                <hr>
                                                                <ul class="exclusive-offers__carousel-features-list">
                                                                    <li><span>Round Trip Flights</span></li>
                                                                    <li><span>5 Star Hotels</span></li>
                                                                    <li><span>Airport Transfers</span></li>
                                                                    <li><span>5 Activities</span></li>
                                                                    <li><span>Selected Meals</span></li>
                                                                </ul>

                                                                <!-- Price Box -->
                                                                <div
                                                                    class="exclusive-offers__carousel-price-box ps-0 d-flex justify-content-between">
                                                                    <div
                                                                        class="badge carousel-badge py-2 px-3 rounded-start-0 bg-dark">
                                                                        Completed
                                                                    </div>
                                                                    <button href="#"
                                                                        class="btn btn-outline-primary user-bookings__view-details-btn gap-0 px-2 rounded-pill fw-500"
                                                                        data-bs-toggle="offcanvas"
                                                                        data-bs-target="#viewBookingDetailsSideDrawer"
                                                                        aria-controls="sideDrawer">
                                                                        View Details
                                                                        <i class="fa-solid fa-chevron-right"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div
                                                    class="d-flex justify-content-between align-items-center pt-3 mt-3">
                                                    <!-- Left text -->
                                                    <span class="text-light3 small">Showing 50 of 569</span>

                                                    <!-- Right pagination info -->
                                                    <div class="d-flex align-items-center gap-3">
                                                        <!-- <button
                                                        class="btn btn-outline-secondary rounded-3">
                                                        <i class="fa-solid fa-chevron-left"></i>
                                                            Prev
                                                        </button> -->
                                                        <span class="text-light2 small">Page 1-5</span>
                                                        <button class="btn btn-outline-secondary rounded-3">
                                                            Next
                                                            <i class="fa-solid fa-chevron-right"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                                aria-labelledby="nav-profile-tab">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div
                                                            class="exclusive-offers__carousel-item swiper-slide user-bookings__card">
                                                            <div class="exclusive-offers__carousel-item-img">
                                                                <img src="{{ asset('frontend/assets/exclusive-offer.png') }}"
                                                                    alt="Exclusive Offer" class="img-fluid">
                                                                <div class="badge carousel-badge"><i
                                                                        class="fa-solid fa-location-dot"></i> Macca
                                                                </div>
                                                            </div>
                                                            <div class="exclusive-offers__carousel-item-info">
                                                                <div class="d-flex justify-content-between mb-1">
                                                                    <h6 class="fw-bold">Bujairi Terrace</h6>
                                                                    <span
                                                                        class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                                                                </div>
                                                                <p class="text-muted small mb-2">2N Diriyah • 3D Jeddah
                                                                </p>
                                                                <hr>
                                                                <ul class="exclusive-offers__carousel-features-list">
                                                                    <li><span>Round Trip Flights</span></li>
                                                                    <li><span>5 Star Hotels</span></li>
                                                                    <li><span>Airport Transfers</span></li>
                                                                    <li><span>5 Activities</span></li>
                                                                    <li><span>Selected Meals</span></li>
                                                                </ul>

                                                                <!-- Price Box -->
                                                                <div
                                                                    class="exclusive-offers__carousel-price-box ps-0 d-flex justify-content-between">
                                                                    <div
                                                                        class="badge carousel-badge py-2 px-3 rounded-start-0">
                                                                        Upcoming
                                                                    </div>
                                                                    <button href="#"
                                                                        class="btn btn-outline-primary user-bookings__view-details-btn gap-0 px-2 rounded-pill fw-500"
                                                                        data-bs-toggle="offcanvas"
                                                                        data-bs-target="#viewBookingDetailsSideDrawer"
                                                                        aria-controls="sideDrawer">
                                                                        View Details
                                                                        <i class="fa-solid fa-chevron-right"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div
                                                            class="exclusive-offers__carousel-item swiper-slide user-bookings__card">
                                                            <div class="exclusive-offers__carousel-item-img">
                                                                <img src="{{ asset('frontend/assets/exclusive-offer.png') }}"
                                                                    alt="Exclusive Offer" class="img-fluid">
                                                                <div class="badge carousel-badge"><i
                                                                        class="fa-solid fa-location-dot"></i> Macca
                                                                </div>
                                                            </div>
                                                            <div class="exclusive-offers__carousel-item-info">
                                                                <div class="d-flex justify-content-between mb-1">
                                                                    <h6 class="fw-bold">Bujairi Terrace</h6>
                                                                    <span
                                                                        class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                                                                </div>
                                                                <p class="text-muted small mb-2">2N Diriyah • 3D Jeddah
                                                                </p>
                                                                <hr>
                                                                <ul class="exclusive-offers__carousel-features-list">
                                                                    <li><span>Round Trip Flights</span></li>
                                                                    <li><span>5 Star Hotels</span></li>
                                                                    <li><span>Airport Transfers</span></li>
                                                                    <li><span>5 Activities</span></li>
                                                                    <li><span>Selected Meals</span></li>
                                                                </ul>

                                                                <!-- Price Box -->
                                                                <div
                                                                    class="exclusive-offers__carousel-price-box ps-0 d-flex justify-content-between">
                                                                    <div
                                                                        class="badge carousel-badge py-2 px-3 rounded-start-0 bg-danger">
                                                                        Cancelled
                                                                    </div>
                                                                    <button href="#"
                                                                        class="btn btn-outline-primary user-bookings__view-details-btn gap-0 px-2 rounded-pill fw-500"
                                                                        data-bs-toggle="offcanvas"
                                                                        data-bs-target="#viewBookingDetailsSideDrawer"
                                                                        aria-controls="sideDrawer">
                                                                        View Details
                                                                        <i class="fa-solid fa-chevron-right"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div
                                                            class="exclusive-offers__carousel-item swiper-slide user-bookings__card">
                                                            <div class="exclusive-offers__carousel-item-img">
                                                                <img src="{{ asset('frontend/assets/exclusive-offer.png') }}"
                                                                    alt="Exclusive Offer" class="img-fluid">
                                                                <div class="badge carousel-badge"><i
                                                                        class="fa-solid fa-location-dot"></i> Macca
                                                                </div>
                                                            </div>
                                                            <div class="exclusive-offers__carousel-item-info">
                                                                <div class="d-flex justify-content-between mb-1">
                                                                    <h6 class="fw-bold">Bujairi Terrace</h6>
                                                                    <span
                                                                        class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                                                                </div>
                                                                <p class="text-muted small mb-2">2N Diriyah • 3D Jeddah
                                                                </p>
                                                                <hr>
                                                                <ul class="exclusive-offers__carousel-features-list">
                                                                    <li><span>Round Trip Flights</span></li>
                                                                    <li><span>5 Star Hotels</span></li>
                                                                    <li><span>Airport Transfers</span></li>
                                                                    <li><span>5 Activities</span></li>
                                                                    <li><span>Selected Meals</span></li>
                                                                </ul>

                                                                <!-- Price Box -->
                                                                <div
                                                                    class="exclusive-offers__carousel-price-box ps-0 d-flex justify-content-between">
                                                                    <div
                                                                        class="badge carousel-badge py-2 px-3 rounded-start-0 bg-dark">
                                                                        Completed
                                                                    </div>
                                                                    <button href="#"
                                                                        class="btn btn-outline-primary user-bookings__view-details-btn gap-0 px-2 rounded-pill fw-500"
                                                                        data-bs-toggle="offcanvas"
                                                                        data-bs-target="#viewBookingDetailsSideDrawer"
                                                                        aria-controls="sideDrawer">
                                                                        View Details
                                                                        <i class="fa-solid fa-chevron-right"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div
                                                    class="d-flex justify-content-between align-items-center pt-3 mt-3">
                                                    <!-- Left text -->
                                                    <span class="text-light3 small">Showing 50 of 569</span>

                                                    <!-- Right pagination info -->
                                                    <div class="d-flex align-items-center gap-3">
                                                        <!-- <button
                                                        class="btn btn-outline-secondary rounded-3">
                                                        <i class="fa-solid fa-chevron-left"></i>
                                                            Prev
                                                        </button> -->
                                                        <span class="text-light2 small">Page 1-5</span>
                                                        <button class="btn btn-outline-secondary rounded-3">
                                                            Next
                                                            <i class="fa-solid fa-chevron-right"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                                aria-labelledby="nav-contact-tab">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div
                                                            class="exclusive-offers__carousel-item swiper-slide user-bookings__card">
                                                            <div class="exclusive-offers__carousel-item-img">
                                                                <img src="{{ asset('frontend/assets/exclusive-offer.png') }}"
                                                                    alt="Exclusive Offer" class="img-fluid">
                                                                <div class="badge carousel-badge"><i
                                                                        class="fa-solid fa-location-dot"></i> Macca
                                                                </div>
                                                            </div>
                                                            <div class="exclusive-offers__carousel-item-info">
                                                                <div class="d-flex justify-content-between mb-1">
                                                                    <h6 class="fw-bold">Bujairi Terrace</h6>
                                                                    <span
                                                                        class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                                                                </div>
                                                                <p class="text-muted small mb-2">2N Diriyah • 3D Jeddah
                                                                </p>
                                                                <hr>
                                                                <ul class="exclusive-offers__carousel-features-list">
                                                                    <li><span>Round Trip Flights</span></li>
                                                                    <li><span>5 Star Hotels</span></li>
                                                                    <li><span>Airport Transfers</span></li>
                                                                    <li><span>5 Activities</span></li>
                                                                    <li><span>Selected Meals</span></li>
                                                                </ul>

                                                                <!-- Price Box -->
                                                                <div
                                                                    class="exclusive-offers__carousel-price-box ps-0 d-flex justify-content-between">
                                                                    <div
                                                                        class="badge carousel-badge py-2 px-3 rounded-start-0">
                                                                        Upcoming
                                                                    </div>
                                                                    <button href="#"
                                                                        class="btn btn-outline-primary user-bookings__view-details-btn gap-0 px-2 rounded-pill fw-500"
                                                                        data-bs-toggle="offcanvas"
                                                                        data-bs-target="#viewBookingDetailsSideDrawer"
                                                                        aria-controls="sideDrawer">
                                                                        View Details
                                                                        <i class="fa-solid fa-chevron-right"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div
                                                            class="exclusive-offers__carousel-item swiper-slide user-bookings__card">
                                                            <div class="exclusive-offers__carousel-item-img">
                                                                <img src="{{ asset('frontend/assets/exclusive-offer.png') }}"
                                                                    alt="Exclusive Offer" class="img-fluid">
                                                                <div class="badge carousel-badge"><i
                                                                        class="fa-solid fa-location-dot"></i> Macca
                                                                </div>
                                                            </div>
                                                            <div class="exclusive-offers__carousel-item-info">
                                                                <div class="d-flex justify-content-between mb-1">
                                                                    <h6 class="fw-bold">Bujairi Terrace</h6>
                                                                    <span
                                                                        class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                                                                </div>
                                                                <p class="text-muted small mb-2">2N Diriyah • 3D Jeddah
                                                                </p>
                                                                <hr>
                                                                <ul class="exclusive-offers__carousel-features-list">
                                                                    <li><span>Round Trip Flights</span></li>
                                                                    <li><span>5 Star Hotels</span></li>
                                                                    <li><span>Airport Transfers</span></li>
                                                                    <li><span>5 Activities</span></li>
                                                                    <li><span>Selected Meals</span></li>
                                                                </ul>

                                                                <!-- Price Box -->
                                                                <div
                                                                    class="exclusive-offers__carousel-price-box ps-0 d-flex justify-content-between">
                                                                    <div
                                                                        class="badge carousel-badge py-2 px-3 rounded-start-0 bg-danger">
                                                                        Cancelled
                                                                    </div>
                                                                    <button href="#"
                                                                        class="btn btn-outline-primary user-bookings__view-details-btn gap-0 px-2 rounded-pill fw-500"
                                                                        data-bs-toggle="offcanvas"
                                                                        data-bs-target="#viewBookingDetailsSideDrawer"
                                                                        aria-controls="sideDrawer">
                                                                        View Details
                                                                        <i class="fa-solid fa-chevron-right"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div
                                                            class="exclusive-offers__carousel-item swiper-slide user-bookings__card">
                                                            <div class="exclusive-offers__carousel-item-img">
                                                                <img src="{{ asset('frontend/assets/exclusive-offer.png') }}"
                                                                    alt="Exclusive Offer" class="img-fluid">
                                                                <div class="badge carousel-badge"><i
                                                                        class="fa-solid fa-location-dot"></i> Macca
                                                                </div>
                                                            </div>
                                                            <div class="exclusive-offers__carousel-item-info">
                                                                <div class="d-flex justify-content-between mb-1">
                                                                    <h6 class="fw-bold">Bujairi Terrace</h6>
                                                                    <span
                                                                        class="badge carousel-badge-outline rounded-pill">2N/3D</span>
                                                                </div>
                                                                <p class="text-muted small mb-2">2N Diriyah • 3D Jeddah
                                                                </p>
                                                                <hr>
                                                                <ul class="exclusive-offers__carousel-features-list">
                                                                    <li><span>Round Trip Flights</span></li>
                                                                    <li><span>5 Star Hotels</span></li>
                                                                    <li><span>Airport Transfers</span></li>
                                                                    <li><span>5 Activities</span></li>
                                                                    <li><span>Selected Meals</span></li>
                                                                </ul>

                                                                <!-- Price Box -->
                                                                <div
                                                                    class="exclusive-offers__carousel-price-box ps-0 d-flex justify-content-between">
                                                                    <div
                                                                        class="badge carousel-badge py-2 px-3 rounded-start-0 bg-dark">
                                                                        Completed
                                                                    </div>
                                                                    <button href="#"
                                                                        class="btn btn-outline-primary user-bookings__view-details-btn gap-0 px-2 rounded-pill fw-500"
                                                                        data-bs-toggle="offcanvas"
                                                                        data-bs-target="#viewBookingDetailsSideDrawer"
                                                                        aria-controls="sideDrawer">
                                                                        View Details
                                                                        <i class="fa-solid fa-chevron-right"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div
                                                    class="d-flex justify-content-between align-items-center pt-3 mt-3">
                                                    <!-- Left text -->
                                                    <span class="text-light3 small">Showing 50 of 569</span>

                                                    <!-- Right pagination info -->
                                                    <div class="d-flex align-items-center gap-3">
                                                        <!-- <button
                                                        class="btn btn-outline-secondary rounded-3">
                                                        <i class="fa-solid fa-chevron-left"></i>
                                                            Prev
                                                        </button> -->
                                                        <span class="text-light2 small">Page 1-5</span>
                                                        <button class="btn btn-outline-secondary rounded-3">
                                                            Next
                                                            <i class="fa-solid fa-chevron-right"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>