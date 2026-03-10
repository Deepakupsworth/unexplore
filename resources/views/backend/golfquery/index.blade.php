@extends('backend.layout')

@section('content')

<!-- Breadcrumb -->
<div class="mb-5">
    <ul class="m-0 p-0 list-none flex items-center gap-2">
        <li class="text-primary-500">
            <a href="#">
                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
            </a>
        </li>
        <li class="text-slate-400">/</li>
        <li class="text-slate-700 font-medium">Golf Contact Queries</li>
    </ul>
</div>

<div class="card">

<header class="card-header flex justify-between items-center">
    <h4 class="card-title">Golf Contact Queries</h4>
</header>


<div class="card-body">

{{-- Search Filter --}}
<form method="GET" class="mb-4 p-6 py-3">

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">

{{-- Name / Email Search --}}
<div class="fromGroup">
<label class="form-label">Search</label>
<input type="text"
name="search"
value="{{ request('search') }}"
placeholder="Name or Email"
class="form-control">
</div>

{{-- Status --}}
<div class="fromGroup">
<label class="form-label">Status</label>
<select name="status" class="form-control">

<option value="">All</option>

<option value="new"
{{ request('status') == 'new' ? 'selected' : '' }}>
New
</option>

<option value="in_progress"
{{ request('status') == 'in_progress' ? 'selected' : '' }}>
In Progress
</option>

<option value="resolved"
{{ request('status') == 'resolved' ? 'selected' : '' }}>
Resolved
</option>

</select>
</div>

</div>

<div class="flex justify-end gap-2 mt-4">

<a href="{{ route('admin.golf.queries') }}"
class="btn btn-outline-secondary">
Reset
</a>

<button class="btn btn-dark">
Search
</button>

</div>

</form>


{{-- Table --}}
<div class="overflow-x-auto">

<table class="min-w-full border-collapse text-sm">

<thead class="bg-slate-200 dark:bg-slate-700">
<tr class="text-left text-slate-600">

<th class="table-th">#</th>
<th class="table-th">Name</th>
<th class="table-th">Email</th>
<th class="table-th">Phone</th>
<!-- <th class="table-th">Subject</th> -->
<th class="table-th">Golf ID</th>
<th class="table-th">Status</th>
<th class="table-th">Date</th>
<th class="table-th text-right">Action</th>

</tr>
</thead>

<tbody class="bg-white dark:bg-slate-800 divide-y divide-slate-100 dark:divide-slate-700">

@forelse($queries as $index => $query)

<tr>

<td class="table-td">
{{ $queries->firstItem() + $index }}
</td>

<td class="table-td">
{{ $query->name }}
</td>

<td class="table-td">
{{ $query->email }}
</td>

<td class="table-td">
{{ $query->phone ?? '—' }}
</td>

<!-- <td class="table-td">
{{ $query->subject ?? '—' }}
</td> -->

<td class="table-td">
{{ $query->golf_id ?? '—' }}
</td>

<td class="table-td">

@if($query->status == 'new')
<span class="px-2 py-1 rounded  badge bg-warning-500 text-white capitalize">
New
</span>

@elseif($query->status == 'in_progress')
<span class="px-2 py-1 rounded  badge bg-info-500 text-white capitalize">
In Progress
</span>

@else
<span class="px-2 py-1 rounded badge bg-success-500 text-white capitalize">
Resolved
</span>
@endif

</td>

<td class="table-td">
{{ $query->created_at->format('d M Y') }}
</td>

<td class="table-td">

<div class="flex gap-2">

<a href="{{ route('admin.golf.queries.show',$query->id) }}"
class="action-btn bg-blue-100 text-blue-700">
<iconify-icon icon="heroicons:eye"></iconify-icon>
</a>

<form method="POST"
action="{{ route('admin.golf.queries.delete',$query->id) }}">

@csrf
@method('DELETE')

<button onclick="return confirm('Delete this query?')"
class="action-btn">

<iconify-icon icon="heroicons:trash"></iconify-icon>

</button>

</form>

</div>

</td>

</tr>

@empty

<tr>
<td colspan="9"
class="text-center py-10 text-slate-400">

No queries found

</td>
</tr>

@endforelse

</tbody>

</table>

</div>

{{-- Pagination --}}
<div class="mt-6">
{{ $queries->links() }}
</div>

</div>
</div>

@endsection