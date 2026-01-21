@extends('backend.layout')
@section('content')
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
    <div class="card">
        <header class="card-header flex justify-between items-center">
            <h4 class="card-title">Transports</h4>
            <a href="{{ route('transports.create') }}" class="btn btn-dark">
                + Add Transpor
            </a>
        </header>


        <div class="card-body px-6 pb-6">
            <form method="GET" class="mb-4">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">

                    {{-- Transport Name --}}
                    <div class="fromGroup">
                        <label class="form-label">Transport Name</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search transport..." class="form-control">
                    </div>

                    {{-- City --}}
                    <div class="fromGroup">
                        <label class="form-label">City</label>
                        <select name="city_id" class="form-control">
                            <option value="">All Cities</option>
                            @foreach ($cities as $id => $city)
                                <option value="{{ $id }}" {{ request('city_id') == $id ? 'selected' : '' }}>
                                    {{ $city }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Type --}}
                    <div class="fromGroup">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-control">
                            <option value="">All</option>
                            <option value="car" {{ request('type') == 'car' ? 'selected' : '' }}>Car
                            </option>
                            <option value="bus" {{ request('type') == 'bus' ? 'selected' : '' }}>Bus
                            </option>
                            <option value="van" {{ request('type') == 'van' ? 'selected' : '' }}>Van
                            </option>
                            <option value="bike" {{ request('type') == 'bike' ? 'selected' : '' }}>Bike
                            </option>
                        </select>
                    </div>

                    {{-- Status --}}
                    <div class="fromGroup">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="">All</option>
                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active
                            </option>
                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>

                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <a href="{{ route('transports.index') }}" class="btn btn-outline-secondary">
                        Reset
                    </a>
                    <button class="btn btn-dark">
                        Search
                    </button>
                </div>

            </form>
            <div class="overflow-x-auto -mx-6">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700">
                            <thead class="bg-slate-200 dark:bg-slate-700">
                                <tr class="text-left text-slate-600">
                                    <th class="table-th">#</th>
                                    <th class="table-th">Thumb</th>
                                    <th class="table-th">Name</th>
                                    <th class="table-th">City</th>
                                    <th class="table-th">Type</th>
                                    <th class="table-th">Capacity</th>
                                    <th class="table-th">Contact</th>
                                    <th class="table-th">Status</th>
                                    <th class="table-th text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transports as $key => $t)
                                    <tr>
                                        <td class="table-td">{{ $transports->firstItem() + $key }}</td>
                                        <td class="table-td">
                                            @if ($t->thumb)
                                                <img src="{{ asset('storage/' . $t->thumb->image_path) }}"
                                                    class="w-10 h-10 rounded object-cover">
                                            @endif
                                        </td>
                                        <td class="table-td font-semibold">
                                            {{ $t->translations->first()->name ?? '-' }}
                                        </td>
                                        <td class="table-td">{{ $t->city->slug ?? '-' }}</td>
                                        <td class="table-td uppercase">{{ $t->type }}</td>
                                        <td class="table-td">{{ $t->capacity }}</td>
                                        <td class="table-td">{{ $t->contact_number }}</td>
                                        <td class="table-td">
                                            {!! status_badge($t->status) !!}
                                        </td>

                                        <td class="table-td text-right">
                                            <div class="flex gap-2">
                                                <a href="{{ route('transports.show', $t->id) }}"
                                                    class="action-btn bg-blue-100 text-blue-700">
                                                    <iconify-icon icon="heroicons:eye"></iconify-icon>
                                                </a>
                                                <a href="{{ route('transports.edit', $t->id) }}" class="action-btn">
                                                    <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                                </a>
                                                <form method="POST" action="{{ route('transports.delete', $t->id) }}"
                                                    class="inline">
                                                    @csrf @method('DELETE')
                                                    <button class="action-btn" onclick="return confirm('Delete?')">
                                                        <iconify-icon icon="heroicons:trash"></iconify-icon>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-6">{{ $transports->links() }}</div>
        </div>
    </div>
@endsection
