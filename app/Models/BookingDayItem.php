<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingDayItem extends Model
{
    use HasFactory;

    protected $table = 'booking_day_items';

    protected $fillable = [
        'booking_day_id',
        'item_type',
        'original_item_id',
        'title',
        'description',
        'start_time',
        'end_time',
        'sort_order',
        'extra_price',
        'is_optional',
        'is_selected',
        'meta_json',
    ];

    protected $casts = [
        'start_time'  => 'datetime:H:i',
        'end_time'    => 'datetime:H:i',
        'extra_price' => 'decimal:2',
        'is_optional' => 'boolean',
        'is_selected' => 'boolean',
        'meta_json'   => 'array',
    ];

    /**
     * Parent booking day
     */
    public function day()
    {
        return $this->belongsTo(BookingDay::class, 'booking_day_id');
    }

    /* =====================
       Helpful scopes
       ===================== */

    public function scopeSelected($query)
    {
        return $query->where('is_selected', true);
    }

    public function scopeOptional($query)
    {
        return $query->where('is_optional', true);
    }
}
