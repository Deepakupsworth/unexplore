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
                                <li><a href="#" class="footer-link">{{ __('footer.link.terms_conditions') }}</a>
                                </li>
                                <li><a href="#" class="footer-link">{{ __('footer.link.privacy_policy') }}</a>
                                </li>
                                <li><a href="#" class="footer-link">{{ __('footer.link.faqs') }}</a></li>
                                <li><a href="#" class="footer-link">{{ __('footer.link.news_events') }}</a></li>
                                <li><a href="#" class="footer-link">{{ __('footer.link.cookie_policy') }}</a>
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
                                <li><a href="#" class="footer-link">{{ __('footer.link.sitemap') }}</a></li>
                            </ul>
                        </div>

                    </div>
                </div>

                <!-- Social & Newsletter -->
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="footer-icons-section">
                        <a href="#" class="footer-icon">
                            <img src="{{ asset('frontend/assets/icons/instagram.svg') }}" alt="instagram">
                        </a>
                        <a href="#" class="footer-icon">
                            <img src="{{ asset('frontend/assets/icons/facebook.svg') }}" alt="facebook">
                        </a>
                        <a href="#" class="footer-icon">
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

                        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="d-flex flex-column">
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
                <a href="#" class="footer-link text-white mx-2">
                    {{ __('footer.bottom.terms') }}
                </a>
                &bull;
                <a href="#" class="footer-link text-white mx-2">
                    {{ __('footer.bottom.privacy') }}
                </a>
                &bull;
                <a href="#" class="footer-link text-white mx-2">
                    {{ __('footer.bottom.cookie') }}
                </a>
                &bull;
                <a href="#" class="footer-link text-white mx-2">
                    {{ __('footer.bottom.sitemap') }}
                </a>
            </span>
        </div>
    </div>
</footer>
