{{-- ================= REQUIRED HIDDEN DATA ================= --}}
<input type="hidden" id="packageId" value="{{ $package->id }}">


{{-- ================= COUPON INPUT ================= --}}
<div class="card pkg-details__pricing-card checkout-pricing-card mt-3">
    <p class="fw-600">Coupons & Offers</p>

    <div class="input-group mt-3 package-listing__search-bar checkout-pricing-card__search-bar">
        <input type="text" id="couponCodeInput" class="form-control" placeholder="Enter Coupon Code">
        <button class="btn btn-primary btn-sm rounded-pill p-small" type="button" onclick="applyCouponFromInput()">
            Apply
        </button>
    </div>

    <p id="couponError" class="text-danger p-small mt-2 d-none"></p>
</div>

{{-- ================= COUPON LIST ================= --}}
@if ($coupons->count())
    <div class="checkout-coupon-section mb-3">

        @foreach ($coupons as $coupon)
            @php
                $stripText =
                    $coupon->discount_type === 'percentage'
                        ? rtrim(rtrim($coupon->discount_value, '0'), '.') . '% OFF'
                        : '₹' . number_format($coupon->discount_value) . ' OFF';
            @endphp

            <div class="checkout-coupon-card d-flex mt-3" data-code="{{ $coupon->code }}">

                <div class="checkout-coupon-left-strip d-flex justify-content-center align-items-center">
                    <p class="checkout-coupon-left-strip-label fw-600">
                        {{ $stripText }}
                    </p>
                </div>

                <div class="flex-grow-1 p-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="d-flex primary-text p-large gap-1 align-items-center">
                                <p>-</p>
                                <img src="{{ asset('/frontend/assets/icons/riyal-primary.svg') }}" alt="">
                                <p>{{ number_format($checkout['final_total']) }}</p>
                            </div>

                            <h6 class="fw-600 mb-1 p-large">
                                {{ $coupon->code }}
                            </h6>
                        </div>

                        <div class="checkout-offer-icon">
                            <img src="{{ asset('/frontend/assets/icons/offer.svg') }}" alt="">
                        </div>
                    </div>

                    <p class="text-muted p-small mb-3">
                        {{ $coupon->title }}
                    </p>

                    <button type="button" class="btn apply-btn w-100 rounded-pill"
                        onclick="applyCoupon('{{ $coupon->code }}')">
                        Apply Code
                    </button>
                </div>
            </div>
        @endforeach

        <div class="mt-3 text-center">
            <a href="#" class="primary-text">
                + {{ $coupons->count() }} More
            </a>
        </div>

    </div>
@endif
