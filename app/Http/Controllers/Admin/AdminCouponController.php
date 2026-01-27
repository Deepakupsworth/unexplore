<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Category;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCouponController extends Controller
{
    /* ================= LIST ================= */
    public function index()
    {
        $coupons = Coupon::latest()->paginate(20);
        return view('backend.coupon.index', compact('coupons'));
    }

    /* ================= CREATE ================= */
    public function create()
    {
        return view('backend.coupon.create', [
            'categories' => Category::with('translation')->where('type','package')->get(),
            'packages'   => Package::with('translation')->get(),
        ]);
    }

    /* ================= STORE ================= */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'nullable|string',
            'discount_type'    => 'required|in:amount,percentage',
            'discount_value'   => 'required|numeric|min:1',
            'max_discount'     => 'nullable|numeric|min:1',
            'applies_to'       => 'required|in:all,category,package',
            'category_ids'     => 'nullable|array',
            'package_ids'      => 'nullable|array',
            'starts_at'        => 'nullable|date',
            'ends_at'          => 'nullable|date|after_or_equal:starts_at',
            'usage_limit'      => 'nullable|integer|min:1',
            'usage_per_user'   => 'nullable|integer|min:1',
        ]);

        $data['code'] = strtoupper('FIN' . Str::random(6));
        $data['is_active'] = true;

        $coupon = Coupon::create($data);

        // relations
        if ($data['applies_to'] === 'category') {
            $coupon->categories()->sync($data['category_ids'] ?? []);
        }

        if ($data['applies_to'] === 'package') {
            $coupon->packages()->sync($data['package_ids'] ?? []);
        }

        return redirect()
            ->route('coupon.index')
            ->with('success', 'Coupon created successfully');
    }

    /* ================= EDIT ================= */
    public function edit(Coupon $coupon)
    {
        return view('backend.coupon.edit', [
            'coupon'     => $coupon,
            'categories' => Category::where('type','package')->get(),
            'packages'   => Package::with('translation')->get(),
        ]);
    }

    /* ================= UPDATE ================= */
    public function update(Request $request, Coupon $coupon)
    {
        $data = $request->validate([
            'title'            => 'nullable|string',
            'discount_type'    => 'required|in:amount,percentage',
            'discount_value'   => 'required|numeric|min:1',
            'max_discount'     => 'nullable|numeric|min:1',
            'applies_to'       => 'required|in:all,category,package',
            'category_ids'     => 'nullable|array',
            'package_ids'      => 'nullable|array',
            'starts_at'        => 'nullable|date',
            'ends_at'          => 'nullable|date|after_or_equal:starts_at',
            'usage_limit'      => 'nullable|integer|min:1',
            'usage_per_user'   => 'nullable|integer|min:1',
            'is_active'        => 'required|boolean',
        ]);

        $coupon->update($data);

        // reset & sync relations
        $coupon->categories()->detach();
        $coupon->packages()->detach();

        if ($data['applies_to'] === 'category') {
            $coupon->categories()->sync($data['category_ids'] ?? []);
        }

        if ($data['applies_to'] === 'package') {
            $coupon->packages()->sync($data['package_ids'] ?? []);
        }

        return redirect()
            ->route('coupon.index')
            ->with('success', 'Coupon updated successfully');
    }

    /* ================= DELETE ================= */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()
            ->route('coupon.index')
            ->with('success', 'Coupon deleted');
    }

    public function status(Coupon $coupon)
    {
        $coupon->update([
            'is_active' => !$coupon->is_active
        ]);

        return back()->with('success', 'Coupon status updated successfully');
    }


}
