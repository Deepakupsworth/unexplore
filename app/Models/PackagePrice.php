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

    protected $touches = ['package'];


    public function package()
    {
        return $this->belongsTo(Package::class);
    }

   // PackagePrice.php
    public function increasePersons()
    {
        return $this->hasMany(
            PackagePriceIncreasePerson::class,
            'package_id',
            'package_id'
        );
    }

    public function childPrices()
    {
        return $this->hasMany(
            PackageChildPrice::class,
            'package_id',
            'package_id'
        );
    }

}
