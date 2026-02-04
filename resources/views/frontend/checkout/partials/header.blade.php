<div class="checkout-top-header d-flex flex-column flex-sm-row justify-content-between align-items-start">

    <!-- LEFT BLOCK -->
    <div>
        <h1 class="fw-600 text-white mb-1 h3">{{ $package?->translation?->title }}</h1>

        <div class="text-white d-flex align-items-center gap-3 my-2">
            @foreach ($package->itinerarySubtitleFull() as $text)
                <p>{{ $text }}</p>

                @if (!$loop->last)
                    <div class="dot primary-bg"></div>
                @endif
            @endforeach
        </div>

        <div class="text-white d-flex flex-wrap align-items-center gap-3">

            {{-- START DATE --}}
            <p class="p-small">
                {{ $startDate?->format('D, M d, Y') }}
            </p>

            {{-- DURATION --}}
            <span class="trip-badge p-micro rounded-pill">
                {{ $package->duration_days }}D / {{ $package->duration_nights }}N
            </span>

            {{-- END DATE --}}
            <p class="p-small">
                {{ $endDate?->format('D, M d, Y') }}
            </p>

            {{-- ROOM & ADULTS --}}
            {{-- <span class="vertical-divider"></span>
                                <p class="p-small">
                                    <span class="fw-600">{{ $rooms }} Room</span> - {{ $adults }} Adults
                                </p> --}}

        </div>

    </div>
    <!-- RIGHT BUTTON -->
    {{-- <button class="btn btn-light rounded-pill customizable-btn mt-3 mt-sm-0 fw-500">
                            Customizable
                        </button> --}}
</div>
