@extends('backend.layout')

@section('content')

{{-- Breadcrumb --}}
<div class="mb-5 flex justify-between items-center">
    <div class="flex gap-2 text-sm">
        <a href="{{ route('admin.golf.queries') }}" class="text-primary-500">
            <iconify-icon icon="heroicons-outline:home"></iconify-icon>
        </a>
        <span>/</span>
        <span class="font-medium">Golf Contact Query</span>
    </div>

    <a href="{{ route('admin.golf.queries') }}" class="btn btn-outline-primary">
        Back
    </a>
</div>


<div class="bg-white dark:bg-slate-800 rounded-xl shadow overflow-hidden">

    {{-- Header --}}
    <div class="px-6 py-4 border-b dark:border-slate-700 flex justify-between items-center">

        <div>
            <h2 class="text-xl font-semibold">
                {{ $query->name }}
            </h2>
            <p class="text-sm text-slate-500">
                {{ $query->email }}
            </p>
        </div>

        {{-- Status Change --}}
        <form method="POST" action="{{ route('admin.golf.queries.status', $query->id) }}">
            @csrf
            @method('PATCH')

            <div class="flex items-center gap-2">

                <select name="status" class="form-control">

                    <option value="new"
                        {{ $query->status == 'new' ? 'selected' : '' }}>
                        New
                    </option>

                    <option value="in_progress"
                        {{ $query->status == 'in_progress' ? 'selected' : '' }}>
                        In Progress
                    </option>

                    <option value="resolved"
                        {{ $query->status == 'resolved' ? 'selected' : '' }}>
                        Resolved
                    </option>

                </select>

                <button class="btn btn-dark btn-sm">
                    Update
                </button>

            </div>
        </form>

    </div>


    <div class="card h-full">
        <div class="card-body grid grid-cols-2 gap-6 p-4">

            <div>
                <p class="text-xs text-slate-500">Name</p>
                <p class="font-medium">{{ $query->name }}</p>
            </div>

            <div>
                <p class="text-xs text-slate-500">Email</p>
                <p class="font-medium">{{ $query->email }}</p>
            </div>

            <div>
                <p class="text-xs text-slate-500">Phone</p>
                <p class="font-medium">{{ $query->phone ?? '—' }}</p>
            </div>

            <div>
                <p class="text-xs text-slate-500">Golf ID</p>
                <p class="font-medium">{{ $query->golf_id ?? '—' }}</p>
            </div>

            <div>
                <p class="text-xs text-slate-500">Submitted</p>
                <p class="font-medium">
                    {{ $query->created_at->format('d M Y H:i') }}
                </p>
            </div>

            <div>
                <p class="text-xs text-slate-500">Current Status</p>

                @if($query->status == 'new')
                    <span class="px-2 py-1 badge bg-warning-500 text-white capitalize">
                        New
                    </span>
                @elseif($query->status == 'in_progress')
                    <span class="px-2 py-1 rounded badge bg-info-500 text-white capitalize">
                        In Progress
                    </span>
                @else
                    <span class="px-2 py-1 rounded badge bg-success-500 text-white capitalize">
                        Resolved
                    </span>
                @endif

            </div>

        </div>
    </div>
    <div class="col-span-12 xl:col-span-6">

    <div class="card h-full">

        <div class="card-body p-6 space-y-6">

            <!-- <div>
                <p class="text-xs text-slate-500 mb-2">
                    Subject
                </p>

                <div class="bg-slate-50 dark:bg-slate-900 rounded-lg p-4 font-medium text-slate-700 dark:text-slate-300">
                    {{ $query->subject ?? '—' }}
                </div>
            </div> -->


            <div>
                <p class="text-xs text-slate-500 mb-2">
                    Message
                </p>

                <div class="bg-slate-50 dark:bg-slate-900 rounded-lg p-5 text-slate-700 dark:text-slate-300 leading-relaxed">
                    {!! nl2br(e($query->message)) !!}
                </div>
            </div>

        </div>

    </div>

</div>

</div>

@endsection