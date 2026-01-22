<?php

namespace App\Http\Controllers\Frontend\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\City;
use App\Models\Category;

class EventController extends Controller
{
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
            'events', 'cities', 'categories'
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
                        ->where('name', 'LIKE', "%{$request->search}%");
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

        /* ↕ Sort (ONLY if selected) */
        if ($request->filled('sort')) {
            match ($request->sort) {
                'popular' => $query->orderBy('id', 'desc'),
                'newest'  => $query->orderBy('created_at', 'desc'),
                default   => null, // ❌ no fallback sorting
            };
        }

        return $query;
    }

    /* Event details */
    public function show(Request $request)
    {
        $event = Event::with([
            'translation',
            'thumb',
            'city.translationData',
            'category.translationData'
        ])->where('slug', $request->slug)->firstOrFail();

        return view('frontend.events.show', compact('event'));
    }

    public function eventPackage()
    {
        $language = current_lang();

        $events = Event::query()
            ->with([
                'translation' => fn ($q) =>
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
