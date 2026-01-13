<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * List categories
     */
    public function index()
    {
        $categories = Category::with('translation')->paginate(10);
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Create / Edit form
     */
    public function form($id = null)
    {
        $model = Category::with('translations')->find($id) ?? new Category();
        $languages = Language::all();

        return view('backend.categories.form', compact('model', 'languages'));
    }

    /**
     * Store / Update Category
     */
    public function save(Request $request)
    {
        // English name is mandatory
        $request->validate([
            'translations.en.name' => 'required|string|max:255',
            'thumb_image' => 'nullable|image|max:2048',
            'thumb_icon'  => 'nullable|image|max:1024',
        ]);

        // Create or Update category
        $category = Category::updateOrCreate(
            ['id' => $request->id],
            [
                'slug' => $request->slug ?: Str::slug($request->translations['en']['name']),
            ]
        );

        /**
         * Save thumb image
         */
        if ($request->hasFile('thumb_image')) {
            if ($category->thumb_image) {
                Storage::disk('public')->delete($category->thumb_image);
            }

            $path = $request->file('thumb_image')->store('categories/thumbs', 'public');
            $category->update(['thumb_image' => $path]);
        }

        /**
         * Save thumb icon
         */
        if ($request->hasFile('thumb_icon')) {
            if ($category->thumb_icon) {
                Storage::disk('public')->delete($category->thumb_icon);
            }

            $path = $request->file('thumb_icon')->store('categories/icons', 'public');
            $category->update(['thumb_icon' => $path]);
        }

        /**
         * Save translations
         */
        foreach ($request->translations as $langCode => $data) {

            $langCode = strtolower($langCode);
            $name = trim($data['name'] ?? '');

            // Remove translation if field is empty
            if ($name === '') {
                CategoryTranslation::where('category_id', $category->id)
                    ->where('language_code', $langCode)
                    ->delete();
                continue;
            }

            // Create or update translation
            CategoryTranslation::updateOrCreate(
                [
                    'category_id'   => $category->id,
                    'language_code'=> $langCode,
                ],
                [
                    'name' => $name
                ]
            );
        }

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category saved successfully!');
    }

    /**
     * Delete Category
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->thumb_image) {
            Storage::disk('public')->delete($category->thumb_image);
        }

        if ($category->thumb_icon) {
            Storage::disk('public')->delete($category->thumb_icon);
        }

        $category->delete();

        return redirect()
            ->back()
            ->with('success', 'Category deleted successfully.');
    }
}
