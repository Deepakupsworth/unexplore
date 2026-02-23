<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTranslation;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with(['translation', 'thumb']);

        if ($request->filled('search')) {
            $query->whereHas('translations', function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%");
            });
        }

        $blogs = $query->latest()->paginate(15);

        return view('backend.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $model = new Blog();
        $languages = Language::all();

        return view('backend.blogs.form', compact('model', 'languages'));
    }

    public function edit($id)
    {
        $model = Blog::with('translations', 'thumb')->findOrFail($id);
        $languages = Language::all();


        return view('backend.blogs.form', compact('model', 'languages'));
    }

    public function save(Request $request)
    {
        /** ---------------- VALIDATION ---------------- */
        $validated = $request->validate([
            'translations.en.title'   => 'required|string|max:255',
            'translations.en.content' => 'required|string',

            'translations.*.title'   => 'nullable|string|max:255',
            'translations.*.content' => 'nullable|string',

            'is_published' => 'required|in:0,1',

            'thumb_image' => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();

        try {

            /** ---------------- FIND OR CREATE ---------------- */
            if ($request->filled('id')) {
                $blog = Blog::findOrFail($request->id);
                $isUpdate = true;
            } else {
                $blog = new Blog();
                $isUpdate = false;
            }

            /** ---------------- PUBLISH LOGIC (BACKEND CONTROLLED) ---------------- */
            $isPublished = (int) $validated['is_published'];

            // 🧠 smart publish handling
            if ($isPublished == 1) {
                // first time publish → set now
                if (!$blog->published_at) {
                    $publishedAt = now();
                } else {
                    // already published → keep old date
                    $publishedAt = $blog->published_at;
                }
            } else {
                // unpublished
                $publishedAt = null;
            }

            /** ---------------- BLOG DATA ---------------- */
            $blog->fill([
                'user_id'      => auth()->id(),
                'slug'         => Str::slug($validated['translations']['en']['title']),
                'is_published' => $isPublished,
                'published_at' => $publishedAt,
            ]);

            $blog->save();

            /** ---------------- TRANSLATIONS ---------------- */
            foreach ($validated['translations'] as $lang => $data) {

                if (empty($data['title']) && empty($data['content'])) {
                    continue;
                }

                BlogTranslation::updateOrCreate(
                    [
                        'blog_id'       => $blog->id,
                        'language_code' => strtolower($lang),
                    ],
                    [
                        'title'   => $data['title'],
                        'content' => $data['content'],
                    ]
                );
            }

            /** ---------------- THUMB IMAGE (CLEAN) ---------------- */
            if ($request->hasFile('thumb_image')) {

                optional($blog->thumb)->delete();

                storeImage(
                    $blog,
                    $request->file('thumb_image'),
                    'blogs/thumbs',
                    'thumb',
                    'en',
                    true
                );
            }

            DB::commit();

            return redirect()
                ->route('admin.blogs.index')
                ->with('success', 'Blog saved successfully');
        } catch (\Throwable $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
    public function delete($id)
    {
        Blog::findOrFail($id)->delete();

        return back()->with('success', 'Blog deleted');
    }
}
