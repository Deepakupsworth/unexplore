@extends('frontend.layout')
@section('content')
{{-- @dd($cities) --}}
    <!-- 1. DESTINATION BANNER SECTION  -->
    <section class="hero-banner dest-banner">
        <video class="hero-banner__video" autoplay muted loop playsinline poster="{{ asset('frontend/assets/hero-banner-bg.png')}}">
            <source src="{{ asset('frontend/assets/videos/seekers-entry-video.mp4')}}" type="video/mp4">
            {{__('common.video_not_supported')}}
        </video>
        <!-- <img class="hero-banner__image" src="../assets/hero-banner-bg.png" alt="Banner"> -->
        <div class="container-fluid">
            <div class="dest-banner__carousel swiper">
                <div class="swiper-wrapper">
                    @foreach($cities as $cites)
                        <div class="dest-banner__carousel-item swiper-slide">
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $cites->thumb_image) }}" alt="Destination">
                                <a href="{{ route('destinations.show', $cites->slug) }}"
                                   class="btn btn-outline-light dest__explore-btn">
                                    Explore
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </a>
                            </div>

                            <div class="dest-banner__carousel-item-content">
                                {{-- 🔥 DYNAMIC CATEGORY NAMES --}}
                                <p class="p-small text-uppercase">
                                    {{ $cites->categoryNames() }}
                                </p>

                                <div class="d-flex justify-content-between mt-1">
                                    <h6 class="dest-banner__carousel-item-title">
                                        {{ $cites->translation->name }}
                                    </h6>
                                    <a href="{{ route('packages.index') }}">
                                        Packages ({{ $cites->package_count }})
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    <!-- 2. EXPLORE DESTINATIONS -->
    <section class="explore-destinations section-padding">
        <div class="container">
            <div class="section__header">
                <div class="section__header-content">
                    <h2 class="section__heading">{{ __('destinations.explore_more.title') }}</h2>
                    <p class="section__description">{{ __('destinations.explore_more.description') }}</p>
                </div>
            </div>
            <div class="row gy-xl-5 gy-lg-3 gy-3 gx-4 explore-destinations__items">
                @foreach($cities as $cites)
                <div class="col-md-6 col-lg-4">
                    <div class="explore-destinations__item">
                        <div class="position-relative explore-destinations__item-image">
                            <img src="{{ asset('storage/' . $cites->thumb_image) }}" alt="Destination">
                            <a href="{{ route('destinations.show',$cites->slug) }}" class="btn btn-outline-light dest__explore-btn">
                                {{ __('destinations.card.explore') }}
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                        <div class="explore-destinations__item-content">
                            <div>
                                <p class="explore-destinations__item-title mb-2">{{ $cites->translation->tagline }}</p>
                                <h5 class="explore-destinations__item-description">{{ $cites->translation->name }}</h5>
                            </div>
                            {{-- destinations.show --}}
                            <a href="{{ route('packages.index') }}" class="btn btn-outline-primary rounded-pill"> {{__('destinations.card.packages') }} ({{$cites->package_count}}) <i class="fa-solid fa-angles-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>
@endsection
