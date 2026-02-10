<div class="package-listing__results-list">
    <div class="row gy-4 gx-3">
        @forelse($packages as $package)
            <div class="col-md-6 col-lg-4">
                @include('frontend.packages.partials.card', ['package' => $package])
            </div>
        @empty
            <p class="text-muted">{{ __('packages.empty') }}</p>
        @endforelse
    </div>

    <div class="col-md-12 col-lg-12 col-xl-12">
        {{ $packages->withQueryString()->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
