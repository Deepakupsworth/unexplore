<div class="exclusive-offers__carousel-item">

    <div class="exclusive-offers__carousel-item-img">
        <img
            src="{{ $package->thumb
                ? asset('storage/' . $package->thumb->image_path)
                : asset('frontend/assets/destinations/hail/3.jpg')
            }}"
            class="img-fluid"
            alt="{{ $package->title }}"
        >

        <div class="badge carousel-badge">
            <i class="fa-solid fa-location-dot"></i>
            {{ optional($package->cities->first()?->city)->name }}
        </div>
    </div>

    <div class="exclusive-offers__carousel-item-info">

        <div class="d-flex justify-content-between mb-1">
            <h6 class="fw-bold mb-0">
                {{ $package->title }}
            </h6>

            <span class="badge carousel-badge-outline rounded-pill">
                {{ $package->duration_nights }}N /
                {{ $package->duration_days }}D
            </span>
        </div>

        <p class="text-muted small mb-2">
            {{ $package->sub_title }}
        </p>

        <hr>

        {!! packageListingUl($package->days) !!}

        <div class="exclusive-offers__carousel-price-box">
            <div class="d-flex justify-content-between align-items-center">
                <p class="text-muted">Only for now</p>
                <div class="d-flex align-items-center gap-1 text-muted">
                    <img src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                    <p class="fw-bold text-dark">{{ number_format($package->price->per_person_price ?? 0) }}</p> /Person
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-1 text-muted">
                    <img class="opacity-50" src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal">
                    8,332
                </div>
                <p class="text-muted small">Total Price: <img class="opacity-50"
                        src="{{ asset('frontend/assets/icons/riyal.svg') }}" alt="Riyal"> 1,22,100</p>
            </div>
        </div>

    </div>
</div>
