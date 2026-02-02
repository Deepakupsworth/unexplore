@props([
    'label' => 'Category',
    'name' => 'category_id',   // category_id OR category_ids
    'categories' => [],
    'selected' => null,        // int | array
    'required' => false,
    'multiple' => false,
])

@php
    // normalize selected values
    $selectedValues = collect(old(
        str_replace('[]', '', $name),
        $selected
    ))->flatten()->map(fn ($v) => (string) $v)->toArray();

    // ensure [] for multiple
    $fieldName = $multiple && !str_ends_with($name, '[]')
        ? $name . '[]'
        : $name;

    // base classes
    $baseClass = 'form-control';

    // add select2 automatically for multiple
    $selectClass = $multiple ? ' select2' : '';

    // error class
    $errorClass = $errors->has(str_replace('[]', '', $name))
        ? ' border-red-500 focus:border-red-500'
        : '';
@endphp

<div>
    <label class="form-label">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    <select
        name="{{ $fieldName }}"
        {{ $multiple ? 'multiple' : '' }}
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge([
            'class' => $baseClass . $selectClass . $errorClass,
        ]) }}
    >
        @unless($multiple)
            <option value="">Select Category</option>
        @endunless

        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                @selected(in_array((string) $category->id, $selectedValues))
            >
                {{ $category->translation?->name ?? '—' }}
            </option>
        @endforeach
    </select>

    @error(str_replace('[]', '', $name))
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
