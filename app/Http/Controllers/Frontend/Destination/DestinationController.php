<?php

namespace App\Http\Controllers\Frontend\Destination;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Support\Facades\Cache;

class DestinationController extends Controller
{
    /**
     * Destination listing page
     * URL: /destinations
     */
    public function index()
    {
        $language = app()->getLocale();

        $cities = Cache::remember(
            "frontend_destinations_{$language}",
            now()->addMinutes(30),
            function () use ($language) {
                return City::with([
                    'translation' => fn ($q) =>
                        $q->where('language_code', $language),
                    'thumb'
                ])
                ->get();
            }
        );

        return view('frontend.destinations.index', compact('cities'));
    }

    /**
     * Destination detail page
     * URL: /destinations/{slug}
     */
    public function show(string $slug)
    {
        $language = app()->getLocale();

        $city = City::with([
                'translation' => fn ($q) =>
                    $q->where('language_code', $language),
                'thumb',
                'packages.translation'
            ])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.destinations.show', compact('city'));
    }
}
