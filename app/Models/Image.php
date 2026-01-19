<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_path',
        'language_code',
        'role',
        'is_primary',
        'sort_order',
    ];

    /**
     * Polymorphic relation
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    /**
     * Scope: only thumbnails
     */
    public function scopeThumb($query)
    {
        return $query->where('role', 'thumb');
    }

    /**
     * Scope: gallery images
     */
    public function scopeGallery($query)
    {
        return $query->where('role', 'gallery');
    }

    /**
     * Scope: language aware
     */
    public function scopeLang($query, $lang = null)
    {
        $lang = $lang ?? app()->getLocale();

        return $query->where(function ($q) use ($lang) {
            $q->where('language_code', $lang)
              ->orWhereNull('language_code');
        });
    }
}
