@props(['name', 'label' => '', 'value' => null, 'checked' => false])

<div class="checkbox-area">
    <label class="inline-flex items-center cursor-pointer">
        <input type="checkbox" name="{{ $name }}" value="{{ $value }}" class="hidden peer"
            {{ $checked ? 'checked' : '' }}>

        <span
            class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800
                   rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150
                   bg-slate-100 dark:bg-slate-900">
            <img src="{{ asset('backend/images/icon/ck-white.svg') }}" alt="check"
                class="h-2.5 w-2.5 block m-auto opacity-0 peer-checked:opacity-100">
        </span>

        @if ($label)
            <span class="text-slate-500 dark:text-slate-400 text-sm leading-6">
                {{ $label }}
            </span>
        @endif
    </label>
</div>
