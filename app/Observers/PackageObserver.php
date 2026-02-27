<?php

namespace App\Observers;

use App\Models\Package;
use App\Models\Language;
use Illuminate\Support\Facades\Cache;
use App\Support\ClearsHomeCache;


class PackageObserver
{
    use ClearsHomeCache;

    
    /**
     * Handle the Package "created" event.
     */
    public function created(Package $package): void
    {
        $this->clearPackagePageCache();


    }

    /**
     * Handle the Package "updated" event.
     */
    public function updated(Package $package): void
    {
        $this->clearPackagePageCache();
    }

    /**
     * Handle the Package "deleted" event.
     */
    public function deleted(Package $package): void
    {
        $this->clearPackagePageCache();
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
