<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\CityTranslation;
use App\Models\Language;
use App\Models\CityGalleryImage;
use App\Models\Country;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    // List cities
    public function index()
    {
        $cities = City::with(['translations' => function ($q) {
            $q->where('language_code', 'en');
        }])->paginate(10);

        return view('backend.cities.index', compact('cities'));
    }

    // Create / Edit form
    public function form($id = null)
    {
        $model = City::with(['translations', 'galleryImages'])->find($id) ?? new City();
        $languages = Language::all();
        $countries = Country::pluck('name', 'id'); // <-- ADD THIS

        return view('backend.cities.form', compact('model', 'languages', 'countries'));
    }

    // Store / Update
    public function save(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'country_id' => 'required|exists:countries,id',
            'translations.*.name' => 'nullable|string|max:255',
            'translations.en.name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Save city
        $city = City::updateOrCreate(
            ['id' => $request->id],
            [
                'country_id' => $request->country_id,   // 🔥 REQUIRED
                'slug' => $request->slug ?? Str::slug($request->translations['en']['name']),
                'video_url' => $request->video_url,
            ]
        );

        // Thumb image
        if ($request->hasFile('thumb_image')) {
            if ($city->thumb_image) {
                Storage::disk('public')->delete($city->thumb_image);
            }
            $path = $request->file('thumb_image')->store('cities/thumbs', 'public');
            $city->update(['thumb_image' => $path]);
        }

        // Translations
        foreach ($request->translations as $langCode => $data) {
            if (!empty($data['name'])) {
                CityTranslation::updateOrCreate(
                    [
                        'city_id' => $city->id,
                        'language_code' => $langCode,
                    ],
                    [
                        'name' => $data['name'],
                        'tagline' => $data['tagline'] ?? null,
                        'about' => $data['about'] ?? null,
                    ]
                );
            }
        }

        // Gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $path = $file->store('cities/gallery', 'public');
                CityGalleryImage::create([
                    'city_id' => $city->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('cities.index')->with('success', 'City saved successfully!');
    }

    // Delete gallery image
    public function deleteGalleryImage($id)
    {
        $image = CityGalleryImage::findOrFail($id);

        if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
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
