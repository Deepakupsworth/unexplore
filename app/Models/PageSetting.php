<?php
// app/Models/Tag.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSetting extends Model
{
    protected $casts = [
        'data' => 'array',
    ];
}
