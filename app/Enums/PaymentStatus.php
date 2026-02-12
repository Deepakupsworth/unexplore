<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PENDING        = 'pending';
    case PAID           = 'paid';
    case UNPAID         = 'unpaid';
    case FAILED         = 'failed';
    case REFUNDED       = 'refunded';
    case PARTIAL_REFUND = 'partial_refund';

    /* ===============================
     | All Values (for validation)
     ===============================*/
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /* ===============================
     | Human Readable Label
     ===============================*/
    public function label(): string
    {
        return match ($this) {
            self::PENDING        => 'Pending',
            self::PAID           => 'Paid',
            self::UNPAID           => 'Unpaid',
            self::FAILED         => 'Failed',
            self::REFUNDED       => 'Refunded',
            self::PARTIAL_REFUND => 'Partial Refund',
        };
    }

    /* ===============================
     | Dropdown Options Helper
     ===============================*/
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($case) => [
                $case->value => $case->label()
            ])
            ->toArray();
    }
}
