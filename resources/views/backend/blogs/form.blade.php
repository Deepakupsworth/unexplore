@extends('backend.layout')
@section('content')
    <style>
        .lang-btn {
            padding: .5rem 1rem;
            border: 1px solid #cbd5e1;
            border-radius: .375rem;
            font-size: .875rem;
            font-weight: 500;
            cursor: pointer;
        }

        .lang-btn.active {
            background: #1e293b;
            color: #fff;
        }

        .lang-section {
            display: none
        }

        .lang-section.active {
            display: block
        }
    </style>

    <div class="card">
        <header class="card-header">
            <h4 class="card-title">
                {{ $model->id ? 'Edit Blog' : 'Add Blog' }}
            </h4>
        </header>

        <div class="card-body p-6">

            <form action="{{ route('admin.blogs.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $model->id }}">

                {{-- ================= LANGUAGE TABS ================= --}}
                <div class="flex gap-2 mb-4">
                    @foreach ($languages as $lang)
                        @php
                            $code = strtolower($lang->code);
                            $hasError = $errors->has("translations.$code.title");
                        @endphp

                        <button type="button" class="lang-btn {{ $loop->first || $hasError ? 'active' : '' }}"
                            data-lang="{{ $code }}">
                            {{ strtoupper($code) }}
                        </button>
                    @endforeach
                </div>

                {{-- ================= LANGUAGE FIELDS ================= --}}
                @foreach ($languages as $lang)
                    @php
                        $code = strtolower($lang->code);
                        $trans = $model->translations->where('language_code', $code)->first();
                        $hasError = $errors->has("translations.$code.title");
                    @endphp

                    <div class="lang-section {{ $loop->first || $hasError ? 'active' : '' }}" id="lang-{{ $code }}">

                        {{-- TITLE --}}
                        <label class="form-label">
                            Title ({{ strtoupper($code) }})
                            @if ($code == 'en')
                                <span class="text-red-500">*</span>
                            @endif
                        </label>

                        <input name="translations[{{ $code }}][title]"
                            class="form-control @error("translations.$code.title") border-red-500 @enderror"
                            value="{{ old("translations.$code.title", $trans->title ?? '') }}"
                            {{ $code == 'en' ? 'required' : '' }}>

                        @error("translations.$code.title")
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        {{-- CONTENT (EDITOR) --}}
                        <label class="form-label mt-4">Content</label>

                        <textarea name="translations[{{ $code }}][content]" class="form-control editor" rows="8">{{ old("translations.$code.content", $trans->content ?? '') }}</textarea>

                    </div>
                @endforeach

                <hr class="my-6">

                {{-- ================= PUBLISH ================= --}}
                <div class="mb-4">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="is_published" value="1"
                            {{ old('is_published', $model->is_published) ? 'checked' : '' }}>
                        <span>Publish Blog</span>
                    </label>
                </div>

                {{-- ================= THUMB ================= --}}
                <div>
                    <label class="form-label">Thumb Image</label>
                    <input type="file" name="thumb_image" class="form-control">
                    @if ($model->thumb?->image_path)
                        <img src="{{ asset('storage/' . $model->thumb->image_path) }}"
                            class="w-[80px] h-[80px] object-cover rounded border mt-2">
                    @endif
                </div>

                <div class="mt-6 flex gap-3">
                    <button class="btn btn-dark">
                        {{ $model->id ? 'Update' : 'Create' }}
                    </button>

                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>

    {{-- ================= JS FIX ================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ✅ language tabs
            document.querySelectorAll('.lang-btn').forEach(btn => {
                btn.addEventListener('click', function() {

                    document.querySelectorAll('.lang-btn').forEach(b => b.classList.remove(
                        'active'));
                    document.querySelectorAll('.lang-section').forEach(s => s.classList.remove(
                        'active'));

                    this.classList.add('active');

                    const lang = this.dataset.lang;
                    const section = document.getElementById('lang-' + lang);
                    if (section) section.classList.add('active');
                });
            });

        });
    </script>
@endsection
