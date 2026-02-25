<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.includes.head')
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('meta_description', 'Default description')">

</head>

<body>
    <style>
        .text-ellipsis-1 {
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
        }

        .swiper-slide .exclusive-offers__carousel-item {
            display: flex;
            flex-direction: column;
            height: 100%;
            width: 100%;
        }

        .exclusive-offers__carousel-item.swiper-slide {
            height: auto !important;
        }

        .exclusive-offers__carousel-item-info {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            justify-content: space-around;
        }

        .exclusive-offers__carousel-price-box {
            margin-top: auto;
        }

        .dest-banner__carousel-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .explore-destinations__item-content a.btn.btn-outline-primary {
            white-space: nowrap;
            gap: 4px;
            padding-top: 8px;
            padding-bottom: 8px;
        }

        .upcoming-event__carousel-item-img img {
            width: 100%;
        }

        .package-listing__results-list .exclusive-offers__carousel-item-img img {
            height: 200px;
        }
        .exclusive-offers__carousel-item-img img {
            height: 100%;
            min-height: 200px;
        }

        .package-listing__results-list .exclusive-offers__carousel-item {
            display: flex;
            flex-direction: column;
            height: 100%;
        }
    </style>
    <style>
            /* Match Bootstrap input height */
        .select2-container--default .select2-selection--single {
            height: 38px;
            padding: 8px 12px;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            display: flex;
            align-items: center;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: normal;
            padding-left: 0;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100%;
            right: 10px;
        }
        .select2-container--default .select2-selection--single .select2-selection__clear {
            margin-right: 30px;
        }
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #86b7fe;
            box-shadow: 0 0 0 .25rem rgba(13,110,253,.25);
        }
</style>


    {{-- HEADER --}}
    @php
        $whiteHeaderPages = [
            'package-details',
            'package-listing',
            'profile',
            'to-do-things-search',
            'about-us',
            'blog-details',
            'blogs',
            'checkout',
            'contact-us',
            'packages*',
            'things-to-do',
            'account',
            'events',
            'booking*',
            'products',
            'info*',
            'privacy-policy',
            'terms-conditions',
            'cookie-policy',
            'faqs',
            'blogs*'
        ];
    @endphp

    <div id="header" class="{{ request()->is($whiteHeaderPages) ? 'white-header-static' : '' }}">
        @include('frontend.includes.header')
    </div>

    {{-- PAGE CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <div id="footer">
        @include('frontend.includes.footer')
    </div>

    {{-- PAGE SCRIPTS --}}
    @include('frontend.includes.scripts')

    {{-- TOAST --}}
    @include('partials.izitoast')

    @stack('scripts')
</body>

</html>
