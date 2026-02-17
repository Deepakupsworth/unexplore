@extends('frontend.layout')

@section('content')
    <!-- 1. BLOG DETAILS -->
    <section class="blog-details__section">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-9">
                    <div class="blog-details__header p-4">
                        <!-- Category Tag -->
                        <p class="blog-category-badge rounded-4 text-black fw-500 w-fit">Technology</p>
                        <!-- Title -->
                        <h1 class="fw-600 text-white mt-3 mb-4 h3">
                            The Impact of Technology on the Workplace: How Technology is Changing
                        </h1>
                        <!-- Author Info -->
                        <div class="d-flex align-items-center gap-4">
                            <div class="d-flex align-items-center gap-2">
                                <div class="blog-details__user-avatar">
                                    <i class="fa-solid fa-circle-user"></i>
                                </div>
                                <p class="text-white">Tracey Wilson</p>
                            </div>
                            <p class="text-white">August 20, 2022</p>
                        </div>
                    </div>

                    <div class="mt-3 blog-details__img-wrapper">
                        <img class="img-fluid" src="{{ asset('frontend/assets/old-town.png') }}" alt="Old Town">
                    </div>

                    <div class="blog-details__content">
                        <p class="p-large">
                            Traveling is an enriching experience that opens up new horizons, exposes us to different
                            cultures, and creates memories that last a lifetime. However, traveling can also be
                            stressful and overwhelming, especially if you don't plan and prepare adequately. In this
                            blog article, we'll explore tips and tricks for a memorable journey and how to make the most
                            of your travels.
                        </p>
                        <p class="p-large">
                            One of the most rewarding aspects of traveling is immersing yourself in the local culture
                            and customs. This includes trying local cuisine, attending cultural events and festivals,
                            and interacting with locals. Learning a few phrases in the local language can also go a long
                            way in making connections and showing respect.
                        </p>
                        <p class="p-large">
                            Before embarking on your journey, take the time to research your destination. This includes
                            understanding the local culture, customs, and laws, as well as identifying top attractions,
                            restaurants, and accommodations. Doing so will help you navigate your destination with
                            confidence and avoid any cultural faux pas.
                        </p>
                        <p class="p-large">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. In hendrerit gravida rutrum quisque non tellus orci ac auctor. Mi
                            ipsum faucibus vitae aliquet nec ullamcorper sit amet. Aenean euismod elementum nisi quis
                            eleifend quam adipiscing vitae. Viverra adipiscing at in tellus.
                        </p>
                        <h4 class="fw-600 mt-2">Research Your Destination</h4>
                        <p class="p-large">While it's essential to leave room for spontaneity and unexpected adventures,
                            having a rough itinerary can help you make the most of your time and budget. Identify the
                            must-see sights and experiences and prioritize them according to your interests and preferences.
                            This will help you avoid overscheduling and ensure that you have time to relax and enjoy your
                            journey.</p>
                        <p class="p-large">Vitae sapien pellentesque habitant morbi tristique. Luctus venenatis lectus magna
                            fringilla. Nec ullamcorper sit amet risus nullam eget felis. Tincidunt arcu non sodales neque
                            sodales ut etiam sit amet.</p>
                        <h4 class="fw-600 mt-2">Plan Your Itinerary</h4>
                        <div class="blog-details__content-itinerary">
                            <p>“ Traveling can expose you to new environments and potential health risks, so it's crucial to
                                take precautions to stay safe and healthy. ”</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card pkg-details__pricing-card checkout-pricing-card py-4">
                        <div class="input-group package-listing__search-bar">
                            <input type="text" class="form-control" placeholder="Browse Package, Locations"
                                aria-label="Browse Package, Location">
                            <button class="btn" type="button">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card pkg-details__pricing-card checkout-pricing-card py-4 mt-3">
                        <p class="p-large package-listing__filter-title">Recent Blogs</p>
                        <div class="blog-details__recent-wrapper">
                            <div class="blog-details__recent-blog-card">
                                <a href="#" class="fw-500">
                                    Event Ideas that Celebrate Culture, Community...
                                </a>
                                <p class="text-light3 p-small">24 December 2025</p>
                                <hr class="m-0 w-100">
                            </div>
                            <div class="blog-details__recent-blog-card">
                                <a href="#" class="fw-500">
                                    Event Ideas that Celebrate Culture, Community...
                                </a>
                                <p class="text-light3 p-small">24 December 2025</p>
                                <hr class="m-0 w-100">
                            </div>
                            <div class="blog-details__recent-blog-card">
                                <a href="#" class="fw-500">
                                    Event Ideas that Celebrate Culture, Community...
                                </a>
                                <p class="text-light3 p-small">24 December 2025</p>
                                <hr class="m-0 w-100">
                            </div>
                            <div class="blog-details__recent-blog-card">
                                <a href="#" class="fw-500">
                                    Event Ideas that Celebrate Culture, Community...
                                </a>
                                <p class="text-light3 p-small">24 December 2025</p>
                            </div>
                        </div>
                    </div>
                    <div class="card pkg-details__pricing-card py-4 mt-3">
                        <p class="p-large">Do you have questions or need more information?</p>
                        <button class="btn btn-outline-secondary rounded-pill fw-600 mt-3 pkg-details__get-more-help-btn">
                            Get More Help
                        </button>
                    </div>
                    <div class="py-4 mt-4">
                        <p>Share</p>
                        <div class="mt-2 pkg-details__share-icons">
                            <a href="#" class="flex-center">
                                <img src="{{ asset('frontend/assets/icons/instagram.svg') }}" alt="Instagram">
                            </a>
                            <a href="#" class="flex-center">
                                <img src="{{ asset('frontend/assets/icons/facebook.svg') }}" alt="Facebook">
                            </a>
                            <a href="#" class="flex-center">
                                <img src="{{ asset('frontend/assets/icons/facebook.svg') }}" alt="Facebook">
                            </a>
                            <a href="#" class="flex-center">
                                <img src="{{ asset('frontend/assets/icons/x.svg') }}" alt="X">
                            </a>
                            <a href="#" class="flex-center">
                                <img src="{{ asset('frontend/assets/icons/share.svg') }}" alt="Share">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
