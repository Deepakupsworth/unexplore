<script>

    /* ================= COUNTERS ================= */
let extraPersonIndex =
    document.querySelectorAll('#extraPersonBox .price-row').length;

let childPriceIndex =
    document.querySelectorAll('#childPriceBox .price-row').length;

/* ================= ENABLE EDIT ================= */
window.enablePricingEdit = function () {
    document.querySelectorAll('.editable').forEach(el => {
        el.disabled = false;
    });

    document.getElementById('savePricingBtn').classList.remove('hidden');
};

/* ================= ADD EXTRA PERSON ================= */
window.addExtraPersonRow = function () {
    const box = document.getElementById('extraPersonBox');
    if (!box) return;

    box.insertAdjacentHTML('beforeend', `
        <div class="grid grid-cols-3 gap-3 mb-2 price-row">

            <div>
                <label class="form-label">Extra Person Count</label>
                <input class="form-control editable"
                       name="extra_persons[${extraPersonIndex}][person_number]"
                       placeholder="e.g. 1">
            </div>

            <div>
                <label class="form-label">Additional Price</label>
                <input class="form-control editable"
                       name="extra_persons[${extraPersonIndex}][additional_price]"
                       placeholder="e.g. 500">
            </div>

            <div class="flex items-end">
                <button type="button"
                        class="btn btn-sm btn-outline-danger remove-row w-full">
                    Remove
                </button>
            </div>

        </div>
    `);

    extraPersonIndex++;
};

/* ================= ADD CHILD PRICE (CARD) ================= */
window.addChildPriceRow = function () {
    const box = document.getElementById('childPriceBox');
    if (!box) return;

    box.insertAdjacentHTML('beforeend', `
        <div class="border rounded-xl p-4 bg-slate-50 price-row">

            <div class="flex justify-between items-center mb-3">
                <h5 class="font-semibold text-slate-700">
                    Child Price #${childPriceIndex + 1}
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
                           name="child_prices[${childPriceIndex}][min_age]"
                           placeholder="e.g. 1">
                </div>

                <div>
                    <label class="form-label">Max Age</label>
                    <input class="form-control editable"
                           name="child_prices[${childPriceIndex}][max_age]"
                           placeholder="e.g. 5">
                </div>

                <div>
                    <label class="form-label">Price Type</label>
                    <select class="form-control editable"
                            name="child_prices[${childPriceIndex}][price_type]">
                        <option value="fixed">Fixed Amount</option>
                        <option value="percentage">Percentage (%)</option>
                    </select>
                </div>

                <div>
                    <label class="form-label">Price Value</label>
                    <input class="form-control editable"
                           name="child_prices[${childPriceIndex}][price_value]"
                           placeholder="e.g. 500">
                </div>

            </div>
        </div>
    `);

    childPriceIndex++;
};

/* ================= REMOVE ROW ================= */
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-row')) {
        e.target.closest('.price-row').remove();
    }
});

</script>
