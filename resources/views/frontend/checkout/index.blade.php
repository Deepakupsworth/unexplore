@extends('frontend.layout')
@section('title','Checkout')

@section('meta_description', '')
@section('content')


    <script>
        window.CHECKOUT = {
            adults: {{ (int) ($checkout['adults'] ?? 0) }},
            travellers: @json($travellerSlots)
        };
    </script>

  <?php
        use Carbon\Carbon;

        $availability = $package->availabilities;

        $startDate = $availability?->available_from ? Carbon::parse($availability->available_from) : null;
        $startDate = Carbon::parse($checkout['start_date']);

        $endDate = $startDate ? $startDate->copy()->addDays($package->duration_days - 1) : null;

        // fallback values (agar dynamic selection abhi nahi hai)
        $rooms = 1;
        $adults = 3;

    ?>

    <section class="checkout-section">
        <div class="container">
            <form method="POST" action="{{ route('checkout.book') }}" id="checkoutForm">
                @csrf
                <input type="hidden" name="travellers_completed" id="travellers_completed" value="0">
                <input type="hidden" name="applied_coupon_code" id="appliedCouponInput">
                <input type="hidden" name="coupon_discount" id="couponDiscountInput">
                <input type="hidden" name="final_payable" id="finalPayableInput">
                <div class="row">
                    <div class="col-lg-9">

                        {{-- ================= CHECKOUT HEADER ================= --}}
                        @include('frontend.checkout.partials.header')

                        {{-- ================= TRAVELLER DETAILS ACCORDION ================= --}}
                        @include('frontend.checkout.partials.accordion.traveller', [
                            'travellerSlots' => $travellerSlots,
                            'totalTravellers' => $totalTravellers,
                            'adultCount' => $adultCount,
                            'childCount' => $childCount,
                        ])
                        {{-- Billing Details --}}
                        @include('frontend.checkout.partials.accordion.billing')

                        {{-- ================= PACKAGE ADD-ONS ACCORDION ================= --}}

                        {{-- @include('frontend.checkout.partials.accordion.add-on') --}}

                        {{-- ================= PACKAGE DETAILS ACCORDION ================= --}}

                        @include('frontend.checkout.partials.accordion.package')

                        {{-- ================= CANCELLATION & DATE CHANGE ================= --}}
                        @include('frontend.checkout.partials.accordion.cancellation')

                    </div>
                    <div class="col-lg-3">
                        {{-- ================= PRICE CARD ================= --}}

                        @include('frontend.checkout.partials.price-card', ['checkout' => $checkout])


                        {{-- ================= COUPONS & OFFERS ================= --}}

                        @include('frontend.checkout.partials.coupon')

                    </div>
                </div>

            </form>
        </div>
    </section>

    <div class="modal fade" id="travellerModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content traveller-modal">

                <!-- HEADER -->
                <div class="modal-header">
                    <div>
                        <h6 class="modal-title fw-600 p-large">
                            {{ __('checkout.add_traveller_details') }}
                        </h6>
                        <p class="text-light2 p-small mb-0">
                            {{-- Traveller {{ max(1, $travellerCount) }}/{{ max(1, $travellerCount) }} --}}
                        </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div id="travellerForm">

                    <div class="modal-body">
                        <input type="hidden" id="current_traveller_index">

                        <!-- TABS -->
                        <div class="d-flex traveller-tabs gap-3 mb-3 flex-wrap">

                            @foreach ($travellerSlots as $index => $slot)
                                @php $t = $slot['data']; @endphp

                                <button type="button"
                                    class="btn btn-outline-secondary trav-btn d-flex gap-2 align-items-center"
                                    data-slot="{{ $index }}" data-id="{{ $t?->id ?? '' }}"
                                    data-first="{{ $t?->first_name ?? '' }}" data-last="{{ $t?->last_name ?? '' }}"
                                    data-dob="{{ $t?->dob ?? '' }}" data-gender="{{ $t?->gender ?? '' }}"
                                    data-country="{{ $t?->country ?? '' }}" data-type="{{ $slot['type'] }}">

                                    <div class="trav-btn__icon flex-center">
                                        <i class="fa-solid fa-user"></i>
                                    </div>

                                    <div>
                                        <span class="fw-500">{{ ucfirst($slot['type']) }}:</span>
                                        Traveller {{ $index + 1 }}

                                    </div>
                                </button>
                            @endforeach
                        </div>

                        <!-- 🔍 Traveller Search -->
                        {{-- <div class="mb-3">
                            <label class="form-label"> {{ __('checkout.search_existing_traveller') }}</label>
                            <input type="text" id="travellerSearchInput" class="form-control"
                                placeholder="Type traveller name...">
                            <div id="travellerSearchResults" class="list-group mt-2"></div>
                        </div> --}}

                        <!-- INFO -->
                        <div class="mb-3">
                            <h6 class="fw-600 p">{{ __('checkout.mandatory_information') }}</h6>
                            <p class="p-small text-light2">
                                <i class="fa-solid fa-circle-info"></i>
                                {{ __('checkout.please_enter_mandatory_information') }}
                            </p>
                        </div>

                        <!-- FORM -->
                        <div class="row g-3">

                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">{{ __('checkout.first_name') }} *</label>
                                <input type="text" id="first_name" class="form-control" required>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">{{ __('checkout.last_name') }} *</label>
                                <input type="text" id="last_name" class="form-control" required>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">{{ __('checkout.date_of_birth') }} *</label>
                                <input type="date" min="{{ now()->subYears(100)->format('Y-m-d') }}"
                                    max="{{ now()->format('Y-m-d') }}" id="dob" class="form-control" required>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">{{ __('checkout.gender') }} *</label>
                                <select id="gender" class="form-select form-control" required>
                                    <option value="">{{ __('checkout.select') }}</option>
                                    <option value="male">{{ __('checkout.male') }}</option>
                                    <option value="female">{{ __('checkout.female') }}</option>
                                </select>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">{{ __('checkout.country') }} *</label>

                                <select id="country" class="form-select myCountry" required>
                                    <option value="">{{ __('checkout.select_country') }}</option>

                                    @foreach ($countries as $country)
                                        <option value="{{ $country->code }}">
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> 



                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">{{ __('checkout.traveller_type') }} *</label>
                                <select id="type" class="form-select" required>
                                    <option value="">{{ __('checkout.select') }}</option>
                                    <option value="adult">{{ __('checkout.adult') }} </option>
                                    <option value="child">{{ __('checkout.child') }} </option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer traveller-footer">
                        <button type="button" class="btn btn-outline-secondary px-3 rounded-pill"
                            data-bs-dismiss="modal">
                            {{ __('checkout.cancel') }}
                        </button>

                        <button type="button" class="btn btn-success px-3 rounded-pill"
                            onclick="saveTravellerLocally()">
                            {{ __('checkout.confirm_details') }}
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            /* =========================================================
               INITIAL STATE
            ========================================================== */

            window.TRAVELLERS_STATE = @json($sessionTravellers ?? []);

            if (!Array.isArray(window.TRAVELLERS_STATE)) {
                window.TRAVELLERS_STATE = [];
            }

            const TOTAL_SLOTS = {{ $totalTravellers }};

            while (window.TRAVELLERS_STATE.length < TOTAL_SLOTS) {
                window.TRAVELLERS_STATE.push(null);
            }

            syncHiddenInputs();


            /* =========================================================
               OPEN MODAL (From Main Slot Button)
            ========================================================== */

            document.querySelectorAll('.open-traveller-modal').forEach(btn => {

                btn.addEventListener('click', function() {

                    const index = this.dataset.slot;

                    // Trigger modal tab click instead of locking slot
                    const modalTab = document.querySelector(`.trav-btn[data-slot="${index}"]`);
                    if (modalTab) {
                        modalTab.click();
                        
                     
                         // ✅ ALWAYS target the single select
                                const $countrySelect = $('#travellerModal .myCountry');

                                // 🔥 destroy only if already initialized
                                if ($countrySelect.hasClass('select2-hidden-accessible')) {
                                    $countrySelect.select2('destroy');
                                }

                                // ✅ init Select2 correctly inside modal
                                $countrySelect.select2({
                                    dropdownParent: $('#travellerModal'),
                                    width: '100%',
                                    placeholder: "{{ __('checkout.select_country') }}",
                                    allowClear: true
                                });

                                // ✅ restore saved value (if exists for this traveller)
                                // const selectedCountry = $('.trav-btn.active').data('country');
                                // if (selectedCountry) {
                                //     $countrySelect.val(selectedCountry).trigger('change');
                                // } else {
                                //     $countrySelect.val(null).trigger('change'); // 🔥 prevents first option auto-select
                                // }

                
                    }
                });

            });


            /* =========================================================
               MODAL TAB SWITCHING (NEW LOGIC)
            ========================================================== */

            document.querySelectorAll('.trav-btn').forEach(tab => {

                tab.addEventListener('click', function() {

                    const index = this.dataset.slot;
                    const slotType = this.dataset.type;

                    document.getElementById('current_traveller_index').value = index;

                    highlightActiveTab(index);
                    setDOBLimits(slotType);

                    const traveller = window.TRAVELLERS_STATE[index];

                    const typeSelect = document.getElementById('type');
                    typeSelect.value = slotType;
                    typeSelect.setAttribute('disabled', true);

                    if (traveller) {
                        fillForm(traveller);
                    } else {
                        resetTravellerForm(slotType);
                    }

                    // document.getElementById('travellerSearchInput').value = '';
                    // document.getElementById('travellerSearchResults').innerHTML = '';
                });

            });


            /* =========================================================
               SEARCH WITH DEBOUNCE
            ========================================================== */

            const debouncedSearch = debounce(function(e) {
                searchTraveller(e.target.value.trim());
            }, 400);

            // document.getElementById('travellerSearchInput')
            //     .addEventListener('input', debouncedSearch);

        });


        /* =========================================================
           SAVE TRAVELLER
        ========================================================== */

        function saveTravellerLocally() {

            const index = document.getElementById('current_traveller_index').value;
            const slotBtn = document.querySelector(`.trav-btn[data-slot="${index}"]`);
            const slotType = slotBtn.dataset.type;

            const traveller = {
                first_name: document.getElementById('first_name').value.trim(),
                last_name: document.getElementById('last_name').value.trim(),
                dob: document.getElementById('dob').value,
                gender: document.getElementById('gender').value,
                country: document.getElementById('country').value,
                type: slotType
            };

            if (!traveller.first_name || !traveller.last_name ||
                !traveller.dob || !traveller.gender ||
                !traveller.country) {

                alert("Please fill all fields");
                return;
            }

            window.TRAVELLERS_STATE[index] = traveller;

            updateTravellerUI(index);
            syncHiddenInputs();
            updateSession();

            bootstrap.Modal.getInstance(
                document.getElementById('travellerModal')
            ).hide();
        }


        /* =========================================================
            REMOVE TRAVELLER
        ========================================================= */

        document.addEventListener("click", function(e) {

            const btn = e.target.closest('.remove-traveller');
            if (!btn) return;

            const index = btn.dataset.slot;

            if (!confirm("Remove this traveller?")) return;

            // 1️⃣ Reset state
            window.TRAVELLERS_STATE[index] = null;

            // 2️⃣ UI Elements
            const nameEl = document.querySelector(`.traveller-name[data-slot="${index}"]`);
            const missingEl = document.querySelector(`.traveller-missing[data-slot="${index}"]`);
            const statusEl = document.querySelector(`.traveller-status[data-slot="${index}"]`);
            const updateBtn = document.querySelector(`.open-traveller-modal[data-slot="${index}"]`);

            // 3️⃣ Reset Name
            if (nameEl) nameEl.innerText = '';

            // 4️⃣ Show Missing Text
            if (missingEl) missingEl.style.display = 'block';

            // 5️⃣ Clear Status
            if (statusEl) statusEl.innerHTML = '';

            // 6️⃣ Hide Remove Button
            btn.style.display = "none";

            // 7️⃣ Reset Add/Update Button Text
            if (updateBtn) {
                updateBtn.innerText = "Add Traveller";
            }

            // 8️⃣ Sync Hidden Inputs
            syncHiddenInputs();

            // 9️⃣ Update Session
            updateSession();
        });



        /* =========================================================
           SEARCH FUNCTION
        ========================================================== */

        function searchTraveller(query) {

            const resultsBox = document.getElementById('travellerSearchResults');

            if (query.length < 2) {
                resultsBox.innerHTML = '';
                return;
            }

            const currentIndex = document.getElementById('current_traveller_index').value;
            const slotBtn = document.querySelector(`.trav-btn[data-slot="${currentIndex}"]`);
            const slotType = slotBtn.dataset.type;

            fetch("{{ route('checkout.search.traveller') }}?q=" + query)
                .then(res => res.json())
                .then(data => {

                    resultsBox.innerHTML = '';

                    data.forEach(traveller => {

                        if (traveller.type !== slotType) return;

                        const item = document.createElement('a');
                        item.href = "javascript:void(0)";
                        item.className = "list-group-item list-group-item-action";
                        item.innerText = traveller.first_name + " " + traveller.last_name;

                        item.addEventListener('click', function() {
                            fillForm(traveller);
                            resultsBox.innerHTML = '';
                            // document.getElementById('travellerSearchInput').value =
                            //     traveller.first_name + " " + traveller.last_name;
                        });

                        resultsBox.appendChild(item);
                    });
                });
        }


        /* =========================================================
           HIGHLIGHT ACTIVE TAB
        ========================================================== */

        // function highlightActiveTab(index) {

        //     document.querySelectorAll('.trav-btn').forEach(tab => {
        //         tab.classList.remove('active');
        //     });

        //     const active = document.querySelector(`.trav-btn[data-slot="${index}"]`);
        //     if (active) {
        //         active.classList.add('active');
        //     }
        // }

        function highlightActiveTab(index) {

            document.querySelectorAll('.trav-btn').forEach(tab => {

                const tabIndex = tab.dataset.slot;

                // remove active from all
                tab.classList.remove('active');

                // 🔥 disable all clicks
                tab.style.pointerEvents = 'none';
                tab.style.opacity = '0.6';
            });

            const active = document.querySelector(`.trav-btn[data-slot="${index}"]`);

            if (active) {
                active.classList.add('active');

                // ✅ enable only active tab
                active.style.pointerEvents = 'auto';
                active.style.opacity = '1';
            }
        }



        /* =========================================================
           DOB LIMITS
        ========================================================== */

        function setDOBLimits(slotType) {

            const dob = document.getElementById('dob');
            const today = new Date();

            if (slotType === 'adult') {

                const minDate = new Date();
                minDate.setFullYear(today.getFullYear() - 100);

                const maxDate = new Date();
                maxDate.setFullYear(today.getFullYear() - 12);

                dob.min = minDate.toISOString().split("T")[0];
                dob.max = maxDate.toISOString().split("T")[0];

            } else {

                const minDate = new Date();
                minDate.setFullYear(today.getFullYear() - 11);

                const maxDate = new Date();
                maxDate.setFullYear(today.getFullYear() - 2);

                dob.min = minDate.toISOString().split("T")[0];
                dob.max = maxDate.toISOString().split("T")[0];
            }
        }



        function updateTravellerUI(index) {

            const traveller = window.TRAVELLERS_STATE[index];

            const nameEl = document.querySelector(`.traveller-name[data-slot="${index}"]`);
            const missingEl = document.querySelector(`.traveller-missing[data-slot="${index}"]`);
            const statusEl = document.querySelector(`.traveller-status[data-slot="${index}"]`);
            const removeBtn = document.querySelector(`.remove-traveller[data-slot="${index}"]`);
            const actionBtn = document.querySelector(`.open-traveller-modal[data-slot="${index}"]`);

            if (!nameEl || !missingEl || !statusEl) return;

            // Update name
            nameEl.innerText = traveller.first_name + " " + traveller.last_name;

            // Hide missing text
            missingEl.style.display = "none";

            // Show status
            statusEl.innerHTML = `
            <div class="flex-center gap-1 text-success">
                <i class="fa-solid fa-circle-check"></i>
                <p class="p-small fw-500 mb-0">Traveller Added</p>
            </div>
            `;

            // 🔥 SHOW REMOVE BUTTON
            if (removeBtn) {
                removeBtn.classList.remove('d-none');
                removeBtn.style.display = "inline-block";
            }

            // Change Add → Update
            if (actionBtn) {
                actionBtn.innerText = "Update";
            }
        }


        /* =========================================================
           SYNC HIDDEN INPUTS
        ========================================================== */

        function syncHiddenInputs() {

            const form = document.querySelector('form');

            document.querySelectorAll('input[name^="travellers"]').forEach(el => el.remove());

            window.TRAVELLERS_STATE.forEach((traveller, index) => {

                if (!traveller) return;

                Object.keys(traveller).forEach(key => {

                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = `travellers[${index}][${key}]`;
                    input.value = traveller[key];

                    form.appendChild(input);
                });
            });
        }


        /* =========================================================
           SESSION UPDATE
        ========================================================== */

        function updateSession() {

            fetch("{{ route('checkout.update.session') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    travellers: window.TRAVELLERS_STATE
                })
            });
        }


        /* =========================================================
           FORM HELPERS
        ========================================================== */

        function resetTravellerForm(type) {

            document.getElementById('first_name').value = '';
            document.getElementById('last_name').value = '';
            document.getElementById('dob').value = '';
            document.getElementById('gender').value = '';
            document.getElementById('country').value = '';
            document.getElementById('type').value = type;
        }

        function fillForm(traveller) {

            document.getElementById('first_name').value = traveller.first_name || '';
            document.getElementById('last_name').value = traveller.last_name || '';
            document.getElementById('dob').value = traveller.dob || '';
            document.getElementById('gender').value = traveller.gender || '';
            document.getElementById('country').value = traveller.country || '';
        }


        /* =========================================================
           DEBOUNCE UTILITY
        ========================================================== */

        function debounce(func, delay = 400) {
            let timer;
            return function(...args) {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    func.apply(this, args);
                }, delay);
            };
        }
    </script>

    <script>
        /* =========================================================
                           BLOCK BOOKING IF TRAVELLERS NOT COMPLETE
                        ========================================================== */
        document.addEventListener("DOMContentLoaded", function() {

            const form = document.getElementById("checkoutForm");
            const continueBtn = document.getElementById("checkoutContinueBtn");

            if (!form || !continueBtn) return;

            function validateTravellers() {

                const totalSlots = {{ $totalTravellers }};
                const state = window.TRAVELLERS_STATE || [];

                const filled = state.filter(t => t !== null).length;

                if (filled !== totalSlots) {

                    iziToast.error({
                        title: 'Incomplete Details',
                        message: `Please complete all traveller details (${filled}/${totalSlots} completed).`,
                        position: 'topRight',
                        timeout: 5000
                    });

                    const section = document.getElementById("checkoutTravelDetails");
                    if (section) {
                        section.scrollIntoView({
                            behavior: "smooth"
                        });
                    }

                    return false;
                }

                return true;
            }

            /* =========================
               BUTTON CLICK BLOCK
            ========================== */

            continueBtn.addEventListener("click", function(e) {

                if (!validateTravellers()) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    return false;
                }
            });

            /* =========================
               FORM SUBMIT DOUBLE CHECK
            ========================== */

            form.addEventListener("submit", function(e) {

                if (!validateTravellers()) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    return false;
                }
            });

        });
    </script>


    {{-- coupon js --}}
    <script>
        function applyCoupon(code) {
            document.getElementById('couponCodeInput').value = code;
            applyCouponFromInput();
        }

        function applyCouponFromInput() {
            const code = document.getElementById('couponCodeInput').value.trim();
            const packageId = document.getElementById('packageId').value;
            const errorBox = document.getElementById('couponError');

            errorBox.classList.add('d-none');
            errorBox.innerText = '';

            if (!code) {
                errorBox.innerText = 'Please enter a coupon code';
                errorBox.classList.remove('d-none');
                return;
            }

            fetch("{{ route('coupon.apply') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        code: code,
                        package_id: packageId
                    })
                })
                .then(res => res.json().then(data => ({
                    ok: res.ok,
                    data
                })))
                .then(({
                    ok,
                    data
                }) => {

                    if (!ok) {
                        errorBox.innerText = data.message || 'Invalid coupon';
                        iziToast.error({
                            title: 'Coupon Failed',
                            message: data.message || 'Invalid coupon',
                            position: 'topRight'
                        });
                        errorBox.classList.remove('d-none');
                        return;
                    }
                    console.log(data.discount);

                    // ✅ SUCCESS (controller response)
                    // alert(
                    //     `Coupon Applied Successfully\n\n` +
                    //     `Code: ${data.code}\n` +
                    //     `Discount: ₹${data.discount}\n` +
                    //     `Final Price: ₹${data.final_price}`
                    // );
                    updateCheckoutPrice(data);
                    highlightAppliedCoupon(data.code);
                })
                .catch((err) => {
                    console.error('Error applying coupon', err);
                    errorBox.innerText = 'Server error. Please try again.';
                    errorBox.classList.remove('d-none');
                });
        }

        function highlightAppliedCoupon(code) {
            document.querySelectorAll('.checkout-coupon-card').forEach(card => {
                card.classList.toggle(
                    'border-success',
                    card.dataset.code === code
                );
            });
        }

        function updateCheckoutPrice(data) {

            const grandTotal = document.getElementById('grandTotalAmount');
            const totalPayable = document.getElementById('totalPayableAmount');

            const couponRow = document.getElementById('couponDiscountRow');
            const couponAmount = document.getElementById('couponDiscountAmount');
            const couponCode = document.getElementById('appliedCouponCode');

            // hidden inputs
            const couponCodeInput = document.getElementById('appliedCouponInput');
            const couponDiscountInput = document.getElementById('couponDiscountInput');
            const finalPayableInput = document.getElementById('finalPayableInput');

            // UI UPDATE
            grandTotal.innerText = formatPrice(data.final_price);
            totalPayable.innerText = formatPrice(data.final_price);

            couponAmount.innerText = formatPrice(data.discount);
            couponCode.innerText = `Applied Coupon: ${data.code}`;
            couponRow.classList.remove('d-none');

            // 🔥 FORM DATA UPDATE (MOST IMPORTANT)
            couponCodeInput.value = data.code;
            couponDiscountInput.value = data.discount;
            finalPayableInput.value = data.final_price;
        }


        function formatPrice(val) {
            return Number(val).toLocaleString('en-IN');
        }
    </script>

<script>
        $('.selectCountrySelect2').select2();
        </script>

 
@endsection
