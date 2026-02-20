@extends('backend.layout')

@section('content')

<form method="POST"
      action="{{ route('admin.seo.update', [$type, $item->id]) }}" >
    @csrf
   

    <div class="card " style="padding:40px">
        <div class="card-body space-y-6">

            {{-- LANGUAGE SWITCH --}}
            <div class="flex gap-2">
                @foreach ($languages as $lang)
                    <button type="button"
                        class="lang-btn {{ $loop->first ? 'active' : '' }}"
                        data-lang="{{ $lang->code }}">
                        {{ strtoupper($lang->code) }}
                    </button>
                @endforeach
            </div>

            {{-- LANG SECTIONS --}}
            @foreach ($languages as $lang)
                @php
                    $code = $lang->code;
                    $seo  = $seoMetas[$code] ?? null;
                    $default = $defaultSeo[$code] ?? null;

                    $schema = $seo['schema_json'] ?? ($default['schema'] ?? null);
                @endphp

                <div id="lang-{{ $code }}"
                     class="lang-section {{ $loop->first ? '' : 'hidden' }} space-y-4">

                    {{-- META TITLE --}}
                    <div>
                        <label class="form-label">Meta Title ({{ strtoupper($code) }})</label>
                        <input class="form-control"
                               name="seo[{{ $code }}][meta_title]"
                               value="{{ old("seo.$code.meta_title", $seo->meta_title ?? $default['meta_title'] ?? '') }}">
                    </div>

                    {{-- META DESCRIPTION --}}
                    <div>
                        <label class="form-label">Meta Description</label>
                        <textarea class="form-control" rows="3"
                                  name="seo[{{ $code }}][meta_description]">{{ old(
                                      "seo.$code.meta_description",
                                      $seo->meta_description ?? $default['meta_title'] ?? ''
                                  ) }}</textarea>
                    </div>

                    {{-- SCHEMA --}}
                    <div class="border rounded p-4 space-y-4">

                        {{-- ENABLE --}}
                        <label class="flex items-center gap-2">
                            <input type="checkbox"
                                   class="schema-toggle"
                                   data-lang="{{ $code }}"
                                   {{ $schema ? 'checked' : '' }}>
                            <span class="font-medium">Enable Schema</span>
                        </label>

                        {{-- SCHEMA FIELDS --}}
                        <div id="schema-fields-{{ $code }}"
                             class="{{ $schema ? '' : 'hidden' }} space-y-3">

                            {{-- TYPE --}}
                            <div>
                                <label class="form-label">Schema Type</label>
                                <select class="form-control"
                                        name="seo[{{ $code }}][schema][type]">
                                    @foreach (['Event','Product','Place','TouristAttraction'] as $type)
                                        <option value="{{ $type }}"
                                            {{ ($schema['@type'] ?? 'Event') === $type ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- NAME --}}
                            <div>
                                <label class="form-label">Name</label>
                                <input class="form-control"
                                       name="seo[{{ $code }}][schema][name]"
                                       value="{{ $schema['name'] ?? '' }}">
                            </div>

                            {{-- PRICE --}}
                            <div>
                                <label class="form-label">Price</label>
                                <input type="number"
                                       class="form-control"
                                       name="seo[{{ $code }}][schema][price]"
                                       value="{{ $schema['price'] ?? '' }}">
                            </div>

                            {{-- CURRENCY --}}
                            <div>
                                <label class="form-label">Currency</label>
                                <select class="form-control"  name="seo[{{ $code }}][schema][currency]">
                                <option value="">Select Currency</option>
                                    @if(!empty($currencies))
                                        @foreach($currencies as $currency)
                                        <option value="{{$currency->code}}" @if($schema['currency'] == $currency->code) @endif >{{$currency->code}}</option>
                                        @endforeach
                                    @endif
                                </select>
                               
                            </div>

                        </div>
                    </div>

                </div>
            @endforeach

            <button class="btn btn-dark mt-4">Save SEO</button>

        </div>
    </div>
</form>

{{-- STYLES --}}
<style>
.lang-btn{
    padding:.45rem 1rem;border:1px solid #cbd5e1;border-radius:.5rem;
    background:#f8fafc;font-size:14px
}
.lang-btn.active{background:#1e293b;color:#fff}
.hidden{display:none}
</style>

{{-- JS --}}
<script>
document.querySelectorAll('.lang-btn').forEach(btn=>{
    btn.onclick=()=>{
        document.querySelectorAll('.lang-btn').forEach(b=>b.classList.remove('active'))
        document.querySelectorAll('.lang-section').forEach(s=>s.classList.add('hidden'))
        btn.classList.add('active')
        document.getElementById('lang-'+btn.dataset.lang).classList.remove('hidden')
    }
})

document.querySelectorAll('.schema-toggle').forEach(chk=>{
    chk.onchange=()=>{
        document.getElementById('schema-fields-'+chk.dataset.lang)
            .classList.toggle('hidden', !chk.checked)
    }
})
</script>

@endsection
