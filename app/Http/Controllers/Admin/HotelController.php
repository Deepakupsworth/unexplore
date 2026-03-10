<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\HotelTranslation;
use App\Models\City;
use App\Models\Image;
use App\Models\Language;
use App\Models\PackageDayItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HotelController extends Controller
{
    /**
     * List Hotels
     */
    public function index(Request $request)
    {
        $query = Hotel::query()
            ->with([
                'translations' => fn($q) => $q->where('language_code', 'en'),
                'city',
                'thumb'
            ]);

        // 🔍 Search by hotel name
        if ($request->filled('search')) {
            $query->whereHas('translations', function ($q) use ($request) {
                $q->where('language_code', 'en')
                    ->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // 🏙 Filter by city
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->filled('cities_ids')) {
            $query->whereIn('city_id', $request->cities_ids);
        }

        // ⭐ Filter by star rating
        if ($request->filled('star')) {
            $query->where('star_rating', $request->star);
        }

        // 🍽 Filter by meal
        if ($request->filled('has_meal')) {
            $query->where('has_meal', $request->has_meal);
        }

        // 🟢 Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $hotels = $query->latest()->paginate(10)->withQueryString();

        $cities = City::pluck('slug', 'id');

        return view('backend.hotels.index', compact('hotels', 'cities'));
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

    public function show($id)
    {
        $hotel = Hotel::with([
            'translations',
            'city',
            'images',
            'thumb'
        ])->findOrFail($id);

        return view('backend.hotels.show', compact('hotel'));
    }


    /**
     * Store / Update Hotel
     */
    public function save(Request $request)
    {
        try {

            DB::beginTransaction();

            // Normalize language keys (EN → en)
            $translations = [];
            foreach ($request->translations ?? [] as $lang => $data) {
                $translations[strtolower($lang)] = $data;
            }
            $request->merge(['translations' => $translations]);

            // ✅ Validation (latitude & longitude added)
            $request->validate([
                'city_id' => 'required|exists:cities,id',
                'translations.en.name' => 'required|string|max:255',

                'latitude'  => 'nullable|numeric|between:-90,90',
                'longitude' => 'nullable|numeric|between:-180,180',

            ], [
                'translations.en.name.required' => 'English hotel name is required',
                'city_id.required' => 'Please select a city',

                'latitude.numeric'  => 'Latitude must be a number',
                'latitude.between'  => 'Latitude must be between -90 and 90',

                'longitude.numeric' => 'Longitude must be a number',
                'longitude.between' => 'Longitude must be between -180 and 180',
            ]);

            // Save hotel
            $hotel = Hotel::updateOrCreate(
                ['id' => $request->id],
                [
                    'city_id'     => $request->city_id,
                    'location'    => $request->location,
                    'latitude'    => $request->latitude,
                    'longitude'   => $request->longitude,
                    'email'       => $request->email,
                    'phone'       => $request->phone,
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

            DB::commit();

            return redirect()
                ->route('hotels.index')
                ->with('success', 'Hotel saved successfully');
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('Hotel save failed', [
                'error' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Something went wrong while saving hotel. Please try again.');
        }
    }


    /**
     * Delete Hotel
     */
    public function deleteGallery($id)
    {
        $image = Image::findOrFail($id);

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Delete Hotel
     */
    // public function delete($id)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $hotel = Hotel::with(['gallery', 'thumb', 'translations'])->findOrFail($id);

    //         // 🖼 Delete thumb
    //         if ($hotel->thumb) {
    //             Storage::disk('public')->delete($hotel->thumb->image_path);
    //             $hotel->thumb()->delete();
    //         }

    //         // 🖼 Delete gallery images
    //         foreach ($hotel->gallery as $image) {
    //             Storage::disk('public')->delete($image->image_path);
    //             $image->delete();
    //         }

    //         // 🌍 Delete translations
    //         $hotel->translations()->delete();

    //         // 🏨 Delete hotel
    //         $hotel->delete();

    //         DB::commit();

    //         return redirect()
    //             ->route('hotels.index')
    //             ->with('success', 'Hotel deleted successfully');
    //     } catch (\Throwable $e) {

    //         DB::rollBack();

    //         Log::error('Hotel delete failed', [
    //             'error' => $e->getMessage()
    //         ]);

    //         return redirect()
    //             ->route('hotels.index')
    //             ->with('error', 'Something went wrong while deleting hotel');
    //     }
    // }


    public function delete($id)
    {
        DB::beginTransaction();

        try {

            $hotel = Hotel::with(['gallery', 'thumb', 'translations'])->findOrFail($id);

            /*
        |--------------------------------------------------------------------------
        | CHECK IF HOTEL USED IN ANY PACKAGE
        |--------------------------------------------------------------------------
        */

            $usedInPackage = PackageDayItem::where('item_type', 'hotel')
                ->where('item_id', $hotel->id)
                ->exists();

            if ($usedInPackage) {

                return redirect()
                    ->route('hotels.index')
                    ->with('error', 'Hotel cannot be deleted because it is used in a package.');
            }

            /*
        |--------------------------------------------------------------------------
        | DELETE THUMB
        |--------------------------------------------------------------------------
        */

            if ($hotel->thumb) {
                Storage::disk('public')->delete($hotel->thumb->image_path);
                $hotel->thumb()->delete();
            }

            /*
        |--------------------------------------------------------------------------
        | DELETE GALLERY IMAGES
        |--------------------------------------------------------------------------
        */

            foreach ($hotel->gallery as $image) {
                Storage::disk('public')->delete($image->image_path);
                $image->delete();
            }

            /*
        |--------------------------------------------------------------------------
        | DELETE TRANSLATIONS
        |--------------------------------------------------------------------------
        */

            $hotel->translations()->delete();

            /*
        |--------------------------------------------------------------------------
        | DELETE HOTEL
        |--------------------------------------------------------------------------
        */

            $hotel->delete();

            DB::commit();

            return redirect()
                ->route('hotels.index')
                ->with('success', 'Hotel deleted successfully');
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('Hotel delete failed', [
                'hotel_id' => $id,
                'error' => $e->getMessage()
            ]);

            return redirect()
                ->route('hotels.index')
                ->with('error', 'Something went wrong while deleting hotel');
        }
    }
}
