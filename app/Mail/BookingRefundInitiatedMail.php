<?php

namespace App\Mail;

use App\Models\Booking;
use App\Models\BookingPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingRefundInitiatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Booking $booking;
    public BookingPayment $payment;

    public function __construct(Booking $booking, BookingPayment $payment)
    {
        $this->booking = $booking;
        $this->payment = $payment;
    }

    public function build()
    {
        return $this->subject('Refund Initiated for Your Booking')
            ->view('emails.booking-refund-initiated');
    }
}
