<?php
namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Traveller extends Model
{
    use SoftDeletes;

    protected $casts = [
        'dob' => 'date',
    ];
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'dob',
        'gender',
        'country',
        'type',
        'age',
    ];

    protected static function boot()
    {
        parent::boot(); // ❗ REQUIRED

        static::saving(function ($traveller) {
            $traveller->age = $traveller->dob
                ? Carbon::parse($traveller->dob)->age
                : null;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
