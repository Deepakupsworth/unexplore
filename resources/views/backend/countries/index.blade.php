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

                    <div class="card-body px-6 pb-6">

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-700">
                                <thead class="bg-slate-50 dark:bg-slate-800">
                                    <tr>
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
                                                <button data-id="{{ $country->id }}"
                                                    class="toggleStatus px-2 py-1 rounded text-xs
                                                {{ $country->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                    {{ $country->status ? 'Active' : 'Inactive' }}
                                                </button>
                                            </td>

                                            <td class="table-td text-right">
                                                <div class="flex justify-end gap-2">
                                                    <a href="{{ route('admin.countries.edit', $country->id) }}"
                                                        class="action-btn">
                                                        <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                                    </a>

                                                    <form method="POST"
                                                        action="{{ route('admin.countries.destroy', $country->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="return confirm('Delete this country?')"
                                                            class="action-btn">
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
