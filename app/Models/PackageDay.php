<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class PackageDay extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_id',
        'day_number',
        'city_id',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function items()
    {
        return $this->hasMany(PackageDayItem::class);
    }
}
