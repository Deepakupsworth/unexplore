@php
    $availability = $package->availabilities->first();
    $minDate = $availability
        ? \Carbon\Carbon::parse($availability->available_from)->format('Y-m-d')
        : null;
@endphp

<section class="mb-2 mt-4 package-filter-bar-section" id="packageFilterBar">

    {{-- ================= PHP → JS DATA ================= --}}
    <script>
        window.PACKAGE = {
            basePersons: {{ (int) $package->base_persons }},
            maxPersons: {{ (int) $package->max_persons }},
            pricePerPerson: {{ (float) $package->price->per_person_price }},

            extraAdultRules: {!! json_encode(
                $package->price->increasePersons->map(function ($r) {
                    return [
                        'person_number' => (int) $r->person_number,
                        'price' => (float) $r->additional_price,
                    ];
                })->values()
            ) !!},

            childRules: {!! json_encode(
                $package->price->childPrices->map(function ($c) {
                    return [
                        'min_age' => (int) $c->min_age,
                        'max_age' => (int) $c->max_age,
                        'type' => $c->price_type, // fixed | percentage
                        'value' => (float) $c->price_value,
                    ];
                })->values()
            ) !!}
        };
    </script>

    <div class="container">

        {{-- ================= UI (UNCHANGED) ================= --}}
        <div class="package-filter-bar package-filter-bar__desktop d-flex flex-wrap gap-2">

            {{-- DATE --}}
            <div class="pkg-fil-bar__input-wrapper flex-center">
                <label>Starting From</label>
                <input type="date"
                       id="packageDate"
                       value="{{ $minDate }}"
                       min="{{ $minDate }}">
            </div>

            {{-- PERSONS --}}
            <div class="pkg-fil-bar__input-wrapper flex-center dropdown text-white">
                <label>Persons</label>

                <div class="w-100 d-flex justify-content-between align-items-center"
                     data-bs-toggle="dropdown">
                    <p id="personSummary">{{ $package->base_persons }} Adults</p>
                    <i class="fa-solid fa-angle-down"></i>
                </div>

                <div class="dropdown-menu travellers-dropdown p-3 shadow-lg">

                    {{-- ADULTS --}}
                    <div class="traveller-row d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <strong>Adults</strong>
                            <p class="text-muted small m-0">12+ Years</p>
                        </div>

                        <div class="traveller-counter d-flex gap-2">
                            <button type="button"
                                    class="traveller-counter-btn minus"
                                    data-type="adult">−</button>

                            <span id="adultCount">{{ $package->base_persons }}</span>

                            <button type="button"
                                    class="traveller-counter-btn plus"
                                    data-type="adult">+</button>
                        </div>
                    </div>

                    {{-- CHILDREN --}}
                    <div class="traveller-row d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Children</strong>
                            <p class="text-muted small m-0">2–12 Years</p>
                        </div>

                        <div class="traveller-counter d-flex gap-2">
                            <button type="button"
                                    class="traveller-counter-btn minus"
                                    data-type="child">−</button>

                            <span id="childCount">0</span>

                            <button type="button"
                                    class="traveller-counter-btn plus"
                                    data-type="child">+</button>
                        </div>
                    </div>

                </div>
            </div>

            <button class="btn btn-dark px-4 rounded-pill">Search</button>
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
    </div>

    {{-- ================= FINAL JS ================= --}}
    <script>
    (function () {

        const config = window.PACKAGE;

        let adults = config.basePersons;
        let children = 0;

        const adultEl = document.getElementById('adultCount');
        const childEl = document.getElementById('childCount');
        const summaryEl = document.getElementById('personSummary');

        function totalPersons() {
            return adults + children;
        }

        function calculateExtraAdult(extraAdults) {
            let perPrice = 0;

            config.extraAdultRules.forEach(rule => {
                if (extraAdults >= rule.person_number) {
                    perPrice = rule.price;
                }
            });

            return {
                perPrice,
                total: perPrice * extraAdults
            };
        }

        function calculateChild() {
            if (!children || !config.childRules.length) {
                return { perPrice: 0, total: 0 };
            }

            const rule = config.childRules[0];
            let perPrice = 0;

            if (rule.type === 'fixed') {
                perPrice = rule.value;
            } else {
                perPrice = (config.pricePerPerson * rule.value) / 100;
            }

            return {
                perPrice,
                total: perPrice * children
            };
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

            summaryEl.textContent =
                `${adults} Adult${adults > 1 ? 's' : ''}` +
                (children ? `, ${children} Child${children > 1 ? 'ren' : ''}` : '');

            updateHiddenFields();
        }

        document.querySelectorAll('#packageFilterBar .traveller-counter-btn')
            .forEach(btn => {
                btn.addEventListener('click', function () {

                    const type = btn.dataset.type;
                    const isPlus = btn.classList.contains('plus');

                    if (isPlus && totalPersons() >= config.maxPersons) return;

                    if (type === 'adult') {
                        if (isPlus) adults++;
                        else if (adults > config.basePersons) adults--;
                    }

                    if (type === 'child') {
                        if (isPlus) children++;
                        else if (children > 0) children--;
                    }

                    updateUI();
                });
            });

        updateUI();

    })();
    </script>

</section>
