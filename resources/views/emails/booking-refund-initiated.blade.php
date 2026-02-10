<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Refund Initiated</title>
</head>

<body style="font-family: Arial, sans-serif; background:#f7f7f7; padding:20px">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" style="background:#ffffff; padding:24px; border-radius:8px">
                    <tr>
                        <td>

                            <h2 style="color:#16a34a;">Refund Initiated 💸</h2>

                            <p>Hello <strong>{{ $booking?->user?->first_name ?? '' }}</strong>,</p>

                            <p>
                                We would like to inform you that the refund for your booking
                                has been <strong>successfully initiated</strong>.
                            </p>

                            <hr>

                            <p><strong>Booking Code:</strong> {{ $booking->booking_code }}</p>
                            <p><strong>Package:</strong>
                                {{ $booking->package->translation->title ?? '—' }}
                            </p>

                            <p><strong>Refund Amount:</strong>
                                {{ $payment->currency }} {{ number_format($payment->amount, 2) }}
                            </p>

                            <p><strong>Payment Method:</strong>
                                {{ ucfirst($payment->payment_method) }}
                            </p>

                            @if ($payment->transaction_id)
                                <p><strong>Transaction ID:</strong>
                                    {{ $payment->transaction_id }}
                                </p>
                            @endif

                            <hr>

                            <p style="color:#555;">
                                The refunded amount will be credited back to your original
                                payment method within <strong>5–7 business days</strong>,
                                depending on your bank or payment provider.
                            </p>

                            <p>
                                If you do not receive the refund within this time,
                                please contact our support team with your booking code.
                            </p>

                            <br>

                            <p>
                                Thanks & Regards,<br>
                                <strong>Unexplored Saudi</strong>
                            </p>

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>
