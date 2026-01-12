
@extends('frontend.layout')
@section('content')
@php
    $jsonPath = app_path('demojson.json');
    

    $jsonData = [];
    if (file_exists($jsonPath)) {
        $jsonData = json_decode(file_get_contents($jsonPath), true);
    }

    $destination = $jsonData['destination'] ?? [];
    $destination_banner = $destination['destination_banner'] ?? [];
    $explore_destinations = $destination['explore_destinations'] ?? [];

    

@endphp
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
                @if(count($destination_banner))
                @foreach($destination_banner as $destination)
                    <div class="dest-banner__carousel-item swiper-slide">
                        <div class="position-relative">
                            <img src="{{ asset(ltrim($destination['image'], '/')) }}" alt="Destination">
                            <a class="btn btn-outline-light dest__explore-btn" href="{{ url('/destination-details?slug=' . $destination['slug']) }}">  
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                        <div class="dest-banner__carousel-item-content">
                            <p class="p-small">{{ $destination['tags'] }} </p>
                            <div class="d-flex justify-content-between mt-1">
                                <h6 class="dest-banner__carousel-item-title">{{ $destination['city'] }}</h6>
                                <a href="#">Packages ({{ $destination['related_packages'] }} )</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif    
                    
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
            @if(count($explore_destinations))
            @foreach($explore_destinations as $explore_destinations)
                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset(ltrim($explore_destinations['image'], '/')) }}" alt="Destination">
                            <a class="btn btn-outline-light dest__explore-btn" href="{{ url('/destination-details?slug=' . $explore_destinations['slug']) }}">
                                Explore
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">{{ $explore_destinations['tags'] }}</p>
                                <h5 class="explore-destinations__item-description">{{ $explore_destinations['city'] }}</h5>
                            </div>
                         <button class="btn btn-outline-primary rounded-pill">Packages ({{ $explore_destinations['related_packages'] }}) <i class="fa-solid fa-angles-right"></i></button>
                        </div>
                    </div>
                </div>
            @endforeach
            @endif  
               
            </div>
        </div>
    </section>

    @endsection