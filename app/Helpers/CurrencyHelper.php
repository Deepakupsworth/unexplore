<?php

use App\Models\Currency;
use Illuminate\Support\Facades\App;
use App\Models\ThingToDo;



if (!function_exists('current_lang')) {
    function current_lang()
    {
        return App::getLocale(); // en, de, ar
    }
}

if (!function_exists('currency_convert')) {

    /**
     * Convert amount from base currency to selected currency
     *
     * @param float $amount  Base amount
     * @param string|null $currencyCode
     * @return float
     */
    function currency_convert(float $amount, ?string $currencyCode = null): float
    {
        $currencyCode = $currencyCode
            ?? session('currency')
            ?? config('app.base_currency', 'SAR');

        $currency = Currency::where('code', $currencyCode)
            ->where('status', 1)
            ->first();

        if (!$currency) {
            return round($amount, 2);
        }

        return round($amount * $currency->rate, 2);
    }
}

if (!function_exists('currency_show')) {

    /**
     * Show formatted price with currency symbol
     *
     * @param float $amount Base amount
     * @param string|null $currencyCode
     * @return string
     */
    function currency_show(float $amount, ?string $currencyCode = null): string
    {
        $currencyCode = $currencyCode
            ?? session('currency')
            ?? config('app.base_currency', 'SAR');

        $currency = Currency::where('code', $currencyCode)
            ->where('status', 1)
            ->first();

        if (!$currency) {
            return number_format($amount, 2);
        }

        $converted = currency_convert($amount, $currencyCode);

        return $currency->symbol . ' ' . number_format($converted, 2);
    }
}
if (!function_exists('currency_icon_path')) {

    function currency_icon_path(?string $currencyCode = null): string
    {
        $currencyCode = $currencyCode
            ?? session('currency')
            ?? config('app.base_currency', 'SAR');

        return match ($currencyCode) {
            'SAR' => 'frontend/assets/icons/riyal.svg',
            'USD' => 'frontend/assets/icons/usd.svg',
            'EUR' => 'frontend/assets/icons/euro.svg',
            'AED' => 'frontend/assets/icons/aed.svg',
            default => 'frontend/assets/icons/riyal.svg',
        };
    }
}
