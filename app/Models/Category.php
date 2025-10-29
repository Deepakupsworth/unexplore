<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'slug',
        'thumb_image',
        'thumb_icon',
    ];

    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }
}
