<?php

namespace App\Http\Controllers\Frontend\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * ================================
     * BLOG LISTING
     * ================================
     */
    public function index()
    {
        $blogs = Blog::with([
                'translation',
                'thumb'
            ])
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate(9);

        return view('frontend.blogs', compact('blogs'));
    }

    /**
     * ================================
     * BLOG DETAIL
     * ================================
     */
    public function detail($slug)
    {
        $language = current_lang() ?? 'en';

        $blog = Blog::with([
            'translation' => fn($q) => $q->where('language_code', $language),
            'user',
            'thumb'
        ])
        ->where('slug', $slug)
        ->where('is_published', 1)
        ->firstOrFail();

        // ✅ latest blogs
        $recentBlogs = Blog::with([
                'translation' => fn($q) => $q->where('language_code', $language)
            ])
            ->where('id', '!=', $blog->id)
            ->where('is_published', 1)
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('frontend.blogs.blog-details', compact('blog', 'recentBlogs'));
    }
}
