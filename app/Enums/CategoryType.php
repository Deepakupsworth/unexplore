<?php

namespace App\Enums;

enum CategoryType: string
{
    case HOTEL        = 'hotel';
    case TRANSPORT    = 'transport';
    case EVENT        = 'event';
    case THING_TO_DO  = 'thing_to_do';
    case PACKAGE      = 'package';
    case  CITY        = 'city';

    public function label(): string
    {
        return match ($this) {
            self::HOTEL       => 'Hotel',
            self::TRANSPORT   => 'Transport',
            self::EVENT       => 'Event',
            self::THING_TO_DO => 'Things To Do',
            self::PACKAGE     => 'Package',
            self::CITY       => 'City',
        };
    }
}
