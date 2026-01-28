{{-- OPTIONS CARD (Theme Based) --}}
<div class="mt-5">

    <div class="card active border border-amber-300">
        <div class="card-body p-0">
            <div class="card-text h-full">

                {{-- HEADER --}}
                <header class="border-b px-4 pt-4 pb-3 flex justify-between items-center">
                    <h3 class="text-sm font-semibold text-primary-500">
                        Optional Upgrades
                    </h3>

                    <button type="button"
                            class="text-sm text-primary-500 hover:underline add-option-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#addOptionModal"
                            data-day="{{ $day->id }}"
                            data-type="{{ $item->item_type }}">
                        + Add
                    </button>
                </header>

                {{-- CONTENT --}}
                <div class="py-4 px-5 space-y-3">

                    @php
                        // ✅ filter only same item type
                        $options = $day->options
                            ->where('item_type', $item->item_type)
                            ->values();
                    @endphp

                    @forelse ($options as $opt)

                        @php
                            // resolve related model based on item_type
                            $relatedItem = match ($opt->item_type) {
                                'hotel' => $opt->hotel,
                                'event' => $opt->event,
                                'todo'  => $opt->todo,
                                default => null,
                            };
                        @endphp

                        <div class="flex justify-between items-start gap-4 border rounded-lg p-4 bg-slate-50">

                            {{-- LEFT --}}
                            <div class="flex gap-3">

                                {{-- THUMB --}}
                                @if ($relatedItem?->thumb)
                                    <img
                                        src="{{ asset('storage/' . $relatedItem->thumb->image_path) }} "
                                        class="w-14 h-14 rounded object-cover border"
                                        alt="Thumbnail"
                                    >
                                @else
                                    <div class="w-14 h-14 rounded bg-slate-200 flex items-center justify-center text-xs text-slate-500">
                                        No Image
                                    </div>
                                @endif

                                <div>
                                    <p class="font-medium text-slate-800">
                                        {{ ucfirst($opt->item_type) }} Upgrade
                                        <span class="text-xs text-slate-400">
                                            (#{{ $opt->item_id }})
                                        </span>
                                    </p>

                                    {{-- ITEM NAME --}}
                                    <p class="text-sm text-slate-600 mt-0.5">
                                        {{ $relatedItem?->translation?->name ?? 'Item not found' }}
                                    </p>

                                    <div class="flex gap-2 mt-1">
                                        @if ($opt->is_default)
                                            <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">
                                                Included
                                            </span>
                                        @else
                                            <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">
                                                Optional
                                            </span>
                                        @endif

                                        <span class="text-xs text-slate-400">
                                            Order {{ $opt->sort_order }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- RIGHT --}}
                            <div class="text-right space-y-2">
                                <p class="text-xs text-slate-400">Extra Cost</p>

                                <p class="text-lg font-bold text-green-600">
                                    ₹ {{ number_format($opt->extra_price, 2) }}
                                </p>

                                <button
                                    type="button"
                                    class="text-xs text-red-600 hover:underline remove-option-btn"
                                    data-id="{{ $opt->id }}">
                                    Remove
                                </button>
                            </div>

                        </div>

                    @empty
                        <div class="text-sm text-slate-400 italic text-center border border-dashed rounded-lg p-4 bg-slate-50">
                            No optional upgrades added yet.
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>

</div>
