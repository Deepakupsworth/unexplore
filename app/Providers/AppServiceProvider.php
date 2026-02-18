<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

use App\Repositories\ThingToDo\ThingToDoRepository;
use App\Repositories\ThingToDo\ThingToDoRepositoryInterface;

use App\Models\Event;
use App\Observers\EventObserver;

use App\Models\ThingToDo;
use App\Observers\ThingToDoObserver;

use App\Models\Package;
use App\Observers\PackageObserver;

use App\Models\Booking;
use App\Observers\BookingObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ThingToDoRepositoryInterface::class,
            ThingToDoRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // $locale = Session::get('locale', config('app.locale'));
        // App::setLocale($locale);
        // Event::observe(EventObserver::class);
        // ThingToDo::observe(ThingToDoObserver::class);
        Package::observe(PackageObserver::class);

        Booking::observe(BookingObserver::class);
    }
}
