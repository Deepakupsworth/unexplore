@extends('backend.layout')

@section('content')

    {{-- Breadcrumb --}}
    <div class="mb-5">
        <ul class="flex items-center gap-2 text-sm">
            <li class="text-primary-500">
                <a href="{{ url('/admin/dashboard') }}">
                    <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                </a>
            </li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-700 font-medium">
                <a href="{{ route('admin.tags.index') }}">Tags</a>
            </li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-700 font-medium">
                {{ $model->exists ? 'Edit' : 'Create' }}
            </li>
        </ul>
    </div>

    <div class="card">

        {{-- HEADER --}}
        <header class="card-header">
            <h4 class="card-title">
                {{ $model->exists ? 'Edit Tag' : 'Create Tag' }}
            </h4>
        </header>

        {{-- BODY --}}
        <div class="card-body p-4">

            <form method="POST"
                  action="{{ route('admin.tags.save') }}"
                  class="max-w-xl">

                @csrf

                {{-- hidden id for update --}}
                <input type="hidden" name="id" value="{{ $model->id }}">

                {{-- TAG NAME --}}
                <div class="fromGroup mb-5">
                    <label class="form-label">
                        Tag Name <span class="text-danger-500">*</span>
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name', $model->name) }}"
                           class="form-control"
                           placeholder="Enter tag name"
                           required>

                    @error('name')
                        <span class="text-danger-500 text-sm mt-1 block">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- ACTION BUTTONS --}}
                <div class="flex gap-3">
                    <button type="submit" class="btn btn-dark">
                        {{ $model->exists ? 'Update Tag' : 'Save Tag' }}
                    </button>

                    <a href="{{ route('admin.tags.index') }}"
                       class="btn btn-outline-secondary">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

@endsection
