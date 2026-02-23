@extends('emails.layouts.app')

@section('title', 'Booking Cancelled')

@section('content')

    <!-- HEADING -->
    <h2 style="margin:0 0 16px 0;font-size:22px;color:#dc2626;">
        Booking Cancelled ❌
    </h2>

    <p style="margin:0 0 18px 0;font-size:14px;">
        Hello
        <strong>
            {{ $booking?->billingAddress?->full_name ?? ($booking?->user?->first_name ?? 'Customer') }}
        </strong>,
    </p>

    <p style="margin:0 0 24px 0;color:#555;">
        We regret to inform you that your booking has been
        <strong>cancelled</strong>. Please find the details below.
    </p>

    <!-- INFO CARD -->
    <table width="100%" cellpadding="0" cellspacing="0"
        style="background:#fef2f2;border:1px solid #fee2e2;border-radius:8px;">
        <tr>
            <td style="padding:16px;">

                <table width="100%" cellpadding="6" cellspacing="0" style="font-size:14px;color:#333;">

                    <tr>
                        <td style="color:#6b7280;width:45%;">Booking Code</td>
                        <td><strong>{{ $booking?->booking_code }}</strong></td>
                    </tr>

                    <tr>
                        <td style="color:#6b7280;">Package</td>
                        <td><strong>{{ $booking?->package?->translation?->title ?? '—' }}</strong></td>
                    </tr>

                    <tr>
                        <td style="color:#6b7280;">Travel Dates</td>
                        <td>
                            <strong>
                                {{ \Carbon\Carbon::parse($booking?->travel_start_date)->format('d M Y') }}
                                →
                                {{ \Carbon\Carbon::parse($booking?->travel_end_date)->format('d M Y') }}
                            </strong>
                        </td>
                    </tr>

                    <tr>
                        <td style="color:#6b7280;">Total Travellers</td>
                        <td><strong>{{ $booking?->total_person }}</strong></td>
                    </tr>

                    <tr>
                        <td style="color:#6b7280;">Status</td>
                        <td>
                            <span
                                style="
        background:#fee2e2;
        color:#b91c1c;
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

                    @if (!empty($reason))
                        <tr>
                            <td style="color:#6b7280;vertical-align:top;">Cancellation Reason</td>
                            <td><strong>{{ $reason }}</strong></td>
                        </tr>
                    @endif

                </table>

            </td>
        </tr>
    </table>

    <!-- MESSAGE -->
    <p style="margin:24px 0 0 0;color:#555;">
        If you have already made a payment, our team will process the refund
        (if applicable) according to the cancellation policy.
    </p>

    <p style="margin:12px 0 0 0;color:#555;">
        For any questions or assistance, please contact our support team.
    </p>

    <p style="margin:22px 0 0 0;">
        Thanks & Regards,<br>
        <strong>Unxplord Saudi</strong>
    </p>

@endsection
