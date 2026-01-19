{{-- OPTIONS CARD (Theme Based) --}}
<div class="mt-5">

    <div class="card active border border-amber-300">
        <div class="card-body p-0">

            <div class="card-text h-full">

                {{-- CARD HEADER --}}
                <header class="border-b px-4 pt-4 pb-3 flex items-center justify-between border-primary-500">
                    <div class="flex items-center">

                        <h3 class="card-title mb-0 text-primary-500 text-sm font-semibold">
                            Optional Upgrades
                        </h3>
                    </div>

                    <button type="button"
                            class="text-sm font-medium text-primary-500 hover:underline
                                   add-option-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#addOptionModal"
                            data-day="{{ $day->id }}"
                            data-type="{{ $item->item_type }}"
                            data-item="{{ $item->item_id }}">
                        + Add
                    </button>
                </header>

                {{-- CARD CONTENT --}}
                <div class="py-4 px-5 space-y-3 options-wrapper"
                     data-day="{{ $day->id }}"
                     data-type="{{ $item->item_type }}"
                     data-item="{{ $item->item_id }}">

                    @php
                        $options = $day->options
                            ->where('item_type', $item->item_type)
                            ->where('item_id', $item->item_id);
                    @endphp

                    @forelse ($options as $opt)
                        {{-- OPTION ROW --}}
                        <div class="flex justify-between items-start
                                    border rounded-lg p-4 bg-slate-50">

                            {{-- LEFT --}}
                            <div>
                                <p class="font-medium text-slate-800">
                                    {{ ucfirst($item->item_type) }} Upgrade
                                    <span class="text-xs text-slate-400">
                                        (#{{ $opt->item_id }})
                                    </span>
                                </p>

                                <div class="flex items-center gap-2 mt-1">
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

                            {{-- RIGHT PRICE --}}
                            <div class="text-right">
                                <p class="text-xs text-slate-400">
                                    Extra Cost
                                </p>
                                <p class="text-lg font-bold text-green-600">
                                    ₹ {{ number_format($opt->extra_price, 2) }}
                                </p>
                            </div>

                        </div>
                    @empty
                        {{-- EMPTY STATE --}}
                        <div class="text-sm text-slate-400 italic text-center
                                    border border-dashed rounded-lg p-4 bg-slate-50">
                            No optional upgrades added yet.
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>

</div>
