<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogTranslation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'blog_id',
        'language_code',
        'title',
        'content',
    ];

    // Parent blog
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}