<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GolfContactQuery extends Model
{
    protected $table = 'golf_contact_queries';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'golf_id',
        'status'
    ];

    protected $casts = [
        'golf_id' => 'integer'
    ];

    /*
    |--------------------------------------------------------------------------
    | Future Golf Relation
    |--------------------------------------------------------------------------
    | golf_id nullable because golf table may not exist now
    */

    public function golf()
    {
        return $this->belongsTo(Golf::class, 'golf_id');
    }
}