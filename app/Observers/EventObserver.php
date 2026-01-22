<?php

namespace App\Observers;

use App\Models\Event;
use App\Models\Language;
use Illuminate\Support\Facades\Cache;

class EventObserver
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
     * Handle the Event "created" event.
     */
    public function created(Event $event): void
    {
        //
        $this->clearHomePageCache();

    }

    /**
     * Handle the Event "updated" event.
     */
    public function updated(Event $event): void
    {
        //
        $this->clearHomePageCache();

    }

    /**
     * Handle the Event "deleted" event.
     */
    public function deleted(Event $event): void
    {
        //
    }

    /**
     * Handle the Event "restored" event.
     */
    public function restored(Event $event): void
    {
        //
    }

    /**
     * Handle the Event "force deleted" event.
     */
    public function forceDeleted(Event $event): void
    {
        //
    }
}
