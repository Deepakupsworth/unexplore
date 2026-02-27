<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThingToDoTranslation extends Model
{
    protected $table = 'thing_translations';

    protected $fillable = [
        'thing_id',
        'language_code',
        'name',
        'about'
    ];
    
    protected $touches = ['thing'];

    public function thing()
    {
        return $this->belongsTo(ThingToDo::class, 'thing_id');
    }
}
