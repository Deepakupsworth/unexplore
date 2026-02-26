<div class="accordion accordion-flush mt-3 checkout-accordion" id="checkoutBillingAccordion">
    <div class="accordion-item border rounded mb-3 pkg-details__accordion-item">

        {{-- HEADER --}}
        <div class="accordion-header" data-bs-toggle="collapse" data-bs-target="#checkoutBillingCollapse"
            aria-expanded="true" aria-controls="checkoutBillingCollapse">

            <div class="d-flex gap-2 pkg-details__accordion-actions">
                <p class="fw-600">2. {{ __('checkout.billing_details') }}</p>
            </div>

            <div class="d-flex justify-content-between align-items-center gap-3">
                <div class="accordion-icon">
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
            </div>
        </div>

        {{-- COLLAPSE --}}
        <div id="checkoutBillingCollapse" class="accordion-collapse collapse show"
            data-bs-parent="#checkoutBillingAccordion">

            <div class="accordion-body">
                <div class="row g-3 mb-4">

                    {{-- FULL NAME --}}
                    <div class="col-md-4">
                        <label class="form-label small mb-1">
                            {{ __('checkout.full_name') }}
                        </label>
                        <input type="text" name="billing[full_name]" class="form-control"
                            placeholder="{{ __('checkout.enter_full_name') }}"
                            value="{{ old('billing.full_name', $defaultBilling?->full_name ?? '') }}" required>
                    </div>

                    {{-- PHONE --}}
                    <div class="col-md-4">
                        <label class="form-label small mb-1">
                            {{ __('checkout.mobile') }}
                        </label>
                        <input type="tel" name="billing[phone]" class="form-control" placeholder="05XXXXXXXX"
                            value="{{ old('billing.phone', $defaultBilling?->phone ?? '') }}" required>
                    </div>

                    {{-- EMAIL --}}
                    <div class="col-md-4">
                        <label class="form-label small mb-1">
                            {{ __('checkout.email') }}
                        </label>
                        <input type="email" name="billing[email]" class="form-control"
                            placeholder="{{ __('checkout.enter_email') }}"
                            value="{{ old('billing.email', $defaultBilling?->email ?? '') }}">
                    </div>

                    {{-- COUNTRY --}}
                    <div class="col-md-4">
                        <label class="form-label small mb-1">
                            {{ __('checkout.country') }}
                        </label>

                        @php
                            $selectedCountry = old('billing.country_code') ?? $defaultBilling?->country_code;
                        @endphp

                        <select name="billing[country_code]" class="form-select selectCountrySelect2" required>
                            <option value="">{{ __('checkout.select_country') }}</option>

                            @foreach ($countries as $country)
                                <option value="{{ $country->code }}" @selected($selectedCountry == $country->code)>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- CITY --}}
                    <div class="col-md-4">
                        <label class="form-label small mb-1">
                            {{ __('checkout.city') }}
                        </label>
                        <input type="text" name="billing[city]" class="form-control"
                            placeholder="{{ __('checkout.enter_city') }}"
                            value="{{ old('billing.city', $defaultBilling?->city ?? '') }}" required>
                    </div>

                    {{-- POSTAL --}}
                    <div class="col-md-4">
                        <label class="form-label small mb-1">
                            {{ __('checkout.postal_code') }}
                        </label>
                        <input type="text" name="billing[postal_code]" class="form-control" placeholder="12345"
                            value="{{ old('billing.postal_code', $defaultBilling?->postal_code ?? '') }}" required>
                    </div>

                    {{-- ADDRESS --}}
                    <div class="col-md-12">
                        <label class="form-label small mb-1">
                            {{ __('checkout.address') }}
                        </label>
                        <input type="text" name="billing[address_line1]" class="form-control"
                            placeholder="{{ __('checkout.enter_address') }}"
                            value="{{ old('billing.address_line1', $defaultBilling?->address_line1 ?? '') }}" required>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
