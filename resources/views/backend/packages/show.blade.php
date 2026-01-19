@extends('backend.layout')

@section('content')
    @php
        use Carbon\Carbon;
        $card = 'bg-white rounded-2xl shadow-sm border p-6';
    @endphp

    {{-- ================= HEADER ================= --}}
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Package Details</h2>
            <p class="text-sm text-slate-500">Complete overview of this travel package</p>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-primary">
                Edit Package
            </a>
            <a href="{{ route('admin.packages.index') }}" class="btn btn-outline-dark">
                Back
            </a>
        </div>
    </div>

    <div class="space-y-10">

        {{-- ================= BASIC INFO ================= --}}
        <section class="{{ $card }}">
            <h3 class="text-lg font-semibold mb-6 border-b pb-3">Basic Information</h3>

            <div class="grid grid-cols-2 gap-6 text-sm">
                <div>
                    <p class="text-slate-500">Category</p>
                    <p class="font-semibold">{{ $package->category?->translation?->name }}</p>
                </div>

                <div>
                    <p class="text-slate-500">Status</p>
                    {!! status_badge($package->status) !!}
                </div>

                <div>
                    <p class="text-slate-500">Package Type</p>
                    <span class="inline-block px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-700">
                        {{ ucfirst($package->package_type) }}
                    </span>
                </div>

                <div>
                    <p class="text-slate-500">Duration</p>
                    <p class="font-semibold">
                        {{ $package->duration_days }} Days / {{ $package->duration_nights }} Nights
                    </p>
                </div>

                <div>
                    <p class="text-slate-500">Base Persons</p>
                    <p class="font-semibold">{{ $package->base_persons }}</p>
                </div>

                <div>
                    <p class="text-slate-500">Max Persons</p>
                    <p class="font-semibold">{{ $package->max_persons }}</p>
                </div>
            </div>
        </section>

        {{-- ================= AVAILABILITY ================= --}}
        <section class="{{ $card }}">
            <h3 class="text-lg font-semibold mb-6 border-b pb-3">Availability</h3>

            @php $avail = $package->availabilities->first(); @endphp

            <div class="grid grid-cols-2 gap-6 text-sm">
                <div>
                    <p class="text-slate-500">Available From</p>
                    <p class="font-semibold">
                        {{ $avail?->available_from ? Carbon::parse($avail->available_from)->format('d M Y') : '—' }}
                    </p>
                </div>

                <div>
                    <p class="text-slate-500">Available To</p>
                    <p class="font-semibold">
                        {{ $avail?->available_to ? Carbon::parse($avail->available_to)->format('d M Y') : '—' }}
                    </p>
                </div>

                <div>
                    <p class="text-slate-500">Booking Start</p>
                    <p class="font-semibold">
                        {{ $avail?->booking_start_date ? Carbon::parse($avail->booking_start_date)->format('d M Y, h:i A') : '—' }}
                    </p>
                </div>

                <div>
                    <p class="text-slate-500">Booking End</p>
                    <p class="font-semibold">
                        {{ $avail?->booking_end_date ? Carbon::parse($avail->booking_end_date)->format('d M Y, h:i A') : '—' }}
                    </p>
                </div>
            </div>
        </section>

        {{-- ================= CITIES ================= --}}
        <section class="{{ $card }}">
            <h3 class="text-lg font-semibold mb-6 border-b pb-3">Cities & Nights</h3>

            <table class="w-full text-sm border rounded-lg overflow-hidden">
                <thead class="bg-slate-100">
                    <tr>
                        <th class="px-4 py-3 text-left">City</th>
                        <th class="px-4 py-3 text-center">Nights</th>
                        <th class="px-4 py-3 text-center">Order</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach ($package->cities as $city)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3 font-medium">{{ $city->city?->slug }}</td>
                            <td class="px-4 py-3 text-center">{{ $city->nights }}</td>
                            <td class="px-4 py-3 text-center">{{ $city->sort_order }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        {{-- ================= DAY WISE ITINERARY ================= --}}
        <section class="{{ $card }}">
            <h3 class="text-lg font-semibold mb-6 border-b pb-3">Day Wise Itinerary</h3>

            <div class="space-y-10">
                @foreach ($package->days as $day)
                    {{-- DAY CONTAINER --}}
                    <div class="card border">
                        <div class="card-body">
                            <div class="card-text h-full">
                                <header class="px-4 pt-4 pb-3 flex items-center">

                                    <h3 class="card-title mb-0 text-primary-500"> Day {{ $day->day_number }}
                                        <span class="text-slate-500 font-medium">
                                            — {{ $day->city?->slug }}
                                        </span>
                                    </h3>
                                </header>
                                <div class="py-3 px-5">
                                    @forelse ($day->items as $item)
                                        @php
                                            $border = match ($item->item_type) {
                                                'hotel' => 'border-blue-500',
                                                'todo' => 'border-green-500',
                                                'transport' => 'border-yellow-500',
                                                default => 'border-slate-400',
                                            };
                                        @endphp

                                        {{-- ITEM CARD --}}
                                        <div class="bg-white border {{ $border }} rounded-xl p-5 shadow-sm mb-4">

                                            {{-- ITEM HEADER --}}
                                            <div class="flex justify-between items-start mb-3">
                                                <div>
                                                    <p class="text-base font-semibold capitalize text-slate-800">
                                                        {{ $item->item_type }}
                                                        <span class="text-xs text-slate-400">
                                                            (#{{ $item->item_id }})
                                                        </span>
                                                    </p>


                                                    <p class="text-sm text-slate-500 mt-1">
                                                        {{ $item->start_time ? Carbon::parse($item->start_time)->format('h:i A') : '—' }}
                                                        →
                                                        {{ $item->end_time ? Carbon::parse($item->end_time)->format('h:i A') : '—' }}
                                                    </p>
                                                </div>
                                            </div>

                                            {{-- OPTIONS --}}
                                            <div class="mt-4 pt-4 border-t">
                                                @include('backend.packages.partials.day-item-options', [
                                                    'day' => $day,
                                                    'item' => $item,
                                                ])
                                            </div>

                                        </div>

                                    @empty
                                        <p class="text-sm text-slate-400 italic">
                                            No items added for this day.
                                        </p>
                                    @endforelse

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>



        {{-- ================= PRICING ================= --}}
        <section class="{{ $card }}">
            <h3 class="text-lg font-semibold mb-6 border-b pb-3">Pricing</h3>

            <div class="grid grid-cols-2 gap-6 text-sm">
                <div>
                    <p class="text-slate-500">Currency</p>
                    <p class="font-semibold">{{ $package->price?->currency }}</p>
                </div>

                <div>
                    <p class="text-slate-500">Original Price</p>
                    <p class="font-semibold line-through text-slate-400">
                        {{ $package->price?->original_price }}
                    </p>
                </div>

                <div>
                    <p class="text-slate-500">Discount Price</p>
                    <p class="font-semibold text-green-600">
                        {{ $package->price?->discount_price ?? '—' }}
                    </p>
                </div>

                <div>
                    <p class="text-slate-500">Per Person</p>
                    <p class="text-lg font-bold text-slate-800">
                        {{ $package->price?->per_person_price }}
                    </p>
                </div>
            </div>
        </section>
        @include('backend.packages.partials.add-option-modal')
        @include('backend.packages.partials.package-options-js')
    </div>
@endsection
