<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThingToDoCategory extends Model
{
    protected $table = 'thing_to_do_category';

    protected $fillable = [
        'thing_id',
        'category_id',
    ];

    public $timestamps = false;

    public function thing()
    {
        return $this->belongsTo(ThingToDo::class, 'thing_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
