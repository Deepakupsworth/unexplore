<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $tags = Tag::when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('backend.tags.index', compact('tags'));
    }

    // 🔥 SAME FORM FOR CREATE + EDIT (Event jaisa)
    public function form($id = null)
    {
        $tag = Tag::find($id) ?? new Tag();

        return view('backend.tags.form', [
            'model' => $tag
        ]);
    }

    // 🔥 SINGLE SAVE METHOD
    public function save(Request $request)
    {
        $data = $request->validate([
            'id'   => 'nullable|exists:tags,id',
            'name' => 'required|string|max:100',
        ]);

        Tag::updateOrCreate(
            ['id' => $data['id'] ?? null],
            [
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
            ]
        );

        return redirect()
            ->route('admin.tags.index')
            ->with('success', 'Tag saved successfully');
    }

    public function destroy($id)
    {
        Tag::findOrFail($id)->delete();

        return back()->with('success', 'Tag deleted');
    }
}
