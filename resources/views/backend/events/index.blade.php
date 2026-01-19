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
            <li class="text-slate-700 font-medium">Events</li>
        </ul>
    </div>

    <div class="card">
        <header class="card-header flex justify-between items-center">
            <h4 class="card-title">Events</h4>
            <a href="{{ route('events.create') }}" class="btn btn-dark">
                + Add Event
            </a>
        </header>

        <div class="card-body px-6 pb-6">
            <form method="GET" class="mb-4">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">

                    {{-- Title --}}
                    <div class="fromGroup">
                        <label class="form-label">Event Name</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search event..."
                            class="form-control">
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

                    {{-- Status --}}
                    <div class="fromGroup">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="">All</option>
                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    {{-- Start Date --}}
                    <div class="fromGroup">
                        <label class="form-label">From</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                    </div>

                    {{-- End Date --}}
                    <div class="fromGroup">
                        <label class="form-label">To</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                    </div>

                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <a href="{{ route('events.index') }}" class="btn btn-outline-secondary">
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
                            <th class="table-th">Title</th>
                            <th class="table-th">City</th>
                            <th class="table-th">Dates</th>
                            <th class="table-th">Status</th>
                            <th class="table-th text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white dark:bg-slate-800 divide-y divide-slate-100 dark:divide-slate-700">

                        @forelse($events as $event)
                            <tr>
                                <td class="table-td">{{ $event->id }}</td>

                                <td class="table-td font-medium text-slate-700 dark:text-white">
                                    {{ optional($event->translations->first())->title ?? '—' }}
                                </td>

                                <td class="table-td">
                                    {{ $event->city->slug ?? '—' }}
                                </td>

                                <td class="table-td">
                                    @if ($event->start_date)
                                        {{ $event->start_date }} → {{ $event->end_date ?? '—' }}
                                    @else
                                        —
                                    @endif
                                </td>

                                <td class="table-td">
                                    @if ($event->status)
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
                                    <div class="flex justify-end gap-2 items-center">
                                        <a href="{{ route('events.show', $event->id) }}"
                                            class="action-btn bg-blue-100 text-blue-700">
                                            <iconify-icon icon="heroicons:eye"></iconify-icon>
                                        </a>
                                        <a href="{{ route('events.edit', $event->id) }}" class="action-btn">
                                            <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                        </a>

                                        <form method="POST" action="{{ route('events.delete', $event->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Delete this event?')" class="action-btn">
                                                <iconify-icon icon="heroicons:trash"></iconify-icon>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-10 text-slate-400">
                                    No events found
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $events->links() }}
            </div>

        </div>
    </div>
@endsection
