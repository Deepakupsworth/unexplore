<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;  // ✅ add this
use App\Models\CategoryTranslation; // ✅ add this too if you’re using translations
use App\Models\Language;


class CategoryController extends Controller
{

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'thumb_image' => 'nullable|image|mimes:jpg,jpeg,png',
        'thumb_icon' => 'nullable|image|mimes:jpg,jpeg,png',
        'lang' => 'required|string'
    ]);

     // ✅ Check if English version exists before adding other language
    //  if ($request->lang !== 'en') {
    //     $englishCategory = CategoryTranslation::where('language_id', 1)->first();

    //     if (!$englishCategory) {
    //         return redirect()->back()->with('error', 'You must first add the English category before adding translations.');
    //     }
    // }

    // ✅ 1. Upload images
    $thumbImagePath = null;
    $thumbIconPath = null;

    if ($request->hasFile('thumb_image')) {
        $thumbImagePath = $request->file('thumb_image')->store('categories/images', 'public');
    }

    if ($request->hasFile('thumb_icon')) {
        $thumbIconPath = $request->file('thumb_icon')->store('categories/icons', 'public');
        
    }

    // ✅ 2. Create Category
    $category = Category::create([
        'slug' => \Str::slug($request->name),
        'thumb_image' => $thumbImagePath,
        'thumb_icon' => $thumbIconPath,
    ]);

    // ✅ 3. Get language ID or default
    $language = match ($request->lang) {
        'en' => 1,
        'de' => 2,
        'ar' => 3,
        default => 1,
    };

    // ✅ 4. Create translation
    $category->translations()->create([
        'language_id' => $language,
        'name' => $request->name,
    ]);

    return redirect()->back()->with('success', 'Category created successfully!');
}

public function edit($id, Request $request)
    {
        $lang = $request->get('lang', 'en');
        $language = Language::where('code', $lang)->first();

        $category = Category::with(['translations' => function ($q) use ($language) {
            $q->where('language_id', $language->id ?? 1);
        }])->findOrFail($id);
        // print_r($category);die;
        return view('backend.pages.edit_categories', compact('category', 'lang'))->back()->with('success', 'Category created successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'thumb_image' => 'nullable|image|mimes:jpg,jpeg,png',
            'thumb_icon' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $category = Category::findOrFail($id);

        // ✅ Handle images (only replace if new ones uploaded)
        if ($request->hasFile('thumb_image')) {
            $category->thumb_image = $request->file('thumb_image')->store('categories/images', 'public');
        }

        if ($request->hasFile('thumb_icon')) {
            $category->thumb_icon = $request->file('thumb_icon')->store('categories/icons', 'public');
        }

        $category->save();

        // ✅ Update translation
        $language = Language::where('code', $request->lang)->first();

        $translation = CategoryTranslation::updateOrCreate(
            [
                'category_id' => $category->id,
                'language_id' => $language->id ?? 1,
            ],
            [
                'name' => $request->name,
            ]
        );

        return redirect()->back()->with('success', 'Category updated successfully!');
    }

   

}