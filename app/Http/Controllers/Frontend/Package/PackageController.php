<?php

namespace App\Http\Controllers\Frontend\Package;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Package;
use App\Services\Frontend\Package\PackageService;
use Illuminate\Http\Request;

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
        // 🌍 Cities
        $cities = City::orderBy('slug')->get();

        // 📦 PACKAGE TYPE COUNTS (FILTER SIDEBAR)
        $packageTypes = Package::select('package_type')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('package_type')
            ->pluck('total', 'package_type');

        // 📦 MAIN PACKAGE LIST QUERY
        $packages = Package::query()
            ->with([
                'translations',
                'cities.city',
                'price',
                'days.items.transport',
                'days.items.hotel'
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
                            'cities.city',
                            fn($c) =>
                            $c->where('name', 'like', "%{$request->search}%")
                        );
                });
            })

            // ✈️ FLIGHT
            ->when(
                $request->flight === 'with',
                fn($q) =>
                $q->whereHas(
                    'days.items.transport',
                    fn($t) =>
                    $t->where('type', 'flight')
                )
            )
            ->when(
                $request->flight === 'without',
                fn($q) =>
                $q->whereDoesntHave(
                    'days.items.transport',
                    fn($t) =>
                    $t->where('type', 'flight')
                )
            )

            // 💰 BUDGET
            ->when($request->budget, function ($q) use ($request) {
                $q->whereHas('price', function ($p) use ($request) {
                    foreach ($request->budget as $range) {
                        [$min, $max] = explode('-', $range);
                        $p->orWhereBetween('per_person_price', [$min, $max]);
                    }
                });
            })

            // ⭐ HOTEL RATING
            ->when(
                $request->rating,
                fn($q) =>
                $q->whereHas(
                    'days.items.hotel',
                    fn($h) =>
                    $h->whereIn('star_rating', $request->rating)
                )
            )

            // 🌍 CITIES
            ->when(
                $request->cities,
                fn($q) =>
                $q->whereHas(
                    'cities',
                    fn($c) =>
                    $c->whereIn('city_id', $request->cities)
                )
            )

            // 📦 PACKAGE TYPE (🔥 FIXED)
            ->when(
                $request->package_type,
                fn($q) =>
                $q->whereIn('package_type', $request->package_type)
            )

            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view(
            'frontend.packages.index',
            compact('packages', 'cities', 'packageTypes')
        );
    }



    /**
     * =========================
     * AJAX FILTER LOAD
     * =========================
     */
    public function ajax(Request $request)
    {
        $packages = Package::query()
            ->with([
                'translations',
                'cities.city',
                'price',
                'days.items.transport',
                'days.items.hotel'
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
                            'cities.city',
                            fn($c) =>
                            $c->where('name', 'like', "%{$request->search}%")
                        );
                });
            })

            // ✈️ FLIGHT
            ->when(
                $request->flight === 'with',
                fn($q) =>
                $q->whereHas(
                    'days.items.transport',
                    fn($t) =>
                    $t->where('type', 'flight')
                )
            )
            ->when(
                $request->flight === 'without',
                fn($q) =>
                $q->whereDoesntHave(
                    'days.items.transport',
                    fn($t) =>
                    $t->where('type', 'flight')
                )
            )

            // 💰 BUDGET
            ->when($request->budget, function ($q) use ($request) {
                $q->whereHas('price', function ($p) use ($request) {
                    foreach ($request->budget as $range) {
                        [$min, $max] = explode('-', $range);
                        $p->orWhereBetween('per_person_price', [$min, $max]);
                    }
                });
            })

            // ⭐ HOTEL RATING
            ->when(
                $request->rating,
                fn($q) =>
                $q->whereHas(
                    'days.items.hotel',
                    fn($h) =>
                    $h->whereIn('star_rating', $request->rating)
                )
            )

            // 🌍 CITIES
            ->when(
                $request->cities,
                fn($q) =>
                $q->whereHas(
                    'cities',
                    fn($c) =>
                    $c->whereIn('city_id', $request->cities)
                )
            )

            // 📦 PACKAGE TYPE (🔥 THIS WAS MISSING)
            ->when(
                $request->package_type,
                fn($q) =>
                $q->whereIn('package_type', $request->package_type)
            )

            ->latest()
            ->paginate(20);

        // ✅ IMPORTANT: ONLY LIST PARTIAL
        return view('frontend.packages.partials.list', compact('packages'));
    }


    public function show(string $slug)
    {
        $package = Package::with([
            'translations',
            'cities.city',
            'price',
            'thumb',              // banner images
            'days.city',
            'days.items.transport',
            'days.items.hotel',
            'days.items.event',
            'days.items.todo',
        ])->where('slug', $slug)->firstOrFail();

        return view('frontend.packages.show', compact('package'));
    }
}
