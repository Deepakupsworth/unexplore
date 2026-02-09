@forelse($events as $event)


<div class="col-md-6 col-lg-6 col-xl-4">
@include('frontend.events.includes.card-box', ['event' => $event])

</div>


@empty
<p>No results found.</p>
@endforelse

<div class="col-md-12 col-lg-12 col-xl-12">
    {{ $events->withQueryString()->links('vendor.pagination.bootstrap-5') }}
</div>
