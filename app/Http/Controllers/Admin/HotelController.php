<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\HotelTranslation;
use App\Models\City;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    /**
     * List Hotels
     */
    public function index()
    {
        $hotels = Hotel::with([
            'translations' => fn($q) => $q->where('language_code', 'en'),
            'city',
            'thumb'
        ])->paginate(10);

        return view('backend.hotels.index', compact('hotels'));
    }

    /**
     * Create / Edit form
     */
    public function form($id = null)
    {
        $model = Hotel::with(['translations', 'gallery', 'thumb'])->find($id) ?? new Hotel();
        $languages = Language::all();
        $cities = City::pluck('slug', 'id');

        return view('backend.hotels.form', compact('model', 'languages', 'cities'));
    }

    /**
     * Store / Update Hotel
     */
    public function save(Request $request)
    {
        // Normalize language keys (EN → en)
        $translations = [];
        foreach ($request->translations ?? [] as $lang => $data) {
            $translations[strtolower($lang)] = $data;
        }
        $request->merge(['translations' => $translations]);

        // Validate
        $request->validate([
            'city_id' => 'required|exists:cities,id',
            'translations.en.name' => 'required|string|max:255',
        ], [
            'translations.en.name.required' => 'English hotel name is required',
            'city_id.required' => 'Please select a city',
        ]);

        // Save hotel
        $hotel = Hotel::updateOrCreate(
            ['id' => $request->id],
            [
                'city_id'      => $request->city_id,
                'star_rating' => $request->star_rating,
                'has_meal'    => $request->has_meal ? 1 : 0,
                'status'      => $request->status ? 1 : 0,
            ]
        );

        // Save translations
        foreach ($request->translations as $lang => $data) {
            if (!empty($data['name'])) {
                HotelTranslation::updateOrCreate(
                    [
                        'hotel_id' => $hotel->id,
                        'language_code' => $lang
                    ],
                    [
                        'name' => $data['name'],
                        'description' => $data['description'] ?? null
                    ]
                );
            }
        }

        // Save thumb
        if ($request->hasFile('thumb')) {
            if ($hotel->thumb) {
                Storage::disk('public')->delete($hotel->thumb->image_path);
                $hotel->thumb()->delete();
            }

            storeImage($hotel, $request->thumb, 'hotels/thumbs', 'thumb', 'en', true);
        }

        // Save gallery
        if ($request->hasFile('gallery')) {
            foreach ($request->gallery as $file) {
                storeImage($hotel, $file, 'hotels/gallery', 'gallery');
            }
        }

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel saved successfully');
    }

    /**
     * Delete Hotel
     */
    public function delete($id)
    {
        $hotel = Hotel::findOrFail($id);

        // delete all images
        foreach ($hotel->images as $img) {
            Storage::disk('public')->delete($img->image_path);
        }

        $hotel->delete();

        return redirect()->back()->with('success', 'Hotel deleted');
    }
}
