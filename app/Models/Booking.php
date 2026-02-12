<?php

namespace App\Models;

use App\Enums\BookingStatus;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;


    protected $fillable = [
        'booking_code',
        'user_id',
        'package_id',

        'status',
        'payment_status',

        'base_currency',
        'booking_currency',

        'base_total_amount',
        'exchange_rate',
        'booking_total_amount',

        'coupon_code',
        'coupon_discount',

        'travel_start_date',
        'travel_end_date',

        'total_person',
        'total_adult',
        'total_child',
    ];

    protected $casts = [
        'base_total_amount'    => 'decimal:2',
        'exchange_rate'        => 'decimal:6',
        'booking_total_amount' => 'decimal:2',

        'travel_start_date' => 'date',
        'travel_end_date'   => 'date',
        'snapshot_json' => 'array',

        'payment_status' => PaymentStatus::class,
        'status' => BookingStatus::class,
    ];

    /* ================= RELATIONS ======s=========== */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function travellers()
    {
        return $this->hasMany(BookingTraveller::class);
    }

    public function snapshot()
    {
        return $this->hasOne(BookingSnapshot::class);
    }

    public function days()
    {
        return $this->hasMany(BookingDay::class);
    }
    public function dayItems()
    {
        return $this->hasMany(BookingDayItem::class);
    }

    public function payments()
    {
        return $this->hasMany(\App\Models\BookingPayment::class);
    }
}
