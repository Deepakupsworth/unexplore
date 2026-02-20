<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>


<script>
    document.addEventListener("DOMContentLoaded", function() {

        const images = document.querySelectorAll("img:not([loading])");

        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;

                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                    }

                    img.setAttribute("loading", "lazy");

                    obs.unobserve(img);
                }
            });
        }, {
            rootMargin: "100px"
        });

        images.forEach(img => {

            // Skip images already loaded (like logo, hero if needed)
            if (img.classList.contains("no-lazy")) return;

            // Convert existing src to data-src
            if (img.src) {
                img.dataset.src = img.src;
                img.src = "";
            }

            observer.observe(img);
        });

    });



</script>

{{-- <script>
    function initSelect2(context = document) {

        if (!(window.jQuery && $.fn.select2)) {
            console.warn("Select2 not loaded");
            return;
        }

        // ✅ normal select
        $(context).find('.select2').each(function() {

            // 🔥 CRITICAL: destroy if already init
            if ($(this).hasClass('select2-hidden-accessible')) {
                $(this).select2('destroy');
            }

            $(this).select2({
                width: '100%',
                theme: 'bootstrap-5',
                placeholder: $(this).data('placeholder') || 'Select option'
            });
        });

        // ✅ modal select
        $(context).find('.select2-modal').each(function() {
            console.log('modal find')
            // 🔥 CRITICAL: destroy if already init
            if ($(this).hasClass('select2-hidden-accessible')) {
                $(this).select2('destroy');
            }

            const $modal = $(this).closest('.modal');
            console.log($modal);
            $(this).select2({
                dropdownParent: $modal.length ? $modal : $('body'),
                width: '100%',
                theme: 'bootstrap-5',
                placeholder: $(this).data('placeholder') || 'Select option'
            });
        });
    }
</script> --}}
