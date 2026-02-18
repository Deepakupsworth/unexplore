<?php

use App\Enums\CategoryType;
use App\Models\Category;
use App\Models\CompanyDetail;
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

        $baseQuery = \App\Models\City::with([
            'translationData' => function ($q) use ($language) {
                $q->select('id', 'name', 'city_id', 'language_code')
                  ->where('language_code', $language);
            }
        ]);

        /* ================= FAVOURITES ================= */
        $favourites = (clone $baseQuery)
            ->whereHas('tags', function ($q) {
                $q->where('slug', 'favourite');
            })
            ->latest()
            ->take(10)
            ->get();

        if ($favourites->isNotEmpty()) {
            return $favourites;
        }

        /* ================= FALLBACK ================= */
        return $baseQuery
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


if (!function_exists('company')) {

    /**
     * Get company detail or specific field
     *
     * Usage:
     * company('company_name')
     * company('email')
     * company() // full model
     */
    function company($key = null, $default = null)
    {
        static $company = null;
        // cache()->forget('company_details_single');

        // 🔥 request-level cache
        if ($company === null) {
            $company = cache()->remember(
                'company_details_single',
                60 * 60, // 1 hour
                fn() => CompanyDetail::first()
            );
        }

        if (!$company) {
            return $default;
        }

        // return full model
        if ($key === null) {
            return $company;
        }

        return data_get($company, $key, $default);
    }
}
