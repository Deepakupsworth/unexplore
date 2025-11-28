// =============================
// SWIPER INITIALIZATIONS
// =============================

const initSwiper = (selector, options) => {
  const elements = document.querySelectorAll(selector);
  elements.forEach(el => new Swiper(el, options));
};

// Hero Banner Carousel
initSwiper(".hero-banner__carousel", {
  slidesPerView: 1,
  spaceBetween: 30,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    renderBullet: (index, className) => `<span class="${className}"></span>`,
  },
  breakpoints: {
    767: { slidesPerView: "auto", spaceBetween: 20 },
  },
});

// Discover / Offers / Events Carousels
initSwiper(".dis-adventure__carousel, .exclusive-offers__carousel, .upcoming-event__carousel", {
  slidesPerView: 1,
  spaceBetween: 26,
  pagination: {
    el: ".custom__carousel-pagination",
    clickable: true,
    renderBullet: (index, className) => `<span class="${className}"></span>`,
  },
  breakpoints: {
    768: { slidesPerView: 2, spaceBetween: 20 },
    991: { slidesPerView: 3, spaceBetween: 20 },
    1199: { slidesPerView: 4, spaceBetween: 20 },
  },
});

// News & Event Carousel
initSwiper(".news-event__carousel", {
  slidesPerView: 1,
  spaceBetween: 26,
  navigation: {
    nextEl: ".news-event__carousel-next",
    prevEl: ".news-event__carousel-prev",
  },
  breakpoints: {
    767: { slidesPerView: 2, spaceBetween: 20 },
    1199: { slidesPerView: 3, spaceBetween: 20 },
  },
});

// Destination Banner Carousel
initSwiper(".dest-banner__carousel", {
  slidesPerView: 1,
  spaceBetween: 26,
  breakpoints: {
    767: { slidesPerView: 2, spaceBetween: 20 },
    1199: { slidesPerView: 4, spaceBetween: 20 },
  },
});

// Stories & Insight Carousel
initSwiper(".stories-insight__carousel", {
  slidesPerView: 1,
  spaceBetween: 26,
  navigation: {
    nextEl: ".stories-insight__carousel-navigation-next",
    prevEl: ".stories-insight__carousel-navigation-prev",
  },
  breakpoints: {
    767: { slidesPerView: 2, spaceBetween: 20 },
    1199: { slidesPerView: 2, spaceBetween: 20 },
  },
});

// Package Details Banner Carousel
initSwiper(".pkg-details__banner-carousel", {
  slidesPerView: 1,
  spaceBetween: 12,
  breakpoints: {
    767: { slidesPerView: 4, spaceBetween: 12 },
    1199: { slidesPerView: 4, spaceBetween: 12 },
  },
});

// User Dashboard Packages Carousel
initSwiper(".user-dashboard__packages", {
  slidesPerView: 1,
  spaceBetween: 12,
  pagination: {
    el: ".user-dashboard__packages-pagination",
    clickable: true,
    renderBullet: (index, className) => `<span class="${className}"></span>`,
  },
});

const initThumbSwiper = (selector, options) => {
  return new Swiper(selector, options);
};

const initSwiperWithThumbs = (parentSelector, thumbSelector, parentOptions, thumbOptions) => {
  const thumbSwiper = new Swiper(thumbSelector, thumbOptions);

  new Swiper(parentSelector, {
    ...parentOptions,
    thumbs: {
      swiper: thumbSwiper,
    },
  });
};

// Parent Swiper with Thumbs
initSwiperWithThumbs(
  ".pkg-details__banner-parent-carousel-wrapper",
  ".pkg-details__banner-carousel",
  {
    spaceBetween: 10,
    slidesPerView: 1,
    navigation: {
      nextEl: ".pkg-details__banner-next",
      prevEl: ".pkg-details__banner-prev",
    },
  },
  {
    spaceBetween: 10,
    slidesPerView: 2,
    freeMode: true,
    watchSlidesProgress: true,
    breakpoints: {
      767: { slidesPerView: 4, spaceBetween: 12 },
      1199: { slidesPerView: 4, spaceBetween: 12 },
    },
  }
);

// =============================
// DROPDOWN VALUE UPDATER
// =============================
document.querySelectorAll('.package-listing__results-sort-dropdown').forEach(dropdown => {
  const valueSpan = dropdown.querySelector('.package-listing__results-sort-option');
  dropdown.querySelectorAll('.dropdown-item').forEach(item => {
    item.addEventListener('click', () => {
      valueSpan.textContent = item.textContent.trim();
    });
  });
});


// =============================
// PROFILE PHOTO UPLOAD HANDLER
// =============================
const uploadBtn = document.getElementById('uploadBtn');
const uploadPhoto = document.getElementById('uploadPhoto');

if (uploadBtn && uploadPhoto) {
  uploadBtn.addEventListener('click', () => uploadPhoto.click());
}

// Clear Package Filter Button Handler
$('body').on('click', '.clear-package', function () {
  $(this).closest('.package-listing__results-applied-fil').remove();
});

// Clear All Package Filter Button Handler
$('body').on('click', '#clear-all-package-filter', function () {
  $('#package-listing__applied-filters').remove();
});

$('body').on('change', '.package-listing__budget-filter-option input[type="checkbox"]', function () {
  const parent = $(this).closest('.package-listing__budget-filter-option');

  if ($(this).is(':checked')) {
    parent.addClass('active');
  } else {
    parent.removeClass('active');
  }
});

$('body').on('click', '.pkg-details__accordion-actions button', function (e) {
  e.stopPropagation(); // prevents accordion toggle
});