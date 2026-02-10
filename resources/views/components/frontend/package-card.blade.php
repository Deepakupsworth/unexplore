@props(['package'])
{{-- @dd($package) --}}
@php
    // =========================
    // SAFE DATA (FROM CONTROLLER)
    // =========================

    $translation = $package->translation ?? null;

    $title    = $translation->title ?? '—';
    $subTitle = $translation->sub_title ?? '';

    // City translation already resolved in controller
    $city = $package->current_city ?? null;

    // Pricing
    $perPersonPrice =$package->price->per_person_price ?? 0;

@endphp

{{-- @dd($package) --}}

<a href="{{ route('packages.show', $package->slug) }}"
   class="text-decoration-none text-dark">

    <div class="exclusive-offers__carousel-item">

        {{-- ================= IMAGE ================= --}}
        <div class="exclusive-offers__carousel-item-img">
            <img
                src="{{ $package->thumb
                    ? asset('storage/' . $package->thumb->image_path)
                    : asset('frontend/assets/destinations/hail/3.jpg')
                }}"
                class="img-fluid"
                alt="{{ $title }}"
                loading="lazy"
            >

            {{-- CITY BADGE --}}
            @if($city)
                <div class="badge carousel-badge">
                    <i class="fa-solid fa-location-dot"></i>
                    {{ $city->name }}
                </div>
            @endif
        </div>

        {{-- ================= INFO ================= --}}
        <div class="exclusive-offers__carousel-item-info">

            <div class="d-flex justify-content-between align-items-start mb-1">
                <h6 class="fw-bold mb-0 text-ellipsis-1">
                    {{ $title }}
                </h6>

                <span class="badge carousel-badge-outline rounded-pill">
                    {{ $package->duration_nights }}N /
                    {{ $package->duration_days }}D
                </span>
            </div>

            @if($subTitle)
                <p class="text-muted small mb-2">
                    {{ $subTitle }}
                </p>
            @endif

            <hr>

            {{-- FEATURES --}}
            {!! packageListingUl($package->days) !!}

            {{-- ================= PRICE ================= --}}
            <div class="exclusive-offers__carousel-price-box">

                {{-- PER PERSON --}}
                <div class="d-flex justify-content-between align-items-center">
                    <p class="text-muted">{{__('package.pricing.starting_from')}}</p>

                    <div class="d-flex align-items-center gap-1 text-muted">
                        <img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                        <p class="fw-bold text-dark mb-0">
                            {{ number_format($perPersonPrice) }}
                        </p>
                        / {{__('package.pricing.person')}}
                    </div>
                </div>

                {{-- TOTAL --}}
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-1 text-muted">
                        <img class="opacity-50"
                             src="{{ asset('frontend/assets/icons/riyal.svg') }}"
                             alt="Riyal">
                        {{ number_format($perPersonPrice) }}
                    </div>

                    <p class="text-muted small mb-0">
                        {{__('package.pricing.total_price')}}:
                        <img class="opacity-50"
                             src="{{ asset('frontend/assets/icons/riyal.svg') }}"
                             alt="Riyal">
                        {{ number_format($package->price->original_price) }}
                    </p>
                </div>

            </div>
        </div>
    </div>
</a>
