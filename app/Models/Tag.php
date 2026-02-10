<?php
// app/Models/Tag.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'slug'];

    public function packages()
    {
        return $this->morphedByMany(Package::class, 'taggable');
    }

    public function events()
    {
        return $this->morphedByMany(Event::class, 'taggable');
    }

    public function todos()
    {
        return $this->morphedByMany(Thingtodo::class, 'taggable');
    }

    public function cities()
    {
        return $this->morphedByMany(City::class, 'taggable');
    }
}
