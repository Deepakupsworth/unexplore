<?php

namespace App\Http\Controllers\Frontend\Package;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Event;
use App\Models\Hotel;
use App\Models\Package;
use App\Models\PackageDayItemOption;
use App\Models\ThingToDo;
use App\Models\PackageDayItem;
use App\Models\Transport;
use App\Services\Frontend\Package\PackageService;
use Illuminate\Http\Request;
use App\Support\PriceCalculator;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class PackageController extends Controller
{
    protected PackageService $service;

    public function __construct(PackageService $service)
    {
        $this->service = $service;
    }

    /**
     * =========================
     * NORMAL PAGE LOAD (SEO)
     * =========================
     */
    public function index(Request $request)
    {
        /* ================= LEFT FILTER DATA ================= */

        // 🌍 Cities
        $cities = City::whereHas('packages')
        ->orderBy('slug')
        ->get();

        // 👥 Persons
        $persons = max((int) $request->get('persons', 1), 1);

        /* ================= MAIN QUERY ================= */
        //print_r($request->rating);die;

        $packagesQuery = Package::query()
            ->with(['translations', 'cities.city.translations', 'price']);

        $packagesQuery = $this->applyPackageFilters($packagesQuery, $request);

        // $packagesQuery = Package::query()
        //     ->with([
        //         'translations',
        //         'cities.city.translations',
        //         'price',

        //     ])->where('status','active')

        //     /* 🔍 SEARCH */
        //     ->when($request->search, function ($q) use ($request) {
        //         $q->where(function ($qq) use ($request) {
        //             $qq->whereHas(
        //                 'translations',
        //                 fn($t) =>
        //                 $t->where('title', 'like', "%{$request->search}%")
        //             )
        //                 ->orWhereHas(
        //                     'cities.city.translations',
        //                     fn($ct) =>
        //                     $ct->where('name', 'like', "%{$request->search}%")
        //                 );
        //         });
        //     })

        //     /* 💰 BUDGET RANGE FILTER (NEW) */
        //     ->when(
        //         $request->filled('min_price') || $request->filled('max_price'),
        //         function ($q) use ($request) {

        //             $min = (int) ($request->min_price ?? 0);
        //             $max = (int) ($request->max_price ?? PHP_INT_MAX);

        //             $q->whereHas('price', function ($priceQuery) use ($min, $max) {
        //                 $priceQuery->whereBetween('per_person_price', [$min, $max]);
        //             });
        //         }
        //     )


        //     ->when($request->rating, function ($q) use ($request) {

        //         $ratings = (array) $request->rating;

        //         $q->whereHas('dayItems', function ($dayItem) use ($ratings) {

        //             $dayItem->whereHasMorph(
        //                 'item',
        //                 [Hotel::class], // 🔒 ONLY hotels
        //                 function ($hotel) use ($ratings) {
        //                     $hotel->whereIn('star_rating', $ratings);
        //                 }
        //             );

        //         });

        //     })

        //     /* 🌍 CITY */
        //     ->when(
        //         $request->cities,
        //         fn($q) =>
        //         $q->whereHas(
        //             'cities',
        //             fn($c) =>
        //             $c->whereIn('city_id', (array) $request->cities)
        //         )
        //     )

        //     ->when(
        //         $request->city,
        //         fn($q) =>
        //         $q->whereHas(
        //             'cities',
        //             fn($c) =>
        //             $c->where('city_id',$request->city)
        //         )
        //     )

        //     /* 📦 PACKAGE TYPE */
        //     ->when(
        //         $request->package_type,
        //         fn($q) =>
        //         $q->whereIn('package_type', (array) $request->package_type)
        //     )

        //     /* 🎯 TODO / EVENT FILTERS */
        //     ->when($request->todo_category, function ($q) use ($request) {
        //         $q->whereHas('days.items', function ($item) use ($request) {
        //             $item->whereHasMorph(
        //                 'item',
        //                 [ThingToDo::class],
        //                 function ($todo) use ($request) {
        //                     $todo->where('category_id', $request->todo_category);
        //                 }
        //             );
        //         });
        //     })

        //     /* =========================
        //      | TODO ID FILTER
        //      |=========================*/
        //     ->when($request->todo_id, function ($q) use ($request) {
        //         $q->whereHas('days.items', function ($item) use ($request) {
        //             $item->whereHasMorph(
        //                 'item',
        //                 [ThingToDo::class],
        //                 function ($todo) use ($request) {
        //                     $todo->where('id', $request->todo_id);
        //                 }
        //             );
        //         });
        //     })

        //     /* =========================
        //      | EVENT ID FILTER
        //      |=========================*/
        //     ->when($request->event_id, function ($q) use ($request) {
        //         $q->whereHas('days.items', function ($item) use ($request) {
        //             $item->whereHasMorph(
        //                 'item',
        //                 [Event::class],
        //                 function ($event) use ($request) {
        //                     $event->where('id', $request->event_id);
        //                 }
        //             );
        //         });
        //     });

        /* ================= SORT ================= */

        if ($request->sort === 'price_asc' || $request->sort === 'price_desc') {

            $direction = $request->sort === 'price_asc' ? 'asc' : 'desc';

            $packagesQuery
                ->join('package_prices', 'package_prices.package_id', '=', 'packages.id')
                ->orderBy('package_prices.original_price', $direction)
                ->select('packages.*');
        } elseif ($request->sort === 'newest') {

            $packagesQuery->orderBy('packages.created_at', 'desc');
        } else {

            $packagesQuery->latest('packages.created_at');
        }

        /* ================= PAGINATION ================= */


        $packages = $packagesQuery
            ->paginate(20)
            ->withQueryString();

            //print_r($packages->toArray());die;

        /* ================= PRICE CALCULATION ================= */

        $packages->getCollection()->transform(function ($pkg) use ($persons) {
            $price = PriceCalculator::calculate($pkg->price, $persons);
            $pkg->price_per_person = $price['per_person'];
            $pkg->total_price      = $price['total'];
            return $pkg;
        });

        /* ================= HEADER COUNTS (🔥 FIXED) ================= */

        $packageTypes = Package::query()
            ->select('package_type')
            ->selectRaw('COUNT(*) as total')->where('status','active')
            ->groupBy('package_type')
            ->pluck('total', 'package_type');

        /* ================= HEADER CATEGORIES ================= */

        $headerCategories = Category::whereHas('packageCategories')
            ->withCount('packageCategories')
            ->with('translation')
            ->get();

        /* ================= VIEW ================= */

        return view('frontend.packages.index', compact(
            'packages',
            'cities',
            'packageTypes',
            'persons',
            'headerCategories'
        ));
    }


    private function applyPackageFilters($query, Request $request)
    {
        return $query
            ->where('status', 'active')

            /* 🔍 SEARCH */
            ->when($request->search, function ($q) use ($request) {
                $q->where(function ($qq) use ($request) {
                    $qq->whereHas('translations', fn ($t) =>
                        $t->where('title', 'like', "%{$request->search}%")
                    )->orWhereHas('cities.city.translations', fn ($ct) =>
                        $ct->where('name', 'like', "%{$request->search}%")
                    );
                });
            })

            /* 💰 PRICE RANGE */
            ->when(
                $request->filled('min_price') || $request->filled('max_price'),
                function ($q) use ($request) {
                    $min = (int) ($request->min_price ?? 0);
                    $max = (int) ($request->max_price ?? PHP_INT_MAX);

                    $q->whereHas('price', fn ($p) =>
                        $p->whereBetween('per_person_price', [$min, $max])
                    );
                }
            )

            /* ⭐ HOTEL RATING */
            ->when($request->rating, function ($q) use ($request) {

                $ratings = (array) $request->rating;

                $q->whereHas('dayItems', function ($di) use ($ratings) {

                    $di->where('item_type', 'hotel')
                       ->whereIn('item_id', function ($sub) use ($ratings) {
                           $sub->select('id')
                               ->from('hotels')
                               ->whereIn('star_rating', $ratings);
                       });

                });
            })

            /* 🌍 CITIES */
            ->when($request->cities, fn ($q) =>
                $q->whereHas('cities', fn ($c) =>
                    $c->whereIn('city_id', (array) $request->cities)
                )
            )

            ->when($request->city, fn ($q) =>
                $q->whereHas('cities', fn ($c) =>
                    $c->where('city_id', $request->city)
                )
            )

            ->when($request->start_date, function ($q) use ($request) {
                $q->whereHas('availabilities', function ($c) use ($request) {
                    $c->where('available_from', '<=', $request->start_date)
                      ->where('available_to', '>=', $request->start_date);
                });
            })

            ->when($request->adult || $request->children, function ($q) use ($request) {

                $totalPersons = (int)$request->adult + (int)$request->children;

                $q->where('max_persons', '>=', $totalPersons);

            })

            /* 📦 PACKAGE TYPE */
            ->when($request->package_type, fn ($q) =>
                $q->whereIn('package_type', (array) $request->package_type)
            )

           // 🎯 TODO CATEGORY
            ->when($request->todo_category, function ($q) use ($request) {
                $q->whereHas('dayItems', function ($di) use ($request) {
                    $di->where('item_type', 'todo')
                    ->whereIn('item_id', function ($sub) use ($request) {
                        $sub->select('id')
                            ->from('thing_to_dos') // your table name
                            ->where('category_id', $request->todo_category);
                    });
                });
            })

            // 🎯 TODO ID
            ->when($request->todo_id, function ($q) use ($request) {
                $q->whereHas('dayItems', function ($di) use ($request) {
                    $di->where('item_type', 'todo')
                    ->where('item_id', $request->todo_id);
                });
            })

            // 🎯 EVENT ID
            ->when($request->event_id, function ($q) use ($request) {
                $q->whereHas('dayItems', function ($di) use ($request) {
                    $di->where('item_type', 'event')
                    ->where('item_id', $request->event_id);
                });
            });
    }

    /**
     * =========================
     * AJAX FILTER LOAD
     * =========================
     */
    public function ajax(Request $request)
    {
        // 👥 Persons
        $persons = max((int) $request->get('persons', 1), 1);

        /* ================= MAIN QUERY ================= */
        $packagesQuery = Package::query()
            ->with(['translations', 'cities.city.translations', 'price']);

         $packagesQuery = $this->applyPackageFilters($packagesQuery, $request);

        /* ================= SORT ================= */

        if ($request->sort === 'price_asc' || $request->sort === 'price_desc') {

            $direction = $request->sort === 'price_asc' ? 'asc' : 'desc';

            $packagesQuery
                ->join('package_prices', 'package_prices.package_id', '=', 'packages.id')
                ->orderBy('package_prices.original_price', $direction)
                ->select('packages.*');
        } elseif ($request->sort === 'newest') {

            $packagesQuery->orderBy('packages.created_at', 'desc');
        } else {

            $packagesQuery->latest('packages.created_at');
        }


        /* ================= PAGINATION ================= */
        $packages = $packagesQuery
            ->paginate(20)
            ->withQueryString();

        /* ================= PRICE CALC ================= */
        $packages->getCollection()->transform(function ($pkg) use ($persons) {
            $price = PriceCalculator::calculate($pkg->price, $persons);

            $pkg->price_per_person = $price['per_person'];
            $pkg->total_price      = $price['total'];

            return $pkg;
        });

        /* ================= HEADER COUNTS (🔥 IMPORTANT) ================= */
        $packageTypes = Package::query()
            ->select('package_type')
            ->selectRaw('COUNT(*) as total')
            ->where('status','active')
            ->groupBy('package_type')
            ->pluck('total', 'package_type');

        /* ================= RETURN FULL RESULTS ================= */
        return view('frontend.packages.partials.results', compact(
            'packages',
            'packageTypes'
        ));
    }



    /**
     * =========================
     * PACKAGE DETAILS PAGE
     * =========================
     */


     public function show(Request $request,string $slug)
     {
         $language = current_lang();
         //session()->flush();

         /* -------------------------------------------------
          | LOAD PACKAGE (NO POLYMORPHIC EAGER LOADING)
          |--------------------------------------------------*/
         $package = Package::with([
             'thumb',
             'gallery',
             'translation',
             'cities',
             'availabilities',
             'days.items',
             'days.options',
         ])
         ->where('slug', $slug)
         ->firstOrFail();

 
        $filtersessionKey = "filter_package_{$package->id}";
        $filter_package_session_data = session($filtersessionKey);
        
        $startDate = $request->start_date;
        $adults = (int) $request->adult;
        $children = (int) $request->children;
     
        // validate conditions
        if ($startDate && $adults > 0 && empty($filter_package_session_data)) {
    
            session([
                "filter_package_{$package->id}" => [
                    'adults' => $adults,
                    'children' => $children,
                    'date' => $startDate,
                ]
            ]);
        }


         /* -------------------------------------------------
          | CITY → NIGHTS
          |--------------------------------------------------*/
         $places = collect($package->days)
             ->groupBy('city_id')
             ->map(function ($days) {
                 $city = $days->first()->city;

                 return [
                     'city'   => $city?->translation?->name ?? 'Unknown',
                     'nights' => max(1, $days->count() - 1),
                 ];
             })
             ->values();

         /* -------------------------------------------------
          | DAY WISE OPTIONS
          |--------------------------------------------------*/
         $dayWiseOptions = [];

         foreach ($package->days as $day) {
             $dayWiseOptions[$day->id] = $day->options
                 ->groupBy('item_type')
                 ->map(fn ($items) => $items->keyBy('item_id')->toArray())
                 ->toArray();
         }

         

        // print_r($dayWiseOptions);die;
         /* -------------------------------------------------
          | SESSION OVERRIDE + COLLECT IDS
          |--------------------------------------------------*/
        $sessionItems = session("package_day_items.{$package->id}", []);
         //print_r($sessionItems);



         $hotelIds = [];
         $eventIds = [];
         $todoIds  = [];
         $transportIds = [];

         foreach ($package->days as $day) {

            // Group items by type FIRST
            $itemsByType = $day->items->groupBy('item_type');

            foreach ($itemsByType as $type => $items) {

                // Reset index per type (0,1,2…)
                $items = $items->values();

                foreach ($items as $index => $item) {

                    $selectedItemId =
                        $sessionItems[$day->id][$type][$index]
                        ?? $item->item_id;

                    match ($type) {
                        'hotel'     => $hotelIds[]     = $selectedItemId,
                        'event'     => $eventIds[]     = $selectedItemId,
                        'todo'      => $todoIds[]      = $selectedItemId,
                        'transport' => $transportIds[] = $selectedItemId,
                        default     => null,
                    };
                }
            }
        }
         $hotelIds     = array_unique($hotelIds);
         $eventIds     = array_unique($eventIds);
         $todoIds      = array_unique($todoIds);
         $transportIds = array_unique($transportIds);




         /* -------------------------------------------------
          | LOAD REAL MODELS (BATCH)
          |--------------------------------------------------*/
         $allHotels = Hotel::with([
             'translation' => fn ($t) => $t->where('language_code', $language),
             'thumb',
             'gallery',
         ])->whereIn('id', $hotelIds)->get()->keyBy('id');

         $allEvents = Event::with([
             'translation' => fn ($t) => $t->where('language_code', $language),
             'thumb',
             'gallery',
         ])->whereIn('id', $eventIds)->get()->keyBy('id');

         $allTodos = ThingToDo::with([
             'translation' => fn ($t) => $t->where('language_code', $language),
             'thumb',
             'gallery',
         ])->whereIn('id', $todoIds)->get()->keyBy('id');

         $allTransports = Transport::with([
             'translation' => fn ($t) => $t->where('language_code', $language),
             'thumb',
         ])->whereIn('id', $transportIds)->get()->keyBy('id');

         //print_r($allEvents->toArray());die;

         /* -------------------------------------------------
          | ATTACH RESOLVED ITEM TO EACH DAY ITEM
          |--------------------------------------------------*/
        //  foreach ($package->days as $day) {
        //      foreach ($day->items as $item) {
        //          $item->resolved_item = match ($item->item_type) {
        //              'hotel'     => $allHotels[$item->item_id]     ?? null,
        //              'event'     => $allEvents[$item->item_id]     ?? null,
        //              'todo'      => $allTodos[$item->item_id]      ?? null,
        //              'transport' => $allTransports[$item->item_id] ?? null,
        //              default     => null,
        //          };
        //      }
        //  }

         /* -------------------------------------------------
          | FILTER SESSION
          |--------------------------------------------------*/
         $filter_data = session("filter_package_{$package->id}", []);

         /* -------------------------------------------------
          | FINAL ARRAY (GALLERY / SUMMARY)
          |--------------------------------------------------*/
         $finalArray = $this->finalArray($package);

         return view('frontend.packages.show', compact(
             'package',
             'allHotels',
             'allTodos',
             'allEvents',
             'allTransports',
             'dayWiseOptions',
             'sessionItems',
             'filter_data',
             'finalArray',
             'places'
         ));
     }

    public function finalArray($package)
    {
        $finalArray = [
            'package' => [
                'name'    => $package->title,
                'thumb'   => $package->thumb ?? null,
                'gallery' => $package->gallery ?? [],
            ],
            'hotel'     => [],
            'todo'      => [],
            'event'     => [],
            'transport' => [],
        ];

        $added = [
            'hotel'     => [],
            'todo'      => [],
            'event'     => [],
            'transport' => [],
        ];

        foreach ($package->days as $day) {
            foreach ($day->items as $item) {

                $type = $item->item_type; // hotel | todo | event | transport
                $data = $item->{$type} ?? null;

                if (!$data || isset($added[$type][$data->id])) {
                    continue; // avoid duplicates across days
                }

                $finalArray[$type][] = [
                    'name'       => $data->translation->name ?? $data->translation->title,
                    'video_url'  => $data->video_url ?? null, // mostly for event
                    'thumb'      => $data->thumb ?? null,
                    'gallery'    => $data->gallery ?? [],
                ];

                $added[$type][$data->id] = true;
            }
        }

        return $finalArray;
    }




    //  public function packageDayOption($id,$type)
    //  {
    //     //print_r($id);die;
    //     $language = current_lang();

    //         $packageOptions = PackageDayItemOption::with([
    //             'hotel.translation' => fn($q) => $q->where('language_code', $language),
    //             'hotel.thumb',

    //             'todo.translation' => fn($q) => $q->where('language_code', $language),
    //             'todo.thumb',

    //             'event.translation' => fn($q) => $q->where('language_code', $language),
    //             'event.thumb',
    //         ])->where(['package_day_id'=>$id,'item_type'=>$type])->get();

    //         //print_r($packageOptions);die;
    //         return response()->json([
    //             'status' => true,
    //             'data'   => $packageOptions
    //         ]);

    //  }
    //     public function packageDayOption($dayId, $type)
    // {
    //     $language = current_lang();

    //     if (!in_array($type, ['hotel', 'todo', 'event'])) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Invalid item type'
    //         ], 422);
    //     }

    //     $relations = [
    //         "$type.translation" => fn ($q) => $q->where('language_code', $language),
    //         "$type.thumb",
    //     ];

    //     $items = PackageDayItemOption::with($relations)
    //         ->where('package_day_id', $dayId)
    //         ->where('item_type', $type)
    //         ->orderBy('sort_order')
    //         ->get();

    //     return response()->json([
    //         'status' => true,
    //         'type'   => $type,
    //         'data'   => $items
    //     ]);
    // }


    /***
    public function packageDayOption($dayId, $type)
    {
        $language = current_lang();

        if (!in_array($type, ['hotel', 'todo', 'event', 'transport'])) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid item type'
            ], 422);
        }


            $currentDayItem = PackageDayItem::where('package_day_id', $dayId)
            ->where('item_type', $type)
            ->first();

            $map = [
                'hotel'     => Hotel::class,
                'event'     => Event::class,
                'todo'      => ThingToDo::class,
                'transport' => Transport::class,

            ];

            $currentItem = $map[$currentDayItem->item_type]::with([
                    'translation' => fn ($q) => $q->where('language_code', $language),
                    'thumb',
                ])
                ->find($currentDayItem->item_id);
            // $currentItem = PackageDayItem::with([
            //     "$type.translation" => fn($q) => $q->where('language_code', $language),
            //     "$type.thumb",
            // ])
            //     ->where('package_day_id', $dayId)
            //     ->where('item_type', $type)
            //     ->first(); // only ONE current item



            $optionItems = PackageDayItemOption::with([
                "$type.translation" => fn($q) => $q->where('language_code', $language),
                "$type.thumb",
            ])
                ->where('package_day_id', $dayId)
                ->where('item_type', $type)
                ->orderBy('sort_order')
                ->get();

                //print_r($optionItems->toArray());die;


            $merged = collect();

            if ($currentItem) {
                $currentItem->is_selected = true;
                $merged->push($currentItem);
            }

            foreach ($optionItems as $option) {

                // Skip duplicate of current item
                if (
                    $currentItem &&
                    $option->item_id === $currentItem->item_id
                ) {
                    continue;
                }

                $option->is_selected = false;
                $merged->push($option);
            }


        return response()->json([
            'status' => true,
            'type'   => $type,
            'data'   => $merged->values()
        ]);
    }
    **/

    public function packageDayOption($dayId, $type, $index)
    {
        $language = current_lang();

        if (!in_array($type, ['hotel', 'todo', 'event', 'transport'])) {
            return response()->json([
                'status'  => false,
                'message' => __('package.invalid_item_type')
            ], 422);
        }

        /*
    |--------------------------------------------------------------------------
    | 1️⃣ CURRENT ITEM (FROM package_day_items)
    |--------------------------------------------------------------------------
    */



    $currentDayItem = PackageDayItem::where('package_day_id', $dayId)
    ->where('item_type', $type)
    ->first();

    try {
        $index_wise_data = $this->getOtherSelectedPackageDayItemIdsWithSource($currentDayItem->package_id,$dayId,$type,$index);

    } catch (\Throwable $e)
    {
        $index_wise_data = [];
    }

    $currentOption = null;

    if ($currentDayItem) {
        $currentOption = new PackageDayItemOption();
        $currentOption->package_day_id = $currentDayItem->package_day_id;
        $currentOption->item_type      = $currentDayItem->item_type;
        $currentOption->item_id        = $currentDayItem->item_id;
        $currentOption->sort_order     = -1; // force first
        $currentOption->is_selected    = true;

        // 🔑 load polymorphic item relation manually
        $map = [
            'hotel'     => Hotel::class,
            'event'     => Event::class,
            'todo'      => ThingToDo::class,
            'transport' => Transport::class,
        ];

        $model = $map[$type];

        $currentOption->setRelation(
            $type,
            $model::with([
                'translation' => fn ($q) => $q->where('language_code', $language),
                'thumb',
            ])->find($currentDayItem->item_id)
        );
    }
        // $currentItem = PackageDayItem::with([
        //     "$type.translation" => fn($q) => $q->where('language_code', $language),
        //     "$type.thumb",
        // ])
        //     ->where('package_day_id', $dayId)
        //     ->where('item_type', $type)
        //     ->first(); // only ONE current item


        /*
    |--------------------------------------------------------------------------
    | 2️⃣ OPTION ITEMS (FROM package_day_item_options)
    |--------------------------------------------------------------------------
    */
        $optionItems = PackageDayItemOption::with([
            "$type.translation" => fn($q) => $q->where('language_code', $language),
            "$type.thumb",
        ])
            ->where('package_day_id', $dayId)
            ->where('item_type', $type)
            ->orderBy('sort_order')
            ->get();

            //print_r($optionItems->toArray());die;


        /*
    |--------------------------------------------------------------------------
    | 3️⃣ MERGE LOGIC
    |--------------------------------------------------------------------------
    | - current item FIRST
    | - mark is_selected = true
    | - remove duplicates from options
    */
    $merged = collect();

    if ($currentOption) {
        $merged->push($currentOption);
    }

    foreach ($optionItems as $option) {

        if ($currentOption && $option->item_id === $currentOption->item_id) {
            continue;
        }

        $option->is_selected = false;
        $merged->push($option);
    }

    //print_r($merged->values()->toArray());die;
    if(!empty(@$index_wise_data['data']))
    {
        $result_data = $index_wise_data['data'];
        //print_r($result_data);

        $filtered = $merged->reject(function ($item) use ($result_data) {
            return in_array($item['item_id'], $result_data);
        })->values();

        // print_r($filtered->toArray());
        // die;

        return response()->json([
            'status' => true,
            'type'   => $type,
            'data'   => $filtered,
            'newData' => $index_wise_data
        ]);
    }

        /*
    |--------------------------------------------------------------------------
    | 4️⃣ RESPONSE
    |--------------------------------------------------------------------------
    */
        return response()->json([
            'status' => true,
            'type'   => $type,
            'data'   => $merged->values(),
            'newData' => $index_wise_data
        ]);
    }


    public function savePackageDayItemSession(Request $request)
    {
        //print_r('dd');die;
        $data = session("package_day_items.{$request->package_id}", []);

        $data[$request->day_id][$request->type][$request->index]
            = $request->item_id;

        session(["package_day_items.{$request->package_id}" => $data]);

        return response()->json(['success' => true]);
    }


    public function saveToSession(Request $request)
    {
        $request->validate([
            'day_id'    => 'required|integer',
            'item_type' => 'required|in:hotel,todo,event',
            'items'     => 'array'
        ]);

        $packageId = $request->package_id; // ✅ REQUIRED
        $dayId     = $request->day_id;
        $type      = $request->item_type;
        $itemIds   = $request->items ?? [];

        // ✅ SAVE SESSION WITH PACKAGE ID
        $sessionKey = "package_day_items.$packageId.$dayId.$type";
        session([$sessionKey => $itemIds]);

        return response()->json([
            'status' => true
        ]);
    }


    function getSelectedPackageDayItemIds(int $packageId,int $dayId,string $type,int $index) {

        // Session (highest priority)
        $sessionItems = session("package_day_items.$packageId", []);

        $sessionItemId = null;

        if (
            isset($sessionItems[$dayId]) &&
            isset($sessionItems[$dayId][$type]) &&
            array_key_exists($index, $sessionItems[$dayId][$type])
        ) {
            $sessionItemId = $sessionItems[$dayId][$type][$index];
        }

        // DB fallback (same order as UI)
        $dayItems = PackageDayItem::where('package_day_id', $dayId)
            ->where('item_type', $type)
            ->orderBy('id') // must match foreach order
            ->get()
            ->values();

        $dbItemId = $dayItems[$index]->item_id ?? null;

        return [
            'session_item_id' => $sessionItemId,
            'db_item_id'      => $dbItemId,
            'final_item_id'   => $sessionItemId ?? $dbItemId, // optional helper
        ];
    }

    function getOtherSelectedPackageDayItemIds(int $packageId,int $dayId,string $type,int $currentIndex): array {

        $sessionItems = session("package_day_items.$packageId", []);

        // 1️⃣ Get DB items (same order as UI)
        $dayItems = PackageDayItem::where('package_day_id', $dayId)
            ->where('item_type', $type)
            ->orderBy('id') // must match foreach order
            ->get()
            ->values();

        $result = [];

        foreach ($dayItems as $index => $dayItem) {

            // Skip current index
            if ($index === $currentIndex) {
                continue;
            }

            // Session override if exists
            if (
                isset($sessionItems[$dayId]) &&
                isset($sessionItems[$dayId][$type]) &&
                array_key_exists($index, $sessionItems[$dayId][$type])
            ) {
                $result[] = $sessionItems[$dayId][$type][$index];
            } else {
                // DB fallback
                if ($dayItem->item_id) {
                    $result[] = $dayItem->item_id;
                }
            }
        }

        // Remove nulls + duplicates
        return array_values(array_unique(array_filter($result)));
    }

    public function storeSession(Request $request)
    {
        $packageId = (int)$request->filter_package_unique_id;

        session([
            "filter_package_{$packageId}" => [
                'adults'   => (int) $request->adults,
                'children' => (int) $request->children,
                'date'     => $request->date,
            ]
        ]);

        return response()->json([
            'success' => true
        ]);
    }


    public function gallery($slug)
    {
        $package = Package::where('slug', $slug)->firstOrFail();

        //use of this array for gallery images
        $finalArray =  $this->finalArray($package);

        return view('frontend.package.partials.gallery-modal-content', compact(
            'package',
            'finalArray'
        ));
    }

    function getOtherSelectedPackageDayItemIdsWithSource(
        int $packageId,
        int $dayId,
        string $type,
        int $currentIndex
    ): array {

        $sessionItems = session("package_day_items.$packageId", []);

        // DB items in SAME order as UI
        $dayItems = PackageDayItem::where('package_day_id', $dayId)
            ->where('item_type', $type)
            ->orderBy('id') // must match foreach order
            ->get()
            ->values();

        $result = [];
        $result2 = [];

        foreach ($dayItems as $index => $dayItem) {

            // Skip current index
            if ($index === $currentIndex) {
                continue;
            }

            // Session value if exists
            $sessionItemId = null;
            if (
                isset($sessionItems[$dayId]) &&
                isset($sessionItems[$dayId][$type]) &&
                array_key_exists($index, $sessionItems[$dayId][$type])
            ) {
                $sessionItemId = $sessionItems[$dayId][$type][$index];
            }

            $dbItemId = $dayItem->item_id ?? null;

            $result[] = [
                'index'            => $index,
                'session_item_id'  => $sessionItemId,
                'db_item_id'       => $dbItemId,
                'final_item_id'    => $sessionItemId ?? $dbItemId,
            ];


            if(!empty($sessionItemId))
            {
                $result2[] = (int)$sessionItemId;
            }

            if(!empty($dbItemId))
            {
                $result2[] = $dbItemId;
            }
        }
        $result['data'] = $result2;

        return $result;
    }


}
