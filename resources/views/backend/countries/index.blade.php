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
            <li class="text-slate-700 font-medium">Countries</li>
        </ul>
    </div>

    <div class="card">
        <header class="card-header flex justify-between items-center">
            <h4 class="card-title">Countries</h4>
            <a href="{{ route('admin.countries.create') }}" class="btn btn-dark">
                + Add Country
            </a>
        </header>

        <div class="card-body">
            <form method="GET" class="mb-4 p-6 py-2">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">

                    {{-- Country Name --}}
                    <div class="fromGroup">
                        <label class="form-label">Country Name</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search country..."
                            class="form-control">
                    </div>

                    {{-- Code --}}
                    <div class="fromGroup">
                        <label class="form-label">Code</label>
                        <input type="text" name="code" value="{{ request('code') }}" placeholder="IN, SA..."
                            class="form-control">
                    </div>

                    {{-- Currency --}}
                    {{-- <div class="fromGroup">
                                    <label class="form-label">Currency</label>
                                    <select name="currency" class="form-control">
                                        <option value="">All</option>
                                        <option value="INR" {{ request('currency') == 'INR' ? 'selected' : '' }}>INR</option>
                                        <option value="SAR" {{ request('currency') == 'SAR' ? 'selected' : '' }}>SAR</option>
                                        <option value="AED" {{ request('currency') == 'AED' ? 'selected' : '' }}>AED</option>
                                    </select>
                                </div> --}}

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
                    {{-- <a href="{{ route('countries.index') }}" class="btn btn-outline-secondary">
                                    Reset
                                </a> --}}
                    <button class="btn btn-dark">
                        Filter
                    </button>
                </div>

            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-700">
                    <thead class="bg-slate-200 dark:bg-slate-700">
                        <tr class="text-left text-slate-600">
                            <th class="table-th">#</th>
                            <th class="table-th">Name</th>
                            <th class="table-th">Code</th>
                            <th class="table-th">Currency</th>
                            <th class="table-th">Status</th>
                            <th class="table-th text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white dark:bg-slate-800 divide-y divide-slate-100 dark:divide-slate-700">
                        @forelse($countries as $key => $country)
                            <tr>
                                <td class="table-td">{{ $countries->firstItem() + $key }}</td>

                                <td class="table-td font-medium">
                                    {{ $country->name }}
                                </td>

                                <td class="table-td">{{ $country->code }}</td>

                                <td class="table-td">{{ $country->currency_code }}</td>

                                <td class="table-td">
                                    {!! status_badge($country->status) !!}
                                </td>

                                <td class="table-td text-right">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.countries.edit', $country->id) }}" class="action-btn">
                                            <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                        </a>

                                        <form method="POST" action="{{ route('admin.countries.destroy', $country->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Delete this country?')" class="action-btn">
                                                <iconify-icon icon="heroicons:trash"></iconify-icon>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-10 text-slate-400">
                                    No countries found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $countries->links() }}
            </div>

        </div>
    </div>


    <script>
        document.querySelectorAll('.toggleStatus').forEach(btn => {
            btn.onclick = () => {
                fetch(`/admin/countries/${btn.dataset.id}/toggle-status`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(() => location.reload());
            };
        });
    </script>
@endsection
