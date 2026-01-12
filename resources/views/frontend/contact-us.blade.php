@extends('frontend.layout')
@section('content')

<!-- PRELOADER -->
<div id="preloader"
     style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
            background:rgba(255,255,255,0.8); z-index:9999; text-align:center;">
    <div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%);">
        <div class="spinner-border text-primary" style="width:60px; height:60px;"></div>
        <p class="mt-3 fw-bold fs-5">Sending...</p>
    </div>
</div>


   <!-- 1. CONTACT US: BANNER -->
    <section class="package-listing__banner">
        <div class="container">
            <div
                class="text-center justify-content-center package-listing__banner-content contact-us-banner align-items-center">
                <h1 class="h2 fw-bold text-white m-0">Contact Us</h1>
                <p>24/7—call us anytime or send your request using the form below.</p>
            </div>
        </div>
    </section>

    <section class="section-padding-md contact-us_form-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="contact-box p-3 p-md-4 rounded-5">
                        <h5 class="fw-bold mb-4">Contact Us</h5>
                        <form action="{{ route('contact.send') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">First Name *</label>
                                    <input type="text" class="form-control contact-input" placeholder="Enter here" name="first_name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Last Name *</label>
                                    <input type="text" class="form-control contact-input" placeholder="Enter here" name="last_name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Email</label>
                                    <input type="email" class="form-control contact-input" placeholder="Enter here" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Phone Number *</label>
                                    <input type="text" class="form-control contact-input" placeholder="Enter here" name="phone" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label small fw-semibold">Subject *</label>
                                    <input type="text" class="form-control contact-input" placeholder="Enter here" name="subject" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label small fw-semibold">Message</label>
                                    <textarea rows="4" class="form-control contact-input"
                                        placeholder="Enter message" name="message_new"></textarea>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="row my-4">
                                <div class="col-md-6">
                                    <button type="submit"
                                        class="btn btn-primary btn-lg rounded-4 btn-submit w-100 px-3 justify-content-between">
                                        Submit <i class="fa-solid fa-angles-right"></i>
                                    </button>
                                </div>
                            </div>

                            <div id="success-message" style="display:none;" class="alert alert-success mt-3">
                                ✅ Your form has been submitted. We will connect with you soon.
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="event-map__info-card rounded-5 h-100">
                        <h6 class="fw-600 p-large mb-3">Information</h6>
                        <div class="event-map__info-card-row flex-v-center rounded-4 gap-1 mb-3 gap-2">
                            <div class="icon primary-text flex-center"><i class="fa-solid fa-location-dot"></i></div>
                            <div>
                                <p class="text-light2 p-small mb-1">Location:</p>
                                <p class="p-large fw-500">One Central, building 2, 4th floor PO Box 594 Saudi Arabia</p>
                            </div>
                        </div>
                        <div class="event-map__info-card-row flex-v-center rounded-4 gap-1 mb-3 gap-2">
                            <div class="icon primary-text flex-center"><i class="fa-regular fa-clock"></i></div>
                            <div>
                                <p class="text-light2 p-small mb-1">Time:</p>
                                <p class="p-large fw-500">Sun: 03:00 PM to 06:00 PM</p>
                            </div>
                        </div>
                        <div class="event-map__info-card-row flex-v-center rounded-4 gap-1 mb-3 gap-2">
                            <div class="icon primary-text flex-center"><i class="fa-solid fa-phone"></i></div>
                            <div>
                                <p class="text-light2 p-small mb-1">Call Us:</p>
                                <p class="p-large fw-500">+96 156 996 665</p>
                            </div>
                        </div>
                        <div class="event-map__info-card-row flex-v-center rounded-4 gap-1 mb-3 gap-2">
                            <div class="icon primary-text flex-center"><i class="fa-regular fa-envelope"></i></div>
                            <div>
                                <p class="text-light2 p-small mb-1">Email Us:</p>
                                <p class="p-large fw-500">Contact.exploredsaudi.com</p>
                            </div>
                        </div>
                        <div class="event-map__info-card-row flex-v-center rounded-4 gap-1 mb-3 gap-2">
                            <div class="icon primary-text flex-center"><i class="fa-brands fa-whatsapp"></i></div>
                            <div>
                                <p class="text-light2 p-small mb-1">Whatsapp:</p>
                                <p class="p-large fw-500">+916656 65656</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="contact-office_wrapper text-white">
                <div class="section__header">
                    <div class="section__header-content gap-1">
                        <p class="p-large fw-600">Locate Us</p>
                        <h2 class="section__heading text-white">Offices</h2>
                        <p class="section__description">Embark on unforgettable journeys and explore the hidden gems
                            across the heart of Saudi Arabia</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-4">
                        <div class="contact-office_img-wrapper position-relative">
                            <img class="img-fluid" src="{{ asset('/frontend/assets/contact-office1.png') }}" alt="Contact Office">
                            <div class="contact-office__badge fw-600 text-black">Riyadh</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-office_img-wrapper position-relative">
                            <img class="img-fluid" src="{{ asset('/frontend/assets/contact-office2.png') }}" alt="Contact Office">
                            <div class="contact-office__badge fw-600 text-black">Jeddah</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-office_img-wrapper position-relative">
                            <img class="img-fluid" src="{{ asset('/frontend/assets/contact-office3.png') }}" alt="Contact Office">
                            <div class="contact-office__badge fw-600 text-black">Abha</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="news-event section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4 d-flex align-items-center">
                    <div class="section__header flex-column align-items-start gap-4">
                        <div class="section__header-content">
                            <h2 class="section__heading">News and Events</h2>
                            <p class="section__description">Discover inspiring travel stories and valuable insights from
                                across Saudi
                                Arabia. From hidden cultural gems to modern attractions, explore real experiences that
                                help you plan
                                your journey better.</p>
                        </div>
                        <div class="section__header-CTA">
                            <a href="#" class="btn btn-primary rounded-pill">
                                View All
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="news-event__carousel-container">
                        <div class="news-event__carousel-prev">
                            <i class="fa-solid fa-arrow-left"></i>
                        </div>
                        <div class="news-event__carousel swiper">
                            <div class="news-event__carousel-wrapper swiper-wrapper">
                                <div class="news-event__carousel-item swiper-slide">
                                    <img src="{{ asset('/frontend/assets/news-event1.jpg') }}" alt="News" class="img-fluid">
                                    <div class="news-event__carousel-item-info">
                                        <div class="small news-event__carousel-item-date mb-2">
                                            <i class="fa-solid fa-calendar"></i>
                                            Nov 28 | 15:30
                                        </div>
                                        <h6>Event Ideas that Celebrate Culture, Community...</h6>
                                    </div>
                                </div>
                                <div class="news-event__carousel-item swiper-slide">
                                    <img src="{{ asset('/frontend/assets/news-event2.jpg') }}" alt="News" class="img-fluid">
                                    <div class="news-event__carousel-item-info">
                                        <div class="small news-event__carousel-item-date mb-2">
                                            <i class="fa-solid fa-calendar"></i>
                                            Nov 28 | 15:30
                                        </div>
                                        <h6>Event Ideas that Celebrate Culture, Community...</h6>
                                    </div>
                                </div>
                                <div class="news-event__carousel-item swiper-slide">
                                    <img src="{{ asset('/frontend/assets/news-event3.jpg') }}" alt="News" class="img-fluid">
                                    <div class="news-event__carousel-item-info">
                                        <div class="small news-event__carousel-item-date mb-2">
                                            <i class="fa-solid fa-calendar"></i>
                                            Nov 28 | 15:30
                                        </div>
                                        <h6>Event Ideas that Celebrate Culture, Community...</h6>
                                    </div>
                                </div>
                                <div class="news-event__carousel-item swiper-slide">
                                    <img src="{{ asset('/frontend/assets/news-event4.jpg') }}" alt="News" class="img-fluid">
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

    <section class="section-padding-md">
        <div class="container">
            <div class="section__header align-items-center">
                <div class="section__header-content">
                    <h2 class="section__heading">FAQ’s</h2>
                    <p class="section__description">Find answers to the most common questions people ask</p>
                </div>
                <div class="section__header-CTA">
                    <a href="#" class="btn btn-primary rounded-pill">
                        View All
                        <i class="fa-solid fa-angles-right"></i>
                    </a>
                </div>
            </div>
            <div class="event-listing__faq" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqOne">
                        <button class="accordion-button p-large fw-600" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapseOne" aria-expanded="true" aria-controls="faqCollapseOne">
                            What is the refund policy for event bookings?
                        </button>
                    </h2>
                    <div id="faqCollapseOne" class="accordion-collapse collapse show" aria-labelledby="faqOne"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p class="text-light2">Webflow is a powerful visual development platform that allows
                                designers to build fully responsive websites without writing a single line of code. It
                                combines the flexibility of code with the simplicity of a visual editor, empowering
                                creators to bring their ideas to life faster and more efficiently than ever before.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqTwo">
                        <button class="accordion-button collapsed p-large fw-600" type="button"
                            data-bs-toggle="collapse" data-bs-target="#faqCollapseTwo" aria-expanded="false"
                            aria-controls="faqCollapseTwo">
                            What is Saudi famous for?
                        </button>
                    </h2>
                    <div id="faqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="faqTwo"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p class="text-light2">Webflow is a powerful visual development platform that allows
                                designers to build fully responsive websites without writing a single line of code. It
                                combines the flexibility of code with the simplicity of a visual editor, empowering
                                creators to bring their ideas to life faster and more efficiently than ever before.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector("form");
    const preloader = document.getElementById("preloader");
    const successMsg = document.getElementById("success-message");

    form.addEventListener("submit", function (e) {
        e.preventDefault(); // Stop normal submit behavior

        preloader.style.display = "block"; // Show loader

        let formData = new FormData(form);

        fetch(form.getAttribute("action"), {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            preloader.style.display = "none";      // Hide preloader
            successMsg.style.display = "block";    // Show success message
            form.reset();                          // Clear form fields
        })
        .catch(error => {
            preloader.style.display = "none";
            alert("Something went wrong. Please try again.");
        });
    });
});
</script>


    @endsection