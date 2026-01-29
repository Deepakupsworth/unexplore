@php
    $availability = $package->availabilities->first();
    $minDate = $availability
        ? \Carbon\Carbon::parse($availability->available_from)->format('Y-m-d')
        : null;
@endphp

<section class="mb-2 mt-4 package-filter-bar-section" id="packageFilterBar">

    {{-- PASS DATA FROM PHP TO JS --}}
    <script>
        window.PACKAGE = {
            basePersons: "{{ $package->base_persons }}",
            maxPersons: "{{ $package->max_persons }}",
            pricePerPerson: "{{ $package->price->per_person_price }}"
        };
    </script>

    <div class="container">
        <div class="package-filter-bar package-filter-bar__desktop d-flex flex-wrap align-items-center gap-2 justify-content-between">
            <div class="d-flex gap-2">

                {{-- DATE --}}
                <div class="pkg-fil-bar__input-wrapper flex-center">
                    <label>Starting From</label>
                    <input
                        type="date"
                        id="packageDate"
                        value="{{ $minDate }}"
                        min="{{ $minDate }}"
                    >
                </div>

                {{-- PERSONS --}}
                <div class="pkg-fil-bar__input-wrapper flex-center dropdown">
                    <label>Persons</label>

                    <div class="w-100 d-flex justify-content-between align-items-center text-white gap-1"
                        data-bs-toggle="dropdown">
                        <p class="text-truncate" id="personSummary">
                            {{ $package->base_persons }} Adults
                        </p>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>

                    <div class="dropdown-menu travellers-dropdown p-3 shadow-lg">

                        {{-- ADULTS --}}
                        <div class="traveller-row d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <strong>Adults</strong>
                                <p class="text-muted small m-0">12+ Years</p>
                            </div>

                            <div class="traveller-counter d-flex align-items-center gap-2">
                                <button type="button" class="traveller-counter-btn minus" data-type="adult">
                                    <i class="fa-solid fa-minus"></i>
                                </button>

                                <span class="count" id="adultCount">
                                    {{ $package->base_persons }}
                                </span>

                                <button type="button" class="traveller-counter-btn plus" data-type="adult">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        {{-- CHILDREN --}}
                        <div class="traveller-row d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <strong>Children</strong>
                                <p class="text-muted small m-0">2–12 Years</p>
                            </div>

                            <div class="traveller-counter d-flex align-items-center gap-2">
                                <button type="button" class="traveller-counter-btn minus" data-type="child">
                                    <i class="fa-solid fa-minus"></i>
                                </button>

                                <span class="count" id="childCount">0</span>

                                <button type="button" class="traveller-counter-btn plus" data-type="child">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

                <button class="btn btn-dark pkg-fil-bar__search-btn px-4 rounded-pill">
                    Search
                </button>
            </div>
        </div>

        {{-- 🔒 HIDDEN FIELDS (FOR BACKEND SUBMIT) --}}
        <input type="hidden" name="start_date" id="startDateInput">

        <input type="hidden" name="adults" id="adultsInput">
        <input type="hidden" name="children" id="childrenInput">
        <input type="hidden" name="total_persons" id="totalPersonsInput">

        <input type="hidden" name="base_price" id="basePriceInput">
        <input type="hidden" name="extra_persons" id="extraPersonsInput">
        <input type="hidden" name="extra_price" id="extraPriceInput">
        <input type="hidden" name="final_total" id="finalTotalInput">
    </div>

    {{-- ✅ FINAL JS --}}
    <script>
    (function () {

        if (!window.PACKAGE) return;

        const config = {
            basePersons: parseInt(window.PACKAGE.basePersons, 10),
            maxPersons: parseInt(window.PACKAGE.maxPersons, 10),
            pricePerPerson: parseFloat(window.PACKAGE.pricePerPerson),
        };

        console.log('Package Filter Bar Config:', config);

        let adults   = config.basePersons;
        let children = 0;

        const adultEl   = document.getElementById('adultCount');
        const childEl   = document.getElementById('childCount');
        const summaryEl = document.getElementById('personSummary');
        const buttons   = document.querySelectorAll('#packageFilterBar .traveller-counter-btn');

        function totalPersons() {
            return adults + children;
        }

        function clampValues() {
            if (totalPersons() > config.maxPersons) {
                const extra = totalPersons() - config.maxPersons;
                children = Math.max(0, children - extra);
            }
            if (adults < config.basePersons) {
                adults = config.basePersons;
            }
        }

        function updateButtons() {
            buttons.forEach(btn => {
                if (btn.classList.contains('plus')) {
                    btn.disabled = totalPersons() >= config.maxPersons;
                }
            });
        }

        function updateHiddenFields() {
            const totalP = totalPersons();
            const extraP = Math.max(0, totalP - config.basePersons);

            const basePrice  = config.basePersons * config.pricePerPerson;
            const extraPrice = extraP * config.pricePerPerson;
            const finalTotal = basePrice + extraPrice;

            document.getElementById('startDateInput').value =
                document.getElementById('packageDate').value;

            document.getElementById('adultsInput').value       = adults;
            document.getElementById('childrenInput').value     = children;
            document.getElementById('totalPersonsInput').value = totalP;

            document.getElementById('basePriceInput').value    = basePrice;
            document.getElementById('extraPersonsInput').value = extraP;
            document.getElementById('extraPriceInput').value   = extraPrice;
            document.getElementById('finalTotalInput').value   = finalTotal;
        }

        function updateUI() {
            clampValues();

            adultEl.textContent = adults;
            childEl.textContent = children;

            summaryEl.textContent =
                `${adults} Adult${adults > 1 ? 's' : ''}` +
                (children ? `, ${children} Child${children > 1 ? 'ren' : ''}` : '');

            updateButtons();
            updateHiddenFields();
        }

        buttons.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                const type   = btn.dataset.type;
                const isPlus = btn.classList.contains('plus');

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
