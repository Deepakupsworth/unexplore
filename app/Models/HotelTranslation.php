<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class HotelTranslation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'hotel_id',
        'language_code',
        'name',
        'description',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
