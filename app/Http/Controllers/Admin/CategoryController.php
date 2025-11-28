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
            'translations.*.name' => 'nullable|string|max:255',
            'translations.1.name' => 'required|string|max:255', // English required (id=1)
        ]);

        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $categories = Category::updateOrCreate(
            ['id' => $request->id],
            [
                'slug' => $request->slug ?? Str::slug($request->translations[1]['name']), 

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

        // Save translations
        foreach ($request->translations as $langId => $data) {
            if($data['name'])
            {
                categoryTranslation::updateOrCreate(
                    ['category_id' => $categories->id, 'language_id' => $langId],
                    [
                        'name' => $data['name'] ?? ''
                    ]
                );
            }
        }

        return redirect()->route('categories.index')->with('success', 'Category saved successfully!');
    }


    public function destroy($id)
    {
        $category = \App\Models\Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    } 
    
    
}
