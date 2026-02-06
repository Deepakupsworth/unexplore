@extends('frontend.layout')
@section('content')
    <!-- PRELOADER -->
    <div id="preloader"
        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
            background:rgba(255,255,255,0.8); z-index:9999; text-align:center;">
        <div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%);">
            <div class="spinner-border text-primary" style="width:60px; height:60px;"></div>
            <p class="mt-3 fw-bold fs-5">{{ __('contact.form.sending') }}</p>
        </div>
    </div>

    <!-- CONTACT BANNER -->
    <section class="package-listing__banner">
        <div class="container">
            <div
                class="text-center justify-content-center package-listing__banner-content contact-us-banner align-items-center">
                <h1 class="h2 fw-bold text-white m-0">{{ __('contact.banner.title') }}</h1>
                <p>{{ __('contact.banner.description') }}</p>
            </div>
        </div>
    </section>

    <!-- CONTACT FORM -->
    <section class="section-padding-md contact-us_form-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="contact-box p-3 p-md-4 rounded-5">
                        <h5 class="fw-bold mb-4">{{ __('contact.form.title') }}</h5>

                        <form id="contactForm" action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">{{ __('contact.form.first_name') }}</label>
                                    <input type="text" class="form-control contact-input"
                                        placeholder="{{ __('contact.form.placeholder') }}" name="first_name" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">{{ __('contact.form.last_name') }}</label>
                                    <input type="text" class="form-control contact-input"
                                        placeholder="{{ __('contact.form.placeholder') }}" name="last_name" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">{{ __('contact.form.email') }}</label>
                                    <input type="email" class="form-control contact-input"
                                        placeholder="{{ __('contact.form.placeholder') }}" name="email" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">{{ __('contact.form.phone') }}</label>
                                    <input type="text" class="form-control contact-input"
                                        placeholder="{{ __('contact.form.placeholder') }}" name="phone" required>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label small fw-semibold">{{ __('contact.form.subject') }}</label>
                                    <input type="text" class="form-control contact-input"
                                        placeholder="{{ __('contact.form.placeholder') }}" name="subject" required>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label small fw-semibold">{{ __('contact.form.message') }}</label>
                                    <textarea rows="4" class="form-control contact-input" placeholder="{{ __('contact.form.message_placeholder') }}"
                                        name="message"></textarea>
                                </div>
                            </div>

                            <div class="row my-4">
                                <div class="col-md-6">
                                    <button type="submit"
                                        class="btn btn-primary btn-lg rounded-4 btn-submit w-100 px-3 justify-content-between">
                                        {{ __('contact.form.submit') }}
                                        <i class="fa-solid fa-angles-right"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="formAlert" class="alert mt-3 d-none"></div>
                        </form>
                    </div>
                </div>

                <!-- INFO CARD -->
                <div class="col-lg-4">
                    <div class="event-map__info-card rounded-5 h-100">
                        <h6 class="fw-600 p-large mb-3">{{ __('contact.info.title') }}</h6>

                        <div class="event-map__info-card-row flex-v-center rounded-4 gap-2 mb-3">
                            <div class="icon primary-text flex-center"><i class="fa-solid fa-location-dot"></i></div>
                            <div>
                                <p class="text-light2 p-small mb-1">{{ __('contact.info.location_label') }}</p>
                                <p class="p-large fw-500">{{ __('contact.info.location_value') }}</p>
                            </div>
                        </div>

                        <div class="event-map__info-card-row flex-v-center rounded-4 gap-2 mb-3">
                            <div class="icon primary-text flex-center"><i class="fa-regular fa-clock"></i></div>
                            <div>
                                <p class="text-light2 p-small mb-1">{{ __('contact.info.time_label') }}</p>
                                <p class="p-large fw-500">{{ __('contact.info.time_value') }}</p>
                            </div>
                        </div>

                        <div class="event-map__info-card-row flex-v-center rounded-4 gap-2 mb-3">
                            <div class="icon primary-text flex-center"><i class="fa-solid fa-phone"></i></div>
                            <div>
                                <p class="text-light2 p-small mb-1">{{ __('contact.info.call_label') }}</p>
                                <p class="p-large fw-500">{{ __('contact.info.call_value') }}</p>
                            </div>
                        </div>

                        <div class="event-map__info-card-row flex-v-center rounded-4 gap-2 mb-3">
                            <div class="icon primary-text flex-center"><i class="fa-regular fa-envelope"></i></div>
                            <div>
                                <p class="text-light2 p-small mb-1">{{ __('contact.info.email_label') }}</p>
                                <p class="p-large fw-500">{{ __('contact.info.email_value') }}</p>
                            </div>
                        </div>

                        <div class="event-map__info-card-row flex-v-center rounded-4 gap-2">
                            <div class="icon primary-text flex-center"><i class="fa-brands fa-whatsapp"></i></div>
                            <div>
                                <p class="text-light2 p-small mb-1">{{ __('contact.info.whatsapp_label') }}</p>
                                <p class="p-large fw-500">{{ __('contact.info.whatsapp_value') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- LOCATE US -->
    <section>
        <div class="container">
            <div class="contact-office_wrapper text-white">
                <div class="section__header">
                    <div class="section__header-content gap-1">
                        <p class="p-large fw-600">{{ __('contact.office.locate') }}</p>
                        <h2 class="section__heading text-white">{{ __('contact.office.title') }}</h2>
                        <p class="section__description">{{ __('contact.office.description') }}</p>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-4">
                        <div class="contact-office_img-wrapper position-relative">
                            <img src="{{ asset('/frontend/assets/contact-office1.png') }}" class="img-fluid">
                            <div class="contact-office__badge fw-600 text-black">{{ __('contact.office.riyadh') }}</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-office_img-wrapper position-relative">
                            <img src="{{ asset('/frontend/assets/contact-office2.png') }}" class="img-fluid">
                            <div class="contact-office__badge fw-600 text-black">{{ __('contact.office.jeddah') }}</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-office_img-wrapper position-relative">
                            <img src="{{ asset('/frontend/assets/contact-office3.png') }}" class="img-fluid">
                            <div class="contact-office__badge fw-600 text-black">{{ __('contact.office.abha') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NEWS & EVENTS (DYNAMIC CONTENT UNTOUCHED) -->
    <section class="news-event section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4 d-flex align-items-center">
                    <div class="section__header flex-column align-items-start gap-4">
                        <div class="section__header-content">
                            <h2 class="section__heading">{{ __('contact.news.title') }}</h2>
                            <p class="section__description">{{ __('contact.news.description') }}</p>
                        </div>
                        <div class="section__header-CTA">
                            <a href="#" class="btn btn-primary rounded-pill">
                                {{ __('common.view_all') }}
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- ITEMS LEFT AS-IS (DYNAMIC) -->
                <div class="col-md-8">
                    <div class="news-event__carousel-container">
                        <div class="news-event__carousel-prev">
                            <i class="fa-solid fa-arrow-left"></i>
                        </div>
                        <div class="news-event__carousel swiper">
                            <div class="news-event__carousel-wrapper swiper-wrapper">
                                <div class="news-event__carousel-item swiper-slide">
                                    <img src="{{ asset('/frontend/assets/news-event1.jpg') }}" alt="News"
                                        class="img-fluid">
                                    <div class="news-event__carousel-item-info">
                                        <div class="small news-event__carousel-item-date mb-2">
                                            <i class="fa-solid fa-calendar"></i>
                                            Nov 28 | 15:30
                                        </div>
                                        <h6>Event Ideas that Celebrate Culture, Community...</h6>
                                    </div>
                                </div>
                                <div class="news-event__carousel-item swiper-slide">
                                    <img src="{{ asset('/frontend/assets/news-event2.jpg') }}" alt="News"
                                        class="img-fluid">
                                    <div class="news-event__carousel-item-info">
                                        <div class="small news-event__carousel-item-date mb-2">
                                            <i class="fa-solid fa-calendar"></i>
                                            Nov 28 | 15:30
                                        </div>
                                        <h6>Event Ideas that Celebrate Culture, Community...</h6>
                                    </div>
                                </div>
                                <div class="news-event__carousel-item swiper-slide">
                                    <img src="{{ asset('/frontend/assets/news-event3.jpg') }}" alt="News"
                                        class="img-fluid">
                                    <div class="news-event__carousel-item-info">
                                        <div class="small news-event__carousel-item-date mb-2">
                                            <i class="fa-solid fa-calendar"></i>
                                            Nov 28 | 15:30
                                        </div>
                                        <h6>Event Ideas that Celebrate Culture, Community...</h6>
                                    </div>
                                </div>
                                <div class="news-event__carousel-item swiper-slide">
                                    <img src="{{ asset('/frontend/assets/news-event4.jpg') }}" alt="News"
                                        class="img-fluid">
                                    <div class="news-event__carousel-item-info">
                                        <div class="small news-event__carousel-item-date mb-2">
                                            <i class="fa-solid fa-calendar"></i>
                                            Nov 28 | 15:30
                                        </div>
                                        <h6>Event Ideas that Celebrate Culture, Community...</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="news-event__carousel-next">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="section-padding-md">
        <div class="container">
            <div class="section__header align-items-center">
                <div class="section__header-content">
                    <h2 class="section__heading">{{ __('contact.faq.title') }}</h2>
                    <p class="section__description">{{ __('contact.faq.description') }}</p>
                </div>
                <div class="section__header-CTA">
                    <a href="#" class="btn btn-primary rounded-pill">
                        {{ __('common.view_all') }}
                        <i class="fa-solid fa-angles-right"></i>
                    </a>
                </div>
            </div>

            {{-- dynamic FAQ items --}}
            <div class="event-listing__faq" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqOne">
                        <button class="accordion-button p-large fw-600" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapseOne" aria-expanded="true" aria-controls="faqCollapseOne">
                            {{ __('contact.faq.q1') }}
                        </button>
                    </h2>
                    <div id="faqCollapseOne" class="accordion-collapse collapse show" aria-labelledby="faqOne"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p class="text-light2">{{ __('contact.faq.answer') }}</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqTwo">
                        <button class="accordion-button collapsed p-large fw-600" type="button"
                            data-bs-toggle="collapse" data-bs-target="#faqCollapseTwo" aria-expanded="false"
                            aria-controls="faqCollapseTwo">
                            {{ __('contact.faq.q2') }}
                        </button>
                    </h2>
                    <div id="faqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="faqTwo"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p class="text-light2">{{ __('contact.faq.answer') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                const form = document.getElementById("contactForm");
                const preloader = document.getElementById("preloader");
                const alertBox = document.getElementById("formAlert");

                if (!form) return;

                form.addEventListener("submit", function(e) {
                    e.preventDefault();

                    preloader.style.display = "block";
                    alertBox.classList.add("d-none");

                    const formData = new FormData(form);

                    fetch(form.action, {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Accept": "application/json"
                            },
                            body: formData
                        })
                        .then(async res => {
                            const data = await res.json();

                            preloader.style.display = "none";

                            if (!res.ok) throw data;

                            // ✅ SUCCESS
                            alertBox.className = "alert alert-success";
                            alertBox.innerText = data.message;
                            alertBox.classList.remove("d-none");

                            form.reset();
                        })
                        .catch(err => {
                            preloader.style.display = "none";

                            alertBox.className = "alert alert-danger";
                            alertBox.classList.remove("d-none");

                            // ❌ Validation errors
                            if (err.errors) {
                                alertBox.innerHTML = Object.values(err.errors)
                                    .map(e => `<div>${e[0]}</div>`)
                                    .join("");
                            } else {
                                alertBox.innerText = err.message || "Something went wrong";
                            }
                        });
                });
            });
        </script>
    @endpush
@endsection
