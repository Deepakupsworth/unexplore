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
            <li class="text-slate-700 font-medium">Things To Do</li>
        </ul>
    </div>

    <div class="card">
        <header class="card-header flex justify-between items-center">
            <h4 class="card-title">Things To Do</h4>
            <a href="{{ route('thingtodos.create') }}" class="btn btn-dark">
                + Add Thing To Do
            </a>
        </header>

        <div class="card-body">
            <form method="GET" class="mb-4">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">

                    {{-- Name --}}
                    <div class="fromGroup">
                        <label class="form-label">Thing To Do</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
                            class="form-control">
                    </div>

                    {{-- City --}}
                    <div class="fromGroup">
                        <label class="form-label">Cities</label>
                        <select name="cities_ids[]" id="seachcities" multiple class="form-control select2"></select>
                    </div>

                    {{-- Category --}}
                    <div class="fromGroup">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">All Categories</option>
                            @foreach ($categories as $id => $cat)
                                <option value="{{ $id }}" {{ request('category_id') == $id ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Location --}}
                    <div class="fromGroup">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" value="{{ request('location') }}" placeholder="Area / place"
                            class="form-control">
                    </div>

                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <a href="{{ route('thingtodos.index') }}" class="btn btn-outline-secondary">
                        Reset
                    </a>
                    <button class="btn btn-dark">
                        Search
                    </button>
                </div>

            </form>


            <x-admin.table.table>

                {{-- TABLE HEADER --}}
                <x-admin.table.thead>
                    <x-admin.table.tr>
                        <x-admin.table.th>#</x-admin.table.th>
                        <x-admin.table.th>Thumb</x-admin.table.th>
                        <x-admin.table.th>Name</x-admin.table.th>
                        <x-admin.table.th>City</x-admin.table.th>
                        <x-admin.table.th>Category</x-admin.table.th>
                        <x-admin.table.th class="text-right">Action</x-admin.table.th>
                    </x-admin.table.tr>
                </x-admin.table.thead>

                {{-- TABLE BODY --}}
                <x-admin.table.tbody>

                    @forelse($thingstodos as $key => $thing)
                        <x-admin.table.tr>
                            <x-admin.table.td>
                                {{ $thingstodos->firstItem() + $key }}
                            </x-admin.table.td>

                            {{-- THUMB (NEW SYSTEM) --}}
                            <x-admin.table.td>
                                @if ($thing->thumb)
                                    <img src="{{ asset('storage/' . $thing->thumb->image_path) }}"
                                        class="w-10 h-10 rounded object-cover border">
                                @else
                                    —
                                @endif
                            </x-admin.table.td>

                            {{-- NAME --}}
                            <x-admin.table.td class="font-medium">
                                {{ $thing->translation?->name ?? '—' }}
                            </x-admin.table.td>

                            {{-- CITY --}}
                            <x-admin.table.td>
                                {{ $thing->city?->translation?->name ?? '—' }}
                            </x-admin.table.td>

                            {{-- CATEGORY --}}
                            <x-admin.table.td>
                                @forelse($thing->thingCategories as $tc)
                                    <span class="badge bg-success-500 text-success-500 bg-opacity-30 capitalize rounded-3xl">
                                        {{ $tc->category?->translation?->name ?? '—' }}
                                    </span>
                                @empty
                                    —
                                @endforelse
                            </x-admin.table.td>


                            {{-- ACTION --}}
                            <x-admin.table.td>
                                <x-admin.action-buttons :view="route('thingtodos.show', $thing->id)" :edit="route('thingtodos.edit', $thing->id)" :delete="route('thingtodos.delete', $thing->id)" />
                            </x-admin.table.td>
                        </x-admin.table.tr>

                    @empty
                        <x-admin.table.empty-row colspan="6" text="No things to do found" />
                    @endforelse

                </x-admin.table.tbody>

            </x-admin.table.table>
            <div class="mt-6">{{ $thingstodos->links() }}</div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

    const el = document.getElementById('seachcities');
    if (!el) return;

    const selectedIds = @json(request('cities_ids', []));

    // Initialize Select2 with AJAX search
    $(el).select2({
        placeholder: 'Search cities',
        width: '100%',
        minimumInputLength: 1,
        ajax: {
            url: '/admin/cities/search',
            dataType: 'json',
            delay: 300,
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data.map(item => ({
                        id: item.id,
                        text: item.title
                    }))
                };
            },
            cache: true
        }
    });

    // Load selected IDs (important for GET filter)
    if (selectedIds.length > 0) {
        $.ajax({
            url: '/admin/cities/seachIds',
            type: 'GET',
            data: {
                ids: selectedIds
            },
            success: function (data) {
                data.forEach(item => {
                    const option = new Option(item.title, item.id, true, true);
                    el.append(option);
                });
                $(el).trigger('change');
            }
        });
    }

});
</script>
@endsection
