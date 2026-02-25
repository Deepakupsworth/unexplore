<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\ThingtodoController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\TransportController;
use App\Http\Controllers\Admin\AdminCouponController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Frontend\Event\EventController as FrontendEventController;

use App\Http\Controllers\DemoJsonController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Frontend\Blog\BlogController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Frontend\Checkout\CheckoutController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\PackagePricingController;
use App\Http\Controllers\Frontend\Package\PackageController as FrontendPackageController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ToDoThings\ToDoThingsController;
use App\Models\Event;
use App\Http\Controllers\Frontend\Profile\ProfileController as FrontendProfileController;
use App\Http\Controllers\Frontend\Destination\DestinationController as FrontendDestinationController;
use App\Http\Controllers\Frontend\{TravellerController, AddressController, AccountController, CouponApplyController};
use App\Http\Controllers\Frontend\Booking\BookingController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\CompanyDetailController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PackagePolicyController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Frontend\InfoPageController;

// routes/web.php
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'de', 'ar'])) {
        Session::put('locale', $locale);
        App::setLocale($locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/', [PageController::class, 'index'])->name('home');



Route::get('/signup', function () {
    return view('backend.pages.signup');
})->name('sign_up');



Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    // Auth Routes
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);


    // Password Reset
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'show'])
        ->name('checkout.view');

    Route::post('/checkout/book', [BookingController::class, 'store'])
        ->name('checkout.book');
    Route::get('/booking/success', [BookingController::class, 'success'])
        ->name('booking.success');
    Route::get('/test-booking-mail', [BookingController::class, 'testBookingMail']);

    Route::post(
        '/checkout/update-travellers-session',
        [CheckoutController::class, 'updateTravellerSession']
    )->name('checkout.update.session');

    Route::get('/checkout/search-traveller', [CheckoutController::class, 'searchTraveller'])
        ->name('checkout.search.traveller');
});


Route::middleware(['auth', 'user'])->group(function () {

    Route::get('/account', [AccountController::class, 'index'])
        ->name('account');

    Route::get('/account/load', [AccountController::class, 'loadTab'])
        ->name('account.load');

    Route::post('/account/addresses', [AddressController::class, 'store']);
    Route::get('/account/addresses/{id}', [AddressController::class, 'show']);
    Route::put('/account/addresses/{id}', [AddressController::class, 'update']);
    Route::delete('/account/addresses/{id}', [AddressController::class, 'destroy']);

    // optional
    Route::post('/account/addresses/{id}/restore', [AddressController::class, 'restore']);


    //travellers
    Route::get('/account/tab/travellers', [TravellerController::class, 'index']);

    Route::post('/account/travellers', [TravellerController::class, 'store']);
    Route::get('/account/travellers/{id}', [TravellerController::class, 'show']);
    Route::put('/account/travellers/{id}', [TravellerController::class, 'update']);
    Route::delete('/account/travellers/{id}', [TravellerController::class, 'destroy']);
    Route::get('/travellers/{traveller}', [TravellerController::class, 'show'])
        ->name('travellers.show');
});



Route::prefix('destinations')->group(function () {
    Route::get('/', [FrontendDestinationController::class, 'index'])
        ->name('destinations.index');

    Route::get('{slug}', [FrontendDestinationController::class, 'show'])
        ->name('destinations.show');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Dashboard

Route::middleware(['auth', RoleMiddleware::class . ':user'])->group(function () {
    Route::get('/user/dashboard', fn() => view('user.dashboard'))
        ->name('user.dashboard');
});


Route::get('/events', [FrontendEventController::class, 'index'])->name('event.listing');
Route::get('/events/{slug?}', [FrontendEventController::class, 'show'])->name('event.show');

Route::get('/events-filter', [FrontendEventController::class, 'filter'])->name('events.filter');


Route::middleware(['auth', 'admin'])->group(function () {

    // Notification
    Route::post('/admin/notifications/{id}/read', function ($id) {

        $notification = auth()->user()
            ->notifications()
            ->where('id', $id)
            ->first();

        if ($notification && is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        return response()->json([
            'success' => true
        ]);
    })->name('notifications.read');

    Route::post('/admin/notifications/mark-all-read', function () {
        auth()->user()->unreadNotifications->markAsRead();

        return back();
    })->name('notifications.markAllRead');

    Route::get('/admin/fix-package-day-items', [TestController::class, 'backfillPackageId'])
    ->name('admin.fix.package.day.items');

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');



    Route::prefix('admin')->group(function () {

        Route::get('/users', [UserController::class, 'index'])
            ->name('admin.users.index');

        Route::resource('coupon', AdminCouponController::class);
        Route::post('coupon/{coupon}/status', [AdminCouponController::class, 'status'])
            ->name('coupon.status');
        /*
        |--------------------------------------------------------------------------
        | Cities Routes
        |--------------------------------------------------------------------------
        */
        Route::prefix('cities')->group(function () {
            Route::get('/search', [CityController::class, 'search'])->name('cities.search');

            Route::get('/seachIds', [CityController::class, 'seachIds'])->name('cities.seachIds');

            Route::get('/', [CityController::class, 'index'])->name('cities.index');
            Route::get('/create', [CityController::class, 'form'])->name('cities.create');
            Route::get('/{id}/edit', [CityController::class, 'form'])->name('cities.edit');

            Route::get('/{id}', [CityController::class, 'show'])
                ->name('cities.show');
            Route::post('/save', [CityController::class, 'save'])->name('cities.save');
            Route::delete('/delete/{id}', [CityController::class, 'destroy'])->name('cities.delete');

            Route::delete('/gallery/delete/{id}', [CityController::class, 'deleteGalleryImage'])->name('cities.image.delete');
        });

        Route::prefix('gallery')->group(function () {
            Route::delete('/delete/{id}', [ImageController::class, 'destroy'])->name('gallery.delete');
        });

        /*
        |--------------------------------------------------------------------------
        | Categories Routes
        |--------------------------------------------------------------------------
        */
        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
            Route::get('/create', [CategoryController::class, 'form'])->name('categories.create');
            Route::get('/{id}/edit', [CategoryController::class, 'form'])->name('categories.edit');
            Route::post('/save', [CategoryController::class, 'save'])->name('categories.save');
            Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');
        });

        /*
        |--------------------------------------------------------------------------
        | Things To Do Routes
        |--------------------------------------------------------------------------
        */
        Route::prefix('thingtodo')->group(function () {

            Route::get('/', [ThingtodoController::class, 'index'])->name('thingtodos.index');

            Route::get('/create', [ThingtodoController::class, 'form'])->name('thingtodos.create');

            Route::get('/{id}/edit', [ThingtodoController::class, 'form'])->name('thingtodos.edit');

            Route::get('/{id}', [ThingtodoController::class, 'show'])->name('thingtodos.show');

            Route::post('/save', [ThingtodoController::class, 'save'])->name('thingtodos.save');

            Route::delete('/gallery/{id}', [ThingtodoController::class, 'deleteGalleryImage'])
                ->name('thingtodos.gallery.delete');

            Route::delete('/{id}', [ThingtodoController::class, 'destroy'])
                ->name('thingtodos.delete');
        });


        /*
        |--------------------------------------------------------------------------
        | Events Routes
        |--------------------------------------------------------------------------
        */
        Route::prefix('events')->group(function () {
            Route::get('/', [EventController::class, 'index'])->name('events.index');
            Route::get('/create', [EventController::class, 'form'])->name('events.create');
            Route::get('/{id}/edit', [EventController::class, 'form'])->name('events.edit');
            Route::get('/{id}', [EventController::class, 'show'])->name('events.show');
            Route::post('/save', [EventController::class, 'save'])->name('events.save');
            Route::delete('/delete/{id}', [EventController::class, 'destroy'])->name('events.delete');
            Route::delete('/gallery/delete/{id}', [EventController::class, 'deleteGalleryImage'])->name('events.gallery.delete');
        });
    });

    Route::prefix('admin')->group(function () {
        Route::get('/profile', [AuthController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [AuthController::class, 'edit'])->name('profile.edit');
        Route::post('/profile/update', [AuthController::class, 'update'])->name('profile.update');
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/countries', [CountryController::class, 'index'])->name('countries.index');
        Route::get('/countries/create', [CountryController::class, 'create'])->name('countries.create');
        Route::post('/countries', [CountryController::class, 'store'])->name('countries.store');
        Route::get('/countries/{id}/edit', [CountryController::class, 'edit'])->name('countries.edit');
        Route::put('/countries/{id}', [CountryController::class, 'update'])->name('countries.update');
        Route::delete('/countries/{id}', [CountryController::class, 'destroy'])->name('countries.destroy');
        // AJAX
        Route::patch('/countries/{id}/toggle-status', [CountryController::class, 'toggleStatus']);
        Route::post('/countries/import', [CountryController::class, 'import'])->name('admin.countries.import');

        Route::get('/apiImport', [CountryController::class, 'apiImport'])->name('apiImport');

        Route::get('/seo/{type}/{id}',[SeoController::class, 'edit'])->name('seo.edit');

        Route::post('/seo/{type}/{id}',[SeoController::class, 'update'])->name('seo.update');
    });

    Route::prefix('admin')->group(function () {
        Route::prefix('hotels')->group(function () {

            Route::get('/', [HotelController::class, 'index'])
                ->name('hotels.index');

            Route::get('/create', [HotelController::class, 'form'])
                ->name('hotels.create');

            Route::get('/{id}/edit', [HotelController::class, 'form'])
                ->name('hotels.edit');

            Route::get('/{id}', [HotelController::class, 'show'])
                ->name('hotels.show');

            Route::post('/save', [HotelController::class, 'save'])
                ->name('hotels.save');

            Route::delete('/{id}', [HotelController::class, 'delete'])
                ->name('hotels.delete');

            Route::delete('/gallery/{id}', [HotelController::class, 'deleteGallery'])
                ->name('hotels.gallery.delete');
        });
    });

    Route::prefix('admin')->group(function () {
        Route::prefix('transports')->group(function () {
            Route::get('/', [TransportController::class, 'index'])->name('transports.index');
            Route::get('/create', [TransportController::class, 'form'])->name('transports.create');
            Route::get('/{id}/edit', [TransportController::class, 'form'])->name('transports.edit');
            Route::get('/{id}', [TransportController::class, 'show'])->name('transports.show');
            Route::post('/save', [TransportController::class, 'save'])->name('transports.save');
            Route::delete('/{id}', [TransportController::class, 'delete'])->name('transports.delete');
        });
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::prefix('packages')->name('packages.')->group(function () {

            Route::get('/fix-all-slugs', [AdminPackageController::class, 'fixAllSlugs'])
                ->name('fix-all-slugs');


            Route::get('/', [AdminPackageController::class, 'index'])
                ->name('index');

            Route::get('/create', [AdminPackageController::class, 'create'])
                ->name('create');

            Route::post('/', [AdminPackageController::class, 'store'])
                ->name('store');

            Route::get('/{package}/edit', [AdminPackageController::class, 'edit'])
                ->name('edit');


            Route::get('/{package}/show', [AdminPackageController::class, 'show'])
                ->name('show');


            Route::put('/{package}', [AdminPackageController::class, 'update'])
                ->name('update');

            Route::post(
                '/package-day-item-options',
                [AdminPackageController::class, 'packageDayOptionsStore']
            )->name('package-day-options');

            Route::delete(
                '/package-day-options/{option}',
                [AdminPackageController::class, 'packageDayOptionsDestroy']
            )->name('packages.package-day-options.delete');


            // show price edit form
            Route::get(
                '/packages/{package}/pricing',
                [PackagePricingController::class, 'edit']
            )->name('pricing.edit');

            // save / update pricing
            Route::post(
                '/packages/{package}/pricing',
                [PackagePricingController::class, 'update']
            )->name('pricing.update');

            Route::delete(
                '/pricing/extra-person/{id}',
                [PackagePricingController::class, 'deleteExtraPerson']
            )->name('pricing.extra-person.delete');

            Route::delete(
                '/pricing/child-price/{id}',
                [PackagePricingController::class, 'deleteChildPrice']
            )->name('pricing.child-price.delete');


            Route::post(
                '/{package}/additional-info',
                [AdminPackageController::class, 'saveAdditionalInfo']
            )->name('additional-info.save');

            Route::post(
                'admin/packages/{package}/policies',
                [AdminPackageController::class, 'savePolicies']
            )->name('policies.save');

            Route::get(
                '/search',
                [AdminPackageController::class, 'search']
            )->name('search');

            Route::get(
                '/seachIds',
                [AdminPackageController::class, 'seachIds']
            )->name('seachIds');
        });
    });

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::prefix('bookings')->name('bookings.')->group(function () {

            // 📋 Booking Listing
            Route::get('/', [AdminBookingController::class, 'index'])
                ->name('index');

            // 👁 View Booking Details
            Route::get('/{booking}/show', [AdminBookingController::class, 'show'])
                ->name('show');

            // 🔄 Update Booking Status
            Route::post('/{booking}/status', [AdminBookingController::class, 'updateStatus'])
                ->name('status.update');

            // 💳 Update Payment Status
            Route::post('/{booking}/payment-status', [AdminBookingController::class, 'updatePaymentStatus'])
                ->name('payment-status.update');

            // 📧 Resend Booking Confirmation Mail
            Route::post('/{booking}/resend-mail', [AdminBookingController::class, 'resendConfirmationMail'])
                ->name('resend-mail');

            // 🧾 Download Invoice (PDF)
            Route::get('/{booking}/invoice', [AdminBookingController::class, 'downloadInvoice'])
                ->name('invoice.download');

            // ➕ Add Manual Payment
            Route::post(
                '/{booking}/payment',
                [AdminBookingController::class, 'storeManualPayment']
            )->name('payment.store');
        });
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('package-policies', [PackagePolicyController::class, 'index'])
            ->name('package-policies.index');

        Route::get('package-policies/form/{id?}', [PackagePolicyController::class, 'form'])
            ->name('package-policies.form');

        Route::post('package-policies/save', [PackagePolicyController::class, 'save'])
            ->name('package-policies.save');

        Route::delete('package-policies/{id}', [PackagePolicyController::class, 'destroy'])
            ->name('package-policies.destroy');
    });

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/tags', [TagController::class, 'index'])
            ->name('tags.index');

        Route::get('/form/{id?}', [TagController::class, 'form'])
            ->name('tags.form');

        Route::post('/tags/save', [TagController::class, 'save'])
            ->name('tags.save');

        Route::delete('/tags/{tag}', [TagController::class, 'destroy'])
            ->name('tags.delete');
    });

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('company-details', [CompanyDetailController::class, 'index'])
            ->name('company-details.index');

        // Company Details (single record)
        Route::get('company-details/form', [CompanyDetailController::class, 'form'])
            ->name('company-details.form');

        Route::post('company-details/save', [CompanyDetailController::class, 'save'])
            ->name('company-details.save');
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('blogs', [AdminBlogController::class, 'index'])->name('blogs.index');
        Route::get('blogs/create', [AdminBlogController::class, 'create'])->name('blogs.create');
        Route::get('blogs/edit/{id}', [AdminBlogController::class, 'edit'])->name('blogs.edit');
        Route::post('blogs/save', [AdminBlogController::class, 'save'])->name('blogs.save');
        Route::delete('blogs/delete/{id}', [AdminBlogController::class, 'delete'])->name('blogs.delete');
    });
});


Route::middleware(['auth', 'user'])->prefix('user')->group(function () {

    Route::post('/profile', [FrontendProfileController::class, 'update'])
        ->name('user.profile.update');

    Route::post('/profile/update', [FrontendProfileController::class, 'update'])
        ->name('user.profile.update');

    Route::post('/profile/image/upload', [FrontendProfileController::class, 'uploadProfileImage'])
        ->name('profile.image.upload');

    Route::post('/profile/image/delete', [FrontendProfileController::class, 'deleteProfileImage'])
        ->name('profile.image.delete');
});

Route::post('/apply-coupon', [CouponApplyController::class, 'apply'])
    ->name('coupon.apply');


Route::get('/basic_form', function () {
    return view('backend.pages.basicform');
})->name('form.view');

Route::get('/basic_table', function () {
    return view('backend.pages.basic_table');
})->name('table.view');


// Frontend Routes
Route::get('/destination', function () {
    return view('frontend.destination');
})->name('destination');


Route::get('/destination-details/{slug?}', [HomeController::class, 'destination_details'])->name('destination.details');

// event routes


//package routes

Route::get('/package-listing', [FrontendPackageController::class, 'list'])->name('package.listing');

Route::get('/package-details', [FrontendPackageController::class, 'details'])->name('package.details');
Route::get('/package-day-option/{id}/{type}', [FrontendPackageController::class, 'packageDayOption'])->name('package.details.options');

Route::post('/store-traveller-session', [FrontendPackageController::class, 'storeSession'])
    ->name('store.traveller.session');

Route::get('/package/{slug}/gallery', [FrontendPackageController::class, 'gallery'])
    ->name('package.gallery');

Route::get('/package-day-option/{id}/{type}', [FrontendPackageController::class, 'packageDayOption'])->name('package.details.option');

Route::post('/save-package-day-item-session', [FrontendPackageController::class, 'savePackageDayItemSession'])->name('package.day.item.option.session');


Route::post(
    '/package/day-items/session',
    [FrontendPackageController::class, 'saveToSession']
)->name('package.day.items.session');

// Route::get('/things-to-do-nature', function () {
//     return view('frontend.things-to-do-nature');
// })->name('things-to-do-nature');
// routes for to do things
Route::get('/things-to-do', [ToDoThingsController::class, 'index'])
    ->name('things.to.do');

Route::get('/things-to-do/category', [ToDoThingsController::class, 'category'])
    ->name('things-to-do.category');

Route::get('/things-to-do/{slug}', [ToDoThingsController::class, 'show'])
    ->name('things-to-do.show');

Route::get('/to-do-things-filter', [ToDoThingsController::class, 'filter'])
    ->name('to.do.things.filter');




Route::get('/to-do-things-search', [ToDoThingsController::class, 'search'])->name('to.do.things.search');

// blog routes
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.view');
Route::get('/blogs/{slug}', [BlogController::class, 'detail'])
    ->name('blogs.detail');
// Route::get('/blog-details', [BlogController::class, 'detail'])->name('blog.details');


// checkout route
// Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.view');

//pages routes
Route::get('/about-us', [PageController::class, 'about_us'])->name('about.us');
Route::get('/contact-us', [PageController::class, 'contact_us'])->name('contact.us.view');

//Route::post('/contact-submit', [AuthController::class, 'send'])->name('contact.send');
Route::match(['get', 'post'], '/contact-submit', [AuthController::class, 'send'])->name('contact.send');



Route::get('/packages', [FrontendPackageController::class, 'index'])
    ->name('packages.index');

Route::get('/packages/ajax', [FrontendPackageController::class, 'ajax'])
    ->name('packages.ajax');

Route::get('packages/{slug}', [FrontendPackageController::class, 'show'])
    ->name('packages.show');
//json file route
Route::get('/saudi-packages', [DemoJsonController::class, 'index']);
Route::get('/packege-details-json', [DemoJsonController::class, 'packege_details_page']);
Route::get('/things-to-do-nature-json', [DemoJsonController::class, 'things_to_do_nature_page']);
Route::get('/event-details-json', [DemoJsonController::class, 'event_details_page']);
Route::get('/destination-details-json', [DemoJsonController::class, 'destination_detail_page']);



Route::post('/checkout/init', [CheckoutController::class, 'init'])
    ->name('checkout.init');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

Route::get('/golf', function () {
    return view('frontend.golf.index');
})->name('golf.view');

Route::get('/products', function () {
    return view('frontend.products.index');
})->name('products.view');


Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
    ->name('newsletter.subscribe');

Route::post('/newsletter/unsubscribe', [NewsletterController::class, 'unsubscribe'])
    ->name('newsletter.unsubscribe');


Route::get('/cookie-policy', [PageController::class, 'cookiePolicy'])
    ->name('cookie-policy');

Route::get('/faqs', [PageController::class, 'faqs'])
    ->name('faqs');

Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])
    ->name('privacy-policy');

Route::get('/terms-conditions', [PageController::class, 'termsConditions'])
    ->name('terms-conditions');



Route::prefix('info')->name('info.')->group(function () {

    Route::get('/about-saudi', [InfoPageController::class, 'aboutSaudi'])
        ->name('about-saudi');

    Route::get('/visa-regulations', [InfoPageController::class, 'visaRegulations'])
        ->name('visa-regulations');

    Route::get('/travel-guide', [InfoPageController::class, 'travelGuide'])
        ->name('travel-guide');

    Route::get('/getting-around', [InfoPageController::class, 'gettingAround'])
        ->name('getting-around');
});
