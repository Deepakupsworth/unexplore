@extends('backend.layout')
@section('content')
    <div class="content-wrapper ltr:ml-[248px] rtl:mr-[248px]">
        <div class="page-content container-fluid">

            <form action="{{ route('events.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $model->id }}">

                <div class="grid grid-cols-12 gap-6">

                    {{-- LEFT --}}
                    <div class="xl:col-span-8 col-span-12">
                        <div class="card">
                            <div class="card-body p-6 space-y-6">

                                {{-- LANGUAGE TABS --}}
                                <div class="flex gap-2">
                                    @foreach ($languages as $lang)
                                        <button type="button"
                                            class="lang-btn px-4 py-2 border rounded {{ $loop->first ? 'bg-slate-800 text-white' : '' }}"
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
                                        <div>
                                            <label>Title ({{ strtoupper($code) }})</label>
                                            <input class="form-control" name="translations[{{ $code }}][title]"
                                                value="{{ old("translations.$code.title", $trans->title ?? '') }}"
                                                {{ $code == 'en' ? 'required' : '' }}>
                                        </div>

                                        <div class="mt-3">
                                            <label>Sub Title</label>
                                            <input class="form-control" name="translations[{{ $code }}][sub_title]"
                                                value="{{ old("translations.$code.sub_title", $trans->sub_title ?? '') }}">
                                        </div>

                                        <div class="mt-3">
                                            <label>SEO URL</label>
                                            <input class="form-control" name="translations[{{ $code }}][url]"
                                                value="{{ old("translations.$code.url", $trans->url ?? '') }}">
                                        </div>


                                    </div>
                                @endforeach

                                <hr>

                                {{-- BASIC INFO --}}
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label>City</label>
                                        <select name="city_id" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($cities as $id => $name)
                                                <option value="{{ $id }}"
                                                    {{ old('city_id', $model->city_id) == $id ? 'selected' : '' }}>
                                                    {{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label>Capacity</label>
                                        <input class="form-control" name="capacity"
                                            value="{{ old('capacity', $model->capacity) }}">
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label>Start Date</label>
                                        <input type="date" class="form-control" name="start_date"
                                            value="{{ old('start_date', $model->start_date) }}">
                                    </div>
                                    <div>
                                        <label>End Date</label>
                                        <input type="date" class="form-control" name="end_date"
                                            value="{{ old('end_date', $model->end_date) }}">
                                    </div>
                                </div>

                                <div>
                                    <label>Opening Days</label>
                                    <input class="form-control" name="opening_days"
                                        value="{{ old('opening_days', $model->opening_days) }}">
                                </div>

                                <div>
                                    <label>Video URL</label>
                                    <input class="form-control" name="video_url"
                                        value="{{ old('video_url', $model->video_url) }}">
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- RIGHT --}}
                    <div class="xl:col-span-4 col-span-12">
                        <div class="card">
                            <div class="card-body p-6">

                                <label>Thumbnail</label>
                                <input type="file" name="thumb" class="form-control mb-4">
                                @if ($model->thumb)
                                    <img src="{{ asset('storage/' . $model->thumb->image_path) }}" class="mt-3 w-24">
                                @endif

                                <label class="mt-4">Gallery</label>
                                <input type="file" name="gallery[]" multiple class="form-control">
                                <div class="grid grid-cols-4 gap-3 mt-3 mb-4">
                                    @foreach ($model->gallery as $img)
                                        <img src="{{ asset('storage/' . $img->image_path) }}" class="h-16 w-16 rounded">
                                    @endforeach
                                </div>
                                <div class="mt-3">
                                    <label>Description</label>
                                    <textarea class="form-control" name="translations[{{ $code }}][description]">{{ old("translations.$code.description", $trans->description ?? '') }}</textarea>
                                </div>
                                <button class="btn btn-dark w-full mt-6">
                                    {{ $model->id ? 'Update Event' : 'Create Event' }}
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
                document.querySelectorAll('.lang-btn').forEach(b => b.classList.remove('bg-slate-800',
                    'text-white'))
                document.querySelectorAll('.lang-section').forEach(s => s.classList.add('hidden'))
                btn.classList.add('bg-slate-800', 'text-white')
                document.getElementById('lang-' + btn.dataset.lang).classList.remove('hidden')
            }
        })
    </script>
@endsection
