<?php

namespace App\Enums;

enum BookingStatus: string
{
    case PENDING   = 'pending';
    case CONFIRMED = 'confirmed';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Human readable label
     */
    public function label(): string
    {
        return ucfirst($this->value);
    }

    /**
     * UI badge variant
     */
    public function badgeVariant(): string
    {
        return match ($this) {
            self::CONFIRMED => 'success',
            self::CANCELLED => 'danger',
            self::PENDING   => 'warning',
            self::COMPLETED => 'info',
        };
    }
}
