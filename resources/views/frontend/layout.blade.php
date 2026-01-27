<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.includes.head')

    <title>@yield('title', 'Unexplord')</title>
</head>

<body>

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
            'packages',
            'things-to-do',
            'account',
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
