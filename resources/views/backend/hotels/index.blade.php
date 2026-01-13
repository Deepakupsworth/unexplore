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
                        <li class="text-slate-700 font-medium">Hotels</li>
                    </ul>
                </div>

                <div class="card">
                    <header class="card-header flex justify-between items-center">
                        <h4 class="card-title">Hotels</h4>
                        <a href="{{ route('hotels.create') }}" class="btn btn-dark">
                            + Add Hotel
                        </a>
                    </header>

                    <div class="card-body px-6 pb-6">

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-700">
                                <thead class="bg-slate-50 dark:bg-slate-800">
                                    <tr>
                                        <th class="table-th">#</th>
                                        <th class="table-th">Hotel Name</th>
                                        <th class="table-th">City</th>
                                        <th class="table-th">Stars</th>
                                        <th class="table-th">Meal</th>
                                        <th class="table-th">Status</th>
                                        <th class="table-th">Thumb</th>
                                        <th class="table-th text-right">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white dark:bg-slate-800 divide-y divide-slate-100 dark:divide-slate-700">

                                    @forelse($hotels as $hotel)
                                        <tr>
                                            <td class="table-td">{{ $hotel->id }}</td>

                                            <td class="table-td font-medium text-slate-700 dark:text-white">
                                                {{ $hotel->translations->first()->name ?? '—' }}
                                            </td>

                                            <td class="table-td">
                                                {{ $hotel->city->slug ?? '—' }}
                                            </td>

                                            <td class="table-td">
                                                {{ $hotel->star_rating ? $hotel->star_rating . ' ★' : '—' }}
                                            </td>

                                            <td class="table-td">
                                                @if ($hotel->has_meal)
                                                    <span
                                                        class="px-2 py-1 rounded bg-green-100 text-green-700 text-xs">Yes</span>
                                                @else
                                                    <span
                                                        class="px-2 py-1 rounded bg-slate-100 text-slate-600 text-xs">No</span>
                                                @endif
                                            </td>

                                            <td class="table-td">
                                                @if ($hotel->status)
                                                    <span
                                                        class="px-2 py-1 rounded bg-green-100 text-green-700 text-xs">Active</span>
                                                @else
                                                    <span
                                                        class="px-2 py-1 rounded bg-red-100 text-red-700 text-xs">Inactive</span>
                                                @endif
                                            </td>

                                            <td class="table-td">
                                                @if ($hotel->thumb)
                                                    <img src="{{ asset('storage/' . $hotel->thumb->image_path) }}"
                                                        class="w-10 h-10 object-cover rounded border">
                                                @else
                                                    —
                                                @endif
                                            </td>

                                            <td class="table-td text-right">
                                                <div class="flex justify-end gap-2">
                                                    <a href="{{ route('hotels.edit', $hotel->id) }}" class="action-btn">
                                                        <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                                    </a>

                                                    <form method="POST" action="{{ route('hotels.delete', $hotel->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="return confirm('Delete this hotel?')"
                                                            class="action-btn">
                                                            <iconify-icon icon="heroicons:trash"></iconify-icon>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-10 text-slate-400">
                                                No hotels found
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $hotels->links() }}
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
