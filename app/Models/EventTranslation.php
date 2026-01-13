<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventTranslation extends Model
{
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
