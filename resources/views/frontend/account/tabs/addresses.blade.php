<div class="user-profile__details-content">

    {{-- HEADER --}}
    <div
        class="user-profile__details-header white-bg p-3 d-flex justify-content-between align-items-center flex-sm-row flex-column gap-2">
        <div>
            <p class="p-large fw-600 mb-1">{{ __('account.manage_address') }}</p>
            <p class="text-light2">
                {{ __('account.manage_address_desc') }}
            </p>
        </div>

        <button class="btn btn-primary rounded-pill gap-2 ps-2 pe-3"
                data-bs-toggle="modal"
                data-bs-target="#addAddressModal">
            <i class="fa-solid fa-plus"></i>
            {{ __('account.add_new_address') }}
        </button>
    </div>

    {{-- TABLE --}}
    <div class="white-bg p-3 mt-3">
        <div class="table-responsive">
            <table class="table align-middle mb-0 p-small">
                <thead class="bg-light">
                <tr class="text-light2">
                    <th>#</th>
                    <th>{{ __('account.address_title') }}</th>
                    <th>{{ __('account.full_address') }}</th>
                    <th>{{ __('account.last_updated') }}</th>
                    <th class="text-end">{{ __('account.action') }}</th>
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
                            {{ __('account.no_addresses_found') }}
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>
