@extends('backend.layout')

@section('content')
    {{-- ================= HEADER ================= --}}

    <div class="mb-5">
        <ul class="flex items-center gap-2 text-sm">
            <li class="text-primary-500">
                <a href="{{ url('/admin/dashboard') }}">
                    <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                </a>
            </li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-700 font-medium">Transport</li>
        </ul>
    </div>

    {{-- ================= TABLE ================= --}}

    <div class="card">
        <header class="card-header flex justify-between items-center">
            <h4 class="card-title">Packages</h4>
            <a href="{{ route('admin.packages.create') }}" class="btn btn-dark">
                + Create Package
            </a>
        </header>
        <div class="card-body p-0 overflow-x-auto">
            {{-- ================= FILTERS ================= --}}
            <form method="GET" class="mb-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">

                    {{-- 🔍 Search --}}
                    <div class="fromGroup">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title..."
                        class="form-control">
                    </div>


                    {{-- 📦 Package Type --}}
                    <select name="package_type" class="form-control">
                        <option value="">All Types</option>
                        <option value="fixed" @selected(request('package_type') == 'fixed')>Fixed</option>
                        <option value="customized" @selected(request('package_type') == 'customized')>Customized</option>
                    </select>

                    {{-- ⚡ Status --}}
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="active" @selected(request('status') == 'active')>Active</option>
                        <option value="inactive" @selected(request('status') == 'inactive')>Inactive</option>
                        <option value="draft" @selected(request('status') == 'draft')>Draft</option>
                    </select>
                </div>

                {{-- 🎯 Actions --}}

                <div class="flex justify-end gap-2 mt-4">
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-outline-secondary">
                        Reset
                    </a>
                    <button class="btn btn-dark">
                        Search
                    </button>
                </div>
            </form>

            <table class="min-w-full border-collapse text-sm">
                <thead class="bg-slate-200 dark:bg-slate-700">
                    <tr class="text-left text-slate-600">
                        <th class="table-th">#</th>
                        <th scope="col" class="table-th">Thumb</th>
                        <th class="table-th">Title</th>
                        <th class="table-th">Category</th>
                        <th class="table-th">Type</th>
                        <th class="table-th">Duration</th>
                        <th class="table-th">Status</th>
                        <th class="table-th">Actions</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                    @forelse($packages as $index => $package)
                        <tr class="even:bg-slate-50 dark:even:bg-slate-700">
                            {{-- Row Number --}}
                            <td class="table-td">
                                {{ $packages->firstItem() + $index }}
                            </td>

                            <td class="table-td">
                                @if ($package->thumb)
                                    <img src="{{ asset('storage/' . $package->thumb->image_path) }}"
                                        class="w-12 h-12 rounded object-cover">
                                @else
                                    <span class="text-xs text-slate-400">No Image</span>
                                @endif
                            </td>
                            {{-- Title --}}
                            <td class="table-td">
                                {{ $package->translation->title ?? '—' }}
                            </td>

                            {{-- Category --}}
                            <td class="table-td">
                                {{ $package->category?->translation?->name ?? '—' }}
                            </td>

                            {{-- Type --}}
                            <td class="table-td capitalize">
                                {{ $package->package_type }}
                            </td>

                            {{-- Duration --}}
                            <td class="table-td">
                                {{ $package->duration_days }}D /
                                {{ $package->duration_nights }}N
                            </td>

                            {{-- Status --}}
                            <td class="table-td">
                                {!! status_badge($package->status) !!}
                            </td>

                            {{-- Actions --}}
                            <td class="table-td flex  gap-2 items-center">
                                <a href="{{ route('admin.packages.show', $package->id) }}"
                                    class="action-btn bg-blue-100 text-blue-700">
                                    <iconify-icon icon="heroicons:eye"></iconify-icon>
                                </a>
                                <a href="{{ route('admin.packages.edit', $package) }}" class="action-btn">
                                    <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                </a>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-10 text-slate-400">
                                No packages found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

    {{-- ================= PAGINATION ================= --}}
    <div class="mt-4">
        {{ $packages->links() }}
    </div>
@endsection
