<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class PackageDayItemOption extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_day_id',
        'item_type',
        'item_id',
        'extra_price',
        'is_default',
        'sort_order',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function day()
    {
        return $this->belongsTo(PackageDay::class, 'package_day_id');
    }
}
