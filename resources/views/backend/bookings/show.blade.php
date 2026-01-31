@extends('backend.layout')

@section('content')

{{-- Breadcrumb --}}
<div class="mb-5">
    <ul class="flex items-center gap-2 text-sm">
        <li class="text-primary-500">
            <a href="{{ url('/admin/dashboard') }}">
                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
            </a>
        </li>
        <li class="text-slate-400">/</li>
        <li class="text-primary-500">
            <a href="{{ route('admin.bookings.index') }}">Bookings</a>
        </li>
        <li class="text-slate-400">/</li>
        <li class="text-slate-700 font-medium">
            {{ $booking->booking_code }}
        </li>
    </ul>
</div>

{{-- ================= BOOKING SUMMARY ================= --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

    {{-- LEFT : BOOKING INFO --}}
    <div class="card lg:col-span-2">
        <header class="card-header">
            <h4 class="card-title">Booking Information</h4>
        </header>

        <div class="card-body grid grid-cols-1 md:grid-cols-2 gap-4 p-4">

            <div>
                <p class="text-sm text-slate-500">Booking Code</p>
                <p class="font-medium">{{ $booking->booking_code }}</p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Booking Date</p>
                <p class="font-medium">{{ $booking->created_at->format('d M Y, h:i A') }}</p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Travel Dates</p>
                <p class="font-medium">
                    {{ \App\Helpers\DateHelper::range($booking->travel_start_date, $booking->travel_end_date) }}
                </p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Package</p>
                <p class="font-medium">
                    {{ $booking->package->translation->title ?? '—' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Total Travellers</p>
                <p class="font-medium">
                    {{ $booking->total_person }}
                    ({{ $booking->total_adult }} Adult,
                    {{ $booking->total_child }} Child)
                </p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Total Amount</p>
                <p class="font-semibold text-primary-600">
                    ₹{{ number_format($booking->booking_total_amount) }}
                </p>
            </div>

        </div>
    </div>

    {{-- RIGHT : STATUS --}}
    <div class="card">
        <header class="card-header">
            <h4 class="card-title">Status</h4>
        </header>

        <div class="card-body space-y-4 p-4">

            {{-- Booking Status --}}
            <div>
                <p class="text-sm text-slate-500 mb-1">Booking Status</p>
                {!! status_badge($booking->status) !!}
            </div>

            {{-- Payment Status --}}
            <div>
                <p class="text-sm text-slate-500 mb-1">Payment Status</p>
                {!! status_badge($booking->payment_status) !!}
            </div>

            {{-- ACTIONS --}}
            <div class="pt-4 border-t">
                <div class="flex flex-col gap-3">

                    {{-- CURRENT STATUS --}}
                    <div>
                        <p class="text-sm text-slate-500 mb-1">Current Booking Status</p>
                        {!! ui_badge(ucfirst($booking->status), match($booking->status) {
                            'confirmed' => 'success',
                            'cancelled' => 'danger',
                            'pending'   => 'warning',
                            default     => 'gray',
                        }) !!}
                    </div>

                    {{-- UPDATE STATUS --}}
                    <form method="POST"
                          action="{{ route('admin.bookings.status.update', $booking->id) }}">
                        @csrf

                        {{-- REQUIRED --}}
                        <input type="hidden" name="type" value="booking">

                        <select name="status" class="form-control mb-2" required>
                            <option value="pending"
                                @selected($booking->status === 'pending')>
                                Pending
                            </option>

                            <option value="confirmed"
                                @selected($booking->status === 'confirmed')>
                                Confirmed
                            </option>

                            <option value="cancelled"
                                @selected($booking->status === 'cancelled')>
                                Cancelled
                            </option>
                        </select>

                        <button class="btn btn-dark w-full">
                            Update Booking Status
                        </button>
                    </form>

                    {{-- OPTIONAL ACTIONS --}}
                    {{--
                    <a href="{{ route('admin.bookings.invoice.download', $booking->id) }}"
                       class="btn btn-outline-secondary w-full">
                        Download Invoice
                    </a>

                    <form method="POST"
                          action="{{ route('admin.bookings.resend-mail', $booking->id) }}">
                        @csrf
                        <button class="btn btn-outline-primary w-full">
                            Resend Confirmation Mail
                        </button>
                    </form>
                    --}}
                </div>
            </div>


        </div>
    </div>
</div>

{{-- ================= TRAVELLERS ================= --}}
<div class="card mb-6">
    <header class="card-header">
        <h4 class="card-title">Travellers</h4>
    </header>

    <div class="card-body">

        <x-admin.table.table>

            <x-admin.table.thead>
                <x-admin.table.tr>
                    <x-admin.table.th>#</x-admin.table.th>
                    <x-admin.table.th>Name</x-admin.table.th>
                    <x-admin.table.th>Type</x-admin.table.th>
                    <x-admin.table.th>Gender</x-admin.table.th>
                    <x-admin.table.th>DOB</x-admin.table.th>
                </x-admin.table.tr>
            </x-admin.table.thead>

            <x-admin.table.tbody>
                @forelse($booking->travellers as $key => $traveller)
                    <x-admin.table.tr>
                        <x-admin.table.td>{{ $key + 1 }}</x-admin.table.td>
                        <x-admin.table.td>
                            {{ $traveller->first_name }} {{ $traveller->last_name }}
                        </x-admin.table.td>
                        <x-admin.table.td>{{ ucfirst($traveller->type) }}</x-admin.table.td>
                        <x-admin.table.td>{{ ucfirst($traveller->gender) }}</x-admin.table.td>
                        <x-admin.table.td>{{ $traveller->dob->format('d M Y') }}</x-admin.table.td>
                    </x-admin.table.tr>
                @empty
                    <x-admin.table.empty-row colspan="5" text="No travellers found" />
                @endforelse
            </x-admin.table.tbody>

        </x-admin.table.table>

    </div>
</div>

@endsection
