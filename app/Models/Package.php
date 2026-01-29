<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Package extends Model
{
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
        return $this->hasOne(PackageAvailability::class);
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
    public function category()
    {
        return $this->belongsTo(Category::class)
            ->where('type', 'package');
    }


    public function thumb()
    {
        return $this->morphOne(Image::class, 'imageable')->where('role', 'thumb');
    }

    public function gallery()
    {
        return $this->morphMany(Image::class, 'imageable')->where('role', 'gallery');
    }


    public function scopeOrderByPrice($query, $direction = 'asc')
    {
        return $query->orderBy(
            Package::select('per_person_price')
                ->join('package_prices', 'packages.id', '=', 'package_prices.package_id')
                ->whereColumn('package_prices.package_id', 'packages.id'),
            $direction
        );
    }

    public function subtitle()
    {
        if ($this->days->isEmpty()) {
            return '';
        }

        return $this->days
            ->groupBy('city_id')
            ->map(function ($days, $cityId) {
                $cityName = optional($days->first()->city)->name;
                $nights   = $days->count();
                $daysCnt  = $nights + 1;

                return "{$nights}N {$cityName} • {$daysCnt}D";
            })
            ->values()
            ->join(' ');
    }

    public function getTitleAttribute()
    {
        return $this->translations
            ->firstWhere('language_code', app()->getLocale())
            ?->title
            ?? $this->translations
            ->firstWhere('language_code', config('app.fallback_locale'))
            ?->title
            ?? '';
    }




}
