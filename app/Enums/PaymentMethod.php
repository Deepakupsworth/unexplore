<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case CASH   = 'cash';
    case BANK   = 'bank';
    case ONLINE = 'online';
    case MANUAL = 'manual';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
