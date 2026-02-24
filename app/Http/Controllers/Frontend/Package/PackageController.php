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
            ->with([
                'translations',
                'cities.city.translations',
                'price',
                'days.items.transport',
                'days.items.hotel',
            ])->where('status','active')

            /* 🔍 SEARCH */
            ->when($request->search, function ($q) use ($request) {
                $q->where(function ($qq) use ($request) {
                    $qq->whereHas(
                        'translations',
                        fn($t) =>
                        $t->where('title', 'like', "%{$request->search}%")
                    )
                        ->orWhereHas(
                            'cities.city.translations',
                            fn($ct) =>
                            $ct->where('name', 'like', "%{$request->search}%")
                        );
                });
            })

            /* 💰 BUDGET RANGE FILTER (NEW) */
            ->when(
                $request->filled('min_price') || $request->filled('max_price'),
                function ($q) use ($request) {

                    $min = (int) ($request->min_price ?? 0);
                    $max = (int) ($request->max_price ?? PHP_INT_MAX);

                    $q->whereHas('price', function ($priceQuery) use ($min, $max) {
                        $priceQuery->whereBetween('per_person_price', [$min, $max]);
                    });
                }
            )



            /* ⭐ HOTEL RATING */
            ->when(
                $request->rating,
                fn($q) =>
                // $q->whereHas(
                //     'days.items.hotel',
                //     fn($h) =>
                //     $h->whereIn('star_rating', (array) $request->rating)
                // )
                $q->whereDoesntHave('days.items.hotel', fn ($h) =>
                    $h->whereNotIn('star_rating', (array) $request->rating)
                )
            )

            /* 🌍 CITY */
            ->when(
                $request->cities,
                fn($q) =>
                $q->whereHas(
                    'cities',
                    fn($c) =>
                    $c->whereIn('city_id', (array) $request->cities)
                )
            )

            ->when(
                $request->city,
                fn($q) =>
                $q->whereHas(
                    'cities',
                    fn($c) =>
                    $c->where('city_id',$request->city)
                )
            )

            /* 📦 PACKAGE TYPE */
            ->when(
                $request->package_type,
                fn($q) =>
                $q->whereIn('package_type', (array) $request->package_type)
            )

            /* 🎯 TODO / EVENT FILTERS */
            ->when(
                $request->todo_category,
                fn($q) =>
                $q->whereHas(
                    'days.items.todo',
                    fn($t) =>
                    $t->where('category_id', $request->todo_category)
                )
            )
            ->when(
                $request->todo_id,
                fn($q) =>
                $q->whereHas(
                    'days.items',
                    fn($i) =>
                    $i->where('item_type', 'todo')
                        ->where('item_id', $request->todo_id)
                )
            )
            ->when(
                $request->event_id,
                fn($q) =>
                $q->whereHas(
                    'days.items',
                    fn($i) =>
                    $i->where('item_type', 'event')
                        ->where('item_id', $request->event_id)
                )
            );

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
            ->with([
                'translations',
                'cities.city.translations',
                'price',
                'days.items.transport',
                'days.items.hotel',
            ])->where('status','active')

            /* 🔍 SEARCH */
            ->when($request->search, function ($q) use ($request) {
                $q->where(function ($qq) use ($request) {
                    $qq->whereHas(
                        'translations',
                        fn($t) =>
                        $t->where('title', 'like', "%{$request->search}%")
                    )
                        ->orWhereHas(
                            'cities.city.translations',
                            fn($ct) =>
                            $ct->where('name', 'like', "%{$request->search}%")
                        );
                });
            })

            /* 💰 BUDGET RANGE FILTER (NEW) */
            ->when(
                $request->filled('min_price') || $request->filled('max_price'),
                function ($q) use ($request) {

                    $min = (int) ($request->min_price ?? 0);
                    $max = (int) ($request->max_price ?? PHP_INT_MAX);

                    $q->whereHas('price', function ($priceQuery) use ($min, $max) {
                        $priceQuery->whereBetween('per_person_price', [$min, $max]);
                    });
                }
            )


            /* ⭐ HOTEL RATING */
            ->when(
                $request->rating,
                fn($q) =>
                // $q->whereHas(
                //     'days.items.hotel',
                //     fn($h) =>
                //     $h->whereIn('star_rating', (array) $request->rating)
                // )
                $q->whereDoesntHave('days.items.hotel', fn ($h) =>
                    $h->whereNotIn('star_rating', (array) $request->rating)
                )
            )

            /* 🌍 CITIES */
            ->when(
                $request->cities,
                fn($q) =>
                $q->whereHas(
                    'cities',
                    fn($c) =>
                    $c->whereIn('city_id', (array) $request->cities)
                )
            )

            /* 📦 PACKAGE TYPE */
            ->when(
                $request->package_type,
                fn($q) =>
                $q->whereIn('package_type', (array) $request->package_type)
            );

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


    public function show(string $slug)
    {
        // session()->flush();

        $language = current_lang();

        $package = Package::with([
            'thumb',
            'gallery',
            'translation',
            'cities',
            'days.items.hotel.translation' => fn($q) => $q->where('language_code', $language),
            'days.items.hotel.thumb',
            'days.items.hotel.gallery',

            'days.items.todo.translation' => fn($q) => $q->where('language_code', $language),
            'days.items.todo.thumb',
            'days.items.todo.gallery',

            'days.items.event.translation' => fn($q) => $q->where('language_code', $language),
            'days.items.event.thumb',
            'days.items.event.gallery',

            // ===== ✅ ADD THIS ONLY =====
            'days.options.hotel.translation' => fn($q) => $q->where('language_code', $language),
            'days.options.hotel.thumb',
            'days.options.hotel.gallery',

            'days.options.todo.translation' => fn($q) => $q->where('language_code', $language),
            'days.options.todo.thumb',
            'days.options.todo.gallery',


            'days.options.event.translation' => fn($q) => $q->where('language_code', $language),
            'days.options.event.thumb',
            'days.options.event.gallery',
            'availabilities',

            'days.options.transport.translation' => fn($q) => $q->where('language_code', $language),
            'days.options.transport.thumb',
        ])->where('slug', $slug)->firstOrFail();


        // 🔥 CITY → NIGHTS CALCULATION
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

        //print_r($package->toArray());die;

        // ===== ✅ DAY WISE OPTIONS (FINAL STRUCTURE) =====
        $dayWiseOptions = [];

        foreach ($package->days as $day) {
            $dayWiseOptions[$day->id] = $day->options
                ->groupBy('item_type')
                ->map(function ($items, $type) {

                    return $items
                        ->keyBy('item_id')
                        ->map(function ($option) use ($type) {

                            // remove unrelated relations
                            if ($type !== 'hotel') unset($option['hotel']);
                            if ($type !== 'todo')  unset($option['todo']);
                            if ($type !== 'event') unset($option['event']);
                            if ($type !== 'transport') unset($option['transport']);

                            return $option;
                        })
                        ->toArray();
                })
                ->toArray();
        }



        //use of this array for gallery images
        $finalArray =  $this->finalArray($package);
        // print_r($finalArray);die;


        //print_r($dayWiseOptions);die;
        $sessionItems = session("package_day_items.{$package->id}", []);
        //print_r($sessionItems);

        $hotelIds = [];
        $eventIds = [];
        $todoIds  = [];
        $transportIds = [];

        // foreach ($package->days as $day) {

        //     foreach ($day->items as $index => $item) {

        //         $type = $item->item_type;

        //         // 🔑 SESSION OVERRIDE → else DEFAULT
        //         $selectedItemId =
        //             $sessionItems[$day->id][$type][$index]
        //             ?? $item->item_id;

        //         if ($type === 'hotel') {
        //             $hotelIds[] = $selectedItemId;
        //         }

        //         if ($type === 'event') {
        //             $eventIds[] = $selectedItemId;
        //         }

        //         if ($type === 'todo') {
        //             $todoIds[] = $selectedItemId;
        //         }
        //         if ($type === 'transport') {
        //             $transportIds[] = $selectedItemId;
        //         }
        //     }
        // }
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



        // remove duplicates
        $hotelIds = array_unique($hotelIds);

        //print_r($hotelIds);die;
        $eventIds = array_unique($eventIds);
        $todoIds  = array_unique($todoIds);

        $transportIds  = array_unique($transportIds);


        // ✅ MASTER LIST (POPUP)
        $allHotels = Hotel::with(['translation', 'thumb'])
            ->whereIn('id', $hotelIds)
            ->get()
            ->keyBy('id');

        $allEvents = Event::with(['translation', 'thumb'])
            ->whereIn('id', $eventIds)
            ->get()
            ->keyBy('id');

        $allTodos = ThingToDo::with(['translation', 'thumb'])
            ->whereIn('id', $todoIds)
            ->get()
            ->keyBy('id');

        $allTransports = Transport::with(['translation', 'thumb'])
            ->whereIn('id', $transportIds)
            ->get()
            ->keyBy('id');


        $filter_data = [];
        $session_id_filter = "filter_package_" . $package->id;
        if (!empty(session($session_id_filter))) {
            $filter_data = session($session_id_filter);
        }

        //print_r($filter_data);die;



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
    public function packageDayOption($dayId, $type)
    {
        $language = current_lang();

        if (!in_array($type, ['hotel', 'todo', 'event', 'transport'])) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid item type'
            ], 422);
        }

        /*
    |--------------------------------------------------------------------------
    | 1️⃣ CURRENT ITEM (FROM package_day_items)
    |--------------------------------------------------------------------------
    */
        $currentItem = PackageDayItem::with([
            "$type.translation" => fn($q) => $q->where('language_code', $language),
            "$type.thumb",
        ])
            ->where('package_day_id', $dayId)
            ->where('item_type', $type)
            ->first(); // only ONE current item


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


        /*
    |--------------------------------------------------------------------------
    | 3️⃣ MERGE LOGIC
    |--------------------------------------------------------------------------
    | - current item FIRST
    | - mark is_selected = true
    | - remove duplicates from options
    */
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

        /*
    |--------------------------------------------------------------------------
    | 4️⃣ RESPONSE
    |--------------------------------------------------------------------------
    */
        return response()->json([
            'status' => true,
            'type'   => $type,
            'data'   => $merged->values()
        ]);
    }


    public function savePackageDayItemSession(Request $request)
    {
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
}
