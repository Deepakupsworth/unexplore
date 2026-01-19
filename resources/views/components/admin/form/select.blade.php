@props([
    'label' => null,
    'name',
    'options' => [],
    'selected' => null,
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

    <select name="{{ $name }}" {{ $required ? 'required' : '' }}
        {{ $attributes->merge([
            'class' => 'form-control ' . ($errors->has($name) ? 'border-red-500 focus:border-red-500' : ''),
        ]) }}>
        <option value="">Select</option>

        @foreach ($options as $key => $value)
            <option value="{{ $key }}" {{ old($name, $selected) == $key ? 'selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach
    </select>

    <x-admin.form.error :name="$name" />
</div>
