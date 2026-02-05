<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Event;
use App\Models\Hotel;
use App\Models\Package;
use App\Models\ThingToDo;
use App\Models\Transport;
use App\Models\Traveller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('frontend.checkout');
    }


    public function init(Request $request)
    {
        // package resolve FIRST
        $package = Package::where('slug', $request->slug)->firstOrFail();

        // checkout payload
        $checkout = $request->all();

        // 🔥 REQUIRED FOR BOOKING
        $checkout['package_id'] = $package->id;

        // optional but safe
        $checkout['base_currency']    = $checkout['base_currency'] ?? 'SAR';
        $checkout['booking_currency'] = $checkout['booking_currency'] ?? 'SAR';
        $checkout['exchange_rate']    = $checkout['exchange_rate'] ?? 1;

        session()->put('checkout', $checkout);

        return redirect()->route('checkout.view');
    }




    public function show(Request $request)
    {
        $checkout = session('checkout');

        // dd($checkout);

        if (!$checkout || empty($checkout['slug'])) {
            abort(404, 'Checkout session expired');
        }

        $user = auth()->user();
        $language = current_lang();

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
        ])
            ->where('slug', $checkout['slug'])
            ->firstOrFail();

        /* ================= ACTIVE COUPONS ================= */

        $packageId  = $package->id;
        $categoryId = $package->category_id;

        $coupons = Coupon::where('is_active', true)
            ->whereDate('starts_at', '<=', now())
            ->whereDate('ends_at', '>=', now())
            ->where(function ($q) use ($packageId, $categoryId) {

                // 🌍 applies to ALL
                $q->where('applies_to', 'all')

                    // 📦 applies to PACKAGE
                    ->orWhere(function ($q) use ($packageId) {
                        $q->where('applies_to', 'package')
                            ->whereHas('packages', function ($p) use ($packageId) {
                                $p->where('packages.id', $packageId);
                            });
                    })

                    // 🏷 applies to CATEGORY
                    ->orWhere(function ($q) use ($categoryId) {
                        $q->where('applies_to', 'category')
                            ->whereHas('categories', function ($c) use ($categoryId) {
                                $c->where('categories.id', $categoryId);
                            });
                    });
            })
            ->get();


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

        //print_r($dayWiseOptions);die;
        $sessionItems = session("package_day_items.{$package->id}", []);
        //print_r($sessionItems);

        $hotelIds = [];
        $eventIds = [];
        $todoIds  = [];
        $transportIds = [];

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

                if ($type === 'transport') {
                    $transportIds[] = $selectedItemId;
                }
            }
        }



        // remove duplicates
        $hotelIds = array_unique($hotelIds);

        //print_r($hotelIds);die;
        $eventIds = array_unique($eventIds);
        $todoIds  = array_unique($todoIds);
        $transportIds = array_unique($transportIds);



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
        /* ================= COUNTS (🔥 FIXED) ================= */
        $adults        = (int) ($checkout['adults'] ?? 0);
        $totalPersons = (int) ($checkout['total_persons'] ?? $adults);

        // 🔥 ONLY ONE TRUTH
        $children = max(0, $totalPersons - $adults);

        /* ================= USER SAVED TRAVELLERS ================= */
        $savedTravellers = Traveller::where('user_id', $user->id)
            ->orderBy('id')
            ->get();

        /* ================= BUILD SLOT BASED TRAVELLERS ================= */
        $travellers = [];
        $usedIds = [];

        // ===== ADULT SLOTS =====
        for ($i = 0; $i < $adults; $i++) {
            $match = $savedTravellers
                ->where('type', 'adult')
                ->whereNotIn('id', $usedIds)
                ->first();

            if ($match) {
                $usedIds[] = $match->id;
            }

            $travellers[] = [
                'type'   => 'adult',
                'filled' => (bool) $match,
                'data'   => $match,
            ];
        }

        // ===== CHILD SLOTS (🔥 NOW WORKING) =====
        for ($i = 0; $i < $children; $i++) {
            $match = $savedTravellers
                ->where('type', 'child')
                ->whereNotIn('id', $usedIds)
                ->first();

            if ($match) {
                $usedIds[] = $match->id;
            }

            $travellers[] = [
                'type'   => 'child',
                'filled' => (bool) $match,
                'data'   => $match,
            ];
        }

        /* ================= DAY ITEM SESSION ================= */
        $sessionItems = session("package_day_items.{$package->id}", []);

        return view('frontend.checkout.index', compact(
            'package',
            'travellers',
            'checkout',
            'allHotels',
            'allTodos',
            'allEvents',
            'allTransports',
            'dayWiseOptions',
            'sessionItems',
            'coupons'
        ));
    }
}
