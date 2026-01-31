<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Hotel;
use App\Models\Package;
use App\Models\ThingToDo;
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
            'availabilities',
            'translation',
            'days.city.translation',
        ])
            ->where('slug', $checkout['slug'])
            ->firstOrFail();

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

        return view('frontend.checkout', compact(
            'package',
            'travellers',
            'checkout',
            'sessionItems'
        ));
    }
}
