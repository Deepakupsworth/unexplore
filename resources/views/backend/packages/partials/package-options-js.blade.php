<script>
    document.addEventListener('DOMContentLoaded', () => {

        const form = document.getElementById('optionForm');
        const typeSelect = form.querySelector('[name="item_type"]');
        const itemSelect = form.querySelector('[name="item_id"]');

        // 🔥 ITEMS FROM CONTROLLER
        const itemsMap = {
            hotel: @json($hotels),
            event: @json($events),
            todo: @json($todos),
        };

        /* SET DAY ID ON OPEN */
        document.querySelectorAll('.add-option-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                form.reset();
                form.package_day_id.value = btn.dataset.day;
                itemSelect.innerHTML = '<option value="">Select Item</option>';
            });
        });

        /* ITEM TYPE CHANGE */
        typeSelect.addEventListener('change', () => {
            const type = typeSelect.value;
            itemSelect.innerHTML = '<option value="">Select Item</option>';

            (itemsMap[type] || []).forEach(item => {
                itemSelect.insertAdjacentHTML(
                    'beforeend',
                    `<option value="${item.id}">${item.name}</option>`
                );
            });
        });

        /* SUBMIT */
        form.addEventListener('submit', async e => {
            e.preventDefault();

            const res = await fetch(
                "{{ route('admin.packages.package-day-options') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json'
                    },
                    body: new FormData(form)
                }
            );

            if (res.ok) {
                location.reload();
            } else {
                alert('Failed to save option');
            }
        });

    });
</script>
