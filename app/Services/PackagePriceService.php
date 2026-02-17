<?php

namespace App\Services;

use App\Models\Package;
use Illuminate\Validation\ValidationException;

class PackagePriceService
{
    public function calculate(Package $package, int $adults, int $children = 0, $dayItemsExtra = 0): array
    {
        $priceModel = $package->price;

        if (!$priceModel) {
            throw ValidationException::withMessages([
                'package' => 'Package pricing not configured'
            ]);
        }

        /* ================= VALIDATIONS ================= */

        $totalPersons = $adults + $children;

        // min adults
        if ($adults < $package->base_persons) {
            throw ValidationException::withMessages([
                'adults' => 'Minimum adults required: ' . $package->base_persons
            ]);
        }

        // max persons
        if ($totalPersons > $package->max_persons) {
            throw ValidationException::withMessages([
                'persons' => 'Maximum persons exceeded'
            ]);
        }

        /* ================= BASE PRICE ================= */

        $pricePerPerson = (float) $priceModel->per_person_price;
        $basePrice = $package->price->original_price;

        /* ================= EXTRA ADULT ================= */

        $extraAdults = max(0, $adults - $package->base_persons);

        $extraAdultPerPrice = $pricePerPerson;

        if ($priceModel->increasePersons?->count()) {
            $rule = $priceModel->increasePersons
                ->firstWhere('person_number', $extraAdults);

            if ($rule) {
                $extraAdultPerPrice = (float) $rule->additional_price;
            }
        }

        $extraAdultTotal = $extraAdults * $extraAdultPerPrice;

        /* ================= CHILD PRICE ================= */

        $childPerPrice = $pricePerPerson;

        $childTotal = 0;

        if ($children > 0 && $priceModel->childPrices?->count()) {

            $rule = $priceModel->childPrices->first();

            if ($rule->price_type === 'fixed') {
                $childPerPrice = (float) $rule->price_value;
            } elseif ($rule->price_type === 'percentage') {
                $childPerPrice = ($pricePerPerson * $rule->price_value) / 100;
            }

            $childTotal = $childPerPrice * $children;
        } else {
            $childTotal = $childPerPrice * $children;
        }

        /* ================= FINAL TOTAL ================= */

        // $finalTotal = $basePrice + $extraAdultTotal + $childTotal;
        $dayItemsExtra = max(0, (float) $dayItemsExtra);

        $finalTotal = $basePrice + $extraAdultTotal + $childTotal + $dayItemsExtra;

        return [
            'adults' => $package->base_persons + $extraAdults,
            'child' => $children,
            'base_price' => round($basePrice, 2),
            'extra_adults' => $extraAdults,
            'extra_adult_per_price' => round($extraAdultPerPrice, 2),
            'extra_adult_total' => round($extraAdultTotal, 2),
            'child_per_price' => round($childPerPrice, 2),
            'child_total' => round($childTotal, 2),
            'day_items_extra' => round($dayItemsExtra, 2),
            'final_total' => round($finalTotal, 2),
            'total_persons' => $totalPersons,
        ];
    }
}
