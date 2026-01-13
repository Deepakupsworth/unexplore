@extends('backend.layout')
@section('content')
    <div class="content-wrapper ltr:ml-[248px] rtl:mr-[248px]">
        <div class="page-content container-fluid">

            <div class="card">
                <header class="card-header">
                    <h4 class="card-title">
                        {{ $country->id ? 'Edit Country' : 'Add Country' }}
                    </h4>
                </header>

                <div class="card-body max-w-3xl p-4">

                    <form method="POST"
                        action="{{ $country->id ? route('admin.countries.update', $country->id) : route('admin.countries.store') }}">
                        @csrf
                        @if ($country->id)
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-2 gap-5">

                            {{-- Country Name --}}
                            <div>
                                <label class="form-label">
                                    Country Name <span class="text-red-500">*</span>
                                </label>
                                <input class="form-control @error('name') border-red-500 ring-1 ring-red-500 @enderror"
                                    name="name" value="{{ old('name', $country->name) }}">

                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Country Code --}}
                            <div>
                                <label class="form-label">
                                    Country Code <span class="text-red-500">*</span>
                                </label>
                                <input class="form-control @error('code') border-red-500 ring-1 ring-red-500 @enderror"
                                    name="code" value="{{ old('code', $country->code) }}">

                                @error('code')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Currency Code --}}
                            <div>
                                <label class="form-label">
                                    Currency Code <span class="text-red-500">*</span>
                                </label>
                                <input
                                    class="form-control @error('currency_code') border-red-500 ring-1 ring-red-500 @enderror"
                                    name="currency_code" value="{{ old('currency_code', $country->currency_code) }}">

                                @error('currency_code')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div>
                                <label class="form-label">Status</label>
                                <select name="status"
                                    class="form-control @error('status') border-red-500 ring-1 ring-red-500 @enderror">

                                    <option value="1" {{ old('status', $country->status) == 1 ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="0" {{ old('status', $country->status) == 0 ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>

                                @error('status')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>


                        <div class="mt-6 flex gap-3">
                            <button class="btn btn-dark">
                                {{ $country->id ? 'Update Country' : 'Create Country' }}
                            </button>
                            <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
