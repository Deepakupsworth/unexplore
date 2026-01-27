@extends('auth.layout')
@section('title', __('Register'))

@section('content')

<div class="auth-wrapper">

    <div class="auth-left">
        <a href="{{ url('/') }}" class="btn auth-back-btn rounded-pill">
            <i class="fa-solid fa-arrow-left flex-center"></i> {{ __('Go back to the website') }}
        </a>
        <img class="img-fluid" src="{{ asset('/frontend/assets/signup-banner.png') }}" alt="">
    </div>

    <div class="auth-divider"></div>

    <div class="auth-right">
        <div>
            <img src="{{ asset('/frontend/assets/logo.png') }}" alt="" style="width: 150px;">

            <h1 class="mt-4 fw-600 h5">{{ __('Create your Visit Saudi Account') }}</h1>
            <p class="text-light2">{{ __('Get closer to your dream Saudi holiday with your Unxplord Saudi account.') }}</p>

            <form class="mt-4" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="input-group custom-input-group mb-3">
                    <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                    <input type="text" name="first_name"
                        value="{{ old('first_name') }}"
                        class="form-control @error('first_name') is-invalid @enderror"
                        placeholder="{{ __('First Name') }}">
                </div>
                @error('first_name') <small class="text-danger">{{ $message }}</small> @enderror

                <div class="input-group custom-input-group mb-3">
                    <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                    <input type="text" name="last_name"
                        value="{{ old('last_name') }}"
                        class="form-control @error('last_name') is-invalid @enderror"
                        placeholder="{{ __('Last Name') }}">
                </div>
                @error('last_name') <small class="text-danger">{{ $message }}</small> @enderror

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

                <div class="input-group custom-input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password_confirmation"
                        class="form-control"
                        placeholder="{{ __('Confirm Password') }}">
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="terms" {{ old('terms') ? 'checked' : '' }}>
                    <label class="form-check-label">
                        {{ __('I agree to the') }}
                        <a href="#" class="fw-600 primary-text">{{ __('Terms & Conditions') }}</a>
                        {{ __('and') }}
                        <a href="#" class="fw-600 primary-text">{{ __('Privacy Policy') }}</a>
                    </label>
                </div>
                @error('terms') <div class="text-danger">{{ $message }}</div> @enderror

                <button type="submit"
                    class="btn btn-primary justify-content-center btn-lg btn-submit w-100 rounded-pill">
                    {{ __('Create Account') }}
                </button>

            </form>

        </div>
    </div>

</div>

@endsection
