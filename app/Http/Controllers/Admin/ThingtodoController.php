<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ThingToDo;
use App\Models\ThingToDoTranslation;
use App\Models\ThingGalleryImage;
use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ThingtodoController extends Controller
{
    /**
     * Show all things to do list
     */
    public function index()
    {
        $thingstodos = ThingToDo::with(['translations' => function($q){
            $q->whereHas('language', fn($l) => $l->where('code', 'en'));
        }])->paginate(10); 

        // print_r($thingstodo); die;
        return view('backend.thingtodos.index', compact('thingstodos'));
    }

    public function form($id = null)
    {
        $model = ThingToDo::with(['translations', 'galleryImages'])->find($id) ?? new ThingToDo();
        $languages = Language::all();

        // fetch all cities with plucked id and name in english
        $cities = \App\Models\City::with(['translations' => function($q){
            $q->whereHas('language', fn($l) => $l->where('code', 'en'));
        }])->get()->pluck('translations.0.name', 'id'); 

        $categories = \App\Models\Category::with(['translations' => function($q){
            $q->whereHas('language', fn($l) => $l->where('code', 'en'));
        }])->get()->pluck('translations.0.name', 'id'); 


        // print_r($cities); die;
        return view('backend.thingtodos.form', compact('model', 'languages', 'cities', 'categories'));
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
//   print_r($request->all()); die;
        $thingstodo = ThingToDo::updateOrCreate(
            ['id' => $request->id],
            [
                'slug' => $request->slug,
                'image' => $request->image,
                'location' => $request->location,
                'city_id' => $request->city_id,
                'category_id' => $request->category_id
            ]
        );

        if ($request->hasFile('thumb_image')) {
            if ($thingstodo->thumb_image) {
                Storage::delete('public/' . $thingstodo->thumb_image);
            }
            $path = $request->file('thumb_image')->store('cities/thumbs', 'public');
            $thingstodo->update(['image' => $path]);
        }

        // Save translations
        foreach ($request->translations as $langId => $data) {
            ThingToDoTranslation::updateOrCreate(
                ['thing_id' => $thingstodo->id, 'language_id' => $langId],
                [
                    'name' => $data['name'] ?? '',
                    'about' => $data['about'] ?? '',
                ]
            );
        }

        // Save gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $path = $file->store('thingtodos/gallery', 'public');
                ThingGalleryImage::create([
                    'thing_id' => $thingstodo->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('thingtodos.index')->with('success', 'Thing to do saved successfully!');
    }

    public function deleteGalleryImage($id)
    {
        $image = ThingGalleryImage::findOrFail($id);
        if ($image->image_path && \Storage::disk('public')->exists($image->image_path)) {
            \Storage::disk('public')->delete($image->image_path);
        }
        $image->delete();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $thingstodo = \App\Models\ThingToDo::findOrFail($id);
        $thingstodo->delete();
        return redirect()->back()->with('success', 'Thing to do deleted successfully.');
    } 
}
