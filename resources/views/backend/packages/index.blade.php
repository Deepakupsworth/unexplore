@extends('backend.layout')

@section('content')
    <div class="content-wrapper ltr:ml-[248px] rtl:mr-[248px]">
        <div class="page-content container-fluid">

            {{-- Header --}}
            <div class="mb-6 flex justify-between items-center">
                <h4 class="text-xl font-semibold">Packages</h4>

                <a href="{{ route('admin.packages.create') }}" class="btn btn-dark">
                    + Create Package
                </a>
            </div>

            {{-- Flash --}}
            @if (session('success'))
                <div class="mb-4 p-3 bg-success-100 text-success-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body p-0 overflow-x-auto">

                    <table class="table-auto w-full border-collapse">
                        <thead class="bg-slate-100 dark:bg-slate-900">
                            <tr class="text-left text-sm text-slate-600 dark:text-slate-300">
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Title</th>
                                <th class="px-4 py-3">Category</th>
                                <th class="px-4 py-3">Type</th>
                                <th class="px-4 py-3">Duration</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3 text-right">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @forelse($packages as $index => $package)
                                <tr class="text-sm">
                                    <td class="px-4 py-3">
                                        {{ $packages->firstItem() + $index }}
                                    </td>

                                    <td class="px-4 py-3 font-medium">
                                        {{ $package->translation->title ?? '—' }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $package->category?->translation?->name ?? '—' }}
                                    </td>

                                    <td class="px-4 py-3 capitalize">
                                        {{ $package->package_type }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $package->duration_days }}D /
                                        {{ $package->duration_nights }}N
                                    </td>

                                    <td class="px-4 py-3">
                                        @if ($package->status === 'active')
                                            <span class="badge bg-success-500 text-white">Active</span>
                                        @elseif($package->status === 'inactive')
                                            <span class="badge bg-danger-500 text-white">Inactive</span>
                                        @else
                                            <span class="badge bg-warning-500 text-white">Draft</span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3 text-right">
                                        <a href="{{ route('admin.packages.edit', $package->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-6 text-slate-400">
                                        No packages found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $packages->links() }}
            </div>

        </div>
    </div>
@endsection
