@props([
    'label' => null,
    'name',
    'value' => null,
    'rows' => 4,
    'required' => false,
])

<div>
    @if ($label)
        <label class="form-label">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <textarea name="{{ $name }}" rows="{{ $rows }}" {{ $required ? 'required' : '' }}
        {{ $attributes->merge([
            'class' => 'form-control ' . ($errors->has($name) ? 'border-red-500 focus:border-red-500' : ''),
        ]) }}>{{ old($name, $value) }}</textarea>

    <x-form.error :name="$name" />
</div>
