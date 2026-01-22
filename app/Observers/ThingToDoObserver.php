<?php

namespace App\Observers;

use App\Models\ThingToDo;
use App\Models\Language;
use Illuminate\Support\Facades\Cache;

class ThingToDoObserver
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
     * Handle the ThingToDo "created" event.
     */
    public function created(ThingToDo $thingToDo): void
    {
        //
        $this->clearHomePageCache();

    }

    /**
     * Handle the ThingToDo "updated" event.
     */
    public function updated(ThingToDo $thingToDo): void
    {
        //
        $this->clearHomePageCache();

    }

    /**
     * Handle the ThingToDo "deleted" event.
     */
    public function deleted(ThingToDo $thingToDo): void
    {
        //
    }

    /**
     * Handle the ThingToDo "restored" event.
     */
    public function restored(ThingToDo $thingToDo): void
    {
        //
    }

    /**
     * Handle the ThingToDo "force deleted" event.
     */
    public function forceDeleted(ThingToDo $thingToDo): void
    {
        //
    }
}
