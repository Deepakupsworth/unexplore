<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\TransportType;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Transport extends Model
{
    use HasFactory,SoftDeletes;

    protected $casts = [
        'type' => TransportType::class,
    ];
    protected $fillable = [
        'city_id',
        'type',
        'contact_number',
        'capacity',
        'status',
    ];

    public function translations()
    {
        return $this->hasMany(TransportTranslation::class);
    }

    public function translation($lang = null)
    {
        $lang = $lang ?? app()->getLocale();

        return $this->hasOne(TransportTranslation::class)
            ->where('language_code', $lang);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // For polymorphic images (thumb, gallery)
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function thumb()
    {
        return $this->morphOne(Image::class, 'imageable')->where('role', 'thumb');
    }

    public function gallery()
    {
        return $this->morphMany(Image::class, 'imageable')->where('role', 'gallery');
    }
}
