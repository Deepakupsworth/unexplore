<div class="accordion accordion-flush mt-3 checkout-accordion" id="checkoutPackageAddOn">
    <div class="accordion-item border rounded mb-3 pkg-details__accordion-item">
        <div class="accordion-header" data-bs-toggle="collapse" data-bs-target="#checkoutPackageAddOnCollapse"
            aria-expanded="true" aria-controls="checkoutPackageAddOnCollapse">
            <div class="d-flex gap-2 pkg-details__accordion-actions">
                <p class="fw-600">2. Package Add-Ons</p>
            </div>
            <div class="d-flex justify-content-between align-items-center gap-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="accordion-icon">
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </div>
            </div>
        </div>

        <div id="checkoutPackageAddOnCollapse" class="accordion-collapse collapse show" aria-labelledby="headingOne"
            data-bs-parent="#checkoutPackageAddOn">
            <div class="accordion-body">

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <img src="{{ asset('/frontend/assets/icons/medical.svg') }}" alt="Medical Insurance">
                        <div>
                            <p class="fw-600">Travel + Medical Insurance</p>
                            <p class="text-light2 p-small">Secure your trip and travel worry
                                free</p>
                        </div>
                    </div>
                </div>

                <div class="checkout-tcs-box p-3 rounded-4">
                    <div
                        class="d-flex justify-content-between align-items-start align-items-sm-center flex-column flex-sm-row gap-2">
                        <div class="d-flex gap-3 align-items-start align-items-sm-center flex-column flex-sm-row">
                            <div>
                                <p class="fw-600">$550K Travel Insurance</p>
                                <p class="text-light2 p-small">99% Claims Settled</p>
                            </div>
                            <span class="rounded-pill checkout-package-badge p-small">MOST
                                POPULAR</span>
                        </div>
                        <a href="#" class="fw-600 primary-text">View T&Cs</a>
                    </div>
                    <hr>
                    <p class="fw-600 p-small mb-2">What's Included</p>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="d-flex flex-column gap-1">
                            <div class="d-flex gap-2 align-items-center">
                                <img src="{{ asset('/frontend/assets/icons/emergency.svg') }}" alt="Emergency Medical">
                                <span class="p-small">Emergency Medical Expenses –
                                    <span class="fw-600">$500000</span></span>
                            </div>
                            <div class="d-flex gap-2 align-items-center">
                                <img src="{{ asset('/frontend/assets/icons/trip-cancel.svg') }}"
                                    alt="Trip Cancellation">
                                <span class="p-small">Trip Cancellation and/or Interruption  –
                                    <span class="fw-600">$1250</span></span>
                            </div>
                            <div class="d-flex gap-2 align-items-center">
                                <img src="{{ asset('/frontend/assets/icons/baggage.svg') }}" alt="Baggage Delay">
                                <span class="p-small">Delay of Checked In Baggage –
                                    <span class="fw-600">$125</span></span>
                            </div>
                            <a href="#" class="primary-text mt-2 p-small fw-500">View
                                Benefits</a>
                        </div>
                        <div class="text-end">
                            <p class="fw-600">+ $12,00</p>
                            <p class="p-small text-light2">per person</p>
                            <button class="btn btn-outline-primary rounded-pill px-4 mt-3">Select</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
