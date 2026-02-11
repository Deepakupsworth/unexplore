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
use App\Mail\BookingCancelledMail;
use App\Mail\BookingCompletedMail;
use Illuminate\Support\Facades\Mail;

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
            'package.translation', // meta info
            'travellers',
            'snapshot',
            'days.dayItems'            // ✅ real relation
        ]);

        // Snapshot JSON (safe)
        $snapshot = $booking->snapshot?->snapshot_json ?? [];

        // Extract snapshot data
        $package   = $snapshot['package'] ?? [];
        $days      = $package['days'] ?? [];
        $coupon    = $snapshot['coupon'] ?? null;
        $checkout  = $snapshot['checkout'] ?? null;
        $thumb     = $snapshot['thumb'] ?? null;

        return view('backend.bookings.show', compact(
            'booking',
            'snapshot',
            'package',
            'days',
            'coupon',
            'checkout',
            'thumb'
        ));
    }


    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'reason' => 'nullable|string|max:255',
        ]);

        $oldStatus = $booking->status;

        $booking->update([
            'status' => $request->status
        ]);

        /*
    |--------------------------------------------------------------------------
    | 🔔 STATUS BASED EMAILS
    |--------------------------------------------------------------------------
    */

        // ❌ Cancellation Mail
        if ($oldStatus !== 'cancelled' && $request->status === 'cancelled') {
            Mail::to($booking->user->email)
                ->send(new BookingCancelledMail(
                    $booking,
                    $request->reason ?? null
                ));
        }

        // ✅ Completion Mail
        if ($oldStatus !== 'completed' && $request->status === 'completed') {
            Mail::to($booking->user->email)
                ->send(new BookingCompletedMail($booking));
        }
        return back()->with('success', 'Booking status updated successfully.');
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
