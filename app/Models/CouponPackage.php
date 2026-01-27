<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponPackage extends Model
{
    protected $table = 'coupon_packages';

    protected $fillable = [
        'coupon_id',
        'package_id',
    ];

    public $timestamps = false;

    /* ================= Relations ================= */

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
