<div class="modal fade" id="travellerModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <p class="modal-title fw-600">
                    {{ __('traveller.add_title') }}
                </p>
                <button class="btn-close" data-bs-dismiss="modal"
                        aria-label="{{ __('common.close') }}"></button>
            </div>

            <div class="modal-body">
                <form id="travellerForm">
                    @csrf
                    <input type="hidden" name="_method" value="POST">

                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <label class="form-label">
                                {{ __('traveller.first_name') }}
                            </label>
                            <input class="form-control" name="first_name" required>
                        </div>

                        <div class="col-sm-6 mb-4">
                            <label class="form-label">
                                {{ __('traveller.last_name') }}
                            </label>
                            <input class="form-control" name="last_name" required>
                        </div>

                        <div class="col-sm-6 mb-4">
                            <label class="form-label">
                                {{ __('traveller.dob') }}
                            </label>
                            <input
                                min="{{ now()->subYears(100)->format('Y-m-d') }}"
                                max="{{ now()->format('Y-m-d') }}"
                                type="date"
                                class="form-control"
                                name="dob">
                        </div>

                        <div class="col-sm-6 mb-4">
                            <label class="form-label">
                                {{ __('traveller.type') }}
                            </label>
                            <select name="type" class="form-select">
                                <option value="adult">{{ __('traveller.type_adult') }}</option>
                                <option value="child">{{ __('traveller.type_child') }}</option>
                            </select>
                        </div>

                        <div class="col-sm-6 mb-4">
                            <label class="form-label">
                                {{ __('traveller.gender') }}
                            </label>
                            <select name="gender" class="form-select">
                                <option value="">{{ __('common.select') }}</option>
                                <option value="male">{{ __('traveller.gender_male') }}</option>
                                <option value="female">{{ __('traveller.gender_female') }}</option>
                            </select>
                        </div>

                        <div class="col-sm-6 mb-2">
                            <label class="form-label">
                                {{ __('traveller.country') }}
                            </label>
                            <select name="country" class="form-select travellerCountry" required>
                                <option value="">
                                    {{ __('checkout.select_country') }}
                                </option>

                                @foreach (country_list() as $country)
                                    <option value="{{ $country->code }}">
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-outline-secondary rounded-pill"
                        data-bs-dismiss="modal">
                    {{ __('common.cancel') }}
                </button>
                <button class="btn btn-primary rounded-pill"
                        onclick="saveTraveller()">
                    {{ __('common.save') }}
                </button>
            </div>

        </div>
    </div>
</div>
