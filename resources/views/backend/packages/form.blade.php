@extends('backend.layout')

@section('content')
    <style>
        .tab-btn {
            padding: .6rem 1rem;
            border-bottom: 2px solid transparent;
            cursor: pointer;
            font-size: 14px
        }

        .tab-btn.active {
            border-color: #1e293b;
            font-weight: 600;
            color: #1e293b
        }

        .tab-pane {
            display: none
        }

        .tab-pane.active {
            display: block
        }

        .lang-btn {
            padding: .4rem .9rem;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer
        }

        .lang-btn.active {
            background: #1e293b;
            color: #fff
        }

        .lang-section,
        .info-lang-section {
            display: none
        }

        .lang-section.active,
        .info-lang-section.active {
            display: block
        }

        .form-label {
            font-size: 13px;
            font-weight: 500;
            color: #334155;
            margin-bottom: 4px;
            display: block
        }

        .section-title {
            font-size: 15px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 12px
        }

        .help-text {
            font-size: 12px;
            color: #64748b
        }
    </style>

    <div class="content-wrapper ltr:ml-[248px] rtl:mr-[248px]">
        <div class="page-content container-fluid">

            <form method="POST"
                action="{{ $package->exists ? route('admin.packages.update', $package) : route('admin.packages.store') }}">
                @csrf
                @if ($package->exists)
                    @method('PUT')
                @endif

                @php
                    $tabs = ['basic', 'availability', 'cities', 'itinerary', 'pricing', 'info'];
                @endphp

                <div class="bg-white rounded-xl shadow">

                    {{-- ================= TAB HEADERS ================= --}}
                    <ul class="flex border-b p-2">
                        @foreach ($tabs as $i => $tab)
                            <li>
                                <button type="button" class="tab-btn {{ $i === 0 ? 'active' : '' }}"
                                    data-index="{{ $i }}">
                                    {{ ucfirst($tab) }}
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <div class="p-6">

                        {{-- ================================================= --}}
                        {{-- ================= BASIC INFO ==================== --}}
                        {{-- ================================================= --}}
                        <div class="tab-pane active" id="basic">

                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div>
                                    <label class="form-label">Category *</label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ old('category_id', $package->category_id) == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->translation->name ?? '-' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="form-label">Package Type *</label>
                                    <select name="package_type" class="form-control" required>
                                        <option value="fixed"
                                            {{ old('package_type', $package->package_type) == 'fixed' ? 'selected' : '' }}>
                                            Fixed
                                        </option>
                                        <option value="customized"
                                            {{ old('package_type', $package->package_type) == 'customized' ? 'selected' : '' }}>
                                            Customized</option>
                                    </select>
                                </div>

                                <input name="duration_days" class="form-control"
                                    value="{{ old('duration_days', $package->duration_days) }}" placeholder="Duration Days">

                                <input id="duration_nights" name="duration_nights" class="form-control"
                                    value="{{ old('duration_nights', $package->duration_nights) }}"
                                    placeholder="Duration Nights">

                                <input name="base_persons" class="form-control"
                                    value="{{ old('base_persons', $package->base_persons) }}" placeholder="Base Persons">

                                <input name="max_persons" class="form-control"
                                    value="{{ old('max_persons', $package->max_persons) }}" placeholder="Max Persons">
                            </div>

                            {{-- Language Tabs --}}
                            <div class="flex gap-2 border-b mb-4 pb-2">
                                @foreach ($languages as $lang)
                                    <button type="button" class="lang-btn {{ $loop->first ? 'active' : '' }}"
                                        data-lang="{{ strtolower($lang->code) }}">
                                        {{ strtoupper($lang->code) }}
                                    </button>
                                @endforeach
                            </div>

                            @foreach ($languages as $lang)
                                @php
                                    $code = strtolower($lang->code);
                                    $trans = $package->exists
                                        ? $package->translations->where('language_code', $code)->first()
                                        : null;
                                @endphp

                                <div class="lang-section {{ $loop->first ? 'active' : '' }}"
                                    id="lang-{{ $code }}">
                                    <label class="form-label">Title ({{ strtoupper($code) }})
                                        {{ $code == 'en' ? '*' : '' }}</label>
                                    <input name="translations[{{ $code }}][title]"
                                        value="{{ old("translations.$code.title", $trans->title ?? '') }}"
                                        class="form-control mb-3" {{ $code == 'en' ? 'required' : '' }}>

                                    <label class="form-label">Sub Title</label>
                                    <input name="translations[{{ $code }}][sub_title]"
                                        value="{{ old("translations.$code.sub_title", $trans->sub_title ?? '') }}"
                                        class="form-control mb-3">

                                    <label class="form-label">Description</label>
                                    <textarea name="translations[{{ $code }}][description]" class="form-control h-28">{{ old("translations.$code.description", $trans->description ?? '') }}</textarea>
                                </div>
                            @endforeach
                        </div>

                        {{-- ================================================= --}}
                        {{-- ================= AVAILABILITY ================== --}}
                        {{-- ================================================= --}}
                        @php
                            use Illuminate\Support\Carbon;

                            /**
                             * Normalize availability data
                             * Always return ARRAY
                             * Always return Y-m-d dates
                             */

                            $availability = [
                                'available_from' => '',
                                'available_to' => '',
                                'booking_start_date' => '',
                                'booking_end_date' => '',
                            ];

                            if (old('availability')) {
                                $availability = array_merge($availability, old('availability'));
                            } elseif ($package->exists && $package->availabilities->count()) {
                                $a = $package->availabilities->first();

                                $availability = [
                                    'available_from' => optional($a->available_from)->format('Y-m-d'),
                                    'available_to' => optional($a->available_to)->format('Y-m-d'),
                                    'booking_start_date' => optional($a->booking_start_date)->format('Y-m-d'),
                                    'booking_end_date' => optional($a->booking_end_date)->format('Y-m-d'),
                                ];
                            }
                        @endphp


                        <div class="tab-pane" id="availability">

                            <h6 class="section-title">Package Availability</h6>
                            <p class="help-text mb-4">
                                Define travel date range and optional booking window.
                            </p>

                            {{-- ================= TRAVEL DATES ================= --}}
                            <div class="grid grid-cols-2 gap-4 mb-6">

                                <div>
                                    <label class="form-label">Available From *</label>
                                    <input type="date" name="availability[available_from]"
                                        value="{{ $availability['available_from'] }}" class="form-control" required>
                                </div>

                                <div>
                                    <label class="form-label">Available To *</label>
                                    <input type="date" name="availability[available_to]"
                                        value="{{ $availability['available_to'] }}" class="form-control" required>
                                </div>

                            </div>

                            {{-- ================= BOOKING WINDOW ================= --}}
                            <div class="grid grid-cols-2 gap-4">

                                <div>
                                    <label class="form-label">Booking Start Date</label>
                                    <input type="date" name="availability[booking_start_date]"
                                        value="{{ $availability['booking_start_date'] }}" class="form-control">
                                </div>

                                <div>
                                    <label class="form-label">Booking End Date</label>
                                    <input type="date" name="availability[booking_end_date]"
                                        value="{{ $availability['booking_end_date'] }}" class="form-control">
                                </div>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- ================= CITIES ======================== --}}
                        {{-- ================================================= --}}
                        @php
                            $citiesData = old('cities');

                            if (!$citiesData) {
                                if ($package->exists && $package->cities->count()) {
                                    // convert collection to PURE ARRAY
                                    $citiesData = $package->cities
                                        ->map(function ($c) {
                                            return [
                                                'city_id' => $c->city_id,
                                                'nights' => $c->nights,
                                                'sort_order' => $c->sort_order,
                                            ];
                                        })
                                        ->toArray();
                                } else {
                                    $citiesData = [['city_id' => '', 'nights' => '', 'sort_order' => 1]];
                                }
                            }
                        @endphp


                        <div class="tab-pane" id="cities">

                            <h6 class="section-title">Cities Covered</h6>
                            <p class="help-text mb-4">
                                Select cities included in this package and specify number of nights in each city.
                            </p>
                            @foreach ($citiesData as $i => $row)
                                <div class="grid grid-cols-3 gap-4 mb-6">
                                    <div>
                                        <label class="form-label">City</label>
                                        <select name="cities[{{ $i }}][city_id]" class="form-control">
                                            <option value="">Select City</option>

                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"
                                                    {{ $row['city_id'] == $city->id ? 'selected' : '' }}>
                                                    {{ $city->slug }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    {{-- NIGHTS --}}
                                    <div>
                                        <label class="form-label">Nights</label>
                                        <input type="number" name="cities[{{ $i }}][nights]"
                                            value="{{ $row['nights'] }}" class="form-control">
                                    </div>

                                    {{-- ORDER --}}
                                    <div>
                                        <label class="form-label">Order</label>
                                        <input type="number" name="cities[{{ $i }}][sort_order]"
                                            value="{{ $row['sort_order'] }}" class="form-control">
                                    </div>

                                </div>
                            @endforeach


                        </div>



                        {{-- ================================================= --}}
                        {{-- ================= ITINERARY ===================== --}}
                        {{-- ================================================= --}}
                        @php
                            $itineraryData = old('itinerary');

                            if (!$itineraryData) {
                                if ($package->exists && $package->days->count()) {
                                    $itineraryData = [];

                                    foreach ($package->days as $day) {
                                        $itineraryData[$day->day_number] = [
                                            'city_id' => $day->city_id,
                                            'items' => [
                                                [
                                                    'item_type' => 'hotel',
                                                    'item_id' => 1,
                                                    'start_time' => '',
                                                    'end_time' => '',
                                                    'sort_order' => 0,
                                                ],
                                            ],
                                        ];
                                    }
                                } else {
                                    $itineraryData = [
                                        1 => [
                                            'city_id' => '',
                                            'items' => [
                                                [
                                                    'item_type' => 'hotel',
                                                    'item_id' => 1,
                                                    'start_time' => '',
                                                    'end_time' => '',
                                                    'sort_order' => 0,
                                                ],
                                            ],
                                        ],
                                    ];
                                }
                            }
                        @endphp

                        <div class="tab-pane" id="itinerary">

                            <h6 class="section-title">Day-wise Itinerary</h6>
                            <p class="help-text mb-4">
                                Assign city and schedule for each day of the package.
                            </p>

                            @foreach ($itineraryData as $dayNumber => $day)
                                <div class="border rounded-lg p-4 mb-6 bg-slate-50">

                                    <h6 class="font-semibold text-slate-700 mb-3">
                                        Day {{ $dayNumber }}
                                    </h6>

                                    {{-- CITY --}}
                                    <div class="mb-4">
                                        <label class="form-label">City</label>
                                        <select name="itinerary[{{ $dayNumber }}][city_id]" class="form-control">
                                            <option value="">Select City</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"
                                                    {{ ($day['city_id'] ?? '') == $city->id ? 'selected' : '' }}>
                                                    {{ $city->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- ITEM DETAILS --}}
                                    <h6 class="font-medium text-slate-600 mb-2">
                                        Scheduled Activity
                                    </h6>

                                    <div class="grid grid-cols-2 gap-4 mb-4">

                                        <div>
                                            <label class="form-label">Start Time</label>
                                            <input type="time"
                                                name="itinerary[{{ $dayNumber }}][items][0][start_time]"
                                                value="{{ $day['items'][0]['start_time'] ?? '' }}" class="form-control">
                                        </div>

                                        <div>
                                            <label class="form-label">End Time</label>
                                            <input type="time"
                                                name="itinerary[{{ $dayNumber }}][items][0][end_time]"
                                                value="{{ $day['items'][0]['end_time'] ?? '' }}" class="form-control">
                                        </div>

                                    </div>

                                    {{-- REQUIRED HIDDEN FIELDS (CONTROLLER DEPENDENCY) --}}
                                    <input type="hidden" name="itinerary[{{ $dayNumber }}][items][0][item_type]"
                                        value="{{ $day['items'][0]['item_type'] }}">

                                    <input type="hidden" name="itinerary[{{ $dayNumber }}][items][0][item_id]"
                                        value="{{ $day['items'][0]['item_id'] }}">

                                    <input type="hidden" name="itinerary[{{ $dayNumber }}][items][0][sort_order]"
                                        value="0">

                                </div>
                            @endforeach

                        </div>


                        {{-- ================================================= --}}
                        {{-- ================= PRICING ======================= --}}
                        {{-- ================================================= --}}
                        @php
                            $price = $package->price;

                            /* ---------- Extra Persons ---------- */
                            $extraPersons = old('pricing.extra_persons');

                            if (!$extraPersons) {
                                if ($package->exists && $package->priceIncreasePersons->count()) {
                                    $extraPersons = $package->priceIncreasePersons->toArray();
                                } else {
                                    $extraPersons = [['person_number' => '', 'additional_price' => '']];
                                }
                            }

                            /* ---------- Child Prices ---------- */
                            $childPrices = old('pricing.child_prices');

                            if (!$childPrices) {
                                if ($package->exists && $package->childPrices->count()) {
                                    $childPrices = $package->childPrices->toArray();
                                } else {
                                    $childPrices = [
                                        [
                                            'min_age' => '',
                                            'max_age' => '',
                                            'price_type' => 'fixed',
                                            'price_value' => '',
                                        ],
                                    ];
                                }
                            }
                        @endphp

                        <div class="tab-pane" id="pricing">

                            <h6 class="section-title">Base Pricing</h6>

                            <div class="grid grid-cols-2 gap-4 mb-6">

                                <div>
                                    <label class="form-label">Currency</label>
                                    <input name="pricing[currency]"
                                        value="{{ old('pricing.currency', $price->currency ?? 'INR') }}"
                                        class="form-control">
                                </div>

                                <div>
                                    <label class="form-label">Original Price</label>
                                    <input type="number" name="pricing[original_price]"
                                        value="{{ old('pricing.original_price', $price->original_price ?? '') }}"
                                        class="form-control">
                                </div>

                                <div>
                                    <label class="form-label">Discount Price</label>
                                    <input type="number" name="pricing[discount_price]"
                                        value="{{ old('pricing.discount_price', $price->discount_price ?? '') }}"
                                        class="form-control">
                                </div>

                                <div>
                                    <label class="form-label">Per Person Price</label>
                                    <input type="number" name="pricing[per_person_price]"
                                        value="{{ old('pricing.per_person_price', $price->per_person_price ?? '') }}"
                                        class="form-control">
                                </div>

                            </div>

                            {{-- ================= EXTRA PERSON ================= --}}
                            <h6 class="section-title">Extra Person Charges</h6>

                            @foreach ($extraPersons as $i => $row)
                                <div class="grid grid-cols-2 gap-4 mb-4">

                                    <input type="number"
                                        name="pricing[extra_persons][{{ $i }}][person_number]"
                                        value="{{ $row['person_number'] ?? '' }}" class="form-control"
                                        placeholder="Person count (e.g. 3)">

                                    <input type="number"
                                        name="pricing[extra_persons][{{ $i }}][additional_price]"
                                        value="{{ $row['additional_price'] ?? '' }}" class="form-control"
                                        placeholder="Additional price">

                                </div>
                            @endforeach

                            {{-- ================= CHILD PRICING ================= --}}
                            <h6 class="section-title mt-6">Child Pricing</h6>

                            @foreach ($childPrices as $i => $row)
                                <div class="grid grid-cols-4 gap-4 mb-4">

                                    <input type="number" name="pricing[child_prices][{{ $i }}][min_age]"
                                        value="{{ $row['min_age'] ?? '' }}" class="form-control" placeholder="Min Age">

                                    <input type="number" name="pricing[child_prices][{{ $i }}][max_age]"
                                        value="{{ $row['max_age'] ?? '' }}" class="form-control" placeholder="Max Age">

                                    <select name="pricing[child_prices][{{ $i }}][price_type]"
                                        class="form-control">
                                        <option value="fixed"
                                            {{ ($row['price_type'] ?? '') == 'fixed' ? 'selected' : '' }}>
                                            Fixed
                                        </option>
                                        <option value="percentage"
                                            {{ ($row['price_type'] ?? '') == 'percentage' ? 'selected' : '' }}>
                                            Percentage
                                        </option>
                                    </select>

                                    <input type="number" name="pricing[child_prices][{{ $i }}][price_value]"
                                        value="{{ $row['price_value'] ?? '' }}" class="form-control"
                                        placeholder="Value">

                                </div>
                            @endforeach

                        </div>


                        {{-- ================================================= --}}
                        {{-- ================= INFO ========================== --}}
                        {{-- ================================================= --}}
                        <div class="tab-pane" id="info">

                            <div class="flex gap-2 border-b mb-4 pb-2">
                                @foreach ($languages as $lang)
                                    <button type="button" class="lang-btn {{ $loop->first ? 'active' : '' }}"
                                        data-info-lang="{{ strtolower($lang->code) }}">
                                        {{ strtoupper($lang->code) }}
                                    </button>
                                @endforeach
                            </div>

                            @foreach ($languages as $lang)
                                @php $code=strtolower($lang->code); @endphp
                                <div class="info-lang-section {{ $loop->first ? 'active' : '' }}"
                                    id="info-lang-{{ $code }}">

                                    @foreach (['cancellation', 'visa', 'season'] as $type)
                                        @php
                                            $info = $package->exists
                                                ? $package->infos->where('type', $type)->first()
                                                : null;
                                            $infoT = $info
                                                ? $info->translations->where('language_code', $code)->first()
                                                : null;
                                        @endphp

                                        <textarea name="infos[{{ $type }}][translations][{{ $code }}][content]"
                                            class="form-control h-24 mb-3">{{ old("infos.$type.translations.$code.content", $infoT->content ?? '') }}</textarea>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                        {{-- ================= WIZARD BUTTONS ================= --}}
                        <div class="flex justify-between mt-6">
                            <button type="button" class="btn btn-outline-dark" id="prevBtn">← Previous</button>
                            <button type="button" class="btn btn-dark" id="nextBtn">Next →</button>
                            <button type="submit" class="btn btn-success" id="submitBtn">
                                {{ $package->exists ? 'Update Package' : 'Create Package' }}
                            </button>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>

    <script>
        const tabs = @json($tabs);
        let i = 0;
        const panes = document.querySelectorAll('.tab-pane');
        const btns = document.querySelectorAll('.tab-btn');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const submitBtn = document.getElementById('submitBtn');

        function showTab(n) {
            i = n;
            panes.forEach(p => p.classList.remove('active'));
            btns.forEach(b => b.classList.remove('active'));
            panes[i].classList.add('active');
            btns[i].classList.add('active');
            prevBtn.style.display = i === 0 ? 'none' : 'inline-flex';
            nextBtn.style.display = i === tabs.length - 1 ? 'none' : 'inline-flex';
            submitBtn.style.display = i === tabs.length - 1 ? 'inline-flex' : 'none';
        }

        btns.forEach((b, idx) => b.onclick = () => showTab(idx));
        prevBtn.onclick = () => showTab(i - 1);
        nextBtn.onclick = () => showTab(i + 1);
        showTab(0);

        document.querySelectorAll('.lang-btn').forEach(btn => {
            btn.onclick = () => {
                document.querySelectorAll('.lang-btn').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.lang-section,.info-lang-section').forEach(s => s.classList.remove(
                    'active'));
                btn.classList.add('active');
                const id = btn.dataset.lang ? 'lang-' + btn.dataset.lang : 'info-lang-' + btn.dataset.infoLang;
                document.getElementById(id).classList.add('active');
            };
        });
    </script>
@endsection
