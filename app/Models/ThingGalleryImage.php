<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThingGalleryImage extends Model
{
    /** @use HasFactory<\Database\Factories\ThingGalleryImageFactory> */
    use HasFactory;

    protected $fillable = ['thing_id', 'image_path'];

    public function thingToDo()
    {
        return $this->belongsTo(ThingToDo::class);
    }
}
