<script>
    /* ================= GLOBAL DATA FROM CONTROLLER ================= */
    window.usedDayItems = @json($dayItems ?? []);
    window.usedOptions  = @json($usedOptions ?? []);

    /* ================= MAIN SCRIPT ================= */
    document.addEventListener('DOMContentLoaded', () => {

        const form       = document.getElementById('optionForm');
        const typeSelect = form.querySelector('[name="item_type"]');
        const itemSelect = form.querySelector('[name="item_id"]');
        const typeInput  = form.querySelector('input[name="item_type"]');

        const itemsMap = {
            hotel: @json($hotels),
            event: @json($events),
            todo:  @json($todos),
        };

        let currentDayId = null;

        /* ================= OPEN ADD OPTION MODAL ================= */
        document.querySelectorAll('.add-option-btn').forEach(btn => {
            btn.addEventListener('click', () => {

                form.reset();

                currentDayId = btn.dataset.day;
                // const type   = btn.dataset.type;
                const type   = btn.dataset.type;

                form.package_day_id.value = currentDayId;
                typeSelect.value = type;
                typeInput.value = type;

                populateItems(type);
            });
        });

        /* ================= TYPE CHANGE ================= */
        typeSelect.addEventListener('change', () => {
            populateItems(typeSelect.value);
        });

        /* ================= POPULATE ITEMS (FINAL LOGIC) ================= */
        function populateItems(type) {

            itemSelect.innerHTML = '<option value="">Select Item</option>';

            if (!type || !currentDayId) return;

            const key = `${currentDayId}_${type}`;

            const usedMainItems =
                (window.usedDayItems[key] || []).map(i => parseInt(i.item_id));

            const usedOptionItems =
                (window.usedOptions[key] || []).map(o => parseInt(o.item_id));

            (itemsMap[type] || []).forEach(item => {

                // ❌ already added as main day item
                if (usedMainItems.includes(item.id)) return;

                // ❌ already added as option
                if (usedOptionItems.includes(item.id)) return;

                itemSelect.insertAdjacentHTML(
                    'beforeend',
                    `<option value="${item.id}">${item.name}</option>`
                );
            });

            if (itemSelect.options.length === 1) {
                itemSelect.innerHTML =
                    '<option disabled>No more items available</option>';
            }
        }

        /* ================= SUBMIT ADD OPTION ================= */
        form.addEventListener('submit', async e => {
            e.preventDefault();

            const res = await fetch(
                "{{ route('admin.packages.package-day-options') }}",
                {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json'
                    },
                    body: new FormData(form)
                }
            );

            if (res.ok) {
                location.reload(); // safest
            } else {
                const data = await res.json();
                alert(data.message || 'Failed to add option');
            }
        });

    });

    /* ================= REMOVE OPTION ================= */
    document.addEventListener('click', async function (e) {

        const btn = e.target.closest('.remove-option-btn');
        if (!btn) return;

        if (!confirm('Are you sure you want to remove this option?')) return;

        const optionId = btn.dataset.id;

        const res = await fetch(
            `/admin/packages/package-day-options/${optionId}`,
            {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            }
        );

        if (res.ok) {
            location.reload();
        } else {
            alert('Failed to remove option');
        }
    });
    </script>
