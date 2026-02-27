<?php

namespace App\Observers;

use App\Models\Event;
use App\Models\Language;
use Illuminate\Support\Facades\Cache;
use App\Support\ClearsHomeCache;

class EventObserver
{
    use ClearsHomeCache;
    /**
     * Handle the Event "created" event.
     */
    public function created(Event $event): void
    {
        //
        $this->clearEventPageCache();

    }

    /**
     * Handle the Event "updated" event.
     */
    public function updated(Event $event): void
    {
        //
        $this->clearEventPageCache();

    }

    /**
     * Handle the Event "deleted" event.
     */
    public function deleted(Event $event): void
    {
        //
        $this->clearEventPageCache();
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
