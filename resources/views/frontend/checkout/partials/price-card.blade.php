<div class="card pkg-details__pricing-card checkout-pricing-card">

    {{-- GRAND TOTAL --}}
    <p class="fw-500 mb-1">
        Grand Total - {{ $checkout['adults'] }} Adult{{ $checkout['adults'] > 1 ? 's' : '' }}
        @if ($checkout['total_persons'] - $checkout['adults'] > 0)
            , {{ $checkout['total_persons'] - $checkout['adults'] }} Child
        @endif
    </p>

    <div class="d-flex align-items-center gap-1 mb-2">
        <img src="{{ asset('/frontend/assets/icons/riyal-primary.svg') }}" alt="Riyal">
        <h5 class="text-success fw-bold" id="grandTotalAmount">
            {{ number_format($checkout['final_total']) }}
        </h5>

        {{-- OPTIONAL DISCOUNT BADGE --}}
        @if (($package->price->discount_price ?? 0) > 0)
            <span class="badge primary-bg rounded-pill fw-600">
                {{ round((($package->price->discount_price - $package->price->per_person_price) / $package->price->discount_price) * 100) }}%
                OFF
            </span>
        @endif
    </div>

    <p class="fw-600">Pay Full Amount Now</p>
    <hr>

    {{-- FARE BREAKUP --}}
    <p class="fw-600 mb-2">Fare Breakup</p>

    {{-- BASE PRICE --}}
    <div class="pkg-details__additional-info-item p-2 d-flex align-items-start gap-2 mb-2 justify-content-between">
        <div>
            <p class="fw-600 p-small">Total Basic Cost</p>
            <p class="p-small text-light2">
                {{ number_format($checkout['base_price'] / max(1, $package->base_persons)) }}
                x {{ $package->base_persons }} Travellers
            </p>
        </div>
        <div class="d-flex align-items-center gap-1">
            <img src="{{ asset('/frontend/assets/icons/riyal-light.svg') }}" alt="Riyal">
            <p class="fw-600 text-light2">
                {{ number_format($checkout['base_price']) }}
            </p>
        </div>
    </div>

    {{-- EXTRA ADULTS --}}
    @if ($checkout['extra_adults'] > 0)
        <div class="pkg-details__additional-info-item p-2 d-flex align-items-start gap-2 mb-2 justify-content-between">
            <div>
                <p class="fw-600 p-small">Extra Adults</p>
                <p class="p-small text-light2">
                    {{ $checkout['extra_adults'] }}
                    x {{ number_format($checkout['extra_adult_per_price']) }}
                </p>
            </div>
            <div class="d-flex align-items-center gap-1">
                <img src="{{ asset('/frontend/assets/icons/riyal-light.svg') }}" alt="Riyal">
                <p class="fw-600 text-light2">
                    {{ number_format($checkout['extra_adult_total_price']) }}
                </p>
            </div>
        </div>
    @endif

    {{-- CHILD PRICE --}}
    @if ($checkout['child_total_price'] > 0)
        <div class="pkg-details__additional-info-item p-2 d-flex align-items-start gap-2 mb-2 justify-content-between">
            <div>
                <p class="fw-600 p-small">Children Price</p>
                <p class="p-small text-light2">
                    {{ number_format($checkout['child_per_price']) }} x
                    {{ $checkout['total_persons'] - $checkout['adults'] }} Child
                </p>
            </div>
            <div class="d-flex align-items-center gap-1">
                <img src="{{ asset('/frontend/assets/icons/riyal-light.svg') }}" alt="Riyal">
                <p class="fw-600 text-light2">
                    {{ number_format($checkout['child_total_price']) }}
                </p>
            </div>
        </div>
    @endif

    @if ($checkout['day_items_extra'] > 0)
        {{-- DAY ITEMS EXTRA COST --}}
        <div class="pkg-details__additional-info-item p-2 d-flex align-items-start gap-2 mb-2 justify-content-between">
            <div>
                <p class="fw-600 p-small">Add-On Cost</p>
                <p class="p-small text-light2">
                    Additional cost for selected add-on items
                </p>
            </div>
            <div class="d-flex align-items-center gap-1">
                <img src="{{ asset('/frontend/assets/icons/riyal-light.svg') }}" alt="Riyal">
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
            <p class="fw-600 p-small text-success">Coupon Discount</p>
            <p class="p-small text-light2" id="appliedCouponCode"></p>
        </div>

        <div class="d-flex align-items-center gap-1 text-success">
            <img src="{{ asset('/frontend/assets/icons/riyal-light.svg') }}">
            <p class="fw-600">
                - <span id="couponDiscountAmount">0</span>
            </p>
        </div>
    </div>

    {{-- FINAL TOTAL --}}
    <div class="pkg-details__additional-info-item p-2 d-flex align-items-start gap-2 mb-2 justify-content-between">
        <div>
            <p class="fw-600 p-small">Total Payable</p>
            <p class="p-small text-light2">
                All taxes included
            </p>
        </div>
        <div class="d-flex align-items-center gap-1">
            <img src="{{ asset('/frontend/assets/icons/riyal-light.svg') }}" alt="Riyal">
            <p class="fw-600 text-light2" id="totalPayableAmount">
                {{ number_format($checkout['final_total']) }}
            </p>
        </div>
    </div>
    <div class="mt-3">
        <p class="fw-600 mb-2">Payment Method</p>
        <div class="form-check">
            <input class="form-check-input" type="radio" value="bank" name="payment_method" id="bankTransfer" required>
            <label class="form-check-label" for="bankTransfer">
                Bank Transfer
            </label>
        </div>
    </div>
    {{-- T&C --}}
    <div class="mt-3">
        <p class="fw-600">Important Information</p>
        <div class="form-check mt-2">
            <input name="accept_terms" required class="form-check-input" type="checkbox" id="tncCheck" required>
            <label class="form-check-label p-micro" for="tncCheck">
                I confirm that I have read and I accept
                Cancellation Policy, User Agreement, Terms of
                Service and Privacy Policy
            </label>
        </div>

        <button id="checkoutContinueBtn" type="submit"
            class="btn btn-primary rounded-pill w-100 mt-2 justify-content-between">
            Continue
            <i class="fa-solid fa-angles-right"></i>
        </button>
    </div>

</div>
