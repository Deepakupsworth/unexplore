<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ThingToDo extends Model
{
    protected $table = 'things_to_do';
    /** @use HasFactory<\Database\Factories\ThingToDoFactory> */
    use HasFactory;

    protected $fillable = ['slug', 'image', 'location'];

    public function translations()
    {
        return $this->hasMany(ThingToDoTranslation::class, 'thing_id');
    }

    public function galleryImages()
    {
        return $this->hasMany(ThingGalleryImage::class, 'thing_id');
    }
    
   
}
