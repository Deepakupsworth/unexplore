<div class="mb-5">
    <ul class="flex items-center gap-2 text-sm text-slate-500">
        <li class="text-primary-500">
            <a href="{{ route('admin.dashboard') }}">
                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
            </a>
        </li>

        @foreach ($items as $item)
            <li class="text-slate-400">/</li>
            <li class="{{ $loop->last ? 'text-slate-700 font-medium' : '' }}">
                @if (isset($item['url']))
                    <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                @else
                    {{ $item['label'] }}
                @endif
            </li>
        @endforeach
    </ul>
</div>
