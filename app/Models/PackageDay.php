<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\PackageDayItem;
use App\Models\PackageDayItemOption;

class PackageDay extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_id',
        'day_number',
        'city_id',
    ];

    protected $touches = ['package'];

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

    public function options()
    {
        return $this->hasMany(PackageDayItemOption::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($day) {
            $day->items()->delete();
        });
    }
}
