<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Event;
use App\Models\ThingToDo;
use App\Models\Package;
use Illuminate\Support\Facades\Cache;


class PageController extends Controller
{
    private $language;

    public function __construct()
    {
        $this->language = current_lang();
    }

    public function index()
    {
        $language = $this->language; // e.g. en, de, ar
        Cache::forget("home_page_data_{$language}");

        $homeData = Cache::remember(
            "home_page_data_{$language}",
            now()->addMinutes(30), // cache time (adjust if needed)
            function () use ($language) {

                $cities = City::query()->with([
                    'translation' => fn($q) =>
                    $q->where('language_code', $language),
                    'thumb'
                ])->get();

                $things = ThingToDo::query()
                    ->with([
                        'translation' => fn($q) =>
                        $q->where('language_code', $language),
                        'thumb'
                    ])
                    ->withCount([
                        'packageDayItems as package_count' => function ($q) {
                            $q->whereHas('packageDay.package', function ($q2) {
                                $q2->where('status', 'active');
                            });
                        }
                    ])
                    ->orderByDesc('package_count')
                    ->get();

                $events = Event::with([
                    'translation',
                    'thumb',
                    'city.translation',
                    'category.translation',
                ])
                    ->where('status', 1)
                    ->latest()
                    ->take(12)
                    ->get();

                $packages = Package::query()
                    ->with([
                        'translation' => fn ($q) =>
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

                return compact('things', 'events', 'packages','cities');
            }
        );

        //return view('frontend.home');


        return view('frontend.home', [
            'things'   => $homeData['things'],
            'events'   => $homeData['events'],
            'packages' => $homeData['packages'],
            'cities' => $homeData['cities']
        ]);
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
