<div class="package-listing__results-list pb-4">
    <div class="row gy-4 gx-3">
        @forelse($packages as $package)
            <div class="col-md-6 col-lg-4">
                <x-frontend.package-card :package="$package" :cityShow="false" />
            </div>
        @empty
            <p class="text-muted">{{ __('packages.empty') }}</p>
        @endforelse
    </div>

    <div class="col-md-12 col-lg-12 col-xl-12">
        {{ $packages->withQueryString()->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
