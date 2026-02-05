@extends('backend.layout')

@section('content')
    <!-- Breadcrumb -->
    <div class="mb-5">
        <ul class="m-0 p-0 list-none flex items-center gap-2">
            <li class="text-primary-500">
                <a href="{{ route('admin.dashboard') }}">
                    <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                </a>
            </li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-700 font-medium">Package Policies</li>
        </ul>
    </div>

    <div class="card">
        <!-- Header -->
        <header class="card-header flex justify-between items-center">
            <h4 class="card-title">Package Policies</h4>
            <a href="{{ route('admin.package-policies.form') }}" class="btn btn-dark">
                + Add Policy
            </a>
        </header>

        <!-- Filters -->
        <div class="card-body px-6 pb-6">
            <form method="GET" class="mb-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">

                    {{-- Status --}}
                    <div class="fromGroup">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="">All</option>
                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <a href="{{ route('admin.package-policies.index') }}" class="btn btn-outline-secondary">
                        Reset
                    </a>
                    <button class="btn btn-dark">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="card">
            <div class="card-body p-0 overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-700">
                    <thead class="bg-slate-200 dark:bg-slate-700">
                        <tr class="text-left text-slate-600">
                            <th class="table-th">#</th>
                            <th class="table-th">Policy Content (Preview)</th>
                            <th class="table-th">Status</th>
                            <th class="table-th text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white dark:bg-slate-800 divide-y divide-slate-100 dark:divide-slate-700">

                        @forelse($policies as $index => $policy)
                            <tr>
                                <td class="table-td">
                                    {{ $policies->firstItem() + $index }}
                                </td>

                                {{-- CONTENT PREVIEW --}}
                                <td class="table-td">
                                    <div class="line-clamp-3 text-slate-700 dark:text-white">
                                        {!! $policy->translation->content ?? '—' !!}
                                    </div>
                                </td>

                                {{-- STATUS --}}
                                <td class="table-td">
                                    {!! status_badge($policy->status) !!}
                                </td>

                                {{-- ACTION --}}
                                <td class="table-td">
                                    <div class="flex gap-2 justify-end items-center">
                                        <a href="{{ route('admin.package-policies.form', $policy->id) }}"
                                            class="action-btn">
                                            <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                        </a>

                                        <form method="POST"
                                            action="{{ route('admin.package-policies.destroy', $policy->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Delete this policy?')" class="action-btn">
                                                <iconify-icon icon="heroicons:trash"></iconify-icon>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-10 text-slate-400">
                                    No policies found
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

                <div class="mt-6 px-6">
                    {{ $policies->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
