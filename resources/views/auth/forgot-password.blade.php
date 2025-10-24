<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>

    @if (session('status'))
        <div style="color: green;">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <input type="email" name="email" placeholder="Enter your email" required>
        @error('email') <div style="color: red;">{{ $message }}</div> @enderror

        <button type="submit">Send Reset Link</button>
    </form>

    <p><a href="{{ route('login') }}">Back to Login</a></p>
</body>
</html>
