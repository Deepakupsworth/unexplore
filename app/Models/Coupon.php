<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'title',
        'discount_type',
        'discount_value',
        'max_discount',
        'applies_to',
        'starts_at',
        'ends_at',
        'usage_limit',
        'usage_per_user',
        'is_active',
    ];

    protected $casts = [
        'starts_at' => 'date',
        'ends_at'   => 'date',
        'is_active' => 'boolean',
    ]; 

    /* ================= Relations ================= */

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'coupon_categories');
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'coupon_packages');
    }

    public function usages()
    {
        return $this->hasMany(CouponUsage::class);
    }

    /* ================= UI One-Line Text ================= */

    public function getDiscountTextAttribute()
    {
        if ($this->discount_type === 'percentage') {
            return "{$this->discount_value}% OFF" .
                ($this->max_discount ? " up to ₹{$this->max_discount}" : '');
        }

        return "Flat ₹{$this->discount_value} OFF";
    }
}
