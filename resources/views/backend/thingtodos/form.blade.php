@extends('backend.layout')
@section('content')
    <style>
        .lang-btn {
            padding: .5rem 1rem;
            border: 1px solid #cbd5e1;
            border-radius: .375rem;
            cursor: pointer
        }

        .lang-btn.active {
            background: #1e293b;
            color: #fff
        }

        .lang-section {
            display: none
        }

        .lang-section.active {
            display: block
        }
    </style>

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
                    <li>{{ $model->id ? 'Edit' : 'Add' }} Thing To Do</li>
                </ul>
            </div>

            <div class="card">
                <header class="card-header">
                    <h4>{{ $model->id ? 'Edit' : 'Add' }} Thing To Do</h4>
                </header>

                <div class="card-body p-6">

                    {{-- Errors --}}
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-300 p-4 rounded text-red-700">
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

                        {{-- LANG TABS --}}
                        <div class="flex gap-2 mb-4">
                            @foreach ($languages as $lang)
                                <button type="button" class="lang-btn {{ $loop->first ? 'active' : '' }}"
                                    data-lang="{{ strtolower($lang->code) }}">
                                    {{ strtoupper($lang->code) }}
                                </button>
                            @endforeach
                        </div>

                        {{-- LANG SECTIONS --}}
                        @foreach ($languages as $lang)
                            @php
                                $code = strtolower($lang->code);
                                $trans = $model->translations->where('language_code', $code)->first();
                            @endphp

                            <div class="lang-section {{ $loop->first ? 'active' : '' }}" id="lang-{{ $code }}">

                                <div class="mb-3">
                                    <label>Name ({{ strtoupper($code) }}) @if ($code == 'en')
                                            *
                                        @endif
                                    </label>
                                    <input class="form-control" name="translations[{{ $code }}][name]"
                                        value="{{ old("translations.$code.name", $trans->name ?? '') }}"
                                        {{ $code == 'en' ? 'required' : '' }}>
                                </div>

                                <div class="mb-4">
                                    <label>About ({{ strtoupper($code) }})</label>
                                    <textarea class="form-control" name="translations[{{ $code }}][about]">{{ old("translations.$code.about", $trans->about ?? '') }}</textarea>
                                </div>

                            </div>
                        @endforeach

                        {{-- City --}}
                        <div class="mt-4">
                            <label>City</label>
                            <select name="city_id" class="form-control" required>
                                <option value="">-- Select City --</option>
                                @foreach ($cities as $id => $name)
                                    <option value="{{ $id }}"
                                        {{ old('city_id', $model->city_id) == $id ? 'selected' : '' }}>
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


                        <input type="hidden" name="slug" value="{{ old('slug', $model->slug) }}">

                        {{-- THUMB --}}
                        <div class="mt-4">
                            <label>Thumb Image</label>
                            <input type="file" name="thumb_image" class="form-control">

                            @if ($model->thumb)
                                <img src="{{ asset('storage/' . $model->thumb->image_path) }}"
                                    class="w-14 h-14 mt-2 rounded border object-cover">
                            @endif
                        </div>

                        {{-- GALLERY --}}
                        <div class="mt-4">
                            <label>Gallery Images</label>
                            <input type="file" name="gallery_images[]" multiple class="form-control">

                            @if ($model->gallery->count())
                                <div class="flex gap-2 mt-3">
                                    @foreach ($model->gallery as $img)
                                        <img src="{{ asset('storage/' . $img->image_path) }}"
                                            class="w-14 h-14 rounded object-cover border">
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <button class="btn btn-dark mt-6">
                            {{ $model->id ? 'Update' : 'Create' }}
                        </button>

                    </form>
                </div>
            </div>
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
