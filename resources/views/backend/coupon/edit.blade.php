@extends('backend.layout')

@section('content')
<form action="{{ route('coupon.update', $coupon->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-12 gap-6">

        {{-- LEFT --}}
        <div class="xl:col-span-8 col-span-12 space-y-6">

            <div class="card">
                <div class="card-body p-6 space-y-4">
                    <h5 class="font-semibold">Coupon Information</h5>

                    <div class="grid grid-cols-2 gap-4">

                        <div class="fromGroup">
                            <label class="form-label">Coupon Code</label>
                            <input class="form-control" value="{{ $coupon->code }}" disabled>
                        </div>

                        <div class="fromGroup">
                            <label class="form-label">Title</label>
                            <input class="form-control" name="title" value="{{ $coupon->title }}">
                        </div>

                        <div class="fromGroup">
                            <label class="form-label">Discount Type *</label>
                            <select name="discount_type" class="form-control">
                                <option value="percentage" {{ $coupon->discount_type=='percentage'?'selected':'' }}>Percentage</option>
                                <option value="amount" {{ $coupon->discount_type=='amount'?'selected':'' }}>Amount</option>
                            </select>
                        </div>

                        <div class="fromGroup">
                            <label class="form-label">Discount Value *</label>
                            <input class="form-control" name="discount_value" value="{{ $coupon->discount_value }}">
                        </div>

                        <div class="fromGroup">
                            <label class="form-label">Max Discount</label>
                            <input class="form-control" name="max_discount" value="{{ $coupon->max_discount }}">
                        </div>

                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body p-6 space-y-4">
                    <h5 class="font-semibold">Applies To</h5>

                    <select name="applies_to" id="applies_to" class="form-control">
                        <option value="all" {{ $coupon->applies_to=='all'?'selected':'' }}>All Packages</option>
                        <option value="category" {{ $coupon->applies_to=='category'?'selected':'' }}>Category Wise</option>
                        <option value="package" {{ $coupon->applies_to=='package'?'selected':'' }}>Package Wise</option>
                    </select>

                    <div id="category_box" class="{{ $coupon->applies_to!='category'?'hidden':'' }}">
                        <label class="form-label">Categories</label>
                        <select name="category_ids[]" multiple class="form-control">
                            @foreach($categories as $id => $cat)
                                <option value="{{ $cat->id }}"
                                    {{ $coupon->categories->contains($id)?'selected':'' }}>
                                    {{ $cat->translation?->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div id="package_box" class="{{ $coupon->applies_to!='package'?'hidden':'' }}">
                        <label class="form-label">Packages</label>
                        <select name="package_ids[]" multiple class="form-control">
                            @foreach($packages as $package)
                                <option value="{{ $package->id }}"
                                    {{ $coupon->packages->contains($package->id)?'selected':'' }}>
                                    {{ $package->translation?->title ?? 'Package #'.$package->id }}
                                </option>
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

                    <x-admin.form.input type="date" label="Start Date" name="starts_at" :value="$coupon->starts_at" />
                    <x-admin.form.input type="date" label="End Date" name="ends_at" :value="$coupon->ends_at" />
                    <x-admin.form.input label="Usage Limit" name="usage_limit" :value="$coupon->usage_limit" />
                    <x-admin.form.input label="Usage Per User" name="usage_per_user" :value="$coupon->usage_per_user" />

                    <div>
                        <label class="form-label">Status</label>
                        <select name="is_active" class="form-control">
                            <option value="1" {{ $coupon->is_active?'selected':'' }}>Active</option>
                            <option value="0" {{ !$coupon->is_active?'selected':'' }}>Inactive</option>
                        </select>
                    </div>

                    <button class="btn btn-dark w-full mt-4">
                        Update Coupon
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
