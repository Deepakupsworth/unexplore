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
            <li class="text-slate-700 font-medium">Tags</li>
        </ul>
    </div>

    <div class="card">
        {{-- HEADER --}}
        <header class="card-header flex justify-between items-center">
            <h4 class="card-title">Tags</h4>
            <a href="{{ route('admin.tags.form') }}" class="btn btn-dark">
                + Add Tag
            </a>
        </header>

        <div class="card-body">

            {{-- FILTER --}}
            <form method="GET" class="mb-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">

                    <div class="fromGroup">
                        <label class="form-label">Tag Name</label>
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Search tag..."
                               class="form-control">
                    </div>

                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <a href="{{ route('admin.tags.index') }}"
                       class="btn btn-outline-secondary">
                        Reset
                    </a>
                    <button class="btn btn-dark">
                        Search
                    </button>
                </div>
            </form>

            {{-- TABLE --}}
            <x-admin.table.table>

                {{-- TABLE HEADER --}}
                <x-admin.table.thead>
                    <x-admin.table.tr>
                        <x-admin.table.th>#</x-admin.table.th>
                        <x-admin.table.th>Name</x-admin.table.th>
                        <x-admin.table.th>Slug</x-admin.table.th>
                        <x-admin.table.th class="text-right">Action</x-admin.table.th>
                    </x-admin.table.tr>
                </x-admin.table.thead>

                {{-- TABLE BODY --}}
                <x-admin.table.tbody>

                    @forelse($tags as $index => $tag)
                        <x-admin.table.tr>

                            <x-admin.table.td>
                                {{ $tags->firstItem() + $index }}
                            </x-admin.table.td>

                            <x-admin.table.td class="font-medium">
                                {{ $tag->name }}
                            </x-admin.table.td>

                            <x-admin.table.td class="text-slate-500">
                                {{ $tag->slug }}
                            </x-admin.table.td>

                            <x-admin.table.td class="text-right">
                                <x-admin.action-buttons
                                    :edit="route('admin.tags.form', $tag->id)"
                                    :delete="route('admin.tags.delete', $tag->id)"
                                />
                            </x-admin.table.td>

                        </x-admin.table.tr>
                    @empty
                        <x-admin.table.empty-row
                            colspan="4"
                            text="No tags found" />
                    @endforelse

                </x-admin.table.tbody>

            </x-admin.table.table>

            {{-- PAGINATION --}}
            <div class="mt-6">
                {{ $tags->links() }}
            </div>

        </div>
    </div>

@endsection
