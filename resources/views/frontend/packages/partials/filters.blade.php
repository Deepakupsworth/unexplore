

    <div class="package-listing__filter-section">

        {{-- HEADER --}}
        <div class="package-listing__filter-section-header">
            <h6>{{ __('packages.filters.title') }}</h6>
        </div>

        <div class="package-listing__filter-items">

            {{-- 🔍 SEARCH --}}
            <div class="package-listing__filter-item">
                <p class="p-large package-listing__filter-title">
                    {{ __('packages.filters.search') }}
                </p>

                <div class="input-group mb-3 package-listing__search-bar">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="{{ __('packages.filters.search_placeholder') }}"
                    >
                    <button class="btn" type="button">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>

            <hr>

            {{-- ✈️ FLIGHTS --}}
            {{-- <div class="package-listing__filter-item accordion">
                <p class="accordion-header p-large package-listing__filter-title">
                    {{ __('packages.filters.flights') }}
                </p>

                <div class="package-listing__filter-btn-group">
                    <label class="btn btn-light">
                        <input type="radio" name="flight" value="with" @checked(request('flight') === 'with') hidden>
                        {{ __('packages.filters.with_flight') }}
                    </label>

                    <label class="btn btn-light">
                        <input type="radio" name="flight" value="without" @checked(request('flight') === 'without') hidden>
                        {{ __('packages.filters.without_flight') }}
                    </label>
                </div>
            </div>

            <hr> --}}

            {{-- 💰 BUDGET --}}
            <div class="package-listing__filter-item accordion">
                <p class="accordion-header p-large package-listing__filter-title">
                    {{ __('packages.filters.budget_title') }}
                </p>

                @php
                    $budgets = [
                        '0-80000' => __('packages.filters.budget.under_80k'),
                        '80000-90000' => __('packages.filters.budget.80_90k'),
                        '90000-100000' => __('packages.filters.budget.90_100k'),
                        '100000-110000' => __('packages.filters.budget.100_110k'),
                    ];
                @endphp

                <div class="package-listing__budget-filter-list">
                    @foreach ($budgets as $value => $label)
                        <div class="package-listing__budget-filter-option">
                            <label>
                                <input
                                    type="checkbox"
                                    name="budget[]"
                                    value="{{ $value }}"
                                    @checked(in_array($value, request('budget', [])))
                                >
                                <span class="package-listing__budget-custom-checkbox"></span>
                                <span class="option-text">{!! $label !!}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <hr>

            {{-- ⭐ HOTEL CATEGORY --}}
            <div class="package-listing__filter-item accordion">
                <p class="accordion-header p-large package-listing__filter-title">
                    {{ __('packages.filters.hotel_category') }}
                </p>

                <div class="package-listing__budget-filter-list">
                    @foreach ([3, 4, 5] as $star)
                        <div class="package-listing__budget-filter-option">
                            <label>
                                <input
                                    type="checkbox"
                                    name="rating[]"
                                    value="{{ $star }}"
                                    @checked(in_array($star, request('rating', [])))
                                >
                                <span class="package-listing__budget-custom-checkbox"></span>
                                <span class="option-text">
                                    {{ __('packages.filters.stars_above', ['count' => $star]) }}
                                </span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <hr>

            {{-- 🌍 CITIES --}}
            <div class="package-listing__filter-item accordion">
                <p class="accordion-header p-large package-listing__filter-title">
                    {{ __('packages.filters.cities') }}
                </p>

                <div class="package-listing__budget-filter-list">
                    @foreach ($cities as $city)
                        <div class="package-listing__budget-filter-option">
                            <label>
                                <input
                                    type="checkbox"
                                    name="cities[]"
                                    value="{{ $city->id }}"
                                    @checked(in_array($city->id, request('cities', [])))
                                >
                                <span class="package-listing__budget-custom-checkbox"></span>
                                <span class="option-text">{{ $city->slug }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <hr>

            <div class="package-listing__filter-item accordion" id="packagesAccordion">
                <div class="accordion-item">
                    <p class="accordion-header p-large package-listing__filter-title">
                        <button
                            class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapsePackages"
                            aria-expanded="true"
                            aria-controls="collapsePackages"
                        >
                            {{ __('packages.filters.package_type') }}
                        </button>
                    </p>

                    <div
                        id="collapsePackages"
                        class="accordion-collapse collapse show"
                        data-bs-parent="#packagesAccordion"
                    >
                        <div class="accordion-body">
                            <div class="package-listing__budget-filter-list">

                                @foreach ($packageTypes as $type => $count)
                                    @php
                                        $isChecked = in_array($type, request('package_type', []));
                                    @endphp

                                    <div
                                        class="package-listing__budget-filter-option package-listing__budget-button
                                        {{ $isChecked ? 'active' : '' }}"
                                    >
                                        <label>
                                            <input
                                                type="checkbox"
                                                name="package_type[]"
                                                value="{{ $type }}"
                                                {{ $isChecked ? 'checked' : '' }}
                                            />
                                            <span class="option-text">
                                                {{ $type === 'customized'
                                                    ? __('packages.filters.customizable')
                                                    : ucfirst($type) }}
                                            </span>
                                        </label>

                                        <span class="package-listing__budget-count">
                                            ({{ $count }})
                                        </span>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

