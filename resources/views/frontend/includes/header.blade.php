<header class="navbar navbar-expand-lg ">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ asset('frontend/assets/logo-white.png') }}" alt="Unxplord Saudi" class="header__logo" />

            <img src="{{ asset('frontend/assets/logo.png') }}" alt="Unxplord Saudi" class="header__logo-default" />
        </a>
        <button class="navbar-toggler text-white ms-auto" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="desktop-nav w-100">
            <nav class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="exploreDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span>Explore Saudi</span>
                            <i class="fa-solid fa-angle-down"></i>
                        </a>
                        <div class="dropdown-menu nav-menu-dropdown" aria-labelledby="exploreDropdown">
                            <div class="row">
                                <!-- Left column: Links -->
                                <div class="col-lg-7">
                                    <div class="nav-menu__left">
                                        <p class="fw-bold p-large nav-menu__heading">Explore Events</p>
                                        <div class="sub-menu-section">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="">
                                                        About Saudi
                                                        <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i>
                                                    </a></li>
                                                <li>

                                                <li><a href="#">Riyadh <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i></a>
                                                </li>
                                            </ul>
                                            <ul class="list-unstyled">
                                                <li><a href="#">Traditions in Saudi <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i></a>
                                                </li>
                                                <li><a href="#">Sports in Saudi <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i></a>
                                                </li>
                                                <li><a href="#">Thc local cuisine of Saudi <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i></a>
                                                </li>
                                                <li><a href="#">Wildlife <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Right column: About -->
                                <div class="col-lg-5">
                                    <div class="nav-menu__right">
                                        <p class="fw-bold p-large">About Saudi</p>
                                        <p class="text-muted small">Lorem ipsum dolor sit amet, consectetur adipiscing
                                            elit, sed do eiusmod
                                            tempor incididunt...</p>
                                        <img src="frontend/assets//about-saudi.png" alt="Saudi"
                                            class="img-fluid about-image">
                                        <img src="frontend/assets/nav-dropdown-side.png" alt="Image"
                                            class="nav-menu__right-side-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <!-- id="thingsToDoDropdown" role="button" data-bs-toggle="dropdown" -->
                        {{-- <a class="nav-link" href="{{route('things.to.do')}}" --}}
                        <a class="nav-link" href="#" id="thingsToDoDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span>Things to do </span>
                            <i class="fa-solid fa-angle-down"></i>
                        </a>

                        <div class="dropdown-menu nav-menu-dropdown" aria-labelledby="thingsToDoDropdown">
                            <div class="row">
                                <!-- Left column: Links -->
                                <div class="col-lg-7">
                                    <div class="nav-menu__left">
                                        <p class="fw-bold p-large nav-menu__heading">Explore Things to do</p>
                                        <div class="sub-menu-section">
                                            <ul class="list-unstyled">
                                                @foreach (header_todos() as $category)
                                                    @if ($category->things_count > 0)
                                                        <li>
                                                            <a href="{{ route('things.to.do', [
                                                                'categories[]' => $category->id
                                                            ]) }}">
                                                                {{ $category->translation?->name }}
                                                                ({{ $category->things_count }})
                                                                <i
                                                                    class="fa-solid fa-angles-right primary-text flex-v-center"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                                <li class="fw-bold">
                                                    <a href="{{ route('things.to.do') }}">
                                                        All Things to Do
                                                        <i class="fa-solid fa-angles-right primary-text"></i>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Right column: About -->
                                <div class="col-lg-5">
                                    <div class="nav-menu__right">
                                        <p class="fw-bold p-large">About Saudi</p>
                                        <p class="text-muted small">Lorem ipsum dolor sit amet, consectetur adipiscing
                                            elit, sed do eiusmod
                                            tempor incididunt...</p>
                                        <img src="frontend/assets/about-saudi.png" alt="Saudi"
                                            class="img-fluid about-image">
                                        <img src="frontend/assets/nav-dropdown-side.png" alt="Image"
                                            class="nav-menu__right-side-img">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="eventsDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span>Events & Festivals</span>
                            <i class="fa-solid fa-angle-down"></i>
                        </a>
                        <div class="dropdown-menu nav-menu-dropdown" aria-labelledby="eventsDropdown">
                            <div class="row">
                                <!-- Left column: Links -->
                                <div class="col-lg-7">
                                    <div class="nav-menu__left">
                                        <p class="fw-bold p-large nav-menu__heading">Explore Events</p>
                                        <div class="sub-menu-section">
                                            <ul class="list-unstyled">

                                                @foreach (header_event_categories() as $category)
                                                    @if ($category->events_count > 0)
                                                        <li>
                                                            <a
                                                                href="{{ route('event.listing', [
                                                                    'categories[]' => $category->id,
                                                                ]) }}">
                                                                {{ $category->translationData?->name }}
                                                                ({{ $category->events_count }})
                                                                <i
                                                                    class="fa-solid fa-angles-right primary-text flex-v-center"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endforeach

                                                {{-- 🔥 ALL EVENTS (Professional default) --}}
                                                <li class="fw-bold">
                                                    <a href="{{ route('event.listing') }}">
                                                        All Events
                                                        <i class="fa-solid fa-angles-right primary-text flex-v-center"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Right column: About -->
                                <div class="col-lg-5">
                                    <div class="nav-menu__right">
                                        <p class="fw-bold p-large">About Saudi</p>
                                        <p class="text-muted small">Lorem ipsum dolor sit amet, consectetur adipiscing
                                            elit, sed do eiusmod
                                            tempor incididunt...</p>
                                        <img src="frontend/assets//about-saudi.png" alt="Saudi"
                                            class="img-fluid about-image">
                                        <img src="frontend/assets/nav-dropdown-side.png" alt="Image"
                                            class="nav-menu__right-side-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="dealsDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span>Deals & Offers</span>
                            <i class="fa-solid fa-angle-down"></i>
                        </a>
                        <div class="dropdown-menu nav-menu-dropdown" aria-labelledby="dealsDropdown">
                            <div class="row">
                                <!-- Left column: Links -->
                                <div class="col-lg-7">
                                    <div class="nav-menu__left">
                                        <p class="fw-bold p-large nav-menu__heading">Explore Events</p>
                                        <div class="sub-menu-section">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="">
                                                        About Saudi
                                                        <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i>
                                                    </a></li>
                                                <li>
                                                <li><a href="#" class="">
                                                        Geography of Saudi
                                                        <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i>
                                                    </a></li>
                                                <li><a href="#">History of Saudi <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i></a>
                                                </li>
                                                <li><a href="#">Saudi's climate <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i></a>
                                                </li>
                                                <li><a href="#">Towns & cities in Saudi <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i></a>
                                                </li>
                                                <li><a href="#">Riyadh <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i></a>
                                                </li>
                                            </ul>
                                            <ul class="list-unstyled">
                                                <li><a href="#">Traditions in Saudi <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i></a>
                                                </li>
                                                <li><a href="#">Sports in Saudi <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i></a>
                                                </li>
                                                <li><a href="#">Thc local cuisine of Saudi <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i></a>
                                                </li>
                                                <li><a href="#">Wildlife <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Right column: About -->
                                <div class="col-lg-5">
                                    <div class="nav-menu__right">
                                        <p class="fw-bold p-large">About Saudi</p>
                                        <p class="text-muted small">Lorem ipsum dolor sit amet, consectetur adipiscing
                                            elit, sed do eiusmod
                                            tempor incididunt...</p>
                                        <img src="frontend/assets//about-saudi.png" alt="Saudi"
                                            class="img-fluid about-image">
                                        <img src="frontend/assets/nav-dropdown-side.png" alt="Image"
                                            class="nav-menu__right-side-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="calendarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span>Saudi Calendar</span>
                            <i class="fa-solid fa-angle-down"></i>
                        </a>
                        <div class="dropdown-menu nav-menu-dropdown" aria-labelledby="calendarDropdown">
                            <div class="row">
                                <!-- Left column: Links -->
                                <div class="col-lg-7">
                                    <div class="nav-menu__left">
                                        <p class="fw-bold p-large nav-menu__heading">Explore Events</p>
                                        <div class="sub-menu-section">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="">
                                                        About Saudi
                                                        <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i>
                                                    </a></li>
                                                <li>
                                                <li><a href="#" class="">
                                                        Geography of Saudi
                                                        <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i>
                                                    </a></li>
                                                <li><a href="#">History of Saudi <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i></a>
                                                </li>
                                                <li><a href="#">Saudi's climate <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i></a>
                                                </li>
                                                <li><a href="#">Towns & cities in Saudi <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i></a>
                                                </li>
                                                <li><a href="#">Riyadh <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i></a>
                                                </li>
                                            </ul>
                                            <ul class="list-unstyled">
                                                <li><a href="#">Traditions in Saudi <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i></a>
                                                </li>
                                                <li><a href="#">Sports in Saudi <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i></a>
                                                </li>
                                                <li><a href="#">Thc local cuisine of Saudi <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i></a>
                                                </li>
                                                <li><a href="#">Wildlife <i
                                                            class="fa-solid fa-angles-right primary-text flex-v-center"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Right column: About -->
                                <div class="col-lg-5">
                                    <div class="nav-menu__right">
                                        <p class="fw-bold p-large">About Saudi</p>
                                        <p class="text-muted small">Lorem ipsum dolor sit amet, consectetur adipiscing
                                            elit, sed do eiusmod
                                            tempor incididunt...</p>
                                        <img src="frontend/assets//about-saudi.png" alt="Saudi"
                                            class="img-fluid about-image">
                                        <img src="frontend/assets/nav-dropdown-side.png" alt="Image"
                                            class="nav-menu__right-side-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="d-flex flex-wrap align-items-center gap-2 navbar__buttons">
                    <!-- When user is not logged in -->
                    <!-- <a href="#" class="btn btn-outline-light rounded-pill">Login / Sign Up</a>
     <a href="#" class="btn btn-primary rounded-pill">
      Book Now
      <i class="fa-solid fa-angles-right"></i>
     </a> -->
                    @if (!empty(@auth()->user()->id))
                        <!-- When user is logged in -->
                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle rounded-pill gap-2" type="button"
                                id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-circle-user"></i>
                                {{ Auth()?->user()->first_name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="/profile">My Profile</a></li>

                                <li>
                                    <form method="POST" action="/logout">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            Logout
                                        </button>
                                    </form>
                                </li>

                            </ul>
                        </div>
                    @endif
                </div>
            </nav>
        </div>
        <div class="mobile-nav">
            <nav class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <div class="mx-3">
                    <div class="accordion" id="navbarAccordion">
                        <div class="accordion-item">
                            <button href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#collapseNavOne" aria-expanded="true" aria-controls="collapseNavOne">
                                Explore Saudi
                            </button>
                            <div id="collapseNavOne" class="accordion-collapse collapse"
                                data-bs-parent="#navbarAccordion">
                                <ul class="navbar-nav pt-2 mt-1 ps-3">
                                    <li>
                                        <a href="#" class="nav-link">
                                            About Saudi

                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="nav-link">
                                            Geography of Saudi

                                        </a>
                                    </li>
                                    <li><a href="#" class="nav-link">History of Saudi</a></li>
                                    <li><a href="#" class="nav-link">Saudi's climate</a></li>
                                    <li><a href="#" class="nav-link">Towns &amp; cities in Saudi</a></li>
                                    <li><a href="#" class="nav-link">Riyadh</a></li>
                                    <li><a href="#" class="nav-link">Traditions in Saudi</a></li>
                                    <li><a href="#" class="nav-link">Sports in Saudi</a></li>
                                    <li><a href="#" class="nav-link">Thc local cuisine of Saudi</a></li>
                                    <li><a href="#" class="nav-link">Wildlife</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="accordion-item mt-3">
                            <button href="{{ route('things.to.do') }}" class="accordion-button collapsed"
                                data-bs-toggle="collapse" data-bs-target="#collapseNavTwo" aria-expanded="true"
                                aria-controls="collapseNavTwo">
                                Things to do
                            </button>
                            <div id="collapseNavTwo" class="accordion-collapse collapse"
                                data-bs-parent="#navbarAccordion">
                                <ul class="navbar-nav pt-2 mt-1 ps-3">
                                    <li>
                                        <a href="#" class="nav-link">
                                            About Saudi

                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="nav-link">
                                            Geography of Saudi

                                        </a>
                                    </li>
                                    <li><a href="#" class="nav-link">History of Saudi</a></li>
                                    <li><a href="#" class="nav-link">Saudi's climate</a></li>
                                    <li><a href="#" class="nav-link">Towns &amp; cities in Saudi</a></li>
                                    <li><a href="#" class="nav-link">Riyadh</a></li>
                                    <li><a href="#" class="nav-link">Traditions in Saudi</a></li>
                                    <li><a href="#" class="nav-link">Sports in Saudi</a></li>
                                    <li><a href="#" class="nav-link">Thc local cuisine of Saudi</a></li>
                                    <li><a href="#" class="nav-link">Wildlife</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="accordion-item mt-3">
                            <button href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#collapseNavThree" aria-expanded="true"
                                aria-controls="collapseNavThree">
                                Events & Festivals
                            </button>
                            <div id="collapseNavThree" class="accordion-collapse collapse"
                                data-bs-parent="#navbarAccordion">
                                <ul class="navbar-nav pt-2 mt-1 ps-3">
                                    <li>
                                        <a class="nav-link" href="#">
                                            <span>Explore Saudi</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#">
                                            <span>Explore Saudi</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="accordion-item mt-3">
                            <button href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#collapseNavFour" aria-expanded="true"
                                aria-controls="collapseNavFour">
                                Deals & Offers
                            </button>
                            <div id="collapseNavFour" class="accordion-collapse collapse"
                                data-bs-parent="#navbarAccordion">
                                <ul class="navbar-nav pt-2 mt-1 ps-3">
                                    <li>
                                        <a class="nav-link" href="#">
                                            <span>Explore Saudi</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#">
                                            <span>Explore Saudi</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="accordion-item mt-3">
                            <button href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#collapseNavFive" aria-expanded="true"
                                aria-controls="collapseNavFive">
                                Saudi Calendar
                            </button>
                            <div id="collapseNavFive" class="accordion-collapse collapse"
                                data-bs-parent="#navbarAccordion">
                                <ul class="navbar-nav pt-2 mt-1 ps-3">
                                    <li>
                                        <a class="nav-link" href="#">
                                            <span>Explore Saudi</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#">
                                            <span>Explore Saudi</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-wrap align-items-center gap-2 navbar__buttons">
                    <!-- When user is not logged in -->
                    <!-- <a href="#" class="btn btn-outline-light rounded-pill">Login / Sign Up</a>
     <a href="#" class="btn btn-primary rounded-pill">
      Book Now
      <i class="fa-solid fa-angles-right"></i>
     </a> -->
                </div>
                <!-- When user is logged in -->
                @if (!empty(@auth()->user()->id))
                    <div class="navbar__buttons d-flex flex-column gap-2 mt-3">
                        <a href="#" class="text-white d-flex gap-2 align-items-center text-decoration-none">
                            <i class="fa-solid fa-circle-user"></i>
                            {{ Auth()?->user()->first_name }}
                        </a>
                        <a href="#" class="text-white d-flex gap-2 align-items-center text-decoration-none"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Logout
                        </a>

                        <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                            @csrf
                        </form>

                    </div>
                @endif
            </nav>
        </div>
    </div>
</header>

<div class="feedback-button">
    <a href="#" class="feedback-button__link d-flex align-items-center">
        <span class="feedback-button__text">Feedback</span>
    </a>
</div>
