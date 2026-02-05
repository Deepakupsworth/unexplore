<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PackagePolicy extends Model
{
    protected $fillable = ['status'];

    public function translations()
    {
        return $this->hasMany(PackagePolicyTranslation::class);
    }

    public function translation()
    {
        return $this->hasOne(PackagePolicyTranslation::class)
            ->where('language_code', app()->getLocale());
    }

    public function packages()
    {
        return $this->belongsToMany(
            Package::class,
            'package_package_policy',
            'package_policy_id',
            'package_id'
        );
    }
}
