<div class="modal fade" id="travellerModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <p class="modal-title fw-600">Add Traveller</p>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="travellerForm">
                    @csrf
                    <input type="hidden" name="_method" value="POST">

                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <label class="form-label">First Name</label>
                            <input class="form-control" name="first_name" required>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <label class="form-label">Last Name</label>
                            <input class="form-control" name="last_name" required>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <label class="form-label">DOB</label>
                            <input  min="{{ now()->subYears(100)->format('Y-m-d') }}"
                            max="{{ now()->format('Y-m-d') }}" type="date" class="form-control" name="dob">
                        </div>
                        <div class="col-sm-6 mb-4">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-select">
                                <option value="adult">Adult</option>
                                <option value="child">Child</option>
                            </select>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select">
                                <option value="">Select</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label class="form-label">Country</label>
                            <select name="country" class="form-select" required>
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
                <button class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button class="btn btn-primary rounded-pill" onclick="saveTraveller()">
                    Save
                </button>
            </div>

        </div>
    </div>
</div>
