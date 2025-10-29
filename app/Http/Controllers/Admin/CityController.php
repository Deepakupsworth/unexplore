<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\CityTranslation;
use App\Models\Language;
use App\Models\CityGalleryImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    /**
     * Show all cities list
     */
    public function index()
    {
        $cities = City::with(['translations' => function($q){
            $q->whereHas('language', fn($l) => $l->where('code', 'en'));
        }])->paginate(10);

        return view('backend.cities.index', compact('cities'));
    }

    public function form($id = null)
    {
        $model = City::with(['translations', 'galleryImages'])->find($id) ?? new City();
        $languages = Language::all();
        return view('backend.cities.form', compact('model', 'languages'));
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slug' => 'required|string|max:255',
            'translations.*.name' => 'nullable|string|max:255',
            'translations.1.name' => 'required|string|max:255', // English required (id=1)
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $city = City::updateOrCreate(
            ['id' => $request->id],
            [
                'slug' => $request->slug,
                'video_url' => $request->video_url,
            ]
        );

        if ($request->hasFile('thumb_image')) {
            if ($city->thumb_image) {
                Storage::delete('public/' . $city->thumb_image);
            }
            $path = $request->file('thumb_image')->store('cities/thumbs', 'public');
            $city->update(['thumb_image' => $path]);
        }

        // Save translations
        foreach ($request->translations as $langId => $data) {
            CityTranslation::updateOrCreate(
                ['city_id' => $city->id, 'language_id' => $langId],
                [
                    'name' => $data['name'] ?? '',
                    'tagline' => $data['tagline'] ?? '',
                    'about' => $data['about'] ?? '',
                ]
            );
        }

        // Save gallery images
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

    public function deleteGalleryImage($id)
    {
        $image = CityGalleryImage::findOrFail($id);
        if ($image->image_path && \Storage::disk('public')->exists($image->image_path)) {
            \Storage::disk('public')->delete($image->image_path);
        }
        $image->delete();

        return response()->json(['success' => true]);
    }
}
