@extends('frontend.layout')
@section('content')

    <!-- 1. PACKAGE LISTING BANNER -->
    <section class="user-profile__banner">
        <div class="container">
            <div class="user-profile__banner-content text-center">
                <h1 class="text-white mb-3 h2">User Profile</h1>
                <div
                    class="banner-breadcrumb rounded-pill d-flex align-items-center justify-content-center gap-3 p-small">
                    <a href="#" class="">
                        <i class="fa-solid fa-house"></i>
                        Home
                    </a>
                    <span><i class="fa-solid fa-angles-right"></i></span>
                    <span class="active">Profile</span>
                </div>
            </div>
        </div>
    </section>

    <section class="user-profile__section">
        <div class="container">
            <div class="user-profile__content">
                <div class="user-profile__menu p-3">
                    <ul class="nav nav-tabs list-unstyled m-0 p-0 d-flex flex-column gap-2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#user-dashboard"
                                type="button" role="tab" aria-controls="dashboard">
                                <i class="fa-solid fa-house p-large"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active" data-bs-toggle="tab" data-bs-target="#user-profile"
                                type="button" role="tab" aria-controls="profile">
                                <i class="fa-solid fa-circle-user p-large"></i>
                                Profile
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link" data-bs-toggle="tab" data-bs-target="#user-bookings"
                                type="button" role="tab" aria-controls="bookings">
                                <i class="fa-solid fa-circle-user p-large"></i>
                                Bookings
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link" data-bs-toggle="tab" data-bs-target="#user-addresses"
                                type="button" role="tab" aria-controls="addresses">
                                <i class="fa-solid fa-circle-user p-large"></i>
                                Manage Address
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link" data-bs-toggle="tab" data-bs-target="#user-wishlist"
                                type="button" role="tab" aria-controls="wishlist">
                                <i class="fa-solid fa-heart p-large"></i>
                                My Wishlist
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="w-100 tab-content">
                    <!-- User Profile -->
                    <div class="tab-pane fade user-profile__details user-profile__box p-3" id="user-profile"
                        role="tabpanel">
                        <div class="user-profile__details-content">
                            <div class="user-profile__details-header white-bg p-3">
                                <p class="p-large fw-600 mb-1">Profile</p>
                                <p class="text-light2">Update your avatar and personal information</p>
                            </div>
                            <form  method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">

                            <div class="user-profile__details-body white-bg p-3">
                                        @csrf    
                                <div class="user-profile__details-form user-profile__box p-3 white-bg">
                                    <p class="fw-600 mb-1">Personal Information</p>
                                    <p class="text-light2 p-small">Update your personal details and contact information
                                    </p>

                                    <div class="mt-4">
                                        
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="userDetailFirstName" class="form-label">
                                                        First Name
                                                    </label>
                                                    <input type="text" class="form-control" id="userDetailFirstName"
                                                        aria-describedby="firstName" name="first_name" value="{{ $user->first_name }}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="userDetailLastName" class="form-label">
                                                        Last Name
                                                    </label>
                                                    <input type="text" class="form-control" id="userDetailLastName"
                                                        aria-describedby="lastName" name="last_name" value="{{ $user->last_name }}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="userDetailEmail" class="form-label">
                                                        Email Address
                                                    </label>
                                                    <div class="input-group custom-input-group mb-3">
                                                        <span class="input-group-text">
                                                            <i class="fa-solid fa-envelope"></i>
                                                        </span>
                                                        <input id="userDetailEmail" type="text" class="form-control"
                                                            aria-label="Email" name="email" value="{{ $user->last_name }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="phone" class="form-label fw-semibold">Phone
                                                            Number</label>

                                                        <div class="input-group phone-input">
                                                            <!-- Country selector -->
                                                            <!-- <button
                                                                class="btn btn-outline-secondary form-dropdown-toggle d-flex align-items-center gap-1"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <img src="https://flagcdn.com/w20/sa.png"
                                                                    alt="Saudi Arabia" class="rounded-circle" width="20"
                                                                    height="20">
                                                                <span>+1</span>
                                                                <i class="fa-solid fa-chevron-down p-small"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item d-flex align-items-center"
                                                                        href="#">
                                                                        <img src="https://flagcdn.com/w20/sa.png"
                                                                            class="me-2 rounded-circle">
                                                                        +966 Saudi Arabia
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item d-flex align-items-center"
                                                                        href="#">
                                                                        <img src="https://flagcdn.com/w20/in.png"
                                                                            class="me-2 rounded-circle">
                                                                        +91 India
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item d-flex align-items-center"
                                                                        href="#">
                                                                        <img src="https://flagcdn.com/w20/us.png"
                                                                            class="me-2 rounded-circle">
                                                                        +1 United States
                                                                    </a>
                                                                </li>
                                                            </ul> -->

                                                            <!-- Phone number input -->
                                                            <input type="phone" class="form-control border-start-0"
                                                                id="phone" name="phone" placeholder="+1 (212) 555-9876" value="{{$user->phone ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div>
                                                <label for="userDetailAddress" class="form-label">
                                                    Address
                                                </label>
                                                <div class="input-group custom-input-group mb-3">
                                                    <span class="input-group-text">
                                                        <i class="fa-solid fa-location-dot"></i>
                                                    </span>
                                                    <input type="text" class="form-control" aria-label="Address"
                                                        id="userDetailAddress" placeholder="Saudi, Riyadh">
                                                </div>
                                            </div> -->

                                            <!-- <div class="row mb-3">
                                                <div class="col-sm-6">
                                                    <label for="userDetailFullName" class="form-label">
                                                        Timezone
                                                    </label>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>(GMT+2:00) Saudi</option>
                                                        <option value="Saudi">(GMT+2:00) Saudi</option>
                                                        <option value="Saudi">(GMT+2:00) Saudi</option>
                                                        <option value="Saudi">(GMT+2:00) Saudi</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="userDetailEmail" class="form-label">
                                                        Language
                                                    </label>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>English</option>
                                                        <option value="English">English</option>
                                                        <option value="English">English</option>
                                                        <option value="English">English</option>
                                                    </select>
                                                </div>
                                            </div> -->

                                            <!-- <div>
                                                <label for="userDetailBio" class="form-label">
                                                    Bio
                                                </label>
                                                <textarea class="form-control" id="userDetailBio" rows="3"
                                                    placeholder="Tell us a bit about yourself..."></textarea>
                                                <small class="text-light2 p-micro">Brief description for your profile.
                                                    Max
                                                    280 characters.</small>
                                            </div> -->
                                  
                                    </div>

                                </div>
                                <div class="user-profile__details-avatar user-profile__box p-3 white-bg">
                                    <p class="p-large fw-600 mb-1">Profile Picture</p>
                                    <p class="text-light2 p-small">Update your avatar</p>

                                    <div>
                                        <!-- If user image is there -->
                                        <div class="user-profile__avatar my-4">
                                        <img
                                                src="{{ $profileImage
                                                    ? asset('storage/'.$profileImage->image_path)
                                                    : asset('frontend/assets/user.jpeg') }}"
                                                alt="User"
                                                class="rounded-circle">                                           
                                        </div>
                                        <!-- If user image is not there, will show user initials
                                        <div class="user-profile__initials flex-center rounded-circle my-4">
                                            <h6>NS</h6>
                                        </div> -->
                                    </div>

                                    <div>
                                        <div class="d-flex align-items-center mb-2 justify-space-between gap-2">
                                            <!-- Hidden file input -->

                                            <!-- Upload button triggers file input -->
                                            <div id="uploadBtn"
                                                class="d-flex align-items-center justify-content-center user-profile__upload-btn">
                                                <input type="file" id="uploadPhoto" name="profile_photo" accept="image/*">
                                                <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                                Upload new photo
                                            </div>

                                            <!-- Delete button -->
                                            <div
                                                class="d-flex align-items-center justify-content-center user-profile__upload-btn">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </div>
                                        </div>

                                        <!-- Description text -->
                                        <span class="text-light2 p-micro">JPG, PNG or GIF. Max size 2MB. Recommended
                                            400×400px.</span>

                                            <input type="submit" name="submit" value="Update Profile">

                                    </div>
                                </div>
                           
                            </div>
                            </form>
                        </div>
                    </div>

                    <!-- User Dashboard -->
                    <div class="tab-pane fade" id="user-dashboard" role="tabpanel">
                        <div class="user-profile__dashboard-banner flex-center">
                            <h1 class="h2 text-white">Dashboard</h1>
                        </div>
                        <div class="user-profile__box user-dashboard__section p-3 bg-transparent rounded-top-0">
                            <div class="user-profile__box user-dashboard__explore p-3 bg-transparent">
                                <div class="section__header align-items-center gap-4 mb-3">
                                    <div class="section__header-content">
                                        <p class="section__heading p-large fw-600">
                                            Explore Destinations
                                        </p>
                                    </div>
                                    <div class="section__header-CTA">
                                        <a href="#" class="btn btn-primary rounded-pill">
                                            Explore Destinations
                                            <i class="fa-solid fa-angles-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="row user-dashboard__explore-dests gy-3 gx-3">
                                    <div class="col-lg-4">
                                        <div class="explore-destinations__item">
                                            <div class="position-relative explore-destinations__item-image">
                                                <img src="{{ asset('frontend/assets/destination-banner-item.png') }}" class="img-fluid" alt="Destination">
                                            </div>
                                            <div class="explore-destinations__item-content">
                                                <div>
                                                    <p class="explore-destinations__item-title mb-1">Nature, Culture & History, Beaut & Relax
                                                    </p>
                                                    <h5 class="explore-destinations__item-description p-small fw-600">
                                                        AlUla
                                                    </h5>
                                                </div>
                                                <button class="btn btn-outline-primary rounded-pill">Packages (20) <i
                                                        class="fa-solid fa-angles-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="explore-destinations__item">
                                            <div class="position-relative explore-destinations__item-image">
                                                <img src="{{ asset('frontend/assets/destination-banner-item.png') }}" class="img-fluid" alt="Destination">
                                            </div>
                                            <div class="explore-destinations__item-content">
                                                <div>
                                                    <p class="explore-destinations__item-title mb-1">Culture & History
                                                    </p>
                                                    <h5 class="explore-destinations__item-description p-small fw-600">
                                                        AlUla
                                                    </h5>
                                                </div>
                                                <button class="btn btn-outline-primary rounded-pill">Packages (20) <i
                                                        class="fa-solid fa-angles-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="explore-destinations__item">
                                            <div class="position-relative explore-destinations__item-image">
                                                <img src="{{ asset('frontend/assets/destination-banner-item.png') }}" class="img-fluid" alt="Destination">
                                            </div>
                                            <div class="explore-destinations__item-content">
                                                <div>
                                                    <p class="explore-destinations__item-title mb-1">Culture & History
                                                    </p>
                                                    <h5 class="explore-destinations__item-description p-small fw-600">
                                                        AlUla
                                                    </h5>
                                                </div>
                                                <button class="btn btn-outline-primary rounded-pill">Packages (20) <i
                                                        class="fa-solid fa-angles-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="section__header align-items-center gap-4 my-3">
                                    <div class="section__header-content">
                                        <p class="section__heading p-large fw-600">
                                            Start exploring
                                        </p>
                                    </div>
                                    <div class="section__header-CTA">
                                        <a href="#" class="btn btn-primary rounded-pill">
                                            Explore More
                                            <i class="fa-solid fa-angles-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="row user-dashboard__explore-dests gy-3 gx-3">
                                    <div class="col-lg-4">
                                        <div class="start-exploring__item">
                                            <img src="{{ asset('frontend/assets/start-explore-1.png') }}" alt="Explore" class="img-fluid">
                                            <div class="start-exploring__item-content p-3">
                                                <p class="mb-1 fw-600">Diriyah</p>
                                                <p class="p-micro">A City Embracing Saudi History</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="start-exploring__item">
                                            <img src="{{ asset('frontend/assets/start-explore-1.png') }}" alt="Explore" class="img-fluid">
                                            <div class="start-exploring__item-content p-3">
                                                <p class="mb-1 fw-600">Diriyah</p>
                                                <p class="p-micro">A City Embracing Saudi History</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="start-exploring__item">
                                            <img src="{{ asset('frontend/assets/start-explore-1.png') }}" alt="Explore" class="img-fluid">
                                            <div class="start-exploring__item-content p-3">
                                                <p class="mb-1 fw-600">Diriyah</p>
                                                <p class="p-micro">A City Embracing Saudi History</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="user-profile__box p-3 bg-transparent flex-shrink-0">
                                <div class="section__header align-items-center gap-4 mb-3">
                                    <div class="section__header-content">
                                        <p class="section__heading p-large fw-600">
                                            Explore Packages
                                        </p>
                                    </div>
                                </div>
                                <div class="user-dashboard__packages swiper">
                                    <div class="swiper-wrapper">
                                        <div class="exclusive-offers__carousel-item swiper-slide">
                                            <div class="exclusive-offers__carousel-item-img">
                                                <img src="{{ asset('frontend/assets/exclusive-offer.png') }}" alt="Exclusive Offer"
                                                    class="img-fluid">
                                                <div class="badge carousel-badge"><i
                                                        class="fa-solid fa-location-dot"></i> Macca</div>
                                            </div>
                                            <div class="exclusive-offers__carousel-item-info p-3">
                                                <div
                                                    class="d-flex justify-content-between mb-1 align-items-start gap-1">
                                                    <p class="fw-bold">Bujairi Terrace</p>
                                                    <span
                                                        class="badge carousel-badge-outline rounded-pill p-micro">2N/3D</span>
                                                </div>
                                                <p class="text-muted small mb-2 p-micro">2N Diriyah • 3D Jeddah</p>
                                                <hr>
                                                <ul class="exclusive-offers__carousel-features-list">
                                                    <li><span class="m-0">Round Trip Flights</span></li>
                                                    <li><span class="m-0">5 Star Hotels</span></li>
                                                    <li><span class="m-0">Airport Transfers</span></li>
                                                    <li><span class="m-0">5 Activities</span></li>
                                                </ul>

                                                <!-- Price Box -->
                                                <div class="exclusive-offers__carousel-price-box p-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="text-muted p-micro">Only for now</p>
                                                        <div class="d-flex align-items-center gap-1 text-muted p-small">
                                                            <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}"
                                                                alt="Riyal">
                                                            8,332
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between flex-column mt-2">
                                                        <div
                                                            class="d-flex align-items-center gap-1 text-muted p-small mb-1">
                                                            <img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                                            <p class="fw-bold text-dark">40,000</p> /Person
                                                        </div>
                                                        <p class="text-muted small p-small">Total Price: <img
                                                                class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}"
                                                                alt="Riyal"> 1,22,100
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="exclusive-offers__carousel-item swiper-slide">
                                            <div class="exclusive-offers__carousel-item-img">
                                                <img src="{{ asset('frontend/assets/exclusive-offer.png') }}" alt="Exclusive Offer"
                                                    class="img-fluid">
                                                <div class="badge carousel-badge"><i
                                                        class="fa-solid fa-location-dot"></i> Macca</div>
                                            </div>
                                            <div class="exclusive-offers__carousel-item-info p-3">
                                                <div
                                                    class="d-flex justify-content-between mb-1 align-items-start gap-1">
                                                    <p class="fw-bold">Bujairi Terrace</p>
                                                    <span
                                                        class="badge carousel-badge-outline rounded-pill p-micro">2N/3D</span>
                                                </div>
                                                <p class="text-muted small mb-2 p-micro">2N Diriyah • 3D Jeddah</p>
                                                <hr>
                                                <ul class="exclusive-offers__carousel-features-list">
                                                    <li><span class="m-0">Round Trip Flights</span></li>
                                                    <li><span class="m-0">5 Star Hotels</span></li>
                                                    <li><span class="m-0">Airport Transfers</span></li>
                                                    <li><span class="m-0">5 Activities</span></li>
                                                </ul>

                                                <!-- Price Box -->
                                                <div class="exclusive-offers__carousel-price-box p-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="text-muted p-micro">Only for now</p>
                                                        <div class="d-flex align-items-center gap-1 text-muted p-small">
                                                            <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}"
                                                                alt="Riyal">
                                                            8,332
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between flex-column mt-2">
                                                        <div
                                                            class="d-flex align-items-center gap-1 text-muted p-small mb-1">
                                                            <img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                                            <p class="fw-bold text-dark">40,000</p> /Person
                                                        </div>
                                                        <p class="text-muted small p-small">Total Price: <img
                                                                class="opacity-50" src="../assets/icons/riyal.svg"
                                                                alt="Riyal"> 1,22,100
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="exclusive-offers__carousel-item swiper-slide">
                                            <div class="exclusive-offers__carousel-item-img">
                                                <img src="{{ asset('frontend/assets/exclusive-offer.png') }}" alt="Exclusive Offer"
                                                    class="img-fluid">
                                                <div class="badge carousel-badge"><i
                                                        class="fa-solid fa-location-dot"></i> Macca</div>
                                            </div>
                                            <div class="exclusive-offers__carousel-item-info p-3">
                                                <div
                                                    class="d-flex justify-content-between mb-1 align-items-start gap-1">
                                                    <p class="fw-bold">Bujairi Terrace</p>
                                                    <span
                                                        class="badge carousel-badge-outline rounded-pill p-micro">2N/3D</span>
                                                </div>
                                                <p class="text-muted small mb-2 p-micro">2N Diriyah • 3D Jeddah</p>
                                                <hr>
                                                <ul class="exclusive-offers__carousel-features-list">
                                                    <li><span class="m-0">Round Trip Flights</span></li>
                                                    <li><span class="m-0">5 Star Hotels</span></li>
                                                    <li><span class="m-0">Airport Transfers</span></li>
                                                    <li><span class="m-0">5 Activities</span></li>
                                                </ul>

                                                <!-- Price Box -->
                                                <div class="exclusive-offers__carousel-price-box p-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="text-muted p-micro">Only for now</p>
                                                        <div class="d-flex align-items-center gap-1 text-muted p-small">
                                                            <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}"
                                                                alt="Riyal">
                                                            8,332
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between flex-column mt-2">
                                                        <div
                                                            class="d-flex align-items-center gap-1 text-muted p-small mb-1">
                                                            <img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                                                            <p class="fw-bold text-dark">40,000</p> /Person
                                                        </div>
                                                        <p class="text-muted small p-small">Total Price: <img
                                                                class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}"
                                                                alt="Riyal"> 1,22,100
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom__carousel-pagination user-dashboard__packages-pagination"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User Bookings -->
                    <div class="tab-pane fade user-profile__box" id="user-bookings" role="tabpanel">
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
                    </div>

                    <!-- My Addresses -->
                    <div class="tab-pane fade show active user-profile__box" id="user-addresses" role="tabpanel">
                        <div class="user-profile__details-content">
                            <div
                                class="user-profile__details-header white-bg p-3 d-flex justify-content-between align-items-center flex-sm-row flex-column gap-2">
                                <div>
                                    <p class="p-large fw-600 mb-1">Manage Address</p>
                                    <p class="text-light2">Manage your saved addresses — view existing ones, add new, or
                                        delete them anytime.</p>
                                </div>
                                <button class="btn btn-primary rounded-pill gap-2 ps-2 pe-3 me-auto" data-bs-toggle="modal"
                                    data-bs-target="#addAddressModal" id="abcd">
                                    <i class="fa-solid fa-plus"></i>
                                    Add New Address
                                </button>
                            </div>
                            <div class="white-bg p-3">
                                <div class="user-profile__addresses-table">
                                    <div class="table-responsive">
                                        <table class="table align-middle mb-0 p-small">
                                            <thead class="bg-light">
                                                <tr class="text-light2">
                                                    <th scope="col" class="fw-500"><input type="checkbox" /></th>
                                                    <th scope="col" class="fw-500">#</th>
                                                    <th scope="col" class="fw-500">Address</th>
                                                    <th scope="col" class="fw-500">Full Address</th>
                                                    <th scope="col" class="fw-500">Last Updated</th>
                                                    <th scope="col" class="fw-500">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="checkbox" /></td>
                                                    <td>1</td>
                                                    <td>Office Address</td>
                                                    <td class="text-light2">Lorem ipsum dolor sit amet, consectetur
                                                        adipiscing elit, sed do
                                                        eiusmod tempor incididunt</td>
                                                    <td class="text-light2 text-nowrap">2025-09-25 9:06:24</td>
                                                    <td class="text-nowrap">
                                                        <a href="#" class="text-secondary me-1 text-decoration-none">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>
                                                        <a href="#" class="text-secondary me-1 text-decoration-none">
                                                            <i class="fa-solid fa-pencil"></i>
                                                        </a>
                                                        <a href="#" class="text-secondary text-decoration-none">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><input type="checkbox" /></td>
                                                    <td>1</td>
                                                    <td>Office Address</td>
                                                    <td class="text-light2">Lorem ipsum dolor sit amet, consectetur
                                                        adipiscing elit, sed do
                                                        eiusmod tempor incididunt</td>
                                                    <td class="text-light2 text-nowrap">2025-09-25 9:06:24</td>
                                                    <td class="text-nowrap">
                                                        <a href="#" class="text-secondary me-1 text-decoration-none">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>
                                                        <a href="#" class="text-secondary me-1 text-decoration-none">
                                                            <i class="fa-solid fa-pencil"></i>
                                                        </a>
                                                        <a href="#" class="text-secondary text-decoration-none">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><input type="checkbox" /></td>
                                                    <td>1</td>
                                                    <td>Office Address</td>
                                                    <td class="text-light2">Lorem ipsum dolor sit amet, consectetur
                                                        adipiscing elit, sed do
                                                        eiusmod tempor incididunt</td>
                                                    <td class="text-light2 text-nowrap">2025-09-25 9:06:24</td>
                                                    <td class="text-nowrap">
                                                        <a href="#" class="text-secondary me-1 text-decoration-none">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>
                                                        <a href="#" class="text-secondary me-1 text-decoration-none">
                                                            <i class="fa-solid fa-pencil"></i>
                                                        </a>
                                                        <a href="#" class="text-secondary text-decoration-none">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Pagination section -->
                                    <div class="d-flex justify-content-between align-items-center px-3 py-2">
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

                    <div class="tab-pane fade user-profile__box" id="user-wishlist" role="tabpanel">
                        <div class="user-profile__details-content">
                            <div class="user-profile__details-header white-bg p-3">
                                <p class="p-large fw-600 mb-1">Wishlist</p>
                                <p class="text-light2">Manage your saved addresses — view existing ones, add new, or
                                    delete them anytime.</p>
                            </div>
                            <div class="white-bg p-3">
                                <div
                                    class="package-listing__header d-flex justify-content-between align-items-start align-items-sm-center mb-2 flex-column flex-sm-row gap-2">
                                    <p class="text-black fw-600">Total Packages (15)</p>
                                    <div class="input-group package-listing__search-bar user-wishlist__search-bar">
                                        <input type="text" class="form-control" placeholder="Search booking"
                                            aria-label="Search">
                                        <button class="btn" type="button">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="row gy-3">
                                    <div class="col-sm-6 col-xl-4">
                                        <div class="exclusive-offers__carousel-item swiper-slide">
                                            <div class="exclusive-offers__carousel-item-img">
                                                <img src="{{ asset('frontend/assets/exclusive-offer.png') }}" alt="Exclusive Offer"
                                                    class="img-fluid">
                                                <div class="badge carousel-badge"><i
                                                        class="fa-solid fa-location-dot"></i> Macca</div>
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
                                                            <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}"
                                                                alt="Riyal">
                                                            8,332
                                                        </div>
                                                        <p class="text-muted small">Total Price: <img class="opacity-50"
                                                                src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1,22,100
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xl-4">
                                        <div class="exclusive-offers__carousel-item swiper-slide">
                                            <div class="exclusive-offers__carousel-item-img">
                                                <img src="{{ asset('frontend/assets/exclusive-offer.png') }}" alt="Exclusive Offer"
                                                    class="img-fluid">
                                                <div class="badge carousel-badge"><i
                                                        class="fa-solid fa-location-dot"></i> Macca</div>
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
                                                            <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}"
                                                                alt="Riyal">
                                                            8,332
                                                        </div>
                                                        <p class="text-muted small">Total Price: <img class="opacity-50"
                                                                src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1,22,100
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xl-4">
                                        <div class="exclusive-offers__carousel-item swiper-slide">
                                            <div class="exclusive-offers__carousel-item-img">
                                                <img src="{{ asset('frontend/assets/exclusive-offer.png') }}" alt="Exclusive Offer"
                                                    class="img-fluid">
                                                <div class="badge carousel-badge"><i
                                                        class="fa-solid fa-location-dot"></i> Macca</div>
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
                                                            <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}"
                                                                alt="Riyal">
                                                            8,332
                                                        </div>
                                                        <p class="text-muted small">Total Price: <img class="opacity-50"
                                                                src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1,22,100
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xl-4">
                                        <div class="exclusive-offers__carousel-item swiper-slide">
                                            <div class="exclusive-offers__carousel-item-img">
                                                <img src="{{ asset('frontend/assets/exclusive-offer.png') }}" alt="Exclusive Offer"
                                                    class="img-fluid">
                                                <div class="badge carousel-badge"><i
                                                        class="fa-solid fa-location-dot"></i> Macca</div>
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
                                                            <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}"
                                                                alt="Riyal">
                                                            8,332
                                                        </div>
                                                        <p class="text-muted small">Total Price: <img class="opacity-50"
                                                                src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1,22,100
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xl-4">
                                        <div class="exclusive-offers__carousel-item swiper-slide">
                                            <div class="exclusive-offers__carousel-item-img">
                                                <img src="{{ asset('frontend/assets/exclusive-offer.png') }}" alt="Exclusive Offer"
                                                    class="img-fluid">
                                                <div class="badge carousel-badge"><i
                                                        class="fa-solid fa-location-dot"></i> Macca</div>
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
                                                            <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}"
                                                                alt="Riyal">
                                                            8,332
                                                        </div>
                                                        <p class="text-muted small">Total Price: <img class="opacity-50"
                                                                src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1,22,100
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xl-4">
                                        <div class="exclusive-offers__carousel-item swiper-slide">
                                            <div class="exclusive-offers__carousel-item-img">
                                                <img src="{{ asset('frontend/assets/exclusive-offer.png') }}" alt="Exclusive Offer"
                                                    class="img-fluid">
                                                <div class="badge carousel-badge"><i
                                                        class="fa-solid fa-location-dot"></i> Macca</div>
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
                                                            <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}"
                                                                alt="Riyal">
                                                            8,332
                                                        </div>
                                                        <p class="text-muted small">Total Price: <img class="opacity-50"
                                                                src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1,22,100
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
    </section>

    <!-- Add Address Side Drawer -->
    <div class="offcanvas offcanvas-end view-booking-detail-side-drawer" tabindex="-1" id="viewBookingDetailsSideDrawer"
        aria-labelledby="viewBookingDetailsSideDrawerLabel">
        <div class="offcanvas-header side-drawer__header">
            <p class="offcanvas-title fw-600" id="viewBookingDetailsSideDrawerLabel">Add New Address</p>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body side-drawer__booking-body">
            <div class="booking-card mb-3 position-relative">
                <span class="badge-upcoming rounded-pill p-small">Upcoming</span>
                <img src="{{ asset('frontend/assets/booking.png') }}" class="booking-image" alt="Booking Image">
            </div>
            <!-- Title -->
            <h6 class="fw-600 p-large text-black">Habitas AlUla, Saudi Arabia</h6>
            <p class="text-light2 mb-3">2N Diriya • 3D Jeddah</p>

            <!-- Amenities -->
            <div class="mb-4 text-light2 p-small fw-500 side-drawer__booking-amenities">
                <p>Round Trip Flights</p>
                <p>5 Star Hotels</p>
                <p>Airport Transfers</p>
                <p>Selected Meals</p>
            </div>

            <hr>

            <!-- Booking Details -->
            <p class="fw-600 text-black mb-3">Booking Details</p>
            <div class="d-flex gap-3 mb-2">
                <img src="{{ asset('frontend/assets/icons/drag-vertical.svg') }}" alt="Vertical Drag Icon">
                <div class="booking-details__item">
                    <span class="booking-details__item-title">Date</span>
                    <span class="fw-500 d-flex gap-3"><span class="text-black fw-600">:</span> 24 Aug, 2025</span>
                </div>
            </div>
            <div class="d-flex gap-3 mb-2">
                <img src="{{ asset('frontend/assets/icons/drag-vertical.svg') }}" alt="Vertical Drag Icon">
                <div class="booking-details__item">
                    <span class="booking-details__item-title">Total Amount</span>
                    <span class="fw-500 d-flex gap-3"><span class="text-black fw-600">:</span>15000</span>
                </div>
            </div>
            <div class="d-flex gap-3 mb-2">
                <img src="{{ asset('frontend/assets/icons/drag-vertical.svg') }}" alt="Vertical Drag Icon">
                <div class="booking-details__item">
                    <span class="booking-details__item-title">Payment Type</span>
                    <span class="fw-500 d-flex gap-3"><span class="text-black fw-600">:</span>Bank Transfer</span>
                </div>
            </div>
            <div class="d-flex gap-3 mb-2">
                <img src="{{ asset('frontend/assets/icons/drag-vertical.svg') }}" alt="Vertical Drag Icon">
                <div class="booking-details__item">
                    <span class="booking-details__item-title">Transaction ID</span>
                    <span class="fw-500 d-flex gap-3"><span class="text-black fw-600">:</span>#15569745569</span>
                </div>
            </div>
            <button class="btn btn-outline-secondary mt-3 text-black rounded-4">
                <i class="fa-solid fa-receipt"></i> Download Invoice
            </button>
        </div>

        <div class="offcanvas-footer border-top text-end p-3">
            <button class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="offcanvas">Cancel</button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header">
                    <p class="modal-title fw-600 text-black" id="addAddressLabel">Add New Address</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Address Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="e.g., home address, address 1">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">City <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="e.g., riyadh, jeddah">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pin Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="e.g., 110011">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Full Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="3"
                                placeholder="e.g., Street no. 91, Main King Fahad Road, Riyadh, Saudi Arabia"></textarea>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                    <button type="button" class="btn btn-primary rounded-pill">Save</button>
                </div>
            </div>
        </div>
    </div>


@endsection