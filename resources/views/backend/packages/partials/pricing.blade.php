{{-- ================= PRICING ================= --}}
<div class="tab-pane">

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
            <input type="number"
                   name="pricing[original_price]"
                   value="{{ old('pricing.original_price', $price->original_price ?? '') }}"
                   class="form-control">
        </div>

        <div>
            <label class="form-label">Discount Price</label>
            <input type="number"
                   name="pricing[discount_price]"
                   value="{{ old('pricing.discount_price', $price->discount_price ?? '') }}"
                   class="form-control">
        </div>

        <div>
            <label class="form-label">Per Person Price</label>
            <input type="number"
                   name="pricing[per_person_price]"
                   value="{{ old('pricing.per_person_price', $price->per_person_price ?? '') }}"
                   class="form-control">
        </div>
    </div>

    {{-- EXTRA PERSON --}}
    <h6 class="section-title">Extra Person Charges</h6>

    @foreach($extraPersons as $i => $row)
        <div class="grid grid-cols-2 gap-4 mb-4">
            <input type="number"
                   name="pricing[extra_persons][{{ $i }}][person_number]"
                   value="{{ $row['person_number'] ?? '' }}"
                   class="form-control"
                   placeholder="Person count">

            <input type="number"
                   name="pricing[extra_persons][{{ $i }}][additional_price]"
                   value="{{ $row['additional_price'] ?? '' }}"
                   class="form-control"
                   placeholder="Additional price">
        </div>
    @endforeach

    {{-- CHILD PRICING --}}
    <h6 class="section-title mt-6">Child Pricing</h6>

    @foreach($childPrices as $i => $row)
        <div class="grid grid-cols-4 gap-4 mb-4">
            <input type="number"
                   name="pricing[child_prices][{{ $i }}][min_age]"
                   value="{{ $row['min_age'] ?? '' }}"
                   class="form-control"
                   placeholder="Min Age">

            <input type="number"
                   name="pricing[child_prices][{{ $i }}][max_age]"
                   value="{{ $row['max_age'] ?? '' }}"
                   class="form-control"
                   placeholder="Max Age">

            <select name="pricing[child_prices][{{ $i }}][price_type]" class="form-control">
                <option value="fixed" {{ ($row['price_type'] ?? '') == 'fixed' ? 'selected' : '' }}>
                    Fixed
                </option>
                <option value="percentage" {{ ($row['price_type'] ?? '') == 'percentage' ? 'selected' : '' }}>
                    Percentage
                </option>
            </select>

            <input type="number"
                   name="pricing[child_prices][{{ $i }}][price_value]"
                   value="{{ $row['price_value'] ?? '' }}"
                   class="form-control"
                   placeholder="Value">
        </div>
    @endforeach

</div>
