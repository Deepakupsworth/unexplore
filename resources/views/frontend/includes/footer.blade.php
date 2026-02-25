<div class="footer-top-image">
    <img src="{{ asset('frontend/assets/footer-top.png') }}" alt="Footer">
</div>

<footer class="bg-white">
    <div class="footer-top">
        <div class="container">
            <div class="row align-items-start">

                <!-- Logo -->
                <div class="col-md-12 col-lg-2 mb-4">
                    <img src="{{ asset('frontend/assets/logo.png') }}" alt="{{ __('footer.logo_alt') }}"
                        class="footer__logo">
                </div>

                <!-- Links columns -->
                <div class="col-md-12 col-lg-7">
                    <div class="row footer-links-section">

                        <div class="col-md-4 mb-4">
                            <p class="footer-link-heading p-large">
                                {{ __('footer.popular_links') }}
                            </p>
                            <ul class="list-unstyled">
                                <li><a href="{{ route('destinations.index') }}" class="footer-link">{{ __('footer.link.explore_saudi') }}</a></li>
                                <li><a href="{{ route('things.to.do') }}" class="footer-link">{{ __('footer.link.things_to_do') }}</a></li>
                                <li><a href="{{route('packages.index')}}" class="footer-link">{{ __('footer.link.plan_trip') }}</a></li>
                                <li><a href="{{ route('event.listing') }}" class="footer-link">{{ __('footer.link.events_festivals') }}</a>
                                </li>
                                <li><a href="#" class="footer-link">{{ __('footer.link.saudi_calendar') }}</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-4 mb-4">
                            <p class="footer-link-heading p-large">
                                {{ __('footer.information') }}
                            </p>
                            <ul class="list-unstyled">
                                <li><a href="{{route('terms-conditions')}}" class="footer-link">{{ __('footer.link.terms_conditions') }}</a>
                                </li>
                                <li><a href="{{route('privacy-policy')}}" class="footer-link">{{ __('footer.link.privacy_policy') }}</a>
                                </li>
                                <li><a href="{{route('faqs')}}" class="footer-link">{{ __('footer.link.faqs') }}</a></li>
                                <li><a href="#" class="footer-link">{{ __('footer.link.news_events') }}</a></li>
                                <li><a href="{{route('cookie-policy')}}" class="footer-link">{{ __('footer.link.cookie_policy') }}</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-4 mb-4">
                            <p class="footer-link-heading p-large">
                                {{ __('footer.company') }}
                            </p>
                            <ul class="list-unstyled">
                                <li><a href="{{ asset('/about-us') }}"
                                        class="footer-link">{{ __('footer.link.about_us') }}</a></li>
                                <li><a href="{{ asset('/contact-us') }}"
                                        class="footer-link">{{ __('footer.link.contact_us') }}</a></li>
                                {{-- <li><a href="#" class="footer-link">{{ __('footer.link.sitemap') }}</a></li> --}}
                            </ul>
                        </div>

                    </div>
                </div>
                <!-- Social & Newsletter -->
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="footer-icons-section">
                        <a href={{ company('instagram_url') ?: '#' }}" class="footer-icon">
                            <img src="{{ asset('frontend/assets/icons/instagram.svg') }}" alt="instagram">
                        </a>
                        <a href="{{ company('facebook_url') ?: '#' }}" class="footer-icon">
                            <img src="{{ asset('frontend/assets/icons/facebook.svg') }}" alt="facebook">
                        </a>
                        <a href="{{ company('twitter_url') ?: '#' }}" class="footer-icon">
                            <img src="{{ asset('frontend/assets/icons/x.svg') }}" alt="x">
                        </a>
                    </div>

                    <div class="footer-newsletter-section">
                        <p class="mb-2 heading p-large">
                            {{ __('footer.subscribe.heading') }}
                        </p>
                        {{-- <form class="d-flex flex-column">
                <div class="custom-input-group mb-2">
                  <span class="input-text" id="newsletter-email">
                    <i class="fa-solid fa-envelope"></i>
                  </span>
                  <input type="email"
                         class="form-control rounded-pill"
                         placeholder="{{ __('footer.subscribe.placeholder') }}"
                         aria-describedby="newsletter-email">
                </div>
                <button type="submit"
                        class="btn btn-primary justify-content-center rounded-pill">
                  {{ __('footer.subscribe.button') }}
                </button>
              </form> --}}

                        <form id="newsletterForm" action="{{ route('newsletter.subscribe') }}" method="POST" class="d-flex flex-column">
                            @csrf

                            <div class="custom-input-group mb-2">
                                <span class="input-text" id="newsletter-email">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>

                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control rounded-pill"
                                    placeholder="{{ __('footer.subscribe.placeholder') }}"
                                    aria-describedby="newsletter-email" required>
                            </div>

                            <button type="submit" class="btn btn-primary justify-content-center rounded-pill">
                                {{ __('footer.subscribe.button') }}
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Copyright bar -->
    <div class="footer-bottom bg-dark text-white text-center">
        <div class="container d-flex flex-wrap justify-content-between align-items-center gap-sm-2">
            <span>
                {{ __('footer.copyright') }}
            </span>
            <span>
                <a href="{{route('terms-conditions')}}" class="footer-link text-white mx-2">
                    {{ __('footer.bottom.terms') }}
                </a>
                &bull;
                <a href="{{route('privacy-policy')}}" class="footer-link text-white mx-2">
                    {{ __('footer.bottom.privacy') }}
                </a>
                &bull;
                <a href="{{route('cookie-policy')}}" class="footer-link text-white mx-2">
                    {{ __('footer.bottom.cookie') }}
                </a>
                {{-- &bull;
                <a href="#" class="footer-link text-white mx-2">
                    {{ __('footer.bottom.sitemap') }}
                </a> --}}
            </span>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const form = document.getElementById('newsletterForm');
            if (!form) return;

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(form);
                const action = form.getAttribute('action');

                fetch(action, {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': form.querySelector('[name=_token]').value,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(async response => {

                    const data = await response.json();

                    if (!response.ok) {
                        throw data;
                    }

                    return data;
                })
                .then(data => {

                    iziToast[data.status || 'success']({
                        title: data.status?.charAt(0).toUpperCase() + data.status?.slice(1),
                        message: data.message,
                        position: 'topRight',
                        timeout: 5000
                    });

                    if (data.status === 'success') {
                        form.reset();
                    }

                })
                .catch(error => {

                    if (error.errors) {
                        // Laravel validation errors
                        Object.values(error.errors).forEach(messages => {
                            messages.forEach(message => {
                                iziToast.error({
                                    title: 'Validation Error',
                                    message: message,
                                    position: 'topRight',
                                    timeout: 6000
                                });
                            });
                        });
                    } else {
                        iziToast.error({
                            title: 'Error',
                            message: error.message || 'Something went wrong.',
                            position: 'topRight',
                            timeout: 6000
                        });
                    }
                });

            });

        });
        </script>

</footer>
