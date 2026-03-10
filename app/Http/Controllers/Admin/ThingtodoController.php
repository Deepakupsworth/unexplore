<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CategoryType;
use App\Http\Controllers\Controller;
use App\Models\ThingToDo;
use App\Models\Language;
use App\Models\City;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Repositories\ThingToDo\ThingToDoRepositoryInterface;
use Illuminate\Database\QueryException;
use Throwable;


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

        $categories = Category::whereType(CategoryType::THING_TO_DO)
                ->pluck('slug', 'id');

        return view('backend.thingtodos.index', compact(
            'thingstodos',
            'cities',
            'categories',
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

        $tags = Tag::orderBy('name')->get();

        return view('backend.thingtodos.form', compact(
            'model',
            'languages',
            'cities',
            'categories',
            'tags'
        ));
    }

    public function save(Request $request)
    {
        $request->validate([
            'tags'   => 'nullable|array',
            'tags.*' => 'exists:tags,id',

            'translations.en.name' => 'required|string|max:255',
            'city_id'              => 'required|exists:cities,id',

            // ✅ MULTI CATEGORY
            'category_ids'         => 'required|array|min:1',
            'category_ids.*'       => 'exists:categories,id',

            'video_url'            => 'nullable|url|max:255',
        ]);

        try {

            $this->repo->createOrUpdate(
                $request->all(),
                $request->id
            );

            return redirect()
                ->route('thingtodos.index')
                ->with('success', 'Thing To Do saved successfully');
        } catch (QueryException $e) {

            // 🔥 Duplicate entry (MySQL 1062)
            if ($e->errorInfo[1] == 1062) {
                return back()
                    ->withInput()
                    ->with('error', 'Record with this name already exists.');
            }

            return back()
                ->withInput()
                ->with('error', 'Database error occurred.');
        } catch (Throwable $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage()); // 👈 dev mode friendly
        }
    }


    public function destroy($id)
    {
        $deleted = $this->repo->delete($id);

        if (!$deleted) {
            return back()->with('error', 'Unable to delete. This activity may be used in a package.');
        }

        return back()->with('success', 'Deleted successfully');
    }
}
