<div class="user-profile__details-content">

    <div class="user-profile__details-header white-bg p-3 d-flex justify-content-between">
        <div>
            <p class="p-large fw-600 mb-1">{{ __('account.travellers') }} </p>
            <p class="text-light2">{{ __('account.travellers_desc') }}</p>
        </div>

        <button class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#travellerModal">
            <i class="fa-solid fa-plus"></i> {{ __('account.add_traveller') }}
        </button>
    </div>

    <div class="white-bg p-3 mt-3">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('account.name') }}</th>
                    <th>{{ __('account.type') }}</th>
                    <th>{{ __('account.age') }}</th>
                    <th>{{ __('account.country') }}</th>
                    <th>{{ __('account.action') }}</th>
                </tr>
            </thead>
            <tbody id="travellerTable">
                @forelse($travellers as $i => $t)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $t->first_name }} {{ $t->last_name }}</td>

                        @php
                            $isAdult = $t->type === 'adult';
                        @endphp

                        <td>
                            <span class="badge {{ $isAdult ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ $isAdult ? __('account.adult') : __('account.child') }}
                            </span>
                        </td>

                        <td>{{ $t->age }}</td>
                        <td>
                            @php $countryName = country_name($t->country); @endphp
                            {{ $countryName ?: '-' }}
                        </td>
                        <td>
                            <a href="javascript:void(0)" class="text-secondary me-1 text-decoration-none"
                                onclick="viewTraveller({{ $t->id }})">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="javascript:void(0)" onclick="editTraveller({{ $t->id }})">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            <a href="javascript:void(0)" class="text-danger ms-2"
                                onclick="deleteTraveller({{ $t->id }})">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-light2">{{ __('account.no_travellers') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
