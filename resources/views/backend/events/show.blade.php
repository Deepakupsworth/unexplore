@extends('backend.layout')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    {{-- Breadcrumb --}}
    <div class="mb-5 flex justify-between items-center">
        <div class="flex gap-2 text-sm">
            <a href="{{ route('events.index') }}" class="text-primary-500">
                <iconify-icon icon="heroicons-outline:home" />
            </a>
            <span>/</span>
            <span class="font-medium">View Event</span>
        </div>

        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-dark">
            Edit Event
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-4 border-b dark:border-slate-700">
            <h2 class="text-xl font-semibold capitalize">
                {{ $event->translations->first()->title ?? 'Event' }}
            </h2>
            <p class="text-sm text-slate-500">
                {{ $event->city?->slug }}
            </p>

        </div>

        {{-- MAIN GRID --}}
        <div class="p-6 grid grid-cols-12 gap-6">

            {{-- QUICK INFO --}}
            <div class="col-span-12 xl:col-span-6">
                <div class="card h-full">
                    <div class="card-body grid grid-cols-2 gap-6 p-4">
                        <div>
                            <p class="text-sm text-slate-500">Categories</p>
                                @forelse ($event->eventCategories as $index => $eventCategory)
                                <span class="badge bg-slate-900 text-white capitalize rounded-3xl">{{  $eventCategory->category?->translation?->name }} </span>
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @empty
                                    —
                                @endforelse
                        </div>
                        <div>
                            <p class="text-xs text-slate-500">Start Date</p>
                            <p class="font-medium">{{ $event->start_date ?? '—' }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-slate-500">End Date</p>
                            <p class="font-medium">{{ $event->end_date ?? '—' }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-slate-500">Opening Time</p>
                            @if ($event->opening_time)
                                <p class="font-medium">
                                    {{ Carbon::parse($event->opening_time)->format('h:i A') }}
                                </p>
                            @endif
                        </div>

                        <div>
                            <p class="text-xs text-slate-500">Closing Time</p>
                            @if ($event->closing_time)
                                <p class="font-medium">
                                    {{ Carbon::parse($event->closing_time)->format('h:i A') }}
                                </p>
                            @endif
                        </div>

                        <div>
                            <p class="text-xs text-slate-500">Opening Days</p>
                            <p class="font-medium">{{ $event->opening_days ?? '—' }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-slate-500">Capacity</p>
                            <p class="font-medium">{{ $event->capacity ?? '—' }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-slate-500">Status</p>
                            {!! status_badge($event->status) !!}
                        </div>

                        <div>
                            <p class="text-xs text-slate-500">Location</p>
                            <p class="font-medium">{{ $event->location ?? '—' }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-slate-500">City</p>
                            <p class="font-medium">{{ $event->city?->slug ?? '—' }}</p>
                        </div>

                    </div>
                </div>
            </div>

            {{-- THUMB + GALLERY --}}
            <div class="col-span-12 xl:col-span-6">
                <div class="card h-full">
                    <div class="card-body p-4">

                        <div class="h-[260px] bg-slate-100 dark:bg-slate-900 rounded-md overflow-hidden">
                            @if ($event->thumb)
                                <img src="{{ Storage::url($event->thumb->image_path) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="h-full flex items-center justify-center text-slate-400">
                                    No Image
                                </div>
                            @endif
                        </div>

                        @if ($event->gallery && $event->gallery->count())
                            <div class="grid xl:grid-cols-6 lg:grid-cols-3 md:grid-cols-3 grid-cols-2 gap-4 mt-5">
                                @foreach ($event->gallery as $img)
                                    <img src="{{ Storage::url($img->image_path) }}"
                                        class="rounded-md border w-full h-24 object-cover">
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>
            </div>

        </div>

        {{-- TRANSLATIONS (CUSTOM TABS) --}}
        <div class="card mt-8">
            <div class="card-body p-6">

                <h4 class="text-lg font-semibold mb-4">
                    Event Descriptions
                </h4>

                {{-- TAB BUTTONS --}}
                <div class="flex gap-2 mb-6">
                    @foreach ($event->translations as $t)
                        <button type="button"
                            class="lang-tab px-4 py-2 rounded border text-sm font-medium
                                {{ $loop->first ? 'bg-slate-800 text-white' : 'bg-slate-100 text-slate-700' }}"
                            data-lang="{{ $t->language_code }}">
                            {{ strtoupper($t->language_code) }}
                        </button>
                    @endforeach
                </div>

                {{-- TAB CONTENT --}}
                @foreach ($event->translations as $t)
                    <div class="lang-content {{ $loop->first ? '' : 'hidden' }}" id="lang-{{ $t->language_code }}">

                        <div class="space-y-6">

                            <div class="bg-white dark:bg-slate-900 rounded-xl shadow p-6">
                                <p class="text-xs uppercase text-slate-500 mb-1">Event Title</p>
                                <h3 class="text-2xl font-semibold">
                                    {{ $t->title }}
                                </h3>

                                @if ($t->sub_title)
                                    <p class="text-sm text-slate-500 mt-2">
                                        {{ $t->sub_title }}
                                    </p>
                                @endif
                            </div>

                            <div class="bg-slate-50 dark:bg-slate-800 rounded-xl p-6">
                                <p class="text-xs uppercase text-slate-500 mb-2">Description</p>
                                <div class="prose max-w-none">
                                    {!! $t->description ?? '<span class="text-slate-400">No description</span>' !!}
                                </div>
                            </div>

                            @if ($t->url)
                                <a href="{{ $t->url }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    SEO URL
                                </a>
                            @endif

                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        {{-- MAP --}}
        @if ($event->latitude && $event->longitude)
            <div class="card mt-8">
                <div class="card-body p-6">

                    <header class="flex mb-5 items-center border-b dark:border-slate-700 pb-4">
                        <div class="flex-1">
                            <div class="card-title">Event Location</div>
                        </div>
                        <div class="text-sm text-slate-500">
                            {{ $event->latitude }}, {{ $event->longitude }}
                        </div>
                    </header>

                    <div class="w-full h-[360px] rounded-lg overflow-hidden shadow">
                        <iframe width="100%" height="100%" style="border:0" loading="lazy"
                            src="https://www.google.com/maps?q={{ $event->latitude }},{{ $event->longitude }}&output=embed">
                        </iframe>
                    </div>

                </div>
            </div>
        @endif

    </div>


    {{-- TABS JS --}}
    <script>
        document.querySelectorAll('.lang-tab').forEach(tab => {
            tab.addEventListener('click', () => {

                document.querySelectorAll('.lang-tab').forEach(t => {
                    t.classList.remove('bg-slate-800', 'text-white')
                    t.classList.add('bg-slate-100', 'text-slate-700')
                })

                document.querySelectorAll('.lang-content').forEach(c => {
                    c.classList.add('hidden')
                })

                tab.classList.add('bg-slate-800', 'text-white')
                tab.classList.remove('bg-slate-100', 'text-slate-700')

                document.getElementById('lang-' + tab.dataset.lang)
                    .classList.remove('hidden')
            })
        })
    </script>
@endsection
