<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    protected $fillable = [
        'company_name',
        'email',
        'phone',
        'whatsapp',
        'address_line',
        'city',
        'country',
        'postal_code',
        'working_days',
        'working_hours',
        'instagram_url',
        'facebook_url',
        'twitter_url',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Get single company detail (CMS style)
     */
    public static function getInfo(): ?self
    {
        return static::first();
    }
}
