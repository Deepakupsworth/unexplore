@extends('backend.layout')

@section('content')
    <!-- Breadcrumb -->
    <div class="mb-5">
        <ul class="m-0 p-0 list-none flex items-center gap-2">
            <li class="text-primary-500">
                <a href="{{ route('admin.dashboard') }}">
                    <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                </a>
            </li>
            <li class="text-slate-400">/</li>
            <li class="text-slate-700 font-medium">Coupons</li>
        </ul>
    </div>

    <div class="card">
        <header class="card-header flex justify-between items-center">
            <h4 class="card-title">Coupons</h4>
            <a href="{{ route('coupon.create') }}" class="btn btn-dark">
                + Add Coupon
            </a>
        </header>

        {{-- Filters --}}
        <div class="card-body px-6 pb-6">
            <form method="GET" class="mb-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 p-4">

                    {{-- Coupon Code --}}
                    <div class="fromGroup">
                        <label class="form-label">Coupon Code</label>
                        <input type="text" name="search"
                            value="{{ request('search') }}"
                            placeholder="Search code..."
                            class="form-control">
                    </div>

                    {{-- Discount Type --}}
                    <div class="fromGroup">
                        <label class="form-label">Discount Type</label>
                        <select name="discount_type" class="form-control">
                            <option value="">All</option>
                            <option value="percentage" {{ request('discount_type') == 'percentage' ? 'selected' : '' }}>
                                Percentage
                            </option>
                            <option value="amount" {{ request('discount_type') == 'amount' ? 'selected' : '' }}>
                                Amount
                            </option>
                        </select>
                    </div>

                    {{-- Applies To --}}
                    <div class="fromGroup">
                        <label class="form-label">Applies To</label>
                        <select name="applies_to" class="form-control">
                            <option value="">All</option>
                            <option value="all" {{ request('applies_to') == 'all' ? 'selected' : '' }}>All Packages</option>
                            <option value="category" {{ request('applies_to') == 'category' ? 'selected' : '' }}>Category</option>
                            <option value="package" {{ request('applies_to') == 'package' ? 'selected' : '' }}>Package</option>
                        </select>
                    </div>

                    {{-- Status --}}
                    <div class="fromGroup">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="">All</option>
                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <a href="{{ route('coupon.index') }}" class="btn btn-outline-secondary">
                        Reset
                    </a>
                    <button class="btn btn-dark">
                        Search
                    </button>
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="card">
            <div class="card-body p-0 overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-700">
                    <thead class="bg-slate-200 dark:bg-slate-700">
                        <tr class="text-left text-slate-600">
                            <th class="table-th">#</th>
                            <th class="table-th">Code</th>
                            <th class="table-th">Discount</th>
                            <th class="table-th">Applies To</th>
                            <th class="table-th">Validity</th>
                            <th class="table-th">Status</th>
                            <th class="table-th text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white dark:bg-slate-800 divide-y divide-slate-100 dark:divide-slate-700">
                        @forelse ($coupons as $index => $coupon)
                            <tr>
                                <td class="table-td">{{ $coupons->firstItem() + $index  }}</td>

                                <td class="table-td font-medium text-slate-700 dark:text-white">
                                    {{ $coupon->code }}
                                </td>

                                <td class="table-td">
                                    {{ $coupon->discount_text }}
                                </td>

                                <td class="table-td capitalize">
                                    {{ str_replace('_', ' ', $coupon->applies_to) }}
                                </td>

                                <td class="table-td">
                                    @if ($coupon->starts_at || $coupon->ends_at)
                                        {{ $coupon->starts_at?->format('d M Y') ?? '—' }}
                                        →
                                        {{ $coupon->ends_at?->format('d M Y') ?? '—' }}
                                    @else
                                        —
                                    @endif
                                </td>

                                <td class="table-td">
                                    {!! status_badge($coupon->is_active) !!}
                                </td>

                                <td class="table-td">
                                    <div class="flex gap-2 items-center justify-end">

                                        {{-- Edit --}}
                                        <a href="{{ route('coupon.edit', $coupon->id) }}" class="action-btn">
                                            <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                        </a>

                                        {{-- Toggle Status --}}
                                        <form method="POST" action="{{ route('coupon.status', $coupon->id) }}">
                                            @csrf
                                            <button class="action-btn bg-yellow-100 text-yellow-700">
                                                <iconify-icon icon="heroicons:arrow-path"></iconify-icon>
                                            </button>
                                        </form>

                                        {{-- Delete --}}
                                        <form method="POST" action="{{ route('coupon.destroy', $coupon->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Delete this coupon?')" class="action-btn">
                                                <iconify-icon icon="heroicons:trash"></iconify-icon>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-10 text-slate-400">
                                    No coupons found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-6 px-6">
                    {{ $coupons->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
