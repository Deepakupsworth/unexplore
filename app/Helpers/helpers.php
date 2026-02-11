<?php

use App\Enums\CategoryType;
use App\Models\Category;
use App\Models\Event;
use App\Models\ThingToDo;
use App\Models\City;;
use Illuminate\Support\Facades\Cache;

if (!function_exists('header_event_categories')) {
    function header_event_categories()
    {
        $language = current_lang();
        Cache::forget("header_event_categories_{$language}");
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
        Cache::forget("header_todos_{$language}");

        return Category::withCount([
            'things as things_count' => function ($q) use ($language) {
                $q->whereHas('translation', function ($t) use ($language) {
                    $t->where('language_code', $language);
                });
            }
        ])
        ->with('translationData')
        ->where('type', CategoryType::THING_TO_DO->value)
        ->latest()
        ->limit(5)
        ->get();

    }
}

if (!function_exists('header_destinations')) {
    function header_destinations()
    {
        $language = current_lang();
        $favouriteTagId = \App\Models\Tag::where('slug', 'favourite')->value('id');

        /* ================= FAVOURITES ================= */
        if ($favouriteTagId) {
            $favourites = \App\Models\City::with([
                    'translationData' => function ($q) use ($language) {
                        $q->select('id', 'name', 'city_id', 'language_code')
                          ->where('language_code', $language);
                    }
                ])
                ->whereHas('tags', function ($q) use ($favouriteTagId) {
                    $q->where('tags.id', $favouriteTagId);
                })
                ->latest()
                ->take(10)
                ->get();

            if ($favourites->isNotEmpty()) {
                return $favourites;
            }
        }

        /* ================= FALLBACK ================= */
        return \App\Models\City::with([
                'translationData' => function ($q) use ($language) {
                    $q->select('id', 'name', 'city_id', 'language_code')
                      ->where('language_code', $language);
                }
            ])
            ->latest()
            ->take(5)
            ->get();
    }
}



if (!function_exists('header_destination_categories')) {
    function header_destination_categories()
    {
        $language = current_lang();
        Cache::forget("header_destination_categories_{$language}");

        return Category::with('translationData')
        ->where('type', CategoryType::CITY->value)
        ->latest()
        ->limit(5)
        ->get();

    }
}

if (!function_exists('header_packages')) {
    function header_packages()
    {
        $language = current_lang();
        Cache::forget("header_packages_{$language}");

        return Category::withCount([
            'packages as packages_count' => function ($q) use ($language) {
                $q->whereHas('translation', function ($t) use ($language) {
                    $t->where('language_code', $language);
                });
            }
        ])
        ->having('packages_count', '>=', 1)
        ->with('translationData')
        ->where('type', CategoryType::PACKAGE->value)
        ->latest()
        ->limit(5)
        ->get();

    }
}
