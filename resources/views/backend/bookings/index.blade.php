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
            <li class="text-slate-700 font-medium">Bookings</li>
        </ul>
    </div>

    <div class="card">

        {{-- HEADER --}}
        <header class="card-header flex justify-between items-center">
            <h4 class="card-title">Bookings</h4>
        </header>

        <div class="card-body">

            {{-- FILTER FORM --}}
            <form method="GET" class="mb-4">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">

                    {{-- Booking Code --}}
                    <div class="fromGroup">
                        <label class="form-label">Booking Code</label>
                        <input type="text"
                               name="booking_code"
                               value="{{ request('booking_code') }}"
                               placeholder="Search booking code"
                               class="form-control">
                    </div>

                    {{-- Status --}}
                    <div class="fromGroup">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="">All</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary">
                        Reset
                    </a>
                    <button class="btn btn-dark">
                        Search
                    </button>
                </div>

            </form>

            {{-- TABLE --}}
            <x-admin.table.table>

                {{-- TABLE HEADER --}}
                <x-admin.table.thead>
                    <x-admin.table.tr>
                        <x-admin.table.th>#</x-admin.table.th>
                        <x-admin.table.th>Booking Code</x-admin.table.th>
                        <x-admin.table.th>User</x-admin.table.th>
                        <x-admin.table.th>Package</x-admin.table.th>
                        <x-admin.table.th>Travellers</x-admin.table.th>
                        <x-admin.table.th>Total Amount</x-admin.table.th>
                        <x-admin.table.th>Status</x-admin.table.th>
                        <x-admin.table.th>Payment</x-admin.table.th>
                        <x-admin.table.th class="text-right">Action</x-admin.table.th>
                    </x-admin.table.tr>
                </x-admin.table.thead>

                {{-- TABLE BODY --}}
                <x-admin.table.tbody>

                    @forelse($bookings as $index => $booking)
                        <x-admin.table.tr>

                            <x-admin.table.td>{{ $bookings->firstItem() + $index }}</x-admin.table.td>

                            <x-admin.table.td class="font-medium">
                                {{ $booking->booking_code }}
                            </x-admin.table.td>

                            <x-admin.table.td>
                                {{ $booking->user->first_name ?? '' }}
                                {{$booking->user->last_name ?? '' }}
                                <div class="text-xs text-slate-500">
                                    {{ $booking->user->email ?? '' }}
                                </div>
                            </x-admin.table.td>

                            <x-admin.table.td>
                                {{ $booking->package->translation->title ?? '—' }}
                            </x-admin.table.td>

                            <x-admin.table.td>
                                {{ $booking->total_person }}
                                ({{ $booking->total_adult }}A /
                                {{ $booking->total_child }}C)
                            </x-admin.table.td>

                            <x-admin.table.td>
                                ₹{{ number_format($booking->booking_total_amount) }}
                            </x-admin.table.td>

                            <x-admin.table.td>

                                {!! status_badge($booking->status->value) !!}
                            </x-admin.table.td>

                            <x-admin.table.td>
                                {!! status_badge($booking->payment_status->value) !!}
                            </x-admin.table.td>

                            <x-admin.table.td class="text-right">
                                <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                   class="btn btn-sm btn-dark">
                                    View
                                </a>
                            </x-admin.table.td>

                        </x-admin.table.tr>
                    @empty
                        <x-admin.table.empty-row colspan="9" text="No bookings found" />
                    @endforelse

                </x-admin.table.tbody>

            </x-admin.table.table>

            <div class="mt-6">
                {{ $bookings->links() }}
            </div>

        </div>
    </div>

@endsection
