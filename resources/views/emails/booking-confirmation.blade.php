@extends('emails.layouts.app')

@section('title', 'Booking Confirmed')

@section('content')

    <!-- HEADING -->
    <h2 style="margin:0 0 16px 0;font-size:22px;color:#1f2937;">
        Booking Confirmation 🎉
    </h2>

    <p style="margin:0 0 18px 0;font-size:14px;">
        Hello <strong>{{ $booking?->billingAddress?->full_name ?? 'Customer' }}</strong>,
    </p>

    <p style="margin:0 0 24px 0;color:#555;">
        Your booking has been successfully placed. Here are your booking details:
    </p>

    <!-- INFO CARD -->
    <table width="100%" cellpadding="0" cellspacing="0"
        style="background:#f9fafb;border:1px solid #eeeeee;border-radius:8px;padding:16px;">
        <tr>
            <td>

                <table width="100%" cellpadding="6" cellspacing="0" style="font-size:14px;color:#333;">

                    <tr>
                        <td style="color:#6b7280;width:45%;">Booking ID</td>
                        <td><strong>{{ $booking->booking_code }}</strong></td>
                    </tr>

                    <tr>
                        <td style="color:#6b7280;">Package</td>
                        <td><strong>{{ $booking->package?->translation?->title ?? '' }}</strong></td>
                    </tr>

                    <tr>
                        <td style="color:#6b7280;">Total Travellers</td>
                        <td><strong>{{ $booking->total_person }}</strong></td>
                    </tr>

                    <tr>
                        <td style="color:#6b7280;">Total Amount</td>
                        <td>
                            <strong style="color:#0a6b3c;font-size:16px;">
                                ₹{{ number_format($booking->booking_total_amount) }}
                            </strong>
                        </td>
                    </tr>

                    <tr>
                        <td style="color:#6b7280;">Status</td>
                        <td>
                            <span
                                style="
        background:#fff7ed;
        color:#b45309;
        padding:4px 10px;
        border-radius:999px;
        font-size:12px;
        font-weight:bold;
        display:inline-block;
    ">
                                {{ $booking->status->label() }}
                            </span>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

    <!-- MESSAGE -->
    <p style="margin:24px 0 0 0;color:#555;">
        We will notify you once your payment is completed and your booking is confirmed.
    </p>

    <p style="margin:22px 0 0 0;">
        Thanks & Regards,<br>
        <strong>Unxplord Saudi</strong>
    </p>

@endsection
