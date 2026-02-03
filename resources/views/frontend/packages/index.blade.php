@extends('frontend.layout')

@section('content')
    @include('frontend.packages.partials.banner')

    <section class="package-listing">
        <div class="container">
            <div class="package-listing__filters">
                <form class="package-filter">
                    {{-- LEFT FILTER (STATIC) --}}
                    @include('frontend.packages.partials.filters')
                    <input type="hidden" name="sort" value="{{ request('sort', 'popular') }}">

                </form>
                {{-- RIGHT SIDE --}}
                <div class="package-listing__results">
                    <div id="package-results">
                        @include('frontend.packages.partials.results', [
                            'packages' => $packages,
                            'packageTypes' => $packageTypes,
                        ])
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection


{{-- ================= AJAX SCRIPT ================= --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    function loadPackages(page = 1, updateUrl = true) {

        const query = $('.package-filter').serialize();

        if (updateUrl) {
            history.pushState({}, '', window.location.pathname + '?' + query);
        }

        $.ajax({
            url: "{{ route('packages.ajax') }}",
            data: query + '&page=' + page,
            success(res) {
                console.log(res);
                $('#package-results').html(res);
            }
        });
    }

    // 🔃 SORTING
    $(document).on('click', '.sort-option', function(e) {
        e.preventDefault();

        const sort = $(this).data('sort');
        $('input[name="sort"]').val(sort);

        loadPackages();
    });

    // 🔁 FILTER CHANGE (LEFT SIDEBAR)
    $(document).on(
        'change',
        '.package-filter input[type="checkbox"], .package-filter select',
        function() {
            loadPackages();
        }
    );

    // 🔍 SEARCH
    let timer;
    $(document).on('keyup', 'input[name="search"]', function() {
        clearTimeout(timer);
        timer = setTimeout(() => loadPackages(), 400);
    });

    // 📄 PAGINATION (FIXED SELECTOR)
    $(document).on('click', '#package-results .pagination a', function(e) {
        e.preventDefault();

        const page = new URL($(this).attr('href')).searchParams.get('page');
        loadPackages(page, false);
    });

    // ❌ REMOVE SINGLE TYPE (TOP PILL)
    $(document).on('click', '.remove-type', function() {

        const type = $(this).data('type');

        const checkbox = $('.package-filter')
            .find(`input[name="package_type[]"][value="${type}"]`);

        // Uncheck checkbox
        checkbox.prop('checked', false).trigger('change');

        // Remove active class from UI button
        checkbox
            .closest('.package-listing__budget-button')
            .removeClass('active');

        // Reload packages
        loadPackages();
    });


    // 🧹 CLEAR ALL (SAFE)
    $(document).on('click', '.clear-all', function(e) {
        e.preventDefault();

        const $form = $('.package-filter');

        // only checkboxes
        $form.find('input[type="checkbox"]').prop('checked', false);

        // reset sort
        $form.find('input[name="sort"]').val('popular');

        loadPackages();
    });

    // 🔙 BACK / FORWARD SUPPORT
    window.addEventListener('popstate', function() {
        loadPackages(1, false);
    });

</script>
<script>
    // 🏷️ TAG CLICK (MERGE QUERY WITHOUT PAGE RELOAD)
    $(document).on('click', '.package-type-tag', function (e) {
        e.preventDefault();

        const type = $(this).data('type');
        const $form = $('.package-filter');

        const checkbox = $form
            .find(`input[name="package_type[]"][value="${type}"]`);

        // Toggle checkbox
        checkbox.prop('checked', !checkbox.prop('checked'));

        // Reload with merged query
        loadPackages(1, true);
    });
</script>

