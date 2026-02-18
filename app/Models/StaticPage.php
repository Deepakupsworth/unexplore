<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    protected $fillable = [
        'slug',
        'page_title',
        'meta_title',
        'meta_description',
        'schema_json',
        'language_code'
    ];

    protected $casts = [
        'schema_json' => 'array',
    ];
}
