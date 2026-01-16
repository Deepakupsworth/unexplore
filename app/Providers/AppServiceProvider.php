<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

use App\Repositories\ThingToDo\ThingToDoRepository;
use App\Repositories\ThingToDo\ThingToDoRepositoryInterface;

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
    }
}
