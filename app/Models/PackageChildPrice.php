<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class PackageChildPrice extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_id',
        'min_age',
        'max_age',
        'price_type',
        'price_value',
    ];

    
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
