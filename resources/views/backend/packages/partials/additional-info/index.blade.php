<form method="POST"
      action="{{ route('admin.packages.additional-info.save', $package) }}">

    @csrf

    {{-- ================= CONTENT ================= --}}
    <div class="border rounded-xl p-5 bg-slate-50">

        <div id="additionalInfoBox" class="space-y-6"></div>

        <div class="mt-4">
            <button type="button"
                    class="btn btn-sm btn-outline-primary"
                    onclick="addAdditionalInfo()">
                + Add Additional Info
            </button>
        </div>

    </div>

    {{-- ================= BOTTOM ACTION BAR ================= --}}
    <div class="flex justify-end gap-3 mt-6 border-t pt-4">

        <a href="{{ route('admin.packages.index') }}"
           class="btn btn-outline-secondary">
            Cancel
        </a>

        <button type="submit" class="btn btn-primary">
            {{ $package && $package->exists
                ? 'Update Additional Info'
                : 'Create Additional Info' }}
        </button>

    </div>

    {{-- templates & scripts --}}
    @include('backend.packages.partials.additional-info.template')
    @include('backend.packages.partials.additional-info.script', [
        'package' => $package,
        'languages' => $languages,
    ])

</form>
