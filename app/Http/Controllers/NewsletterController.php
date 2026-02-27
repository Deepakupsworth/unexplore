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

            if ($subscriber && $subscriber->is_active) {
                return response()->json([
                    'status'  => 'info',
                    'message' => __('home.already_subscribed')
                ]);
            }

            if ($subscriber && !$subscriber->is_active) {
                $subscriber->update([
                    'is_active'        => true,
                    'subscribed_at'    => now(),
                    'unsubscribed_at'  => null,
                ]);

                return response()->json([
                    'status'  => 'success',
                    'message' => __('home.reactivated')
                ]);
            }

            NewsletterSubscriber::create([
                'email'          => $request->email,
                'is_active'      => true,
                'subscribed_at'  => now(),
            ]);

            return response()->json([
                'status'  => 'success',
                'message' => __('home.subscribed')
            ]);

        } catch (Throwable $e) {

            Log::error('Newsletter subscribe failed', [
                'email' => $request->email,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'status'  => 'error',
                'message' => __('home.server_error')
            ], 500);
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

            return response()->json([
                'status'  => 'success',
                'message' => __('home.unsubscribed')
            ]);

        } catch (Throwable $e) {

            Log::error('Newsletter unsubscribe failed', [
                'email' => $request->email,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'status'  => 'error',
                'message' => __('home.unsubscribe_failed')
            ], 500);
        }
    }

}
