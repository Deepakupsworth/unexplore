{{-- ================= INFO ================= --}}
<div class="tab-pane">

    <div class="flex gap-2 border-b mb-4 pb-2">
        @foreach ($languages as $lang)
            <button type="button" class="lang-btn {{ $loop->first ? 'active' : '' }}"
                data-info-lang="{{ strtolower($lang->code) }}">
                {{ strtoupper($lang->code) }}
            </button>
        @endforeach
    </div>

    @foreach ($languages as $lang)
        @php
            $code = strtolower($lang->code);
        @endphp

        <div class="info-lang-section {{ $loop->first ? 'active' : '' }}" id="info-lang-{{ $code }}">

            @foreach (['cancellation', 'visa', 'season'] as $type)
                @php
                    $info = $package->exists ? $package->infos->where('type', $type)->first() : null;
                    $infoT = $info ? $info->translations->where('language_code', $code)->first() : null;
                @endphp

                <label class="form-label">{{ ucfirst($type) }} ({{ strtoupper($code) }})</label>

                <textarea name="infos[{{ $type }}][translations][{{ $code }}][content]" class="form-control h-24 mb-4">{{ old("infos.$type.translations.$code.content", $infoT->content ?? '') }}</textarea>
            @endforeach

        </div>
    @endforeach

</div>
