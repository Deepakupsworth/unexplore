<div class="offcanvas offcanvas-end view-booking-detail-side-drawer" tabindex="-1" id="viewBookingDetailsSideDrawer"
    aria-labelledby="viewBookingDetailsSideDrawerLabel">
    <div class="offcanvas-header side-drawer__header">
        <p class="offcanvas-title fw-600" id="viewBookingDetailsSideDrawerLabel">Booking Details</p>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body side-drawer__booking-body">
        <div class="booking-card mb-3 position-relative">
            <span class="badge-upcoming rounded-pill p-small" id="drawerLabel"></span>
            <img id="thumbImage" src="" class="booking-image" alt="Booking Image">
        </div>

        <!-- Title -->
        <h6 class="fw-600 p-large text-black" id="bookingTitle"></h6>
        <p class="text-light2 mb-3" id="bookingRoute"></p>
        <hr/>

        {{--Booking Details  --}}
        <p class="fw-600 text-black mb-3">Days Details</p>
        <hr/>

        <!-- Amenities -->
        <div class="mb-4 text-light2 p-small fw-500 side-drawer__booking-amenities" id="drawerAmenities">

        </div>

        <div id="drawerItinerary" class="mt-3"></div>

        <hr/>

        <!-- Booking Details -->
        <p class="fw-600 text-black mb-3">Transaction Details</p>
        <div class="d-flex gap-3 mb-2">
            <img src="{{ asset('frontend/assets/icons/drag-vertical.svg') }}" alt="Vertical Drag Icon">
            <div class="booking-details__item">
                <span class="booking-details__item-title">Date</span>
                <span class="fw-500 d-flex gap-3">
                    <span class="text-black fw-600">:</span>
                    <span id="bookingDate"></span>
                </span>
            </div>
        </div>
        <div class="d-flex gap-3 mb-2">
            <img src="{{ asset('frontend/assets/icons/drag-vertical.svg') }}" alt="Vertical Drag Icon">
            <div class="booking-details__item">
                <span class="booking-details__item-title">Total Amount</span>
                <span class="fw-500 d-flex gap-2">
                    <span class="text-black fw-600">:</span>
                    <span id="bookingCurrencyIcon"></span> <span id="bookingTotal"></span>
                </span>

            </div>
        </div>

        <div id="transactionItem"></div>
    </div>

    <div class="offcanvas-footer border-top text-end p-3">
        <button class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="offcanvas">Close</button>
    </div>
</div>
