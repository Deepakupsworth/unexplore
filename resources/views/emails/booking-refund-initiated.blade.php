@extends('emails.layouts.app')

@section('title', 'Refund Initiated')

@section('content')

    <!-- HEADING -->
    <h2 style="margin:0 0 16px 0;font-size:22px;color:#16a34a;">
        Refund Initiated
    </h2>

    <p style="margin:0 0 18px 0;font-size:14px;">
        Hello
        <strong>
            {{ $booking?->billingAddress?->full_name ?? ($booking?->user?->first_name ?? 'Customer') }}
        </strong>,
    </p>

    <p style="margin:0 0 24px 0;color:#555;">
        We would like to inform you that the refund for your booking has been
        <strong>successfully initiated</strong>. Please find the details below.
    </p>

    <!-- INFO CARD -->
    <table width="100%" cellpadding="0" cellspacing="0"
        style="background:#f0fdf4;border:1px solid #dcfce7;border-radius:8px;">
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
                        <td style="color:#6b7280;">Refund Amount</td>
                        <td style="display:flex; align-items:center; gap:6px;">
                            <img width="18" height="18" src="{{asset(currency_icon_path($booking->booking_currency, 'light')) }}">
                            <strong style="color:#16a34a;font-size:16px;">
                                {{ $payment->currency }}
                                {{ number_format($payment->amount, 2) }}
                            </strong>
                        </td>
                    </tr>

                    <tr>
                        <td style="color:#6b7280;">Payment Method</td>
                        <td>
                            <strong>
                                {{ is_object($payment->payment_method) ? $payment->payment_method->label() : ucfirst($payment->payment_method) }}
                            </strong>
                        </td>
                    </tr>

                    @if (!empty($payment->transaction_id))
                        <tr>
                            <td style="color:#6b7280;">Transaction ID</td>
                            <td><strong>{{ $payment->transaction_id }}</strong></td>
                        </tr>
                    @endif

                </table>

            </td>
        </tr>
    </table>

    <!-- MESSAGE -->
    <p style="margin:24px 0 0 0;color:#555;">
        The refunded amount will be credited back to your original payment method
        within <strong>5–7 business days</strong>, depending on your bank or payment provider.
    </p>

    <p style="margin:12px 0 0 0;color:#555;">
        If you do not receive the refund within this time, please contact our support team
        with your booking code.
    </p>

    <p style="margin:22px 0 0 0;">
        Thanks & Regards,<br>
        <strong>Unxplord Saudi</strong>
    </p>

@endsection
