<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class TransportTranslation extends Model
{
    use HasFactory;
    protected $fillable = [
        'transport_id',
        'language_code',
        'name',
        'description'
    ];

    public function transport()
    {
        return $this->belongsTo(Transport::class);
    }
}
