@extends('frontend.layout')
@section('title', 'Saudi Arabia Travel Packages | Tours, Deals & Experiences')

@section('meta_description', 'Explore curated Saudi Arabia travel packages, including city tours, desert adventures, cultural experiences, and special deals to plan your perfect trip.')
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

   
  @media (max-width: 768px) {

        body.filter-open {
            overflow: hidden;
            height: 100vh;
        }

        .package-listing__filter-section {
            position: fixed;
            inset: 0;
            background: #fff;
            z-index: 9999;

            display: none;              /* 🔥 hidden by default */
            flex-direction: column;
        }

        .package-listing__filter-section.active {
            display: flex;              /* 🔥 show only when active */
        }

        .filter-header,
        .filter-footer {
            flex-shrink: 0;
        }

        .filter-body {
            flex: 1;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }
        .filtet-mob-button{
            margin:20px;
        }
}
</style>

@section('content')
    @include('frontend.packages.partials.banner')

    <section class="package-listing">
        <div class="container">
            <div class="filtet-mob-button">
                <button class="btn btn-outline-primary d-md-none mb-3" id="openFilters">
                    Filters
                </button>
            </div>
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
    document.addEventListener("DOMContentLoaded", function() {
        const slider = document.getElementById('budgetSlider');
        if (!slider) return;

        const minInput = document.getElementById('min_price');
        const maxInput = document.getElementById('max_price');
        const minLabel = document.getElementById('minPriceLabel');
        const maxLabel = document.getElementById('maxPriceLabel');

        noUiSlider.create(slider, {
            start: [Number(minInput.value), Number(maxInput.value)],
            connect: true,
            step: 5000,
            range: {
                min: 0,
                max: 200000
            },
            format: {
                to: value => Math.round(value),
                from: value => Number(value)
            }
        });

        // ✅ UPDATE LABELS LIVE
        slider.noUiSlider.on('update', function(values) {
            minInput.value = values[0];
            maxInput.value = values[1];

            minLabel.textContent = Number(values[0]).toLocaleString('en-IN');
            maxLabel.textContent = Number(values[1]).toLocaleString('en-IN');
        });

        // 🔥🔥🔥 IMPORTANT — TRIGGER AJAX ON SLIDE END
        slider.noUiSlider.on('change', function() {
            loadPackages(); // ✅ your existing function
        });
    });
</script>

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

<script>
document.addEventListener('DOMContentLoaded', function () {

    const filter   = document.querySelector('.package-listing__filter-section');
    const openBtn  = document.getElementById('openFilters');
    const closeBtn = document.getElementById('closeFilters');
    const applyBtn = document.getElementById('applyFilters');
    const searchBtn = document.getElementById('eventSearchBtn');

    function openFilter() {
        if (window.innerWidth > 768) return;
        filter.classList.add('active');
        document.body.classList.add('filter-open');
    }

    function closeFilter() {
        filter.classList.remove('active');
        document.body.classList.remove('filter-open');
    }

    openBtn?.addEventListener('click', openFilter);
    closeBtn?.addEventListener('click', closeFilter);
    applyBtn?.addEventListener('click', closeFilter);
    searchBtn?.addEventListener('click', closeFilter);
});
</script>
