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
                    <div class="fromGroup">
                        <label class="form-label">Packages</label>
                        <select name="package_ids[]" id="packages" multiple class="form-control select2"></select>
                    </div>



                    {{-- Status --}}
                    <div class="fromGroup">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="">All</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>

                        </select>
                    </div>

                    <div class="fromGroup">
                    <label class="form-label">Payment Status</label>
                    <select name="payment_status" class="form-control">
                        <option value="">All</option>

                        @foreach (\App\Enums\PaymentStatus::cases() as $status)
                            <option value="{{ $status->value }}"
                                {{ request('payment_status') === $status->value ? 'selected' : '' }}>
                                {{ Str::headline($status->value) }}
                            </option>
                        @endforeach
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

  

    <script>
document.addEventListener('DOMContentLoaded', function () {

    const el = document.getElementById('packages');
    if (!el) return;

    const selectedIds = @json(request('package_ids', []));

    // Initialize Select2 with AJAX search
    $(el).select2({
        placeholder: 'Search packages',
        width: '100%',
        minimumInputLength: 1,
        ajax: {
            url: '/admin/packages/search',
            dataType: 'json',
            delay: 300,
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data.map(item => ({
                        id: item.id,
                        text: item.title
                    }))
                };
            },
            cache: true
        }
    });

    // Load selected IDs (important for GET filter)
    if (selectedIds.length > 0) {
        $.ajax({
            url: '/admin/packages/seachIds',
            type: 'GET',
            data: {
                ids: selectedIds
            },
            success: function (data) {
                data.forEach(item => {
                    const option = new Option(item.title, item.id, true, true);
                    el.append(option);
                });
                $(el).trigger('change');
            }
        });
    }

});
</script>








@endsection


