<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /** @use HasFactory<\Database\Factories\CityFactory> */
    use HasFactory;
    protected $fillable = ['slug', 'thumb_image', 'video_url'];

    public function translations()
    {
        return $this->hasMany(CityTranslation::class);
    }

    public function galleryImages()
    {
        return $this->hasMany(CityGalleryImage::class);
    }
}
