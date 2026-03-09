<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Event;
use App\Models\ThingToDo;
use App\Models\Package;
use Illuminate\Support\Facades\Cache;
use App\Models\Tag;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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

        //Cache::forget("home_page_data_{$language}");

        $homeData = Cache::remember(
            "home_page_data_{$language}",
            now()->addMinutes(30),
            function () use ($language) {

                /* ================= CITIES ================= */
                $citiesQuery = fn() => City::with([
                    'translation' => fn($q) =>
                    $q->where('language_code', $language),
                    'thumb'
                ]);

                $cities = $citiesQuery()
                    ->whereHas('tags', fn($q) => $q->where('slug', 'favourite'))
                    ->take(6)
                    ->get();

                if ($cities->isEmpty()) {
                    $cities = $citiesQuery()
                        ->latest()
                        ->take(6)
                        ->get();
                }

                /* ================= THINGS TO DO ================= */
                $thingsQuery = fn() => ThingToDo::with([
                    'translation' => fn($q) =>
                    $q->where('language_code', $language),
                    'thumb',
                    'city.translationData',
                ])
                    ->withCount([
                        'packageDayItems as package_count' => function ($q) {
                            $q->whereHas(
                                'packageDay.package',
                                fn($q2) => $q2->where('status', 'active')
                            )
                                ->join('package_days', 'package_day_items.package_day_id', '=', 'package_days.id')
                                ->select(DB::raw('COUNT(DISTINCT package_days.package_id)'));
                        }
                    ])
                    ->having('package_count', '>', 0);

                $things = $thingsQuery()
                    ->whereHas('tags', fn($q) => $q->where('slug', 'favourite'))
                    ->take(12)
                    ->get();

                if ($things->isEmpty()) {
                    $things = $thingsQuery()
                        ->orderByDesc('package_count')
                        ->take(12)
                        ->get();
                }

                /* ================= EVENTS ================= */
                $activeEventCondition = function ($q) {
                    $q->where(function ($q2) {
                        $q2->whereNull('start_date')
                            ->orWhereDate('start_date', '>=', now());
                    });
                };

                $eventsQuery = fn() => Event::with([
                    'translation',
                    'thumb',
                    'city.translation',
                    'category.translation',
                    'eventCategories.category.translationData'
                ])
                    ->where('status', 1)
                    ->where($activeEventCondition);

                $events = $eventsQuery()
                    ->whereHas('tags', fn($q) => $q->where('slug', 'favourite'))
                    ->take(6)
                    ->get();

                if ($events->isEmpty()) {
                    $events = $eventsQuery()
                        ->latest()
                        ->take(6)
                        ->get();
                }

                /* ================= PACKAGES ================= */
                $packagesQuery = fn() => Package::with([
                    'translation' => fn($q) =>
                    $q->where('language_code', $language),
                    'cities.city',
                    'price',
                    'thumb',
                ])
                    ->where('status', 'active');

                $packages = $packagesQuery()
                    ->whereHas('tags', fn($q) => $q->where('slug', 'favourite'))
                    ->take(6)
                    ->get();

                if ($packages->isEmpty()) {
                    $packages = $packagesQuery()
                        ->latest()
                        ->take(6)
                        ->get();
                }

                /* ================= BLOGS ================= */
                $blogs = Blog::with([
                    'translation' => fn($q) =>
                    $q->where('language_code', $language),
                    'thumb',
                    'user'
                ])
                    ->where('is_published', true)
                    // ->whereNotNull('published_at')
                    ->latest('published_at')
                    ->take(5)
                    ->get();

                return compact('things', 'events', 'packages', 'cities', 'blogs');
            }
        );

        //print_r($homeData);die;

        return view('frontend.pages.home', $homeData);
    }

    public function about_us()
    {

        $language = app()->getLocale();

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

        $packages = Package::query()
            ->with([
                'translation' => fn($q) =>
                $q->where('language_code', $language),
                'cities.city',
                'price'
            ])
            ->where('status', 'active')
            ->whereHas('tags', function ($q) {
                $q->where('slug', 'favourite');
            })
            ->latest()
            ->take(12)
            ->get();
        return view('frontend.pages.about-us', compact('packages', 'favouriteCities'));
    }

    public function contact_us()
    {
        return view('frontend.pages.contact-us');
    }


    public function cookiePolicy()
    {
        return view('frontend.pages.cookie-policy');
    }

    public function faqs()
    {
        return view('frontend.pages.faqs');
    }

    public function privacyPolicy()
    {
        return view('frontend.pages.privacy-policy');
    }

    public function termsConditions()
    {
        return view('frontend.pages.terms-conditions');
    }

    public function search(Request $request)
    {
        $q = trim($request->query('q', ''));
        $language = $this->language;

        $cities = City::query()
            ->whereHas('packages')
            ->whereHas('translation', function ($query) use ($q, $language) {
                $query->where('language_code', $language);

                if ($q !== '') {
                    $query->where('name', 'LIKE', "%{$q}%");
                }
            })
            ->with([
                'translation' => fn($t) =>
                    $t->where('language_code', $language)
            ])
            ->limit(20)
            ->get()
            ->map(function ($city) {
                return [
                    'id'   => $city->id,
                    'name' => $city->translation->name ?? '',
                    'slug' => $city->slug,
                ];
            });

        return response()->json($cities);
    }
}
