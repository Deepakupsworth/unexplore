<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Event;
use App\Models\ThingToDo;
use App\Models\Package;
use Illuminate\Support\Facades\Cache;
use App\Models\Tag;

class PageController extends Controller
{
    private $language;

    public function __construct()
    {
        $this->language = current_lang();
    }



    public function index()
    {
        $language = $this->language; // en, de, ar

        Cache::forget("home_page_data_{$language}");

        $homeData = Cache::remember(
            "home_page_data_{$language}",
            now()->addMinutes(30),
            function () use ($language) {

                /* ================= FAVOURITE TAG ================= */
                $favouriteTagId = Tag::where('slug', 'favourite')->value('id');

                /* ================= CITIES ================= */
                $cities = City::with([
                    'translation' => fn($q) =>
                    $q->where('language_code', $language),
                    'thumb'
                ])
                    ->latest()
                    ->take(6)
                    ->get();

                /* ================= THINGS TO DO ================= */
                $thingsBaseQuery = ThingToDo::with([
                    'translation' => fn($q) =>
                    $q->where('language_code', $language),
                    'thumb',
                    'city.translationData',
                ])
                    ->withCount([
                        'packageDayItems as package_count' => function ($q) {
                            $q->whereHas(
                                'packageDay.package',
                                fn($q2) =>
                                $q2->where('status', 'active')
                            );
                        }
                    ])
                    ->having('package_count', '>', 0);

                $things = $favouriteTagId
                    ? (clone $thingsBaseQuery)
                    ->whereHas(
                        'tags',
                        fn($q) =>
                        $q->where('tags.id', $favouriteTagId)
                    )
                    ->take(12)
                    ->get()
                    : collect();

                if ($things->isEmpty()) {
                    $things = $thingsBaseQuery
                        ->orderByDesc('package_count')
                        ->take(12)
                        ->get();
                }

                /* ================= EVENTS ================= */
                $eventsBaseQuery = Event::with([
                    'translation',
                    'thumb',
                    'city.translation',
                    'category.translation',
                    'eventCategories.category.translationData'
                ])
                    ->where('status', 1);

                $events = $favouriteTagId
                    ? (clone $eventsBaseQuery)
                    ->whereHas(
                        'tags',
                        fn($q) =>
                        $q->where('tags.id', $favouriteTagId)
                    )
                    ->take(6)
                    ->get()
                    : collect();

                if ($events->isEmpty()) {
                    $events = $eventsBaseQuery
                        ->latest()
                        ->take(6)
                        ->get();
                }

                /* ================= PACKAGES ================= */
                $packagesBaseQuery = Package::with([
                    'translation' => fn($q) =>
                    $q->where('language_code', $language),
                    'cities.city',
                    'price',
                    'thumb',
                ])
                    ->where('status', 'active');

                $packages = $favouriteTagId
                    ? (clone $packagesBaseQuery)
                    ->whereHas(
                        'tags',
                        fn($q) =>
                        $q->where('tags.id', $favouriteTagId)
                    )
                    ->take(6)
                    ->get()
                    : collect();

                if ($packages->isEmpty()) {
                    $packages = $packagesBaseQuery
                        ->latest()
                        ->take(6)
                        ->get();
                }

                return compact('things', 'events', 'packages', 'cities');
            }
        );

        return view('frontend.home', $homeData);
    }


    public function about_us()
    {
        return view('frontend.about-us');
    }

    public function contact_us()
    {
        return view('frontend.contact-us');
    }
}
