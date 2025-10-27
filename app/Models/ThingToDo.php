<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThingToDo extends Model
{
    protected $table = 'things_to_do';
    /** @use HasFactory<\Database\Factories\ThingToDoFactory> */
    use HasFactory;
   
}
