<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class EventTranslation extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id',
        'language_code',
        'title',
        'sub_title',
        'url',
        'description'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
