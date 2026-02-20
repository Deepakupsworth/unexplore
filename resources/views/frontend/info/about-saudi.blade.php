@extends('frontend.layout')
@section('title','About Saudi Arabia | Travel Guide, Culture & Vision 2030 | Unxplord Saudi')

@section('meta_description', 'Discover Saudi Arabia’s rich culture, UNESCO heritage sites, modern cities, and Vision 2030 transformation. Explore top destinations, history, and travel insights with Unxplord Saudi.')
@section('content')

<section class="package-listing__banner about-us__banner">
    <div class="container">
        <div class="text-center package-listing__banner-content contact-us-banner banner-about-saudi">
            <h1 class="h2 fw-bold text-white m-0">About Saudi Arabia</h1>
            <p>Discover the rich culture, heritage, and modern transformation of the Kingdom.</p>
        </div>
    </div>
</section>

<section class="section-padding-md">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-7">

                <div class="section__header-content">
                    <h2 class="section__heading">Discover Saudi Arabia</h2>
                    <p class="section__description p-large">
                        Saudi Arabia is a land of ancient history, vibrant culture, and rapid modernization.
                        From the holy cities of Makkah and Madinah to the futuristic skyline of Riyadh,
                        the Kingdom offers a unique blend of tradition and innovation.
                    </p>
                </div>

                <div class="row mt-5 gy-4">

                    <div class="col-md-6">
                        <div class="contact-us__content-block rounded-5">
                            <h5 class="fw-600">Rich Heritage</h5>
                            <p>
                                Explore UNESCO World Heritage sites, ancient deserts,
                                and centuries-old traditions that define Saudi identity.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="contact-us__content-block rounded-5">
                            <h5 class="fw-600">Vision 2030</h5>
                            <p>
                                Saudi Arabia is rapidly transforming under Vision 2030,
                                opening its doors to global tourism and innovation.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="contact-us__content-block rounded-5">
                            <h5 class="fw-600">Cultural Experiences</h5>
                            <p>
                                Enjoy traditional cuisine, local markets, desert safaris,
                                and world-class entertainment events.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="contact-us__content-block rounded-5">
                            <h5 class="fw-600">Modern Cities</h5>
                            <p>
                                Experience the dynamic energy of Riyadh, Jeddah, and NEOM —
                                the future of smart living.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- images keep same --}}
            <div class="col-lg-5">
                <div class="row about-us__img-wrapper">
                    <div class="col-6">
                        <img class="img-fluid rounded-5" src="{{ asset('frontend/assets/about-us1.png') }}">
                    </div>
                    <div class="col-6">
                        <img class="img-fluid rounded-5" src="{{ asset('frontend/assets/about-us2.png') }}">
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
