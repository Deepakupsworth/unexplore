<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageInfo extends Model
{
    protected $fillable = [
        'package_id',
        'type', // cancellation | visa | season
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function translations()
    {
        return $this->hasMany(PackageInfoTranslation::class);
    }
}
