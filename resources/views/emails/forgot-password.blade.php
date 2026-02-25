@extends('emails.layouts.app')

@section('title', 'Reset Your Password')

@section('content')

    <h2 style="margin-top:0;color:#111827;">
        Reset Your Password
    </h2>

    <p>
        Hello {{ $name }},
    </p>

    <p>
        You are receiving this email because we received a password reset request
        for your account.
    </p>

    <p style="margin:20px 0;">
        <a href="{{ $url }}"
            style="display:inline-block;padding:12px 22px;background:#16a34a;
              color:#ffffff;text-decoration:none;border-radius:8px;
              font-weight:600;">
            Reset Password
        </a>
    </p>

    <p>
        If you did not request a password reset, no further action is required.
    </p>

    <p style="margin-top:24px;">
        Regards,<br>
        <strong>Unxplord Saudi</strong>
    </p>

@endsection
