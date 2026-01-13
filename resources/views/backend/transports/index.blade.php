@extends('backend.layout')
@section('content')
    <div class="content-wrapper ltr:ml-[248px] rtl:mr-[248px]">
        <div class="page-content">
            <div class="container-fluid">

                <div class="mb-5 flex justify-between items-center">
                    <h4 class="text-xl font-semibold">Transports</h4>
                    <a href="{{ route('transports.create') }}" class="btn btn-dark">+ Add Transport</a>
                </div>

                <div class="card">
                    <div class="card-body px-6 pb-6">

                        <table class="min-w-full divide-y divide-slate-100">
                            <thead>
                                <tr class="bg-slate-50">
                                    <th class="table-th">#</th>
                                    <th class="table-th">Name</th>
                                    <th class="table-th">City</th>
                                    <th class="table-th">Type</th>
                                    <th class="table-th">Capacity</th>
                                    <th class="table-th">Contact</th>
                                    <th class="table-th">Status</th>
                                    <th class="table-th">Thumb</th>
                                    <th class="table-th text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transports as $key => $t)
                                    <tr>
                                        <td class="table-td">{{ $transports->firstItem() + $key }}</td>
                                        <td class="table-td font-semibold">{{ $t->translations->first()->name ?? '-' }}</td>
                                        <td class="table-td">{{ $t->city->slug ?? '-' }}</td>
                                        <td class="table-td uppercase">{{ $t->type }}</td>
                                        <td class="table-td">{{ $t->capacity }}</td>
                                        <td class="table-td">{{ $t->contact_number }}</td>
                                        <td class="table-td">
                                            <span
                                                class="px-2 py-1 text-xs rounded {{ $t->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                {{ $t->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="table-td">
                                            @if ($t->thumb)
                                                <img src="{{ asset('storage/' . $t->thumb->image_path) }}"
                                                    class="w-10 h-10 rounded object-cover">
                                            @endif
                                        </td>
                                        <td class="table-td text-right">
                                            <div class="flex justify-end gap-2">
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

                        <div class="mt-6">{{ $transports->links() }}</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
