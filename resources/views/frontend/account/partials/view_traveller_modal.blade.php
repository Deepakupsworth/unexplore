<div class="modal fade" id="viewTravellerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <p class="modal-title fw-600 text-black">
                    {{ __('traveller.details_title') }}
                </p>
                <button class="btn-close" data-bs-dismiss="modal"
                        aria-label="{{ __('common.close') }}"></button>
            </div>

            <div class="modal-body p-small">
                <table class="table table-borderless mb-0">
                    <tr>
                        <td class="text-light2">
                            {{ __('traveller.name') }}
                        </td>
                        <td><strong id="tv-name"></strong></td>
                    </tr>
                    <tr>
                        <td class="text-light2">
                            {{ __('traveller.type') }}
                        </td>
                        <td id="tv-type"></td>
                    </tr>
                    <tr>
                        <td class="text-light2">
                            {{ __('traveller.gender') }}
                        </td>
                        <td id="tv-gender"></td>
                    </tr>
                    <tr>
                        <td class="text-light2">
                            {{ __('traveller.date_of_birth') }}
                        </td>
                        <td id="tv-dob"></td>
                    </tr>
                    <tr>
                        <td class="text-light2">
                            {{ __('traveller.age') }}
                        </td>
                        <td id="tv-age"></td>
                    </tr>
                    <tr>
                        <td class="text-light2">
                            {{ __('traveller.country') }}
                        </td>
                        <td id="tv-country"></td>
                    </tr>
                    <tr>
                        <td class="text-light2">
                            {{ __('traveller.created_at') }}
                        </td>
                        <td id="tv-created"></td>
                    </tr>
                </table>
            </div>

            <div class="modal-footer">
                <button class="btn btn-outline-secondary rounded-pill"
                        data-bs-dismiss="modal">
                    {{ __('common.close') }}
                </button>
            </div>

        </div>
    </div>
</div>
