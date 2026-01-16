<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageDayItem extends Model
{
    protected $fillable = [
        'package_day_id',
        'item_type',   // hotel | transport | event | todo
        'item_id',
        'start_time',
        'end_time',
        'sort_order',
    ];

    public function day()
    {
        return $this->belongsTo(PackageDay::class, 'package_day_id');
    }

    /**
     * Resolve actual model dynamically
     */
    public function item()
    {
        return match ($this->item_type) {
            'hotel'     => $this->belongsTo(Hotel::class, 'item_id'),
            'transport' => $this->belongsTo(Transport::class, 'item_id'),
            'event'     => $this->belongsTo(Event::class, 'item_id'),
            'todo'      => $this->belongsTo(ThingToDo::class, 'item_id'),
            default     => null,
        };
    }
}
