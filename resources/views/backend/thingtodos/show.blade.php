@extends('backend.layout')

@section('content')
<div class="content-wrapper ltr:ml-[248px] rtl:mr-[248px]">
    <div class="page-content container-fluid">

        {{-- Breadcrumb --}}
        <div class="mb-5">
            <ul class="flex gap-2 text-sm">
                <li>
                    <a href="{{ route('thingtodos.index') }}">
                        <iconify-icon icon="heroicons-outline:home" />
                    </a>
                </li>
                <li>/</li>
                <li>View Thing To Do</li>
            </ul>
        </div>
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg overflow-hidden">

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b dark:border-slate-700">
                <div>
                    <h2 class="text-xl font-semibold text-slate-800 dark:text-white">
                        {{ $thing->translation?->name }}
                    </h2>
                    <p class="text-sm text-slate-500">Thing To Do Details</p>
                </div>

                <a href="{{ route('thingtodos.edit',$thing->id) }}"
                   class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Edit
                </a>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Left Column --}}
                <div class="space-y-6">

                    {{-- Thumbnail --}}
                    <div>
                        <p class="text-sm font-semibold text-slate-600 mb-2">Thumbnail</p>
                        @if($thing->thumb->image_path)
                            <img src="{{ asset('storage/'.$thing->thumb->image_path) }}"
                                 class="w-full h-48 object-cover rounded-lg shadow">
                        @else
                            <div class="w-full h-48 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400">
                                No Image
                            </div>
                        @endif
                    </div>

                    {{-- Meta --}}
                    <div class="bg-slate-50 dark:bg-slate-900 p-4 rounded-lg space-y-3">
                        <div>
                            <p class="text-xs text-slate-500">City</p>
                            <p class="font-medium">{{ $thing->city?->translation?->name }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-slate-500">Category</p>
                            <p class="font-medium">{{ $thing->category?->translation?->name }}</p>
                        </div>
                    </div>
                </div>

                {{-- Right Column --}}
                <div class="md:col-span-2 space-y-6">

                    {{-- Translations --}}
                    <div>
                        <h4 class="text-lg font-semibold mb-3">Translations</h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($thing->translations as $t)
                                <div class="border dark:border-slate-700 rounded-lg p-4 bg-slate-50 dark:bg-slate-900">
                                    <span class="inline-block text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded mb-2">
                                        {{ strtoupper($t->language_code) }}
                                    </span>
                                    <h5 class="font-semibold">{{ $t->name }}</h5>
                                    <div class="text-sm mt-2 text-slate-600 dark:text-slate-400">
                                        {!! $t->about !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Gallery --}}
                    @if($thing->images && $thing->images->where('role','gallery')->count())
                        <div>
                            <h4 class="text-lg font-semibold mb-3">Gallery</h4>
                            <div class="grid grid-cols-3 md:grid-cols-6 gap-3">
                                @foreach($thing->images->where('role','gallery') as $img)
                                    <img src="{{ Storage::url($img->image_path) }}"
                                         class="w-full h-24 object-cover rounded-lg hover:scale-105 transition cursor-pointer shadow">
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
