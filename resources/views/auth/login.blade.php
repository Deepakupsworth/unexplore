@extends('auth.layout')
@section('title', __('Login'))

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

            <h1 class="mt-4 fw-600 h5">{{ __('Log in to continue') }}</h1>
            <p class="text-light2">{{ __('Unlock more by logging in to your Unxplord Saudi account.') }}</p>

            <form class="mt-4" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group custom-input-group mb-3">
                    <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                    <input type="email" name="email"
                        value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="{{ __('Your Email') }}">
                </div>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror

                <div class="input-group custom-input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="{{ __('Password') }}">
                </div>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror

                <div class="mb-4 text-end">
                    <a href="{{ route('password.request') }}"
                       class="text-decoration-none fw-500 primary-text">
                       {{ __('Forgot your password?') }}
                    </a>
                </div>

                <button type="submit"
                    class="btn btn-primary justify-content-center btn-lg btn-submit w-100 rounded-pill">
                    {{ __('Login') }}
                </button>
            </form>

            <p class="text-center mt-3">
                {{ __("Don't have an account?") }}
                <a href="{{ url('/register') }}" class="text-decoration-none primary-text fw-500">
                    {{ __('Sign Up') }}
                </a>
            </p>

        </div>
    </div>

</div>

@endsection
