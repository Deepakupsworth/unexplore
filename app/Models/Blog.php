<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'slug',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Author
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thumb()
    {
        return $this->morphOne(Image::class, 'imageable')
            ->where('role', 'thumb');
    }

    // All translations
    public function translations()
    {
        return $this->hasMany(BlogTranslation::class);
    }

    // Single translation by language
    public function translation($languageCode = null)
    {
        $lang = $languageCode ?? current_lang() ?? 'en';
        return $this->hasOne(BlogTranslation::class)

            ->where('language_code', $lang);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
