@props([
    'label' => 'Category',
    'name' => 'category_id',
    'categories' => [],
    'selected' => null,
    'required' => false,
])

<div>
    <label class="form-label">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    <select name="{{ $name }}" {{ $required ? 'required' : '' }}
        {{ $attributes->merge([
            'class' => 'form-control ' . ($errors->has($name) ? 'border-red-500 focus:border-red-500' : ''),
        ]) }}>
        <option value="">Select Category</option>

        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old($name, $selected) == $category->id ? 'selected' : '' }}>
                {{ $category->translation?->name ?? '—' }}
            </option>
        @endforeach
    </select>

    @error($name)
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
