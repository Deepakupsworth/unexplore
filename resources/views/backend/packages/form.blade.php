@extends('backend.layout')

@section('content')
    <style>
        .tab-btn {
            padding: .6rem 1rem;
            border-bottom: 2px solid transparent;
            cursor: pointer
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

        .lang-section {
            display: none
        }

        .lang-section.active {
            display: block
        }
    </style>

    <form method="POST" action="{{ route('admin.packages.store') }}">
        @csrf

        @php
            $tabs = ['basic', 'availability', 'cities', 'itinerary', 'pricing', 'info'];
        @endphp

        <div class="bg-white rounded-xl shadow">

            {{-- ================= TAB HEADERS ================= --}}
            <ul class="flex border-b p-2">
                @foreach ($tabs as $i => $tab)
                    <li>
                        <button type="button" class="tab-btn {{ $i == 0 ? 'active' : '' }}" data-index="{{ $i }}">
                            {{ ucfirst($tab) }}
                        </button>
                    </li>
                @endforeach
            </ul>

            <div class="p-6">

                {{-- ================================================= --}}
                {{-- ================= BASIC ========================== --}}
                {{-- ================================================= --}}
                <div class="tab-pane active">

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <select name="category_id" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->translation->name }}</option>
                            @endforeach
                        </select>

                        <select name="package_type" class="form-control">
                            <option value="fixed">Fixed</option>
                            <option value="customized">Customized</option>
                        </select>

                        <input id="days" name="duration_days" class="form-control" placeholder="Duration Days">
                        <input id="nights" name="duration_nights" class="form-control" placeholder="Duration Nights">
                        <input name="base_persons" class="form-control" placeholder="Base Persons">
                        <input name="max_persons" class="form-control" placeholder="Max Persons">
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

                    {{-- Language Sections --}}
                    @foreach ($languages as $lang)
                        @php $code=strtolower($lang->code); @endphp
                        <div class="lang-section {{ $loop->first ? 'active' : '' }}" id="lang-{{ $code }}">
                            <input name="translations[{{ $code }}][title]" class="form-control mb-3"
                                placeholder="Title ({{ strtoupper($code) }})" {{ $code == 'en' ? 'required' : '' }}>

                            <input name="translations[{{ $code }}][sub_title]" class="form-control mb-3"
                                placeholder="Sub title">

                            <textarea name="translations[{{ $code }}][description]" class="form-control h-28" placeholder="Description"></textarea>
                        </div>
                    @endforeach

                </div>

                {{-- ================================================= --}}
                {{-- ================= AVAILABILITY =================== --}}
                {{-- ================================================= --}}
                <div class="tab-pane">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="form-label">Available From</label>
                            <input type="date" name="availability[from]" class="form-control">
                        </div>

                        <div>
                            <label class="form-label">Available To</label>
                            <input type="date" name="availability[to]" class="form-control">
                        </div>

                        <div>
                            <label class="form-label">Booking Start Date</label>
                            <input type="date" name="availability[booking_start_date]" value="booking_start_date"
                                class="form-control">
                        </div>

                        <div>
                            <label class="form-label">Booking End Date</label>
                            <input type="date" name="availability[booking_end_date]" value="booking_end_date"
                                class="form-control">
                        </div>
                    </div>
                </div>

                {{-- ================================================= --}}
                {{-- ================= CITIES ========================= --}}
                {{-- ================================================= --}}
                <div class="tab-pane">
                    <div id="citiesContainer"></div>
                </div>

                {{-- ================================================= --}}
                {{-- ================= ITINERARY ====================== --}}
                {{-- ================================================= --}}
                <div class="tab-pane">
                    <div id="itineraryContainer"></div>
                </div>

                {{-- ================================================= --}}
                {{-- ================= PRICING ======================== --}}
                {{-- ================================================= --}}
                <div class="tab-pane">
                    <div class="grid grid-cols-2 gap-4 mb-6">

                        <div>
                            <label class="form-label">Currency</label>
                            <input name="pricing[currency]" value="" class="form-control">
                        </div>

                        <div>
                            <label class="form-label">Original Price</label>
                            <input type="number" name="pricing[original_price]" value="" class="form-control">
                        </div>

                        <div>
                            <label class="form-label">Discount Price</label>
                            <input type="number" name="pricing[discount_price]" value="" class="form-control">
                        </div>

                        <div>
                            <label class="form-label">Per Person Price</label>
                            <input type="number" name="pricing[per_person_price]" value="" class="form-control">
                        </div>

                    </div>
                </div>

                {{-- ================================================= --}}
                {{-- ================= INFO TAB ====================== --}}
                {{-- ================================================= --}}
                <div class="tab-pane" id="info">

                    {{-- Language Tabs --}}
                    <div class="flex gap-2 border-b mb-4 pb-2">
                        @foreach ($languages as $lang)
                            <button type="button" class="lang-btn {{ $loop->first ? 'active' : '' }}"
                                data-info-lang="{{ strtolower($lang->code) }}">
                                {{ strtoupper($lang->code) }}
                            </button>
                        @endforeach
                    </div>

                    {{-- Language Sections --}}
                    @foreach ($languages as $lang)
                        @php
                            $code = strtolower($lang->code);
                        @endphp

                        <div class="info-lang-section {{ $loop->first ? 'active' : '' }}"
                            id="info-lang-{{ $code }}">

                            @foreach (['cancellation', 'visa', 'season'] as $type)
                                @php
                                    $info = $package->exists ? $package->infos->where('type', $type)->first() : null;

                                    $infoT = $info ? $info->translations->where('language_code', $code)->first() : null;
                                @endphp

                                <div class="mb-6">

                                    {{-- TITLE (REQUIRED BY DB) --}}
                                    <label class="form-label">
                                        {{ ucfirst($type) }} Title ({{ strtoupper($code) }})
                                    </label>
                                    <input type="text"
                                        name="infos[{{ $type }}][translations][{{ $code }}][title]"
                                        class="form-control mb-2"
                                        value="{{ old("infos.$type.translations.$code.title", $infoT->title ?? '') }}">

                                    {{-- CONTENT --}}
                                    <label class="form-label">
                                        {{ ucfirst($type) }} Content
                                    </label>
                                    <textarea name="infos[{{ $type }}][translations][{{ $code }}][content]" class="form-control h-24">{{ old("infos.$type.translations.$code.content", $infoT->content ?? '') }}</textarea>

                                </div>
                            @endforeach

                        </div>
                    @endforeach
                </div>


                {{-- ================= BUTTONS ================= --}}
                <div class="flex justify-between mt-6">
                    <button type="button" class="btn btn-outline-dark" id="prevBtn">← Prev</button>
                    <button type="button" class="btn btn-dark" id="nextBtn">Next →</button>
                    <button type="submit" class="btn btn-success" id="submitBtn" style="display:none">
                        Create Package
                    </button>
                </div>

            </div>
        </div>
    </form>

    {{-- ================= JS ================= --}}
    <script>
        const tabs = document.querySelectorAll('.tab-pane');
        const btns = document.querySelectorAll('.tab-btn');
        let i = 0;

        function showTab(n) {
            tabs.forEach(t => t.classList.remove('active'));
            btns.forEach(b => b.classList.remove('active'));
            tabs[n].classList.add('active');
            btns[n].classList.add('active');
            document.getElementById('prevBtn').style.display = n === 0 ? 'none' : 'inline-flex';
            document.getElementById('nextBtn').style.display = n === tabs.length - 1 ? 'none' : 'inline-flex';
            document.getElementById('submitBtn').style.display = n === tabs.length - 1 ? 'inline-flex' : 'none';
            i = n;
        }
        btns.forEach((b, idx) => b.onclick = () => showTab(idx));
        document.getElementById('prevBtn').onclick = () => showTab(i - 1);
        document.getElementById('nextBtn').onclick = () => showTab(i + 1);
        showTab(0);

        document.querySelectorAll('.lang-btn').forEach(btn => {
            btn.onclick = () => {
                document.querySelectorAll('.lang-btn').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.lang-section').forEach(s => s.classList.remove('active'));
                btn.classList.add('active');
                document.getElementById('lang-' + btn.dataset.lang).classList.add('active');
            };
        });

        const cities = @json($cities);

        function render() {
            const d = parseInt(days.value || 0);
            const n = parseInt(nights.value || 0);
            citiesContainer.innerHTML = '';
            itineraryContainer.innerHTML = '';

            for (let i = 0; i < n; i++) {
                citiesContainer.innerHTML += `
<div class="grid grid-cols-3 gap-4 mb-3">
<select name="cities[${i}][city_id]" class="form-control">
<option value="">City</option>
${cities.map(c=>`<option value="${c.id}">${c.slug}</option>`).join('')}
</select>
<div>
    <label class="form-label">Nights</label>
        <input type="" name="cities[${i}][nights]" value="1" class="form-control">
</div>
<div>
    <label class="form-label">Order</label>
    <input type="" name="cities[${i}][sort_order]" value="${i+1}" class="form-control">
    </div>
</div>`;
            }

            for (let dno = 1; dno <= d; dno++) {
                itineraryContainer.innerHTML += `
<div class="border p-4 mb-4">
<h6>Day ${dno}</h6>
<select name="itinerary[${dno}][city_id]" class="form-control mb-3">
<option value="">City</option>
${cities.map(c=>`<option value="${c.id}">${c.slug}</option>`).join('')}
</select>
<input type="hidden" name="itinerary[${dno}][items][0][item_type]" value="hotel">
<input type="hidden" name="itinerary[${dno}][items][0][item_id]" value="1">
</div>`;
            }
        }
        days.onchange = render;
        nights.onchange = render;
    </script>
@endsection
