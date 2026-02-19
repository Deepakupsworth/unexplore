<?php

namespace App\Observers;

use App\Models\Booking;

use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Notification;

class BookingObserver
{
    /**
     * Handle the Booking "created" event.
     */
    public function created(Booking $booking)
    {
        // Notify Admin(s)
        $admins = User::where('role', 'admin')->get();

        Notification::send(
            $admins,
            new SystemNotification(
                'new_booking',
                [
                    'booking_id' => $booking->id,
                    'booking_code' => $booking->booking_code,
                    'user_id' => $booking->user_id,
                    'message' => "Booking #{$booking->booking_code} New booking received",
                    'url'          => route('admin.bookings.show', $booking->id),
                ]
            )
        );
    }

    /**
     * Handle the Booking "updated" event.
     */
    public function updated(Booking $booking)
    {
        if (!$booking->isDirty('status')) {
            return;
        }

        $statusMap = [
            'cancelled' => [
                'type' => 'booking_cancelled',
                'text' => 'has been cancelled',
            ],
            'refunded' => [
                'type' => 'booking_refunded',
                'text' => 'has been refunded',
            ],
            'confirmed' => [
                'type' => 'booking_confirmed',
                'text' => 'has been confirmed',
            ],
            'completed' => [
                'type' => 'booking_completed',
                'text' => 'has been completed',
            ],
        ];

          // 👇 FIX: ensure string
        $status = is_object($booking->status)
        ? $booking->status->value
        : (string) $booking->status;

        if (!isset($statusMap[$status])) {
            return;
        }

        $config = $statusMap[$status];

        $booking->user->notify(
            new SystemNotification(
                $config['type'],
                [
                    'booking_id'   => $booking->id,
                    'booking_code' => $booking->booking_code,
                    'message'      => "Booking #{$booking->booking_code} {$config['text']}",
                    'url'          => route('admin.bookings.show', $booking->id),
                ]
            )
        );
    }


    /**
     * Handle the Booking "deleted" event.
     */
    public function deleted(Booking $booking): void
    {
        //
    }

    /**
     * Handle the Booking "restored" event.
     */
    public function restored(Booking $booking): void
    {
        //
    }

    /**
     * Handle the Booking "force deleted" event.
     */
    public function forceDeleted(Booking $booking): void
    {
        //
    }
}
