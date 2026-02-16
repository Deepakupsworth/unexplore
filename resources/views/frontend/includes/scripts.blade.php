<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script src="{{ asset('frontend/js/main.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

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
