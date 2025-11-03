<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventGalleryImage extends Model
{
    /** @use HasFactory<\Database\Factories\EventGalleryImageFactory> */
    use HasFactory;

    protected $fillable = ['event_id', 'image_path'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
