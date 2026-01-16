@extends('backend.layout')

@section('content')
    <div class="content-wrapper ltr:ml-[248px] rtl:mr-[248px]">
        <div class="page-content container-fluid">

            {{-- Breadcrumb --}}
            <div class="mb-5 flex justify-between items-center">
                <div class="flex gap-2 text-sm">
                    <a href="{{ route('hotels.index') }}" class="text-primary-500">
                        <iconify-icon icon="heroicons-outline:home" />
                    </a>
                    <span>/</span>
                    <span class="font-medium">View Hotel</span>
                </div>

                <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-dark">
                    Edit Hotel
                </a>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-xl shadow overflow-hidden">

                {{-- Header --}}
                <div class="px-6 py-4 border-b dark:border-slate-700">
                    <h2 class="text-xl font-semibold">
                        {{ $hotel->translations->first()->name ?? 'Hotel' }}
                    </h2>
                    <p class="text-sm text-slate-500">{{ $hotel->city?->slug }}</p>
                </div>

                {{-- Main Grid --}}
                <div class="p-6 grid grid-cols-12 gap-6">

                    {{-- QUICK INFO --}}
                    <div class="col-span-12 xl:col-span-6">
                        <div class="card h-full">

                            <div class="card-body grid grid-cols-2 gap-6 p-4">

                                <div>
                                    <p class="text-xs text-slate-500">Stars</p>
                                    <div class="flex items-center gap-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <iconify-icon icon="heroicons:star-solid"
                                                style="color: {{ $i <= $hotel->star_rating ? '#facc15' : '#cbd5e1' }};"
                                                width="18">
                                            </iconify-icon>
                                        @endfor
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500">Meal</p>
                                    <p class="font-medium">{{ $hotel->has_meal ? 'Included' : 'No' }}</p>
                                </div>

                                <div>
                                    <p class="text-xs text-slate-500">Status</p>
                                    <span
                                        class="badge {{ $hotel->status ? 'bg-success-500' : 'bg-danger-500' }} text-white">
                                        {{ $hotel->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500">City</p>
                                    <p class="font-medium">{{ $hotel->city?->slug ?? '—' }}</p>
                                </div>

                                <div>
                                    <p class="text-xs text-slate-500">Email</p>
                                    <p class="font-medium">{{ $hotel->email ?? '—' }}</p>
                                </div>

                                <div>
                                    <p class="text-xs text-slate-500">Phone</p>
                                    <p class="font-medium">{{ $hotel->phone ?? '—' }}</p>
                                </div>

                                <div>
                                    <p class="text-xs text-slate-500">Location</p>
                                    <p class="font-medium">{{ $hotel->location ?? '—' }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- THUMB + BASIC INFO --}}
                    <div class="col-span-12 xl:col-span-6">
                        <div class="card h-full">
                            <div class="card-body p-4">

                                {{-- Image --}}
                                <div class="h-[260px] bg-slate-100 dark:bg-slate-900 rounded-t-md overflow-hidden">
                                    @if ($hotel->thumb)
                                        <img src="{{ Storage::url($hotel->thumb->image_path) }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div class="h-full flex items-center justify-center text-slate-400">
                                            No Image
                                        </div>
                                    @endif
                                </div>

                                <div class="card-text h-full mt-4">
                                    <div class="grid xl:grid-cols-6 lg:grid-cols-3 md:grid-cols-3 grid-cols-1 gap-5">
                                        @if ($hotel->images && $hotel->images->count())
                                            @foreach ($hotel->images as $img)
                                                <img src="{{ Storage::url($img->image_path) }}"
                                                    class="rounded-md border-4 border-slate-300 max-w-full w-full block"
                                                    alt="image">
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>


                {{-- End Grid --}}

                {{-- Translations --}}
                <div class="card mt-8">
                    <div class="card-body flex flex-col p-6">

                        <header
                            class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                            <div class="flex-1">
                                <div class="card-title text-slate-900 dark:text-white">
                                    Hotel Descriptions
                                </div>
                            </div>
                        </header>

                        <div class="card-text h-full">

                            {{-- Tabs --}}
                            <ul class="nav nav-tabs flex flex-col md:flex-row flex-wrap list-none border-b-0 pl-0 mb-4"
                                id="hotel-lang-tabs" role="tablist">

                                @foreach ($hotel->translations as $t)
                                    <li class="nav-item" role="presentation">
                                        <a href="#lang-{{ $t->language_code }}"
                                            class="nav-link w-full block font-medium text-sm leading-tight capitalize
                            border-x-0 border-t-0 border-b border-transparent px-4 pb-2 my-2
                            {{ $loop->first ? 'active' : '' }} dark:text-slate-300"
                                            id="tab-{{ $t->language_code }}" data-bs-toggle="pill"
                                            data-bs-target="#lang-{{ $t->language_code }}" role="tab"
                                            aria-controls="lang-{{ $t->language_code }}"
                                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                            {{ strtoupper($t->language_code) }}
                                        </a>
                                    </li>
                                @endforeach

                            </ul>

                            {{-- Tab Content --}}
                            <div class="tab-content" id="hotel-lang-tabsContent">

                                @foreach ($hotel->translations as $t)
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                        id="lang-{{ $t->language_code }}">

                                        <div class="space-y-6">

                                            {{-- Hotel Title --}}
                                            <div class="bg-white dark:bg-slate-900 rounded-xl shadow p-6">
                                                <p class="text-xs uppercase tracking-wide text-slate-500 mb-1">
                                                    Hotel Name
                                                </p>
                                                <h3 class="text-2xl font-semibold text-slate-900 dark:text-white">
                                                    {{ $t->name }}
                                                </h3>
                                            </div>

                                            {{-- Description --}}
                                            <div class="bg-slate-50 dark:bg-slate-800 rounded-xl p-6">
                                                <p class="text-xs uppercase tracking-wide text-slate-500 mb-2">
                                                    Description
                                                </p>
                                                <div
                                                    class="prose max-w-none text-slate-700 dark:text-slate-300 leading-relaxed">
                                                    {!! $t->description ?? '<span class="text-slate-400">No description provided</span>' !!}
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                @endforeach

                            </div>



                        </div>

                    </div>
                </div>

                @if ($hotel->latitude && $hotel->longitude)
                    <div class="card mt-8">
                        <div class="card-body p-6">

                            <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-4">
                                <div class="flex-1">
                                    <div class="card-title text-slate-900 dark:text-white">
                                        Hotel Location
                                    </div>
                                </div>
                                <div class="text-sm text-slate-500">
                                    {{ $hotel->latitude }}, {{ $hotel->longitude }}
                                </div>
                            </header>

                            <div class="w-full h-[360px] rounded-lg overflow-hidden shadow">
                                <iframe width="100%" height="100%" style="border:0" loading="lazy" allowfullscreen
                                    referrerpolicy="no-referrer-when-downgrade"
                                    src="https://www.google.com/maps?q={{ $hotel->latitude }},{{ $hotel->longitude }}&output=embed">
                                </iframe>
                            </div>

                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-sm text-slate-500">
                                    {{ $hotel->location }}
                                </span>

                                <a target="_blank"
                                    href="https://www.google.com/maps?q={{ $hotel->latitude }},{{ $hotel->longitude }}"
                                    class="btn btn-outline-primary btn-sm">
                                    Open in Google Maps
                                </a>
                            </div>

                        </div>
                    </div>
                @endif

            </div>
        </div>

        <script>
            document.querySelectorAll('.lang-tab').forEach(tab => {
                tab.addEventListener('click', () => {

                    document.querySelectorAll('.lang-tab').forEach(t => {
                        t.classList.remove('text-primary-500', 'before:w-full')
                        t.classList.add('text-slate-500', 'dark:text-slate-300', 'before:w-0')
                    })

                    document.querySelectorAll('.lang-content').forEach(c => c.classList.add('hidden'))

                    tab.classList.add('text-primary-500', 'before:w-full')
                    tab.classList.remove('text-slate-500', 'dark:text-slate-300', 'before:w-0')

                    document.getElementById('lang-' + tab.dataset.lang).classList.remove('hidden')
                })
            })
        </script>

    @endsection
