<?php

namespace App\Models;

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
    ];

    /* ================= RELATIONS ================= */

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

    public function dayItems()
    {
        return $this->hasManyThrough(
            BookingDayItem::class,
            BookingDay::class
        );
    }
}
