<?php

namespace App\Http\Controllers\Frontend\Destination;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Event;
use App\Models\Package;
use App\Models\ThingToDo;
use Illuminate\Support\Facades\Cache;

class DestinationController extends Controller
{
    /**
     * Destination listing page
     * URL: /destinations
     */
    // public function index()
    // {
    //     $language = app()->getLocale();
    //     Cache::forget("frontend_destinations_{$language}");

    //     $cities = Cache::remember(
    //         "frontend_destinations_{$language}",
    //         now()->addMinutes(30),
    //         function () use ($language) {

    //             /* ================= FAVOURITE TAG ================= */
    //             $favouriteTagId = \App\Models\Tag::where('slug', 'favourite')->value('id');

    //             $citiesBaseQuery = City::with([
    //                 'translation' => fn($q) =>
    //                 $q->where('language_code', $language),
    //                 'thumb',
    //                 'categories.translationData',
    //             ])
    //                 ->withCount([
    //                     'packageCities as package_count' => function ($q) {
    //                         $q->whereHas(
    //                             'package',
    //                             fn($p) =>
    //                             $p->where('status', 'active')
    //                         );
    //                     }
    //                 ]);

    //             /* ===== Favourite Cities (max 4) ===== */
    //             $cities = $favouriteTagId
    //                 ? (clone $citiesBaseQuery)
    //                 ->whereHas(
    //                     'tags',
    //                     fn($q) =>
    //                     $q->where('tags.id', $favouriteTagId)
    //                 )
    //                 ->take(4)
    //                 ->get()
    //                 : collect();

    //             /* ===== Fallback Cities (max 4) ===== */
    //             if ($cities->isEmpty()) {
    //                 $cities = $citiesBaseQuery
    //                     ->latest()
    //                     ->take(4)
    //                     ->get();
    //             }

    //             return $cities;
    //         }
    //     );

    //     return view('frontend.destinations.index', compact('cities'));
    // }

    public function index()
    {
        $language = app()->getLocale();
        Cache::forget("frontend_destinations_{$language}");

        [$favouriteCities, $otherCities] = Cache::remember(
            "frontend_destinations_{$language}",
            now()->addMinutes(30),
            function () use ($language) {

                /* ================= FAVOURITE TAG ================= */
                $favouriteTagId = \App\Models\Tag::where('slug', 'favourite')->value('id');

                /* ================= BASE QUERY ================= */
                $citiesBaseQuery = City::with([
                    'translation' => fn($q) =>
                    $q->where('language_code', $language),
                    'thumb',
                    'categories.translationData',
                ])
                    ->withCount([
                        'packageCities as package_count' => function ($q) {
                            $q->whereHas(
                                'package',
                                fn($p) =>
                                $p->where('status', 'active')
                            );
                        }
                    ]);

                /* ================= FAVOURITE CITIES ================= */
                $favouriteCities = collect();

                if ($favouriteTagId) {
                    $favouriteCities = (clone $citiesBaseQuery)
                        ->whereHas('tags', function ($q) use ($favouriteTagId) {
                            $q->where('tags.id', $favouriteTagId);
                        })
                        ->latest()
                        ->take(4)
                        ->get();
                }

                /* ================= OTHER CITIES ================= */
                $remaining = 4 - $favouriteCities->count();

                $otherCities = $remaining > 0
                    ? (clone $citiesBaseQuery)
                    ->latest()
                    ->take($remaining)
                    ->get()
                    : collect();

                return [$favouriteCities, $otherCities];
            }
        );

        return view('frontend.destinations.index', compact(
            'favouriteCities',
            'otherCities'
        ));
    }



    /**
     * Destination detail page
     * URL: /destinations/{slug}
     */
    public function show(string $slug)
    {
        $language = app()->getLocale();

        // ✅ City
        $city = City::with([
            'translation' => fn($q) =>
            $q->where('language_code', $language),
            'thumb',
            'gallery'
        ])
            ->withCount([
                'packageCities as package_count' => function ($q) {
                    $q->whereHas('package', function ($p) {
                        $p->where('status', 'active');
                    });
                }
            ])
            ->where('slug', $slug)
            ->firstOrFail();


        // ✅ Events
        $events = Event::with([
            'translation',
            'thumb',
            'city.translation',
            'category.translation',
        ])
        ->where('status', 1)
        ->where(function ($q) {
            $q->whereNull('start_date')
              ->orWhereDate('start_date', '>=', now());
        })
        ->orderBy('start_date') // upcoming first (better UX)
        ->take(12)
        ->get();

        // ✅ Things To Do with related ACTIVE package count (city specific)
        $things = ThingToDo::with([
            'translation' => fn($q) =>
            $q->where('language_code', $language),
            'thumb'
        ])
            ->withCount([
                'packageDayItems as package_count' => function ($q) use ($city) {
                    $q->whereHas('packageDay.package', function ($p) use ($city) {
                        $p->where('status', 'active')
                            ->whereHas('cities', function ($pc) use ($city) {
                                $pc->where('city_id', $city->id);
                            });
                    });
                }
            ])
            ->having('package_count', '>', 0)
            ->orderByDesc('package_count')
            ->take(12)
            ->get();


        $packages = Package::query()
            ->with([
                'translation' => fn($q) =>
                $q->where('language_code', $language),
                'cities.city',
                'price',
                'days.items.transport',
                'days.items.hotel'
            ])
            ->where('status', 'active')
            ->latest()
            ->take(12)
            ->get();

        return view(
            'frontend.destinations.show',
            compact('city', 'events', 'things', 'packages')
        );
    }
}
