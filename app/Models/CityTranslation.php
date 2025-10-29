<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model
{
    /** @use HasFactory<\Database\Factories\CityTranslationFactory> */
    use HasFactory;
    
    protected $fillable = ['city_id', 'language_id', 'name', 'tagline', 'about'];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
