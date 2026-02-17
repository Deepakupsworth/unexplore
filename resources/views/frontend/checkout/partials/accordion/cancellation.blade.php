@if ($package->policies->count())
    <div class="accordion accordion-flush mt-3 checkout-accordion" id="checkoutPolicies">

        <div class="accordion-item border rounded mb-3 pkg-details__accordion-item">

            {{-- Accordion Header --}}
            <div class="accordion-header" data-bs-toggle="collapse" data-bs-target="#checkoutPoliciesCollapse"
                aria-expanded="true" aria-controls="checkoutPoliciesCollapse">

                <div class="d-flex gap-2 pkg-details__accordion-actions">
                    <p class="fw-600">
                         3. {{ __('checkout.policies') }}
                    </p>
                </div>

                <div class="d-flex justify-content-between align-items-center gap-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="accordion-icon">
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Accordion Body --}}
            <div id="checkoutPoliciesCollapse" class="accordion-collapse collapse show"
                data-bs-parent="#checkoutPolicies">

                <div class="accordion-body">

                    @foreach ($package->policies as $policy)
                        <div class="mb-3">
                            {!! $policy->translation->content !!}
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>
@endif
