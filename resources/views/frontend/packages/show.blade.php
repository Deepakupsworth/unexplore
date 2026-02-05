@extends('frontend.layout')

@section('content')
    <style>
        .selectable-card {
            cursor: pointer;
        }

        .selectable-card.active {
            border-color: #198754;
            background-color: #f6fffa;
        }


        .selectable-card-wrapper {
            cursor: pointer;
        }

        .selectable-card-wrapper.active {
            border-color: #198754;
            background-color: #f6fffa;
        }
    </style>
    @php

        $t = $package->translation;
        $price = $package->price;
        $persons = request('persons', 1);

        $totalPrice = ($price?->per_person_price ?? 0) * $persons;

        $cities = $package->cities->pluck('city.translations.0.name')->filter()->implode(' • ');

        $gallery = $package->gallery ?? collect();

        $coverImage =
            $package->thumb?->image_path ??
            (optional($gallery->first())->image_path ?? 'frontend/assets/package-details-banner.png');

        use Carbon\Carbon;

        $startDate = Carbon::parse($package->start_date); // MUST EXIST
        $endDate = $startDate->copy()->addDays($package->duration_nights);
    @endphp

    <section>

        <script>
            window.PRICE_STATE = {
                persons: {
                    adults: {{ $package->base_persons }},
                    children: 0
                },
                extras: {
                    dayItems: 0
                }
            };
        </script>

        <div class="container">
            <div class="gallery-wrapper swiper">
                <div class="swiper-wrapper  gallery-grid">
                    <!-- LEFT LARGE IMAGE -->
                    <div class="gallery-item gallery-item--large swiper-slide open-gallery">
                        <img class="img-fluid" src="{{ asset('storage/' . $package->thumb->image_path) }}" alt="">
                        <button class="view-gallery-btn" data-bs-toggle="modal" data-bs-target="#galleryModal">
                            <i class="fa-regular fa-image"></i>
                            {{ __('package.gallery.view') }} →
                        </button>
                    </div>

                    <!-- RIGHT GRID -->
                    <div class="gallery-middle swiper-slide">
                        <div class="d-flex flex-column gap-2">
                            <div class="gallery-item full open-gallery" data-open-tab="galleryTabsActivities"
                                data-bs-toggle="modal" data-bs-target="#galleryModal">

                                <?php
                                //print_r($finalArray['todo'][0]['thumb']);die;
                                $imagePathToDo = match (true) {
                                    !empty($finalArray['todo'][0]['thumb']) => asset('storage/' . $finalArray['todo'][0]['thumb']->image_path),

                                    !empty($finalArray['event'][0]['thumb']) => asset('storage/' . $finalArray['event'][0]['thumb']->image_path),

                                    !empty($finalArray['hotel'][0]['thumb']) => asset('storage/' . $finalArray['hotel'][0]['thumb']->image_path),

                                    !empty($package->thumb) => asset('storage/' . $package->thumb->image_path),

                                    default => asset('frontend/assets/package-banner.png'),
                                };
                                ?>




                                <img class="img-fluid" src="{{ $imagePathToDo }}" alt="">
                                <p class="p-small">{{ __('package.gallery.activities') }}</p>
                            </div>
                        </div>

                        <div class="d-flex flex-column gap-2">
                            @php
                                $imagePathEvent = match (true) {
                                    !empty($finalArray['event'][0]['thumb']) => asset(
                                        'storage/' . $finalArray['event'][0]['thumb']->image_path,
                                    ),

                                    !empty($finalArray['todo'][0]['thumb']) => asset(
                                        'storage/' . $finalArray['todo'][0]['thumb']->image_path,
                                    ),

                                    !empty($finalArray['hotel'][0]['thumb']) => asset(
                                        'storage/' . $finalArray['hotel'][0]['thumb']->image_path,
                                    ),

                                    !empty($package->thumb) => asset('storage/' . $package->thumb->image_path),

                                    default => asset('frontend/assets/package-banner.png'),
                                };

                                $videoUrl = match (true) {
                                    !empty($finalArray['event'][0]['video_url']) => $finalArray['event'][0][
                                        'video_url'
                                    ],

                                    default => null,
                                };
                            @endphp


                            @if ($videoUrl)
                                <div class="gallery-item half">

                                    <video controls>
                                        <source src="{{ $videoUrl }}" type="video/mp4">
                                    </video>
                                </div>

                                <div class="gallery-item  half open-gallery" data-open-tab="galleryTabsHighlights"
                                    data-bs-toggle="modal" data-bs-target="#galleryModal">
                                    <img class="img-fluid" src="{{ $imagePathEvent }}" alt="">
                                    <p class="p-small">{{ __('package.gallery.events') }}</p>
                                </div>
                            @else
                                <div class="gallery-item full open-gallery" data-open-tab="galleryTabsActivities"
                                    data-bs-toggle="modal" data-bs-target="#galleryModal">
                                    <img class="img-fluid" src="{{ $imagePathEvent }}" alt="">
                                    <p class="p-small">{{ __('package.gallery.events') }}</p>
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="gallery-item gallery-item--large swiper-slide open-gallery"
                        data-open-tab="galleryTabsProperty" data-bs-toggle="modal" data-bs-target="#galleryModal">
                        @php
                            $imagePathHotel = match (true) {
                                !empty($finalArray['hotel'][0]['thumb']) => asset(
                                    'storage/' . $finalArray['hotel'][0]['thumb']->image_path,
                                ),

                                !empty($finalArray['event'][0]['thumb']) => asset(
                                    'storage/' . $finalArray['event'][0]['thumb']->image_path,
                                ),

                                !empty($finalArray['todo'][0]['thumb']) => asset(
                                    'storage/' . $finalArray['todo'][0]['thumb']->image_path,
                                ),

                                !empty($package->thumb) => asset('storage/' . $package->thumb->image_path),

                                default => asset('frontend/assets/package-banner.png'),
                            };
                        @endphp



                        <img class="img-fluid" src="{{ $imagePathHotel }}" alt="">
                        <p class="p-small">{{ __('package.gallery.hotels') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- @dd($package) --}}
    @include('frontend.packages.partials.filter-bar', [
        'package' => $package,
    ])
    <section>
        <div class="container">
            <div class="pkg-details__wrapper mb-3">

                <div class="pkg-details">

                    {{-- HEADER --}}
                    <div class="section__header mt-4">
                        <div class="section__header-content">
                            <h2 class="section__heading">
                                {{ $t->title }}
                            </h2>

                            <div class="section__description d-flex gap-2 align-items-center">
                                <p>{{ $t->sub_title }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- TABS --}}
                    <ul class="nav nav-pills mt-3 pkg-details__tabs">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pkg-details__overview-tab" data-bs-toggle="pill"
                                data-bs-target="#explore-saudi__overview-tab-content" type="button" role="tab"
                                aria-controls="explore-saudi__overview-tab-content" aria-selected="true">{{ __('package.tabs.overview') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pkg-details__additional-tab" data-bs-toggle="pill"
                                data-bs-target="#explore-saudi__additional-tab-content" type="button" role="tab"
                                aria-controls="explore-saudi__additional-tab-content" aria-selected="false">
                                {{ __('package.tabs.additional_info') }}
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-content">
                            {{-- OVERVIEW TAB --}}

                            @include('frontend.packages.partials.tabs.overview')

                            {{-- ADDITIONAL INFO TAB --}}
                            @include('frontend.packages.partials.tabs.additional-info-tabs')
                        </div>

                        <div class="tab-pane fade mt-4" id="additional">
                            {!! $t->additional_info ?? '' !!}
                        </div>

                    </div>
                </div>


                <div class="pkg-details__pricing mt-4">
                    <div class="card pkg-details__pricing-card">
                        @if ($package->price->discount_price)
                            <p class="fw-500">{{ __('package.pricing.starting_from') }}</p>
                            <div class="d-flex align-items-center gap-1">
                                <img src="{{ asset('frontend/assets/icons/riyal-light.svg') }}" alt="Riyal">
                                <p class="text-decoration-line-through fw-600 text-light2">
                                    {{ $package->price->discount_price }}</p>
                            </div>
                        @endif

                        <div class="d-flex align-items-center gap-1">
                            <img src="{{ asset('frontend/assets/icons/riyal-primary.svg') }}" alt="Riyal">
                            <h5 class="text-success fw-bold">{{ $package->price->per_person_price }}</h5>
                            <p class="text-light2 fw-500">{{ __('package.pricing.per_person') }}</p>
                        </div>

                        {{-- <a href="{{route('checkout.view')}}" class="btn btn-primary justify-content-center pkg-details__book-now-btn my-2">
                            Book Now
                        </a> --}}

                        <form action="{{ route('checkout.init') }}" method="POST" id="packageCheckoutForm">

                            {{-- 🔒 CSRF not required for GET, but ok if POST --}}
                            @csrf
                            <input type="hidden" name="slug" value="{{ $package->slug }}">

                            <input type="hidden" name="day_items_extra" id="dayItemsExtraInput"
                                form="packageCheckoutForm">
                            <button type="submit"
                                class="btn btn-primary justify-content-center pkg-details__book-now-btn my-2">
                                {{ __('package.pricing.book_now') }}
                            </button>

                        </form>


                        <div class="fw-500 text-light2 d-flex align-items-center gap-1">
                            <p>{{ __('package.pricing.total_price') }}</p>
                            <img src="{{ asset('frontend/assets/icons/riyal-light.svg') }}" alt="Riyal">
                            <p id="liveTotalPrice">{{ $package->price->original_price }}</p>

                        </div>

                        <!-- Decorative line -->
                        <div class="pkg-details__decorative-line my-3">
                            <img src="{{ asset('frontend/assets/decorative-line.png') }}" alt="Decorative Line"
                                class="img-fluid w-100">
                        </div>

                        <!-- Duration -->
                        <div class="pkg-details__additional-info-item py-2 px-3 d-flex align-items-center gap-2 mb-2">
                            <i class="fa-solid fa-clock primary-text"></i>
                            <div class="">
                                <p class="text-light2">{{ __('package.duration.label') }}:</p>
                                <p class="fw-600 p-large">{{ $package->duration_nights }} Nights &
                                    {{ $package->duration_days }} Days</p>
                            </div>
                        </div>

                        <!-- Places to Visit -->
                        <div class="pkg-details__additional-info-item py-2 px-3 d-flex align-items-center gap-2 mt-2">
                            <i class="fa-solid fa-location-dot primary-text"></i>

                            <div>
                                <p class="text-light2 mb-0">{{ __('package.places_to_visit') }}:</p>

                                <p class="fw-600 p-large mb-0" style="font-size: 15px">
                                    @foreach ($places as $place)
                                        {{ $place['nights'] }}N {{ $place['city'] }}
                                        @if (!$loop->last)
                                .
                                        @endif
                                    @endforeach
                                </p>
                            </div>
                        </div>



                    </div>

                    <div class="card pkg-details__pricing-card mt-3">
                        <p class="p-large">{{ __('package.help.title') }}</p>
                        <button class="btn btn-outline-secondary rounded-pill fw-600 mt-3 pkg-details__get-more-help-btn">
                            {{ __('package.help.cta') }}
                        </button>
                    </div>

                    <div class="mt-4">
                        <p>{{ __('package.share') }}</p>
                        <div class="mt-2 pkg-details__share-icons">
                            <a href="#" class="flex-center">
                                <img src="{{ asset('frontend/assets/icons/instagram.svg') }}" alt="Instagram">
                            </a>
                            <a href="#" class="flex-center">
                                <img src="{{ asset('frontend/assets/icons/facebook.svg') }}" alt="Facebook">
                            </a>
                            <a href="#" class="flex-center">
                                <img src="{{ asset('frontend/assets/icons/facebook.svg') }}" alt="Facebook">
                            </a>
                            <a href="#" class="flex-center">
                                <img src="{{ asset('frontend/assets/icons/x.svg') }}" alt="X">
                            </a>
                            <a href="#" class="flex-center">
                                <img src="{{ asset('frontend/assets/icons/share.svg') }}" alt="Share">
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="offcanvas offcanvas-end" id="dayItemModal" tabindex="-1">
        <div class="modal-header">
            <h5 class="modal-title" id="dayItemModalTitle"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body side-drawer__booking-body">
            <div id="dayItemList" class="row g-3"></div>
        </div>
        <div class="offcanvas-footer border-top text-end p-3">
            <button id="saveDayItems" class="btn btn-outline-secondary rounded-pill"
                data-bs-dismiss="offcanvas">{{ __('package.save') }}</button>
        </div>

    </div>


    @include('frontend.packages.partials.gallery-modal-content')

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {

                let activeSlot = null; // stable container
                let activeWrapper = null; // replaceable wrapper
                let selectedClone = null;

                /* =====================================================
                   OPEN EDIT MODAL
                ===================================================== */
                document.addEventListener('click', e => {

                    const btn = e.target.closest('.editDayItemsBtn');
                    if (!btn) return;

                    activeSlot = btn.closest('.day-item-slot');
                    if (!activeSlot) return;

                    activeWrapper = activeSlot.querySelector('.day-item-wrapper');
                    if (!activeWrapper) return;

                    const dayId = activeSlot.dataset.dayId;
                    const type = activeSlot.dataset.type;
                    const index = activeSlot.dataset.index;
                    const itemId = activeWrapper.dataset.itemId;

                    const list = document.getElementById('dayItemList');
                    list.innerHTML = '';
                    selectedClone = null;

                    /* ================= CURRENT ITEM ================= */
                    const currentWrapper = activeWrapper.cloneNode(true);
                    currentWrapper.dataset.index = index;

                    // ❌ remove price from main clone (safety)
                    currentWrapper.querySelectorAll('.extra-price').forEach(p => p.remove());
                    currentWrapper.querySelectorAll('input[name="extra_price"]').forEach(i => i.remove());

                    const currentCard = document.createElement('div');
                    currentCard.className = 'selectable-card-wrapper active';
                    currentCard.appendChild(currentWrapper);

                    selectedClone = currentWrapper.cloneNode(true);

                    currentCard.onclick = () => {
                        document.querySelectorAll('.selectable-card-wrapper')
                            .forEach(c => c.classList.remove('active'));
                        currentCard.classList.add('active');
                        selectedClone = currentWrapper.cloneNode(true);
                    };

                    list.appendChild(currentCard);

                    /* ================= OPTIONS ================= */
                    fetch(`/package-day-option/${dayId}/${type}`)
                        .then(r => r.json())
                        .then(res => {

                            res.data.forEach(option => {

                                const model = option[type];
                                if (!model || model.id == itemId) return;

                                const wrapper = activeWrapper.cloneNode(true);
                                wrapper.dataset.itemId = model.id;
                                wrapper.dataset.index = index;

                                /* image */
                                const img = wrapper.querySelector('img');
                                if (img && model.thumb?.image_path) {
                                    img.src = `/storage/${model.thumb.image_path}`;
                                }

                                /* title */
                                const title = wrapper.querySelector('.fw-600');
                                if (title) {
                                    title.innerText =
                                        model.translation?.name ||
                                        model.translation?.title || '';
                                }

                                /* ================= EXTRA PRICE (POPUP ONLY) ================= */
                                wrapper.querySelectorAll('.extra-price').forEach(p => p.remove());
                                wrapper.querySelectorAll('input[name="extra_price"]').forEach(i => i
                                    .remove());

                                const extraPrice = parseFloat(option.extra_price || 0);

                                if (extraPrice > 0) {

                                    /* visible price (popup only) */
                                    const priceEl = document.createElement('div');
                                    priceEl.className = 'extra-price text-success fw-600 mt-1';
                                    priceEl.innerText = `+ ${extraPrice}`;
                                    title.after(priceEl);

                                    /* hidden input (for calculation later) */
                                    const hiddenInput = document.createElement('input');
                                    hiddenInput.type = 'hidden';
                                    hiddenInput.name = 'extra_price';
                                    hiddenInput.value = extraPrice;
                                    wrapper.appendChild(hiddenInput);
                                }

                                const card = document.createElement('div');
                                card.className = 'col-md-12 selectable-card-wrapper';
                                card.appendChild(wrapper);

                                card.onclick = () => {
                                    document.querySelectorAll('.selectable-card-wrapper')
                                        .forEach(c => c.classList.remove('active'));
                                    card.classList.add('active');
                                    selectedClone = wrapper.cloneNode(true);
                                };

                                list.appendChild(card);
                            });

                            // new bootstrap.Modal(
                            //     document.getElementById('dayItemModal')
                            // ).show();

                            new bootstrap.Offcanvas(
                                document.getElementById('dayItemModal')
                            ).show();
                        });
                });

                /* =====================================================
                   SAVE SELECTION
                ===================================================== */
                document.getElementById('saveDayItems').onclick = () => {

                    if (!activeSlot || !selectedClone) return;

                    const dayId = activeSlot.dataset.dayId;
                    const type = activeSlot.dataset.type;
                    const index = activeSlot.dataset.index;
                    const itemId = selectedClone.dataset.itemId;

                    /* 🔒 lock index */
                    selectedClone.dataset.index = index;

                    /* ❌ REMOVE price text from MAIN list */
                    selectedClone.querySelectorAll('.extra-price').forEach(p => p.remove());

                    /* replace wrapper only */
                    const oldWrapper = activeSlot.querySelector('.day-item-wrapper');
                    if (oldWrapper) oldWrapper.remove();

                    activeSlot.prepend(selectedClone);

                    /* update edit button */
                    const editBtn = activeSlot.querySelector('.editDayItemsBtn');
                    if (editBtn) editBtn.dataset.itemId = itemId;

                    /* SAVE TO SESSION */
                    fetch('/save-package-day-item-session', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            package_id: {{ $package->id }},
                            day_id: dayId,
                            type: type,
                            index: index,
                            item_id: itemId
                        })
                    });

                    let totalExtra = 0;

                    document.querySelectorAll(
                        '.day-item-slot > .day-item-wrapper:first-child'
                    ).forEach(wrapper => {

                        const input = wrapper.querySelector('input[name="extra_price"]');
                        if (!input) return;

                        const value = parseFloat(input.value || 0);

                        // 🔒 only count if actually extra
                        if (value > 0) {
                            totalExtra += value;
                        }
                    });


                    console.log('Total Extra Price from Day Items:', totalExtra);

                    window.PRICE_STATE.extras.dayItems = totalExtra;

                    updatePricing();


                    bootstrap.Offcanvas.getInstance(
                        document.getElementById('dayItemModal')
                    ).hide();
                };

                syncDayItemExtrasFromDOM();
                updatePricing();
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const dropdownEl = document.querySelector('.pkg-fil-bar__input-wrapper.dropdown');

                dropdownEl.addEventListener('hidden.bs.dropdown', function() {

                    // 🔥 DROPDOWN CLOSED
                    // alert('close time');

                    storeTravellerSession();
                });

            });
        </script>

        <script>
            document.addEventListener('click', function(e) {
                if (e.target.closest('.travellers-dropdown')) {

                    e.stopPropagation();
                }
            });
        </script>

        <script>
            document.addEventListener('click', e => {
                const chip = e.target.closest('.traveller-chip');
                if (!chip) return;

                chip.closest('.travellers-dropdown')
                    .querySelectorAll('.traveller-chip')
                    .forEach(c => c.classList.remove('active'));



                chip.classList.add('active');



            });
        </script>

        <script>
            function storeTravellerSession() {
                console.log('testing');

                fetch('/store-traveller-session', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        adults: document.getElementById('adultCount')?.innerText ?? 0,
                        children: document.getElementById('childCount')?.innerText ?? 0,
                        date: document.getElementById('startDateInput')?.value ?? null,
                        filter_package_unique_id: '{{ $package->id }}'
                    })
                });
            }
        </script>

        <script>
            function updatePricing() {
                // alert('Updating pricing...');
                /* ================= CONFIG & STATE ================= */
                const pkg = window.PACKAGE;
                const state = window.PRICE_STATE;

                const adults = state.persons.adults;
                const children = state.persons.children;

                /* ================= BASE PRICE ================= */
                const basePrice = pkg.originalPrice;

                /* ================= EXTRA ADULT ================= */
                const extraAdults =
                    Math.max(0, adults - pkg.basePersons);

                let extraAdultPerPrice = 0;

                pkg.extraAdultRules.forEach(rule => {
                    if (extraAdults >= rule.person_number) {
                        extraAdultPerPrice = rule.price;
                    }
                });

                const extraAdultTotal =
                    extraAdults * extraAdultPerPrice;

                /* ================= CHILD PRICE ================= */
                let childPerPrice = 0;
                let childTotal = 0;

                if (children && pkg.childRules.length) {

                    const rule = pkg.childRules[0];

                    childPerPrice =
                        rule.type === 'fixed' ?
                        rule.value :
                        (pkg.pricePerPerson * rule.value) / 100;

                    childTotal = childPerPrice * children;
                }

                /* ================= DAY ITEM EXTRA ================= */
                const dayItemExtra =
                    parseFloat(state.extras.dayItems || 0);

                /* ================= FINAL TOTAL ================= */
                const finalTotal =
                    basePrice +
                    extraAdultTotal +
                    childTotal +
                    dayItemExtra;

                /* ================= UPDATE RIGHT PRICE UI ================= */
                const priceEl = document.getElementById('liveTotalPrice');
                if (priceEl) {
                    priceEl.innerText = finalTotal.toFixed(2);
                }

                /* ================= UPDATE HIDDEN INPUTS ================= */
                document.getElementById('adultsInput').value = adults;
                document.getElementById('childrenInput').value = children;
                document.getElementById('totalPersonsInput').value =
                    adults + children;

                document.getElementById('basePriceInput').value = basePrice;

                document.getElementById('extraAdultsInput').value = extraAdults;
                document.getElementById('extraAdultPerPriceInput').value =
                    extraAdultPerPrice;
                document.getElementById('extraAdultTotalPriceInput').value =
                    extraAdultTotal;

                document.getElementById('childPerPriceInput').value =
                    childPerPrice;
                document.getElementById('childTotalPriceInput').value =
                    childTotal;

                document.getElementById('finalTotalInput').value =
                    finalTotal;

                /* ================= HIDDEN INPUTS ================= */
                document.getElementById('dayItemsExtraInput').value =
                    dayItemExtra;

                /* ================= DEBUG (OPTIONAL) ================= */
                console.log({
                    basePrice,
                    extraAdultTotal,
                    childTotal,
                    dayItemExtra,
                    finalTotal
                });
            }
        </script>

        <script>
            function syncDayItemExtrasFromDOM() {
                let totalExtra = 0;

                document.querySelectorAll(
                    '.day-item-slot > .day-item-wrapper:first-child input[name="extra_price"]'
                ).forEach(input => {
                    const value = parseFloat(input.value || 0);
                    if (value > 0) {
                        totalExtra += value;
                    }
                });

                window.PRICE_STATE.extras.dayItems = totalExtra;
            }
        </script>
    @endpush
@endsection
