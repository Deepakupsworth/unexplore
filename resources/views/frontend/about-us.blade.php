@extends('frontend.layout')
@section('content')

<!-- ABOUT US: BANNER -->
<section class="package-listing__banner about-us__banner">
    <div class="container">
        <div class="text-center justify-content-center package-listing__banner-content contact-us-banner align-items-center">
            <h1 class="h2 fw-bold text-white m-0">{{ __('about.banner.title') }}</h1>
            <p>{{ __('about.banner.description') }}</p>
        </div>
    </div>
</section>

<section class="section-padding-md">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-7">
                <div class="section__header">
                    <div class="section__header-content">
                        <h2 class="section__heading">{{ __('about.section.title') }}</h2>
                        <p class="section__description p-large">
                            {{ __('about.section.description') }}
                        </p>
                    </div>
                </div>

                <div class="row mt-5 gy-4">
                    <div class="col-md-6 col-lg-6">
                        <div class="contact-us__content-block rounded-5">
                            <h5 class="mb-2 fw-600">1. <br> {{ __('about.info.who_we_are') }}</h5>
                            <p>{{ __('about.info.text') }}</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6">
                        <div class="contact-us__content-block rounded-5">
                            <h5 class="mb-2 fw-600">2. <br> {{ __('about.info.vision') }}</h5>
                            <p>{{ __('about.info.text') }}</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6">
                        <div class="contact-us__content-block rounded-5">
                            <h5 class="mb-2 fw-600">3. <br> {{ __('about.info.mission') }}</h5>
                            <p>{{ __('about.info.text') }}</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6">
                        <div class="contact-us__content-block rounded-5">
                            <h5 class="mb-2 fw-600">4. <br> {{ __('about.info.strategic_objectives') }}</h5>
                            <p>{{ __('about.info.text') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- IMAGES (UNCHANGED) -->
            <div class="col-lg-5">
                <div class="row about-us__img-wrapper">
                    <div class="col-6 about-us__img-left">
                        <div>
                            <img class="img-fluid rounded-5" src="{{ asset('frontend/assets/about-us1.png') }}" alt="About us">
                        </div>
                        <div class="mt-4">
                            <img class="img-fluid rounded-5" src="{{ asset('frontend/assets/about-us2.png') }}" alt="About us">
                        </div>
                    </div>
                    <div class="col-6 about-us__img-right">
                        <div>
                            <img class="img-fluid rounded-5" src="{{ asset('frontend/assets/about-us3.png') }}" alt="About us">
                        </div>
                        <div class="mt-4">
                            <img class="img-fluid rounded-5" src="{{ asset('frontend/assets/about-us4.png') }}" alt="About us">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WHAT WE OFFER -->
<section class="section-padding-md contact-us__offer-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="section__header">
                    <div class="section__header-content">
                        <h2 class="section__heading">{{ __('about.offer.title') }}</h2>
                        <p class="section__description p-large">
                            {{ __('about.offer.description') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row contact-us__offer-box-wrapper">
            <div class="col-md-6 col-lg-4">
                <div class="contact-us__offer-box">
                    <div class="contact-us__offer-box-icon flex-center rounded-4 mb-1 primary-text">
                        <i class="fa-regular fa-building"></i>
                    </div>
                    <h5 class="fw-600">{{ __('about.offer.book_hotels.title') }}</h5>
                    <p>{{ __('about.offer.book_hotels.description') }}</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="contact-us__offer-box">
                    <div class="contact-us__offer-box-icon flex-center rounded-4 mb-1 primary-text">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <h5 class="fw-600">{{ __('about.offer.meet_restaurants.title') }}</h5>
                    <p>{{ __('about.offer.meet_restaurants.description') }}</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="contact-us__offer-box">
                    <div class="contact-us__offer-box-icon flex-center rounded-4 mb-1 primary-text">
                        <i class="fa-solid fa-route"></i>
                    </div>
                    <h5 class="fw-600">{{ __('about.offer.discover_destinations.title') }}</h5>
                    <p>{{ __('about.offer.discover_destinations.description') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- OUR VALUES -->
<section class="section-padding-md">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="section__header">
                    <div class="section__header-content">
                        <h2 class="section__heading">{{ __('about.values.title') }}</h2>
                        <p class="section__description p-large">
                            {{ __('about.section.description') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4 gy-4">
            <div class="col-lg-6">
                <div class="contact-us__content-block contact-us__our-values-box rounded-4 py-3">
                    <p class="p-large primary-text fw-600">{{ __('about.values.authenticity.title') }}</p>
                    <p class="p-large">{{ __('about.values.authenticity.description') }}</p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="contact-us__content-block contact-us__our-values-box rounded-4 py-3">
                    <p class="p-large primary-text fw-600">{{ __('about.values.transparency.title') }}</p>
                    <p class="p-large">{{ __('about.values.transparency.description') }}</p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="contact-us__content-block contact-us__our-values-box rounded-4 py-3">
                    <p class="p-large primary-text fw-600">{{ __('about.values.respect.title') }}</p>
                    <p class="p-large">{{ __('about.values.respect.description') }}</p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="contact-us__content-block contact-us__our-values-box rounded-4 py-3">
                    <p class="p-large primary-text fw-600">{{ __('about.values.innovation.title') }}</p>
                    <p class="p-large">{{ __('about.values.innovation.description') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- EXCLUSIVE OFFERS (STATIC TEXT ONLY) -->
<section class="exclusive-offers section-padding-md">
    <div class="container">
        <div class="section__header">
            <div class="section__header-content">
                <h2 class="section__heading">{{ __('about.exclusive.title') }}</h2>
                <p class="section__description">{{ __('about.exclusive.description') }}</p>
            </div>
            <div class="section__header-CTA">
                <a href="{{ route('packages.index') }}" class="btn btn-primary rounded-pill">
                    {{ __('common.view_all') }}
                    <i class="fa-solid fa-angles-right"></i>
                </a>
            </div>
        </div>

        <div class="exclusive-offers__carousel swiper">
            <div class="swiper-wrapper">

                @foreach ($packages as $package)
                    <div class="exclusive-offers__carousel-item swiper-slide">
                        <x-frontend.package-card :package="$package" />
                    </div>
                @endforeach

            </div>
            <div class="custom__carousel-pagination"></div>
        </div>
    </div>
</section>

<!-- START EXPLORING -->
@if($favouriteCities && $favouriteCities->count() > 0)
<section class="section-padding-md">
    <div class="container">
        <div class="section__header">
            <div class="section__header-content">
                <h2 class="section__heading">
                    <span class="fw-600">{{ __('about.explore.title') }}</span>
                </h2>
                <p class="section__description">{{ __('about.explore.description') }}</p>
            </div>
            <div class="section__header-CTA">
                <a href="{{ route('destinations.index') }}" class="btn btn-primary rounded-pill">
                    {{ __('common.view_all') }}
                    <i class="fa-solid fa-angles-right"></i>
                </a>
            </div>
        </div>

        <div class="row start-exploring__row gy-3">
            @foreach ($favouriteCities as $city)

                <div class="col-md-6 col-lg-3">
                    <div class="start-exploring__item">
                        <img src="{{ asset('storage/' . $city->thumb_image) }}" alt="Explore" class="img-fluid">
                        <div class="start-exploring__item-content">
                            <p class="mb-1 p-large fw-600">
                               {{$city?->translation?->name}}
                            </p>
                            <p class="p-small">
                               {{$city?->translation?->tagline}}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
</section>
@endif
@endsection
