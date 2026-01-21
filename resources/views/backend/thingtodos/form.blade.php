@extends('backend.layout')

@section('content')
    <style>
        .lang-btn {
            padding: .5rem 1rem;
            border: 1px solid #cbd5e1;
            border-radius: .5rem;
            cursor: pointer;
            font-size: 14px;
            background: #f8fafc
        }

        .lang-btn.active {
            background: #1e293b;
            color: #fff;
            border-color: #1e293b
        }

        .lang-section {
            display: none
        }

        .lang-section.active {
            display: block
        }
    </style>



    {{-- Breadcrumb --}}
    <div class="mb-6">
        <ul class="flex gap-2 text-sm text-slate-600">
            <li>
                <a href="{{ route('thingtodos.index') }}">
                    <iconify-icon icon="heroicons-outline:home" />
                </a>
            </li>
            <li>/</li>
            <li class="font-medium">{{ $model->id ? 'Edit' : 'Add' }} Thing To Do</li>
        </ul>
    </div>

    <div class="card">
        <header class="card-header">
            <h4 class="card-title">
                {{ $model->id ? 'Edit' : 'Add' }} Thing To Do
            </h4>
        </header>

        <div class="card-body p-6">

            {{-- Errors --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 p-4 rounded-lg text-red-700">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('thingtodos.save') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $model->id }}">
                <input type="hidden" name="slug" value="{{ old('slug', $model->slug) }}">

                {{-- LANGUAGE TABS --}}
                <div class="flex gap-2 mb-6">
                    @foreach ($languages as $lang)
                        <button type="button" class="lang-btn {{ $loop->first ? 'active' : '' }}"
                            data-lang="{{ strtolower($lang->code) }}">
                            {{ strtoupper($lang->code) }}
                        </button>
                    @endforeach
                </div>

                {{-- LANGUAGE SECTIONS --}}
                @foreach ($languages as $lang)
                    @php
                        $code = strtolower($lang->code);
                        $trans = $model->translations->where('language_code', $code)->first();
                    @endphp

                    <div class="lang-section {{ $loop->first ? 'active' : '' }}" id="lang-{{ $code }}">

                        <div class="bg-slate-50 border rounded-xl p-5 mb-6">
                            <div class="mb-4">
                                <label class="form-label">
                                    Name ({{ strtoupper($code) }})
                                    @if ($code == 'en')
                                        <span class="text-red-500">*</span>
                                    @endif
                                </label>
                                <input class="form-control" name="translations[{{ $code }}][name]"
                                    value="{{ old("translations.$code.name", $trans->name ?? '') }}"
                                    {{ $code == 'en' ? 'required' : '' }}>
                            </div>

                            <div>
                                <label class="form-label">
                                    About ({{ strtoupper($code) }})
                                </label>
                                <textarea class="form-control" name="translations[{{ $code }}][about]" rows="4">{{ old("translations.$code.about", $trans->about ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- BASIC INFO --}}
                <div class="bg-slate-50 border rounded-xl p-5 mb-6">
                    <h5 class="font-semibold text-slate-700 mb-4">Basic Information</h5>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="form-label">City *</label>
                            <select name="city_id" class="form-control" required>
                                <option value="">Select City</option>
                                @foreach ($cities as $id => $name)
                                    <option value="{{ $id }}"
                                        {{ old('city_id', $model->city_id) == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="form-label">Category *</label>
                            <select name="category_id" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $model->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->translation?->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- LOCATION --}}
                <div class="bg-slate-50 border rounded-xl p-5 mb-6">
                    <h5 class="font-semibold text-slate-700 mb-4">Location</h5>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="form-label">Latitude</label>
                            <input type="text" name="latitude" value="{{ old('latitude', $model->latitude) }}"
                                class="form-control" placeholder="25.5941">
                        </div>

                        <div>
                            <label class="form-label">Longitude</label>
                            <input type="text" name="longitude" value="{{ old('longitude', $model->longitude) }}"
                                class="form-control" placeholder="85.1376">
                        </div>
                    </div>
                </div>

                {{-- OPENING HOURS --}}
                <div class="bg-slate-50 border rounded-xl p-5 mb-6">
                    <h5 class="font-semibold text-slate-700 mb-4">Opening Hours</h5>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="form-label">Opening Time</label>
                            <input type="time" name="opening_time"
                                value="{{ old('opening_time', $model->opening_time) }}" class="form-control">
                        </div>

                        <div>
                            <label class="form-label">Closing Time</label>
                            <input type="time" name="closing_time"
                                value="{{ old('closing_time', $model->closing_time) }}" class="form-control">
                        </div>
                    </div>
                </div>

                {{-- MEDIA --}}
                <div class="bg-slate-50 border rounded-xl p-5 mb-6">
                    <h5 class="font-semibold text-slate-700 mb-4">Media</h5>

                    <div class="mb-4">
                        <label class="form-label">Thumb Image</label>
                        <input type="file" name="thumb_image" class="form-control">

                        @if ($model->thumb)
                            <img src="{{ asset('storage/' . $model->thumb->image_path) }}"
                                class="w-20 h-20 mt-3 rounded-lg border object-cover">
                        @endif
                    </div>
                    <x-admin.form.gallery :model="$model" deleteRoute="{{ route('gallery.delete', ':id') }}" />
                </div>

                {{-- SUBMIT --}}
                <div class="flex justify-end">
                    <button class="btn btn-dark px-8 py-2 rounded-lg">
                        {{ $model->id ? 'Update Thing' : 'Create Thing' }}
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        document.querySelectorAll('.lang-btn').forEach(btn => {
            btn.onclick = () => {
                document.querySelectorAll('.lang-btn').forEach(b => b.classList.remove('active'))
                document.querySelectorAll('.lang-section').forEach(s => s.classList.remove('active'))
                btn.classList.add('active')
                document.getElementById('lang-' + btn.dataset.lang).classList.add('active')
            }
        })
    </script>
@endsection
