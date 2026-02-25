<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function showBooking(Request $request)
    {
        // ✅ get id from URL
        $bookingId = $request->query('booking_id');

        if (!$bookingId) {
            return 'Booking ID missing in URL';
        }

        // ✅ fetch booking
        $booking = Booking::with([
            'billingAddress',
            'package.translation',
        ])->find($bookingId);

        if (!$booking) {
            return 'Booking not found';
        }

        return view('emails.booking-completed',compact('booking'));
        // ✅ TEMP testing output
        // return response()->json($booking);
    }
}
