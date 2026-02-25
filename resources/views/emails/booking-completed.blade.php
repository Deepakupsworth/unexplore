@extends('emails.layouts.app')

@section('title', 'Booking Completed')

@section('content')

    <!-- HEADING -->
    <h2 style="margin:0 0 16px 0;font-size:22px;color:#16a34a;">
        Booking Completed
    </h2>

    <p style="margin:0 0 18px 0;font-size:14px;">
        Hello <strong>{{ $booking?->billingAddress?->full_name ?? ($booking?->user?->first_name ?? 'Customer') }}</strong>,
    </p>

    <p style="margin:0 0 24px 0;color:#555;">
        We’re delighted to inform you that your booking has been
        <strong>successfully completed</strong>.
    </p>

    <!-- INFO CARD -->
    <table width="100%" cellpadding="0" cellspacing="0"
        style="background:#f9fafb;border:1px solid #eeeeee;border-radius:8px;">
        <tr>
            <td style="padding:16px;">

                <table width="100%" cellpadding="6" cellspacing="0" style="font-size:14px;color:#333;">

                    <tr>
                        <td style="color:#6b7280;width:45%;">Booking Code</td>
                        <td><strong>{{ $booking->booking_code }}</strong></td>
                    </tr>

                    <tr>
                        <td style="color:#6b7280;">Package</td>
                        <td><strong>{{ $booking->package?->translation?->title ?? '—' }}</strong></td>
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
                        <td style="color:#6b7280;">Total Amount Paid</td>
                        <td>
                            <img src="{{ url(asset(currency_icon_path($booking->booking_currency, 'light'))) }}">
                            &nbsp;
                            <strong style="color:#16a34a;font-size:16px;">
                                {{ number_format($booking?->booking_total_amount, 2) }}
                            </strong>
                        </td>
                    </tr>

                    <tr>
                        <td style="color:#6b7280;">Status</td>
                        <td>
                            <span
                                style="
        background:#dcfce7;
        color:#166534;
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
        We hope you had a wonderful experience with us.
        Your feedback means a lot and helps us improve our services.
    </p>

    <p style="margin:12px 0 0 0;color:#555;">
        If you need assistance with future bookings, our support team is always here to help.
    </p>

    <p style="margin:22px 0 0 0;">
        Warm regards,<br>
        <strong>Unxplord Saudi</strong>
    </p>

@endsection
