<?php

namespace App\Services\Frontend\Package;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageService
{
    /**
     * =========================
     * BASE QUERY
     * =========================
     */
    public function baseQuery()
    {

        $lang = app()->getLocale();

        return Package::query()
            ->with([
                'thumb',
                'price',
                'translations' => function ($q) use ($lang) {
                    $q->where('language_code', $lang);
                },
                'cities.city',
            ])
            ->where('status', 'active')
            ->latest()
            ->paginate(12);
    }

    /**
     * =========================
     * APPLY ALL FILTERS
     * =========================
     */
    public function applyFilters(Request $request)
    {
        $query = $this->baseQuery();

        /* 🔍 SEARCH */
        if ($request->filled('search')) {
            $query->whereHas('translations', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%');
            });
        }

        /* 📦 PACKAGE TYPE */
        if ($request->filled('package_type')) {
            $query->whereIn('package_type', (array) $request->package_type);
        }

        /* 💰 BUDGET */
        if ($request->filled('budget')) {
            $query->whereHas('price', function ($q) use ($request) {
                foreach ($request->budget as $range) {
                    [$min, $max] = explode('-', $range);
                    $q->orWhereBetween(
                        'per_person_price',
                        [(int) $min, (int) $max]
                    );
                }
            });
        }

        /* 🌍 CITIES */
        if ($request->filled('cities')) {
            $query->whereHas('cities.city', function ($q) use ($request) {
                $q->whereIn('slug', (array) $request->cities);
            });
        }

        /* ↕ SORT */
        switch ($request->sort) {
            case 'price_low':
                $query->orderByPrice('asc');
                break;

            case 'price_high':
                $query->orderByPrice('desc');
                break;

            default:
                $query->latest();
        }

        return $query;
    }
}
