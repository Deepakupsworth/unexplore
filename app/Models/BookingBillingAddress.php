<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingBillingAddress extends Model
{
    protected $fillable = [
        'booking_id',
        'user_id',
        'full_name',
        'phone',
        'email',
        'address_line1',
        'city',
        'postal_code',
        'country_code',
        'company_name',
        'gst_number',
    ];

    /* ================= RELATIONS ================= */

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
