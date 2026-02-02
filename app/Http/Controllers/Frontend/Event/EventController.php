<?php

namespace App\Http\Controllers\Frontend\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\City;
use App\Models\Category;
use App\Models\Package;

class EventController extends Controller
{

    private string $language;

    public function __construct()
    {
        // ✅ Single source of truth for language
        $this->language = current_lang();
        // or: config('translation.default_language', 'en');
    }
    public function index(Request $request)
    {
        $lang = current_lang();

        $cities = City::has('events')
            ->with('translationData')
            ->withCount('events')
            ->orderByDesc('events_count')
            ->get();

        $categories = Category::where('type', 'event')
            ->has('events')
            ->with('translationData')
            ->withCount('events')
            ->orderByDesc('events_count')
            ->get();

        $events = $this->applyFilters(
            Event::query(),
            $request,
            $lang
        )->paginate(12)->withQueryString();

        return view('frontend.events.index', compact(
            'events',
            'cities',
            'categories'
        ));
    }

    /* AJAX filter */
    public function filter(Request $request)
    {
      
        $lang = current_lang();

        $events = $this->applyFilters(
            Event::query(),
            $request,
            $lang
        )->paginate(12);

        return view(
            'frontend.events.partials.list',
            compact('events')
        )->render();
    }

    /* Shared filters */
    private function applyFilters($query, Request $request, $lang)
    {
        $query->with([
            'translation',
            'thumb',
            'city.translationData',
            'category.translationData'
        ]);

        /* 🔎 Search */
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $lang) {
                $q->where('location', 'LIKE', "%{$request->search}%")
                    ->orWhereHas('translation', function ($t) use ($request, $lang) {
                        $t->where('language_code', $lang)
                            ->where('title', 'LIKE', "%{$request->search}%");
                    });
            });
        }

        /* ☑ Categories */
        if ($request->filled('categories')) {
            $query->whereIn('category_id', $request->categories);
        }

        /* ☑ Cities */
        if ($request->filled('cities')) {
            $query->whereIn('city_id', $request->cities);
        }

        if ($request->filled('sort')) {

            match ($request->sort) {
                'popular'     => $query->orderBy('id', 'desc'),
                'newest'      => $query->orderBy('created_at', 'desc'),
                // 'price_low'   => $query->orderBy('price', 'asc'),
                // 'price_high'  => $query->orderBy('price', 'desc'),
                default       => $query->orderByDesc('id'),
            };
        }

        return $query;
    }

    /* Event details */
    public function show(Request $request)
    {
        $lang = $this->language;
        $event = Event::with([
            'translation',
            'thumb',
            'city.translation',
            'category.translation'
        ])
            ->where('slug', $request->slug)
            ->firstOrFail();

        // Similar Events (Random + Open + Skip Current)
        $similarEvents = Event::with([
            'translation',
            'thumb',
            'category.translation'
        ])
            ->where('id', '!=', $event->id) // skip current event
            ->where('status', 1)            // only active
            ->where(function ($q) {
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>=', now()->toDateString());
            })
            ->where('category_id', $event->category_id) // OPTIONAL but recommended
            ->inRandomOrder()
            ->limit(4)
            ->get();

            $relatedPackages = Package::with([
                // 🔹 package translation (language aware)
                'translation' => fn ($q) =>
                    $q->where('language_code', $lang),

                'thumb',

                // 🔹 category translation (language aware)
                'category.translation' => fn ($q) =>
                    $q->where('language_code', $lang),
            ])
            ->whereHas('days.items', function ($q) use ($event) {
                $q->where('item_type', 'event')
                  ->where('item_id', $event->id);
            })
            ->where('status', 'active')
            ->distinct()
            ->get();


        return view('frontend.events.show', compact('event', 'similarEvents','relatedPackages'));
    }



    public function eventPackage()
    {
        $language = current_lang();

        $events = Event::query()
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
    }
}
