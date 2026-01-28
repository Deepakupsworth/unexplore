@extends('backend.layout')
@section('content')
    <style>
        #file-preview img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .lang-btn {
            padding: 0.5rem 1rem;
            border: 1px solid #cbd5e1;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
        }

        .lang-btn:hover {
            background-color: #f1f5f9
        }

        .lang-btn.active {
            background-color: #1e293b;
            color: #fff
        }

        .lang-section {
            display: none
        }

        .lang-section.active {
            display: block
        }
    </style>

    <div class="card">
        <div class="card-body p-4">
            <form action="{{ route('cities.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $model->id }}">

                {{-- Country --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="input-area mb-4">
                        <label class="form-label">Country <span class="text-red-500">*</span></label>
                        <select name="country_id" class="form-control" required>
                            <option value="">Select Country</option>
                            @foreach ($countries as $id => $name)
                                <option value="{{ $id }}"
                                    {{ old('country_id', $model->country_id) == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Category --}}
                    <div>
                        <label class="form-label">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select name="category_ids[]" class="form-control select2" multiple required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ in_array(
                                        $category->id,
                                        old(
                                            'category_ids',
                                            $model->categories->pluck('id')->toArray()
                                        )
                                    ) ? 'selected' : '' }}>
                                    {{ $category->translation?->name }}
                                </option>
                            @endforeach
                        </select>



                    </div>
                </div>

                {{-- Language Buttons --}}
                <div class="flex gap-2 mb-4">
                    @foreach ($languages as $lang)
                        <button type="button" class="lang-btn {{ $loop->first ? 'active' : '' }}"
                            data-lang="{{ strtolower($lang->code) }}">
                            {{ strtoupper($lang->name) }}
                        </button>
                    @endforeach
                </div>

                {{-- Language Sections --}}
                @foreach ($languages as $lang)
                    @php
                        $code = strtolower($lang->code);
                        $trans = $model->translations->where('language_code', $code)->first();
                    @endphp

                    <div class="lang-section {{ $loop->first ? 'active' : '' }}" id="lang-section-{{ $code }}">

                        <div class="input-area">
                            <label class="form-label">Name ({{ strtoupper($code) }}) <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="translations[{{ $code }}][name]" class="form-control"
                                value="{{ old("translations.$code.name", $trans->name ?? '') }}"
                                {{ $code == 'en' ? 'required' : '' }}>
                        </div>

                        <div class="input-area">
                            <label class="form-label">Tagline</label>
                            <input class="form-control" name="translations[{{ $code }}][tagline]"
                                value="{{ old("translations.$code.tagline", $trans->tagline ?? '') }}">
                        </div>

                        <div class="input-area">
                            <label class="form-label">About</label>
                            <textarea class="form-control" name="translations[{{ $code }}][about]">{{ old("translations.$code.about", $trans->about ?? '') }}</textarea>
                        </div>

                    </div>
                @endforeach

                <input type="hidden" name="slug" value="{{ old('slug', $model->slug) }}">

                {{-- Media --}}
                <div class="input-area mt-4">
                    <label class="form-label">Video URL</label>
                    <input type="url" name="video_url" class="form-control"
                        value="{{ old('video_url', $model->video_url) }}">
                </div>

                <div class="input-area mt-4">
                    <label class="form-label">Thumb Image</label>
                    <input type="file" name="thumb_image" class="form-control">
                    @if ($model->thumb_image)
                        <img src="{{ asset('storage/' . $model->thumb_image) }}" class="w-20 h-20 mt-2 rounded">
                    @endif
                </div>
                {{-- Gallery --}}
                <x-admin.form.gallery :model="$model" deleteRoute="{{ route('gallery.delete', ':id') }}" />

                <button class="btn btn-dark mt-6">
                    {{ $model->id ? 'Update City' : 'Create City' }}
                </button>

            </form>

        </div>
    </div>

    <script>
        document.querySelectorAll('.lang-btn').forEach(btn => {
            btn.onclick = () => {
                document.querySelectorAll('.lang-btn').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.lang-section').forEach(s => s.classList.remove('active'));
                btn.classList.add('active');
                document.getElementById('lang-section-' + btn.dataset.lang).classList.add('active');
            };
        });
    </script>
@endsection
