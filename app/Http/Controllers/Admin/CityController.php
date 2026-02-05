<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Enums\CategoryType;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\CityTranslation;
use App\Models\Language;
use App\Models\Country;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CityController extends Controller
{
    // List cities
    public function index(Request $request)
    {
        $query = City::with([
            'translations' => fn($q) => $q->where('language_code', 'en'),
            'images'
        ]);

        // 🔍 Search by city name
        if ($request->filled('search')) {
            $query->whereHas('translations', function ($q) use ($request) {
                $q->where('language_code', 'en')
                    ->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // 🌍 Country filter
        if ($request->filled('country_id')) {
            $query->where('country_id', $request->country_id);
        }

        // Execute query
        $cities = $query->latest()->paginate(10)->withQueryString();

        // For dropdown
        $countries = \App\Models\Country::pluck('name', 'id');

        return view('backend.cities.index', compact('cities', 'countries'));
    }


    // Create / Edit form
    public function form($id = null)
    {
        $model = City::with(['translations', 'images'])->find($id) ?? new City();
        $languages = Language::all();
        $countries = Country::pluck('name', 'id');
        $categories = Category::where('type', CategoryType::CITY)
            ->with('translation')
            ->get();


        return view('backend.cities.form', compact('model', 'languages', 'countries', 'categories'));
    }

    // Store / Update
    // public function save(Request $request)
    // {
    //     DB::beginTransaction();

    //     try {

    //         // Normalize language keys: EN → en
    //         $translations = [];
    //         foreach ($request->translations ?? [] as $key => $value) {
    //             $translations[strtolower($key)] = $value;
    //         }
    //         $request->merge(['translations' => $translations]);

    //         // Validation
    //         $validator = Validator::make($request->all(), [
    //             'country_id' => 'required|exists:countries,id',
    //             'category_id' => 'nullable|exists:categories,id',
    //             'translations.en.name' => 'required|string|max:255',
    //             'translations.*.name' => 'nullable|string|max:255',
    //             'slug' => [
    //                 'nullable',
    //                 'string',
    //                 'max:255',
    //                 Rule::unique('cities', 'slug')->ignore($request->id),
    //             ],
    //         ]);

    //         if ($validator->fails()) {
    //             return back()->withErrors($validator)->withInput();
    //         }

    //         // Create / Update City
    //         $city = City::updateOrCreate(
    //             ['id' => $request->id],
    //             [
    //                 'country_id'  => $request->country_id,
    //                 'category_id' => $request->category_id,
    //                 'slug'        => $request->slug ?? Str::slug($request->translations['en']['name']),
    //                 'video_url'   => $request->video_url,
    //             ]
    //         );

    //         // Save Translations
    //         foreach ($request->translations as $langCode => $data) {
    //             if (!empty($data['name'])) {
    //                 CityTranslation::updateOrCreate(
    //                     [
    //                         'city_id'       => $city->id,
    //                         'language_code' => $langCode,
    //                     ],
    //                     [
    //                         'name'    => $data['name'],
    //                         'tagline' => $data['tagline'] ?? null,
    //                         'about'   => $data['about'] ?? null,
    //                     ]
    //                 );
    //             }
    //         }

    //         // Save Thumb
    //         if ($request->hasFile('thumb_image')) {

    //             if ($city->thumb_image && Storage::disk('public')->exists($city->thumb_image)) {
    //                 Storage::disk('public')->delete($city->thumb_image);
    //             }

    //             $path = $request->file('thumb_image')->store('cities/thumbs', 'public');
    //             $city->update(['thumb_image' => $path]);
    //         }

    //         // Save Gallery
    //         if ($request->hasFile('gallery_images')) {
    //             foreach ($request->file('gallery_images') as $file) {
    //                 storeImage($city, $file, 'cities/gallery', 'gallery');
    //             }
    //         }

    //         DB::commit();

    //         return redirect()
    //             ->route('cities.index')
    //             ->with('success', 'City saved successfully!');
    //     } catch (Throwable $e) {
    //         DB::rollBack();

    //         Log::error('City save failed', [
    //             'error' => $e->getMessage(),
    //             'trace' => $e->getTraceAsString(),
    //             'data'  => $request->all(),
    //         ]);

    //         return back()
    //             ->withInput()
    //             ->with('error', 'Something went wrong while saving the city. Please try again.');
    //     }
    // }

    public function save(Request $request)
    {
        DB::beginTransaction();

        try {

            /** ---------------- NORMALIZE LANG KEYS ---------------- */
            $translations = [];
            foreach ($request->translations ?? [] as $key => $value) {
                $translations[strtolower($key)] = $value;
            }
            $request->merge(['translations' => $translations]);

            /** ---------------- VALIDATION ---------------- */
            $validator = Validator::make($request->all(), [
                'country_id'            => 'required|exists:countries,id',

                // ✅ MULTI CATEGORY
                'category_ids'          => 'nullable|array',
                'category_ids.*'        => 'exists:categories,id',

                'translations.en.name'  => 'required|string|max:255',
                'translations.*.name'   => 'nullable|string|max:255',

                'slug' => [
                    'nullable',
                    'string',
                    'max:255',
                    Rule::unique('cities', 'slug')->ignore($request->id),
                ],

                'video_url'   => 'nullable|url',
                'thumb_image' => 'nullable|image|max:2048',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            /** ---------------- CREATE / UPDATE CITY ---------------- */
            $city = City::updateOrCreate(
                ['id' => $request->id],
                [
                    'country_id' => $request->country_id,
                    'slug'       => $request->slug
                        ?: Str::slug($request->translations['en']['name']),
                    'video_url'  => $request->video_url,
                ]
            );

            /** ---------------- SAVE TRANSLATIONS ---------------- */
            foreach ($request->translations as $langCode => $data) {
                if (!empty($data['name'])) {
                    CityTranslation::updateOrCreate(
                        [
                            'city_id'       => $city->id,
                            'language_code' => $langCode,
                        ],
                        [
                            'name'    => $data['name'],
                            'tagline' => $data['tagline'] ?? null,
                            'about'   => $data['about'] ?? null,
                        ]
                    );
                }
            }

            /** ---------------- SAVE MULTI CATEGORIES (PIVOT) ---------------- */
            if ($request->filled('category_ids')) {
                $city->categories()->sync($request->category_ids);
            } else {
                // optional: remove all categories if none selected
                $city->categories()->detach();
            }

            /** ---------------- THUMB IMAGE ---------------- */
            if ($request->hasFile('thumb_image')) {

                if ($city->thumb_image && Storage::disk('public')->exists($city->thumb_image)) {
                    Storage::disk('public')->delete($city->thumb_image);
                }

                $path = $request->file('thumb_image')
                    ->store('cities/thumbs', 'public');

                $city->update(['thumb_image' => $path]);
            }

            /** ---------------- GALLERY ---------------- */
            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $file) {
                    storeImage($city, $file, 'cities/gallery', 'gallery');
                }
            }

            DB::commit();

            return redirect()
                ->route('cities.index')
                ->with('success', 'City saved successfully!');
        } catch (Throwable $e) {

            DB::rollBack();

            Log::error('City save failed', [
                'error' => $e->getMessage(),
                'line'  => $e->getLine(),
                'data'  => $request->all(),
            ]);
            return back()
                ->withInput()
                ->with('error', 'Something went wrong while saving the city.');
        }
    }


    public function show($id)
    {
        $city = City::with([
            'translations',
            'translation',        // default EN
            'category.translation',
            'country',            // if relation exists
            'images',             // gallery images
        ])->findOrFail($id);

        return view('backend.cities.show', compact('city'));
    }


    // Delete image (polymorphic)
    public function deleteImage($id)
    {
        $image = Image::findOrFail($id);

        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        return response()->json(['success' => true]);
    }

    // Delete city
    public function destroy($id)
    {
        City::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'City deleted successfully.');
    }
}
