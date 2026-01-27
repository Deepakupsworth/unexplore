<?php

use App\Enums\CategoryType;
use App\Models\Category;
use App\Models\Event;
use App\Models\ThingToDo;
use Illuminate\Support\Facades\Cache;

if (!function_exists('header_event_categories')) {
    function header_event_categories()
    {
        $language = current_lang();
        // Cache::forget("header_event_categories_{$language}");
        return cache()->remember(
            "header_event_categories_{$language}",
            now()->addMinutes(30),
            function () {
                return Category::withCount([
                        'events' => fn ($q) =>
                            $q->where('status', 1)
                    ])
                    ->with('translationData')
                    ->ofType(CategoryType::EVENT->value)   // 👈 event category
                    ->has('events')                 // 👈 empty avoid
                    ->latest()
                    ->limit(5)
                    ->get();
            }
        );
    }
}


if (!function_exists('header_todos')) {
    function header_todos()
    {
        $language = current_lang();
        // Cache::forget("header_todos_{$language}");

        return cache()->remember(
            "header_todos_{$language}",
            now()->addMinutes(30),
            function () {
                return Category::withCount('things')
                    ->with('translationData')
                    ->where('type', CategoryType::THING_TO_DO)
                    ->latest()
                    ->limit(5)
                    ->get();
            }
        );
    }
}
