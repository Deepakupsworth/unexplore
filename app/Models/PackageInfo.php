<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class PackageInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_id',
        'type', // cancellation | visa | season
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function translation()
    {
        return $this->hasOne(PackageInfoTranslation::class)
            ->where('language_code', app()->getLocale());
    }
    public function translations()
    {
        return $this->hasMany(PackageInfoTranslation::class);
    }
}
