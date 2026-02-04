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
            <li class="text-slate-700 font-medium">Categories</li>
        </ul>
    </div>

    <div class="card">
        <header class="card-header flex justify-between items-center">
            <h4 class="card-title">Categories</h4>
            <a href="{{ route('categories.create') }}" class="btn btn-dark">
                + Add Category
            </a>
        </header>

        <div class="card-body">
            <form method="GET" class="mb-4">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">

                    {{-- Name --}}
                    <div class="fromGroup">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search category..." class="form-control">
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
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
                        <x-admin.table.th>Category</x-admin.table.th>
                        <x-admin.table.th class="text-right">Action</x-admin.table.th>
                    </x-admin.table.tr>
                </x-admin.table.thead>

                {{-- TABLE BODY --}}
                <x-admin.table.tbody>

                    @forelse($categories as $index => $cat)
                        <x-admin.table.tr>

                            <x-admin.table.td>{{ $categories->firstItem() + $index }}</x-admin.table.td>
                            <x-admin.table.td>
                                @if ($cat->thumb_image)
                                    <img src="{{ asset('storage/' . $cat->thumb_image) }}"
                                        class="w-10 h-10 rounded object-cover border">
                                @else
                                    —
                                @endif
                            </x-admin.table.td>


                            <x-admin.table.td class="font-medium">
                                {{ $cat->translation?->name ?? '—' }}
                            </x-admin.table.td>
                            <x-admin.table.td>
                                {{ $cat->type?->label() ?? '—' }}
                            </x-admin.table.td>
                            <x-admin.table.td class="text-right">
                                <x-admin.action-buttons :edit="route('categories.edit', $cat->id)" :delete="route('categories.delete', $cat->id)" />
                            </x-admin.table.td>

                        </x-admin.table.tr>
                    @empty
                        <x-admin.table.empty-row colspan="5" text="No categories found" />
                    @endforelse

                </x-admin.table.tbody>

            </x-admin.table.table>

            <div class="mt-6">
                {{ $categories->links() }}
            </div>

        </div>
    </div>
@endsection
