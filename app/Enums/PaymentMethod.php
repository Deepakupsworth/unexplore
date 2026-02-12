<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case CASH          = 'cash';
    case BANK_TRANSFER = 'bank_transfer';
    case ONLINE        = 'online';
    case MANUAL        = 'manual';

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
            self::CASH          => 'Cash',
            self::BANK_TRANSFER => 'Bank Transfer',
            self::ONLINE        => 'Online Payment',
            self::MANUAL        => 'Manual',
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
