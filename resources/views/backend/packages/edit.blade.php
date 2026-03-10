@extends('backend.layout')

@section('content')
    @php
        $selectedTags = $package?->tags->pluck('id')->toArray() ?? [];
    @endphp

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

        #daysContainer select.form-control.item-select {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .select2-container {
            margin-top: 15px !important;
            margin-bottom: 15px !important;

        }

        .select2-container--default {
            margin: 0px !important;
        }

        .select2-selection--single {
            margin-bottom: 15px !important;
        }
    </style>
    <div class="card">
        <div class="card-body flex flex-col p-6">

            <div class="card-text h-full ">
                <div>
                    <ul class="nav nav-tabs flex flex-col md:flex-row flex-wrap list-none border-b-0 pl-0 mb-4" id="tabs-tab"
                        role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="#tabs-home"
                                class="nav-link w-full block font-medium text-sm font-Inter leading-tight capitalize border-x-0 border-t-0 border-b border-transparent px-4 pb-2 my-2 hover:border-transparent focus:border-transparent active dark:text-slate-300"
                                id="tabs-home-tab" data-bs-toggle="pill" data-bs-target="#tabs-home" role="tab"
                                aria-controls="tabs-home" aria-selected="true">Basic Information</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a href="#tabs-itinerary"
                                class="nav-link w-full block font-medium text-sm font-Inter leading-tight capitalize border-x-0 border-t-0 border-b border-transparent px-4 pb-2 my-2 hover:border-transparent focus:border-transparent dark:text-slate-300"
                                data-bs-toggle="pill" role="tab">
                                Itinerary
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a href="#tabs-gallery"
                                class="nav-link w-full block font-medium text-sm font-Inter leading-tight capitalize border-x-0 border-t-0 border-b border-transparent px-4 pb-2 my-2 hover:border-transparent focus:border-transparent dark:text-slate-300"
                                data-bs-toggle="pill" role="tab">
                                Gallery
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a href="#tabs-profile"
                                class="nav-link w-full block font-medium text-sm font-Inter leading-tight capitalize border-x-0 border-t-0 border-b border-transparent px-4 pb-2 my-2 hover:border-transparent focus:border-transparent dark:text-slate-300"
                                id="tabs-profile-tab" data-bs-toggle="pill" data-bs-target="#tabs-profile" role="tab"
                                aria-controls="tabs-profile" aria-selected="false"> Additional Information</a>
                        </li>

                    </ul>

                    <div class="tab-content" id="tabs-tabContent">

                        <div class="tab-pane fade show active" id="tabs-home" role="tabpanel"
                            aria-labelledby="tabs-home-tab">
                            <div class="bg-white rounded-xl shadow p-6 space-y-10">
                                <form method="POST" action="{{ route('admin.packages.update', $package) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="update_section" value="basic">

                                    {{-- ================= BASIC INFO ================= --}}
                                    <h3 class="text-lg font-semibold mb-2">Basic Information</h3>

                                    <div class="grid grid-cols-2 gap-4 mb-4">

                                        <x-admin.form.category-select label="Package Categories" :categories="$categories"
                                            name="category_ids" :selected="$package?->packageCategories->pluck('category_id')->toArray()" multiple required />


                                        <div>
                                            <label class="form-label">Package Type *</label>
                                            <select name="package_type" class="form-control selectCountrySelect2">
                                                <option value="fixed" @selected($package->package_type == 'fixed')>Fixed</option>
                                                <option value="customized" @selected($package->package_type == 'customized')>Customized</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label class="form-label">Package Status *</label>
                                            <select name="status" class="form-control selectCountrySelect2" required>
                                                <option value="draft"
                                                    {{ old('status', $package->status) == 'draft' ? 'selected' : '' }}>
                                                    Draft
                                                </option>
                                                <option value="active"
                                                    {{ old('status', $package->status) == 'active' ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="inactive"
                                                    {{ old('status', $package->status) == 'inactive' ? 'selected' : '' }}>
                                                    Inactive
                                                </option>
                                            </select>
                                        </div>
                                        {{-- Tags --}}
                                        <div>
                                            <label class="form-label block mb-2">Tags</label>

                                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                                @foreach ($tags as $tag)
                                                    <x-admin.form.checkbox name="tags[]" :value="$tag->id"
                                                        :checked="in_array($tag->id, $selectedTags)" :label="$tag->name" />
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                    {{-- ================= AVAILABILITY ================= --}}
                                    <h3 class="text-lg font-semibold mb-2">Availability</h3>

                                    @php
                                        $avail = $package->availability;
                                    @endphp

                                    <div class="grid grid-cols-2 gap-4 mb-4 p-2 border">
                                        <div>
                                            <label class="form-label">Available From</label>
                                            <input type="date" class="form-control" name="availability[available_from]"
                                                value="{{ old('availability.available_from', optional($avail?->available_from)->format('Y-m-d')) }}">
                                        </div>

                                        <div>
                                            <label class="form-label">Available To</label>
                                            <input type="date" class="form-control" name="availability[available_to]"
                                                value="{{ old('availability.available_to', optional($avail?->available_to)->format('Y-m-d')) }}">
                                        </div>
                                        {{-- Booking Start Date --}}
                                        <div>
                                            <label class="form-label">Booking Start Date</label>
                                            <input type="date" class="form-control"
                                                name="availability[booking_start_date]"
                                                value="{{ old('availability.booking_start_date', optional($avail?->booking_start_date)->format('Y-m-d')) }}">
                                        </div>

                                        {{-- Booking End Date --}}
                                        <div>
                                            <label class="form-label">Booking End Date</label>
                                            <input type="date" class="form-control" name="availability[booking_end_date]"
                                                value="{{ old('availability.booking_end_date', optional($avail?->booking_end_date)->format('Y-m-d')) }}">
                                        </div>
                                    </div>

                                    {{-- ================= PRICING ================= --}}
                                    <h3 class="text-lg font-semibold mb-2">Pricing</h3>
                                    <input type="hidden" name="pricing[currency]" value="{{ $baseCurrency }}">

                                    <div class="grid grid-cols-2 gap-4 mb-4 border p-2">

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

                                        <div>
                                            <label class="form-label">Price (Per Person)</label>
                                            <input class="form-control" name="pricing[per_person_price]"
                                                value="{{ old('pricing.per_person_price', $package->price->per_person_price ?? '') }}">
                                        </div>

                                        <div>
                                            <label class="form-label">Discount Price(Per Person)</label>
                                            <input class="form-control" name="pricing[discount_price]"
                                                value="{{ old('pricing.discount_price', $package->price->discount_price ?? '') }}">
                                        </div>

                                        <div>
                                            <label class="form-label">Total Price</label>
                                            <input class="form-control" name="pricing[original_price]"
                                                value="{{ old('pricing.original_price', $package->price->original_price ?? '') }}">
                                        </div>
                                    </div>

                                    {{-- ================= TRANSLATIONS ================= --}}
                                    <h3 class="text-lg font-semibold mb-2">Package Translations</h3>
                                    <div class="border p-2">
                                        {{-- <div class="flex gap-2 pb-2 mb-4">
                                        @foreach ($languages as $lang)
                                            <button type="button" class="lang-btn {{ $loop->first ? 'active' : '' }}"
                                                data-lang="{{ strtolower($lang->code) }}">
                                                {{ strtoupper($lang->code) }}
                                            </button>
                                        @endforeach
                                    </div> --}}

                                        @php
                                            $sortedLanguages = $languages->sortBy(function ($lang) {
                                                return strtolower($lang->code) === 'en' ? 0 : 1;
                                            });
                                        @endphp

                                        <div class="flex gap-2 pb-2 mb-4">
                                            @foreach ($sortedLanguages as $lang)
                                                <button type="button"
                                                    class="lang-btn {{ strtolower($lang->code) === 'en' ? 'active' : '' }}"
                                                    data-lang="{{ strtolower($lang->code) }}">
                                                    {{ strtoupper($lang->code) }}
                                                </button>
                                            @endforeach
                                        </div>

                                        {{-- @foreach ($languages as $lang)
                                            @php
                                                $code = strtolower($lang->code);
                                                $trans = $package->translations->firstWhere('language_code', $code);
                                            @endphp

                                            <div class="lang-section {{ $loop->first ? 'active' : '' }}"
                                                id="lang-{{ $code }}">

                                                <label class="form-label">Title *</label>
                                                <input class="form-control mb-3"
                                                    name="translations[{{ $code }}][title]"
                                                    value="{{ old("translations.$code.title", $trans->title ?? '') }}">

                                                <label class="form-label">Sub Title</label>
                                                <input class="form-control mb-3"
                                                    name="translations[{{ $code }}][sub_title]"
                                                    value="{{ old("translations.$code.sub_title", $trans->sub_title ?? '') }}">

                                                <label class="form-label">Description</label>
                                                <textarea class="editor form-control h-28" name="translations[{{ $code }}][description]">{{ old("translations.$code.description", $trans->description ?? '') }}</textarea>
                                            </div>
                                        @endforeach --}}
                                        @foreach ($sortedLanguages as $lang)
                                            @php
                                                $code = strtolower($lang->code);
                                                $trans = $package->translations->firstWhere('language_code', $code);
                                            @endphp

                                            <div class="lang-section {{ $code === 'en' ? 'active' : '' }}"
                                                id="lang-{{ $code }}">

                                                <label class="form-label">Title *</label>
                                                <input class="form-control mb-3"
                                                    name="translations[{{ $code }}][title]"
                                                    value="{{ old("translations.$code.title", $trans->title ?? '') }}">

                                                <label class="form-label">Sub Title</label>
                                                <input class="form-control mb-3"
                                                    name="translations[{{ $code }}][sub_title]"
                                                    value="{{ old("translations.$code.sub_title", $trans->sub_title ?? '') }}">

                                                <label class="form-label">Description</label>
                                                <textarea class="editor form-control h-28" name="translations[{{ $code }}][description]">{{ old("translations.$code.description", $trans->description ?? '') }}</textarea>

                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="btn btn-success mt-6">Update Basic Info</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-itinerary">
                            <div class="bg-white rounded-xl shadow p-6 space-y-10">
                                <form method="POST" action="{{ route('admin.packages.update', $package) }}">

                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="update_section" value="itinerary">
                                    <h3 class="text-lg font-semibold">Itinerary</h3>
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="form-label">Duration Days *</label>
                                            <input id="duration_days" type="number" class="form-control"
                                                name="duration_days"
                                                value="{{ old('duration_days', $package->duration_days) }}">
                                        </div>

                                        <div>
                                            <label class="form-label">Duration Nights *</label>
                                            <input id="duration_nights" type="number" class="form-control"
                                                name="duration_nights"
                                                value="{{ old('duration_nights', $package->duration_nights) }}">
                                        </div>

                                        <div>
                                            <label class="form-label">Base Persons</label>
                                            <input class="form-control" name="base_persons"
                                                value="{{ old('base_persons', $package->base_persons) }}">
                                        </div>

                                        <div>
                                            <label class="form-label">Max Persons *</label>
                                            <input class="form-control" name="max_persons"
                                                value="{{ old('max_persons', $package->max_persons) }}">
                                        </div>
                                    </div>

                                    {{-- ================= CITIES ================= --}}
                                    <h3 class="text-lg font-semibold mb-2">Cities & Nights</h3>
                                    <div id="citiesContainer" class="mb-4"></div>

                                    {{-- ================= DAYS ================= --}}
                                    <h3 class="text-lg font-semibold mb-2">Day Wise Itinerary</h3>
                                    <div id="daysContainer"></div>
                                    <button class="btn btn-success mt-6">Update Itinerary</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-gallery">
                            <div class="bg-white rounded-xl shadow p-6 space-y-10">
                                <form method="POST" action="{{ route('admin.packages.update', $package) }}"
                                    enctype="multipart/form-data">

                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="update_section" value="media">
                                    <h3 class="text-lg font-semibold">Gallery</h3>
                                    {{-- ================= THUMBNAIL ================= --}}
                                    <div class="mb-4 mt-2">
                                        <label class="form-label">Thumbnail</label>

                                        {{-- Existing Thumbnail Preview --}}

                                        <input type="file" name="thumb"
                                            class="form-control mb-4 @error('thumb') error-input @enderror">

                                        @if ($package->thumb)
                                            <img src="{{ asset('storage/' . $package->thumb->image_path) }}"
                                                class="h-24 w-24 object-cover rounded border">
                                        @endif


                                        @error('thumb')
                                            <p class="error-text">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <x-admin.form.gallery :model="$package"
                                        deleteRoute="{{ route('gallery.delete', ':id') }}" />
                                    <button type="submit" class="btn btn-success mt-6">
                                        Update Media
                                    </button>
                                </form>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-profile" role="tabpanel" aria-labelledby="tabs-profile-tab">
                            @include('backend.packages.partials.additional-info.index', [
                                'package' => $package, // 🔥 edit ke liye IMPORTANT
                                'languages' => $languages,
                            ])
                        </div>

                    </div>

                </div>
            </div>
        </div>


        {{-- ================= EXISTING DATA FOR JS ================= --}}
        <script>
            window.existingCities = @json($package->cities);
            window.existingDays = @json($package->days);
        </script>

        <script>
            /* ================= DOM REFERENCES ================= */
            const duration_days = document.getElementById('duration_days');
            const duration_nights = document.getElementById('duration_nights');
            const citiesContainer = document.getElementById('citiesContainer');
            const daysContainer = document.getElementById('daysContainer');

            /* ================= BACKEND DATA ================= */
            const cities = @json($cities);
            const hotels = @json($hotels);
            const events = @json($events);
            const todos = @json($todos);
            const transports = @json($transports);

            /* ================= EXISTING DATA (EDIT MODE) ================= */
            window.existingCities = @json($package->cities ?? []);
            window.existingDays = @json($package->days ?? []);

            /* ================= ITEM MAP ================= */
            const itemsMap = {
                hotel: hotels,
                event: events,
                todo: todos,
                transport: transports
            };

            // 🔥 TRACK USED ITEMS PER DAY
            function getUsedItems(day) {
                const used = {
                    hotel: new Set(),
                    event: new Set(),
                    todo: new Set(),
                    transport: new Set()
                };

                const dayData = window.existingDays?.find(x => x.day_number == day);

                if (dayData?.items) {
                    dayData.items.forEach(it => {
                        if (it.item_type && it.item_id) {
                            used[it.item_type]?.add(String(it.item_id));
                        }
                    });
                }

                return used;
            }

            /* ======================================================
               CITIES (NIGHTS) RENDER – EDIT SAFE
            ====================================================== */
            //     function renderCities(n) {
            //         citiesContainer.innerHTML = '';
            //         n = parseInt(n || 0);

            //         for (let i = 0; i < n; i++) {

            //             const row = window.existingCities?.[i] || {};

            //             citiesContainer.insertAdjacentHTML('beforeend', `
    //     <div class="border rounded p-4 mb-4 bg-gray-50">

    //         <h5 class="font-semibold mb-3">City ${i + 1}</h5>

    //         <div class="grid grid-cols-3 gap-4">

    //             <div>
    //                 <label class="form-label">Select City *</label>
    //                 <select class="form-control selectCountrySelect2"
    //                         name="cities[${i}][city_id]"
    //                         required>
    //                     <option value="">Select City</option>
    //                     ${cities.map(c =>
    //                         `<option value="${c.id}" ${c.id == row.city_id ? 'selected' : ''}>
            //                                                                                     ${c.slug}
            //                                                                                 </option>`
    //                     ).join('')}
    //                 </select>
    //             </div>

    //             <div>
    //                 <label class="form-label">Number of Nights *</label>
    //                 <input class="form-control"
    //                        type="number"
    //                        min="1"
    //                        name="cities[${i}][nights]"
    //                        value="${row.nights ?? 1}"
    //                        required>
    //             </div>

    //             <div>
    //                 <label class="form-label">Sort Order</label>
    //                 <input class="form-control"
    //                        type="number"
    //                        min="1"
    //                        name="cities[${i}][sort_order]"
    //                        value="${row.sort_order ?? (i + 1)}">
    //             </div>

    //         </div>
    //     </div>
    // `);
            //         }

            //     }

            function renderCities(n) {

                citiesContainer.innerHTML = '';
                n = parseInt(n || 0);

                for (let i = 0; i < n; i++) {

                    const row = window.existingCities?.[i] || {};

                    citiesContainer.insertAdjacentHTML('beforeend', `

<div class="border rounded p-4 mb-4 bg-gray-50 city-row">

<div class="flex justify-between items-center mb-3">
    <h5 class="font-semibold">City ${i + 1}</h5>

    <button type="button"
            class="btn btn-sm btn-outline-dark remove-city" data-city="${row.city_id ?? ''}"  data-tippy-content="Delete Cities">
            <iconify-icon icon="heroicons:trash"></iconify-icon>
    </button>

</div>

<div class="grid grid-cols-3 gap-4">

    <div>
        <label class="form-label">Select City *</label>

        <select class="form-control selectCountrySelect2"
                name="cities[${i}][city_id]"
                required>

            <option value="">Select City</option>

            ${cities.map(c => `
                                                                        <option value="${c.id}" ${c.id == row.city_id ? 'selected' : ''}>
                                                                            ${c.slug}
                                                                        </option>
                                                                    `).join('')}

        </select>
    </div>

    <div>
        <label class="form-label">Number of Nights *</label>

        <input class="form-control city-nights"
               type="number"
               min="0"
               name="cities[${i}][nights]"
               value="${row.nights ?? 0}"
               readonly
               required>
    </div>

    <div>
        <label class="form-label">Sort Order</label>

        <input class="form-control"
               type="number"
               min="1"
               name="cities[${i}][sort_order]"
               value="${row.sort_order ?? (i + 1)}">
    </div>

</div>

</div>

`);
                }

                tippy('[data-tippy-content]');
            }

            /* ======================================================
               DAY BLOCK
            ====================================================== */
            function activityBlock(day, index, item = {}) {

                const used = getUsedItems(day);
                const currentId = String(item.item_id || '');

                let optionsHTML = '';

                if (item.item_type && itemsMap[item.item_type]) {
                    optionsHTML = itemsMap[item.item_type]
                        .filter(o => {
                            const oid = String(o.id);

                            // ✅ allow current selected
                            if (oid === currentId) return true;

                            // ❌ block already used
                            return !used[item.item_type]?.has(oid);
                        })
                        .map(o => `
            <option value="${o.id}" ${o.id == item.item_id ? 'selected' : ''}>
                ${o.name ?? o.title}
            </option>
        `).join('');
                }

                //                 return `
        // <div class="border p-3 mb-3">
        //     <select class="form-control selectCountrySelect2 mb-4 activity-type">
        //         <option value="">Activity Type</option>
        //         ${['hotel','event','todo','transport'].map(t =>
        //             `<option value="${t}" ${item.item_type === t ? 'selected' : ''}>
                //                                                                                                                                                 ${t.charAt(0).toUpperCase()+t.slice(1)}
                //                                                                                                                                             </option>`
        //         ).join('')}
        //     </select>

        //     <select class="form-control mb-2 item-select selectCountrySelect2"
        //             name="days[${day}][items][${index}][item_id]">
        //         <option value="">Select Item</option>
        //         ${optionsHTML}
        //     </select>

        //     <input type="hidden"
        //            name="days[${day}][items][${index}][item_type]"
        //            value="${item.item_type ?? ''}">

        //     <label class="form-label">Start Time</label>
        //     <input type="time"
        //            class="form-control mb-2"
        //            name="days[${day}][items][${index}][start_time]"
        //            value="${item.start_time ?? ''}">

        //     <label class="form-label">End Time</label>
        //     <input type="time"
        //            class="form-control"
        //            name="days[${day}][items][${index}][end_time]"
        //            value="${item.end_time ?? ''}">
        // </div>
        // `;

                //             }
                return `
<div class="border p-3 mb-3 activity-row">

    <div class="flex justify-between items-center mb-2">
        <strong>Activity</strong>
        <button type="button" class="btn btn-sm btn-outline-dark remove-activity" data-tippy-content="Delete Activity">
            <iconify-icon icon="heroicons:trash"></iconify-icon>
        </button>
    </div>

    <select class="form-control selectCountrySelect2 mb-4 activity-type">
        <option value="">Activity Type</option>
        ${['hotel','event','todo','transport'].map(t =>
            `<option value="${t}" ${item.item_type === t ? 'selected' : ''}>
                                                                                                ${t.charAt(0).toUpperCase()+t.slice(1)}
                                                                                            </option>`
        ).join('')}
    </select>

    <select class="form-control mb-2 item-select selectCountrySelect2"
            name="days[${day}][items][${index}][item_id]">
        <option value="">Select Item</option>
        ${optionsHTML}
    </select>

    <input type="hidden"
           name="days[${day}][items][${index}][item_type]"
           value="${item.item_type ?? ''}">

    <label class="form-label">Start Time</label>
    <input type="time"
           class="form-control mb-2"
           name="days[${day}][items][${index}][start_time]"
           value="${item.start_time ?? ''}">

    <label class="form-label">End Time</label>
    <input type="time"
           class="form-control"
           name="days[${day}][items][${index}][end_time]"
           value="${item.end_time ?? ''}">
</div>
`;

                tippy('[data-tippy-content]');

            }


            /* ======================================================
               DAYS + ACTIVITIES – EDIT SAFE
            ====================================================== */
            function renderDays(days) {
                daysContainer.innerHTML = '';
                days = parseInt(days || 0);

                for (let d = 1; d <= days; d++) {

                    const dayData = window.existingDays?.find(x => x.day_number == d) || {};
                    const items = dayData.items || [];

                    let activitiesHTML = '';
                    items.forEach((item, idx) => {
                        activitiesHTML += activityBlock(d, idx, item);
                    });

                    daysContainer.insertAdjacentHTML('beforeend', `
<div class="border rounded p-4 mb-6 day-row">
    <div class="flex justify-between items-center mb-2">
    <h4 class="font-semibold">Day ${d}</h4>

    <button type="button"
            class="btn btn-sm btn-outline-dark remove-day" data-tippy-content="Delete Day">
            <iconify-icon icon="heroicons:trash"></iconify-icon>
    </button>
</div>

                <select class="form-control selectCountrySelect2"
                        name="days[${d}][city_id]">
                    <option value="">Select City</option>
                    ${cities.map(c =>
                        `<option value="${c.id}" ${c.id == dayData.city_id ? 'selected' : ''}>
                                                                                                                                                                                                                                                                                                                    ${c.slug}
                                                                                                                                                                                                                                                                                                                </option>`
                    ).join('')}
                </select>

                <div class="activities" data-day="${d}">
                    ${activitiesHTML}
                </div>

                <button type="button"
                        class="btn btn-sm btn-outline-dark add-activity"
                        data-day="${d}">
                    + Add Activity
                </button>
            </div>
            `);
                }

                tippy('[data-tippy-content]');

            }

            /* ======================================================
               ADD ACTIVITY (NO DATA LOSS)
            ====================================================== */
            document.addEventListener('click', function(e) {
                if (!e.target.classList.contains('add-activity')) return;

                const day = e.target.dataset.day;
                const box = e.target.previousElementSibling;
                const index = box.children.length;

                box.insertAdjacentHTML('beforeend', activityBlock(day, index));
                // $('.selectCountrySelect2').select2();

            });

            document.addEventListener('click', function(e) {

                if (!e.target.classList.contains('remove-activity')) return;

                const row = e.target.closest('.activity-row');

                if (confirm("Remove this activity?")) {
                    row.remove();
                }

            });

            /* ======================================================
               ACTIVITY TYPE CHANGE
            ====================================================== */
            document.addEventListener('change', function(e) {
                if (!e.target.classList.contains('activity-type')) return;

                const wrap = e.target.closest('.border');
                const type = e.target.value;

                wrap.querySelector('input[name*="[item_type]"]').value = type;

                const select = wrap.querySelector('.item-select');
                select.classList.add("selectCountrySelect2");
                select.innerHTML = '<option value="">Select Item</option>';


                // ✅ NEW SMART FILTER
                const day = wrap.closest('.activities').dataset.day;
                const used = getUsedItems(day);
                const currentId = select.value;

                (itemsMap[type] || []).forEach(item => {
                    const idStr = String(item.id);

                    if (idStr === currentId || !used[type]?.has(idStr)) {
                        select.insertAdjacentHTML(
                            'beforeend',
                            `<option value="${item.id}">${item.name ?? item.title}</option>`
                        );
                    }
                });
            });

            /* ======================================================
               INPUT CHANGE – SAFE (NO WIPE)
            ====================================================== */
            duration_days.addEventListener('change', () => {
                renderDays(duration_days.value);
            });

            duration_nights.addEventListener('change', () => {
                renderCities(duration_nights.value);
            });

            /* ======================================================
               LANGUAGE TABS
            ====================================================== */
            document.querySelectorAll('[data-lang]').forEach(btn => {
                btn.onclick = () => {
                    document.querySelectorAll('.lang-btn').forEach(b => b.classList.remove('active'));
                    document.querySelectorAll('.lang-section').forEach(s => s.classList.remove('active'));
                    btn.classList.add('active');
                    document.getElementById('lang-' + btn.dataset.lang).classList.add('active');
                };
            });

            document.querySelectorAll('[data-info]').forEach(btn => {
                btn.onclick = () => {
                    document.querySelectorAll('[data-info]').forEach(b => b.classList.remove('active'));
                    document.querySelectorAll('.info-lang-section').forEach(s => s.classList.remove('active'));
                    btn.classList.add('active');
                    document.getElementById('info-' + btn.dataset.info).classList.add('active');
                };
            });

            /* ======================================================
               INITIAL LOAD (CREATE + EDIT)
            ====================================================== */
            document.addEventListener('DOMContentLoaded', () => {
                if (duration_nights.value > 0) renderCities(duration_nights.value);
                if (duration_days.value > 0) renderDays(duration_days.value);
            });

            document.addEventListener('click', function(e) {

                if (!e.target.classList.contains('remove-day')) return;

                const row = e.target.closest('.day-row');
                row.remove();

                const totalDays = document.querySelectorAll('.day-row').length;

                duration_days.value = totalDays;
                duration_nights.value = totalDays > 0 ? totalDays - 1 : 0;

            });

            document.addEventListener("input", function(e) {

                if (!e.target.classList.contains("city-nights")) return;

                let nights = 0;

                document.querySelectorAll(".city-nights").forEach(el => {
                    nights += parseInt(el.value || 0);
                });

                duration_nights.value = nights;
                duration_days.value = nights > 0 ? nights + 1 : 1;

            });

            function reindexCities() {

                const rows = document.querySelectorAll('.city-row');

                rows.forEach((row, index) => {

                    row.querySelector("h5").innerText = `City ${index+1}`;

                    row.querySelector("select").name = `cities[${index}][city_id]`;
                    row.querySelector(".city-nights").name = `cities[${index}][nights]`;

                    row.querySelector('input[name*="sort_order"]').name = `cities[${index}][sort_order]`;

                });

            }

            document.addEventListener("click", function(e) {

                if (!e.target.classList.contains("remove-city")) return;

                if (!confirm("Remove this city?")) return;

                const cityId = e.target.dataset.city;

                fetch(`/admin/packages/{{ $package->id }}/city/${cityId}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json"
                        }
                    })
                    .then(res => res.json())
                    .then(data => {

                        if (data.success) {

                            e.target.closest(".city-row").remove();

                            iziToast.success({
                                title: "Success",
                                message: data.message,
                                position: "topRight"
                            });

                        } else {

                            iziToast.error({
                                title: "Error",
                                message: data.message,
                                position: "topRight"
                            });

                        }

                    })
                    .catch(() => {

                        iziToast.error({
                            title: "Error",
                            message: "Something went wrong",
                            position: "topRight"
                        });

                    });

            });
        </script>
    @endsection
