@extends('frontend.layout')
@section('title','FAQs | Unxplord Saudi')

@section('meta_description','Find answers to common questions about bookings, payments, cancellations, and travel with Unxplord Saudi.')

@section('content')
<section class="package-listing__banner about-us__banner">
    <div class="container">
        <div class="text-center package-listing__banner-content banner-travel-guide">
            <h1 class="h2 fw-bold text-white m-0">Frequently Asked Questions</h1>
            <p>Quick answers to common queries.</p>
        </div>
    </div>
</section>

<section class="section-padding-md">
    <div class="container">

        <div class="contact-us__content-block rounded-5 mb-4">
            <h5 class="fw-600">How do I book a package?</h5>
            <p>
                Simply browse packages, select your travel date, add traveller details,
                and complete the checkout process.
            </p>
        </div>

        <div class="contact-us__content-block rounded-5 mb-4">
            <h5 class="fw-600">Can I cancel my booking?</h5>
            <p>
                Yes, cancellations are allowed as per the package cancellation policy.
                Refund eligibility depends on the timing of cancellation.
            </p>
        </div>

        <div class="contact-us__content-block rounded-5">
            <h5 class="fw-600">Is Saudi Arabia safe for tourists?</h5>
            <p>
                Yes, Saudi Arabia is considered safe for tourists.
                Visitors should follow local laws and standard travel precautions.
            </p>
        </div>

    </div>
</section>
@endsection
