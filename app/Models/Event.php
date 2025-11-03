<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected $fillable = ['slug', 'image', 'start_date', 'end_date', 'opening_days', 'opening_time', 'closing_time', 'city_id']; 

    public function translations()
    {
        return $this->hasMany(EventTranslation::class, 'event_id');
    }

    public function galleryImages()
    {
        return $this->hasMany(EventGalleryImage::class, 'event_id'); 
    }
}
