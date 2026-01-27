<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CategoryType;
use App\Http\Controllers\Controller;
use App\Models\ThingToDo;
use App\Models\Language;
use App\Models\City;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\ThingToDo\ThingToDoRepositoryInterface;


class ThingtodoController extends Controller
{
    private ThingToDoRepositoryInterface $repo;

    public function __construct(ThingToDoRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $thingstodos = $this->repo->paginate(10);

        // These are ONLY for filters
        $cities = \App\Models\City::pluck('slug', 'id');
        $categories = \App\Models\Category::pluck('slug', 'id');

        return view('backend.thingtodos.index', compact(
            'thingstodos',
            'cities',
            'categories'
        ));
    }


    public function create()
    {
        return $this->form();
    }

    public function show($id)
    {
        $thing = $this->repo->find($id);

        return view('backend.thingtodos.show', compact('thing'));
    }


    public function edit($id)
    {
        return $this->form($id);
    }

    public function form($id = null)
    {
        $model = $id
            ? $this->repo->find($id)
            : new ThingToDo();

        $languages = Language::all();

        $cities = City::with('translation')
            ->get()
            ->pluck('translation.name', 'id');

        $categories = Category::where('type', CategoryType::THING_TO_DO)
            ->with('translation')
            ->get();

        return view('backend.thingtodos.form', compact(
            'model',
            'languages',
            'cities',
            'categories'
        ));
    }

    public function save(Request $request)
    {
        $request->validate([
            'translations.en.name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'category_id' => 'nullable|exists:categories,id',
            // 'thumb_image' => 'nullable|image|max:2048',
        ]);

        $this->repo->createOrUpdate($request->all(), $request->id);

        return redirect()
            ->route('thingtodos.index')
            ->with('success', 'Thing To Do saved successfully');
    }

    public function destroy($id)
    {
        $this->repo->delete($id);
        return back()->with('success', 'Deleted successfully');
    }
}
