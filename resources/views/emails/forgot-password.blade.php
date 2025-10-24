<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Hello {{ $name }},</h2>
    <p>You are receiving deepak this email because we received a password reset request for your account.</p>
    <p>
        <a href="{{ $url }}" style="display:inline-block;padding:10px 20px;background:#3490dc;color:#fff;text-decoration:none;border-radius:5px;">
            Reset Password
        </a>
    </p>
    <p>If you did not request a password reset, no further action is required.</p>
    <p>Regards,<br>Your Company Name</p>
</body>
</html>
