@extends('frontend.layout')
@section('content')
    @php
        $travellerSlots = collect($travellers);

        $totalTravellers = $travellerSlots->count();
        $adultCount = $travellerSlots->where('type', 'adult')->count();
        $childCount = $travellerSlots->where('type', 'child')->count();
    @endphp

    <script>
        window.CHECKOUT = {
            adults: {{ (int) ($checkout['adults'] ?? 0) }},
            travellers: @json($travellerSlots->values())
        };
    </script>

    @php
        use Carbon\Carbon;

        $availability = $package->availabilities;

        $startDate = $availability?->available_from ? Carbon::parse($availability->available_from) : null;

        $endDate = $startDate ? $startDate->copy()->addDays($package->duration_days - 1) : null;

        // fallback values (agar dynamic selection abhi nahi hai)
        $rooms = 1;
        $adults = 3;
    @endphp

    <section class="checkout-section">
        <div class="container">
            <form method="POST" action="{{ route('checkout.book') }}">
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
                            Add Traveller Details
                        </h6>
                        <p class="text-light2 p-small mb-0">
                            {{-- Traveller {{ max(1, $travellerCount) }}/{{ max(1, $travellerCount) }} --}}
                        </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form method="POST" id="travellerForm">

                    @csrf

                    <input type="hidden" name="traveller_id" id="traveller_id">

                    <div class="modal-body">

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


                        <!-- INFO -->
                        <div class="mb-3">
                            <h6 class="fw-600 p">Mandatory Information</h6>
                            <p class="p-small text-light2">
                                <i class="fa-solid fa-circle-info"></i>
                                Please Enter Mandatory Information
                            </p>
                        </div>

                        <!-- FORM -->
                        <div class="row g-3">

                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">First Name *</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" required>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">Last Name *</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" required>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">Date of Birth *</label>
                                <input type="date" name="dob" id="dob" class="form-control" required>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">Gender *</label>
                                <select name="gender" id="gender" class="form-select" required>
                                    <option value="">Select</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">Country *</label>
                                <input type="text" name="country" id="country" class="form-control" required>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">Traveller Type *</label>
                                <select name="type" id="type" class="form-select" required>
                                    <option value="">Select Type</option>
                                    <option value="adult">Adult</option>
                                    <option value="child">Child</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer traveller-footer">
                        <button type="button" class="btn btn-outline-secondary px-3 rounded-pill" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-success px-3 rounded-pill">
                            Confirm Details
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const modal = document.getElementById('travellerModal');
            const form = document.getElementById('travellerForm');

            const f = {
                id: document.getElementById('traveller_id'),
                first: document.getElementById('first_name'),
                last: document.getElementById('last_name'),
                dob: document.getElementById('dob'),
                gender: document.getElementById('gender'),
                country: document.getElementById('country'),
                type: document.getElementById('type'),
            };

            /* ---------------- RESET FORM ---------------- */
            function resetForm(type) {
                form.reset();
                f.id.value = '';
                f.type.value = type || 'adult';
            }

            /* ---------------- FILL FORM ---------------- */
            function fillForm(btn) {
                f.id.value = btn.dataset.id || '';
                f.first.value = btn.dataset.first || '';
                f.last.value = btn.dataset.last || '';
                f.dob.value = btn.dataset.dob || '';
                f.gender.value = btn.dataset.gender || '';
                f.country.value = btn.dataset.country || '';
                f.type.value = btn.dataset.type || 'adult';
            }

            /* ---------------- TAB ACTIVE ---------------- */
            function setActiveTab(slotIndex) {
                document.querySelectorAll('.trav-btn').forEach(b => {
                    b.classList.toggle('active', b.dataset.slot === slotIndex);
                });
            }

            /* ---------------- OPEN MODAL ---------------- */
            document.addEventListener('click', e => {
                const btn = e.target.closest('.openTravellerModal');
                if (!btn) return;

                const mode = btn.dataset.mode;
                const slot = btn.dataset.slot;

                setActiveTab(slot);

                if (mode === 'add') {
                    resetForm(btn.dataset.type);
                } else {
                    fillForm(btn);
                }
            });

            /* ---------------- TAB CLICK ---------------- */
            document.querySelectorAll('.trav-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    setActiveTab(btn.dataset.slot);
                    if (btn.dataset.id) {
                        fillForm(btn);
                    } else {
                        resetForm(btn.dataset.type);
                    }
                });
            });

            /* ---------------- SUBMIT ---------------- */
            form.addEventListener('submit', async e => {
                e.preventDefault();

                const isUpdate = f.id.value !== '';
                const url = isUpdate ?
                    `/account/travellers/${f.id.value}` :
                    `/account/travellers`;

                try {
                    const res = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: new FormData(form)
                    });

                    if (!res.ok) throw new Error();
                    location.reload();

                } catch {
                    alert('Something went wrong');
                }
            });

            /* ---------------- DELETE ---------------- */
            document.addEventListener('click', async e => {
                const btn = e.target.closest('.delete-traveller-btn');
                if (!btn) return;

                if (!confirm('Delete this traveller?')) return;

                await fetch(`/account/travellers/${btn.dataset.id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                });

                location.reload();
            });

        });
    </script>

    <script>
        window.TRAVELLER_STATUS = {
            total: {{ $totalTravellers }},
            filled: {{ $travellerSlots->whereNotNull('data')->count() }}
        };

        document.getElementById('checkoutContinueBtn')
            .addEventListener('click', function(e) {

                if (window.TRAVELLER_STATUS.filled < window.TRAVELLER_STATUS.total) {
                    e.preventDefault();
                    alert('Please add details for all travellers');
                    return false;
                }
            });
    </script>

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
                        errorBox.classList.remove('d-none');
                        return;
                    }

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
@endsection
