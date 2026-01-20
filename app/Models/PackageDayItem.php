<?php

namespace App\Models; // ✅ THIS WAS MISSING

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Hotel;
use App\Models\Transport;
use App\Models\Event;
use App\Models\PackageDay;
use App\Models\ThingToDo;

class PackageDayItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_day_id',
        'item_type',
        'item_id',
        'start_time',
        'end_time',
        'sort_order',
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time'   => 'datetime:H:i',
    ];

    public function day()
    {
        return $this->belongsTo(PackageDay::class);
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

    public function item()
    {
        return match ($this->item_type) {
            'hotel'     => $this->hotel(),
            'transport' => $this->transport(),
            'event'     => $this->event(),
            'todo'      => $this->todo(),
            default     => null,
        };
    }
}
