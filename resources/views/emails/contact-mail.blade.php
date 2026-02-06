@extends('emails.layouts.master')

@section('title', 'New Contact Message')

@section('content')
    <h2 style="margin-top:0;">📩 New Contact Form Submission</h2>

    <table width="100%" cellpadding="6" cellspacing="0">
        <tr>
            <td><strong>First Name:</strong></td>
            <td>{{ $first_name }}</td>
        </tr>
        <tr>
            <td><strong>Last Name:</strong></td>
            <td>{{ $last_name }}</td>
        </tr>
        <tr>
            <td><strong>Email:</strong></td>
            <td>{{ $email ?? 'Not provided' }}</td>
        </tr>
        <tr>
            <td><strong>Phone:</strong></td>
            <td>{{ $phone }}</td>
        </tr>
        <tr>
            <td><strong>Subject:</strong></td>
            <td>{{ $subject }}</td>
        </tr>
    </table>

    <hr style="margin:20px 0;">

    <p><strong>Message:</strong></p>
    <p style="background:#f4f6f8;padding:15px;border-radius:6px;">
        {{ $user_message ?? 'No message entered' }}
    </p>
@endsection
