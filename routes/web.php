<?php

use App\Http\Controllers\Controller;
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
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TransportController;
use App\Http\Controllers\Frontend\Event\EventController as FrontendEventController;

use App\Http\Controllers\DemoJsonController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\Frontend\Blog\BlogController;
use App\Http\Controllers\Frontend\Checkout\CheckoutController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\PackagePricingController;
use App\Http\Controllers\Frontend\Package\PackageController as FrontendPackageController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ToDoThings\ToDoThingsController;
use App\Models\Event;
use App\Http\Controllers\Frontend\Profile\ProfileController as FrontendProfileController;


// routes/web.php
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'de', 'ar'])) {
        Session::put('locale', $locale);
        App::setLocale($locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/', [PageController::class, 'index'])->name('home');

Route::get('/admin/dashboard', function () {
    return view('backend.admin.dashboard');
});

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

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Dashboard

Route::middleware(['auth', RoleMiddleware::class . ':user'])->group(function () {
    Route::get('/user/dashboard', fn() => view('user.dashboard'))
        ->name('user.dashboard');
});

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', fn() => view('backend.admin.dashboard'))
        ->name('admin.dashboard');
});

Route::get('/event-details/{slug?}', [FrontendEventController::class, 'event_details'])->name('event.details');

Route::get('/events', [FrontendEventController::class, 'index'])->name('event.listing');




Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    // Profile Routes
    // Route::get('/admin/profile', fn() => view('backend.pages.profile'));
    // Route::get('/admin/profile/edit', fn() => view('backend.pages.Profile_edit'));
    // Route::get('/admin/profile', [AuthController::class, 'profile'])->name('admin.profile');
    // Route::get('/admin/profile/edit', [AuthController::class, 'editProfile'])->name('admin.profile.edit');
    // Route::post('/admin/profile/update', [AuthController::class, 'updateProfile'])->name('admin.profile.update');
    // Route::get('/admin/category/view', [AuthController::class, 'updateProfile'])->name('admin.category.view');

    Route::prefix('admin')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Cities Routes
        |--------------------------------------------------------------------------
        */
        Route::prefix('cities')->group(function () {
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
        });
    });
});


Route::middleware('auth')->prefix('user')->group(function () {
    Route::get('/profile', [FrontendProfileController::class, 'index'])
        ->name('user.profile.index');

    Route::post('/profile', [FrontendProfileController::class, 'update'])
        ->name('user.profile.update');
});


Route::get('/basic_form', function () {
    return view('backend.pages.basicform');
})->name('form.view');

Route::get('/basic_table', function () {
    return view('backend.pages.basic_table');
})->name('table.view');

// Route::get('/categories', function () {
//     return view('backend.pages.categories');
// })->name('categories.view');

// Route::get('/admin/category', function () {
//     return view('backend.category.viewcategory');
// })->name('category.viewcategory');

// Route::get('/admin/addcategory', function () {
//     return view('backend.category.addcategory');
// })->name('category.addcategory');


// Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

// Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
// Route::post('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');



// Frontend Routes
Route::get('/destination', function () {
    return view('frontend.destination');
})->name('destination');


Route::get('/destination-details/{slug?}', [HomeController::class, 'destination_details'])->name('destination.details');

// event routes


//package routes

Route::get('/package-listing', [FrontendPackageController::class, 'list'])->name('package.listing');

Route::get('/package-details', [FrontendPackageController::class, 'details'])->name('package.details');

Route::get('/profile', [FrontendProfileController::class, 'index'])->name('profile.view');

// Route::get('/things-to-do-nature', function () {
//     return view('frontend.things-to-do-nature');
// })->name('things-to-do-nature');
// routes for to do things
Route::get('/things-to-do', [ToDoThingsController::class, 'index'])->name('things.to.do');
Route::get('/things-to-do/{slug?}', [ToDoThingsController::class, 'show'])->name('things-to-do.nature');
Route::get('/to-do-things-filter', [ToDoThingsController::class, 'filter'])->name('to.do.things.filter');



Route::get('/to-do-things-search', [ToDoThingsController::class, 'search'])->name('to.do.things.search');

// blog routes
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.view');
Route::get('/blog-details', [BlogController::class, 'detail'])->name('blog.details');


// checkout route
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.view');

//pages routes
Route::get('/about-us', [PageController::class, 'about_us'])->name('about.us');
Route::get('/contact-us', [PageController::class, 'contact_us'])->name('contact.us.view');

//Route::post('/contact-submit', [AuthController::class, 'send'])->name('contact.send');
Route::match(['get', 'post'], '/contact-submit', [AuthController::class, 'send'])->name('contact.send');



Route::get('/packages', [FrontendPackageController::class, 'index'])
    ->name('packages.index');

Route::get('/packages/ajax', [FrontendPackageController::class, 'ajax'])
    ->name('packages.ajax');

Route::get('/{slug}', [FrontendPackageController::class, 'show'])
    ->name('packages.show');
//json file route
Route::get('/saudi-packages', [DemoJsonController::class, 'index']);
Route::get('/packege-details-json', [DemoJsonController::class, 'packege_details_page']);
Route::get('/things-to-do-nature-json', [DemoJsonController::class, 'things_to_do_nature_page']);
Route::get('/event-details-json', [DemoJsonController::class, 'event_details_page']);
Route::get('/destination-details-json', [DemoJsonController::class, 'destination_detail_page']);
