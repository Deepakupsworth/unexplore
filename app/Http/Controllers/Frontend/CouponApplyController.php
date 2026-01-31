<?php
namespace App\Http\Controllers\Frontend;

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
        $request->validate([
            'code'       => 'required',
            'package_id' => 'required|exists:packages,id',
        ]);

        $coupon = Coupon::where('code', $request->code)
            ->where('is_active', true)
            ->first();

        if (!$coupon) {
            return response()->json(['message' => 'Invalid coupon'], 422);
        }

        // date check
        if (
            ($coupon->starts_at && now()->lt($coupon->starts_at)) ||
            ($coupon->ends_at && now()->gt($coupon->ends_at))
        ) {
            return response()->json(['message' => 'Coupon expired'], 422);
        }

        $package = Package::with('category')->findOrFail($request->package_id);

        /* ================= Scope Validation ================= */

        if ($coupon->applies_to === 'category' &&
            !$coupon->categories->contains($package->category_id)) {
            return response()->json(['message' => 'Coupon not valid for this category'], 422);
        }

        if ($coupon->applies_to === 'package' &&
            !$coupon->packages->contains($package->id)) {
            return response()->json(['message' => 'Coupon not valid for this package'], 422);
        }

        /* ================= Usage Limits ================= */

        if ($coupon->usage_limit &&
            $coupon->usages()->count() >= $coupon->usage_limit) {
            return response()->json(['message' => 'Coupon usage limit reached'], 422);
        }

        if (
            auth()->check() &&
            $coupon->usage_per_user &&
            $coupon->usages()
                ->where('user_id', auth()->id())
                ->count() >= $coupon->usage_per_user
        ) {
            return response()->json(['message' => 'Coupon already used'], 422);
        }

        /* ================= Discount Calculation ================= */

        $discount = $coupon->discount_type === 'percentage'
            ? ($package->price * $coupon->discount_value / 100)
            : $coupon->discount_value;

        if ($coupon->max_discount) {
            $discount = min($discount, $coupon->max_discount);
        }

        return response()->json([
            'coupon_id'     => $coupon->id,
            'code'          => $coupon->code,
            'discount_text' => $coupon->discount_text,
            'discount'      => round($discount, 2),
            'final_price'   => max(0, $package->price - $discount),
        ]);
    }
}
