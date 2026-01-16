<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CategoryType;
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
    public function index(Request $request)
    {
        $query = Category::with('translation');

        // 🔍 Search by category name (English)
        if ($request->filled('search')) {
            $query->whereHas('translation', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $categories = $query->latest()->paginate(10)->withQueryString();

        return view('backend.categories.index', compact('categories'));
    }


    /**
     * Create / Edit form
     */
    public function form($id = null)
    {
        $model = Category::with('translations')->find($id) ?? new Category();
        $languages = Language::all();
        $types = CategoryType::cases();

        return view('backend.categories.form', compact('model', 'languages','types'));
    }

    /**
     * Store / Update Category
     */

    public function save(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'type'                  => 'required|string|max:50', // 👈 NEW
            'translations.en.name'  => 'required|string|max:255',
            'thumb_image'           => 'nullable|image|max:2048',
            'thumb_icon'            => 'nullable|image|max:1024',
        ]);

        /**
         * Create or Update Category
         */
        $category = Category::updateOrCreate(
            ['id' => $request->id],
            [
                'type' => $request->type, // 👈 IMPORTANT
                'slug' => $request->slug
                    ?: Str::slug($request->translations['en']['name']),
            ]
        );

        /**
         * Save Thumb Image
         */
        if ($request->hasFile('thumb_image')) {
            if ($category->thumb_image) {
                Storage::disk('public')->delete($category->thumb_image);
            }

            $path = $request->file('thumb_image')
                ->store('categories/thumbs', 'public');

            $category->update(['thumb_image' => $path]);
        }

        /**
         * Save Thumb Icon
         */
        if ($request->hasFile('thumb_icon')) {
            if ($category->thumb_icon) {
                Storage::disk('public')->delete($category->thumb_icon);
            }

            $path = $request->file('thumb_icon')
                ->store('categories/icons', 'public');

            $category->update(['thumb_icon' => $path]);
        }

        /**
         * Save Translations
         */
        foreach ($request->translations as $langCode => $data) {

            $langCode = strtolower($langCode);
            $name = trim($data['name'] ?? '');

            // ❌ Remove translation if name empty
            if ($name === '') {
                CategoryTranslation::where('category_id', $category->id)
                    ->where('language_code', $langCode)
                    ->delete();
                continue;
            }

            // ✅ Create or Update translation
            CategoryTranslation::updateOrCreate(
                [
                    'category_id'    => $category->id,
                    'language_code'  => $langCode,
                ],
                [
                    'name' => $name,
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
