<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'address_title',
        'country',
        'city',
        'pin_code',
        'full_address',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
