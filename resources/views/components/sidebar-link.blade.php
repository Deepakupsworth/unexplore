@props(['href'])

@php
    $path = trim(parse_url($href, PHP_URL_PATH), '/');
    $isActive = request()->is($path . '*');
@endphp

<a href="{{ $href }}" class="navItem {{ $isActive ? 'active' : '' }}">
    {{ $slot }}
</a>
