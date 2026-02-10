<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PackagePolicyTranslation extends Model
{
    protected $fillable = [
        'package_policy_id',
        'language_code',
        'content',
    ];

    public function policy()
    {
        return $this->belongsTo(PackagePolicy::class, 'package_policy_id');
    }
}
