<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    protected $fillable = [
        'metaable_id',
        'metaable_type',
        'meta_title',
        'meta_description',
        'schema_json',
        'language_code'
    ];

    protected $casts = [
        'schema_json' => 'array',
    ];

    public function metaable()
    {
        return $this->morphTo();
    }
}
