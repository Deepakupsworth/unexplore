<section class="{{ $card }}">
    <h3 class="text-lg font-semibold mb-6 border-b pb-3">
        Pricing
    </h3>

    <form method="POST"
          action="{{ route('admin.packages.pricing.update', $package) }}"
          id="pricingForm">
        @csrf

        {{-- ================= BASE PRICE ================= --}}
        <div class="grid grid-cols-2 gap-4 mb-6">

            <div>
                <label class="form-label">Currency</label>
                <input class="form-control"
                       value="{{ $package->price?->currency }}"
                       readonly>
            </div>

            <div>
                <label class="form-label">Base Price (Per Person)</label>
                <input class="form-control editable"
                       value="{{ $package->price?->per_person_price }}"
                       disabled>
            </div>

            <div>
                <label class="form-label">Discount Price</label>
                <input class="form-control editable"
                       value="{{ $package->price?->discount_price }}"
                       disabled>
            </div>

            <div>
                <label class="form-label">Final Price (Per Person)</label>
                <input class="form-control editable"
                       value="{{ $package->price?->per_person_price }}"
                       disabled>
            </div>
        </div>

        {{-- ================= EXTRA PERSON ================= --}}
        <h4 class="font-semibold mb-3">Extra Person Pricing</h4>

        <div id="extraPersonBox">
            @foreach ($package->priceIncreasePersons as $i => $row)
                <div class="grid grid-cols-3 gap-3 mb-2 price-row"
                     data-id="{{ $row->id }}"
                     data-type="extra">

                    <div>
                        <label class="form-label">Extra Person Count</label>
                        <input class="form-control editable"
                               name="extra_persons[{{ $i }}][person_number]"
                               value="{{ $row->person_number }}"
                               disabled>
                    </div>

                    <div>
                        <label class="form-label">Additional Price</label>
                        <input class="form-control editable"
                               name="extra_persons[{{ $i }}][additional_price]"
                               value="{{ $row->additional_price }}"
                               disabled>
                    </div>

                    <div class="flex items-end">
                        <button type="button"
                                class="btn btn-sm btn-outline-danger remove-row w-full">
                            Remove
                        </button>
                    </div>

                    <input type="hidden"
                           name="extra_persons[{{ $i }}][id]"
                           value="{{ $row->id }}">
                </div>
            @endforeach
        </div>


        <button type="button"
                class="btn btn-sm btn-outline-primary mt-2"
                onclick="addExtraPersonRow()">
            + Add Extra Person
        </button>

        {{-- ================= CHILD PRICE ================= --}}
        <h4 class="font-semibold mt-6 mb-3">Child Pricing</h4>

        <div id="childPriceBox" class="space-y-4">
            @foreach ($package->childPrices as $i => $row)
                <div class="border rounded-xl p-4 bg-slate-50 price-row"
                     data-id="{{ $row->id }}"
                     data-type="child">

                    <div class="flex justify-between items-center mb-3">
                        <h5 class="font-semibold text-slate-700">
                            Child Price #{{ $i + 1 }}
                        </h5>

                        <button type="button"
                                class="btn btn-sm btn-outline-danger remove-row">
                            Remove
                        </button>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                        <div>
                            <label class="form-label">Min Age</label>
                            <input class="form-control editable"
                                   name="child_prices[{{ $i }}][min_age]"
                                   value="{{ $row->min_age }}"
                                   disabled>
                        </div>

                        <div>
                            <label class="form-label">Max Age</label>
                            <input class="form-control editable"
                                   name="child_prices[{{ $i }}][max_age]"
                                   value="{{ $row->max_age }}"
                                   disabled>
                        </div>

                        <div>
                            <label class="form-label">Price Type</label>
                            <select class="form-control editable"
                                    name="child_prices[{{ $i }}][price_type]"
                                    disabled>
                                <option value="fixed" @selected($row->price_type === 'fixed')>
                                    Fixed Amount
                                </option>
                                <option value="percentage" @selected($row->price_type === 'percentage')>
                                    Percentage (%)
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="form-label">Price Value</label>
                            <input class="form-control editable"
                                   name="child_prices[{{ $i }}][price_value]"
                                   value="{{ $row->price_value }}"
                                   disabled>
                        </div>

                    </div>

                    <input type="hidden"
                           name="child_prices[{{ $i }}][id]"
                           value="{{ $row->id }}">
                </div>
            @endforeach
        </div>


        <button type="button"
                class="btn btn-sm btn-outline-primary mt-2"
                onclick="addChildPriceRow()">
            + Add Child Price
        </button>

        {{-- ================= ACTIONS ================= --}}
        <div class="mt-6 flex gap-3">
            {{-- <button type="button"
                    class="btn btn-outline-dark"
                    onclick="enablePricingEdit()">
                Edit Pricing
            </button> --}}

            <button class="btn btn-success hidden"
                    id="savePricingBtn">
                Save Changes
            </button>
        </div>
    </form>
</section>

<script src="{{ asset('js/package-pricing.js') }}"></script>
