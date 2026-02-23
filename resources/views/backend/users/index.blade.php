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
            <li class="text-slate-700 font-medium">Users</li>
        </ul>
    </div>

    <div class="card">
        <header class="card-header flex justify-between items-center">
            <h4 class="card-title">Users</h4>
        </header>

        <div class="card-body">

            {{-- 🔍 FILTER --}}
            <form method="GET" class="mb-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">

                    {{-- Search --}}
                    <div class="fromGroup">
                        <label class="form-label">Search User</label>
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Search name, email, phone..."
                               class="form-control">
                    </div>

                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                        Reset
                    </a>
                    <button class="btn btn-dark">
                        Search
                    </button>
                </div>
            </form>

            {{-- 📊 TABLE --}}
            <x-admin.table.table>

                {{-- HEADER --}}
                <x-admin.table.thead>
                    <x-admin.table.tr>
                        <x-admin.table.th>#</x-admin.table.th>
                        <x-admin.table.th>Name</x-admin.table.th>
                        <x-admin.table.th>Email</x-admin.table.th>
                        <x-admin.table.th>Phone</x-admin.table.th>
                        <x-admin.table.th>Bookings</x-admin.table.th> {{-- ✅ NEW --}}
                        <x-admin.table.th>Created</x-admin.table.th>
                    </x-admin.table.tr>
                </x-admin.table.thead>

                {{-- BODY --}}
                <x-admin.table.tbody>

                    @forelse($users as $index => $user)
                        <x-admin.table.tr>

                            {{-- # --}}
                            <x-admin.table.td>
                                {{ $users->firstItem() + $index }}
                            </x-admin.table.td>

                            {{-- Name --}}
                            <x-admin.table.td class="font-medium">
                                {{ $user->first_name ?? $user->name ?? '—' }}
                            </x-admin.table.td>

                            {{-- Email --}}
                            <x-admin.table.td>
                                {{ $user->email ?? '—' }}
                            </x-admin.table.td>

                            {{-- Phone --}}
                            <x-admin.table.td>
                                {{ $user->phone ?? '—' }}
                            </x-admin.table.td>

                            {{-- 🔥 Bookings Count --}}
                            <x-admin.table.td>
                                {{ $user->bookings_count }}
                            </x-admin.table.td>

                            {{-- Created --}}
                            <x-admin.table.td>
                                {{ $user->created_at?->format('d M Y') ?? '—' }}
                            </x-admin.table.td>

                        </x-admin.table.tr>
                    @empty
                        <x-admin.table.empty-row colspan="6" text="No users found" />
                    @endforelse

                </x-admin.table.tbody>

            </x-admin.table.table>

            {{-- PAGINATION --}}
            <div class="mt-6">
                {{ $users->links() }}
            </div>

        </div>
    </div>
@endsection
