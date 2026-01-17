@extends('backend.layout')

@section('content')
    <div class="content-wrapper ltr:ml-[248px] rtl:mr-[248px]">
        <div class="page-content container-fluid">

            {{-- Breadcrumb --}}
            <div class="mb-5 flex justify-between items-center">
                <h4 class="text-xl font-semibold">View Transport</h4>

                <a href="{{ route('transports.edit', $transport->id) }}" class="btn btn-dark">
                    Edit Transport
                </a>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg overflow-hidden">

                {{-- Header --}}
                <div class="px-6 py-4 border-b dark:border-slate-700">
                    <h2 class="text-xl font-semibold">
                        {{ $transport->translations->first()->name ?? 'Transport' }}
                    </h2>
                    <p class="text-sm text-slate-500">
                        {{ $transport->city?->slug }}
                    </p>
                </div>

                <div class="p-6 grid grid-cols-12 gap-6">

                    {{-- Left --}}
                    <div class="col-span-12 xl:col-span-6">

                        {{-- Meta --}}

                        <div class="card h-full">
                            <div class="card-body grid grid-cols-3 gap-6 p-4">
                                <div>
                                    <p class="text-xs text-slate-500">Type</p>
                                    <p class="font-medium">{{ $transport->type }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500">Capacity</p>
                                    <p class="">{{ $transport->capacity }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500">Contact Number</p>
                                    <p class="">{{ $transport->contact_number }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 mb-2">Status</p>
                                    <span
                                        class="badge {{ $transport->status ? 'bg-success-500' : 'bg-danger-500' }} text-white">
                                        {{ $transport->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right --}}

                    {{-- Translations --}}
                    {{-- <div>
                        <h4 class="text-lg font-semibold mb-3">Translations</h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($transport->translations as $t)
                                <div class="border dark:border-slate-700 rounded-lg p-4 bg-slate-50 dark:bg-slate-900">
                                    <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded">
                                        {{ strtoupper($t->language_code) }}
                                    </span>
                                    <h5 class="mt-2 font-semibold">{{ $t->name }}</h5>
                                    <div class="text-sm mt-2 text-slate-600">
                                        {!! $t->description ?? '' !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div> --}}

                    {{-- Gallery --}}

                    <div class="col-span-12 xl:col-span-6">
                        <div class="card h-full">
                            <div class="card-body p-4">

                                {{-- Image --}}
                                <div class="h-[260px] bg-slate-100 dark:bg-slate-900 rounded-t-md overflow-hidden">
                                    @if ($transport->thumb)
                                        <img src="{{ Storage::url($transport->thumb->image_path) }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div class="h-full flex items-center justify-center text-slate-400">
                                            No Image
                                        </div>
                                    @endif
                                </div>

                                <div class="card-text h-full mt-4">
                                    <div class="grid xl:grid-cols-6 lg:grid-cols-3 md:grid-cols-3 grid-cols-1 gap-5">
                                        @if ($transport->images && $transport->images->count())
                                            @foreach ($transport->images as $img)
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
                {{-- Translations --}}
                <div class="card mt-8">
                    <div class="card-body flex flex-col p-6">

                        <header
                            class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                            <div class="flex-1">
                                <div class="card-title text-slate-900 dark:text-white">
                                    Transport Descriptions
                                </div>
                            </div>
                        </header>

                        <div class="card-text h-full">

                            {{-- Tabs --}}
                            <ul class="nav nav-tabs flex flex-col md:flex-row flex-wrap list-none border-b-0 pl-0 mb-4"
                                id="hotel-lang-tabs" role="tablist">

                                @foreach ($transport->translations as $t)
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

                                @foreach ($transport->translations as $t)
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                        id="lang-{{ $t->language_code }}">

                                        <div class="space-y-6">

                                            {{-- Hotel Title --}}
                                            <div class="bg-white dark:bg-slate-900 rounded-xl shadow p-6">
                                                <p class="text-xs uppercase tracking-wide text-slate-500 mb-1">
                                                    Transport Name
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
        </div>
    </div>
@endsection
