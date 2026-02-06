<?php

namespace App\Http\Controllers\Admin;
use App\Services\BookingPaymentService;
use App\Enums\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Exception;

use App\Enums\BookingStatus;
use App\Enums\PaymentStatus;

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
            'travellers',
            'snapshot',
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


    public function storeManualPayment(
        Request $request,
        Booking $booking,
        BookingPaymentService $service
    ) {
        $request->validate([
            'payment_method' => ['required'],
            'amount'         => 'required|numeric|min:1',
            'transaction_id' => 'nullable|string',
            'bank_name'      => 'nullable|string',
            'note'           => 'nullable|string',
            'payment_id'     => 'nullable|integer',
            'status'         => ['required', Rule::in([
                'pending',
                'paid',
                'failed',
                'refunded',
                'partial_refund',
            ])],
        ]);

        try {
            $service->addOrUpdatePayment(
                booking: $booking,
                method: PaymentMethod::from($request->payment_method),
                amount: (float) $request->amount,
                transactionId: $request->transaction_id,
                note: $request->note,
                paymentId: $request->payment_id,
                bankName: $request->bank_name,
                status: PaymentStatus::from($request->status),
            );

            return back()->with('success', 'Payment saved successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['payment' => $e->getMessage()]);
        }
    }


}
