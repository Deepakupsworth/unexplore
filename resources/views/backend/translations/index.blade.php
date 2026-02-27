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
        <li class="text-slate-700 font-medium">Translations</li>
    </ul>
</div>

{{-- ================= TABLE ================= --}}
<div class="card">
    <header class="card-header flex justify-between items-center">
        <h4 class="card-title">Translation Groups</h4>
    </header>

    <div class="card-body p-0 overflow-x-auto">
        <table class="min-w-full border-collapse text-sm">
            <thead class="bg-slate-200 dark:bg-slate-700">
                <tr class="text-left text-slate-600">
                    <th class="table-th">#</th>
                    <th class="table-th">Group Name</th>
                    <th class="table-th">Type</th>
                    <th class="table-th text-center">Action</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                @forelse($groups as $index => $group)
                    <tr class="even:bg-slate-50 dark:even:bg-slate-700">

                        {{-- Row Number --}}
                        <td class="table-td">
                            {{ $index + 1 }}
                        </td>

                        {{-- Group Name --}}
                        <td class="table-td font-medium capitalize">
                            {{ $group === 'common' ? 'Common Keys' : $group }}
                        </td>

                        {{-- Type --}}
                        <td class="table-td">
                            @if($group === 'common')
                                <span class="badge bg-info-500 text-info-500 bg-opacity-30 rounded-3xl">
                                    Global (JSON)
                                </span>
                            @else
                                <span class="badge bg-success-500 text-success-500 bg-opacity-30 rounded-3xl">
                                    Group File
                                </span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="table-td text-center">
                            <a href="{{ url('admin/translations/'.$group) }}"
                               class="action-btn bg-primary-100 text-primary-700">
                                <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                            </a>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-10 text-slate-400">
                            No translation groups found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection