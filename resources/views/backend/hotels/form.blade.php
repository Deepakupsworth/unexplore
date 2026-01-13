@extends('backend.layout')
@section('content')
    <div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]">
        <div class="page-content">
            <div class="container-fluid">

                {{-- Breadcrumb --}}
                <div class="mb-5">
                    <ul class="m-0 p-0 list-none flex gap-2 items-center">
                        <li class="text-primary-500">
                            <a href="{{ route('hotels.index') }}">
                                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                            </a>
                        </li>
                        <li class="text-slate-500">/</li>
                        <li class="text-slate-700 font-medium">
                            {{ $model->id ? 'Edit Hotel' : 'Add Hotel' }}
                        </li>
                    </ul>
                </div>

                {{-- Global validation errors --}}
                @if ($errors->any())
                    <div class="mb-5 p-4 bg-red-100 border border-red-300 rounded text-red-700">
                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('hotels.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $model->id }}">

                    <div class="grid grid-cols-12 gap-6">

                        {{-- LEFT --}}
                        <div class="xl:col-span-8 col-span-12">
                            <div class="card">
                                <div class="card-body p-6 space-y-6">

                                    <h4 class="text-lg font-semibold">Hotel Information</h4>

                                    <div class="grid grid-cols-2 gap-4">
                                        {{-- City --}}
                                        <div>
                                            <label class="form-label">City <span class="text-red-500">*</span></label>
                                            <select name="city_id"
                                                class="form-control @error('city_id') border-red-500 @enderror">
                                                <option value="">Select City</option>
                                                @foreach ($cities as $id => $name)
                                                    <option value="{{ $id }}"
                                                        {{ old('city_id', $model->city_id) == $id ? 'selected' : '' }}>
                                                        {{ $name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('city_id')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- Stars --}}
                                        <div>
                                            <label class="form-label">Star Rating</label>
                                            <select name="star_rating" class="form-control">
                                                <option value="">None</option>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ old('star_rating', $model->star_rating) == $i ? 'selected' : '' }}>
                                                        {{ $i }} Star
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Checkboxes --}}
                                    <div class="flex gap-6 mt-4">
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" name="has_meal" value="1"
                                                {{ old('has_meal', $model->has_meal) ? 'checked' : '' }}>
                                            Has Meal
                                        </label>

                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" name="status" value="1"
                                                {{ old('status', $model->status) ? 'checked' : '' }}>
                                            Active
                                        </label>
                                    </div>

                                    <hr>

                                    {{-- Language Tabs --}}
                                    <div class="flex gap-2">
                                        @foreach ($languages as $lang)
                                            <button type="button"
                                                class="lang-btn px-4 py-2 border rounded {{ $loop->first ? 'bg-slate-800 text-white' : '' }}"
                                                data-lang="{{ strtolower($lang->code) }}">
                                                {{ strtoupper($lang->code) }}
                                            </button>
                                        @endforeach
                                    </div>

                                    {{-- Language Forms --}}
                                    @foreach ($languages as $lang)
                                        @php
                                            $code = strtolower($lang->code);
                                            $trans = $model->translations->where('language_code', $code)->first();
                                        @endphp

                                        <div class="lang-section {{ $loop->first ? 'block' : 'hidden' }}"
                                            id="lang-{{ $code }}">

                                            <div class="mt-4">
                                                <label class="form-label">
                                                    Hotel Name ({{ strtoupper($code) }})
                                                    @if ($code == 'en')
                                                        <span class="text-red-500">*</span>
                                                    @endif
                                                </label>
                                                <input
                                                    class="form-control @error("translations.$code.name") border-red-500 @enderror"
                                                    name="translations[{{ $code }}][name]"
                                                    value="{{ old("translations.$code.name", $trans->name ?? '') }}"
                                                    {{ $code == 'en' ? 'required' : '' }}>
                                                @error("translations.$code.name")
                                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mt-3">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control h-32" name="translations[{{ $code }}][description]">{{ old("translations.$code.description", $trans->description ?? '') }}</textarea>
                                            </div>

                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                        {{-- RIGHT --}}
                        <div class="xl:col-span-4 col-span-12">
                            <div class="card">
                                <div class="card-body p-6 space-y-6">

                                    <h4 class="text-lg font-semibold">Media</h4>

                                    {{-- Thumb --}}
                                    <div>
                                        <label class="form-label">Thumbnail</label>
                                        <input type="file" name="thumb" class="form-control">
                                        @if ($model->thumb)
                                            <img src="{{ asset('storage/' . $model->thumb->image_path) }}"
                                                class="mt-3 w-24 rounded border">
                                        @endif
                                    </div>

                                    {{-- Gallery --}}
                                    <div>
                                        <label class="form-label">Gallery</label>
                                        <input type="file" name="gallery[]" multiple class="form-control">
                                        <div class="grid grid-cols-4 gap-3 mt-3">
                                            @foreach ($model->gallery as $img)
                                                <img src="{{ asset('storage/' . $img->image_path) }}"
                                                    class="h-16 w-16 object-cover rounded border">
                                            @endforeach
                                        </div>
                                    </div>

                                    <button class="btn btn-dark w-full mt-6">
                                        {{ $model->id ? 'Update Hotel' : 'Create Hotel' }}
                                    </button>

                                </div>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.lang-btn').forEach(btn => {
            btn.onclick = () => {
                document.querySelectorAll('.lang-btn').forEach(b => b.classList.remove('bg-slate-800',
                    'text-white'))
                document.querySelectorAll('.lang-section').forEach(s => s.classList.add('hidden'))
                btn.classList.add('bg-slate-800', 'text-white')
                document.getElementById('lang-' + btn.dataset.lang).classList.remove('hidden')
            }
        })
    </script>
@endsection
