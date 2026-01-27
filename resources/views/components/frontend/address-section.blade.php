@props(['addresses' => collect()])

{{-- ================= ADDRESS SECTION ================= --}}
<div class="tab-pane fade show active user-profile__box" id="user-addresses" role="tabpanel">

    <div class="user-profile__details-content">

        <div
            class="user-profile__details-header white-bg p-3 d-flex justify-content-between align-items-center flex-sm-row flex-column gap-2">
            <div>
                <p class="p-large fw-600 mb-1">Manage Address</p>
                <p class="text-light2">
                    Manage your saved addresses — view existing ones, add new, or delete them anytime.
                </p>
            </div>

            <button class="btn btn-primary rounded-pill gap-2 ps-2 pe-3 me-auto" id="addNewAddressBtn"
                data-bs-toggle="modal" data-bs-target="#addressModal">
                <i class="fa-solid fa-plus"></i>
                Add New Address
            </button>
        </div>

        <div class="white-bg p-3">
            <div class="table-responsive">
                <table class="table align-middle mb-0 p-small">
                    <thead class="bg-light">
                        <tr class="text-light2">
                            <th>#</th>
                            <th>Address</th>
                            <th>Full Address</th>
                            <th>Last Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="addressTableBody">
                        @forelse($addresses as $i => $address)
                            <tr id="addressRow{{ $address->id }}">
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $address->title }}</td>
                                <td class="text-light2">{{ $address->full_address }}</td>
                                <td class="text-nowrap">
                                    {{ $address->updated_at->format('Y-m-d H:i') }}
                                </td>
                                <td class="text-nowrap">

                                    {{-- VIEW --}}
                                    <a href="javascript:void(0)" class="text-secondary me-1 viewAddressBtn"
                                        data-address="{{ $address->full_address }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    {{-- EDIT --}}
                                    <a href="javascript:void(0)" class="text-secondary me-1 editAddressBtn"
                                        data-id="{{ $address->id }}" data-title="{{ $address->title }}"
                                        data-city="{{ $address->city }}" data-pincode="{{ $address->pincode }}"
                                        data-address="{{ $address->full_address }}">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>

                                    {{-- DELETE --}}
                                    <a href="javascript:void(0)" class="text-secondary deleteAddressBtn"
                                        data-id="{{ $address->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    No address added yet
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

{{-- ================= ADDRESS MODAL ================= --}}
<div class="modal fade" id="addressModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <p class="modal-title fw-600" id="addressModalTitle">Add Address</p>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="addressForm">
                    @csrf
                    <input type="hidden" name="address_id" id="address_id">

                    <div class="mb-3">
                        <label class="form-label">Address Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">City</label>
                        <input type="text" name="city" id="city" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pin Code</label>
                        <input type="text" name="pincode" id="pincode" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Full Address</label>
                        <textarea name="address" id="address" rows="3" class="form-control"></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button class="btn btn-primary rounded-pill" id="saveAddressBtn">
                    Save
                </button>
            </div>

        </div>
    </div>
</div>



<!-- ================= CLIENT SIDE JS ================= -->
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const modalEl = document.getElementById('addressModal');
        const modal = new bootstrap.Modal(modalEl);

        // RESET FORM FOR ADD
        document.getElementById('addNewAddressBtn').addEventListener('click', function() {
            document.getElementById('addressForm').reset();
            document.getElementById('address_id').value = '';
            document.getElementById('addressModalTitle').innerText = 'Add Address';
        });

        // EDIT ADDRESS
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.editAddressBtn');
            if (!btn) return;

            document.getElementById('addressModalTitle').innerText = 'Edit Address';
            document.getElementById('address_id').value = btn.dataset.id;
            document.getElementById('title').value = btn.dataset.title;
            document.getElementById('city').value = btn.dataset.city;
            document.getElementById('pincode').value = btn.dataset.pincode;
            document.getElementById('address').value = btn.dataset.address;

            modal.show();
        });

        // VIEW ADDRESS
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.viewAddressBtn');
            if (!btn) return;

            alert(btn.dataset.address);
        });

        // SAVE (ADD / UPDATE)
        document.getElementById('saveAddressBtn').addEventListener('click', function() {

            const formData = new FormData(document.getElementById('addressForm'));

            fetch("{{ route('user.address.store') }}", {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(res => {
                    if (res.status === 'success') {
                        location.reload(); // safest (no UI bug)
                    }
                });
        });

        // DELETE ADDRESS
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.deleteAddressBtn');
            if (!btn) return;

            if (!confirm('Delete this address?')) return;

            const id = btn.dataset.id;

            fetch(`/user/addresses/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(() => {
                document.getElementById('addressRow' + id)?.remove();
            });
        });

    });
</script>
