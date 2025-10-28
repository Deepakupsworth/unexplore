<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThingToDoTranslation extends Model
{
    protected $table = 'thing_translations';
    /** @use HasFactory<\Database\Factories\ThingToDoTranslationFactory> */
    use HasFactory;
}
