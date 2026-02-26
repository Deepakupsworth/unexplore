@extends('backend.layout')

@section('content')


    {{-- Breadcrumb --}}
    <div class="mb-5 flex justify-between items-center">
        <div class="flex gap-2 text-sm">
            <a href="{{ route('thingtodos.index') }}" class="text-primary-500">
                <iconify-icon icon="heroicons-outline:home" />
            </a>
            <span>/</span>
            <span class="font-medium">View Thing To Do</span>
        </div>

        <a href="{{ route('thingtodos.edit', $thing->id) }}" class="btn btn-dark">
            Edit
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow overflow-hidden">

        {{-- HEADER --}}
        <div class="flex justify-between px-6 py-4 border-b dark:border-slate-700">
            <div>
                <h2 class="text-xl font-semibold capitalize">
                    {{ $thing->translation?->name }}
                </h2>
                <p class="text-sm text-slate-500 capitalize">
                    @forelse ($thing->thingCategories as $tc)
                        {{ $tc->category?->translation?->name }}
                        @if (!$loop->last)
                            ,
                        @endif
                    @empty
                        —
                    @endforelse
                </p>
            </div>

            <div>
                <a href="{{ route('admin.seo.edit', ['type' => 'todo', 'id' => $thing?->id]) }}" class="btn btn-primary">
                    Add Meta
                </a>
            </div>
        </div>

        {{-- MAIN GRID --}}
        <div class="p-6 grid grid-cols-12 gap-6">

            {{-- QUICK INFO --}}
            <div class="col-span-12 xl:col-span-6">
                <div class="card h-full">
                    <div class="card-body grid grid-cols-2 gap-6 p-4">

                        <div>
                            <p class="text-xs text-slate-500 mb-2">City</p>
                            <p class="font-medium">
                                {{ $thing->city?->translation?->name ?? '—' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-slate-500 mb-2">Categories</p>
                            <p class="font-medium">
                                @forelse ($thing->thingCategories as $tc)
                                    <span
                                        class="badge bg-success-500 text-success-500 bg-opacity-30 capitalize rounded-3xl mb-1">
                                        {{ $tc->category?->translation?->name }}</span>
                                    @if (!$loop->last)

                                    @endif
                                @empty
                                    —
                                @endforelse
                            </p>
                        </div>


                        <div>
                            <p class="text-xs text-slate-500 mb-2">Latitude</p>
                            <p class="font-medium">{{ $thing->latitude ?? '—' }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-slate-500 mb-2">Longitude</p>
                            <p class="font-medium">{{ $thing->longitude ?? '—' }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-slate-500 mb-2">Location</p>
                            <p class="font-medium">{{ $thing->location ?? '—' }}</p>
                        </div>

                        <div class="col-span-2">
                            <p class="text-xs text-slate-500 mb-2">Video URL</p>
                            @if ($thing->video_url)
                                <a href="{{ $thing->video_url }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    View Video
                                </a>
                            @else
                                <p class="font-medium">—</p>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

            {{-- THUMB + GALLERY --}}
            <div class="col-span-12 xl:col-span-6">
                <div class="card h-full">
                    <div class="card-body p-4">

                        {{-- Thumbnail --}}
                        <div class="h-[260px] bg-slate-100 dark:bg-slate-900 rounded-md overflow-hidden">
                            @if ($thing->thumb)
                                <img src="{{ Storage::url($thing->thumb->image_path) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="h-full flex items-center justify-center text-slate-400">
                                    No Image
                                </div>
                            @endif
                        </div>

                        {{-- Gallery --}}
                        @if ($thing->images && $thing->images->where('role', 'gallery')->count())
                            <div class="grid xl:grid-cols-6 lg:grid-cols-3 md:grid-cols-3 grid-cols-2 gap-4 mt-5">
                                @foreach ($thing->images->where('role', 'gallery') as $img)
                                    <img src="{{ Storage::url($img->image_path) }}"
                                        class="rounded-md border w-full h-24 object-cover hover:scale-105 transition">
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>
            </div>

        </div>

        {{-- TRANSLATIONS WITH WORKING TABS --}}
        <div class="card mt-8">
            <div class="card-body p-6">
                <h4 class="text-lg font-semibold mb-4">
                    Descriptions
                </h4>

                <div class="border rounded p-4">

                    {{-- TAB BUTTONS --}}
                    <div class="flex gap-2 mb-6">
                        @foreach ($thing->translations as $t)
                            <button type="button"
                                class="lang-tab px-4 py-2 rounded border text-sm font-medium
                                    {{ $loop->first ? 'bg-slate-800 text-white' : 'bg-slate-100 text-slate-700' }}"
                                data-lang="{{ $t->language_code }}">
                                {{ strtoupper($t->language_code) }}
                            </button>
                        @endforeach
                    </div>

                    {{-- TAB CONTENT --}}
                    @foreach ($thing->translations as $t)
                        <div class="lang-content {{ $loop->first ? '' : 'hidden' }}" id="lang-{{ $t->language_code }}">

                            <div class="space-y-6">

                                <div class="bg-white dark:bg-slate-900">
                                    <div class="mb-4">
                                        <p class="text-xs capitalize text-slate-500 mb-2">Name</p>
                                        <h3 class="text-2xl font-semibold">
                                            {{ $t->name }}
                                        </h3>
                                    </div>
                                    <div>
                                        <p class="text-xs capitalize text-slate-600 mb-2">About</p>
                                        <div class="prose max-w-none">
                                            {!! $t->about ?? '<span class="text-slate-400">No description</span>' !!}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- MAP --}}
        @if ($thing->latitude && $thing->longitude)
            <div class="card mt-8">
                <div class="card-body p-6">

                    <header class="flex mb-5 items-center border-b dark:border-slate-700 pb-4">
                        <div class="flex-1">
                            <div class="card-title">Location Map</div>
                        </div>
                        <div class="text-sm text-slate-500">
                            {{ $thing->latitude }}, {{ $thing->longitude }}
                        </div>
                    </header>

                    <div class="w-full h-[360px] rounded-lg overflow-hidden shadow">
                        <iframe width="100%" height="100%" style="border:0" loading="lazy"
                            src="https://www.google.com/maps?q={{ $thing->latitude }},{{ $thing->longitude }}&output=embed">
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
