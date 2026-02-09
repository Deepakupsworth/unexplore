<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class NewsletterController extends Controller
{
    /**
     * Subscribe to newsletter
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        try {
            $subscriber = NewsletterSubscriber::where('email', $request->email)->first();

            // Already subscribed & active
            if ($subscriber && $subscriber->is_active) {
                return back()->with('info', 'You are already subscribed.');
            }

            // Exists but inactive → reactivate
            if ($subscriber && !$subscriber->is_active) {
                $subscriber->update([
                    'is_active'        => true,
                    'subscribed_at'    => now(),
                    'unsubscribed_at'  => null,
                ]);

                return back()->with('success', 'Subscription reactivated successfully.');
            }

            // New subscription
            NewsletterSubscriber::create([
                'email'          => $request->email,
                'is_active'      => true,
                'subscribed_at'  => now(),
            ]);

            return back()->with('success', 'Subscribed successfully.');
        } catch (Throwable $e) {

            Log::error('Newsletter subscribe failed', [
                'email' => $request->email,
                'error' => $e->getMessage(),
                'file'  => $e->getFile(),
                'line'  => $e->getLine(),
            ]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Unsubscribe from newsletter
     */
    public function unsubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:newsletter_subscribers,email',
        ]);

        try {
            NewsletterSubscriber::where('email', $request->email)
                ->update([
                    'is_active'        => false,
                    'unsubscribed_at'  => now(),
                ]);

            return back()->with('success', 'You have been unsubscribed successfully.');
        } catch (Throwable $e) {

            Log::error('Newsletter unsubscribe failed', [
                'email' => $request->email,
                'error' => $e->getMessage(),
            ]);

            return back()->with('error', 'Unable to unsubscribe at the moment.');
        }
    }
}
