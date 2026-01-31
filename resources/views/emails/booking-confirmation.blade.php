<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Booking Confirmed</title>
</head>

<body style="font-family: Arial, sans-serif">

    {{-- @dd($booking) --}}
    <h2>Booking Confirmation 🎉</h2>

    <p>Hello {{ $booking->user->first_name ?? 'Guest' }} {{$booking->user->last_name}},</p>

    <p>Your booking has been successfully placed.</p>

    <hr>

    <p><strong>Booking ID:</strong> {{ $booking->booking_code }}</p>
    <p><strong>Package:</strong> {{ $booking->package->translation->title ?? '' }}</p>
    <p><strong>Total Travellers:</strong> {{ $booking->total_person }}</p>
    <p><strong>Total Amount:</strong> ₹{{ number_format($booking->booking_total_amount) }}</p>
    <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>

    <hr>

    <p>We will update you once payment is completed.</p>

    <p>Thanks & Regards,<br>
        <strong>Your Travel Company</strong>
    </p>

</body>

</html>
