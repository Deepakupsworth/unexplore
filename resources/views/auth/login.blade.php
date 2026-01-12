@extends('backend.signinlayout')
@section('title', 'Dashboard')
@section('content')

<div class="auth-wrapper">
        <!-- Left Image Section -->
        <div class="auth-left">
            <a href="{{ url('/')}}" class="btn auth-back-btn rounded-pill">
                <i class="fa-solid fa-arrow-left flex-center"></i> Go back to the website
            </a>
            <img class="img-fluid" src="{{ asset('frontend/assets/signup-banner.png') }}" alt="">
        </div>
        <!-- Divider -->
        <div class="auth-divider"></div>

        <!-- Right Form Section -->
        <div class="auth-right">
            <div>
                <img src="{{ asset('/frontend/assets/logo.png') }}" alt="" style="width: 150px;">
                <!-- <h4 class="font-medium">{{ __('Login') }}</h4> -->
                <h1 class="mt-4 fw-600 h5">Log in to continue</h1>
                <p class="text-light2">Unlock more by logging in to your Unxplord Saudi account.</p>

                <!-- <form id="lang-form" action="" method="get">
              <select onchange="window.location.href=this.value;" >
                  <option class="form-control" value="{{ route('lang.switch', 'en') }}" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                  <option class="form-control" value="{{ route('lang.switch', 'de') }}" {{ app()->getLocale() == 'de' ? 'selected' : '' }}>Deutsch</option>
                  <option class="form-control" value="{{ route('lang.switch', 'ar') }}" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>العربية</option>
              </select>
          </form> -->
                <form class="mt-4" method="POST" action="{{ route('login') }}"> 
                    @csrf
                    <div class="input-group custom-input-group mb-3">
                        <span class="input-group-text" id="login-email"><i class="fa-regular fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="Your Email" aria-label="Username"
                            aria-describedby="login-email">
                    </div>
                    <div class="input-group custom-input-group mb-3">
                        <span class="input-group-text" id="login-password"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Username"
                            aria-describedby="login-password">
                    </div>

                    <div class="mb-4">
                        <a href="#" class="text-decoration-none fw-500 primary-text">Forgot your password?</a>
                    </div>

                    <button type="submit"
                        class="btn btn-primary justify-content-center btn-lg btn-submit w-100 rounded-pill">Create
                        Account</button>
                </form>
                @if($errors->any()) <div>{{ $errors->first() }}</div> @endif
                <p class="text-center mt-3">
                    Don't have an account? <a href="{{ url('/register') }}" class="text-decoration-none primary-text fw-500">Sign Up</a>
                </p>
            </div>
        </div>

    </div>





  @endsection