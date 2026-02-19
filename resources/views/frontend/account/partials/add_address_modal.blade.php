<div class="modal fade" id="addAddressModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title fw-600">Add New Address</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="addressForm">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Address Title *</label>
                        <input type="text" name="address_title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">City *</label>
                        <input type="text" name="city" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pin Code *</label>
                        <input type="text" name="pin_code" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address *</label>
                        <textarea name="full_address" rows="3" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
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

                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary rounded-pill" onclick="saveAddress()">Save</button>
            </div>

        </div>
    </div>
</div>
