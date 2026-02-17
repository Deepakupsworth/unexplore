<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /** @use HasFactory<\Database\Factories\CityFactory> */
    use HasFactory;
    protected $fillable = [
        'country_id',
        'slug',
        'thumb_image',
        'category_id',
        'video_url',
    ];

    public function translations()
    {
        return $this->hasMany(CityTranslation::class);
    }

    public function translation()
    {
        return $this->hasOne(CityTranslation::class)->where('language_code', 'en');
    }

    public function translationData()
    {
        $lang = current_lang() ?? 'en';
        return $this->hasOne(CityTranslation::class)
            ->where('language_code', $lang);
    }

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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function things()
    {
        return $this->hasMany(ThingToDo::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function packageCities()
    {
        return $this->hasMany(PackageCity::class);
    }

    // ✅ MAIN RELATION (MULTI CATEGORY)
    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'city_category',
            'city_id',
            'category_id'
        );
    }

    public function categoryNames()
    {
        return $this->categories
            ->map(fn($cat) => $cat->translationData?->name)
            ->filter()
            ->implode(', ');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

}
