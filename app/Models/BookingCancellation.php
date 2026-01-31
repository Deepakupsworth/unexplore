<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingCancellation extends Model
{
    use HasFactory;

    protected $table = 'booking_cancellations';

    protected $fillable = [
        'booking_id',
        'type',
        'currency',
        'refund_amount',
        'refund_status',
        'reason',
        'note',
        'policy_snapshot_json',
        'cancelled_by',
    ];

    protected $casts = [
        'refund_amount'        => 'decimal:2',
        'policy_snapshot_json'=> 'array',
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

    public function scopeRefundPending($query)
    {
        return $query->where('refund_status', 'pending');
    }

    public function scopeRefundProcessed($query)
    {
        return $query->where('refund_status', 'processed');
    }
}
