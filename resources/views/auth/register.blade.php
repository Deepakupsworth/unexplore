<!-- <form method="POST" action="{{ route('register') }}">
    @csrf
    <input name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

    <select name="role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select>

    <button type="submit">Register</button>
</form>
@if($errors->any()) <div>{{ $errors->first() }}</div> @endif -->


@extends('backend.signinlayout')
@section('title', 'Dashboard')
@section('content')

<div class="auth-wrapper">
        <!-- Left Image Section -->
        <div class="auth-left">
            <a href="{{ url('/')}}" class="btn auth-back-btn rounded-pill">
                <i class="fa-solid fa-arrow-left flex-center"></i> Go back to the website
            </a>
            <img class="img-fluid" src="{{ asset('/frontend/assets/signup-banner.png') }}" alt="">
        </div>

        <!-- Divider -->
        <div class="auth-divider"></div>

        <!-- Right Form Section -->
        <div class="auth-right">
            <div>
                <img src="{{ asset('/frontend/assets/logo.png') }}" alt="" style="width: 150px;">

                <h1 class="mt-4 fw-600 h5">Create your Visit Saudi Account</h1>
                <p class="text-light2">Get closer to your dream Saudi holiday with your Unxplord Saudi account.</p>

                <form class="mt-4" method="POST" action="{{ route('register') }}">
                    @csrf
  
                    <div class="input-group custom-input-group mb-3">
                        <span class="input-group-text" id="signup-first-name"><i class="fa-regular fa-user"></i></span>
                        <input type="text" class="form-control" name="first_name" placeholder="First Name" aria-label="Username"
                            aria-describedby="signup-first-name">
                    </div>
                    <div class="input-group custom-input-group mb-3">
                        <span class="input-group-text" id="signup-last-name"><i class="fa-regular fa-user"></i></span>
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name" aria-label="Username"
                            aria-describedby="signup-last-name">
                    </div>
                    <div class="input-group custom-input-group mb-3">
                        <span class="input-group-text" id="signup-email"><i class="fa-regular fa-envelope"></i></span>
                        <input type="email" class="form-control" name="email" placeholder="Your Email" aria-label="Username"
                            aria-describedby="signup-email">
                    </div>
                    <div class="input-group custom-input-group mb-3">
                        <span class="input-group-text" id="signup-password"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Password" aria-label="Username"
                            aria-describedby="signup-password">
                    </div>
                    <div class="input-group custom-input-group mb-3">
                        <span class="input-group-text" id="signup-confirm-password"><i
                                class="fa-solid fa-lock"></i></span>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" aria-label="Username"
                            aria-describedby="signup-confirm-password">
                    </div>

                    <div class="input-group custom-input-group mb-3">
                       
                                <select name="role" class="form-control w-full">
                              <option class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Select an option</option>
                              <option value="user" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">User</option>
                              <option value="admin" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Admin</option>
                            </select>
                            
                         
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="signup-agree"> 
                        <label class="form-check-label" for="signup-agree">
                            I have read and agree to the
                            <a href="#" class="fw-600 primary-text">Terms & Conditions</a>
                            and
                            <a href="#" class="fw-600 primary-text">Privacy Policy</a>
                        </label>
                    </div>

                    <button type="submit"
                        class="btn btn-primary justify-content-center btn-lg btn-submit w-100 rounded-pill">Create
                        Account</button>
                </form>
                @if($errors->any()) <div class="alert alert-danger">{{ $errors->first() }}</div> @endif
                <p class="text-center mt-3">
                    Already have an account? <a href="{{ url('/login') }}" class="text-decoration-none primary-text fw-500">Sign in</a>
                </p>
            </div>
        </div>

    </div>

  @endsection