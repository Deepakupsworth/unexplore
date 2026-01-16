<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackagePriceIncreasePerson extends Model
{
    protected $table = 'package_price_increase_persons';

    protected $fillable = [
        'package_id',
        'person_number',
        'additional_price',
    ];
}
