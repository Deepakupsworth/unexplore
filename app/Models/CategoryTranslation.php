<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CategoryTranslation extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryTranslationFactory> */
    //use HasFactory;
    use HasFactory;

    protected $fillable = [
        'category_id',
        'language_id',
        'name',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
