<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['slug','thumb_image','thumb_icon'];

    // All translations
    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    // English translation
    public function translation()
    {
        return $this->hasOne(CategoryTranslation::class)
                    ->where('language_code','en');
    }
}
