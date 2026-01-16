<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageCity extends Model
{
    protected $fillable = [
        'package_id',
        'city_id',
        'nights',
        'sort_order',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
