<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportTranslation extends Model
{
    protected $fillable = [
        'transport_id',
        'language_code',
        'name',
        'message'
    ];

    public function transport()
    {
        return $this->belongsTo(Transport::class);
    }
}
