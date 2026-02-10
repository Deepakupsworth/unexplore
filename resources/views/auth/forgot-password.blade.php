@extends('auth.layout')

@section('title', __('Forgot Password'))

@section('content')
<div class="auth-wrapper">

    <div class="auth-left">
        <a href="{{ url('/') }}" class="btn auth-back-btn rounded-pill">
            <i class="fa-solid fa-arrow-left flex-center"></i> {{ __('Go back to the website') }}
        </a>
        <img class="img-fluid" src="{{ asset('frontend/assets/signup-banner.png') }}" alt="">
    </div>

    <div class="auth-divider"></div>

    <div class="auth-right">
        <div>
            <img src="{{ asset('/frontend/assets/logo.png') }}" alt="" style="width: 150px;">

            <h1 class="mt-4 fw-600 h5">{{ __('auth.forgot.title') }}</h1>
            <p class="text-light2"> {{ __('auth.forgot.subtitle') }}</p>

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4 mt-4">
                @csrf

                <div class="input-group custom-input-group mb-3">
                    <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                    <input type="email" name="email"
                        value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="{{ __('Your Email') }}">
                </div>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror

                <button type="submit" class="btn btn-primary justify-content-center btn-lg btn-submit w-100 rounded-pill">
                    {{ __('auth.forgot.send_email') }}
                </button>
            </form>

            <p class="text-center mt-3">
                {{ __('auth.forgot.remember_password') }}
                <a href="{{ route('login') }}" class="text-decoration-none primary-text fw-500">
                    {{ __('auth.forgot.sign_in') }}
                </a>
            </p>

        </div>
    </div>

</div>
@endsection
