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
use App\Http\Controllers\Admin\ThingtodoController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\DemoJsonController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DestinationController;



// routes/web.php
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'de', 'ar'])) {
        Session::put('locale', $locale); 
        App::setLocale($locale);
    }
    return redirect()->back();
})->name('lang.switch');

// Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return view('frontend.home');
}); 


Route::get('/admin/dashboard', function () {
    return view('backend.admin.dashboard');
});

Route::get('/signup', function () {
    return view('backend.pages.signup');
})->name('sign_up') ;

Route::middleware([RedirectIfAuthenticated::class])->group(function () {
// Auth Routes
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);


    // Password Reset
    Route::get('/forgot-password', function() {
        return view('auth.forgot-password');
    })->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Dashboard

Route::middleware(['auth', RoleMiddleware::class.':user'])->group(function () {
    Route::get('/user/dashboard', fn() => view('user.dashboard'));
});

Route::middleware(['auth', RoleMiddleware::class.':admin'])->group(function () {
    Route::get('/admin/dashboard', fn() => view('backend.admin.dashboard'));
});

// Route::get('/profile', function () {
//     return view('backend.pages.profile');
// });

Route::middleware(['auth', RoleMiddleware::class.':admin'])->group(function () {
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
            Route::post('/save', [CityController::class, 'save'])->name('cities.save');
            Route::delete('/delete/{id}', [CityController::class, 'destroy'])->name('cities.delete');
            Route::delete('/gallery/delete/{id}', [CityController::class, 'deleteGalleryImage'])->name('cities.gallery.delete');
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
            Route::post('/save', [ThingtodoController::class, 'save'])->name('thingtodos.save');
            Route::delete('/delete/{id}', [ThingtodoController::class, 'destroy'])->name('thingtodos.delete');
            Route::delete('/gallery/delete/{id}', [ThingtodoController::class, 'deleteGalleryImage'])->name('thingtodos.gallery.delete');
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

// Route::get('/destination-details', function () {
//     return view('frontend.destination-details');
// })->name('destination.details');


Route::get('/destination-details/{slug?}', [HomeController::class, 'destination_details'])->name('destination.details');

// Route::get('/event-details', function () {
//     return view('frontend.event-details');
// })->name('event.details');
Route::get('/event-details/{slug?}', [HomeController::class, 'event_details'])->name('event.details');

Route::get('/event-listing', function () {
    return view('frontend.event-listing');
})->name('event.listing');

Route::get('/package-details', function () {
    return view('frontend.package-details');
})->name('package.details');

Route::get('/package-listing', function () {
    return view('frontend.package-listing');
})->name('package.listing'); 

Route::get('/profile', function () {
    return view('frontend.profile');
})->name('profile.view'); 
 
// Route::get('/things-to-do-nature', function () { 
//     return view('frontend.things-to-do-nature');
// })->name('things-to-do-nature'); 

Route::get('/things-to-do-nature/{slug?}', [HomeController::class, 'things_to_do_nature'])->name('things-to-do.nature');


Route::get('/things-to-do', function () {
    return view('frontend.things-to-do');
})->name('things.to.do');  


Route::get('/to-do-things-search', function () {
    return view('frontend.to-do-things-search');
})->name('to.do.things.search');

Route::get('/about-us', function () {
    return view('frontend.about-us');
})->name('about.us');

Route::get('/blog-details', function () {
    return view('frontend.blog-details');
})->name('blog.details');

Route::get('/blogs', function () {
    return view('frontend.blogs');
})->name('blogs.view');

Route::get('/checkout', function () {
    return view('frontend.checkout');
})->name('checkout.view');

Route::get('/contact-us', function () {
    return view('frontend.contact-us');
})->name('contact.us.view');

//Route::post('/contact-submit', [AuthController::class, 'send'])->name('contact.send'); 
Route::match(['get', 'post'], '/contact-submit', [AuthController::class, 'send'])->name('contact.send');

//json file route 
Route::get('/saudi-packages', [DemoJsonController::class, 'index']); 
Route::get('/packege-details-json', [DemoJsonController::class, 'packege_details_page']); 
Route::get('/things-to-do-nature-json', [DemoJsonController::class, 'things_to_do_nature_page']); 
Route::get('/event-details-json', [DemoJsonController::class, 'event_details_page']);
Route::get('/destination-details-json', [DemoJsonController::class, 'destination_detail_page']);


