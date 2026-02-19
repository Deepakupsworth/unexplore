<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerBilling extends Model
{
    protected $table = 'customer_billings';

    protected $fillable = [
        'user_id',

        // basic
        'full_name',
        'email',
        'phone',

        // address
        'address_line1',
        'address_line2',
        'city',
        'state',
        'postal_code',
        'country_code',

        // business
        'company_name',
        'gst_number',

        // flags
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    /* ================= RELATIONS ================= */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /* ================= HELPERS ================= */

    public function getFullAddressAttribute(): string
    {
        return collect([
            $this->address_line1,
            $this->address_line2,
            $this->city,
            $this->state,
            $this->postal_code,
        ])->filter()->implode(', ');
    }
}
