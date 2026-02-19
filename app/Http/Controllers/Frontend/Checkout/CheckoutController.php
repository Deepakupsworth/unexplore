<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Event;
use App\Models\Hotel;
use App\Models\Package;
use App\Models\ThingToDo;
use App\Models\Transport;
use App\Models\Traveller;
use App\Services\PackagePriceService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('frontend.checkout');
    }


    public function init(Request $request, PackagePriceService $priceService)
    {
        $package = Package::where('slug', $request->slug)->firstOrFail();

        $start_date = $request->start_date;
        $adults     = (int) $request->adults;
        $children   = (int) $request->children;
        $dayItemsExtra = (float) $request->input('day_items_extra', 0);

        /* ================= DAY ITEMS FROM FORM ================= */

        $dayItems       = $request->input('day_items', []);
        $dayItemPrices  = $request->input('day_item_prices', []);

        /* ================= SERVER PRICING ================= */

        $pricing = $priceService->calculate(
            $package,
            $adults,
            $children,
            $dayItemsExtra
        );

        /* ================= BUILD CHECKOUT SESSION ================= */

        $checkout = session('checkout', []);

        $checkout['package_id'] = $package->id;
        $checkout['start_date'] = $start_date;
        $checkout['adults']     = $adults;
        $checkout['children']   = $children;
        $checkout['pricing']    = $pricing;

        // ⭐⭐⭐ CRITICAL ⭐⭐⭐
        $checkout['day_items']       = $dayItems;
        $checkout['day_item_prices'] = $dayItemPrices;

        // optional currency safety
        $checkout['base_currency']    = $checkout['base_currency'] ?? 'SAR';
        $checkout['booking_currency'] = $checkout['booking_currency'] ?? 'SAR';
        $checkout['exchange_rate']    = $checkout['exchange_rate'] ?? 1;

        session()->put('checkout', $checkout);

        return redirect()->route('checkout.view');
    }


    public function show(Request $request)
    {
        /* ---------------------------------------------------
        | Checkout Session Guard
        --------------------------------------------------- */
        $checkout = session('checkout');



        $sessionItems = session("package_day_items.{$checkout['package_id']}", []);
        // dd($sessionItems);

        $user = auth()->user();
        $language = current_lang();

        /* ---------------------------------------------------
        | SAFE PERSON COUNTS (🔥 SINGLE SOURCE OF TRUTH)
        --------------------------------------------------- */
        $adultCount = (int) ($checkout['adults'] ?? 0);
        $childCount = (int) ($checkout['children'] ?? 0);
        $totalTravellers = $adultCount + $childCount;


        if ($adultCount <= 0) {
            abort(400, 'Invalid travellers');
        }

        // $sessionTravellers = session('checkout_travellers', []);

        /* ---------------------------------------------------
        | BUILD TRAVELLER SLOTS (UI PURPOSE)
        --------------------------------------------------- */
        // $travellerSlots = [];

        // for ($i = 0; $i < $totalTravellers; $i++) {
        //     $type = $i < $adultCount ? 'adult' : 'child';

        //     $travellerSlots[] = [
        //         'type' => $type,
        //         'data' => $sessionTravellers[$i] ?? null
        //     ];
        // }
        // session()->forget('checkout_travellers');


        /* ---------------------------------------------------
            |           STEP 1 — LOAD SESSION
            --------------------------------------------------- */
        $sessionTravellers = session('checkout_travellers', []);

        /* ---------------------------------------------------
            | STEP 2 — HYDRATE FROM DB (ONLY IF SESSION EMPTY)
        --------------------------------------------------- */
        if (empty($sessionTravellers) && $user) {

            $dbTravellers = $user->travellers()
                ->orderByRaw("FIELD(type, 'adult','child')")
                ->orderBy('id')
                ->get()
                ->map(function ($t) {
                    return [
                        'type'       => $t->type,
                        'first_name' => $t->first_name,
                        'last_name'  => $t->last_name,
                        'dob'        => optional($t->dob)->format('Y-m-d'),
                        'gender'     => $t->gender,
                        'country'    => $t->country,
                    ];
                })
                ->take($totalTravellers) // prevent overflow
                ->values()
                ->toArray();

            if (!empty($dbTravellers)) {
                session(['checkout_travellers' => $dbTravellers]);
                $sessionTravellers = $dbTravellers;
            }
        }

        /* ---------------------------------------------------
            |    STEP 3 — NORMALIZE SESSION
        --------------------------------------------------- */
        $sessionTravellers = collect($sessionTravellers)
            ->filter()
            ->values()
            ->toArray();

        /* ---------------------------------------------------
            | STEP 4 — BUILD EXACT SLOT
        --------------------------------------------------- */
        $travellerSlots = [];

        for ($i = 0; $i < $totalTravellers; $i++) {

            $type = $i < $adultCount ? 'adult' : 'child';

            $travellerSlots[] = [
                'type' => $type,
                'data' => isset($sessionTravellers[$i])
                    ? [
                        'first_name' => $sessionTravellers[$i]['first_name'] ?? '',
                        'last_name'  => $sessionTravellers[$i]['last_name'] ?? '',
                        'dob'        => $sessionTravellers[$i]['dob'] ?? '',
                        'gender'     => $sessionTravellers[$i]['gender'] ?? '',
                        'country'    => $sessionTravellers[$i]['country'] ?? '',
                        'type'       => $sessionTravellers[$i]['type'] ?? $type,
                    ]
                    : null,
            ];
        }

        /* ================= PACKAGE ================= */
        $package = Package::with([
            'days.items.hotel.translation' => fn($q) => $q->where('language_code', $language),
            'days.items.hotel.thumb',
            'days.items.todo.translation' => fn($q) => $q->where('language_code', $language),
            'days.items.todo.thumb',
            'days.items.event.translation' => fn($q) => $q->where('language_code', $language),
            'days.items.event.thumb',
            'days.options.hotel.translation' => fn($q) => $q->where('language_code', $language),
            'days.options.hotel.thumb',
            'days.options.todo.translation' => fn($q) => $q->where('language_code', $language),
            'days.options.todo.thumb',
            'days.options.event.translation' => fn($q) => $q->where('language_code', $language),
            'days.options.event.thumb',
            'days.options.transport.translation' => fn($q) => $q->where('language_code', $language),
            'days.options.transport.thumb',
            'availabilities',
            'translation',
            'days.city.translation',
            'policies.translation',
            'price.increasePersons',
            'price.childPrices',
        ])
            ->where('id', $checkout['package_id'])
            ->firstOrFail();

        /* ---------------------------------------------------
        | 🔥 PRICE REVALIDATION (ANTI-TAMPER)
        --------------------------------------------------- */
        $dayItemsExtra = (float) ($checkout['pricing']['day_items_extra'] ?? 0);

        $pricing = app(\App\Services\PackagePriceService::class)
            ->calculate($package, $adultCount, $childCount, $dayItemsExtra);

        $checkout['pricing'] = $pricing;
        session()->put('checkout', $checkout);

        /* ================= ACTIVE COUPONS ================= */
        $packageId  = $package->id;
        $categoryId = $package->category_id;

        $coupons = Coupon::where('is_active', true)
            ->whereDate('starts_at', '<=', now())
            ->whereDate('ends_at', '>=', now())
            ->where(function ($q) use ($packageId, $categoryId) {
                $q->where('applies_to', 'all')
                    ->orWhere(function ($q) use ($packageId) {
                        $q->where('applies_to', 'package')
                            ->whereHas('packages', fn($p) => $p->where('packages.id', $packageId));
                    })
                    ->orWhere(function ($q) use ($categoryId) {
                        $q->where('applies_to', 'category')
                            ->whereHas('categories', fn($c) => $c->where('categories.id', $categoryId));
                    });
            })
            ->get();

        /* ================= DAY OPTIONS ================= */
        $dayWiseOptions = [];

        foreach ($package->days as $day) {
            $dayWiseOptions[$day->id] = $day->options
                ->groupBy('item_type')
                ->map(function ($items, $type) {

                    return $items
                        ->keyBy('item_id')
                        ->map(function ($option) use ($type) {

                            if ($type !== 'hotel') unset($option['hotel']);
                            if ($type !== 'todo') unset($option['todo']);
                            if ($type !== 'event') unset($option['event']);
                            if ($type !== 'transport') unset($option['transport']);

                            return $option;
                        })
                        ->toArray();
                })
                ->toArray();
        }

        /* ================= SESSION DAY ITEMS ================= */
        $sessionItems = session("package_day_items.{$package->id}", []);

        /* ================= MASTER LISTS ================= */
        $hotelIds = [];
        $eventIds = [];
        $todoIds  = [];
        $transportIds = [];

        foreach ($package->days as $day) {
            foreach ($day->items as $index => $item) {

                $type = $item->item_type;

                $selectedItemId =
                    $sessionItems[$day->id][$type][$index]
                    ?? $item->item_id;

                if ($type === 'hotel') $hotelIds[] = $selectedItemId;
                if ($type === 'event') $eventIds[] = $selectedItemId;
                if ($type === 'todo')  $todoIds[]  = $selectedItemId;
                if ($type === 'transport') $transportIds[] = $selectedItemId;
            }
        }

        $allHotels = Hotel::with(['translation', 'thumb'])
            ->whereIn('id', array_unique($hotelIds))
            ->get()
            ->keyBy('id');

        $allEvents = Event::with(['translation', 'thumb'])
            ->whereIn('id', array_unique($eventIds))
            ->get()
            ->keyBy('id');

        $allTodos = ThingToDo::with(['translation', 'thumb'])
            ->whereIn('id', array_unique($todoIds))
            ->get()
            ->keyBy('id');

        $allTransports = Transport::with(['translation', 'thumb'])
            ->whereIn('id', array_unique($transportIds))
            ->get()
            ->keyBy('id');

        /* ================= USER SAVED TRAVELLERS ================= */
        $savedTravellers = Traveller::where('user_id', $user->id)
            ->orderBy('id')
            ->get();

        $travellers = [];
        $usedIds = [];

        // Adults
        for ($i = 0; $i < $adultCount; $i++) {
            $match = $savedTravellers
                ->where('type', 'adult')
                ->whereNotIn('id', $usedIds)
                ->first();

            if ($match) $usedIds[] = $match->id;

            $travellers[] = [
                'type'   => 'adult',
                'filled' => (bool) $match,
                'data'   => $match,
            ];
        }

        // Children
        for ($i = 0; $i < $childCount; $i++) {
            $match = $savedTravellers
                ->where('type', 'child')
                ->whereNotIn('id', $usedIds)
                ->first();

            if ($match) $usedIds[] = $match->id;

            $travellers[] = [
                'type'   => 'child',
                'filled' => (bool) $match,
                'data'   => $match,
            ];
        }

        $countries = Country::query()
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        $defaultBilling = auth()->user()->defaultBilling;

        return view(
            'frontend.checkout.index',
            array_merge(
                compact(
                    'package',
                    'travellers',
                    'checkout',
                    'allHotels',
                    'allTodos',
                    'allEvents',
                    'allTransports',
                    'dayWiseOptions',
                    'sessionItems',
                    'coupons',
                    'countries',
                    'defaultBilling'
                ),
                [
                    'adultCount' => $adultCount,
                    'childCount' => $childCount,
                    'travellerSlots' => $travellerSlots,
                    'sessionTravellers' => $sessionTravellers,
                    'totalTravellers' => $totalTravellers,
                ]
            )
        );
    }


    public function searchTraveller(Request $request)
    {
        $query = $request->q;

        $travellers = Traveller::where('user_id', auth()->id()) // 🔒 FILTER BY LOGIN USER
            ->where(function ($q) use ($query) {
                $q->where('first_name', 'like', "%{$query}%")
                    ->orWhere('last_name', 'like', "%{$query}%");
            })
            ->whereNull('deleted_at') // if soft delete
            ->get();

        return response()->json($travellers);
    }



    public function updateTravellerSession(Request $request)
    {
        session()->put('checkout_travellers', $request->travellers);

        return response()->json([
            'success' => true
        ]);
    }
}
