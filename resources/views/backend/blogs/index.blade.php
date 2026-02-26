@extends('backend.layout')
@section('content')

 {{-- ================= HEADER ================= --}}

 <div class="mb-5">
    <ul class="flex items-center gap-2 text-sm">
        <li class="text-primary-500">
            <a href="{{ url('/admin/dashboard') }}">
                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
            </a>
        </li>
        <li class="text-slate-400">/</li>
        <li class="text-slate-700 font-medium">Blogs</li>
    </ul>
</div>

<div class="card">
    <header class="card-header flex justify-between">
        <h4 class="card-title">Blogs</h4>

        <a href="{{ route('admin.blogs.create') }}" class="btn btn-dark">
            + Add Blog
        </a>
    </header>

    <div class="card-body">

        <x-admin.table.table>
            <x-admin.table.thead>
                <x-admin.table.tr>
                    <x-admin.table.th>#</x-admin.table.th>
                    <x-admin.table.th>Thumb</x-admin.table.th>
                    <x-admin.table.th>Title</x-admin.table.th>
                    <x-admin.table.th>Status</x-admin.table.th>
                    <x-admin.table.th class="text-right">Action</x-admin.table.th>
                </x-admin.table.tr>
            </x-admin.table.thead>

            <x-admin.table.tbody>
                @forelse($blogs as $index => $blog)

                <x-admin.table.tr>
                    <x-admin.table.td>{{ $blogs->firstItem() + $index }}</x-admin.table.td>

                    <x-admin.table.td>
                        @if($blog->thumb?->image_path)
                            <img src="{{ asset('storage/'.$blog->thumb->image_path) }}"
                                 class="w-10 h-10 rounded object-cover border">
                        @else — @endif
                    </x-admin.table.td>

                    <x-admin.table.td>
                        {{ $blog->translation?->title ?? '—' }}
                    </x-admin.table.td>

                    <x-admin.table.td>
                        {!! $blog->is_published
                            ? '<span class="badge bg-success">Published</span>'
                            : '<span class="badge bg-warning">Draft</span>' !!}
                    </x-admin.table.td>

                    <x-admin.table.td class="text-right">
                        <x-admin.action-buttons
                            :edit="route('admin.blogs.edit',$blog->id)"
                            :delete="route('admin.blogs.delete',$blog->id)" />
                    </x-admin.table.td>

                </x-admin.table.tr>

                @empty
                    <x-admin.table.empty-row colspan="5" text="No blogs found" />
                @endforelse
            </x-admin.table.tbody>
        </x-admin.table.table>

        <div class="mt-6">
            {{ $blogs->links() }}
        </div>

    </div>
</div>

@endsection
