@extends('frontend.layout')
@section('title', __('checkout.title'))

@section('meta_description', '')
@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">

                <div class="card border-0 shadow-lg rounded-4 text-center p-4 p-md-5">

                    {{-- ICON --}}
                    <div class="mx-auto mb-4 d-flex align-items-center justify-content-center rounded-circle"
                         style="width:80px;height:80px;background:#16a34a;">
                        <i class="fa-solid fa-check text-white fs-2"></i>
                    </div>

                    {{-- TITLE --}}
                    <h2 class="fw-700 mb-2">
                        {{ __('checkout.booking_confirmed') }} 🎉
                    </h2>

                    {{-- SUBTITLE --}}
                    <p class="text-muted mb-4">
                        {{ __('checkout.thank_you') }}
                        <strong class="text-dark">UNXplord Saudi</strong>.
                        <br>
                        {{ __('checkout.booking_received') }}
                    </p>

                    {{-- INFO BOX --}}
                    <div class="border rounded-4 p-3 mb-4 text-start bg-light">
                        <div class="d-flex align-items-start gap-2 mb-2">
                            <i class="fa-solid fa-envelope text-success mt-1"></i>
                            <p class="mb-0 small">
                                {{ __('checkout.email_sent') }}
                            </p>
                        </div>

                        <div class="d-flex align-items-start gap-2 mb-2">
                            <i class="fa-solid fa-phone text-success mt-1"></i>
                            <p class="mb-0 small">
                                {{ __('checkout.expert_contact') }}
                            </p>
                        </div>

                        <div class="d-flex align-items-start gap-2">
                            <i class="fa-solid fa-compass text-success mt-1"></i>
                            <p class="mb-0 small">
                                {{ __('checkout.ready_journey') }}
                            </p>
                        </div>
                    </div>

                    {{-- ACTIONS --}}
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                        <a href="{{ url('/') }}"
                           class="btn btn-primary rounded-pill px-4 fw-500">
                            {{ __('checkout.back_home') }}
                        </a>

                        <a href="{{ url('/destinations') }}"
                           class="btn btn-outline-primary rounded-pill px-4 fw-500">
                            {{ __('checkout.explore_destinations') }}
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
@endsection
