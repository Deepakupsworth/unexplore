<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageAvailability extends Model
{
    protected $fillable = [
        'package_id',
        'available_from',
        'available_to',
        'booking_start_date',
        'booking_end_date',
    ];

    protected $casts = [
        'available_from' => 'date',
        'available_to' => 'date',
        'booking_start_date' => 'date',
        'booking_end_date' => 'date',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
