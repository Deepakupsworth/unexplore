<?php

namespace App\Http\Controllers\Frontend\Booking;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\{
    Booking,
    BookingTraveller,
    BookingSnapshot,
    BookingDay,
    BookingDayItem,
    Coupon,
    Package,
    Traveller
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Mail\BookingConfirmationMail;
use App\Services\BookingPaymentService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    // public function store(Request $request, BookingPaymentService $paymentService)
    // {
    //     /* =========================
    //    1️⃣ CHECKOUT SESSION
    // ========================= */
    //     $checkout = session('checkout');

    //     if (!$checkout || empty($checkout['package_id'])) {
    //         abort(400, 'Checkout session expired');
    //     }

    //     /* =========================
    //    2️⃣ LOAD PACKAGE
    // ========================= */
    //     $package = Package::with(['days.items.translationData', 'days.city.translation'])
    //         ->findOrFail($checkout['package_id']);

    //     /* =========================
    //    3️⃣ TRAVEL DATES
    // ========================= */
    //     $startDate = Carbon::parse($checkout['start_date']);
    //     $endDate   = $startDate->copy()->addDays($package->days->count() - 1);

    //     /* =========================
    //    4️⃣ COUPON (SERVER SIDE)
    // ========================= */
    //     [$couponCode, $couponDiscount, $finalPayable] =
    //         $this->calculateCouponDiscount(
    //             $request->applied_coupon_code,
    //             $checkout['final_total'],
    //             $package
    //         );

    //     /* =========================
    //    5️⃣ CREATE BOOKING (TX)
    // ========================= */
    //     $booking = DB::transaction(function () use (
    //         $checkout,
    //         $package,
    //         $startDate,
    //         $endDate,
    //         $couponCode,
    //         $couponDiscount,
    //         $finalPayable,
    //         $request,          // ✅ ADD
    //         $paymentService
    //     ) {

    //         /* ===== BOOKING ===== */
    //         $booking = Booking::create([
    //             'booking_code'         => 'BK-' . strtoupper(Str::random(8)),
    //             'user_id'              => auth()->id(),
    //             'package_id'           => $package->id,

    //             'status'               => 'pending',
    //             'payment_status'       => 'unpaid',

    //             'base_currency'        => $checkout['base_currency'] ?? 'INR',
    //             'booking_currency'     => $checkout['booking_currency'] ?? 'INR',
    //             'base_total_amount'    => $checkout['base_price'] ?? 0,
    //             'exchange_rate'        => $checkout['exchange_rate'] ?? 1,

    //             'booking_total_amount' => $finalPayable,
    //             'coupon_code'          => $couponCode,
    //             'coupon_discount'      => $couponDiscount,

    //             'travel_start_date'    => $startDate->toDateString(),
    //             'travel_end_date'      => $endDate->toDateString(),

    //             'total_person'         => $checkout['total_persons'],
    //             'total_adult'          => $checkout['adults'],
    //             'total_child'          => max(0, $checkout['total_persons'] - $checkout['adults']),
    //         ]);

    //         /* ===== TRAVELLERS ===== */
    //         Traveller::where('user_id', auth()->id())
    //             ->take($checkout['total_persons'])
    //             ->get()
    //             ->each(
    //                 fn($t) =>
    //                 BookingTraveller::create([
    //                     'booking_id' => $booking->id,
    //                     'type'       => $t->type,
    //                     'first_name' => $t->first_name,
    //                     'last_name'  => $t->last_name,
    //                     'gender'     => $t->gender,
    //                     'dob'        => $t->dob,
    //                 ])
    //             );



    //         /* ===== DAYS + ITEMS ===== */
    //         foreach ($package->days as $i => $day) {

    //             $bookingDay = BookingDay::create([
    //                 'booking_id'      => $booking->id,
    //                 'original_day_id' => $day->id,
    //                 'day_number'      => $i + 1,
    //                 'date'            => $startDate->copy()->addDays($i),
    //                 'city_id'         => $day->city_id,
    //                 'city_name'       => $day->city?->translation?->name,
    //                 'meta_json'       => $day->toArray(),
    //             ]);

    //             foreach ($day->items as $item) {
    //                 dd($item);
    //                 BookingDayItem::create([
    //                     'booking_day_id'   => $bookingDay->id,
    //                     'item_type'        => $item->item_type,
    //                     'original_item_id' => $item->item_id,
    //                     'title'            => $item->title ?? '',
    //                     'description'      => $item->description,
    //                     'start_time'       => $item->start_time,
    //                     'end_time'         => $item->end_time,
    //                     'extra_price'      => $item->extra_price ?? 0,
    //                     'is_optional'      => $item->is_optional ?? false,
    //                     'is_selected'      => true,
    //                     'meta_json'        => $item->toArray(),
    //                 ]);
    //             }
    //         }

    //         /* ===== SNAPSHOT ===== */
    //         BookingSnapshot::create([
    //             'booking_id' => $booking->id,
    //             'snapshot_json' => [
    //                 'thumb' => $package->thumb ?? null,
    //                 'checkout' => $checkout,
    //                 'coupon' => [
    //                     'code'     => $couponCode,
    //                     'discount' => $couponDiscount,
    //                     'final'    => $finalPayable,
    //                 ],
    //                 'package' => $package->toArray(),
    //                 'created' => now()->toDateTimeString(),
    //             ],
    //         ]);

    //         /* =========================
    //         💳 BANK TRANSFER PAYMENT ENTRY
    //         ========================= */
    //         $paymentService->addOrUpdatePayment(
    //             booking: $booking,
    //             method: PaymentMethod::BANK,
    //             amount: $finalPayable,
    //             transactionId: $request->transaction_id ?? null,
    //             note: 'Bank transfer initiated by user',
    //             paymentId: null,                      // ➕ new payment
    //             bankName: $request->bank_name ?? null,
    //             status: PaymentStatus::PENDING        // ⏳ bank = pending
    //         );

    //         return $booking;
    //     });

    //     /* =========================
    //    6️⃣ MAIL (SAFE)
    // ========================= */
    //     try {
    //         Mail::to(auth()->user()->email)
    //             ->send(new BookingConfirmationMail($booking));
    //     } catch (\Throwable $e) {
    //         Log::warning('Booking mail failed', ['error' => $e->getMessage()]);
    //     }

    //     session()->forget('checkout');

    //     return redirect()->route('booking.success');
    // }


    public function store(Request $request, BookingPaymentService $paymentService)
    {
        /* =========================
       1️⃣ CHECKOUT SESSION
    ========================= */
        $checkout = session('checkout');

        if (!$checkout || empty($checkout['package_id'])) {
            abort(400, 'Checkout session expired');
        }

        /* =========================
       2️⃣ LOAD PACKAGE WITH RELATIONS
    ========================= */
        $package = Package::with([
            'thumb',
            'days.city.translation',

            'days.items.hotel.translation',
            'days.items.hotel.thumb',

            'days.items.todo.translation',
            'days.items.todo.thumb',

            'days.items.event.translation',
            'days.items.event.thumb',

            'days.items.transport.translation',
            'days.items.transport.thumb',
        ])->findOrFail($checkout['package_id']);

        /* =========================
       3️⃣ TRAVEL DATES
    ========================= */
        $startDate = Carbon::parse($checkout['start_date']);
        $endDate   = $startDate->copy()->addDays($package->days->count() - 1);

        /* =========================
       4️⃣ COUPON
    ========================= */
        [$couponCode, $couponDiscount, $finalPayable] =
            $this->calculateCouponDiscount(
                $request->applied_coupon_code,
                $checkout['final_total'],
                $package
            );

        /* =========================
       5️⃣ TRANSACTION
    ========================= */
        $booking = DB::transaction(function () use (
            $checkout,
            $package,
            $startDate,
            $endDate,
            $couponCode,
            $couponDiscount,
            $finalPayable,
            $request,
            $paymentService
        ) {

            /* ===== CREATE BOOKING ===== */
            $booking = Booking::create([
                'booking_code'         => 'BK-' . strtoupper(Str::random(8)),
                'user_id'              => auth()->id(),
                'package_id'           => $package->id,

                'status'               => 'pending',
                'payment_status'       => 'unpaid',

                'base_currency'        => $checkout['base_currency'] ?? 'INR',
                'booking_currency'     => $checkout['booking_currency'] ?? 'INR',
                'base_total_amount'    => $checkout['base_price'] ?? 0,
                'exchange_rate'        => $checkout['exchange_rate'] ?? 1,

                'booking_total_amount' => $finalPayable,
                'coupon_code'          => $couponCode,
                'coupon_discount'      => $couponDiscount,

                'travel_start_date'    => $startDate->toDateString(),
                'travel_end_date'      => $endDate->toDateString(),

                'total_person'         => $checkout['total_persons'],
                'total_adult'          => $checkout['adults'],
                'total_child'          => max(0, $checkout['total_persons'] - $checkout['adults']),
            ]);

            /* ===== TRAVELLERS ===== */
            Traveller::where('user_id', auth()->id())
                ->take($checkout['total_persons'])
                ->get()
                ->each(function ($t) use ($booking) {
                    BookingTraveller::create([
                        'booking_id' => $booking->id,
                        'type'       => $t->type,
                        'first_name' => $t->first_name,
                        'last_name'  => $t->last_name,
                        'gender'     => $t->gender,
                        'dob'        => $t->dob,
                    ]);
                });

            /* ===== DAYS + ITEMS ===== */
            foreach ($package->days as $dayIndex => $day) {

                $bookingDay = BookingDay::create([
                    'booking_id'      => $booking->id,
                    'original_day_id' => $day->id,
                    'day_number'      => $dayIndex + 1,
                    'date'            => $startDate->copy()->addDays($dayIndex),
                    'city_id'         => $day->city_id,
                    'city_name'       => $day->city?->translation?->name,
                    'meta_json'       => $day->toArray(),
                ]);


                foreach ($day->items as $itemIndex => $item) {

                    $title = null;
                    $image = null;

                    if ($item->item_type === 'hotel' && $item->hotel) {
                        $title = $item->hotel->translation?->name;
                        $image = $item->hotel->thumb?->image_path;
                    }

                    if ($item->item_type === 'todo' && $item->todo) {
                        $title = $item->todo->translation?->name;
                        $image = $item->todo->thumb?->image_path;
                    }

                    if ($item->item_type === 'event' && $item->event) {
                        $title = $item->event->translation?->title;
                        $image = $item->event->thumb?->image_path;
                    }

                    if ($item->item_type === 'transport' && $item->transport) {
                        $title = $item->transport->translation?->name;
                        $image = $item->transport->thumb?->image_path;
                    }

                    $snapshot = [
                        'item_id'    => $item->item_id,
                        'item_type'  => $item->item_type,
                        'title'      => $title,
                        'image_path' => $image,
                    ];

                    BookingDayItem::create([
                        'booking_day_id'   => $bookingDay->id,
                        'item_type'        => $item->item_type,
                        'original_item_id' => $item->item_id,

                        'title'       => $title ?? 'N/A',
                        'description' => $item->description,
                        'start_time'  => $item->start_time
                            ? Carbon::parse($item->start_time)->format('H:i:s')
                            : null,
                        'end_time'    => $item->end_time
                            ? Carbon::parse($item->end_time)->format('H:i:s')
                            : null,
                        'sort_order'  => $itemIndex,
                        'extra_price' => $item->extra_price ?? 0,
                        'is_optional' => $item->is_optional ?? 0,
                        'is_selected' => 1,

                        'meta_json'   => $snapshot,
                    ]);
                }
            }

            /* ===== SNAPSHOT ===== */
            BookingSnapshot::create([
                'booking_id' => $booking->id,
                'snapshot_json' => [
                    'thumb'    => $package->thumb ?? null,
                    'checkout' => $checkout,
                    'coupon'   => [
                        'code'     => $couponCode,
                        'discount' => $couponDiscount,
                        'final'    => $finalPayable,
                    ],
                    'package'  => $package->toArray(),
                    'created'  => now()->toDateTimeString(),
                ],
            ]);

            /* ===== PAYMENT ENTRY ===== */
            $paymentService->addOrUpdatePayment(
                booking: $booking,
                method: PaymentMethod::BANK,
                amount: $finalPayable,
                transactionId: $request->transaction_id ?? null,
                note: 'Bank transfer initiated by user',
                paymentId: null,
                bankName: $request->bank_name ?? null,
                status: PaymentStatus::PENDING
            );

            return $booking;
        });

        /* =========================
       6️⃣ MAIL
    ========================= */
        try {
            Mail::to(auth()->user()->email)
                ->send(new BookingConfirmationMail($booking));
        } catch (\Throwable $e) {
            Log::warning('Booking mail failed', ['error' => $e->getMessage()]);
        }

        session()->forget('checkout');

        return redirect()->route('booking.success');
    }




    public function success()
    {
        return view('frontend.booking.success');
    }


    private function calculateCouponDiscount(?string $code, float $amount, Package $package): array
    {
        if (!$code) {
            return [null, 0, $amount];
        }

        $coupon = Coupon::with(['categories', 'packages'])
            ->where('code', $code)
            ->where('is_active', true)
            ->first();

        if (!$coupon) {
            return [null, 0, $amount];
        }

        // date check
        if (
            ($coupon->starts_at && now()->lt($coupon->starts_at)) ||
            ($coupon->ends_at && now()->gt($coupon->ends_at))
        ) {
            return [null, 0, $amount];
        }

        // scope check
        if (
            $coupon->applies_to === 'package' &&
            !$coupon->packages->pluck('id')->contains($package->id)
        ) {
            return [null, 0, $amount];
        }

        if (
            $coupon->applies_to === 'category' &&
            !$coupon->categories->pluck('id')->contains($package->category_id)
        ) {
            return [null, 0, $amount];
        }

        $discount = $coupon->discount_type === 'percentage'
            ? ($amount * $coupon->discount_value / 100)
            : $coupon->discount_value;

        if ($coupon->max_discount) {
            $discount = min($discount, $coupon->max_discount);
        }

        return [
            $coupon->code,
            round($discount, 2),
            max(0, $amount - $discount)
        ];
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
