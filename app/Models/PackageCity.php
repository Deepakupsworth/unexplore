<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class PackageCity extends Model
{
    use HasFactory;
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


    public function translations()
    {
        return $this->hasMany(PackageTranslation::class);
    }
}
