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

    public function index()
    {
        $language = app()->getLocale();

        Cache::forget("frontend_destinations_{$language}");

        [$favouriteCities, $otherCities] = Cache::remember(
            "frontend_destinations_{$language}",
            now()->addMinutes(30),
            function () use ($language) {

                /*
                |--------------------------------------------------------------------------
                | Favourite Cities
                |--------------------------------------------------------------------------
                */
                $favouriteCities = City::with([
                    'translation' => fn($q) =>
                    $q->where('language_code', $language),
                    'thumb',
                    'categories.translationData',
                ])
                    ->withCount([
                        'packageCities as package_count' => function ($q) {
                            $q->whereHas(
                                'package',
                                fn($p) => $p->where('status', 'active')
                            );
                        }
                    ])
                    ->whereHas('tags', function ($q) {
                        $q->where('slug', 'favourite');
                    })
                    ->latest()
                    ->take(6)
                    ->get();


                    if ($favouriteCities->isEmpty()) {

                        $favouriteCities = City::with([
                                'translation' => fn($q) =>
                                    $q->where('language_code', $language),
                                'thumb',
                                'categories.translationData',
                            ])
                            ->withCount([
                                'packageCities as package_count' => function ($q) {
                                    $q->whereHas(
                                        'package',
                                        fn($p) => $p->where('status', 'active')
                                    );
                                }
                            ])
                            ->inRandomOrder()
                            ->take(6)
                            ->get();
                    }
                /*
                |--------------------------------------------------------------------------
                | Other Cities (All Cities - No Filter)
                |--------------------------------------------------------------------------
                */
                $otherCities = City::with([
                    'translation' => fn($q) =>
                    $q->where('language_code', $language),
                    'thumb',
                    'categories.translationData',
                ])
                    ->withCount([
                        'packageCities as package_count' => function ($q) {
                            $q->whereHas(
                                'package',
                                fn($p) => $p->where('status', 'active')
                            );
                        }
                    ])
                    ->latest()
                    ->get();


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


            $favouriteCities = City::with([
                'translation' => fn($q) =>
                $q->where('language_code', $language),
                'thumb',
                'categories.translationData',
            ])
                ->withCount([
                    'packageCities as package_count' => function ($q) {
                        $q->whereHas(
                            'package',
                            fn($p) => $p->where('status', 'active')
                        );
                    }
                ])
                ->whereHas('tags', function ($q) {
                    $q->where('slug', 'favourite');
                })
                ->latest()
                ->take(4)
                ->get();


                if ($favouriteCities->isEmpty()) {

                    $favouriteCities = City::with([
                            'translation' => fn($q) =>
                                $q->where('language_code', $language),
                            'thumb',
                            'categories.translationData',
                        ])
                        ->withCount([
                            'packageCities as package_count' => function ($q) {
                                $q->whereHas(
                                    'package',
                                    fn($p) => $p->where('status', 'active')
                                );
                            }
                        ])
                        ->inRandomOrder()
                        ->take(4)
                        ->get();
                }

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
            compact('city','favouriteCities', 'events', 'things', 'packages')
        );
    }
}
