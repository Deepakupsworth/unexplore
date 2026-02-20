<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Event extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'slug',

        // Dates & Time
        'start_date',
        'end_date',
        'opening_days',
        'opening_time',
        'closing_time',

        // Relations
        'city_id',
        'category_id',

        // Meta
        'capacity',
        'status',
        'location',

        // Map
        'latitude',
        'longitude',

        // Media / URLs
        'video_url',
        'url',
    ];

    // City
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Translations
    public function translations()
    {
        return $this->hasMany(EventTranslation::class);
    }

    //translation
    public function translation()
    {
        $lang = current_lang() ?? 'en';

        return $this->hasOne(EventTranslation::class, 'event_id')
            ->whereIn('language_code', [$lang, 'en'])
            ->orderByRaw("language_code = '{$lang}' desc");
    }


    // English shortcut
    public function en()
    {
        return $this->hasOne(EventTranslation::class)->where('language_code', 'en');
    }

    // Images (polymorphic)
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function thumb()
    {
        return $this->morphOne(Image::class, 'imageable')->where('role', 'thumb');
    }

    public function gallery()
    {
        return $this->morphMany(Image::class, 'imageable')->where('role', 'gallery');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // OLD HISTORY SAFE
    public function packageDayItems()
    {
        return $this->hasMany(PackageDayItem::class, 'item_id')
            ->where('item_type', 'event');
    }

    public function eventCategories()
    {
        return $this->hasMany(EventCategory::class);
    }

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'category_event',
            'event_id',
            'category_id'
        );
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function seo()
    {
        return $this->morphMany(SeoMeta::class, 'metaable');
    }

    public function seoMeta($languageId = null)
    {
        $language_code ??= app()->getLocale();

        return $this->seo()
            ->where('language_code', $language_code)
            ->first();
    }



}
