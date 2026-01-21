<?php

namespace App\Http\Controllers\Frontend\ToDoThings;

use App\Http\Controllers\Controller;
use App\Models\ThingToDo;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;


 class ToDoThingsController extends Controller
{

   

    // public function index(Request $request)
    // {
    //     $lang = current_lang();


    //     $cities = City::whereHas('things', function ($q) {
    //         $q->whereNotNull('id'); // ensures at least one thing
    //     })
    //     ->with([
    //         'translationData'
    //     ])
    //     ->withCount('things')
    //     ->having('things_count', '>', 0)
    //     ->orderByDesc('things_count')
    //     ->get();

    //     /* 🏷 Categories (type = thing_to_do) */
    //     $categories = Category::where('type', 'thing_to_do')->
    //     whereHas('things', function ($q) 
    //     {
    //         $q->whereNotNull('id'); // ensures at least one thing
    //     })
    //     ->with([
    //         'translationData',
    //         'things' => fn ($q) => $q->select('id', 'category_id')
    //     ])
    //     ->withCount('things')
    //     ->having('things_count', '>', 0)
    //     ->orderBy('things_count', 'desc')
    //     ->get();

       
    //     $query = ThingToDo::with(['translation', 'thumb','city.translationData','category.translationData']);

    //     /* 🔎 SEARCH (CURRENT LANGUAGE ONLY) */
    //     if ($request->filled('search')) {
    //         $search = $request->search;

    //         $query->where(function ($q) use ($search, $lang) {
    //             $q->where('location', 'LIKE', "%{$search}%")
    //             ->orWhereHas('translation', function ($t) use ($search, $lang) {
    //                 $t->where('language_code', $lang)
    //                     ->where('name', 'LIKE', "%{$search}%");
    //             });
    //         });
    //     }

    //     /* 🏷 MULTIPLE CATEGORIES */
    //     if ($request->has('categories') && is_array($request->categories)) {
    //         $query->whereIn('category_id', $request->categories);
    //     }

    //     /* 🏙 MULTIPLE CITIES */
    //     if ($request->has('cities') && is_array($request->cities)) {
    //         $query->whereIn('city_id', $request->cities);
    //     }
    //  /* 🔄 SORTING */
    //     match ($request->sort) {
    //         'newest' => $query->latest(),
    //         default  => $query->orderBy('id', 'desc'),
    //     };

    //     $things = $query
    //         ->paginate(12)
    //         ->withQueryString();
        
    //     /* AJAX RESPONSE */
    //     if ($request->ajax()) {
    //         return view('frontend.thingstodo.partials.list', compact('things'))->render();
    //     }

    //     return view('frontend.thingstodo.index',compact('things','cities','categories'));
        
    // }

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

        match ($request->sort) {
            'newest' => $query->latest(),
            default  => $query->orderByDesc('id'),
        };

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
}
