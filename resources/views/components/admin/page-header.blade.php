<div class="card-header flex justify-between items-center">
    <h4 class="card-title">{{ $title }}</h4>

    @if (isset($button))
        <a href="{{ $button['url'] }}" class="btn btn-dark">
            {{ $button['label'] }}
        </a>
    @endif
</div>
