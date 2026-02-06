<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'first_name' => 'required|string|max:255',
    //         'last_name'  => 'required|string|max:255',
    //         'email'      => 'nullable|email|max:255',
    //         'phone'      => 'required|string|max:20',
    //         'subject'    => 'required|string|max:255',
    //         'message'    => 'nullable|string',
    //     ]);

    //     // ✅ Save first (important)
    //     $contact = ContactMessage::create($validated + [
    //         'status' => 'new',
    //     ]);

    //     // 📬 Send mail (same pattern as booking)
    //     // try {

    //         Mail::to(config('mail.from.address'))
    //             ->send(new ContactMessageMail($contact));
    //     // } catch (\Throwable $e) {
    //     //     Log::error('Contact mail failed', [
    //     //         'error' => $e->getMessage(),
    //     //     ]);
    //     // }

    //     return back()->with('success', __('contact.form.success'));
    // }


    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name'  => 'required|string|max:255',
                'email'      => 'nullable|email|max:255',
                'phone'      => 'required|string|max:20',
                'subject'    => 'required|string|max:255',
                'message'    => 'nullable|string',
            ]);

            $contact = ContactMessage::create([
                'first_name' => $validated['first_name'],
                'last_name'  => $validated['last_name'],
                'email'      => $validated['email'] ?? null,
                'phone'      => $validated['phone'],
                'subject'    => $validated['subject'],
                'message'    => $validated['message'] ?? null,
                'status'     => 'new',
            ]);

            // 📩 Mail (safe)
            try {
                Mail::to(config('mail.from.address'))
                    ->send(new \App\Mail\ContactMessageMail($contact));
            } catch (\Throwable $e) {
                Log::error('Contact mail failed', ['error' => $e->getMessage()]);
            }

            return response()->json([
                'success' => true,
                'message' => __('contact.form.success'),
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            Log::error('Contact form failed', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => __('contact.form.error'),
            ], 500);
        }
    }
}
