<?php

namespace App\Http\Controllers;

use App\Mail\UserRegisteredMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class AuthController extends Controller
{
    /* =========================
     | REGISTER
     ========================= */
    public function showRegister()
    {
        return view('auth.register');
    }

    // public function register(Request $request)
    // {
    //     $validated = $request->validate([
    //         'first_name' => 'required|string|max:50',
    //         'last_name'  => 'required|string|max:50',
    //         'email'      => 'required|email|unique:users,email',
    //         'password'   => 'required|min:8|confirmed',
    //         'terms'      => 'accepted',
    //     ], [
    //         'terms.accepted' => 'You must accept the Terms & Conditions',
    //     ]);

    //     try {
    //         DB::beginTransaction();

    //         User::create([
    //             'first_name'      => $validated['first_name'],
    //             'last_name'       => $validated['last_name'],
    //             'email'           => $validated['email'],
    //             'password'        => Hash::make($validated['password']),
    //             'role'            => 'user',
    //             'terms_accepted'  => true,
    //         ]);

    //         DB::commit();

    //         return redirect()
    //             ->route('login')
    //             ->with('success', 'Account created successfully! Please login.');

    //     } catch (Throwable $e) {
    //         DB::rollBack();

    //         Log::error('Register failed', [
    //             'error' => $e->getMessage(),
    //         ]);

    //         return back()
    //             ->withInput()
    //             ->with('error', 'Something went wrong. Please try again.');
    //     }
    // }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:8|confirmed',
            'terms'      => 'accepted',
        ], [
            'terms.accepted' => 'You must accept the Terms & Conditions',
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'first_name'     => $validated['first_name'],
                'last_name'      => $validated['last_name'],
                'email'          => $validated['email'],
                'password'       => Hash::make($validated['password']),
                'role'           => 'user',
                'terms_accepted' => true,
            ]);

            DB::commit();

            // ✅ SEND MAIL (safe)
            try {
                Mail::to($user->email)->send(new UserRegisteredMail($user));
            } catch (\Throwable $e) {
                Log::warning('Welcome mail failed', [
                    'error' => $e->getMessage()
                ]);
            }

            return redirect()
                ->route('login')
                ->with('success', 'Account created successfully! Please login.');

        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Register failed', [
                'error' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    /* =========================
     | LOGIN / LOGOUT
     ========================= */
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        try {
            if (!Auth::attempt($credentials)) {
                return back()->with('error', 'Invalid email or password');
            }

            $request->session()->regenerate();

            $user = Auth::user();

            return $user->role === 'admin'
            ? redirect()->route('admin.dashboard')->with('success', 'Welcome back ' . $user->first_name . ' 👋')
            : redirect()->intended(route('home'))->with('success', 'Welcome back ' . $user->first_name . ' 👋');

        } catch (Throwable $e) {
            Log::error('Login failed', ['error' => $e->getMessage()]);

            return back()->with('error', 'Unable to login. Try again later.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /* =========================
     | PASSWORD RESET
     ========================= */
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        try {
            $status = Password::sendResetLink($request->only('email'));

            return $status === Password::RESET_LINK_SENT
                ? back()->with('success', __($status))
                : back()->withErrors(['email' => __($status)]);

        } catch (Throwable $e) {
            Log::error('Password reset link failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'Unable to send reset link.');
        }
    }

    public function showResetForm($token)
    {
        return view('auth.reset-password', compact('token'));
    }

    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        try {
            $status = Password::reset(
                $validated,
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password),
                    ])->save();
                }
            );

            return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('success', __($status))
                : back()->withErrors(['email' => __($status)]);

        } catch (Throwable $e) {
            Log::error('Password reset failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'Unable to reset password.');
        }
    }

    /* =========================
     | PROFILE
     ========================= */
    public function profile()
    {
        return view('backend.pages.profile', [
            'user' => Auth::user()
        ]);
    }

    public function editProfile()
    {
        return view('profile_edit', [
            'user' => Auth::user()
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'     => 'required|string|max:100',
            'password' => 'nullable|confirmed|min:8',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $user->name = $validated['name'];

            if (!empty($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }

            if ($request->hasFile('image')) {
                if ($user->image) {
                    Storage::disk('public')->delete('profile/' . $user->image);
                }

                $path = $request->file('image')->store('profile', 'public');
                $user->image = basename($path);
            }

            $user->save();

            DB::commit();

            return back()->with('success', 'Profile updated successfully!');

        } catch (Throwable $e) {
            DB::rollBack();

            Log::error('Profile update failed', ['error' => $e->getMessage()]);

            return back()->with('error', 'Unable to update profile.');
        }
    }

    /* =========================
     | CONTACT FORM
     ========================= */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'first_name'  => 'required|string',
            'last_name'   => 'required|string',
            'email'       => 'nullable|email',
            'phone'       => 'required|string',
            'subject'     => 'required|string',
            'message_new' => 'nullable|string',
        ]);

        try {
            Mail::send('emails.contact-mail', $validated, function ($msg) {
                $msg->to(config('mail.from.address'))
                    ->subject('New Contact Form Submission');
            });

            return back()->with('success', 'Your message has been sent successfully!');

        } catch (Throwable $e) {
            Log::error('Contact mail failed', ['error' => $e->getMessage()]);

            return back()->with('error', 'Unable to send message.');
        }
    }
}
