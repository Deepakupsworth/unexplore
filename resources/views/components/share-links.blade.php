{{-- resources/views/components/share-links.blade.php --}}

@php
    $aClass   = $aClass   ?? 'social-icon';
    $iconSize = $iconSize ?? '';

    $urls = [
        'instagram' => '#',
        'facebook'  => '#',
        'tweet'     => '#',
    ];
@endphp

<a href="https://www.instagram.com/?url={{ urlencode($urls['instagram']) }}"
   target="_blank"
   class="{{ $aClass }}">
    <img src="{{ asset('frontend/assets/icons/instagram.svg') }}"
         class="{{ $iconSize }}"
         alt="Instagram">
</a>

<a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($urls['facebook']) }}"
   target="_blank"
   class="{{ $aClass }}">
    <img src="{{ asset('frontend/assets/icons/facebook.svg') }}"
         class="{{ $iconSize }}"
         alt="Facebook">
</a>

<a href="https://twitter.com/intent/tweet?url={{ urlencode($urls['tweet']) }}"
   target="_blank"
   class="{{ $aClass }}">
    <img src="{{ asset('frontend/assets/icons/x.svg') }}"
         class="{{ $iconSize }}"
         alt="X">
</a>
