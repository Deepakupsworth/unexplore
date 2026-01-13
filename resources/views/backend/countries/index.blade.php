@extends('backend.layout')
@section('content')
    <div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]">
        <div class="page-content">
            <div class="container-fluid">

                <!-- Breadcrumb -->
                <div class="mb-5">
                    <ul class="m-0 p-0 list-none flex items-center gap-2">
                        <li class="text-primary-500">
                            <a href="{{ route('admin.dashboard') }}">
                                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                            </a>
                        </li>
                        <li class="text-slate-400">/</li>
                        <li class="text-slate-600 font-medium">Countries</li>
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

                        <!-- Search -->
                        {{-- <form method="GET" class="flex justify-between items-center mb-6">
                            <div class="w-1/2">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Search country, code or currency..." class="form-control w-full">
                            </div>
                        </form> --}}

                        <div class="overflow-x-auto bg-white rounded-xl shadow-sm">
                            <table class="min-w-full divide-y divide-slate-100">
                                <thead class="bg-slate-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-600">#</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-600">Name</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-600">Code</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-600">Currency</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-600">Status</th>
                                        <th class="px-4 py-3 text-right text-sm font-semibold text-slate-600">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y">
                                    @forelse($countries as $key => $country)
                                        <tr>
                                            <td class="px-4 py-3">{{ $countries->firstItem() + $key }}</td>
                                            <td class="px-4 py-3 font-medium">{{ $country->name }}</td>
                                            <td class="px-4 py-3">{{ $country->code }}</td>
                                            <td class="px-4 py-3">{{ $country->currency_code }}</td>
                                            <td class="px-4 py-3">
                                                <button data-id="{{ $country->id }}"
                                                    class="toggleStatus px-3 py-1 rounded-full text-xs
                {{ $country->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                    {{ $country->status ? 'Active' : 'Inactive' }}
                                                </button>
                                            </td>
                                            <td class="px-4 py-3 text-right flex justify-end gap-2">
                                                <a href="{{ route('admin.countries.edit', $country->id) }}"
                                                    class="action-btn">
                                                    <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                                </a>
                                                <form method="POST"
                                                    action="{{ route('admin.countries.destroy', $country->id) }}">
                                                    @csrf @method('DELETE')
                                                    <button class="action-btn"
                                                        onclick="return confirm('Delete this country?')">
                                                        <iconify-icon icon="heroicons:trash"></iconify-icon>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-12 text-slate-400">
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
