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

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($case) => [
                $case->value => $case->label()
            ])
            ->toArray();
    }

    public function label(): string
    {
        return match ($this) {
            self::PENDING   => 'Pending',
            self::CONFIRMED => 'Confirmed',
            self::CANCELLED => 'Cancelled',
            self::COMPLETED => 'Completed',
        };
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
