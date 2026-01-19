<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Package extends Model{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'slug',
        'status',
        'package_type',
        'duration_days',
        'duration_nights',
        'base_persons',
        'max_persons',
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    
    

    public function thumb()
    {
        return $this->morphOne(Image::class, 'imageable')
            ->where('role', 'thumb');
    }


    /* ================= TRANSLATIONS ================= */
    public function translations()
    {
        return $this->hasMany(PackageTranslation::class);
    }

    public function translation()
    {
        return $this->hasOne(PackageTranslation::class)
            ->where('language_code', app()->getLocale());
    }

    /* ================= AVAILABILITY ================= */
    public function availabilities()
    {
        return $this->hasMany(PackageAvailability::class);
    }

    /* ================= CITIES (🔥 MISSING RELATION) ================= */
    public function cities()
    {
        return $this->hasMany(PackageCity::class);
    }

    /* ================= ITINERARY ================= */
    public function days()
    {
        return $this->hasMany(PackageDay::class);
    }

    /* ================= PRICING ================= */
    public function price()
    {
        return $this->hasOne(PackagePrice::class);
    }

    public function priceIncreasePersons()
    {
        return $this->hasMany(PackagePriceIncreasePerson::class);
    }

    public function childPrices()
    {
        return $this->hasMany(PackageChildPrice::class);
    }

    /* ================= INFO ================= */
    public function infos()
    {
        return $this->hasMany(PackageInfo::class);
    }
}
