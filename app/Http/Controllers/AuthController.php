<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show register form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Register logic
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            // 'role' => 'admin'
            'role' => 'required|in:user,admin'
        ]);

        $user = User::create($request->only('name', 'email', 'password', 'role'));

        Auth::login($user);

        return $user->role === 'admin'
            ? redirect('/admin/dashboard')
            : redirect('/user/dashboard');
    }

    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Login logic
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // print_r($user);die;
            return $user->role === 'admin'
                ? redirect('/admin/dashboard')
                : redirect('/user/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    // Forgot password (send reset link)
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    // Reset password form
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // Reset password logic
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill(['password' => Hash::make($password)])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect('/login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function profile()
    {
        $user = Auth::user();
        return view('backend.pages.profile', compact('user'));
    }    
// Show edit profile page
public function editProfile()
{
    $user = Auth::user();
    return view('profile_edit', compact('user'));
}

// Update profile
public function updateProfile(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:100',
        'password' => 'nullable|confirmed|min:6',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Update name
    $user->name = $request->name;

    // Update password if entered
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // Handle profile image upload
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($user->image && file_exists(public_path('uploads/profile/' . $user->image))) {
            unlink(public_path('uploads/profile/' . $user->image));
        }

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/profile'), $imageName);
        $user->image = $imageName;
    }

    $user->save();

    return back()->with('success', 'Profile updated successfully!');
}


}
