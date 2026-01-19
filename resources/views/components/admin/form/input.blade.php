@props([
    'label' => null,
    'name',
    'type' => 'text',
    'value' => null,
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

    <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge([
            'class' => 'form-control ' . ($errors->has($name) ? 'border-red-500 focus:border-red-500' : ''),
        ]) }}>

    <x-admin.form.error :name="$name" />
</div>
