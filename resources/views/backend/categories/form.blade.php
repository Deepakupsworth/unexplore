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
        <header class="card-header">
            <h4 class="card-title">{{ $model->id ? 'Edit Category' : 'Add Category' }}</h4>
        </header>

        <div class="card-body p-6">

            <form action="{{ route('categories.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $model->id }}">

                {{-- LANGUAGE TABS --}}
                <div class="flex gap-2 mb-4">
                    @foreach ($languages as $lang)
                        @php
                            $hasError = $errors->has("translations.$lang->code.name");
                        @endphp
                        <button type="button" class="lang-btn {{ $loop->first || $hasError ? 'active' : '' }}"
                            data-lang="{{ $lang->code }}">
                            {{ strtoupper($lang->code) }}
                        </button>
                    @endforeach
                </div>

                {{-- LANGUAGE FIELDS --}}
                @foreach ($languages as $lang)
                    @php
                        $code = strtolower($lang->code);
                        $trans = $model->translations->where('language_code', $code)->first();
                        $hasError = $errors->has("translations.$code.name");
                    @endphp

                    <div class="lang-section {{ $loop->first || $hasError ? 'active' : '' }}" id="lang-{{ $code }}">

                        <label class="form-label">
                            Name ({{ strtoupper($code) }})
                            @if ($code == 'en')
                                <span class="text-red-500">*</span>
                            @endif
                        </label>

                        <input name="translations[{{ $code }}][name]"
                            class="form-control @error("translations.$code.name") border-red-500 @enderror"
                            value="{{ old("translations.$code.name", $trans->name ?? '') }}"
                            {{ $code == 'en' ? 'required' : '' }}>

                        @error("translations.$code.name")
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                    </div>
                @endforeach

                {{-- CATEGORY TYPE --}}
                <hr class="my-6">

                <div>
                    <label class="form-label">Category Type <span class="text-red-500">*</span></label>

                    <select name="type" class="form-control selectCountrySelect2" required>
                        <option value="">Select Type</option>

                        @foreach ($types as $type)
                            <option value="{{ $type->value }}"
                                {{ old('type', $model->type?->value) === $type->value ? 'selected' : '' }}>
                                {{ $type->label() }}
                            </option>
                        @endforeach
                    </select>

                    @error('type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                @php
                $selectedTags = $model?->tags->pluck('id')->toArray() ?? [];
            @endphp

            <div class="mb-6 mt-4">
                <label class="form-label mb-2 block">Tags</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach ($tags as $tag)
                        <x-admin.form.checkbox name="tags[]" :value="$tag->id" :checked="in_array($tag->id, $selectedTags)" :label="$tag->name" />
                    @endforeach
                </div>

            </div>
                {{-- MEDIA --}}
                <hr class="my-6">

                <div>
                    <label class="form-label">Thumb Image</label>
                    <input type="file" name="thumb_image" class="form-control">
                    @if ($model->thumb_image)
                        <img src="{{ asset('storage/' . $model->thumb_image) }}"
                            class="w-[60px] h-[60px] object-cover rounded border mt-2">
                    @endif
                    @error('thumb_image')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <label class="form-label">Thumb Icon</label>
                    <input type="file" name="thumb_icon" class="form-control">
                    @if ($model->thumb_icon)
                        <img src="{{ asset('storage/' . $model->thumb_icon) }}"
                            class="w-[60px] h-[60px] object-cover rounded border mt-2">
                    @endif
                    @error('thumb_icon')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6 flex gap-3">
                    <button class="btn btn-dark">{{ $model->id ? 'Update' : 'Create' }}</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
                </div>

            </form>
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
