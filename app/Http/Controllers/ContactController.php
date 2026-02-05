<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactController extends Controller
{
    /**
     * Store contact form submission
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'nullable|email|max:255',
            'phone'      => 'required|string|max:20',
            'subject'    => 'required|string|max:255',
            'message'    => 'nullable|string',
        ]);

        // ✅ Save always
        $contact = ContactMessage::create([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'email'      => $validated['email'] ?? null,
            'phone'      => $validated['phone'],
            'subject'    => $validated['subject'],
            'message'    => $validated['message'] ?? null,
            'status'     => 'new',
        ]);

        // 📬 Try mail (non-blocking UX)
        try {
            Mail::send('emails.contact-mail', $validated, function ($msg) {
                $msg->from(
                    config('mail.from.address'),
                    config('mail.from.name')
                )
                    ->to(config('mail.from.address'))
                    ->subject('New Contact Form Submission');
            });
        } catch (\Throwable $e) {
            Log::error('Contact mail failed', [
                'error' => $e->getMessage()
            ]);
        }

        return back()->with('success', __('contact.form.success'));
    }
}
