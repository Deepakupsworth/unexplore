@extends('backend.layout')
@section('content')
    <!-- BEGIN: Breadcrumb -->
    <div class="mb-5">
        <ul class="m-0 p-0 list-none">
            <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
                <a href="{{ asset('/admin/dashboard') }}">
                    <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                    <iconify-icon icon="heroicons-outline:chevron-right"
                        class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
                </a>
            </li>
            <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
                Cities List
            </li>
        </ul>
    </div>
    <!-- END: BreadCrumb -->

    <div class="card">
        <header class="card-header noborder flex justify-between items-center">
            <h4 class="card-title">Cities</h4>
            <a href="{{ route('cities.create') }}" class="btn btn-dark text-white text-sm px-4 py-2 rounded">
                + Add City
            </a>
        </header>

        <div class="card-body px-6 pb-6">
            <form method="GET" class="mb-4">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">

                    {{-- City Name --}}
                    <div class="fromGroup">
                        <label class="form-label">City Name</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search city..."
                            class="form-control">
                    </div>

                    {{-- Country --}}
                    <div class="fromGroup">
                        <label class="form-label">Country</label>
                        <select name="country_id" class="form-control">
                            <option value="">All Countries</option>
                            @foreach ($countries as $id => $country)
                                <option value="{{ $id }}" {{ request('country_id') == $id ? 'selected' : '' }}>
                                    {{ $country }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <a href="{{ route('cities.index') }}" class="btn btn-outline-secondary">
                        Reset
                    </a>
                    <button class="btn btn-dark">
                        Search
                    </button>
                </div>

            </form>

            <div class="overflow-x-auto -mx-6 dashcode-data-table">
                <span class="col-span-8 hidden"></span>
                <span class="col-span-4 hidden"></span>
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700">
                            <thead class="border-t border-slate-100 dark:border-slate-800">
                                <tr>
                                    <th scope="col" class="table-th">ID</th>
                                    <th scope="col" class="table-th">Thumb</th>
                                    <th scope="col" class="table-th">Name (EN)</th>
                                    <th scope="col" class="table-th">Slug</th>
                                    <th scope="col" class="table-th">Created At</th>
                                    <th scope="col" class="table-th">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">

                                @forelse($cities as $city)
                                    <tr>
                                        <td class="table-td">{{ $city->id }}</td>

                                        <td class="table-td">

                                            @if ($city->thumb_image)
                                                <img src="{{ asset('storage/' . $city->thumb_image) }}" alt="thumb"
                                                    class="w-12 h-12 rounded object-cover">
                                            @else
                                                <span class="text-xs text-slate-400">No Image</span>
                                            @endif
                                        </td>

                                        <td class="table-td">
                                            {{ optional($city->translations->where('language_code', 'en')->first())->name ?? '—' }}

                                        </td>
                                        <td class="table-td">{{ $city->slug }}</td>
                                        <td class="table-td">{{ $city->created_at->format('d M Y') }}</td>

                                        <td class="table-td">
                                            <div class="flex space-x-3 rtl:space-x-reverse">
                                                <a href="{{ route('cities.show', $city->id) }}"
                                                    class="action-btn bg-blue-100 text-blue-700">
                                                    <iconify-icon icon="heroicons:eye"></iconify-icon>
                                                </a>
                                                <a href="{{ route('cities.edit', $city->id) }}">
                                                    <button class="action-btn" type="button">
                                                        <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                                    </button>
                                                </a>
                                                <form action="{{ route('cities.delete', $city->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this city?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="action-btn">
                                                        <iconify-icon icon="heroicons:trash"></iconify-icon>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-slate-500">No cities found</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                {{ $cities->links() }}
            </div>

        </div>
    </div>

    </div>
@endsection
