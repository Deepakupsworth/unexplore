<?php

namespace App\Support;

use App\Models\PackagePrice;

class PriceCalculator
{
    public static function calculate(?PackagePrice $price, int $persons = 1): array
    {
        if (!$price) {
            return [
                'per_person' => 0,
                'total' => 0,
            ];
        }

        $perPerson = (float) $price->per_person_price;
        $persons = max($persons, 1);

        return [
            'per_person' => $perPerson,
            'total' => $perPerson * $persons,
        ];
    }
}
