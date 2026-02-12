@extends('frontend.layout')
<style>
    #package-results {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .results-loading {
        opacity: 0;
        transform: translateY(10px);
    }

    .results-loaded {
        opacity: 1;
        transform: translateY(0);
    }

    .loading-skeleton {
        padding: 60px 0;
        text-align: center;
        font-weight: 600;
        color: #999;
    }
</style>

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

        const $form = $('.package-filter');
        const query = $form.serialize();

        if (updateUrl) {
            history.pushState({}, '', window.location.pathname + '?' + query);
        }

        $.ajax({
            url: "{{ route('packages.ajax') }}",
            data: query + '&page=' + page,
            beforeSend() {
                $('#package-results').html('<div class="text-center py-5">Loading...</div>');
            },
            success(res) {
                // setTimeout(()=>$('#package-results').html(res),500);
                $('#package-results').html(res);
            }
        });
    }


    /* ================= SORT ================= */
    $(document).on('click', '.sort-option', function(e) {
        e.preventDefault();

        const sort = $(this).data('sort');

        $('input[name="sort"]').val(sort);

        // Active state update
        $('.sort-option').removeClass('active');
        $(this).addClass('active');

        loadPackages();
    });


    /* ================= CHECKBOX FILTER ================= */
    $(document).on(
        'change',
        '.package-filter input[type="checkbox"], .package-filter select',
        function() {

            const $wrapper = $(this).closest('.package-listing__budget-button');

            if ($(this).is(':checked')) {
                $wrapper.addClass('active');
            } else {
                $wrapper.removeClass('active');
            }

            loadPackages();
        }
    );


    /* ================= SEARCH (DEBOUNCE) ================= */
    let timer;
    $(document).on('keyup', 'input[name="search"]', function() {
        clearTimeout(timer);
        timer = setTimeout(() => loadPackages(), 400);
    });


    /* ================= PAGINATION ================= */
    $(document).on('click', '#package-results .pagination a', function(e) {
        e.preventDefault();

        const page = new URL($(this).attr('href')).searchParams.get('page');
        loadPackages(page, false);
    });


    /* ================= REMOVE SINGLE TYPE ================= */
    $(document).on('click', '.remove-type', function() {

        const type = $(this).data('type');

        const $checkbox = $('.package-filter')
            .find(`input[name="package_type[]"][value="${type}"]`);

        $checkbox.prop('checked', false).trigger('change');
    });


    /* ================= CLEAR ALL ================= */
    $(document).on('click', '.clear-all', function(e) {
        e.preventDefault();

        const $form = $('.package-filter');

        $form.find('input[type="checkbox"]').prop('checked', false);
        $form.find('input[name="sort"]').val('popular');
        $form.find('input[name="search"]').val('');

        $('.package-listing__budget-button').removeClass('active');
        $('.sort-option').removeClass('active');

        loadPackages();
    });


    /* ================= BACK BUTTON SUPPORT ================= */
    window.addEventListener('popstate', function() {
        loadPackages(1, false);
    });

    </script>

<script>
    $(document).on('click', '.package-type-tag', function(e) {
        e.preventDefault();

        const type = $(this).data('type');
        const $form = $('.package-filter');

        const $checkbox = $form
            .find(`input[name="package_type[]"][value="${type}"]`);

        // Toggle checkbox state
        const isChecked = !$checkbox.prop('checked');
        $checkbox.prop('checked', isChecked);

        const $wrapper = $checkbox.closest('.package-listing__budget-button');

        // Toggle active class properly
        if (isChecked) {
            $wrapper.addClass('active');
        } else {
            $wrapper.removeClass('active');
        }

        loadPackages();
    });
</script>
