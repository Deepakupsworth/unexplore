<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingTraveller extends Model
{
    use HasFactory;

    protected $table = 'booking_travellers';

    protected $fillable = [
        'booking_id',
        'type',        // adult | child
        'first_name',
        'last_name',
        'gender',
        'dob',
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    /**
     * Parent booking
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /* =====================
       Helpful Scopes
       ===================== */

    public function scopeAdult($query)
    {
        return $query->where('type', 'adult');
    }

    public function scopeChild($query)
    {
        return $query->where('type', 'child');
    }
}
