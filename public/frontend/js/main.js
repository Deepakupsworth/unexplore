// =============================
// SWIPER INITIALIZATIONS
// =============================

const swiperInstances = [];
const isRTL = () => $('html').attr('dir') === 'rtl';


const initSwiper = (selector, options) => {
  document.querySelectorAll(selector).forEach(el => {
    const swiper = new Swiper(el, {
      ...options,
      rtl: isRTL(),
      direction: 'horizontal'
    });
    swiperInstances.push(swiper);
  });
};

const initSwiperWithThumbs = (parentSelector, thumbSelector, parentOptions, thumbOptions) => {
  const thumbSwiper = new Swiper(thumbSelector, {
    ...thumbOptions,
    rtl: isRTL()
  });

  const parentSwiper = new Swiper(parentSelector, {
    ...parentOptions,
    rtl: isRTL(),
    thumbs: {
      swiper: thumbSwiper,
    },
  });

  swiperInstances.push(thumbSwiper, parentSwiper);
};

const initAllSwipers = () => {

  // Hero Banner
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
      renderBullet: (_, className) => `<span class="${className}"></span>`,
    },
    breakpoints: {
      767: { slidesPerView: "auto", spaceBetween: 20 },
    },
  });

  // Discover / Offers / Events
  initSwiper(".dis-adventure__carousel, .exclusive-offers__carousel, .upcoming-event__carousel", {
    slidesPerView: 1,
    spaceBetween: 26,
    pagination: {
      el: ".custom__carousel-pagination",
      clickable: true,
      renderBullet: (_, className) => `<span class="${className}"></span>`,
    },
    breakpoints: {
      768: { slidesPerView: 2, spaceBetween: 20 },
      991: { slidesPerView: 3, spaceBetween: 20 },
      1199: { slidesPerView: 4, spaceBetween: 20 },
    },
  });

  // News
  initSwiper(".news-event__carousel", {
    slidesPerView: 1,
    spaceBetween: 26,
    navigation: {
      nextEl: ".news-event__carousel-next",
      prevEl: ".news-event__carousel-prev",
    },
    breakpoints: {
      767: { slidesPerView: 2 },
      1199: { slidesPerView: 3 },
    },
  });

  // Destination Banner
  initSwiper(".dest-banner__carousel", {
    slidesPerView: 1,
    spaceBetween: 26,
    breakpoints: {
      767: { slidesPerView: 2 },
      1199: { slidesPerView: 4 },
    },
  });

  // Stories
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


  initSwiper(".golf-locations__carousel", {
    slidesPerView: 1,
    spaceBetween: 20,
    pagination: {
      el: ".golf-locations__carousel-pagination",
      clickable: true,
      renderBullet: (index, className) => `<span class="${className}"></span>`,
    },
    breakpoints: {
      767: { slidesPerView: 3, spaceBetween: 12 },
      1199: { slidesPerView: 4, spaceBetween: 12 },
    },
  });

  initSwiper(".golf-highlights__carousel", {
    slidesPerView: 1,
    spaceBetween: 20,
    pagination: {
      el: ".golf-highlights__carousel-pagination",
      clickable: true,
      renderBullet: (index, className) => `<span class="${className}"></span>`,
    },
    breakpoints: {
      767: { slidesPerView: 3, spaceBetween: 12 },
      1199: { slidesPerView: 4, spaceBetween: 12 },
    },
  });

  // Package Details Thumbs
  initSwiperWithThumbs(
    ".pkg-details__banner-parent-carousel-wrapper",
    ".pkg-details__banner-carousel",
    {
      slidesPerView: 1,
      spaceBetween: 10,
      navigation: {
        nextEl: ".pkg-details__banner-next",
        prevEl: ".pkg-details__banner-prev",
      },
    },
    {
      slidesPerView: 2,
      spaceBetween: 10,
      freeMode: true,
      watchSlidesProgress: true,
      breakpoints: {
        767: { slidesPerView: 4 },
        1199: { slidesPerView: 4 },
      },
    }
  );

  // Gallery Modal Thumbs
  initSwiperWithThumbs(
    ".gallery-modal-parent-carousel-wrapper",
    ".gallery-modal-carousel-wrapper",
    {
      allowTouchMove: false,
      spaceBetween: 10,
      pagination: {
        el: ".gallery-swiper-pagination",
        type: "fraction",
      },
      breakpoints: {
        0: { allowTouchMove: true },
        575: { allowTouchMove: false },
      },
    },
    {
      navigation: {
        nextEl: ".gallery-carousel__next",
        prevEl: ".gallery-carousel__prev",
      },
      breakpoints: {
        767: { slidesPerView: 4 },
        1199: { slidesPerView: 5 },
      },
    }
  );
};

let mobileGallerySwiper = null;

const initMobileGallerySwiper = () => {
  const isMobile = window.innerWidth < 768;

  if (isMobile && !mobileGallerySwiper) {
    mobileGallerySwiper = new Swiper('.gallery-wrapper', {
      slidesPerView: 'auto',
      spaceBetween: 0,
      freeMode: true,
      grabCursor: true,
      rtl: isRTL(),
    });
  }

  if (!isMobile && mobileGallerySwiper) {
    mobileGallerySwiper.destroy(true, true);
    mobileGallerySwiper = null;
  }
};


$(document).ready(function () {
  initAllSwipers();

  // Mobile-only gallery slider
  initMobileGallerySwiper();

  $(window).on('resize', function () {
    initMobileGallerySwiper();
  });


});

// const initThumbSwiper = (selector, options) => {
//   return new Swiper(selector, { ...options, rtl: $('html').attr('dir') === 'rtl' });
// };


// Parent Swiper with Thumbs
// initSwiperWithThumbs(
//   ".pkg-details__banner-parent-carousel-wrapper",
//   ".pkg-details__banner-carousel",
//   {
//     spaceBetween: 10,
//     slidesPerView: 1,
//     navigation: {
//       nextEl: ".pkg-details__banner-next",
//       prevEl: ".pkg-details__banner-prev",
//     },
//   },
//   {
//     spaceBetween: 10,
//     slidesPerView: 2,
//     freeMode: true,
//     watchSlidesProgress: true,
//     breakpoints: {
//       767: { slidesPerView: 4, spaceBetween: 12 },
//       1199: { slidesPerView: 4, spaceBetween: 12 },
//     },
//   }
// );

// Parent Swiper with Thumbs
// initSwiperWithThumbs(
//   ".gallery-modal-parent-carousel-wrapper",
//   ".gallery-modal-carousel-wrapper",
//   {
//     spaceBetween: 10,
//     allowTouchMove: false,
//     pagination: {
//       el: ".gallery-swiper-pagination",
//       type: "fraction",
//     },
//     breakpoints: {
//       0: {
//         allowTouchMove: true   // mobile
//       },
//       575: {
//         allowTouchMove: false  // tablet & desktop
//       }
//     },
//   },
//   {
//     spaceBetween: 10,
//     allowTouchMove: false,
//     // watchSlidesProgress: true,
//     navigation: {
//       nextEl: ".gallery-carousel__next",
//       prevEl: ".gallery-carousel__prev",
//     },
//     breakpoints: {
//       767: { slidesPerView: 4, spaceBetween: 24 },
//       1199: { slidesPerView: 5, spaceBetween: 24 }
//     },
//   }
// );

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

$('body').on('click', '.nav-item.dropdown .nav-link', function (e) {
  const $menu = $(this).next('.dropdown-menu');
  const rect = $menu[0].getBoundingClientRect();

  const viewportWidth = $(window).width();
  const overflowRight = rect.right - viewportWidth;
  const overflowLeft = rect.left;

  // Reset first
  $menu.css({ left: '', right: '', transform: '' });

  // If overflowing right → shift left
  if (overflowRight > 0) {
    $menu.css('left', `-${overflowRight + 10}px`);
  }

  // If overflowing left → shift right
  if (overflowLeft < 0) {
    $menu.css('left', `${Math.abs(overflowLeft) + 10}px`);
  }
});

$(document).ready(function () {

  // Prevent dropdown from closing on inside click
  $('body').on('click', '.travellers-dropdown', function (e) {
    e.stopPropagation();
  });

  // Counter Buttons
  $('body').on('click', '.traveller-counter-btn', function () {
    let countEl = $(this).siblings('.count');
    let value = parseInt(countEl.text());

    if ($(this).hasClass('plus')) {
      value++;
    } else if ($(this).hasClass('minus') && value > 0) {
      value--;
    }

    countEl.text(value);

    // Enable/disable minus btn
    updateMinusButtonState($(this).closest('.traveller-counter'));
    updateTravellerLabel();
  });

  // Chips (Travel Classes)
  $('body').on('click', '.traveller-chip', function () {

    // If this chip is already active → remove it
    if ($(this).hasClass('active')) {
      $(this).removeClass('active');
    }
    else {
      // Otherwise activate only this chip
      $(this).removeClass('active');
      $(this).addClass('active');
    }
    updateTravellerLabel();
  });


  // Update button text
  function updateTravellerLabel() {
    let adults = parseInt($('.traveller-row').eq(0).find('.count').text());
    let cls = $('.chip.active').text();

    $('.travellers-btn').text(`${adults} Adult • ${cls}`);
  }

  function updateMinusButtonState(counter) {
    let count = parseInt(counter.find('.count').text());
    let minusBtn = counter.find('.minus');

    if (count === 0) {
      minusBtn.prop('disabled', true).addClass('disabled-btn');
    } else {
      minusBtn.prop('disabled', false).removeClass('disabled-btn');
    }
  }

  $('body').on('click', '.langToggleBtn', function () {
    const $btn = $('.langToggleBtn');
    const isEN = $(this).text().trim() === 'EN';

    if (isEN) {
      $btn.text('AR');
      $('html').attr({ dir: 'rtl', lang: 'ar' });
      $('body').addClass('rtl').removeClass('ltr');
    } else {
      $btn.text('EN');
      $('html').attr({ dir: 'ltr', lang: 'en' });
      $('body').addClass('ltr').removeClass('rtl');
    }

    // 🔥 Destroy all Swipers
    swiperInstances.forEach(swiper => swiper.destroy(true, true));
    swiperInstances.length = 0;

    // 🔥 Re-init with new direction
    initAllSwipers();
  });


});



// $('.view-gallery-btn').trigger('click');


$('body').on('click', '#galleryTabs .nav-link', function () {
  const targetId = $(this).data('target');
  const targetEl = $('#' + targetId);

  if (!targetEl.length) return;

  $('.gallery-tabs .nav-link').removeClass('active');
  $(this).addClass('active');

  $('.gallery-tab-content').removeClass('active');
  $('#' + targetId).addClass('active');

  $('.gallery-section-pills').addClass('d-none');
  $(`.gallery-section-pills[data-tab="${targetId}"]`).removeClass('d-none');
  $(`.gallery-section-pills[data-tab="${targetId}"]`).find('.filter-pill').removeClass('active');
  $(`.gallery-section-pills[data-tab="${targetId}"]`).find('.filter-pill').first().addClass('active');
});

$('body').on('click', '.filter-pill', function () {
  const sectionKey = $(this).data('section');
  const $activeTab = $('.gallery-tab-content.active');
  const $targetSection = $activeTab.find(
    `.gallery-modal-section[data-section="${sectionKey}"]`
  );

  if (!$targetSection.length) return;

  $(this)
    .addClass('active')
    .siblings('.filter-pill')
    .removeClass('active');

  const $scrollContainer = $('#galleryModal');

  const containerTop = $scrollContainer.scrollTop();
  const targetTop = $targetSection.offset().top;
  const containerOffset = $scrollContainer.offset().top;
  $scrollContainer.animate(
    {
      scrollTop: containerTop + (targetTop - containerOffset) - 200
    },
    400
  );
});

const activatePillOnScroll = () => {
  const $activeTab = $('.gallery-tab-content.active');
  const activeTabId = $activeTab.attr('id');

  const $filters = $(
    `.gallery-section-pills[data-tab="${activeTabId}"] .filter-pill`
  );

  const $scrollContainer = $('#galleryModal');
  const scrollTop = $scrollContainer.scrollTop();

  let currentSection = null;

  $activeTab.find('.gallery-modal-section').each(function () {
    const offsetTop = $(this).position().top;

    if (offsetTop <= scrollTop + 60) {
      currentSection = $(this).data('section');
    }
  });
  if (!currentSection) return;

  $filters.removeClass('active');
  $filters
    .filter(`[data-section="${currentSection}"]`)
    .addClass('active');
};


$('#galleryModal').on('scroll', activatePillOnScroll);

let pendingTabToOpen = null;
let pendingSectionToOpen = null;

$('body').on('click', '.open-gallery', function () {
  pendingTabToOpen = $(this).data('open-tab');
  pendingSectionToOpen = $(this).data('open-section') || null;
});

$('#galleryModal').on('shown.bs.modal', function () {
  if (!pendingTabToOpen) return;

  // Activate tab button
  const $tabButton = $(
    `#galleryTabs .nav-link[data-target="${pendingTabToOpen}"]`
  );

  $tabButton.trigger('click');

  // Optional: scroll to specific section
  if (pendingSectionToOpen) {
    setTimeout(() => {
      const $activeTab = $('.gallery-tab-content.active');
      const $section = $activeTab.find(
        `.gallery-modal-section[data-section="${pendingSectionToOpen}"]`
      );

      if ($section.length) {
        $('.gallery-tab-content-wrapper').animate(
          {
            scrollTop: $section.position().top - 20
          },
          400
        );
      }
    }, 150);
  }

  // reset
  pendingTabToOpen = null;
  pendingSectionToOpen = null;
});
