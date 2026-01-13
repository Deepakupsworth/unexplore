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

                            <div>
                                <label class="form-label">Country Name</label>
                                <input class="form-control" name="name" value="{{ old('name', $country->name) }}">
                            </div>

                            <div>
                                <label class="form-label">Country Code</label>
                                <input class="form-control" name="code" value="{{ old('code', $country->code) }}">
                            </div>

                            <div>
                                <label class="form-label">Currency Code</label>
                                <input class="form-control" name="currency_code"
                                    value="{{ old('currency_code', $country->currency_code) }}">
                            </div>

                            <div>
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ $country->status ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !$country->status ? 'selected' : '' }}>Inactive</option>
                                </select>
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
