<?php

namespace App\Enums;

enum TransportType: string
{
    case TAXI   = 'taxi';
    case CAR    = 'car';
    case BUS    = 'bus';
    case TRAIN  = 'train';
    case FLIGHT = 'flight';

    public function label(): string
    {
        return match($this) {
            self::TAXI   => 'Taxi',
            self::CAR    => 'Car',
            self::BUS    => 'Bus',
            self::TRAIN  => 'Train',
            self::FLIGHT => 'Flight',
        };
    }
}
