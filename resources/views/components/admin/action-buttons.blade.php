<div class="flex gap-2">

    {{-- VIEW --}}
    @if(isset($view))
        <a href="{{ $view }}" class="action-btn text-blue-600">
            <iconify-icon icon="heroicons:eye"></iconify-icon>
        </a>
    @endif

    {{-- EDIT --}}
    @if(isset($edit))
        <a href="{{ $edit }}" class="action-btn">
            <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
        </a>
    @endif

    {{-- DELETE --}}
    @if(isset($delete))
        <form method="POST" action="{{ $delete }}" onsubmit="return confirm('Are you sure?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="action-btn text-red-600">
                <iconify-icon icon="heroicons:trash"></iconify-icon>
            </button>
        </form>
    @endif

</div>
