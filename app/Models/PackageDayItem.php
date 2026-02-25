<?php

namespace App\Models; // ✅ THIS WAS MISSING

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Hotel;
use App\Models\Transport;
use App\Models\Event;
use App\Models\PackageDay;
use App\Models\ThingToDo;
use Illuminate\Database\Eloquent\Relations\MorphTo;


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
        'package_id'
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time'   => 'datetime:H:i',
    ];

    public function day()
    {
        return $this->belongsTo(PackageDay::class);
    }

    /* ---------------------------------
     | MANUAL ITEM RESOLVER (SCOPED)
     |----------------------------------*/
     public function getItemAttribute()
     {
         if (! $this->item_type || ! $this->item_id) {
             return null;
         }
 
         return match ($this->item_type) {
             'hotel'     => Hotel::find($this->item_id),
             'event'     => Event::find($this->item_id),
             'todo'      => ThingToDo::find($this->item_id),
             'transport' => Transport::find($this->item_id),
             default     => null,
         };
     }
 
     /* ---------------------------------
      | TYPE-SAFE SHORTCUT ACCESSORS
      |----------------------------------*/
 
     public function getHotelAttribute()
     {
         return $this->item_type === 'hotel' ? $this->item : null;
     }
 
     public function getEventAttribute()
     {
         return $this->item_type === 'event' ? $this->item : null;
     }
 
     public function getTodoAttribute()
     {
         return $this->item_type === 'todo' ? $this->item : null;
     }
 
     public function getTransportAttribute()
     {
         return $this->item_type === 'transport' ? $this->item : null;
     }

    public function packageDay()
    {
        return $this->belongsTo(PackageDay::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
