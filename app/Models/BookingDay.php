<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingDay extends Model
{
    use HasFactory;

    protected $table = 'booking_days';

    protected $fillable = [
        'booking_id',
        'original_day_id',
        'day_number',
        'date',
        'city_id',
        'city_name',
        'meta_json',
    ];

    protected $casts = [
        'date'      => 'date',
        'meta_json' => 'array',
    ];

    /**
     * Parent booking
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Day-wise items
     */
    public function items()
    {
        return $this->hasMany(BookingDayItem::class, 'booking_day_id')
            ->orderBy('sort_order');
    }
}
