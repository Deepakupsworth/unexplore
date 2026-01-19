@extends('backend.layout')

@section('content')

    {{-- ================= HEADER ================= --}}
    <div class="mb-6 flex items-center justify-between">
        <h4 class="text-xl font-semibold text-slate-800">
            Packages
        </h4>

        <a href="{{ route('admin.packages.create') }}"
           class="btn btn-dark">
            + Create Package
        </a>
    </div>

    {{-- ================= TABLE ================= --}}
    <div class="card">
        <div class="card-body p-0 overflow-x-auto">

            <table class="min-w-full border-collapse text-sm">
                <thead class="bg-slate-200 dark:bg-slate-700">
                    <tr class="text-left text-slate-600">
                        <th class="table-th">#</th>
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

                            {{-- Title --}}
                            <td class="table-td">
                                {{ $package->translation->title ?? '—' }}
                            </td>

                            {{-- Category --}}
                            <td class="table-td3">
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
                                @switch($package->status)
                                    @case('active')
                                        <span class="inline-flex px-2 py-1 text-xs font-medium rounded bg-green-100 text-green-700">
                                            Active
                                        </span>
                                        @break

                                    @case('inactive')
                                        <span class="inline-flex px-2 py-1 text-xs font-medium rounded bg-red-100 text-red-700">
                                            Inactive
                                        </span>
                                        @break

                                    @default
                                        <span class="inline-flex px-2 py-1 text-xs font-medium rounded bg-yellow-100 text-yellow-700">
                                            Draft
                                        </span>
                                @endswitch
                            </td>

                            {{-- Actions --}}
                            <td class="table-td flex justify-end gap-2 items-center">
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
                            <td colspan="7"
                                class="text-center py-10 text-slate-400">
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
