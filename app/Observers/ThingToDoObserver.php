<?php

namespace App\Observers;

use App\Models\ThingToDo;
use App\Models\Language;
use Illuminate\Support\Facades\Cache;
use App\Support\ClearsHomeCache;

class ThingToDoObserver
{
    use ClearsHomeCache;
    /**
     * Handle the ThingToDo "created" event.
     */
    public function created(ThingToDo $thingToDo): void
    {
        //
        $this->clearTodoPageCache();

    }

    /**
     * Handle the ThingToDo "updated" event.
     */
    public function updated(ThingToDo $thingToDo): void
    {
        //
        $this->clearTodoPageCache();

    }

    /**
     * Handle the ThingToDo "deleted" event.
     */
    public function deleted(ThingToDo $thingToDo): void
    {
        //
        $this->clearTodoPageCache();
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
