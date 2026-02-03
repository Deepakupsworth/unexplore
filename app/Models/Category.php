<?php

namespace App\Models;

use App\Enums\CategoryType;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $fillable = [
        'slug',
        'type',        // 👈 REQUIRED
        'thumb_image',
        'thumb_icon',
    ];

    protected $casts = [
        'type' => CategoryType::class,
    ];
    /**
     * All translations
     */
    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    /**
     * English translation (default)
     */
    public function translation()
    {
        return $this->hasOne(CategoryTranslation::class)
            ->where('language_code', 'en');
    }

    public function translationData()
    {
        $lang = current_lang() ?? 'en';
        return $this->hasOne(CategoryTranslation::class)
            ->where('language_code', $lang);
    }

    /**
     * Scope by category type
     * Usage: Category::ofType('hotel')->get();
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function things()
    {
        return $this->hasMany(ThingToDo::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function packageCategories()
    {
        return $this->hasMany(PackageCategory::class, 'category_id');
    }
}
