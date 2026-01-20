<section class="package-listing">
    <div class="container">
        <div class="package-listing__filters">

            @include('frontend.packages.filters.index')

            <div class="package-listing__results">
                @include('frontend.packages.results.header')

                <div id="package-results">
                    @include('frontend.packages.results.list')
                </div>
            </div>

        </div>
    </div>
</section>
