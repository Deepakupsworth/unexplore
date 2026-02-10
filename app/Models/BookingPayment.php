<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\PaymentStatus;
use App\Enums\PaymentMethod;

class BookingPayment extends Model
{
    use HasFactory;

    protected $table = 'booking_payments';

    protected $fillable = [
        'booking_id',
        'payment_method',
        'bank_name', 
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
        // 'payment_method' => PaymentMethod::class,
        // 'status' => PaymentStatus::class,
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
