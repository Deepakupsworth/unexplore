@php
function bookingStatusUI($status)
{
    if ($status instanceof \App\Enums\BookingStatus) {
        $status = $status->value;
    }

    return match ($status) {
        'pending', 'confirmed' => [__('account.status_upcoming'), ''],
        'cancelled' => [__('account.status_cancelled'), 'bg-danger'],
        'completed' => [__('account.status_completed'), 'bg-dark'],
    };
}
@endphp


<div class="user-profile__details-content">

    {{-- HEADER --}}
    <div class="user-profile__details-header white-bg p-3">
        <p class="p-large fw-600 mb-1">{{ __('account.my_bookings') }}</p>
        <p class="text-light2">
            {{ __('account.my_bookings_desc') }}
        </p>
    </div>

    <div class="white-bg p-3 user-profile__details-body">
        <div class="user-profile__box white-bg w-100">

            {{-- ================= TABS ================= --}}
            <div class="user-profile__details-header px-2 pt-2">
                <nav class="user-bookings__nav">
                    <div class="nav nav-tabs">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#upcoming">
                            {{ __('account.upcoming') }}
                        </button>
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#cancelled">
                            {{ __('account.cancelled') }}
                        </button>
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#completed">
                            {{ __('account.completed') }}
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
                                    {{ __('account.no_upcoming_bookings') }}
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
                                    {{ __('account.no_cancelled_bookings') }}
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
                                    {{ __('account.no_completed_bookings') }}
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
