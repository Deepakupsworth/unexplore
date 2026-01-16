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
                        <form method="GET" class="mb-4">

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">

                                {{-- Hotel Name --}}
                                <div class="fromGroup">
                                    <label class="form-label">Hotel Name</label>
                                    <input type="text"
                                           name="search"
                                           value="{{ request('search') }}"
                                           placeholder="Search hotel..."
                                           class="form-control">
                                </div>

                                {{-- City --}}
                                <div class="fromGroup">
                                    <label class="form-label">City</label>
                                    <select name="city_id" class="form-control">
                                        <option value="">All Cities</option>
                                        @foreach($cities as $id => $city)
                                            <option value="{{ $id }}" {{ request('city_id') == $id ? 'selected' : '' }}>
                                                {{ $city }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Stars --}}
                                <div class="fromGroup">
                                    <label class="form-label">Stars</label>
                                    <select name="star" class="form-control">
                                        <option value="">All</option>
                                        <option value="3" {{ request('star') == 3 ? 'selected' : '' }}>3 ★</option>
                                        <option value="4" {{ request('star') == 4 ? 'selected' : '' }}>4 ★</option>
                                        <option value="5" {{ request('star') == 5 ? 'selected' : '' }}>5 ★</option>
                                    </select>
                                </div>

                                {{-- Meal --}}
                                <div class="fromGroup">
                                    <label class="form-label">Meal</label>
                                    <select name="has_meal" class="form-control">
                                        <option value="">All</option>
                                        <option value="1" {{ request('has_meal') === '1' ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ request('has_meal') === '0' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>

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

                            {{-- Buttons --}}
                            <div class="flex justify-end gap-2 mt-4">
                                <a href="{{ route('hotels.index') }}" class="btn btn-outline-secondary">
                                    Reset
                                </a>
                                <button class="btn btn-dark">
                                    Search
                                </button>
                            </div>

                        </form>


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
                                                    <span class="badge bg-success-500 text-white">
                                                        <span class="inline-flex items-center gap-1">
                                                            <iconify-icon icon="heroicons:check-circle"></iconify-icon>
                                                            Active
                                                        </span>
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger-500 text-white">
                                                        <span class="inline-flex items-center gap-1">
                                                            <iconify-icon icon="heroicons:x-circle"></iconify-icon>
                                                            Inactive
                                                        </span>
                                                    </span>
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
                                                    <a href="{{ route('hotels.show', $hotel->id) }}" class="action-btn bg-blue-100 text-blue-700">
                                                        <iconify-icon icon="heroicons:eye"></iconify-icon>
                                                    </a>
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
