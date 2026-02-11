<?php

namespace App\Services;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\BookingPayment;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Illuminate\Support\Facades\DB;
use Exception;


class BookingPaymentService
{
    public function addOrUpdatePayment(
        Booking $booking,
        PaymentMethod $method,
        float $amount,
        ?string $transactionId = null,
        ?string $note = null,
        ?int $paymentId = null,
        ?string $bankName = null,
        PaymentStatus $status   // ✅ STRONGLY TYPED
    ): BookingPayment {

        if ($amount <= 0) {
            throw new Exception('Invalid payment amount.');
        }

        return DB::transaction(function () use (
            $booking,
            $method,
            $amount,
            $transactionId,
            $note,
            $paymentId,
            $bankName,
            $status
        ) {

            /**
             * =========================
             * ✏️ UPDATE EXISTING PAYMENT
             * =========================
             */
            if ($paymentId) {

                $payment = BookingPayment::where('id', $paymentId)
                    ->where('booking_id', $booking->id)
                    ->firstOrFail();

                if ($payment->status === PaymentStatus::PAID->value) {
                    throw new Exception('Paid payment cannot be edited.');
                }

                $payment->update([
                    'transaction_id' => $transactionId,
                    'amount'         => $amount,
                    'status'         => $status->value,   // ✅ FIX
                    'bank_name'      => $bankName,
                    'payload_json'   => array_merge(
                        $payment->payload_json ?? [],
                        [
                            'note'       => $note,
                            'updated_by' => auth()->id(),
                        ]
                    ),
                ]);

                // 🔄 Sync only if updated to PAID
                if ($status === PaymentStatus::PAID) {
                    $this->syncBookingPaymentStatus($booking);
                }

                return $payment;
            }

            /**
             * =========================
             * ➕ ADD NEW PAYMENT
             * =========================
             */
            if (
                $booking->status !== BookingStatus::CONFIRMED
                && !in_array($method, [
                    PaymentMethod::BANK,
                    PaymentMethod::CASH
                ])
            ) {
                throw new Exception('Payment allowed only for confirmed bookings.');
            }

            $payment = BookingPayment::create([
                'booking_id'     => $booking->id,
                'payment_method' => $method->value,
                'transaction_id' => $transactionId,
                'currency'       => $booking->booking_currency,
                'amount'         => $amount,
                'status'         => $status->value,     // ✅ ADMIN SELECTED
                'bank_name'      => $bankName,
                'payload_json'   => [
                    'note'     => $note,
                    'added_by' => auth()->id(),
                ],
            ]);

            // 🔄 Sync booking only when PAID
            if ($status === PaymentStatus::PAID) {
                $this->syncBookingPaymentStatus($booking);
            }

            return $payment;
        });
    }

    protected function syncBookingPaymentStatus(Booking $booking): void
    {
        $totalPaid = $booking->payments()
            ->where('status', PaymentStatus::PAID->value)
            ->sum('amount');

        if ($totalPaid >= $booking->booking_total_amount) {
            $booking->update([
                'payment_status' => PaymentStatus::PAID->value,
                'status'         => BookingStatus::COMPLETED->value,
            ]);
        }
    }
}

