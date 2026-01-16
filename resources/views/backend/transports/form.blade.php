@extends('backend.layout')
@section('content')

    <div class="content-wrapper ltr:ml-[248px] rtl:mr-[248px]">
        <div class="page-content container-fluid">

            {{-- Breadcrumb --}}
            <div class="mb-6 flex justify-between items-center">
                <h4 class="text-xl font-semibold">
                    {{ $model->id ? 'Edit Transport' : 'Add Transport' }}
                </h4>
                <a href="{{ route('transports.index') }}" class="btn btn-outline-dark">← Back</a>
            </div>

            {{-- Errors --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-300 rounded text-red-700">
                    <ul class="list-disc ml-6">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('transports.save') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $model->id }}">

                <div class="grid grid-cols-12 gap-6">

                    {{-- LEFT --}}
                    <div class="col-span-8">
                        <div class="card p-4">
                            <div class="card-body space-y-6">

                                <h5 class="font-semibold text-slate-700 border-b pb-2">Transport Details</h5>
                                <div class="grid grid-cols-2 gap-4">

                                    {{-- City --}}
                                    <div>
                                        <label class="form-label">City</label>
                                        <select name="city_id" class="form-control">
                                            <option value="">Select City</option>
                                            @foreach ($cities as $id => $name)
                                                <option value="{{ $id }}"
                                                    {{ old('city_id', $model->city_id) == $id ? 'selected' : '' }}>
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Transport Type --}}
                                    <div>
                                        <label class="form-label">Transport Type</label>
                                        <select name="type" class="form-control" required>
                                            <option value="">Select Transport Type</option>

                                            @foreach ($types as $type)
                                                <option value="{{ $type->value }}"
                                                    {{ old('type', $model->type) == $type->value ? 'selected' : '' }}>
                                                    {{ $type->label() }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="form-label">Capacity</label>
                                        <input type="number" name="capacity" class="form-control"
                                            value="{{ old('capacity', $model->capacity) }}">
                                    </div>

                                    <div>
                                        <label class="form-label">Contact Number</label>
                                        <input name="contact_number" class="form-control"
                                            value="{{ old('contact_number', $model->contact_number) }}">
                                    </div>
                                </div>

                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="status" value="1"
                                        {{ old('status', $model->status) ? 'checked' : '' }}>
                                    Active
                                </label>

                                <hr>

                                {{-- LANGUAGE SWITCH --}}
                                <div class="flex gap-2 border-b pb-3">
                                    @foreach ($languages as $lang)
                                        <button type="button"
                                            class="lang-btn px-4 py-2 rounded-md border text-sm font-medium
        {{ $loop->first ? 'bg-slate-800 text-white' : 'bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300' }}"
                                            data-lang="{{ strtolower($lang->code) }}">
                                            {{ strtoupper($lang->code) }}
                                        </button>
                                    @endforeach
                                </div>

                                {{-- TRANSLATIONS --}}
                                @foreach ($languages as $lang)
                                    @php
                                        $code = strtolower($lang->code);
                                        $trans = $model->translations->where('language_code', $code)->first();
                                    @endphp

                                    <div class="lang-section {{ $loop->first ? 'block' : 'hidden' }}"
                                        id="lang-{{ $code }}">

                                        <div class="mt-4">
                                            <label class="form-label">Name ({{ strtoupper($code) }})</label>
                                            <input name="translations[{{ $code }}][name]" class="form-control"
                                                value="{{ old("translations.$code.name", $trans->name ?? '') }}"
                                                {{ $code == 'en' ? 'required' : '' }}>
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
                    <div class="col-span-4">
                        <div class="card p-4">
                            <div class="card-body space-y-6">

                                <h5 class="font-semibold border-b pb-2">Media</h5>

                                <div>
                                    <label class="form-label">Thumbnail</label>
                                    <input type="file" name="thumb" class="form-control">
                                    @if ($model->thumb)
                                        <img src="{{ asset('storage/' . $model->thumb->image_path) }}"
                                            class="mt-3 w-28 rounded border">
                                    @endif
                                </div>

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

                                <button class="btn btn-dark w-full">
                                    {{ $model->id ? 'Update Transport' : 'Create Transport' }}
                                </button>

                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script>
        document.querySelectorAll('.lang-btn').forEach(btn => {
            btn.onclick = () => {
                document.querySelectorAll('.lang-btn').forEach(b => {
                    b.classList.remove('bg-slate-800', 'text-white')
                    b.classList.add('bg-white', 'dark:bg-slate-800', 'text-slate-700',
                        'dark:text-slate-300')
                })
                document.querySelectorAll('.lang-section').forEach(s => s.classList.add('hidden'))

                btn.classList.add('bg-slate-800', 'text-white')
                document.getElementById('lang-' + btn.dataset.lang).classList.remove('hidden')
            }
        })
    </script>

@endsection
