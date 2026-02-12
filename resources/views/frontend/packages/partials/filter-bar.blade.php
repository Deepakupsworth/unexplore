@php
    $availability = $package->availabilities->first();
    $minDate = $availability ? \Carbon\Carbon::parse($availability->available_from)->format('Y-m-d') : null;
@endphp

<section class="mb-2 mt-4 package-filter-bar-section" id="packageFilterBar">



    {{-- ================= PHP → JS DATA ================= --}}
    <script>
        window.PACKAGE = {
            basePersons: {{ (int) $package->base_persons }},
            originalPrice: {{ (float) optional($package->price)->original_price }},
            maxPersons: {{ (int) $package->max_persons }},
            pricePerPerson: {{ (float) optional($package->price)->per_person_price }},

            /* ================= EXTRA ADULT RULES ================= */
            extraAdultRules: {!! json_encode(
                optional($package->price?->increasePersons)->count() > 0
                    ? $package->price->increasePersons->map(function ($r) {
                        return [
                            'person_number' => (int) $r->person_number,
                            'price' => (float) $r->additional_price,
                        ];
                    })->values()->toArray()
                    : [
                        [
                            'person_number' => 1,
                            'price' => (float) optional($package->price)->per_person_price,
                        ]
                    ]
            ) !!},

            /* ================= CHILD RULES ================= */
            childRules: {!! json_encode(
                optional($package->price?->childPrices)->count() > 0
                    ? $package->price->childPrices->map(function ($c) {
                        return [
                            'min_age' => (int) $c->min_age,
                            'max_age' => (int) $c->max_age,
                            'type' => $c->price_type,
                            'value' => (float) $c->price_value,
                        ];
                    })->values()->toArray()
                    : [
                        [
                            'min_age' => 0,
                            'max_age' => 18,
                            'type' => 'fixed',
                            'value' => (float) optional($package->price)->per_person_price,
                        ]
                    ]
            ) !!}
        };
        </script>




    <div class="container">
 {{-- ================= UI (UNCHANGED) ================= --}}
        <div class="package-filter-bar package-filter-bar__desktop d-flex flex-wrap gap-2">

            {{-- DATE --}}
            <div class="pkg-fil-bar__input-wrapper flex-center">
                <label>{{ __('package.pricing.starting_from') }}</label>
                <input type="date" id="packageDate" value="{{ $filter_data['date'] ?? $minDate }}" min="{{ $minDate }}">
            </div>

            {{-- PERSONS --}}
            <div class="pkg-fil-bar__input-wrapper flex-center dropdown text-white">
                <label>Persons</label>

                <div class="w-100 d-flex justify-content-between align-items-center" data-bs-toggle="dropdown">
                    <p id="personSummary">{{ $package->base_persons }} {{ __('package.traveller.adults') }}</p>
                    <i class="fa-solid fa-angle-down"></i>
                </div>

                <div class="dropdown-menu travellers-dropdown p-3 shadow-lg">


                    {{-- ADULTS --}}
                    <div class="traveller-row d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <strong>{{ __('package.traveller.adults') }}</strong>
                            <p class="text-muted small m-0">{{ __('package.traveller.adults_age') }}</p>
                        </div>

                        <div class="traveller-counter d-flex gap-2">
                            <button type="button" class="traveller-counter-btn minus" data-type="adult">−</button>

                            <span id="adultCount">{{ $package->base_persons }}</span>

                            <button type="button" class="traveller-counter-btn plus" data-type="adult">+</button>
                        </div>
                    </div>

                    {{-- CHILDREN --}}
                    <div class="traveller-row d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ __('package.traveller.children') }}</strong>
                            <p class="text-muted small m-0">{{ __('package.traveller.children_age') }}</p>
                        </div>

                        <div class="traveller-counter d-flex gap-2">
                            <button type="button" class="traveller-counter-btn minus" data-type="child">−</button>

                            <span id="childCount">0</span>

                            <button type="button" class="traveller-counter-btn plus" data-type="child">+</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>


        <div class="w-100 text-start package-filter-bar__mobile mb-2">

                <div class="d-flex align-items-center gap-2">
                    <p class="f-14 summaryMob" >{{ $package->base_persons }} {{ __('package.traveller.adults') }}</p>
                    <div class="primary-text" id="package-filter-bar-edit-btn" data-bs-toggle="modal"
                        data-bs-target="#packageFilterModal">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= HIDDEN INPUTS (SERVER READY) ================= --}}
        <input type="hidden" name="start_date" id="startDateInput" form="packageCheckoutForm">

        <input type="hidden" name="adults" id="adultsInput" form="packageCheckoutForm">
        <input type="hidden" name="children" id="childrenInput">
        <input type="hidden" name="total_persons" id="totalPersonsInput" form="packageCheckoutForm">

        <input type="hidden" name="base_price" id="basePriceInput" form="packageCheckoutForm">

        <input type="hidden" name="extra_adults" id="extraAdultsInput" form="packageCheckoutForm">
        <input type="hidden" name="extra_adult_per_price" id="extraAdultPerPriceInput" form="packageCheckoutForm">
        <input type="hidden" name="extra_adult_total_price" id="extraAdultTotalPriceInput" form="packageCheckoutForm">

        <input type="hidden" name="child_per_price" id="childPerPriceInput" form="packageCheckoutForm">
        <input type="hidden" name="child_total_price" id="childTotalPriceInput" form="packageCheckoutForm">

        <input type="hidden" name="final_total" id="finalTotalInput" form="packageCheckoutForm">


    <!-- Modal -->
    <div class="modal fade" id="packageFilterModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex gap-2">
                        <button type="button" class="pkg-fil-modal__close-btn" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                        <h5 class="modal-title" id="exampleModalLabel">Edit Your Search</h5>
                    </div>
                </div>
                <div class="modal-body pkg-fil-modal-body">

                    <div class="pkg-fil-bar__input-wrapper flex-center mb-2">
                        <label>Starting Date</label>

                        <input type="date" id="packageDateNew" value="{{ $filter_data['date'] ?? $minDate }}" min="{{ $minDate }}">

                    </div>
                    <div class="pkg-fil-bar__input-wrapper flex-center">
                        <label>Starting From</label>
                        <div class="w-100 d-flex justify-content-between align-items-center gap-1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <p class="text-truncate summaryMob">{{ $package->base_persons }} {{ __('package.traveller.adults') }}</p>
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                        <div class="dropdown-menu travellers-dropdown p-3 shadow-lg">

                            <!-- Adults -->
                            <div class="traveller-row d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <strong>Adults</strong>
                                    <p class="text-muted small m-0">12+ Years</p>
                                </div>

                                <div class="traveller-counter d-flex align-items-center gap-2">
                                    <button class="traveller-counter-btn minus" data-type="adult">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                    <span  id="adultCountMob">{{ $package->base_persons }}</span>
                                    <button class="traveller-counter-btn plus"  data-type="adult">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Children -->
                            <div class="traveller-row d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <strong>Children</strong>
                                    <p class="text-muted small m-0">2–12 Years</p>
                                </div>

                                <div class="traveller-counter d-flex align-items-center gap-2">
                                    <button class="traveller-counter-btn minus" data-type="child">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                    <span  id="childCountMob">0</span>
                                    <button class="traveller-counter-btn plus" data-type="child">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div>



                        </div>
                    </div>
                    <?php /***
                    <button
                        class="btn btn-primary mt-3 w-100 btn-lg justify-content-center rounded-pill">Search</button> ***/ ?>
                </div>
            </div>
        </div>
    </div>


    {{-- ================= FINAL JS ================= --}}
    <script>
document.addEventListener('DOMContentLoaded', function() {

    const dateNew  = document.getElementById('packageDateNew');
    const dateMain = document.getElementById('packageDate');

    if (!dateNew || !dateMain) return;

    // When New Date Changes → Update Main
    dateNew.addEventListener('change', function() {
        dateMain.value = this.value;
    });

    // When Main Date Changes → Update New
    dateMain.addEventListener('change', function() {
        dateNew.value = this.value;
    });

});
</script>

 <script>
        (function() {

            const config = window.PACKAGE;

            // let adults = 5
            // let children = 2;
            let adults = Number('{{ $filter_data['adults'] ?? $package->base_persons }}');
            let children = Number('{{ $filter_data['children'] ?? 0 }}');


            let adultEl = document.getElementById('adultCount');
            let childEl = document.getElementById('childCount');

            const adultElMob = document.getElementById('adultCountMob');
            const childElMob = document.getElementById('childCountMob');

            const summaryEl = document.getElementById('personSummary');
            const summaryElMob = document.getElementsByClassName('summaryMob');

            function totalPersons() {
                return adults + children;
            }

            function calculateExtraAdult(extraAdults) {
                let perPrice = 0;

                // config.extraAdultRules.forEach(rule => {
                //     if (extraAdults >= rule.person_number) {
                //         perPrice = rule.price;
                //     }
                // });


                perPrice =
                    Array.isArray(config.extraAdultRules)
                        ? (config.extraAdultRules.find(
                            r => r.person_number === Number(extraAdults)
                        )?.price ?? config.pricePerPerson)
                        : config.pricePerPerson;



                return {
                    perPrice,
                    total: perPrice * extraAdults
                };
            }

            function calculateChild() {


                if (!children || !config.childRules.length) {
                    return {
                        perPrice: 0,
                        total: 0
                    };
                }

                // const rule = config.childRules[0];
                // let perPrice = 0;

                // if (rule.type === 'fixed') {
                //     perPrice = rule.value;
                // } else {
                //     perPrice = (config.pricePerPerson * rule.value) / 100;
                // }

                // new  code
                let childPerPrice = config.pricePerPerson; // default fallback
                let childTotal = 0;

                if (children > 0) {

                    const rules = Array.isArray(config.childRules) ? config.childRules : [];

                    if (rules.length > 0) {

                        const rule = rules[0]; // or find specific rule if needed

                        if (rule.type === 'fixed') {
                            childPerPrice = rule.value;
                        } else if (rule.type === 'percentage') {
                            childPerPrice = (config.pricePerPerson * rule.value) / 100;
                        }
                    }

                    childTotal = childPerPrice * children;
                }

                return {
                    childPerPrice,
                    total: childTotal
                };

                // return {
                //     perPrice,
                //     total: perPrice * children
                // };
            }

            function updateHiddenFields() {

                const extraAdults = Math.max(0, adults - config.basePersons);

                const basePrice = config.basePersons * config.pricePerPerson;
                const extraAdult = calculateExtraAdult(extraAdults);
                const child = calculateChild();

                document.getElementById('startDateInput').value =
                    document.getElementById('packageDate').value;

                document.getElementById('adultsInput').value = adults;
                document.getElementById('childrenInput').value = children;
                document.getElementById('totalPersonsInput').value = totalPersons();

                document.getElementById('basePriceInput').value = basePrice;

                document.getElementById('extraAdultsInput').value = extraAdults;
                document.getElementById('extraAdultPerPriceInput').value = extraAdult.perPrice;
                document.getElementById('extraAdultTotalPriceInput').value = extraAdult.total;

                document.getElementById('childPerPriceInput').value = child.perPrice;
                document.getElementById('childTotalPriceInput').value = child.total;

                document.getElementById('finalTotalInput').value =
                    basePrice + extraAdult.total + child.total;
            }

            function updateUI() {

                adultEl.textContent = adults;
                childEl.textContent = children;



                adultElMob.textContent = adults;
                childElMob.textContent = children;


                summaryEl.textContent =
                    `${adults} Adult${adults > 1 ? 's' : ''}` +
                    (children ? `, ${children} Child${children > 1 ? 'ren' : ''}` : '');

                for (let i = 0; i < summaryElMob.length; i++) {
                    summaryElMob[i].textContent = `${adults} Adult${adults > 1 ? 's' : ''}` +
                    (children ? `, ${children} Child${children > 1 ? 'ren' : ''}` : '');

                }



                updateHiddenFields();
            }

            document.querySelectorAll('#packageFilterBar .traveller-counter-btn')
                .forEach(btn => {
                    btn.addEventListener('click', function(e) {

                        const type = btn.dataset.type;
                        const isPlus = btn.classList.contains('plus');



                       if (isPlus && totalPersons() >= config.maxPersons) {
                        e.preventDefault();
                            e.stopImmediatePropagation();
                            return false;

                       }

                        if (type === 'adult') {
                            if (isPlus) adults++;
                            else if (adults > config.basePersons) adults--;
                        }

                        if (type === 'child') {
                            if (isPlus) children++;
                            else if (children > 0) children--;
                        }

                        updateUI();

                        if (window.PRICE_STATE) {
                            window.PRICE_STATE.persons.adults = adults;
                            window.PRICE_STATE.persons.children = children;

                            if (typeof updatePricing === 'function') {
                                updatePricing();
                            }
                        }
                    });
                });

            updateUI();

        })();

    </script>

</section>
