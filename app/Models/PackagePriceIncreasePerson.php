<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class PackagePriceIncreasePerson extends Model
{
    use HasFactory;
    protected $table = 'package_price_increase_persons';

    protected $fillable = [
        'package_id',
        'person_number',
        'additional_price',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
