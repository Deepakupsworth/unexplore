@extends('backend.layout')

@section('content')
    <style>
        .lang-btn {
            padding: .45rem 1rem;
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

        .error-input {
            border-color: #ef4444 !important;
        }

        .error-text {
            color: #dc2626;
            font-size: 12px;
            margin-top: 4px;
        }
    </style>

    {{-- Breadcrumb --}}
    <form action="{{ route('events.save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $model->id }}">

        <div class="grid grid-cols-12 gap-6">

            {{-- LEFT --}}
            <div class="xl:col-span-8 col-span-12 space-y-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- TRANSLATIONS --}}
                <div class="card">
                    <div class="card-body p-6 space-y-4">
                        <div class="flex gap-2">
                            @foreach ($languages as $lang)
                                <button type="button" class="lang-btn {{ $loop->first ? 'active' : '' }}"
                                    data-lang="{{ strtolower($lang->code) }}">
                                    {{ strtoupper($lang->code) }}
                                </button>
                            @endforeach
                        </div>

                        @foreach ($languages as $lang)
                            @php
                                $code = strtolower($lang->code);
                                $trans = $model->translations->where('language_code', $code)->first();
                            @endphp

                            <div class="lang-section {{ $loop->first ? '' : 'hidden' }}" id="lang-{{ $code }}">
                                <div class="space-y-4">

                                    {{-- TITLE --}}
                                    <div class="fromGroup">
                                        <label class="form-label">Title ({{ strtoupper($code) }}) *</label>
                                        <input class="form-control @error("translations.$code.title") error-input @enderror"
                                            name="translations[{{ $code }}][title]"
                                            value="{{ old("translations.$code.title", $trans->title ?? '') }}"
                                            {{ $code == 'en' ? 'required' : '' }}>
                                        @error("translations.$code.title")
                                            <p class="error-text">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- SUB TITLE --}}
                                    <div>
                                        <label class="form-label">Sub Title</label>
                                        <input
                                            class="form-control @error("translations.$code.sub_title") error-input @enderror"
                                            name="translations[{{ $code }}][sub_title]"
                                            value="{{ old("translations.$code.sub_title", $trans->sub_title ?? '') }}">
                                        @error("translations.$code.sub_title")
                                            <p class="error-text">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- DESCRIPTION --}}
                                    <div>
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control editor @error("translations.$code.description") error-input @enderror" rows="4"
                                            name="translations[{{ $code }}][description]">{{ old("translations.$code.description", $trans->description ?? '') }}</textarea>
                                        @error("translations.$code.description")
                                            <p class="error-text">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- SEO URL --}}
                                    <div>
                                        <label class="form-label">SEO URL *</label>
                                        <input class="form-control @error("translations.$code.url") error-input @enderror"
                                            name="translations[{{ $code }}][url]"
                                            value="{{ old("translations.$code.url", $trans->url ?? '') }}">
                                        @error("translations.$code.url")
                                            <p class="error-text">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- BASIC INFO --}}
                <div class="card">
                    <div class="card-body p-6">
                        <h5 class="font-semibold mb-4">Basic Information</h5>

                        <div class="grid grid-cols-2 gap-4">

                            <x-admin.form.select label="City" name="city_id" :options="$cities" :selected="$model->city_id"
                                required />

                            {{-- <x-admin.form.category-select label="Event Category" :categories="$categories" :selected="$model->category_id"
                                required /> --}}
                            <x-admin.form.category-select label="Event Categories" :categories="$categories" name="category_ids"
                                :selected="$model?->eventCategories->pluck('category_id')->toArray()" multiple required />


                            <x-admin.form.input label="Capacity" name="capacity" :value="old('capacity', $model->capacity)" />

                            <x-admin.form.input label="Location" name="location" :value="old('location', $model->location)" />
                        </div>
                    </div>
                </div>

                {{-- DATE & TIME --}}
                <div class="card">
                    <div class="card-body p-6">
                        <h5 class="font-semibold mb-4">Date & Timing</h5>
                        <div class="grid grid-cols-2 gap-4">
                            <x-admin.form.input type="date" label="Start Date" name="start_date" :value="old('start_date', $model->start_date)" />
                            <x-admin.form.input type="date" label="End Date" name="end_date" :value="old('end_date', $model->end_date)" />
                            <x-admin.form.input type="time" label="Opening Time" name="opening_time" :value="old(
                                'opening_time',
                                $model->opening_time ? substr($model->opening_time, 0, 5) : '',
                            )" />

                            <x-admin.form.input type="time" label="Closing Time" name="closing_time" :value="old(
                                'closing_time',
                                $model->closing_time ? substr($model->closing_time, 0, 5) : '',
                            )" />

                            <x-admin.form.input label="Opening Days" name="opening_days" :value="old('opening_days', $model->opening_days)" />
                        </div>
                    </div>
                </div>

                {{-- MAP --}}
                <div class="card">
                    <div class="card-body p-6">
                        <h5 class="font-semibold mb-4">Map Location</h5>

                        <div class="grid grid-cols-2 gap-4">
                            <x-admin.form.input label="Latitude" name="latitude" :value="old('latitude', $model->latitude)" />
                            <x-admin.form.input label="Longitude" name="longitude" :value="old('longitude', $model->longitude)" />

                        </div>
                    </div>
                </div>

            </div>

            {{-- RIGHT --}}
            <div class="xl:col-span-4 col-span-12 space-y-6">
                <div class="card">
                    <div class="card-body p-6 space-y-4">

                        <div class="fromGroup">
                            <label class="form-label">Thumbnail</label>
                            <input type="file" class="form-control @error('thumb') error-input @enderror" name="thumb">
                            @error('thumb')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                            @if ($model->thumb)
                                <img src="{{ asset('storage/' . $model->thumb->image_path) }}" class="mt-3 w-24 rounded">
                            @endif
                        </div>

                        <x-admin.form.gallery :model="$model" deleteRoute="{{ route('gallery.delete', ':id') }}" />

                        <div>
                            <label class="form-label">Video URL</label>
                            <input class="form-control @error('video_url') error-input @enderror" name="video_url"
                                value="{{ old('video_url', $model->video_url) }}">
                            @error('video_url')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">Ticket URL</label>
                            <input class="form-control @error('url') error-input @enderror" name="url"
                                value="{{ old('url', $model->url) }}">
                            @error('url')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control @error('status') error-input @enderror">
                                <option value="1" {{ old('status', $model->status) == 1 ? 'selected' : '' }}>
                                    Active</option>
                                <option value="0" {{ old('status', $model->status) == 0 ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                            @error('status')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>
                        @php
                         $selectedTags = $model?->tags->pluck('id')->toArray() ?? [];
                        @endphp

                        <div class="mb-6">
                            <label class="form-label mb-2 block">Tags</label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach ($tags as $tag)
                                    <x-admin.form.checkbox
                                        name="tags[]"
                                        :value="$tag->id"
                                        :checked="in_array($tag->id, $selectedTags)"
                                        :label="$tag->name"
                                    />
                                @endforeach
                            </div>

                        </div>

                        <button class="btn btn-dark w-full mt-4">
                            {{ $model->id ? 'Update Event' : 'Create Event' }}
                        </button>

                    </div>
                </div>
            </div>

        </div>
    </form>

    <script>
        document.querySelectorAll('.lang-btn').forEach(btn => {
            btn.onclick = () => {
                document.querySelectorAll('.lang-btn').forEach(b => b.classList.remove('active'))
                document.querySelectorAll('.lang-section').forEach(s => s.classList.add('hidden'))
                btn.classList.add('active')
                document.getElementById('lang-' + btn.dataset.lang).classList.remove('hidden')
            }
        })
    </script>
@endsection
