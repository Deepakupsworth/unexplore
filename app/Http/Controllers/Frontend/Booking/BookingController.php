<?php

namespace App\Http\Controllers\Frontend\Booking;

use App\Http\Controllers\Controller;
use App\Models\{
    Booking,
    BookingTraveller,
    BookingSnapshot,
    BookingDay,
    BookingDayItem,
    Package,
    Traveller
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Mail\BookingConfirmationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        /* =========================
       1️⃣ GET CHECKOUT SESSION
    ========================= */
        $checkout = session('checkout');

        if (!$checkout || empty($checkout['package_id'])) {
            abort(400, 'Checkout session expired or invalid');
        }

        /* =========================
       2️⃣ LOAD PACKAGE
    ========================= */
        $package = Package::with(['days.items', 'days.city.translation'])
            ->findOrFail($checkout['package_id']);

        /* =========================
       3️⃣ CALCULATE TRAVEL DATES
    ========================= */
        $startDate = Carbon::parse($checkout['start_date']);
        $totalDays = $package->days->count();
        $endDate   = $startDate->copy()->addDays($totalDays - 1);
        $booking = DB::transaction(function () use ($checkout, $package, $startDate, $endDate) {

            /* =========================
           4️⃣ CREATE BOOKING
        ========================= */
            $booking = Booking::create([
                'booking_code'         => 'BK-' . strtoupper(Str::random(8)),
                'user_id'              => auth()->id(),
                'package_id'           => $package->id,

                'status'               => 'pending',
                'payment_status'       => 'unpaid',

                // 💱 Currency (safe defaults)
                'base_currency'        => $checkout['base_currency'] ?? 'INR',
                'booking_currency'     => $checkout['booking_currency'] ?? 'INR',
                'base_total_amount'    => $checkout['base_price'] ?? 0,
                'exchange_rate'        => $checkout['exchange_rate'] ?? 1,
                'booking_total_amount' => $checkout['final_total'] ?? 0,

                // ✈️ Travel dates
                'travel_start_date'    => $startDate->toDateString(),
                'travel_end_date'      => $endDate->toDateString(),

                // 👨‍👩‍👧 Persons
                'total_person'         => $checkout['total_persons'],
                'total_adult'          => $checkout['adults'],
                'total_child'          => max(
                    0,
                    $checkout['total_persons'] - $checkout['adults']
                ),
            ]);

            /* =========================
           5️⃣ BOOKING TRAVELLERS
           🔥 SOURCE = USER SAVED TRAVELLERS
        ========================= */
            $travellers = Traveller::where('user_id', auth()->id())
                ->orderBy('id')
                ->take($checkout['total_persons'])
                ->get();

            foreach ($travellers as $traveller) {
                BookingTraveller::create([
                    'booking_id' => $booking->id,
                    'type'       => $traveller->type,
                    'first_name' => $traveller->first_name,
                    'last_name'  => $traveller->last_name,
                    'gender'     => $traveller->gender,
                    'dob'        => $traveller->dob,
                ]);
            }

            /* =========================
           6️⃣ BOOKING DAYS + ITEMS
        ========================= */
            foreach ($package->days as $dayIndex => $day) {

                // ✅ CREATE booking_days FIRST
                $bookingDay = BookingDay::create([
                    'booking_id'      => $booking->id,
                    'original_day_id' => $day->id,
                    'day_number'      => $dayIndex + 1,
                    'date'            => $startDate->copy()->addDays($dayIndex),
                    'city_id'         => $day->city_id,
                    'city_name'       => $day->city?->translation?->name ?? 'Unknown City',
                    'meta_json'       => $day->toArray(),
                ]);

                // ✅ THEN booking_day_items
                foreach ($day->items as $item) {
                    BookingDayItem::create([
                        'booking_day_id'   => $bookingDay->id,
                        'item_type'        => $item->item_type,
                        'original_item_id' => $item->item_id,
                        'title'            => $item->title ?? '',
                        'description'      => $item->description,
                        'start_time'       => $item->start_time,
                        'end_time'         => $item->end_time,
                        'sort_order'       => $item->sort_order ?? 0,
                        'extra_price'      => $item->extra_price ?? 0,
                        'is_optional'      => $item->is_optional ?? false,
                        'is_selected'      => true,
                        'meta_json'        => $item->toArray(),
                    ]);
                }
            }

            /* =========================
           7️⃣ SNAPSHOT (IMMUTABLE)
        ========================= */
            BookingSnapshot::create([
                'booking_id' => $booking->id,
                'snapshot_json' => [
                    'checkout' => $checkout,
                    'package'  => $package->toArray(),
                    'created'  => now()->toDateTimeString(),
                ],
            ]);
            return $booking;
        });

        try {
            Mail::to(auth()->user()->email)
                ->send(new BookingConfirmationMail($booking));
        } catch (\Exception $e) {
            Log::error('Booking mail failed: ' . $e->getMessage());
        }
        /* =========================
       8️⃣ CLEAN SESSION
    ========================= */
        session()->forget('checkout');

        return redirect()->route('booking.success');
    }


    public function success()
    {
        return view('frontend.booking.success');
    }



        public function testBookingMail()
        {
            // 🔹 Dummy booking object (assumed data)
            $booking = new Booking([
                'booking_code' => 'TEST-BK-1234',
                'booking_total_amount' => 45000,
                'travel_start_date' => now()->toDateString(),
                'travel_end_date' => now()->addDays(5)->toDateString(),
                'total_person' => 3,
                'status' => 'pending',
            ]);

            // fake relations
            $booking->setRelation('user', auth()->user());
            $booking->setRelation('package', (object)[
                'translation' => (object)[
                    'title' => 'Test Holiday Package'
                ]
            ]);

            try {
                Mail::to(auth()->user()->email)
                    ->send(new BookingConfirmationMail($booking));

                return response()->json([
                    'success' => true,
                    'message' => '✅ Test booking email sent successfully'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }
        }

}
