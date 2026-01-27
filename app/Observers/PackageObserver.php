<?php

namespace App\Observers;

use App\Models\Package;
use App\Models\Language;
use Illuminate\Support\Facades\Cache;

class PackageObserver
{
    protected function clearHomePageCache(): void
    {
        Language::where('status', 'active')
            ->pluck('code')
            ->each(function ($lang) {
                Cache::forget("home_page_data_{$lang}");
            });
    }
    /**
     * Handle the Package "created" event.
     */
    public function created(Package $package): void
    {
        //
        $this->clearHomePageCache();

    }

    /**
     * Handle the Package "updated" event.
     */
    public function updated(Package $package): void
    {
        //
        $this->clearHomePageCache();

    }

    /**
     * Handle the Package "deleted" event.
     */
    public function deleted(Package $package): void
    {
        //
    }

    /**
     * Handle the Package "restored" event.
     */
    public function restored(Package $package): void
    {
        //
    }

    /**
     * Handle the Package "force deleted" event.
     */
    public function forceDeleted(Package $package): void
    {
        //
    }
}
