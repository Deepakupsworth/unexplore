<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingPayment extends Model
{
    use HasFactory;

    protected $table = 'booking_payments';

    protected $fillable = [
        'booking_id',
        'payment_method',
        'transaction_id',
        'gateway_reference',
        'currency',
        'amount',
        'status',
        'payload_json',
    ];

    protected $casts = [
        'amount'       => 'decimal:2',
        'payload_json' => 'array',
    ];

    /**
     * Parent booking
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /* =====================
       Helpful scopes
       ===================== */

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }
}
