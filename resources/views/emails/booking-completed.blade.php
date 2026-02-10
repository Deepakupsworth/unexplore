<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Booking Completed</title>
</head>

<body style="font-family: Arial, sans-serif; background:#f7f7f7; padding:20px">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" style="background:#ffffff; padding:24px; border-radius:8px">

                    <tr>
                        <td>

                            <h2 style="color:#16a34a;">Booking Completed 🎉</h2>

                            <p>Hello <strong>{{ $booking?->user?->first_name ?? '' }}</strong>,</p>

                            <p>
                                We’re delighted to inform you that your booking has been
                                <strong>successfully completed</strong>.
                            </p>

                            <hr>

                            <p><strong>Booking Code:</strong> {{ $booking->booking_code }}</p>

                            <p><strong>Package:</strong>
                                {{ $booking->package?->translation?->title ?? '—' }}
                            </p>

                            <p><strong>Travel Dates:</strong>
                                {{ \Carbon\Carbon::parse($booking?->travel_start_date)->format('d M Y') }}
                                →
                                {{ \Carbon\Carbon::parse($booking?->travel_end_date)->format('d M Y') }}
                            </p>

                            <p><strong>Total Travellers:</strong>
                                {{ $booking?->total_person }}
                            </p>

                            <p><strong>Total Amount Paid:</strong>
                                {{ $booking?->booking_currency }}
                                {{ number_format($booking?->booking_total_amount, 2) }}
                            </p>

                            <hr>

                            <p style="color:#555;">
                                We hope you had a wonderful experience with us.
                                Your feedback means a lot and helps us improve our services.
                            </p>

                            <p>
                                If you have any questions or need assistance with future bookings,
                                feel free to reach out to our support team anytime.
                            </p>

                            <br>

                            <p>
                                Warm regards,<br>
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
