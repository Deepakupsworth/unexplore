<!DOCTYPE html>
<html>
{{-- @dd($booking) --}}
<head>
    <meta charset="utf-8">
    <title>Booking Cancelled</title>
</head>

<body style="font-family: Arial, sans-serif; background:#f7f7f7; padding:20px">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" style="background:#ffffff; padding:24px; border-radius:8px">

                    <tr>
                        <td>
                            <h2 style="color:#dc2626;">Booking Cancelled ❌</h2>

                            <p>Hello <strong>{{ $booking?->user?->first_name }}</strong>,</p>

                            <p>
                                We regret to inform you that your booking has been
                                <strong>cancelled</strong>.
                            </p>

                            <hr>

                            <p><strong>Booking Code:</strong> {{ $booking?->booking_code }}</p>
                            <p><strong>Package:</strong>
                                {{ $booking?->package?->translation->title ?? '—' }}
                            </p>

                            <p><strong>Travel Dates:</strong>
                                {{ \Carbon\Carbon::parse($booking?->travel_start_date)->format('d M Y') }}
                                →
                                {{ \Carbon\Carbon::parse($booking?->travel_end_date)->format('d M Y') }}
                            </p>

                            <p><strong>Total Travellers:</strong> {{ $booking?->total_person }}</p>

                            @if ($reason)
                                <p>
                                    <strong>Cancellation Reason:</strong><br>
                                    {{ $reason }}
                                </p>
                            @endif

                            <hr>

                            <p style="color:#555;">
                                If you have already made a payment, our team will
                                process the refund (if applicable) as per the
                                cancellation policy.
                            </p>

                            <p>
                                For any questions, feel free to contact our support team.
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
