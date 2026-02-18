@php
    $aClass = $aClass ?? 'social-icon';
    $iconSize = $iconSize ?? '';

    // 🔥 share toggle only for generic icon
    $enableShareIcon = $enableShareIcon ?? false;

    $shareUrl = $shareUrl ?? request()->fullUrl();
@endphp

{{-- ================= INSTAGRAM (always visible) ================= --}}
<a href="https://www.instagram.com/?url={{ urlencode($shareUrl) }}" target="_blank" class="{{ $aClass }}">
    <img src="{{ asset('frontend/assets/icons/instagram.svg') }}" class="{{ $iconSize }}" alt="Instagram">
</a>

{{-- ================= FACEBOOK (always visible) ================= --}}
<a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}" target="_blank"
    class="{{ $aClass }}">
    <img src="{{ asset('frontend/assets/icons/facebook.svg') }}" class="{{ $iconSize }}" alt="Facebook">
</a>

{{-- ================= X (always visible) ================= --}}
<a href="https://twitter.com/intent/tweet?url={{ urlencode($shareUrl) }}" target="_blank" class="{{ $aClass }}">
    <img src="{{ asset('frontend/assets/icons/x.svg') }}" class="{{ $iconSize }}" alt="X">
</a>

{{-- ================= GENERIC SHARE (conditional) ================= --}}
@if ($enableShareIcon)
    <a href="{{ $shareUrl }}" class="flex-center">
        <img src="{{ asset('frontend/assets/icons/share.svg') }}" alt="Share">
    </a>
@endif
