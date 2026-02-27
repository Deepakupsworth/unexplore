@extends('backend.layout')

@section('content')

{{-- ================= HEADER ================= --}}
<div class="mb-6 flex justify-between items-center">
    <div>
        <h3 class="text-lg font-semibold">
            {{ $group === 'common' ? 'Common Translations (JSON)' : ucfirst($group).' Translations' }}
        </h3>
        <p class="text-sm text-slate-500">
            {{ $group === 'common'
                ? 'lang/{locale}.json'
                : 'lang/{locale}/'.$group.'.php'
            }}
        </p>
    </div>

    {{-- UPDATE ALL --}}
    <form method="POST"
          action="{{ route('admin.translations.updateAll', $group) }}">
        @csrf

        @foreach($rows as $key => $langs)
            @foreach($langs as $locale => $value)
                <input type="hidden"
                       name="translations[{{ $key }}][{{ $locale }}]"
                       value="{{ $value }}">
            @endforeach
        @endforeach

        <button class="btn btn-success">
            Update All
        </button>
    </form>
</div>

{{-- ================= TABLE ================= --}}
<div class="card">
    <div class="card-body p-0 overflow-x-auto">

        <table class="min-w-full text-sm border-collapse">
            <thead class="bg-slate-200">
                <tr>
                    <th class="table-th w-48">Key</th>

                    @foreach(array_keys(reset($rows) ?? []) as $locale)
                        <th class="table-th text-center">
                            {{ strtoupper($locale) }}
                        </th>
                    @endforeach

                    <th class="table-th w-32 text-center">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @forelse($rows as $key => $langs)
                <tr>
                    {{-- KEY --}}
                    <td class="table-td font-mono text-xs text-slate-600">
                        {{ $key }}
                    </td>

                    {{-- UPDATE ONE FORM --}}
                    <form method="POST"
                          action="{{ route('admin.translations.updateOne', $group) }}">
                        @csrf

                        <input type="hidden" name="key" value="{{ $key }}">

                        {{-- VALUES --}}
                        @foreach($langs as $locale => $value)
                            <td class="table-td">
                                <input type="text"
                                       name="translations[{{ $locale }}]"
                                       value="{{ $value }}"
                                       class="form-control">
                            </td>
                        @endforeach

                        {{-- ACTION --}}
                        <td class="table-td text-center">
                            <button class="btn btn-sm btn-outline-primary">
                                Update
                            </button>
                        </td>
                    </form>
                </tr>
                @empty
                <tr>
                    <td colspan="100%" class="text-center py-10 text-slate-400">
                        No translations found.
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>

    </div>
</div>
<script>
document.querySelectorAll('.update-one-btn').forEach(btn => {
    btn.addEventListener('click', () => {

        const row = btn.closest('tr');
        const key = row.dataset.key;

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ route('admin.translations.updateOne', $group) }}";

        form.innerHTML = `
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="key" value="${key}">
        `;

        row.querySelectorAll('input').forEach(input => {
            const clone = input.cloneNode();
            clone.value = input.value;
            form.appendChild(clone);
        });

        document.body.appendChild(form);
        form.submit();
    });
});
</script>

@endsection