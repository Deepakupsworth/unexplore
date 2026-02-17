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
            <li class="text-slate-700 font-medium">Company Details</li>
        </ul>
    </div>

    <div class="card">
        <header class="card-header flex justify-between items-center">
            <h4 class="card-title">Company Details</h4>

            <a href="{{ route('admin.company-details.form') }}" class="btn btn-dark">
                + Add / Edit
            </a>
        </header>

        <div class="card-body">

            {{-- 🔍 FILTER --}}
            <form method="GET" class="mb-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">

                    <div class="fromGroup">
                        <label class="form-label">Search</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search company..."
                            class="form-control">
                    </div>

                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <a href="{{ route('admin.company-details.index') }}" class="btn btn-outline-secondary">
                        Reset
                    </a>
                    <button class="btn btn-dark">
                        Search
                    </button>
                </div>
            </form>

            {{-- 📊 TABLE --}}
            <x-admin.table.table>

                {{-- HEADER --}}
                <x-admin.table.thead>
                    <x-admin.table.tr>
                        <x-admin.table.th>#</x-admin.table.th>
                        <x-admin.table.th>Company</x-admin.table.th>
                        <x-admin.table.th>Email</x-admin.table.th>
                        <x-admin.table.th>Phone</x-admin.table.th>
                        <x-admin.table.th>City</x-admin.table.th>
                        <x-admin.table.th class="text-right">Action</x-admin.table.th>
                    </x-admin.table.tr>
                </x-admin.table.thead>

                {{-- BODY --}}
                <x-admin.table.tbody>

                    @forelse($companies as $index => $company)
                        <x-admin.table.tr>

                            <x-admin.table.td>
                                {{ $companies->firstItem() + $index }}
                            </x-admin.table.td>

                            <x-admin.table.td class="font-medium">
                                {{ $company->company_name }}
                            </x-admin.table.td>

                            <x-admin.table.td>
                                {{ $company->email ?? '—' }}
                            </x-admin.table.td>

                            <x-admin.table.td>
                                {{ $company->phone ?? '—' }}
                            </x-admin.table.td>

                            <x-admin.table.td>
                                {{ $company->city ?? '—' }}
                            </x-admin.table.td>

                            <x-admin.table.td class="text-right">

                                <x-admin.action-buttons :edit="route('admin.company-details.form', $company->id)" />

                            </x-admin.table.td>

                        </x-admin.table.tr>
                    @empty
                        <x-admin.table.empty-row colspan="6" text="No company details found" />
                    @endforelse

                </x-admin.table.tbody>

            </x-admin.table.table>

            {{-- PAGINATION --}}
            <div class="mt-6">
                {{ $companies->links() }}
            </div>

        </div>
    </div>
@endsection
