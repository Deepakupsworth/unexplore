<!DOCTYPE html>
<!-- Template Name: DashCode - HTML, React, Vue, Tailwind Admin Dashboard Template Author: Codeshaper Website: https://codeshaper.net Contact: support@codeshaperbd.net Like: https://www.facebook.com/Codeshaperbd Purchase: https://themeforest.net/item/dashcode-admin-dashboard-template/42600453 License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project. -->
<html lang="zxx" dir="ltr" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>Unxplord saudi - Backend</title>
    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{  asset('backend/images/favicon.ico') }}">
    <link rel="shortcut icon" href="{{  asset('backend/images/favicon.ico') }}">

    {{-- PNG fallback --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{  asset('backend/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{  asset('backend/images/favicon-16x16.png') }}">

    {{-- Apple --}}
    <link rel="apple-touch-icon" href="{{  asset('backend/images/apple-touch-icon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/assets/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('frontend/assets/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('frontend/assets/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{url('/')}}/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" href="{{ asset('backend/css/rt-plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/app.css') }}">
    <!-- End : Theme CSS-->
    <script src="{{ asset('backend/js/settings.js') }}" sync></script>
    <style>
        .dataTables_paginate {
            display: none;
        }
    </style>
</head>

<body class="font-inter dashcode-app" id="body_class">


    <!-- Main Content -->

    <main class="app-wrapper">
        <!--Sidebar-->
        @include('backend.includes.sidebar')

        <div class="flex flex-col justify-between min-h-screen">
            <div>
                <!-- Header -->
                @include('backend.includes.header')

                <!-- content-->
                <div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]"
                    id="content_wrapper">
                    <div class="page-content">
                        <div class="transition-all duration-150 container-fluid" id="page_layout">
                            <div id="content_layout">

                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Footer -->
            @include('backend.includes.footer')
        </div>
    </main>

    @yield('scripts')

    <!-- Footer End -->
    <!-- scripts -->
    @include('backend.includes.scripts')

    {{-- TOAST --}}
    @include('partials.izitoast')
</body>

</html>
