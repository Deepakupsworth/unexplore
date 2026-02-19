<div class="user-profile__details-content">

    <div class="user-profile__details-header white-bg p-3 d-flex justify-content-between">
        <div>
            <p class="p-large fw-600 mb-1">{{ __('account.travellers') }} </p>
            <p class="text-light2">{{ __('account.travellers_desc') }}</p>
        </div>

        <div>
            <button class="btn btn-primary rounded-pill gap-2 ps-2 pe-3" data-bs-toggle="modal" data-bs-target="#travellerModal">
                <i class="fa-solid fa-plus"></i> {{ __('account.add_traveller') }}
            </button>
        </div>
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
{{-- @dd($t) --}}
                        <td>
                            <span class="badge {{ $isAdult ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ $isAdult ? __('account.adult') : __('account.child') }}
                            </span>
                        </td>
                        <td>{{ \App\Helpers\DateHelper::format($t->dob, 'd M Y') }}</td>
                        <td>
                            @php $countryName = country_name($t->country); @endphp
                            {{ $countryName ?: '-' }}
                        </td>
                        <td>
                            <a href="javascript:void(0)" class="text-secondary me-1 text-decoration-none"
                                onclick="viewTraveller({{ $t->id }})">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="javascript:void(0)" onclick="editTraveller({{ $t->id }})" class="text-decoration-none">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            <a href="javascript:void(0)" class="text-danger ms-2 text-decoration-none"
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
