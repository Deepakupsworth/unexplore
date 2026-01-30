<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class BookingSnapshot extends Model
{
    protected $fillable = ['booking_id', 'snapshot_json'];

    protected $casts = [
        'snapshot_json' => 'array',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
