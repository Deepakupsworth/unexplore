<div class="card">
    <div class="card-body">
      <div class="card-text h-full">
        <header class="border-b px-4 pt-4 pb-3 flex items-center border-primary-500">
          <h3 class="card-title mb-0 text-primary-500">Package Policies</h3>
        </header>
        <div class="py-3 px-5">
            <form method="POST" action="{{ route('admin.packages.policies.save', $package->id) }}">
                @csrf

                @forelse ($policies as $policy)

                    <div class="checkbox-area">
                        <label class="inline-flex items-center cursor-pointer">
                          <input type="checkbox" class="hidden" name="policies[]" value="{{ $policy->id }}" class="mt-1"
                          {{ $package->policies->contains($policy->id) ? 'checked' : '' }}>
                          <span class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                <img src="{{ asset('backend/images/icon/ck-white.svg')}}" alt="" class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                          <span class="text-slate-500 dark:text-slate-400 text-sm leading-6">{!! $policy->translation->content ?? '—' !!}</span>
                        </label>
                      </div>
                @empty
                    <p class="text-slate-400 text-sm">
                        No policies available.
                    </p>
                @endforelse

                <div class="mt-4">
                    <button class="btn btn-dark">
                        Save Policies
                    </button>
                </div>

            </form>
        </div>
      </div>
    </div>
  </div>
