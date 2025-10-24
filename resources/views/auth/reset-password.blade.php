<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>

    @if (session('status'))
        <div style="color: green;">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <input type="email" name="email" placeholder="Email" value="{{ request('email') }}" required>
        @error('email') <div style="color: red;">{{ $message }}</div> @enderror

        <input type="password" name="password" placeholder="New Password" required>
        @error('password') <div style="color: red;">{{ $message }}</div> @enderror

        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

        <button type="submit">Reset Password</button>
    </form>

    <p><a href="{{ route('login') }}">Back to Login</a></p>
</body>
</html>
