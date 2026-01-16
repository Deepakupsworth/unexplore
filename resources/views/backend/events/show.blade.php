@extends('backend.layout')

@section('content')
    <div class="content-wrapper ltr:ml-[248px] rtl:mr-[248px]">
        <div class="page-content container-fluid">

            {{-- Breadcrumb --}}
            <div class="mb-5 flex justify-between items-center">
                <ul class="flex gap-2 text-sm">
                    <li>
                        <a href="{{ route('events.index') }}">
                            <iconify-icon icon="heroicons-outline:home" />
                        </a>
                    </li>
                    <li>/</li>
                    <li class="font-medium">View Event</li>
                </ul>

                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-dark">
                    Edit Event
                </a>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg overflow-hidden">

                {{-- Header --}}
                <div class="px-6 py-4 border-b dark:border-slate-700">
                    <h2 class="text-xl font-semibold">
                        {{ $event->translations->first()->title ?? 'Event' }}
                    </h2>
                    <p class="text-sm text-slate-500">
                        {{ $event->city?->slug }}
                    </p>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">

                    {{-- Left --}}
                    <div class="space-y-6">

                        {{-- Thumbnail --}}
                        <div>
                            <p class="text-sm font-semibold mb-2">Thumbnail</p>
                            @if ($event->thumb)
                                <img src="{{ Storage::url($event->thumb->image_path) }}"
                                    class="w-full h-52 object-cover rounded-lg shadow">
                            @else
                                <div
                                    class="w-full h-52 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400">
                                    No Image
                                </div>
                            @endif
                        </div>

                        {{-- Meta --}}
                        <div class="bg-slate-50 dark:bg-slate-900 p-4 rounded-lg space-y-3">
                            <div>
                                <p class="text-xs text-slate-500">Start Date</p>
                                <p class="font-medium">{{ $event->start_date ?? '—' }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-slate-500">End Date</p>
                                <p class="font-medium">{{ $event->end_date ?? '—' }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-slate-500">Status</p>
                                <p class="font-medium">
                                    {{ $event->status ? 'Active' : 'Inactive' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Right --}}
                    <div class="md:col-span-2 space-y-6">

                        {{-- Translations --}}
                        <div>
                            <h4 class="text-lg font-semibold mb-3">Event Translations</h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($event->translations as $t)
                                    <div class="border dark:border-slate-700 rounded-lg p-4 bg-slate-50 dark:bg-slate-900">
                                        <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded">
                                            {{ strtoupper($t->language_code) }}
                                        </span>
                                        <h5 class="mt-2 font-semibold">{{ $t->title }}</h5>
                                        <div class="text-sm mt-2 text-slate-600">
                                            {!! $t->description ?? '' !!}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Gallery --}}
                        @if ($event->images && $event->images->count())
                            <div>
                                <h4 class="text-lg font-semibold mb-3">Gallery</h4>
                                <div class="grid grid-cols-3 md:grid-cols-6 gap-3">
                                    @foreach ($event->images as $img)
                                        <img src="{{ Storage::url($img->image_path) }}"
                                            class="w-full h-24 object-cover rounded-lg hover:scale-105 transition shadow">
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
