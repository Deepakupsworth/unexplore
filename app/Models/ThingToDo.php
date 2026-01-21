<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ThingToDo extends Model
{
    use HasFactory;

    protected $table = 'things_to_do';

    protected $fillable = [
        'slug',
        'location',
        'city_id',
        'category_id',
        'opening_time',
        'closing_time',
        'latitude',
        'longitude',
    ];

    /* =======================================================
       TRANSLATIONS
    ======================================================= */

    public function translations()
    {
        return $this->hasMany(ThingToDoTranslation::class, 'thing_id');
    }

    public function translation()
    {
        $lang = current_lang() ?? 'en';
        return $this->hasOne(ThingToDoTranslation::class, 'thing_id')
            ->where('language_code', $lang);
    }

    /* =======================================================
       POLYMORPHIC IMAGES (NEW SYSTEM)
    ======================================================= */

    public function images(): MorphMany
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
            ->where('role', 'gallery')
            ->orderBy('sort_order');
    }

    /* =======================================================
       RELATIONS
    ======================================================= */

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
