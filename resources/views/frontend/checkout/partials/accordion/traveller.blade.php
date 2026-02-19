<div class=" accordion accordion-flush mt-3 checkout-accordion" id="checkoutTravelDetails">
    <div class="accordion-item border rounded mb-3 pkg-details__accordion-item">
        <div class="accordion-header" data-bs-toggle="collapse" data-bs-target="#checkoutTravelCollapse"
            aria-expanded="true" aria-controls="checkoutTravelCollapse">
            <div class="d-flex gap-2 pkg-details__accordion-actions">
                <p class="fw-600">1. {{ __('checkout.traveller_details') }}</p>
            </div>
            <div class="d-flex justify-content-between align-items-center gap-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="accordion-icon">
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </div>
            </div>
        </div>

        <div id="checkoutTravelCollapse" class="accordion-collapse collapse show" aria-labelledby="headingOne"
            data-bs-parent="#checkoutTravelDetails">

            <div class="accordion-body">

                {{-- ================= HEADER COUNTS ================= --}}
                <div class="d-flex gap-1 mb-3">
                    <p class="fw-600">
                        {{ $totalTravellers }} Traveller{{ $totalTravellers !== 1 ? 's' : '' }}
                    </p>

                    @if ($totalTravellers > 0)
                        <div class="d-flex gap-2 p-small align-items-center">

                            <div class="vertical-divider h-75"></div>
                            <p>{{ $adultCount }} Adult{{ $adultCount !== 1 ? 's' : '' }}</p>
                            @if ($childCount > 0)
                                <div class="vertical-divider h-75"></div>
                                <p>{{ $childCount }} Child{{ $childCount !== 1 ? 'ren' : '' }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- ================= TRAVELLER LIST ================= --}}
                <div>
                    @foreach ($travellerSlots as $index => $slot)
                        @php
                            $traveller = $slot['data'];
                        @endphp

                        {{-- @dd($traveller) --}}

                        <div class="d-flex justify-content-between align-items-center checkout-traveller-header">

                            {{-- LEFT --}}
                            <div class="d-flex align-items-center gap-3">
                                <div class="traveller-icon flex-center rounded-4">
                                    <i class="fa-solid fa-user"></i>
                                </div>

                                <div>
                                    <h6 class="fw-600 p">
                                        {{ __('checkout.traveller') }} {{ $index + 1 }}
                                        <span class="text-muted p-small">
                                            ({{ ucfirst($slot['type']) }})
                                        </span>
                                    </h6>
                                    <div class="d-flex gap-1">
                                        {{-- ✅ NAME (JS UPDATE TARGET) --}}
                                        <p class="p-small fw-600 mb-0 traveller-name" data-slot="{{ $index }}">
                                            {{ $traveller['first_name'] ?? '' }}
                                            {{ $traveller['last_name'] ?? '' }}
                                        </p>


                                        {{-- ✅ MISSING TEXT (JS HIDE TARGET) --}}
                                        <p class="text-danger p-small mb-0 traveller-missing"
                                            data-slot="{{ $index }}"
                                            @if ($traveller) style="display:none" @endif>
                                            {{ __('checkout.traveller_details_missing') }}
                                        </p>

                                        {{-- REMOVE BUTTON --}}
                                        <button type="button"
                                            class="p-0 border-0 bg-transparent text-danger remove-traveller"
                                            data-slot="{{ $index }}"
                                            @if (!$traveller) style="display:none" @endif>
                                            <i class="fa-solid fa-circle-xmark"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- RIGHT --}}
                            <div class="flex-center gap-3">

                                {{-- ✅ STATUS CONTAINER (JS UPDATE TARGET) --}}
                                <div class="traveller-status" data-slot="{{ $index }}">
                                    @if ($traveller)
                                        <div class="flex-center gap-1 text-success">
                                            <i class="fa-solid fa-circle-check"></i>
                                            <p class="p-small fw-500 mb-0">{{ __('checkout.traveller_added') }}</p>
                                        </div>
                                    @endif
                                </div>

                                {{-- ✅ MODAL BUTTON --}}
                                <button type="button"
                                    class="btn btn-outline-primary rounded-pill fw-500 open-traveller-modal"
                                    data-bs-toggle="modal" data-bs-target="#travellerModal"
                                    data-slot="{{ $index }}" data-type="{{ $slot['type'] }}">
                                    {{ $traveller ? __('checkout.update') : __('checkout.add_traveller') }}

                                </button>

                            </div>

                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>

        </div>

    </div>
</div>
