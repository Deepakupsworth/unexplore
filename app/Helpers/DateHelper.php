<?php

namespace App\Helpers;

use Carbon\Carbon;

/**
 * Class DateHelper
 *
 * PURPOSE:
 * --------
 * This helper is used ONLY for DATE formatting across the application.
 * It is intentionally separated from TimeHelper to keep concerns clean.
 *
 * WHERE TO USE:
 * -------------
 * - Events
 * - Bookings
 * - Orders
 * - Blogs
 * - Admin panels
 * - Frontend views
 *
 * NOTE:
 * -----
 * - Do NOT add time-related logic here.
 * - Time formatting is already handled in TimeHelper.
 */
class DateHelper
{
    /**
     * Format a single date into readable format
     *
     * DEFAULT OUTPUT:
     * ---------------
     * 2025-09-27 → Sunday, 27 Sep 2025
     *
     * USAGE:
     * ------
     * DateHelper::format($date);
     * DateHelper::format($date, 'd M Y');
     */
    public static function format(?string $date, string $format = 'l, d M Y'): ?string
    {
        // If date is null or empty, return null safely
        if (!$date) {
            return null;
        }

        try {
            return Carbon::parse($date)->format($format);
        } catch (\Exception $e) {
            // Fail silently to avoid breaking UI
            return null;
        }
    }

    /**
     * Format a date range (start → end)
     *
     * OUTPUT EXAMPLES:
     * ----------------
     * Same day:
     * 2025-09-27 → Sunday, 27 Sep 2025
     *
     * Multi-day (same year):
     * 2025-09-27 to 2025-09-30 → 27 Sep - 30 Sep 2025
     *
     * Multi-day (different year):
     * 2025-12-30 to 2026-01-02 → 30 Dec 2025 - 02 Jan 2026
     *
     * USAGE:
     * ------
     * DateHelper::range($startDate, $endDate);
     */
    public static function range(?string $start, ?string $end): ?string
    {
        // If start date is missing, nothing to format
        if (!$start) {
            return null;
        }

        try {
            $startDate = Carbon::parse($start);

            // If end date exists and is different from start
            if ($end && $start !== $end) {
                $endDate = Carbon::parse($end);

                // Same year formatting
                if ($startDate->year === $endDate->year) {
                    return $startDate->format('d M')
                        . ' - ' .
                        $endDate->format('d M Y');
                }

                // Different year formatting
                return $startDate->format('d M Y')
                    . ' - ' .
                    $endDate->format('d M Y');
            }

            // Single day event
            return $startDate->format('l, d M Y');
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Format date with localization (multi-language support)
     *
     * OUTPUT EXAMPLE:
     * ---------------
     * EN → Sunday, 27 Sep 2025
     * DE → Sonntag, 27 Sep 2025
     * AR → الأحد، 27 سبتمبر 2025
     *
     * USAGE:
     * ------
     * DateHelper::localized($date, 'en');
     * DateHelper::localized($date, 'de');
     * DateHelper::localized($date, current_lang());
     */
    public static function localized(?string $date, string $locale = 'en'): ?string
    {
        if (!$date) {
            return null;
        }

        try {
            return Carbon::parse($date)
                ->locale($locale)
                ->translatedFormat('l, d M Y');
        } catch (\Exception $e) {
            return null;
        }
    }

    public static function badge(?string $date): ?string
    {
        if (!$date) {
            return null;
        }

        try {
            return \Carbon\Carbon::parse($date)->format('d M Y');
        } catch (\Exception $e) {
            return null;
        }
    }
}
