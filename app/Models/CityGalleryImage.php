<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityGalleryImage extends Model
{
    /** @use HasFactory<\Database\Factories\CityGalleryImageFactory> */
    use HasFactory;

    protected $fillable = ['city_id', 'image_path'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
