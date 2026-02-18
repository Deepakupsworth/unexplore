@php
$checkout = $checkout['pricing'];
@endphp
{{-- @dd($checkout); --}}
<div class="card pkg-details__pricing-card checkout-pricing-card">

    {{-- GRAND TOTAL --}}
    <p class="fw-500 mb-1">
        {{ __('checkout.grand_total') }} - {{ $checkout['adults'] }} {{ $checkout['adults'] > 1 ? __('checkout.adults') : __('checkout.adult') }}

        @if ($checkout['total_persons'] - $checkout['adults'] > 0)
            , {{ $checkout['total_persons'] - $checkout['adults'] }} {{ __('checkout.child') }}
        @endif
    </p>

    <div class="d-flex align-items-center gap-1 mb-2">
        <img src="{{ asset(currency_icon_path(null, 'primary')) }}" alt="Riyal">
        <h5 class="text-success fw-bold" id="grandTotalAmount">
            {{ number_format($checkout['final_total']) }}
        </h5>

        {{-- OPTIONAL DISCOUNT BADGE --}}
        @if (($package->price->discount_price ?? 0) > 0)
            <span class="badge primary-bg rounded-pill fw-600">
                {{ round((($package->price->discount_price - $package->price->per_person_price) / $package->price->discount_price) * 100) }}%
                {{ __('checkout.off') }}
            </span>
        @endif
    </div>


    <p class="fw-600">{{ __('checkout.pay_full_amount') }}</p>
    <hr>

    {{-- FARE BREAKUP --}}
    <p class="fw-600 mb-2">{{ __('checkout.fare_breakup') }}</p>

    {{-- BASE PRICE --}}
    <div class="pkg-details__additional-info-item p-2 d-flex align-items-start gap-2 mb-2 justify-content-between">
        <div>
            <p class="fw-600 p-small">{{ __('checkout.total_basic_cost') }}</p>
            <p class="p-small text-light2">
                {{-- {{ number_format($checkout['base_price'] / max(1, $package->base_persons)) }}
                x --}}
                {{ $package->base_persons }} {{ __('checkout.travellers') }}
            </p>
        </div>
        <div class="d-flex align-items-center gap-1">
            <img src="{{ asset(currency_icon_path(null, 'light')) }}" alt="Riyal">
            <p class="fw-600 text-light2">
                {{ number_format($checkout['base_price']) }}
            </p>
        </div>
    </div>

    {{-- EXTRA ADULTS --}}
    @if ($checkout['extra_adults'] > 0)
        <div class="pkg-details__additional-info-item p-2 d-flex align-items-start gap-2 mb-2 justify-content-between">
            <div>
                <p class="fw-600 p-small">{{ __('checkout.extra_adults') }}</p>
                <p class="p-small text-light2">
                    {{ $checkout['extra_adults'] }} {{ __('checkout.adult') }}

                    {{-- x {{ number_format($checkout['extra_adult_per_price']) }} --}}
                </p>
            </div>
            <div class="d-flex align-items-center gap-1">
                <img src="{{ asset(currency_icon_path(null, 'light')) }}" alt="Riyal">
                <p class="fw-600 text-light2">
                    {{ number_format($checkout['extra_adult_total']) }}
                </p>
            </div>
        </div>
    @endif

    {{-- CHILD PRICE --}}
    @if ($checkout['child_total'] > 0)
        <div class="pkg-details__additional-info-item p-2 d-flex align-items-start gap-2 mb-2 justify-content-between">
            <div>
                <p class="fw-600 p-small">{{ __('checkout.children_price') }}</p>
                <p class="p-small text-light2">
                    {{-- {{ number_format($checkout['child_per_price']) }} x --}}
                    {{ $checkout['child'] }}
                    {{ __('checkout.child') }}
                </p>
            </div>
            <div class="d-flex align-items-center gap-1">
                <img src="{{ asset(currency_icon_path(null, 'light')) }}" alt="Riyal">
                <p class="fw-600 text-light2">
                    {{ number_format($checkout['child_total']) }}
                </p>
            </div>
        </div>
    @endif

    @if ($checkout['day_items_extra'] > 0)
        {{-- DAY ITEMS EXTRA COST --}}
        <div class="pkg-details__additional-info-item p-2 d-flex align-items-start gap-2 mb-2 justify-content-between">
            <div>
                <p class="fw-600 p-small">{{ __('checkout.addon_cost') }}</p>
                <p class="p-small text-light2">
                    {{ __('checkout.additional_cost_selected_addons') }}
                </p>
            </div>
            <div class="d-flex align-items-center gap-1">
                <img src="{{ asset(currency_icon_path(null, 'light')) }}" alt="Riyal">
                <p class="fw-600 text-light2">
                    {{ number_format($checkout['day_items_extra']) }}
                </p>
            </div>
        </div>
    @endif

    {{-- COUPON DISCOUNT (HIDDEN BY DEFAULT) --}}
    <div id="couponDiscountRow"
        class="pkg-details__additional-info-item p-2 d-none
       d-flex align-items-start gap-2 mb-2 justify-content-between">

        <div>
            <p class="fw-600 p-small text-success">{{ __('checkout.coupon_discount') }}</p>
            <p class="p-small text-light2" id="appliedCouponCode"></p>
        </div>

        <div class="d-flex align-items-center gap-1 text-success">
            <img src="{{ asset(currency_icon_path(null, 'light')) }}">
            <p class="fw-600">
                - <span id="couponDiscountAmount">0</span>
            </p>
        </div>
    </div>

    {{-- FINAL TOTAL --}}
    <div class="pkg-details__additional-info-item p-2 d-flex align-items-start gap-2 mb-2 justify-content-between">
        <div>
            <p class="fw-600 p-small">{{ __('checkout.total_payable') }}</p>
            <p class="p-small text-light2">
                {{ __('checkout.all_taxes_included') }}
            </p>
        </div>
        <div class="d-flex align-items-center gap-1">
            <img src="{{ asset(currency_icon_path(null, 'light')) }}" alt="Riyal">
            <p class="fw-600 text-light2" id="totalPayableAmount">
                {{ number_format($checkout['final_total']) }}
            </p>
        </div>
    </div>
    <div class="mt-3">
        <p class="fw-600 mb-2">{{ __('checkout.payment_method') }}</p>
        <div class="form-check">
            <input class="form-check-input" type="radio" value="bank" name="payment_method" id="bankTransfer" required>
            <label class="form-check-label" for="bankTransfer">
                {{ __('checkout.bank_transfer') }}
            </label>
        </div>
    </div>
    {{-- T&C --}}
    <div class="mt-3">
        <p class="fw-600">{{ __('checkout.important_information') }}</p>
        <div class="form-check mt-2">
            <input name="accept_terms" required class="form-check-input" type="checkbox" id="tncCheck" required>
            <label class="form-check-label p-micro" for="tncCheck">
                {{ __('checkout.accept_terms_text') }}
            </label>
        </div>

        <button id="checkoutContinueBtn" type="submit"
            class="btn btn-primary rounded-pill w-100 mt-2 justify-content-between">
            {{ __('checkout.continue') }}
            <i class="fa-solid fa-angles-right"></i>
        </button>
    </div>

</div>
