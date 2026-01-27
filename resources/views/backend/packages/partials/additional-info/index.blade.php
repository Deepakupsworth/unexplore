<div class="card shadow p-2">
    <div class="card-body flex flex-col p-6">
        <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
            <div class="flex-1">
              <div class="card-title text-slate-900 dark:text-white">Additional Information</div>
              <p class="text-sm text-slate-500 mb-4">
                Add important extra details for this package such as cancellation policy,
                visa information, seasonal notes, or any special instructions.
            </p>
            </div>
          </header>



        <div class="border rounded-xl p-5 bg-slate-50">

            {{-- Cards will be injected here --}}
            <div id="additionalInfoBox" class="space-y-6"></div>

            {{-- Add Button --}}
            <div class="mt-4">
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addAdditionalInfo()">
                    + Add Additional Info
                </button>
            </div>

        </div>

    </div>
</div>
{{-- Hidden template + JS --}}
@include('backend.packages.partials.additional-info.template')
@include('backend.packages.partials.additional-info.script', [
    'package' => $package,
    'languages' => $languages,
])
