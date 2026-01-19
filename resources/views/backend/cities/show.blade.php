@extends('backend.layout')

@section('content')

    {{-- Breadcrumb --}}
    <div class="mb-5 flex justify-between items-center">
        <div class="flex gap-2 text-sm">
            <a href="{{ route('cities.index') }}" class="text-primary-500">
                <iconify-icon icon="heroicons-outline:home" />
            </a>
            <span>/</span>
            <span class="font-medium">View City</span>
        </div>

        <a href="{{ route('cities.edit', $city->id) }}" class="btn btn-dark">
            Edit City
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-4 border-b dark:border-slate-700">
            <h2 class="text-xl font-semibold">
                {{ $city->translation?->name ?? 'City' }}
            </h2>
            <p class="text-sm text-slate-500">
                Slug: {{ $city->slug }}
            </p>
        </div>

        {{-- MAIN GRID --}}
        <div class="p-6 grid grid-cols-12 gap-6">

            {{-- QUICK INFO --}}
            <div class="col-span-12 xl:col-span-6">
                <div class="card h-full">
                    <div class="card-body grid grid-cols-2 gap-6 p-4">

                        <div>
                            <p class="text-xs text-slate-500">City Name (EN)</p>
                            <p class="font-medium">
                                {{ optional($city->translations->where('language_code', 'en')->first())->name ?? '—' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-slate-500">Slug</p>
                            <p class="font-medium">{{ $city->slug }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-slate-500">Category</p>
                            <p class="font-medium">
                                {{ $city->category?->translation?->name ?? '—' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-slate-500">Country</p>
                            <p class="font-medium">
                                {{ $city->country?->name ?? '—' }}
                            </p>
                        </div>


                        <div class="col-span-2">
                            <p class="text-xs text-slate-500">Video URL</p>
                            @if ($city->video_url)
                                <a href="{{ $city->video_url }}" target="_blank" class="text-primary-600 underline text-sm">
                                    View Video
                                </a>
                            @else
                                <p class="font-medium">—</p>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

            {{-- THUMB --}}
            <div class="col-span-12 xl:col-span-6">
                <div class="card h-full">
                    <div class="card-body p-4">

                        <div class="h-[260px] bg-slate-100 dark:bg-slate-900 rounded-md overflow-hidden">
                            @if ($city->thumb_image)
                                <img src="{{ asset('storage/' . $city->thumb_image) }}" class="w-full h-full object-cover">
                            @else
                                <div class="h-full flex items-center justify-center text-slate-400">
                                    No Image
                                </div>
                            @endif
                        </div>

                        @if ($city->gallery && $city->gallery->count())
                            <div class="grid xl:grid-cols-6 lg:grid-cols-3 md:grid-cols-3 grid-cols-2 gap-4 mt-5">
                                @foreach ($city->gallery as $img)
                                    <img src="{{ Storage::url($img->image_path) }}"
                                        class="rounded-md border w-full h-24 object-cover">
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>
            </div>

        </div>

        {{-- TRANSLATIONS --}}
        <div class="card mt-8">
            <div class="card-body p-6">

                <h4 class="text-lg font-semibold mb-4">
                    City Translations
                </h4>

                {{-- TAB BUTTONS --}}
                <div class="flex gap-2 mb-6">
                    @foreach ($city->translations as $t)
                        <button type="button"
                            class="lang-tab px-4 py-2 rounded border text-sm font-medium
                                {{ $loop->first ? 'bg-slate-800 text-white' : 'bg-slate-100 text-slate-700' }}"
                            data-lang="{{ $t->language_code }}">
                            {{ strtoupper($t->language_code) }}
                        </button>
                    @endforeach
                </div>

                {{-- TAB CONTENT --}}
                @foreach ($city->translations as $t)
                    <div class="lang-content {{ $loop->first ? '' : 'hidden' }}" id="lang-{{ $t->language_code }}">

                        <div class="space-y-6">

                            <div class="bg-white dark:bg-slate-900 rounded-xl shadow p-6">
                                <div class="mb-4">
                                    <p class="text-xs uppercase text-slate-500 mb-1">City Name</p>
                                    <h3 class="text-2xl font-semibold">
                                        {{ $t->name }}
                                    </h3>
                                </div>
                                <div>
                                    <p class="text-xs uppercase text-slate-500 mb-1">Tagline</p>
                                    @if ($t->tagline)
                                        <p class="text-sm text-slate-500 mt-2">
                                            {{ $t->tagline }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="bg-slate-50 dark:bg-slate-800 rounded-xl p-6">
                                <p class="text-xs uppercase text-slate-500 mb-2">About</p>
                                <div class="prose max-w-none">
                                    {!! $t->about ?? '<span class="text-slate-400">No description</span>' !!}
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach



            </div>
        </div>

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
