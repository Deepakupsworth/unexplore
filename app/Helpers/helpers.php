<?php

use App\Models\Event;
use App\Models\ThingToDo;

if (!function_exists('header_events')) {
    function header_events()
    {
        $language = current_lang();

        return cache()->remember(
            "header_events_{$language}",
            now()->addMinutes(30),
            function () use ($language) {
                return Event::with([
                    'translation' => fn($q) =>
                    $q->where('language_code', $language),
                    'thumb'
                ])
                    ->where('status', 1)
                    ->latest()
                    ->take(5)
                    ->get();
            }
        );
    }
}

if (!function_exists('header_todos')) {
    function header_todos()
    {
        $language = current_lang();

        return cache()->remember(
            "header_todos_{$language}",
            now()->addMinutes(30),
            function () use ($language) {
                return ThingToDo::with([
                    'translation' => fn($q) =>
                    $q->where('language_code', $language),
                    'thumb'
                ])
                    ->latest()
                    ->take(5)
                    ->get();
            }
        );
    }
}
