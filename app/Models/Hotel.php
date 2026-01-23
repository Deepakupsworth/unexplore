<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Hotel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'city_id',
        'location',
        'latitude',
        'longitude',
        'email',
        'phone',
        'star_rating',
        'has_meal',
        'status',
    ];

    public function translation()
    {
        return $this->hasOne(HotelTranslation::class)
            ->where('language_code', current_lang());
    }

    public function translations()
    {
        return $this->hasMany(HotelTranslation::class);
    }

    // Polymorphic Images
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function thumb()
    {
        return $this->morphOne(Image::class, 'imageable')
            ->where('role', 'thumb');
    }

    public function gallery()
    {
        return $this->morphMany(Image::class, 'imageable')
            ->where('role', 'gallery');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
