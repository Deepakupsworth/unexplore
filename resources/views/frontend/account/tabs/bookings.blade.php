@php
    function bookingStatusUI($status)
    {
        if ($status instanceof \App\Enums\BookingStatus) {
            $status = $status->value;
        }

        return match ($status) {
            'pending', 'confirmed' => ['Upcoming', ''],
            'cancelled' => ['Cancelled', 'bg-danger'],
            'completed' => ['Completed', 'bg-dark'],
        };
    }

@endphp

<div class="user-profile__details-content">

    {{-- HEADER --}}
    <div class="user-profile__details-header white-bg p-3">
        <p class="p-large fw-600 mb-1">My Bookings</p>
        <p class="text-light2">
            Here you can view all your bookings and packages along with their current status.
        </p>
    </div>

    <div class="white-bg p-3 user-profile__details-body">
        <div class="user-profile__box white-bg w-100">

            {{-- ================= TABS ================= --}}
            <div class="user-profile__details-header px-2 pt-2">
                <nav class="user-bookings__nav">
                    <div class="nav nav-tabs">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#upcoming">
                            Upcoming
                        </button>
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#cancelled">
                            Cancelled
                        </button>
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#completed">
                            Completed
                        </button>
                    </div>
                </nav>
            </div>

            <div class="p-3">
                <div class="tab-content">

                    {{-- ================= UPCOMING ================= --}}
                    <div class="tab-pane fade show active" id="upcoming">
                        <div class="row gy-3">
                            @forelse($upcomingBookings as $booking)
                                @php [$label, $badgeClass] = bookingStatusUI($booking->status); @endphp

                                @include('frontend.account.partials.booking-card', [
                                    'booking' => $booking,
                                    'label' => $label,
                                    'badgeClass' => $badgeClass,
                                ])
                            @empty
                                <div class="col-12 text-center text-muted py-5">
                                    No upcoming bookings
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- ================= CANCELLED ================= --}}
                    <div class="tab-pane fade" id="cancelled">
                        <div class="row gy-3">
                            @forelse($cancelledBookings as $booking)
                                @php [$label, $badgeClass] = bookingStatusUI($booking->status); @endphp

                                @include('frontend.account.partials.booking-card', [
                                    'booking' => $booking,
                                    'label' => $label,
                                    'badgeClass' => $badgeClass,
                                ])
                            @empty
                                <div class="col-12 text-center text-muted py-5">
                                    No cancelled bookings
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- ================= COMPLETED ================= --}}
                    <div class="tab-pane fade" id="completed">
                        <div class="row gy-3">
                            @forelse($completedBookings as $booking)
                                @php [$label, $badgeClass] = bookingStatusUI($booking->status); @endphp

                                @include('frontend.account.partials.booking-card', [
                                    'booking' => $booking,
                                    'label' => $label,
                                    'badgeClass' => $badgeClass,
                                ])
                            @empty
                                <div class="col-12 text-center text-muted py-5">
                                    No completed bookings
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
