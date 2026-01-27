<?php

namespace App\Http\Controllers\Frontend\Package;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Package;
use App\Services\Frontend\Package\PackageService;
use Illuminate\Http\Request;
use App\Support\PriceCalculator;

class PackageController extends Controller
{
    protected PackageService $service;

    public function __construct(PackageService $service)
    {
        $this->service = $service;
    }

    /**
     * =========================
     * NORMAL PAGE LOAD (SEO)
     * =========================
     */
    public function index(Request $request)
    {
        // 🌍 Cities (filter sidebar)
        $cities = City::orderBy('slug')->get();

        // 📦 Package type counts
        $packageTypes = Package::select('package_type')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('package_type')
            ->pluck('total', 'package_type');

        // 👥 Persons (default = 1)
        $persons = max((int) $request->get('persons', 1), 1);

        // 📦 Main Query
        $packages = Package::query()
            ->with([
                'translations',
                'cities.city.translations',
                'price',
                'days.items.transport',
                'days.items.hotel',
            ])

            // 🔍 SEARCH (Package title + City name)
            ->when($request->search, function ($q) use ($request) {
                $q->where(function ($qq) use ($request) {
                    $qq->whereHas(
                        'translations',
                        fn($t) =>
                        $t->where('title', 'like', "%{$request->search}%")
                    )
                        ->orWhereHas(
                            'cities.city.translations',
                            fn($ct) =>
                            $ct->where('name', 'like', "%{$request->search}%")
                        );
                });
            })

            // ✈️ FLIGHT FILTER
            ->when(
                $request->flight === 'with',
                fn($q) =>
                $q->whereHas(
                    'days.items.transport',
                    fn($t) => $t->where('type', 'flight')
                )
            )
            ->when(
                $request->flight === 'without',
                fn($q) =>
                $q->whereDoesntHave(
                    'days.items.transport',
                    fn($t) => $t->where('type', 'flight')
                )
            )

            // 💰 PRICE FILTER (PER PERSON ONLY)
            ->when(
                $request->price_min || $request->price_max,
                function ($q) use ($request) {
                    $min = $request->price_min ?? 0;
                    $max = $request->price_max ?? 99999999;

                    $q->whereHas(
                        'price',
                        fn($p) =>
                        $p->whereBetween('per_person_price', [$min, $max])
                    );
                }
            )

            // ⭐ HOTEL RATING
            ->when(
                $request->rating,
                fn($q) =>
                $q->whereHas(
                    'days.items.hotel',
                    fn($h) => $h->whereIn('star_rating', $request->rating)
                )
            )

            // 🌍 CITY FILTER
            ->when(
                $request->cities,
                fn($q) =>
                $q->whereHas(
                    'cities',
                    fn($c) => $c->whereIn('city_id', $request->cities)
                )
            )

            // 📦 PACKAGE TYPE
            ->when(
                $request->package_type,
                fn($q) =>
                $q->whereIn('package_type', $request->package_type)
            )
            // ?todo_category=ID
            // /packages?todo_id=12
            // /packages?event_id=8
            // <a href="{{ route('packages.index', ['event_id' => $event->id]) }}">
            // <a href="{{ route('packages.index', ['todo_id' => $todo->id]) }}">
            // <a href="{{ route('packages.index', ['todo_category' => $category->id]) }}">


            //this is filter to do category
            ->when($request->todo_category, function ($q) use ($request) {
                $q->whereHas('days.items', function ($item) use ($request) {
                    $item->where('item_type', 'todo')
                        ->whereHas('todo', function ($todo) use ($request) {
                            $todo->where('category_id', $request->todo_category);
                        });
                });
            })
            ->when($request->todo_id, function ($q) use ($request) {
                $q->whereHas('days.items', function ($item) use ($request) {
                    $item->where('item_type', 'todo')
                        ->where('item_id', $request->todo_id);
                });
            })
            ->when($request->event_id, function ($q) use ($request) {
                $q->whereHas('days.items', function ($item) use ($request) {
                    $item->where('item_type', 'event')
                        ->where('item_id', $request->event_id);
                });
            })

            ->latest()
            ->paginate(20)
            ->withQueryString();

        // 🔥 Price calculation for cards
        $packages->getCollection()->transform(function ($pkg) use ($persons) {
            $price = PriceCalculator::calculate($pkg->price, $persons);

            $pkg->price_per_person = $price['per_person'];
            $pkg->total_price = $price['total'];

            return $pkg;
        });

        return view(
            'frontend.packages.index',
            compact('packages', 'cities', 'packageTypes', 'persons')
        );
    }

    /**
     * =========================
     * AJAX FILTER LOAD
     * =========================
     */
    public function ajax(Request $request)
    {
        $persons = max((int) $request->get('persons', 1), 1);

        $packages = Package::query()
            ->with([
                'translations',
                'cities.city.translations',
                'price',
                'days.items.transport',
                'days.items.hotel',
            ])

            // 🔍 SEARCH
            ->when($request->search, function ($q) use ($request) {
                $q->where(function ($qq) use ($request) {
                    $qq->whereHas(
                        'translations',
                        fn($t) =>
                        $t->where('title', 'like', "%{$request->search}%")
                    )
                        ->orWhereHas(
                            'cities.city.translations',
                            fn($ct) =>
                            $ct->where('name', 'like', "%{$request->search}%")
                        );
                });
            })

            // ✈️ FLIGHT
            ->when(
                $request->flight === 'with',
                fn($q) =>
                $q->whereHas(
                    'days.items.transport',
                    fn($t) => $t->where('type', 'flight')
                )
            )

            // 💰 PRICE FILTER (PER PERSON)
            ->when(
                $request->price_min || $request->price_max,
                function ($q) use ($request) {
                    $min = $request->price_min ?? 0;
                    $max = $request->price_max ?? 99999999;

                    $q->whereHas(
                        'price',
                        fn($p) =>
                        $p->whereBetween('per_person_price', [$min, $max])
                    );
                }
            )

            // ⭐ HOTEL
            ->when(
                $request->rating,
                fn($q) =>
                $q->whereHas(
                    'days.items.hotel',
                    fn($h) => $h->whereIn('star_rating', $request->rating)
                )
            )

            // 🌍 CITY
            ->when(
                $request->cities,
                fn($q) =>
                $q->whereHas(
                    'cities',
                    fn($c) => $c->whereIn('city_id', $request->cities)
                )
            )

            // 📦 TYPE
            ->when(
                $request->package_type,
                fn($q) =>
                $q->whereIn('package_type', $request->package_type)
            )

            ->latest()
            ->paginate(20);

        // 🔥 Price calculation
        $packages->getCollection()->transform(function ($pkg) use ($persons) {
            $price = PriceCalculator::calculate($pkg->price, $persons);

            $pkg->price_per_person = $price['per_person'];
            $pkg->total_price = $price['total'];

            return $pkg;
        });

        return view('frontend.packages.partials.list', compact('packages'));
    }

    /**
     * =========================
     * PACKAGE DETAILS PAGE
     * =========================
     */
    public function show(string $slug)
    {
        $language = current_lang();

        $package = Package::with([
            // ✅ Package main translation
            'translation' => fn($q) =>
            $q->where('language_code', $language),

            // ✅ Infos translation
            'infos.translation' => fn($q) =>
            $q->where('language_code', $language),

            // ✅ Cities + City translation
            'cities.city.translation' => fn($q) =>
            $q->where('language_code', $language),

            // ✅ Price & media
            'price',
            'thumb',
            'gallery',

            // ✅ Days + City
            'days.city.translation' => fn($q) =>
            $q->where('language_code', $language),

            // ✅ Day items
            'days.items.transport.translation' => fn($q) =>
            $q->where('language_code', $language),

            'days.items.hotel.translation' => fn($q) =>
            $q->where('language_code', $language),
            'days.items.hotel.thumb',

            'days.items.event.translation' => fn($q) =>
            $q->where('language_code', $language),
            'days.items.event.thumb',

            'days.items.todo.translation' => fn($q) =>
            $q->where('language_code', $language),
            'days.items.todo.thumb',
        ])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.packages.show', compact('package'));
    }
}
