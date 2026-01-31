<?php

namespace App\Http\Controllers\Frontend\Package;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Event;
use App\Models\Hotel;
use App\Models\Package;
use App\Models\PackageDayItemOption;
use App\Models\ThingToDo;
use App\Models\PackageDayItem;
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
        // 🌍 Cities (filter sidebar)
        $cities = City::orderBy('slug')->get();

        // 📦 Package type counts
        $packageTypes = Package::select('package_type')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('package_type')
            ->pluck('total', 'package_type');

        // 👥 Persons (default = 1)
        $persons = max((int) $request->get('persons', 1), 1);

        // 📦 Main Query
        $packages = Package::query()
            ->with([
                'translations',
                'cities.city.translations',
                'price',
                'days.items.transport',
                'days.items.hotel',
            ])

            // 🔍 SEARCH (Package title + City name)
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

            // ✈️ FLIGHT FILTER
            ->when(
                $request->flight === 'with',
                fn($q) =>
                $q->whereHas(
                    'days.items.transport',
                    fn($t) => $t->where('type', 'flight')
                )
            )
            ->when(
                $request->flight === 'without',
                fn($q) =>
                $q->whereDoesntHave(
                    'days.items.transport',
                    fn($t) => $t->where('type', 'flight')
                )
            )

            // 💰 PRICE FILTER (PER PERSON ONLY)
            ->when(
                $request->price_min || $request->price_max,
                function ($q) use ($request) {
                    $min = $request->price_min ?? 0;
                    $max = $request->price_max ?? 99999999;

                    $q->whereHas(
                        'price',
                        fn($p) =>
                        $p->whereBetween('per_person_price', [$min, $max])
                    );
                }
            )

            // ⭐ HOTEL RATING
            ->when(
                $request->rating,
                fn($q) =>
                $q->whereHas(
                    'days.items.hotel',
                    fn($h) => $h->whereIn('star_rating', $request->rating)
                )
            )

            // 🌍 CITY FILTER
            ->when(
                $request->cities,
                fn($q) =>
                $q->whereHas(
                    'cities',
                    fn($c) => $c->whereIn('city_id', $request->cities)
                )
            )

            // 📦 PACKAGE TYPE
            ->when(
                $request->package_type,
                fn($q) =>
                $q->whereIn('package_type', $request->package_type)
            )
            // ?todo_category=ID
            // /packages?todo_id=12
            // /packages?event_id=8
            // <a href="{{ route('packages.index', ['event_id' => $event->id]) }}">
            // <a href="{{ route('packages.index', ['todo_id' => $todo->id]) }}">
            // <a href="{{ route('packages.index', ['todo_category' => $category->id]) }}">


            //this is filter to do category
            ->when($request->todo_category, function ($q) use ($request) {
                $q->whereHas('days.items', function ($item) use ($request) {
                    $item->where('item_type', 'todo')
                        ->whereHas('todo', function ($todo) use ($request) {
                            $todo->where('category_id', $request->todo_category);
                        });
                });
            })
            ->when($request->todo_id, function ($q) use ($request) {
                $q->whereHas('days.items', function ($item) use ($request) {
                    $item->where('item_type', 'todo')
                        ->where('item_id', $request->todo_id);
                });
            })
            ->when($request->event_id, function ($q) use ($request) {
                $q->whereHas('days.items', function ($item) use ($request) {
                    $item->where('item_type', 'event')
                        ->where('item_id', $request->event_id);
                });
            })

            ->latest()
            ->paginate(20)
            ->withQueryString();

        // 🔥 Price calculation for cards
        $packages->getCollection()->transform(function ($pkg) use ($persons) {
            $price = PriceCalculator::calculate($pkg->price, $persons);

            $pkg->price_per_person = $price['per_person'];
            $pkg->total_price = $price['total'];

            return $pkg;
        });

        return view(
            'frontend.packages.index',
            compact('packages', 'cities', 'packageTypes', 'persons')
        );
    }

    /**
     * =========================
     * AJAX FILTER LOAD
     * =========================
     */
    public function ajax(Request $request)
    {
        $persons = max((int) $request->get('persons', 1), 1);

        $packages = Package::query()
            ->with([
                'translations',
                'cities.city.translations',
                'price',
                'days.items.transport',
                'days.items.hotel',
            ])

            // 🔍 SEARCH
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

            // ✈️ FLIGHT
            ->when(
                $request->flight === 'with',
                fn($q) =>
                $q->whereHas(
                    'days.items.transport',
                    fn($t) => $t->where('type', 'flight')
                )
            )

            // 💰 PRICE FILTER (PER PERSON)
            ->when(
                $request->price_min || $request->price_max,
                function ($q) use ($request) {
                    $min = $request->price_min ?? 0;
                    $max = $request->price_max ?? 99999999;

                    $q->whereHas(
                        'price',
                        fn($p) =>
                        $p->whereBetween('per_person_price', [$min, $max])
                    );
                }
            )

            // ⭐ HOTEL
            ->when(
                $request->rating,
                fn($q) =>
                $q->whereHas(
                    'days.items.hotel',
                    fn($h) => $h->whereIn('star_rating', $request->rating)
                )
            )

            // 🌍 CITY
            ->when(
                $request->cities,
                fn($q) =>
                $q->whereHas(
                    'cities',
                    fn($c) => $c->whereIn('city_id', $request->cities)
                )
            )

            // 📦 TYPE
            ->when(
                $request->package_type,
                fn($q) =>
                $q->whereIn('package_type', $request->package_type)
            )

            ->latest()
            ->paginate(20);

        // 🔥 Price calculation
        $packages->getCollection()->transform(function ($pkg) use ($persons) {
            $price = PriceCalculator::calculate($pkg->price, $persons);

            $pkg->price_per_person = $price['per_person'];
            $pkg->total_price = $price['total'];

            return $pkg;
        });

        return view('frontend.packages.partials.list', compact('packages'));
    }

    /**
     * =========================
     * PACKAGE DETAILS PAGE
     * =========================
     */


    public function show(string $slug)
    {
        //session()->flush();

        $language = current_lang();

        $package = Package::with([
            'days.items.hotel.translation' => fn($q) => $q->where('language_code', $language),
            'days.items.hotel.thumb',

            'days.items.todo.translation' => fn($q) => $q->where('language_code', $language),
            'days.items.todo.thumb',

            'days.items.event.translation' => fn($q) => $q->where('language_code', $language),
            'days.items.event.thumb',

            // ===== ✅ ADD THIS ONLY =====
            'days.options.hotel.translation' => fn($q) => $q->where('language_code', $language),
            'days.options.hotel.thumb',

            'days.options.todo.translation' => fn($q) => $q->where('language_code', $language),
            'days.options.todo.thumb',

            'days.options.event.translation' => fn($q) => $q->where('language_code', $language),
            'days.options.event.thumb',
            'availabilities'
        ])->where('slug', $slug)->firstOrFail();


        // ===== ✅ DAY WISE OPTIONS (FINAL STRUCTURE) =====
        $dayWiseOptions = [];

        foreach ($package->days as $day) {
            $dayWiseOptions[$day->id] = $day->options
                ->groupBy('item_type')
                ->map(function ($items, $type) {

                    return $items
                        ->keyBy('id')
                        ->map(function ($option) use ($type) {

                            // remove unrelated relations
                            if ($type !== 'hotel') unset($option['hotel']);
                            if ($type !== 'todo')  unset($option['todo']);
                            if ($type !== 'event') unset($option['event']);

                            return $option;
                        })
                        ->toArray();

                })
                ->toArray();
        }

        $sessionItems = session("package_day_items.{$package->id}", []);
        //print_r($sessionItems);

        $hotelIds = [];
        $eventIds = [];
        $todoIds  = [];

        foreach ($package->days as $day) {

            foreach ($day->items as $index => $item) {

                $type = $item->item_type;

                // 🔑 SESSION OVERRIDE → else DEFAULT
                $selectedItemId =
                    $sessionItems[$day->id][$type][$index]
                    ?? $item->item_id;

                if ($type === 'hotel') {
                    $hotelIds[] = $selectedItemId;
                }

                if ($type === 'event') {
                    $eventIds[] = $selectedItemId;
                }

                if ($type === 'todo') {
                    $todoIds[] = $selectedItemId;
                }
            }
        }



        // remove duplicates
        $hotelIds = array_unique($hotelIds);

        //print_r($hotelIds);die;
        $eventIds = array_unique($eventIds);
        $todoIds  = array_unique($todoIds);


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

        return view('frontend.packages.show', compact(
            'package',
            'allHotels',
            'allTodos',
            'allEvents',
            'dayWiseOptions',
            'sessionItems'
        ));
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

        if (!in_array($type, ['hotel', 'todo', 'event'])) {
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
}
