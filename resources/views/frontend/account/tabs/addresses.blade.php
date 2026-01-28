<div class="user-profile__details-content">

    {{-- HEADER --}}
    <div
        class="user-profile__details-header white-bg p-3 d-flex justify-content-between align-items-center flex-sm-row flex-column gap-2">
        <div>
            <p class="p-large fw-600 mb-1">Manage Address</p>
            <p class="text-light2">
                Manage your saved addresses — view, add, edit or delete anytime.
            </p>
        </div>

        <button class="btn btn-primary rounded-pill gap-2 ps-2 pe-3"
                data-bs-toggle="modal"
                data-bs-target="#addAddressModal">
            <i class="fa-solid fa-plus"></i>
            Add New Address
        </button>
    </div>

    {{-- TABLE --}}
    <div class="white-bg p-3 mt-3">
        <div class="table-responsive">
            <table class="table align-middle mb-0 p-small">
                <thead class="bg-light">
                <tr class="text-light2">
                    <th>#</th>
                    <th>Address Title</th>
                    <th>Full Address</th>
                    <th>Last Updated</th>
                    <th class="text-end">Action</th>
                </tr>
                </thead>

                <tbody>
                @forelse($addresses as $index => $address)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <td class="fw-500">
                            {{ $address->address_title }}
                        </td>

                        <td class="text-light2">
                            {{ $address->full_address }},
                            {{ $address->city }} - {{ $address->pin_code }}
                        </td>

                        <td class="text-light2 text-nowrap">
                            {{ $address->updated_at->format('Y-m-d H:i') }}
                        </td>

                        <td class="text-end text-nowrap">
                            <a href="javascript:void(0)"
                               class="text-secondary me-2"
                               onclick="viewAddress({{ $address->id }})">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="javascript:void(0)"
                               class="text-secondary me-2"
                               onclick="editAddress({{ $address->id }})">
                                <i class="fa-solid fa-pencil"></i>
                            </a>

                            <a href="javascript:void(0)"
                               class="text-danger"
                               onclick="deleteAddress({{ $address->id }})">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-light2 py-4">
                            No addresses found.
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>
