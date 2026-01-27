@extends('backend.layout')

@section('content')
<form action="{{ route('coupon.store') }}" method="POST">
    @csrf

    <div class="grid grid-cols-12 gap-6">

        {{-- LEFT --}}
        <div class="xl:col-span-8 col-span-12 space-y-6">

            {{-- Coupon Info --}}
            <div class="card">
                <div class="card-body p-6 space-y-4">
                    <h5 class="font-semibold">Coupon Information</h5>

                    <div class="grid grid-cols-2 gap-4">

                        <div class="fromGroup">
                            <label class="form-label">Title</label>
                            <input class="form-control" name="title" value="{{ old('title') }}">
                        </div>

                        <div class="fromGroup">
                            <label class="form-label">Discount Type *</label>
                            <select name="discount_type" class="form-control" required>
                                <option value="">Select</option>
                                <option value="percentage">Percentage</option>
                                <option value="amount">Amount</option>
                            </select>
                        </div>

                        <div class="fromGroup">
                            <label class="form-label">Discount Value *</label>
                            <input class="form-control" name="discount_value" value="{{ old('discount_value') }}" required>
                        </div>

                        <div class="fromGroup">
                            <label class="form-label">Max Discount (Upto)</label>
                            <input class="form-control" name="max_discount" value="{{ old('max_discount') }}">
                        </div>

                    </div>
                </div>
            </div>

            {{-- Applies To --}}
            <div class="card">
                <div class="card-body p-6 space-y-4">
                    <h5 class="font-semibold">Applies To</h5>

                    <div class="fromGroup">
                        <label class="form-label">Scope *</label>
                        <select name="applies_to" id="applies_to" class="form-control" required>
                            <option value="all">All Packages</option>
                            <option value="category">Category Wise</option>
                            <option value="package">Package Wise</option>
                        </select>
                    </div>

                    <div id="category_box" class="hidden">
                        <label class="form-label">Categories</label>
                        <select name="category_ids[]" multiple class="form-control">
                            @foreach($categories as $id => $cat)
                                <option value="{{ $cat->id }}">{{ $cat->translation?->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="package_box" class="hidden">
                        <label class="form-label">Packages</label>
                        <select name="package_ids[]" multiple class="form-control">
                            @foreach($packages as $package)
                                <option value="{{ $package->id }}">{{ $package->translation?->title ?? 'Package #'.$package->id }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>

        </div>

        {{-- RIGHT --}}
        <div class="xl:col-span-4 col-span-12 space-y-6">
            <div class="card">
                <div class="card-body p-6 space-y-4">

                    <div>
                        <label class="form-label">Start Date</label>
                        <input type="date" name="starts_at" class="form-control">
                    </div>

                    <div>
                        <label class="form-label">End Date</label>
                        <input type="date" name="ends_at" class="form-control">
                    </div>

                    <div>
                        <label class="form-label">Usage Limit</label>
                        <input class="form-control" name="usage_limit">
                    </div>

                    <div>
                        <label class="form-label">Usage Per User</label>
                        <input class="form-control" name="usage_per_user">
                    </div>

                    <button class="btn btn-dark w-full mt-4">
                        Create Coupon
                    </button>

                </div>
            </div>
        </div>

    </div>
</form>

<script>
    const appliesTo = document.getElementById('applies_to');
    const categoryBox = document.getElementById('category_box');
    const packageBox = document.getElementById('package_box');

    appliesTo.onchange = () => {
        categoryBox.classList.add('hidden');
        packageBox.classList.add('hidden');

        if (appliesTo.value === 'category') categoryBox.classList.remove('hidden');
        if (appliesTo.value === 'package') packageBox.classList.remove('hidden');
    };
</script>
@endsection
