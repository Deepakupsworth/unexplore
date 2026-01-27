<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'creator_type',
        'code',
        'discount_type',
        'discount_value',
        'is_global',
        'total_usage_limit',
        'per_user_limit',
        'used_count',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'is_global' => 'boolean',
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * Coupon applies to many packages
     */
    public function packages()
    {
        return $this->belongsToMany(
            Package::class,
            'coupon_packages'
        )->withTimestamps();
    }

    /**
     * Coupon creator (admin user)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
