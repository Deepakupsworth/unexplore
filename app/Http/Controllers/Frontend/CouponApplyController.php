<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Category;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CouponApplyController extends Controller
{

    public function apply(Request $request)
    {
        try {

            /* ================= VALIDATION ================= */
            $request->validate([
                'code'       => 'required',
                'package_id' => 'required|exists:packages,id',
            ]);

            /* ================= COUPON ================= */
            $coupon = Coupon::with(['categories', 'packages', 'usages'])
                ->where('code', $request->code)
                ->where('is_active', true)
                ->first();

            if (!$coupon) {
                return response()->json([
                    'message' => 'Invalid coupon'
                ], 422);
            }

            /* ================= DATE CHECK ================= */
            if (
                ($coupon->starts_at && now()->lt($coupon->starts_at)) ||
                ($coupon->ends_at && now()->gt($coupon->ends_at))
            ) {
                return response()->json([
                    'message' => 'Coupon expired'
                ], 422);
            }

            /* ================= PACKAGE ================= */
            $package = Package::with('category')->find($request->package_id);

            if (!$package) {
                return response()->json([
                    'message' => 'Package not found'
                ], 422);
            }

            /* ================= SCOPE VALIDATION ================= */

            if (
                $coupon->applies_to === 'category' &&
                (!$package->category_id ||
                    !$coupon->categories->pluck('id')->contains($package->category_id))
            ) {
                return response()->json([
                    'message' => 'Coupon not valid for this category'
                ], 422);
            }

            if (
                $coupon->applies_to === 'package' &&
                !$coupon->packages->pluck('id')->contains($package->id)
            ) {
                return response()->json([
                    'message' => 'Coupon not valid for this package'
                ], 422);
            }

            /* ================= USAGE LIMIT ================= */

            if (
                $coupon->usage_limit &&
                $coupon->usages->count() >= $coupon->usage_limit
            ) {
                return response()->json([
                    'message' => 'Coupon usage limit reached'
                ], 422);
            }

            if (
                auth()->check() &&
                $coupon->usage_per_user &&
                $coupon->usages
                ->where('user_id', auth()->id())
                ->count() >= $coupon->usage_per_user
            ) {
                return response()->json([
                    'message' => 'Coupon already used'
                ], 422);
            }

            /* ================= PRICE SOURCE ================= */
            // IMPORTANT: avoid $package->price crash
            $checkout = session('checkout');

            // print_r($checkout );die;
            if (
                !$checkout ||
                !isset($checkout['pricing']) ||
                !isset($checkout['pricing']['final_total'])
            ) {
                return response()->json([
                    'message' => 'Checkout session expired'
                ], 422);
            }

            $basePrice = (float) $checkout['pricing']['final_total'];

            /* ================= DISCOUNT ================= */
            if ($coupon->discount_type === 'percentage') {
                $discount = ($basePrice * $coupon->discount_value) / 100;
            } else {
                $discount = $coupon->discount_value;
            }

            if ($coupon->max_discount) {
                $discount = min($discount, $coupon->max_discount);
            }

            return response()->json([
                'coupon_id'     => $coupon->id,
                'code'          => $coupon->code,
                'discount_text' => $coupon->discount_text,
                'discount'      => round($discount, 2),
                'final_price'   => max(0, $basePrice - $discount),
            ]);
        } catch (\Throwable $e) {

            // 🔥 LOG REAL ERROR (for debugging)
            Log::error('Coupon Apply Error', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
            ]);

            // 🔒 SAFE JSON RESPONSE (no HTML)
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
