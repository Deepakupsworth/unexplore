<form method="POST" action="{{ route('register') }}">
    @csrf
    <input name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

    <select name="role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select>

    <button type="submit">Register</button>
</form>
@if($errors->any()) <div>{{ $errors->first() }}</div> @endif
