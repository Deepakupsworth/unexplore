@extends('emails.layouts.master')

@section('title', 'Welcome to Unxplord Saudi')

@section('content')

    <h2 style="margin-top:0;color:#0a6b3c;font-size:22px;">
        Welcome to Unxplord Saudi 🎉
    </h2>

    <p style="font-size:14px;color:#4b5563;">
        Hello <strong>{{ $user->first_name }}</strong>,
    </p>

    <p style="font-size:14px;color:#4b5563;line-height:1.6;">
        Your account has been successfully created. You can now explore amazing travel
        experiences across Saudi Arabia.
    </p>

    <!-- INFO BOX -->
    {{-- <table width="100%" cellpadding="0" cellspacing="0" style="background:#f1f5f9;border-radius:8px;margin:20px 0;">
        <tr>
            <td style="padding:16px;font-size:14px;color:#334155;">

                <strong>Email:</strong> {{ $user->email }}<br>
                <strong>Status:</strong> Active

            </td>
        </tr>
    </table> --}}

    <!-- CTA BUTTON -->
    <table width="100%" cellpadding="0" cellspacing="0" style="margin:24px 0;">
        <tr>
            <td align="center">

                <a href="{{ url('/') }}"
                    style="background:#0a6b3c;color:#ffffff;text-decoration:none;
          padding:12px 26px;border-radius:999px;
          font-size:14px;font-weight:600;display:inline-block;">
                    Explore Now
                </a>

            </td>
        </tr>
    </table>

    <p style="font-size:13px;color:#6b7280;margin-top:24px;">
        If you did not create this account, please contact our support team immediately.
    </p>

    <p style="font-size:14px;margin-top:24px;">
        Warm regards,<br>
        <strong>Unxplord Saudi Team</strong>
    </p>

@endsection
