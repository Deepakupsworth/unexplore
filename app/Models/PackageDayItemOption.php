<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Transport;
use App\Models\Event;
use App\Models\PackageDay;
use App\Models\ThingToDo;


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
    public function transport()
    {
        return $this->belongsTo(Transport::class, 'item_id');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'item_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'item_id');
    }

    public function todo()
    {
        return $this->belongsTo(ThingToDo::class, 'item_id');
    }
}
