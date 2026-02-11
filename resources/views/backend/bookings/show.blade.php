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

            <div class="card-body space-y-6 p-4">

                {{-- ================= BASIC INFO ================= --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

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
                        <div class="flex gap-2">
                            <img src="{{ asset(currency_icon_path(null, 'light')) }}">
                            <p class="font-semibold text-primary-600">
                                {{ number_format($booking->booking_total_amount) }}
                            </p>
                        </div>

                    </div>

                </div>

                {{-- ================= ITINERARY DETAILS ================= --}}
                <div class="border-t pt-4">
                    <h5 class="font-semibold text-base mb-3">Itinerary Details</h5>

                    @foreach ($booking->days as $day)
                        <div class="mb-4 border rounded-lg p-4 bg-white shadow-sm">

                            {{-- Day Header --}}
                            <p class="font-semibold mb-3 text-primary-600">
                                Day {{ $day->day_number }}
                                @if ($day->city_name)
                                    – {{ $day->city_name }}
                                @endif
                            </p>

                            {{-- Items --}}
                            <div class="space-y-3">

                                @foreach ($day->dayItems as $item)
                                    @php
                                        $meta = $item->meta_json ?? [];
                                    @endphp

                                    <div class="flex items-center justify-between bg-slate-50 p-3 rounded-lg">

                                        {{-- LEFT: Image + Title --}}
                                        <div class="flex items-center gap-3">

                                            {{-- Image --}}
                                            @if (!empty($meta['image_path']))
                                                <img src="{{ asset('storage/' . $meta['image_path']) }}"
                                                    class="w-14 h-14 object-cover rounded-md border">
                                            @else
                                                <div
                                                    class="w-14 h-14 bg-gray-200 rounded-md flex items-center justify-center text-xs text-gray-500">
                                                    No Image
                                                </div>
                                            @endif

                                            {{-- Title + Type --}}
                                            <div>
                                                <p class="font-medium">
                                                    {{ $item->title ?? ($meta['title'] ?? ucfirst($item->item_type)) }}
                                                </p>

                                                <p class="text-xs text-slate-500 capitalize">
                                                    {{ $item->item_type }}
                                                </p>
                                            </div>

                                        </div>

                                        {{-- RIGHT: Time --}}
                                        <div class="text-sm text-slate-600">
                                            @if ($item->start_time && $item->end_time)
                                                {{ \Carbon\Carbon::parse($item->start_time)->format('h:i A') }}
                                                →
                                                {{ \Carbon\Carbon::parse($item->end_time)->format('h:i A') }}
                                            @endif
                                        </div>

                                    </div>
                                @endforeach

                            </div>

                        </div>
                    @endforeach
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

                        {{-- UPDATE STATUS --}}
                        <form method="POST" action="{{ route('admin.bookings.status.update', $booking->id) }}">
                            @csrf
                            {{-- REQUIRED --}}
                            <input type="hidden" name="type" value="booking">

                            <select name="status" class="form-control mb-2" required>
                                <option value="pending" @selected($booking->status === 'pending')>
                                    Pending
                                </option>

                                <option value="confirmed" @selected($booking->status === 'confirmed')>
                                    Confirmed
                                </option>

                                <option value="cancelled" @selected($booking->status === 'cancelled')>
                                    Cancelled
                                </option>

                                <option value="completed" @selected($booking->status === 'completed')>
                                    Completed
                                </option>
                            </select>

                            <button class="btn btn-dark w-full">
                                Update Booking Status
                            </button>
                        </form>

                        {{-- ================= PAYMENT DETAILS ================= --}}
                        <div class="card mb-6">
                            <header class="card-header flex justify-between">
                                <h4 class="card-title">Payment Details</h4>
                                {{-- @if ($booking->status === 'confirmed') --}}
                                <button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#paymentModal">
                                    + Add Payment
                                </button>
                                {{-- @endif --}}
                            </header>

                            <div class="card-body space-y-4 p-4">

                                {{-- Existing Payments --}}
                                @if ($booking->payments->count())
                                    <div class="mb-4">
                                        <p class="text-sm text-slate-500 mb-2">Payment History</p>

                                        <x-admin.table.table>
                                            <x-admin.table.thead>
                                                <x-admin.table.tr>
                                                    <x-admin.table.th>Method</x-admin.table.th>
                                                    <x-admin.table.th>Txn ID</x-admin.table.th>
                                                    <x-admin.table.th>Amount</x-admin.table.th>
                                                    <x-admin.table.th>Status</x-admin.table.th>
                                                    <x-admin.table.th>Date</x-admin.table.th>
                                                    <x-admin.table.th>Action</x-admin.table.th>

                                                </x-admin.table.tr>
                                            </x-admin.table.thead>

                                            <x-admin.table.tbody>
                                                @foreach ($booking->payments as $payment)
                                                    <x-admin.table.tr>
                                                        <x-admin.table.td>{{ ucfirst($payment->payment_method) }}</x-admin.table.td>
                                                        <x-admin.table.td>{{ $payment->transaction_id ?? '—' }}</x-admin.table.td>
                                                        <x-admin.table.td>

                                                            <div class="flex gap-2">
                                                                <img src="{{ asset(currency_icon_path($payment->currency , 'light')) }}">
                                                                <p>{{ number_format($payment->amount, 2) }}</p>
                                                            </div>

                                                        </x-admin.table.td>
                                                        <x-admin.table.td>
                                                            {!! ui_badge(
                                                                $payment->status,
                                                                match ($payment->status) {
                                                                    'paid' => 'success',
                                                                    'failed' => 'danger',
                                                                    'refunded' => 'warning',
                                                                    'manual' => 'info',
                                                                    default => 'gray',
                                                                },
                                                            ) !!}
                                                        </x-admin.table.td>
                                                        <x-admin.table.td>
                                                            {{ $payment->created_at->format('d M Y') }}
                                                        </x-admin.table.td>
                                                        <x-admin.table.td>
                                                            <button class="btn btn-xs" data-bs-toggle="modal"
                                                                data-bs-target="#paymentModal"
                                                                data-payment-id="{{ $payment->id }}"
                                                                data-method="{{ $payment->payment_method }}"
                                                                data-amount="{{ $payment->amount }}"
                                                                data-txn="{{ $payment->transaction_id }}"
                                                                data-bank="{{ $payment->bank_name ?? '' }}"
                                                                data-note="{{ $payment->payload_json['note'] ?? '' }}"
                                                                data-status="{{ $payment->status }}">

                                                                <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                                            </button>
                                                        </x-admin.table.td>
                                                    </x-admin.table.tr>
                                                @endforeach
                                            </x-admin.table.tbody>
                                        </x-admin.table.table>
                                    </div>
                                @endif


                            </div>
                        </div>
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
    {{-- ================= PAYMENT MODAL ================= --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
        id="paymentModal" tabindex="-1" aria-labelledby="paymentModal" aria-hidden="true">
        <!-- BEGIN: Modal -->
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div
                class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                            Add Payment
                        </h3>
                        <button type="button"
                            class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white"
                            data-bs-dismiss="modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="#ffffff" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-4">
                        <form method="POST" action="{{ route('admin.bookings.payment.store', $booking->id) }}"
                            id="paymentForm">
                            @csrf

                            <!-- hidden = decide ADD vs EDIT -->
                            <input type="hidden" name="payment_id" id="modal_payment_id">

                            <!-- HEADER -->
                            <div class="modal-header bg-dark text-white">
                                <h5 class="modal-title" id="paymentModalTitle">Add Payment</h5>
                                <button type="button" class="btn-close btn-close-white"
                                    data-bs-dismiss="modal"></button>
                            </div>

                            <!-- BODY -->
                            <div class="modal-body space-y-3">

                                <select name="payment_method" id="modal_payment_method" class="form-control" required>
                                    <option value="cash">Cash</option>
                                    <option value="bank">Bank Transfer</option>
                                    <option value="manual">Manual</option>
                                </select>

                                <div id="modal_bank_field" style="display:none;">
                                    <input type="text" name="bank_name" id="modal_bank_name" class="form-control"
                                        placeholder="Bank Name">
                                </div>

                                <input type="text" name="transaction_id" id="modal_transaction_id"
                                    class="form-control" placeholder="Transaction ID">

                                <input type="number" name="amount" id="modal_amount" class="form-control" required>

                                <textarea name="note" id="modal_note" class="form-control" placeholder="Admin note"></textarea>

                                <select name="status" id="modal_payment_status" class="form-control" required>
                                    <option value="pending">Pending</option>
                                    <option value="paid">Paid</option>
                                    <option value="failed">Failed</option>
                                    <option value="refunded">Refunded</option>
                                    <option value="partial_refund">Partial Refund</option>
                                </select>

                            </div>


                            <!-- Modal footer -->
                            <div
                                class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <button type="submit" class="btn btn-success">
                                    Save Payment
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- END: Modals -->
        </div>


        <script>
            document.getElementById('payment_method')?.addEventListener('change', function() {
                alert('Payment method changed to: ' + this.value);
                const bankField = document.getElementById('bank-name-field');

                if (this.value === 'bank') {
                    bankField.classList.remove('hidden');
                } else {
                    bankField.classList.add('hidden');
                }
            });
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const modal = document.getElementById('paymentModal');
                const methodSelect = document.getElementById('modal_payment_method');
                const bankField = document.getElementById('modal_bank_field');

                const statusSelect = document.getElementById('modal_payment_status');


                function toggleBank(method) {
                    bankField.style.display = method === 'bank' ? 'block' : 'none';
                }

                // Payment method change
                methodSelect.addEventListener('change', function() {
                    toggleBank(this.value);
                });

                // Modal open (ADD + EDIT)
                modal.addEventListener('show.bs.modal', function(event) {

                    const btn = event.relatedTarget;

                    // ADD case
                    if (!btn.dataset.paymentId) {
                        document.getElementById('paymentModalTitle').innerText = 'Add Payment';
                        document.getElementById('paymentForm').reset();
                        document.getElementById('modal_payment_id').value = '';
                        toggleBank(methodSelect.value);
                        return;
                    }

                    // EDIT case
                    document.getElementById('paymentModalTitle').innerText = 'Edit Payment';

                    document.getElementById('modal_payment_id').value = btn.dataset.paymentId;
                    methodSelect.value = btn.dataset.method;
                    document.getElementById('modal_amount').value = btn.dataset.amount;
                    document.getElementById('modal_transaction_id').value = btn.dataset.txn ?? '';
                    document.getElementById('modal_bank_name').value = btn.dataset.bank ?? '';
                    document.getElementById('modal_note').value = btn.dataset.note ?? '';
                    statusSelect.value = btn.dataset.status ?? 'pending';
                    toggleBank(btn.dataset.method);
                });

            });
        </script>



    @endsection
