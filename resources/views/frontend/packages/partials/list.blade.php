<div class="package-listing__results-list">
    <div class="row gy-4 gx-3">
        @forelse($packages as $package)
            <div class="col-md-6 col-lg-4">
                @include('frontend.packages.partials.card', ['package' => $package])
            </div>
        @empty
            <p class="text-muted">No packages found</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $packages->links() }}
    </div>
</div>
