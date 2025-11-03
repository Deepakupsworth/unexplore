<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\categoryTranslation;
use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Show all categories list
     */
    public function index()
    {
        $categories = Category::with(['translations' => function($q){
            $q->whereHas('language', fn($l) => $l->where('code', 'en')); 
        }])->paginate(10);

        return view('backend.categories.index', compact('categories'));
    }


    public function form($id = null)
    {
        $model = Category::with(['translations'])->find($id) ?? new Category();
        $languages = Language::all();
      
        return view('backend.categories.form', compact('model', 'languages'));
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

        $categories = Category::updateOrCreate(
            ['id' => $request->id],
            [
                'slug' => $request->slug, 

            ]
        );

   

        if ($request->hasFile('thumb_image')) { 
            if ($categories->thumb_image) {
                Storage::delete('public/' . $categories->thumb_image);
            }
            $path = $request->file('thumb_image')->store('categories/thumbs', 'public');
            $categories->update(['thumb_image' => $path]);
        }

        //create same as thumb_image but for thumb_icon
        if ($request->hasFile('thumb_icon')) {
            if ($categories->thumb_icon) {
                Storage::delete('public/' . $categories->thumb_icon);
            }
            $path = $request->file('thumb_icon')->store('categories/icons', 'public');
            $categories->update(['thumb_icon' => $path]);
        }

        //updateorcreate thumb_icon and thumb_image if exists 

        // if ($categories->thumb_image || $categories->thumb_icon) {
        //     $categories->update([
        //         'thumb_image' => $categories->thumb_image,
        //         'thumb_icon' => $categories->thumb_icon,
        //     ]);
        // }

        // Save translations
        foreach ($request->translations as $langId => $data) {
            categoryTranslation::updateOrCreate(
                ['category_id' => $categories->id, 'language_id' => $langId],
                [
                    'name' => $data['name'] ?? ''
                ]
            );
        }

        // Save gallery images
        // if ($request->hasFile('gallery_images')) {
        //     foreach ($request->file('gallery_images') as $file) {
        //         $path = $file->store('cities/gallery', 'public');
        //         CityGalleryImage::create([
        //             'city_id' => $city->id,
        //             'image_path' => $path,
        //         ]);
        //     }
        // }
        // if ($request->hasFile('thumb_image')) {
        //     $path = $request->file('thumb_image')->store('categories/thumbs', 'public');
        //     $model->thumb_image = $path;
        // }

       
        return redirect()->route('categories.index')->with('success', 'Category saved successfully!');
    }

    // public function deleteGalleryImage($id)
    // {
    //     $image = CityGalleryImage::findOrFail($id);
    //     if ($image->image_path && \Storage::disk('public')->exists($image->image_path)) {
    //         \Storage::disk('public')->delete($image->image_path);
    //     }
    //     $image->delete();

    //     return response()->json(['success' => true]);
    // }

    public function destroy($id)
    {
        $category = \App\Models\Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    } 
    
    
}
