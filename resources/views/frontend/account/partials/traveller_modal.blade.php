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
                        <div class="col-sm-6 mb-2">
                            <label>First Name</label>
                            <input class="form-control" name="first_name" required>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label>Last Name</label>
                            <input class="form-control" name="last_name" required>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label>DOB</label>
                            <input type="date" class="form-control" name="dob">
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label>Type</label>
                            <select name="type" class="form-select">
                                <option value="adult">Adult</option>
                                <option value="child">Child</option>
                            </select>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label>Gender</label>
                            <select name="gender" class="form-select">
                                <option value="">Select</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label>Country</label>
                            <input class="form-control" name="country">
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
