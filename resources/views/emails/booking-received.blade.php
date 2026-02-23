@extends('emails.layouts.app')

@section('title', 'Booking Received')
@section('content')
    <h2 style="color:#f59e0b;">Booking Received</h2>

    <p>
        Hello
        <strong>{{ $booking?->billingAddress?->full_name ?? 'Customer' }}</strong>,
    </p>

    <p>
        We have successfully received your booking request.
        Our team is currently reviewing it.
    </p>

    <p><strong>Booking Code:</strong> {{ $booking->booking_code }}</p>
    <p><strong>Status:</strong> Pending Confirmation</p>

    <p>
        You will receive another email once your booking is confirmed.
    </p>

    <p>
        Thanks & Regards,<br>
        <strong>Unxplord Saudi</strong>
    </p>

@endsection
