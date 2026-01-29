<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Hotel;
use App\Models\Package;
use App\Models\ThingToDo;
use App\Models\Traveller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {


        return view('frontend.checkout');
    }


    public function show(Request $request)
    {
        $user = auth()->user();


        $travellers = Traveller::where('user_id', $user->id)
        ->orderBy('id')
        ->get();

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
            'availabilities',
            'translation'
        ])->where('slug', $request->slug)->firstOrFail();
        $dayWiseOptions = [];
        $sessionItems = session("package_day_items.{$package->id}", []);

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

        return view('frontend.checkout', compact(
            'package',
            'allHotels',
            'allTodos',
            'allEvents',
            'dayWiseOptions',
            'sessionItems',
            'travellers'
        ));
    }
}
