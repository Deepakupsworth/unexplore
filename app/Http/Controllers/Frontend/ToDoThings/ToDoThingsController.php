<?php

namespace App\Http\Controllers\Frontend\ToDoThings;

use App\Http\Controllers\Controller;
use App\Models\ThingToDo;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;


 class ToDoThingsController extends Controller
{

    public function index(Request $request)
    {
        $lang = current_lang();

        $cities = City::has('things')
            ->with('translationData')
            ->withCount('things')
            ->orderByDesc('things_count')
            ->get();

        $categories = Category::where('type', 'thing_to_do')
            ->has('things')
            ->with('translationData')
            ->withCount('things')
            ->orderByDesc('things_count')
            ->get();

        $things = $this->applyFilters(
            ThingToDo::query(), 
            $request, 
            $lang
        )->paginate(12)->withQueryString();

        return view('frontend.thingstodo.index', compact(
            'things', 'cities', 'categories'
        ));
    }


    public function filter(Request $request)
    {
        $lang = current_lang();

        $things = $this->applyFilters(
            ThingToDo::query(), 
            $request, 
            $lang
        )->paginate(12)->withQueryString();

        return view(
            'frontend.thingstodo.partials.list', 
            compact('things')
        )->render();
    }


    private function applyFilters($query, Request $request, $lang)
    {
        $query->with([
            'translation',
            'thumb',
            'city.translationData',
            'category.translationData'
        ]);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $lang) {
                $q->where('location', 'LIKE', "%{$request->search}%")
                ->orWhereHas('translation', function ($t) use ($request, $lang) {
                    $t->where('language_code', $lang)
                        ->where('name', 'LIKE', "%{$request->search}%");
                });
            });
        }

        if ($request->filled('categories')) {
            $query->whereIn('category_id', $request->categories);
        }

        if ($request->filled('cities')) {
            $query->whereIn('city_id', $request->cities);
        }

      

        if ($request->filled('sort')) {

            match ($request->sort) {
                'popular'     => $query->orderBy('id', 'desc'),
                'newest'      => $query->orderBy('created_at', 'desc'),
                // 'price_low'   => $query->orderBy('price', 'asc'),
                // 'price_high'  => $query->orderBy('price', 'desc'),
                default       => $query->orderByDesc('id'),
            };
        }

        return $query;
    }


    public function search(){
      return view('frontend.thingstodo.things-to-do');
    }

    //show single to do things
    public function show(Request $request)
    {
        $slug = $request->slug;
        $thing = ThingToDo::with([
            'translation',
            'thumb',
            'city.translationData',
            'category.translationData'
        ])->where('slug', $slug)->firstOrFail();

        return view('frontend.thingstodo.show', compact('thing'));
    }


    public function categoriesWisePackageCounts()
    {
        $language = current_lang();

        $categories = Category::query()
            ->where('type', 'thing_to_do')
            ->where('status', 'active')
            ->with([
                'translation',
                'things.packageDayItems.packageDay.package'
            ])
            ->get()
            ->map(function ($category) {

                $category->package_count = $category->things
                    ->flatMap(function ($thing) {
                        return $thing->packageDayItems
                            ->filter(fn ($pdi) =>
                                optional($pdi->packageDay->package)->status === 'active'
                            )
                            ->pluck('packageDay.package.id');
                    })
                    ->unique()
                    ->count();

                return $category;
            })
            ->sortByDesc('package_count')
            ->values();

            return view('frontend.thingstodo.things-to-do');

    }
}
