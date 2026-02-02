@forelse($things as $thing)


<div class="col-md-6 col-lg-6 col-xl-4">
@include('frontend.thingstodo.includes.card-box', ['thing' => $thing])

</div>


@empty
<p>No results found.</p>
@endforelse

<div class="col-md-12 col-lg-12 col-xl-12">
{{ $things->withQueryString()->links('vendor.pagination.bootstrap-5') }}
</div>

