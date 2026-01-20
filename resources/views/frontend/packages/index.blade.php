@extends('frontend.layout')

@section('content')
    @include('frontend.packages.partials.banner')

    <section class="package-listing">
        <div class="container">
            <div class="package-listing__filters">

                {{-- LEFT FILTER --}}
                @include('frontend.packages.partials.filters')

                {{-- RIGHT RESULTS --}}
                <div class="package-listing__results">

                    <div class="package-listing__results-header">
                        <p class="primary-text">
                            All Packages ({{ $packages->total() }})
                        </p>
                    </div>

                    {{-- RESULTS LIST --}}
                    <div id="package-list">
                        @include('frontend.packages.partials.list', [
                            'packages' => $packages,
                        ])
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection


{{-- ✅ AJAX SCRIPT (MUST BE AFTER CONTENT) --}}

{{-- jQuery (required) --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(document).ready(function () {
    // 🔁 Trigger AJAX on filter change
    $(document).on('change', '.package-filter input', function () {
        loadPackages();
    });

    // 🔍 Search debounce
    let timer;
    $(document).on('keyup', '.package-filter input[name="search"]', function () {
        clearTimeout(timer);
        timer = setTimeout(() => loadPackages(), 400);
    });

    function loadPackages(page = 1) {
        $.ajax({
            url: "{{ route('packages.ajax') }}",
            type: "GET",
            data: $('.package-filter').serialize() + '&page=' + page,

            beforeSend() {
                $('#package-list').html(
                    '<div class="text-center py-5">Loading packages...</div>'
                );
            },

            success(res) {
                $('#package-list').html(res);
            },

            error(xhr) {
                console.error(xhr.responseText);
                alert('Ajax error – check console');
            }
        });
    }

    // 📄 AJAX pagination
    $(document).on('click', '#package-list .pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadPackages(page);
    });

});
</script>

