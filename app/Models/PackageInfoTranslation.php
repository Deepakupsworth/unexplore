<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageInfoTranslation extends Model
{
    protected $fillable = [
        'package_info_id',
        'language_code',
        'title',
        'content',
    ];

    public function info()
    {
        return $this->belongsTo(PackageInfo::class, 'package_info_id');
    }
}
