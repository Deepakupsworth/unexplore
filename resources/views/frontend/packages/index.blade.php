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

                    {{-- 🔥 HEADER (STATIC – NEVER AJAX) --}}
                    @include('frontend.packages.partials.header', [
                        'packages' => $packages,
                        'packageTypes' => $packageTypes,
                    ])

                    {{-- 🔥 AJAX CONTAINER (ONLY CARDS) --}}
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

{{-- ================= AJAX ================= --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    function loadPackages(page = 1) {
        const $list = $('#package-list');

        $.ajax({
            url: "{{ route('packages.ajax') }}",
            type: "GET",
            data: $('.package-filter').serialize() + '&page=' + page,

            beforeSend() {
                $list.addClass('loading');
            },

            success(res) {
                $list.fadeOut(120, function() {
                    $list.html(res).fadeIn(180);
                    $list.removeClass('loading');
                });
            },

            error() {
                $list.removeClass('loading');
                alert('Something went wrong');
            }
        });
    }

    // Filters
    $(document).on('change', '.package-filter input', () => loadPackages());

    // Search
    let timer;
    $(document).on('keyup', 'input[name="search"]', function() {
        clearTimeout(timer);
        timer = setTimeout(() => loadPackages(), 400);
    });

    // Pagination
    $(document).on('click', '#package-list .pagination a', function(e) {
        e.preventDefault();
        const page = new URL($(this).attr('href')).searchParams.get('page');
        loadPackages(page);
    });

    // Sorting
    $(document).on('click', '.sort-option', function(e) {
        e.preventDefault();
        $('input[name="sort"]').val($(this).data('sort'));
        loadPackages();
    });
</script>
