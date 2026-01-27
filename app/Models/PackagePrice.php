<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class PackagePrice extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_id',
        'currency',
        'original_price',
        'discount_price',
        'per_person_price',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function increasePersons()
    {
        return $this->hasMany(PackagePriceIncreasePerson::class);
    }

    public function childPrices()
    {
        return $this->hasMany(PackageChildPrice::class);
    }
}
