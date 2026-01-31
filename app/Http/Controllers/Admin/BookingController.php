<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::with([
            'user:id,first_name,last_name,email',
            'package:id',
            'package.translation'
        ])
            ->when(
                $request->booking_code,
                fn($q) =>
                $q->where('booking_code', 'like', '%' . $request->booking_code . '%')
            )
            ->when(
                $request->status,
                fn($q) =>
                $q->where('status', $request->status)
            )
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('backend.bookings.index', compact('bookings'));
    }


    public function show(Booking $booking)
    {
        $booking->load([
            'package.translation',
            'travellers'
        ]);
        return view('backend.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'type'   => 'required|in:booking,payment',
            'status' => 'required|string',
        ]);

        if ($request->type === 'booking') {
            $booking->update([
                'status' => $request->status,
            ]);
        }

        if ($request->type === 'payment') {
            $booking->update([
                'payment_status' => $request->status,
            ]);
        }

        return back()->with('success', 'Status updated successfully');
    }
}
