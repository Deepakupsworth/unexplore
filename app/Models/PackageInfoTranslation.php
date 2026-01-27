<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class PackageInfoTranslation extends Model
{
    use HasFactory;
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
