@extends('backend.layout')

@section('content')
    {{-- ================= ERROR SHOW ================= --}}
    {{-- @if ($errors->any())
        <div class="alert alert-danger mb-6">
            <strong>Please fix the following errors:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <style>
        .form-label {
            font-size: 13px;
            font-weight: 500;
            color: #334155;
            margin-bottom: 4px
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
    </style>

    <div class="card">
        <div class="card-body p-6 space-y-10">
            <form method="POST" action="{{ route('admin.packages.store') }}" enctype="multipart/form-data">
                @csrf
                {{-- ================================================= --}}
                {{-- BASIC INFO --}}
                {{-- ================================================= --}}
                <h3 class="text-lg font-semibold">Basic Information</h3>

                <div class="grid grid-cols-2 gap-4 mb-4">

                    <x-admin.form.category-select label="Package Categories" :categories="$categories" name="category_ids" multiple
                        required />

                    <div class="fromGroup">
                        <label class="form-label">Package Type *</label>
                        <select name="package_type" class="form-control selectCountrySelect2">
                            <option value="fixed" {{ old('package_type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                            <option value="customized" {{ old('package_type') == 'customized' ? 'selected' : '' }}>
                                Customized</option>
                        </select>
                    </div>

                    <div class="fromGroup">
                        <label class="form-label">Duration Days *</label>
                        <input value="{{ old('duration_days') }}" id="duration_days" type="number" name="duration_days"
                            class="form-control" min="1" required>
                    </div>

                    <div class="fromGroup">
                        <label class="form-label">Duration Nights *</label>
                        <input value="{{ old('duration_nights') }}" id="duration_nights" type="number"
                            name="duration_nights" class="form-control" min="0" required>
                    </div>

                    <div class="fromGroup">
                        <label class="form-label">Base Persons</label>
                        <input value="{{ old('base_persons', 2) }}" type="number" name="base_persons" class="form-control"
                            value="2">
                    </div>

                    <div class="fromGroup">
                        <label class="form-label">Max Persons *</label>
                        <input value="{{ old('max_persons') }}" type="number" name="max_persons" class="form-control"
                            required>
                    </div>

                    <div class="fromGroup">
                        <label class="form-label">Package Status *</label>
                        <select name="status" class="form-control selectCountrySelect2" required>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>


                </div>

                {{-- ================================================= --}}
                {{-- TRANSLATIONS --}}
                {{-- ================================================= --}}
                <h3 class="text-lg font-semibold">Package Translations</h3>

                <div class="flex gap-2 border-b pb-2 mb-4 mt-4">
                    @foreach ($languages as $lang)
                        <button type="button" class="lang-btn {{ $loop->first ? 'active' : '' }}"
                            data-lang="{{ strtolower($lang->code) }}">
                            {{ strtoupper($lang->code) }}
                        </button>
                    @endforeach
                </div>

                @foreach ($languages as $lang)
                    @php $code = strtolower($lang->code); @endphp

                    <div class="lang-section {{ $loop->first ? 'active' : '' }}" id="lang-{{ $code }}">
                        <label class="form-label">
                            Title ({{ strtoupper($code) }}) *
                        </label>

                        <input class="form-control mb-3" name="translations[{{ $code }}][title]"
                            value="{{ old("translations.$code.title") }}">

                        <label class="form-label">Sub Title</label>
                        <input class="form-control mb-3" name="translations[{{ $code }}][sub_title]"
                            value="{{ old("translations.$code.sub_title") }}">

                        <label class="form-label">Description</label>
                        <textarea class="editor form-control h-28" name="translations[{{ $code }}][description]">{{ old("translations.$code.description") }}</textarea>
                    </div>
                @endforeach

                {{-- ================================================= --}}
                {{-- AVAILABILITY --}}
                {{-- ================================================= --}}
                <h3 class="text-lg font-semibold mt-4">Availability</h3>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="form-label">Available From *</label>
                        <input type="date" name="availability[available_from]"
                            value="{{ old('availability.available_from') }}" class="form-control" required>
                    </div>
                    <div>
                        <label class="form-label">Available To *</label>
                        <input type="date" name="availability[available_to]"
                            value="{{ old('availability.available_to') }}" class="form-control" required>
                    </div>

                    <div>
                        <label class="form-label">Booking Start Date</label>
                        <input type="date" name="availability[booking_start_date]"
                            value="{{ old('availability.booking_start_date') }}" class="form-control">
                    </div>

                    <div>
                        <label class="form-label">Booking End Date</label>
                        <input type="date" name="availability[booking_end_date]"
                            value="{{ old('availability.booking_end_date') }}" class="form-control">
                    </div>
                </div>


                {{-- ================================================= --}}
                {{-- CITIES --}}
                {{-- ================================================= --}}
                <h3 class="text-lg font-semibold">Cities & Nights</h3>
                <div id="citiesContainer" class="mb-2"></div>

                {{-- ================================================= --}}
                {{-- DAYS & ACTIVITIES --}}
                {{-- ================================================= --}}
                <h3 class="text-lg font-semibold">Day Wise Itinerary</h3>
                <div id="daysContainer" class="mb-2"></div>

                {{-- ================================================= --}}
                {{-- PRICING --}}
                {{-- ================================================= --}}
                <h3 class="text-lg font-semibold mb-2">Pricing</h3>
                <input type="hidden" name="pricing[currency]" value="{{ $baseCurrency }}">

                <div class="grid grid-cols-2 gap-4 mb-4">
                    {{-- <div>
                        <label class="form-label">Currency *</label>

                        <select class="form-control" name="pricing[currency]" required>
                            @foreach ($currencies as $currency)
                                <option value="{{ $currency->code ?? $currency['code'] }}"
                                    {{ old('pricing.currency', $package->price->currency ?? 'SAR') == ($currency->code ?? $currency['code'])
                                        ? 'selected'
                                        : '' }}>

                                    {{ $currency->code ?? $currency['code'] }}
                                    -
                                    {{ $currency->name ?? $currency['name'] }}

                                </option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="fromGroup">
                        <label class="form-label">Price (Per Person) *</label>
                        <input type="number" step="0.01" name="pricing[per_person_price]" class="form-control"
                            required>
                    </div>
                    <div class="fromGroup">
                        <label class="form-label">Discount Price(Per Person)</label>
                        <input type="number" step="0.01" name="pricing[discount_price]" class="form-control"
                            value="{{ old('pricing[discount_price]') }}">
                    </div>
                    <div class="fromGroup">
                        <label class="form-label">Total Price *</label>
                        <input type="number" step="0.01" name="pricing[original_price]" class="form-control"
                            value="{{ old('pricing[original_price]') }}" required>
                    </div>
                </div>



                {{-- ================================================= --}}
                {{-- ADDITIONAL INFO --}}
                <div class="fromGroup mb-4">
                    <label class="form-label">Thumbnail</label>
                    <input type="file" class="form-control @error('thumb') error-input @enderror" name="thumb"
                        required>
                    @error('thumb')
                        <p class="error-text">{{ $message }}</p>
                    @enderror

                </div>

                <div class="fromGroup mb-4">
                    <label class="form-label">Gallery</label>
                    <input type="file" class="form-control @error('gallery.*') error-input @enderror" name="gallery[]"
                        multiple>
                    @error('gallery.*')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button class="btn btn-success mt-6">Create Package</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        /* ================= DOM REFERENCES ================= */
        const duration_days = document.getElementById('duration_days');
        const duration_nights = document.getElementById('duration_nights');
        const citiesContainer = document.getElementById('citiesContainer');
        const daysContainer = document.getElementById('daysContainer');

        /* ================= DATA ================= */
        const cities = @json($cities);
        const hotels = @json($hotels);
        const events = @json($events);
        const todos = @json($todos);
        const transports = @json($transports);

        const itemsMap = {
            hotel: hotels,
            event: events,
            todo: todos,
            transport: transports
        };

        /* ================= RENDER CITIES (SAFE) ================= */
        function renderCities(n) {
            n = parseInt(n || 0);

            // preserve existing values
            const old = {};
            citiesContainer.querySelectorAll('[name^="cities"]').forEach(el => {
                old[el.name] = el.value;
            });

            citiesContainer.innerHTML = '';

            for (let i = 0; i < n; i++) {
                const row = document.createElement('div');
                row.className = 'grid grid-cols-3 gap-4 mb-3';

                // row.innerHTML = `
            //     <select class="form-control" name="cities[${i}][city_id]" required>
            //         <option value="">Select City</option>
            //         ${cities.map(c => `<option value="${c.id}">${c.slug}</option>`).join('')}
            //     </select>

            //     <input class="form-control"
            //            name="cities[${i}][nights]"
            //            value="${old[`cities[${i}][nights]`] ?? 1}">

            //     <input class="form-control"
            //            name="cities[${i}][sort_order]"
            //            value="${old[`cities[${i}][sort_order]`] ?? (i + 1)}">
            // `;

                row.innerHTML = `
                        <select class="form-control"
                                name="cities[${i}][city_id]"
                                required>
                            <option value="">Select City</option>
                            ${cities.map(c => `<option value="${c.id}">${c.slug}</option>`).join('')}
                        </select>

                        <input class="form-control"
                            name="cities[${i}][nights]"
                            value="${old[`cities[${i}][nights]`] ?? 1}"
                            required>

                        <input class="form-control"
                            name="cities[${i}][sort_order]"
                            value="${old[`cities[${i}][sort_order]`] ?? (i + 1)}">
                        `;

                citiesContainer.appendChild(row);

                // restore selected city
                if (old[`cities[${i}][city_id]`]) {
                    row.querySelector('select').value = old[`cities[${i}][city_id]`];
                }
            }
        }

        /* ================= RENDER DAYS (NO DATA LOSS) ================= */
        function renderDays(days) {
            days = parseInt(days || 0);

            for (let d = 1; d <= days; d++) {

                if (daysContainer.querySelector(`[data-day-wrapper="${d}"]`)) {
                    continue; // already exists → don't reset
                }

                const dayBox = document.createElement('div');
                dayBox.className = 'border rounded p-4 mb-6';
                dayBox.dataset.dayWrapper = d;

                dayBox.innerHTML = `
                    <h4 class="font-semibold mb-2">Day ${d}</h4>

                    <label class="form-label">City</label>
                    <select required class="form-control mb-3" name="days[${d}][city_id]">
                        <option value="">Select City</option>
                        ${cities.map(c => `<option value="${c.id}">${c.slug}</option>`).join('')}
                    </select>

                    <div class="activities" data-day="${d}"></div>

                    <button type="button"
                            class="btn btn-sm btn-outline-dark add-activity"
                            data-day="${d}">
                        + Add Activity
                    </button>
                `;

                daysContainer.appendChild(dayBox);
            }

            // remove extra days if reduced
            daysContainer.querySelectorAll('[data-day-wrapper]').forEach(box => {
                if (parseInt(box.dataset.dayWrapper) > days) {
                    box.remove();
                }
            });
        }

        /* ================= ACTIVITY TEMPLATE ================= */
        function activityTemplate(day, index) {
            return `
            <div class="border p-3 mb-3 activity-row">
                <label class="form-label">Activity Type</label>
                <select class="form-control mb-2 activity-type">
                    <option value="">Select Type</option>
                    <option value="hotel">Hotel</option>
                    <option value="event">Event</option>
                    <option value="todo">To Do</option>
                    <option value="transport">Transport</option>
                </select>

                <label class="form-label">Item</label>
                <select class="form-control mb-2 item-select"
                        name="days[${day}][items][${index}][item_id]">
                    <option value="">Select Item</option>
                </select>

                <input type="hidden"
                       name="days[${day}][items][${index}][item_type]">

                <label class="form-label">Start Time</label>
                <input type="time"
                       class="form-control mb-2"
                       name="days[${day}][items][${index}][start_time]">

                <label class="form-label">End Time</label>
                <input type="time"
                       class="form-control"
                       name="days[${day}][items][${index}][end_time]">
            </div>`;
        }

        /* ================= ADD ACTIVITY ================= */
        document.addEventListener('click', e => {
            if (!e.target.classList.contains('add-activity')) return;

            const day = e.target.dataset.day;
            const box = e.target.previousElementSibling;
            const index = box.children.length;

            box.insertAdjacentHTML('beforeend', activityTemplate(day, index));
        });

        /* ================= ACTIVITY TYPE CHANGE ================= */
        document.addEventListener('change', e => {
            if (!e.target.classList.contains('activity-type')) return;

            const wrapper = e.target.closest('.activity-row');
            const type = e.target.value;

            wrapper.querySelector('input[name*="[item_type]"]').value = type;

            const select = wrapper.querySelector('.item-select');
            select.innerHTML = '<option value="">Select Item</option>';

            (itemsMap[type] || []).forEach(item => {
                select.insertAdjacentHTML(
                    'beforeend',
                    `<option value="${item.id}">${item.name || item.title}</option>`
                );
            });
        });

        /* ================= INPUT EVENTS ================= */
        duration_days.addEventListener('change', () => {
            renderDays(duration_days.value);
        });

        duration_nights.addEventListener('change', () => {
            renderCities(duration_nights.value);
        });

        /* ================= LANGUAGE TABS ================= */
        document.querySelectorAll('[data-lang]').forEach(btn => {
            btn.onclick = () => {
                document.querySelectorAll('[data-lang]').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.lang-section').forEach(s => s.classList.remove('active'));
                btn.classList.add('active');
                document.getElementById('lang-' + btn.dataset.lang).classList.add('active');
            };
        });

        // document.querySelectorAll('[data-info]').forEach(btn => {
        //     btn.onclick = () => {
        //         document.querySelectorAll('[data-info]').forEach(b => b.classList.remove('active'));
        //         document.querySelectorAll('.info-lang-section').forEach(s => s.classList.remove('active'));
        //         btn.classList.add('active');
        //         document.getElementById('info-' + btn.dataset.info).classList.add('active');
        //     };
        // });

        /* ================= INITIAL LOAD ================= */
        document.addEventListener('DOMContentLoaded', () => {
            if (duration_nights.value) renderCities(duration_nights.value);
            if (duration_days.value) renderDays(duration_days.value);
        });
    </script>
@endsection
