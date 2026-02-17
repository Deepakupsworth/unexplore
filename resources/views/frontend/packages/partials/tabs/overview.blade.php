<div class="tab-pane fade show active mt-4" id="explore-saudi__overview-tab-content" role="tabpanel"
    aria-labelledby="pkg-details__overview-tab">
    <div class="pkg-details__content-wrapper">
        <div class="pkg-details__day-plan">
            <div class="pkg-details__day-plan-left">
                <div class="pkg-details__day-plan-header pkg-details__common-block">{{ __('package.day_plan.title') }}
                </div>
                <div class="pkg-details__day-dates-wrapper">
                    <div class="pkg-details__day-dates pkg-details__common-block d-flex gap-3 flex-column nav nav-tabs">
                        @foreach ($package->days as $day)
                            <div class="pkg-details__day-date-item rounded-pill {{ $loop->first ? 'active' : '' }}"
                                data-bs-toggle="tab" data-bs-target="#day{{ $day->day_number }}">
                                <div class="dot"></div>
                                Day {{ $day->day_number }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="pkg-details__day-plan-right">
                <div class="tab-content">

                    @foreach ($package->days as $day)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                            id="day{{ $day->day_number }}">

                            {{-- Day Header --}}
                            <div class="pkg-details__day-plan-header pkg-details__common-block">
                                <p class="badge primary-bg">{{ __('package.day') }} {{ $day->day_number }}</p>
                                <p class="fw-600">
                                    {{ $day->city?->translations?->first()?->name }}
                                </p>
                            </div>

                            <div class="pkg-details__day-plan-content pkg-details__common-block">

                                {{-- ================= HOTEL ================= --}}
                                @php
                                    $sessionHotelIds = $sessionItems[$day->id]['hotel'] ?? null;

                                    if ($sessionHotelIds) {
                                        // session exists → show selected
                                        $hotels = $allHotels->whereIn('id', array_values($sessionHotelIds));
                                    } else {
                                        // first time → show package default
                                        $hotels = $day->items->where('item_type', 'hotel')->map(fn($i) => $i->hotel);
                                    }

                                    $slot = 0;
                                @endphp
                                @if ($hotels->count())
                                    <div class="accordion accordion-flush mb-3" id="hotelAccordion{{ $day->id }}">
                                        <div class="accordion-item border rounded pkg-details__accordion-item">

                                            <div class="accordion-header">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="accordion-icon" data-bs-toggle="collapse"
                                                            data-bs-target="#hotelCollapse{{ $day->id }}">
                                                            <i class="fa-solid fa-chevron-down"></i>
                                                        </div>
                                                        <p class="p-small fw-600">{{ __('package.item.hotel') }}</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-2 pkg-details__accordion-actions">


                                                </div>
                                            </div>

                                            <div id="hotelCollapse{{ $day->id }}"
                                                class="accordion-collapse collapse show"
                                                data-bs-parent="#hotelAccordion{{ $day->id }}">

                                                <div class="accordion-body" id="day-{{ $day->id }}-hotel-list">
                                                    @php
                                                        $hotel_slot = 0;
                                                    @endphp
                                                    @foreach ($hotels as $index => $hotel)
                                                        @php
                                                            $hotelImage = $hotel?->thumb
                                                                ? asset('storage/' . $hotel->thumb->image_path)
                                                                : asset('frontend/assets/hotel-placeholder.jpg');
                                                        @endphp
                                                        <div class="day-item-slot d-flex position-relative"
                                                            data-day-id="{{ $day->id }}" data-type="hotel"
                                                            data-index="{{ $hotel_slot }}">
                                                            <div class="day-item-wrapper"
                                                                data-day-id="{{ $day->id }}" data-type="hotel"
                                                                data-item-id="{{ $hotel->id }}"
                                                                data-default-item-id="{{ $hotel->id }}"
                                                                data-index="{{ $hotel_slot }}">
                                                                <div class="d-flex align-items-center gap-3 mb-3 ">
                                                                    <img src="{{ $hotelImage }}"
                                                                        class="pkg-details__tr-ht-img">

                                                                    <div>
                                                                        <div class="pkg-details__star-ratings">
                                                                            @for ($i = 1; $i <= 5; $i++)
                                                                                <i
                                                                                    class="fa-solid fa-star {{ $i <= $hotel->star_rating ? 'active' : 'text-muted' }}"></i>
                                                                            @endfor
                                                                        </div>

                                                                        <p class="fw-600 my-1">
                                                                            {{ $hotel->translation?->name }}
                                                                        </p>

                                                                        <p class="p-small text-light2">
                                                                            <i class="fa-solid fa-location-dot"></i>
                                                                            {{ $hotel->location }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="extra_price"
                                                                    value="{{ $dayWiseOptions[$day->id]['hotel'][$hotel->id]['extra_price'] ?? 0 }}">
                                                                <input class="day-item-input" type="hidden"
                                                                    name="day_items[{{ $day->id }}][hotel][{{ $hotel_slot }}]"
                                                                    value="{{ $hotel->id }}">
                                                                <input type="hidden"
                                                                    name="day_item_prices[{{ $day->id }}][hotel][{{ $hotel->id }}]"
                                                                    class="day-item-price-input"
                                                                    value="{{ $dayWiseOptions[$day->id]['hotel'][$hotel->id]['extra_price'] ?? 0 }}">

                                                            </div>
                                                            @if ($package->package_type !== 'fixed')
                                                                <button type="button"
                                                                    class="btn btn-primary btn-sm position-absolute top-0 end-0 m-2 editDayItemsBtn"
                                                                    data-day-id="{{ $day->id }}" data-type="hotel"
                                                                    data-item-id="{{ $hotel->id }}"
                                                                    data-index="{{ $hotel_slot }}">
                                                                    <i class="fa-solid fa-pencil"></i>
                                                                </button>
                                                            @endif
                                                        </div>
                                                        @php
                                                            $hotel_slot++;
                                                        @endphp
                                                    @endforeach

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endif

                                {{-- ================= TODO ================= --}}
                                @php
                                    $sessionTodoIds = $sessionItems[$day->id]['todo'] ?? null;

                                    $todos = $sessionTodoIds
                                        ? $allTodos->whereIn('id', $sessionTodoIds)
                                        : $day->items->where('item_type', 'todo')->map->todo;
                                @endphp

                                @if ($todos->count())
                                    <div class="accordion accordion-flush mb-3" id="todoAccordion{{ $day->id }}">
                                        <div class="accordion-item border rounded pkg-details__accordion-item">

                                            <div class="accordion-header">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="accordion-icon" data-bs-toggle="collapse"
                                                            data-bs-target="#todoCollapse{{ $day->id }}">
                                                            <i class="fa-solid fa-chevron-down"></i>
                                                        </div>
                                                        <p class="p-small fw-600">{{ __('package.item.todo') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-2 pkg-details__accordion-actions">
                                                    <!-- <button type="button"
                                                                                                                        class="btn btn-primary btn-sm editDayItemsBtn"
                                                                                                                        data-day-id="{{ $day->id }}"
                                                                                                                        data-type="todo"
                                                                                                                        data-selected="{{ $todos->pluck('id')->join(',') }}">
                                                                                                                        <i class="fa-solid fa-pencil"></i>
                                                                                                                    </button> -->

                                                </div>
                                            </div>

                                            <div id="todoCollapse{{ $day->id }}"
                                                class="accordion-collapse collapse show"
                                                data-bs-parent="#todoAccordion{{ $day->id }}">

                                                <div class="accordion-body" id="day-{{ $day->id }}-todo-list">

                                                    @php
                                                        $todo_slot = 0;
                                                    @endphp

                                                    @foreach ($todos as $index => $todo)
                                                        <div class="day-item-slot d-flex position-relative"
                                                            data-day-id="{{ $day->id }}" data-type="todo"
                                                            data-index="{{ $todo_slot }}">
                                                            <div class="day-item-wrapper"
                                                                data-day-id="{{ $day->id }}" data-type="todo"
                                                                data-item-id="{{ $todo->id }}"
                                                                data-index="{{ $todo_slot }}">
                                                                <div class="d-flex gap-3 mb-3">
                                                                    <img src="{{ $todo->thumb ? asset('storage/' . $todo->thumb->image_path) : asset('frontend/assets/hotel-placeholder.jpg') }}"
                                                                        class="pkg-details__tr-ht-img">

                                                                    <div>
                                                                        <p class="fw-600">
                                                                            {{ $todo->translation->name }}
                                                                        </p>
                                                                        <p class="p-small text-light2">
                                                                            <i class="fa fa-clock"></i>
                                                                            {{ $todo->opening_time }}
                                                                            -
                                                                            {{ $todo->closing_time }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="extra_price"
                                                                    value="{{ $dayWiseOptions[$day->id]['todo'][$todo->id]['extra_price'] ?? 0 }}">
                                                                <input type="hidden"
                                                                    class="day-item-input"
                                                                    name="day_items[{{ $day->id }}][todo][{{ $todo_slot }}]"
                                                                    value="{{ $todo->id }}">
                                                                <input type="hidden"
                                                                    name="day_item_prices[{{ $day->id }}][todo][{{ $todo->id }}]"
                                                                    class="day-item-price-input"
                                                                    value="{{ $dayWiseOptions[$day->id]['todo'][$todo->id]['extra_price'] ?? 0 }}">
                                                            </div>
                                                            @if ($package->package_type !== 'fixed')
                                                                <button type="button"
                                                                    class="btn btn-primary btn-sm position-absolute top-0 end-0 m-2 editDayItemsBtn"
                                                                    data-day-id="{{ $day->id }}"
                                                                    data-type="todo"
                                                                    data-item-id="{{ $todo->id }}"
                                                                    data-index="{{ $todo_slot }}">
                                                                    <i class="fa-solid fa-pencil"></i>
                                                                </button>
                                                            @endif
                                                        </div>
                                                        @php
                                                            $todo_slot++;
                                                        @endphp
                                                    @endforeach
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endif

                                {{-- ================= EVENT ================= --}}
                                @php
                                    $sessionEventIds = $sessionItems[$day->id]['event'] ?? null;

                                    $events = $sessionEventIds
                                        ? $allEvents->whereIn('id', $sessionEventIds)
                                        : $day->items->where('item_type', 'event')->map->event;
                                @endphp

                                @if ($events->count())
                                    <div class="accordion accordion-flush mb-3"
                                        id="eventAccordion{{ $day->id }}">
                                        <div class="accordion-item border rounded pkg-details__accordion-item">

                                            <div class="accordion-header">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="accordion-icon" data-bs-toggle="collapse"
                                                            data-bs-target="#eventCollapse{{ $day->id }}">
                                                            <i class="fa-solid fa-chevron-down"></i>
                                                        </div>
                                                        <p class="p-small fw-600">{{ __('package.item.event') }}</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-2 pkg-details__accordion-actions">
                                                    <!-- <button type="button"
                                                                                                                        class="btn btn-primary btn-sm editDayItemsBtn"
                                                                                                                        data-day-id="{{ $day->id }}"
                                                                                                                        data-type="event"
                                                                                                                        data-selected="{{ $events->pluck('id')->join(',') }}">
                                                                                                                        <i class="fa-solid fa-pencil"></i>
                                                                                                                    </button> -->

                                                </div>
                                            </div>

                                            <div id="eventCollapse{{ $day->id }}"
                                                class="accordion-collapse collapse show"
                                                data-bs-parent="#eventAccordion{{ $day->id }}">

                                                <div class="accordion-body" id="day-{{ $day->id }}-event-list">
                                                    @php
                                                        $event_slot = 0;
                                                    @endphp

                                                    @foreach ($events as $index => $event)
                                                        <div class="day-item-slot d-flex position-relative"
                                                            data-day-id="{{ $day->id }}" data-type="event"
                                                            data-index="{{ $event_slot }}">
                                                            <div class="day-item-wrapper"
                                                                data-day-id="{{ $day->id }}" data-type="event"
                                                                data-item-id="{{ $event->id }}"
                                                                data-index="{{ $event_slot }}">
                                                                <div class="d-flex gap-3 mb-3">
                                                                    <img src="{{ $event->thumb ? asset('storage/' . $event->thumb->image_path) : asset('frontend/assets/hotel-placeholder.jpg') }}"
                                                                        class="pkg-details__tr-ht-img">

                                                                    <div>
                                                                        <p class="fw-600">
                                                                            {{ $event->translation->title }}
                                                                        </p>
                                                                        <p class="p-small text-light2">
                                                                            <i class="fa fa-calendar"></i>
                                                                            {{ \App\Helpers\DateHelper::format($event->start_date) }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="extra_price"
                                                                    value="{{ $dayWiseOptions[$day->id]['event'][$event->id]['extra_price'] ?? 0 }}">
                                                                <input type="hidden"
                                                                    class="day-item-input"
                                                                    name="day_items[{{ $day->id }}][event][{{ $event_slot }}]"
                                                                    value="{{ $event->id }}">

                                                                <input type="hidden"
                                                                    name="day_item_prices[{{ $day->id }}][event][{{ $event->id }}]"
                                                                    class="day-item-price-input"
                                                                    value="{{ $dayWiseOptions[$day->id]['event'][$event->id]['extra_price'] ?? 0 }}">
                                                            </div>
                                                            @if ($package->package_type !== 'fixed')
                                                                <button type="button"
                                                                    class="btn btn-primary position-absolute top-0 end-0 m-2 editDayItemsBtn"
                                                                    data-day-id="{{ $day->id }}"
                                                                    data-type="event"
                                                                    data-item-id="{{ $event->id }}"
                                                                    data-index="{{ $event_slot }}">
                                                                    <i class="fa-solid fa-pencil"></i>
                                                                </button>
                                                            @endif

                                                            @php
                                                                $event_slot++;
                                                            @endphp
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endif


                                {{-- ================= TRANSPORT ================= --}}
                                @php
                                    $sessionTransportIds = $sessionItems[$day->id]['transport'] ?? null;

                                    if ($sessionTransportIds) {
                                        // session exists → show selected
                                        $transports = $allTransports->whereIn('id', array_values($sessionTransportIds));
                                    } else {
                                        // first time → show package default
                                        $transports = $day->items
                                            ->where('item_type', 'transport')
                                            ->map(fn($i) => $i->transport);
                                    }

                                @endphp

                                @if ($transports->count())
                                    <div class="accordion accordion-flush mb-3"
                                        id="transportAccordion{{ $day->id }}">

                                        <div class="accordion-item border rounded pkg-details__accordion-item">

                                            <div class="accordion-header">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="accordion-icon" data-bs-toggle="collapse"
                                                            data-bs-target="#transportCollapse{{ $day->id }}">
                                                            <i class="fa-solid fa-chevron-down"></i>
                                                        </div>
                                                        <p class="p-small fw-600">{{ __('package.item.transport') }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="d-flex gap-2 pkg-details__accordion-actions">
                                                    {{-- edit button if needed --}}
                                                </div>
                                            </div>

                                            <div id="transportCollapse{{ $day->id }}"
                                                class="accordion-collapse collapse show"
                                                data-bs-parent="#transportAccordion{{ $day->id }}">

                                                <div class="accordion-body"
                                                    id="day-{{ $day->id }}-transport-list">

                                                    @php
                                                        $transport_slot = 0;
                                                    @endphp

                                                    @foreach ($transports as $index => $transport)
                                                        <div class="day-item-slot d-flex position-relative"
                                                            data-day-id="{{ $day->id }}" data-type="transport"
                                                            data-index="{{ $transport_slot }}">

                                                            <div class="day-item-wrapper"
                                                                data-day-id="{{ $day->id }}"
                                                                data-type="transport"
                                                                data-item-id="{{ $transport->id }}"
                                                                data-index="{{ $transport_slot }}">

                                                                <div class="d-flex gap-3 mb-3">
                                                                    <img src="{{ $transport->thumb
                                                                        ? asset('storage/' . $transport->thumb->image_path)
                                                                        : asset('frontend/assets/transport-placeholder.jpg') }}"
                                                                        class="pkg-details__tr-ht-img">

                                                                    <div>
                                                                        <p class="fw-600">
                                                                            {{ $transport->translation->name }}
                                                                        </p>

                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="extra_price"
                                                                    value="{{ $dayWiseOptions[$day->id]['transport'][$transport->id]['extra_price'] ?? 0 }}">
                                                                    <input type="hidden"
                                                                    class="day-item-input"
                                                                    name="day_items[{{ $day->id }}][transport][{{ $transport_slot }}]"
                                                                    value="{{ $transport->id }}">
                                                                <input type="hidden"
                                                                    name="day_item_prices[{{ $day->id }}][transport][{{ $transport->id }}]"
                                                                    class="day-item-price-input"
                                                                    value="{{ $dayWiseOptions[$day->id]['transport'][$transport->id]['extra_price'] ?? 0 }}">

                                                            </div>

                                                            @if ($package->package_type !== 'fixed')
                                                                <button type="button"
                                                                    class="btn btn-primary position-absolute top-0 end-0 m-2 editDayItemsBtn"
                                                                    data-day-id="{{ $day->id }}"
                                                                    data-type="transport"
                                                                    data-item-id="{{ $transport->id }}"
                                                                    data-index="{{ $transport_slot }}">
                                                                    <i class="fa-solid fa-pencil"></i>
                                                                </button>
                                                            @endif

                                                            @php $transport_slot++; @endphp
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endif


                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>

    <div class="pkg-details__content-wrapper mt-4">
        @php
            $translation = $package->translations->where('language_code', app()->getLocale())->first();
        @endphp

        @if ($translation && $translation->description)
            {!! $translation->description !!}
        @endif
    </div>
</div>
