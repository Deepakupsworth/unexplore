<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'code',
        'symbol',
        'name',
        'rate',
        'is_base',
        'status',
    ];

    protected $casts = [
        'rate'    => 'float',
        'is_base' => 'boolean',
        'status'  => 'boolean',
    ];

    /* ---------------- Scopes ---------------- */

    // Only active currencies
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Base currency (rate = 1)
    public function scopeBase($query)
    {
        return $query->where('is_base', 1);
    }

    /* ---------------- Helpers ---------------- */

    // Get base currency safely
    public static function getBase(): ?self
    {
        return static::base()->first();
    }

    // Get currency by code safely
    public static function byCode(string $code): ?self
    {
        return static::active()->where('code', $code)->first();
    }
}
