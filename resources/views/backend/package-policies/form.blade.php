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
    <div class="mb-5">
        <ul class="flex items-center gap-2">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                </a>
            </li>
            <li>/</li>
            <li class="font-medium">Package Policies</li>
        </ul>
    </div>

    <form method="POST" action="{{ route('admin.package-policies.save') }}">
        @csrf

        {{-- 🔥 THIS LINE WAS MISSING --}}
        <input type="hidden" name="id" value="{{ $policy->id }}">


        <div class="grid grid-cols-12 gap-6">

            {{-- LEFT --}}
            <div class="xl:col-span-8 col-span-12 space-y-6">

                {{-- ERRORS --}}
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

                        {{-- LANGUAGE TABS --}}
                        <div class="flex gap-2">
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
                                $trans = $policy->translations->where('language_code', $code)->first();
                            @endphp

                            <div class="lang-section {{ $loop->first ? '' : 'hidden' }}" id="lang-{{ $code }}">

                                <div class="space-y-4">

                                    {{-- CONTENT (ONLY FIELD) --}}
                                    <div>
                                        <label class="form-label">
                                            Policy Content ({{ strtoupper($code) }})
                                        </label>

                                        <textarea
                                            class="form-control editor
                                            @error("content.$code") error-input @enderror"
                                            rows="6" name="content[{{ $code }}]">{{ old("content.$code", $trans->content ?? '') }}</textarea>

                                        @error("content.$code")
                                            <p class="error-text">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="xl:col-span-4 col-span-12 space-y-6">
                <div class="card">
                    <div class="card-body p-6 space-y-4">

                        {{-- STATUS --}}
                        <div>
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control @error('status') error-input @enderror">
                                <option value="1" {{ old('status', $policy->status) == 1 ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="0" {{ old('status', $policy->status) == 0 ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>

                            @error('status')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <button class="btn btn-dark w-full mt-4">
                            {{ $policy->id ? 'Update Policy' : 'Create Policy' }}
                        </button>

                    </div>
                </div>
            </div>

        </div>
    </form>

    {{-- LANGUAGE TAB SCRIPT --}}
    <script>
        document.querySelectorAll('.lang-btn').forEach(btn => {
            btn.onclick = () => {
                document.querySelectorAll('.lang-btn')
                    .forEach(b => b.classList.remove('active'))
                document.querySelectorAll('.lang-section')
                    .forEach(s => s.classList.add('hidden'))

                btn.classList.add('active')
                document.getElementById('lang-' + btn.dataset.lang)
                    .classList.remove('hidden')
            }
        })
    </script>
@endsection
