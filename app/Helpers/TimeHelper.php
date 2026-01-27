<?php

namespace App\Helpers;

use Carbon\Carbon;

class TimeHelper
{
    /**
     * Convert time to 24-hour format (H:i)
     * Accepts:
     *  - 07:47 PM
     *  - 07:47 AM
     *  - 19:47 (already 24-hour)
     */
    public static function to24Hour(?string $time): ?string
    {
        if (!$time) {
            return null;
        }

        // Already in 24-hour format
        if (preg_match('/^\d{2}:\d{2}$/', $time)) {
            return $time;
        }

        // Convert AM/PM → 24-hour
        try {
            return Carbon::createFromFormat('h:i A', $time)->format('H:i');
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Convert 24-hour time to AM/PM (for display)
     * Example: 19:47 → 07:47 PM
     */
    public static function toAmPm(?string $time): ?string
    {
        if (!$time) {
            return null;
        }

        try {
            return Carbon::createFromFormat('H:i', $time)->format('h:i A');
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Start time to end time only
     * Example: 03:00 PM to 06:00 PM
     */


    /**
     * Start time to end time only
     * Example: 03:00 PM to 06:00 PM
     */
    public static function range(?string $startTime, ?string $endTime): ?string
    {
        if (!$startTime || !$endTime) {
            return null;
        }

        try {
            // Normalize time (handle H:i:s → H:i)
            $start = strlen($startTime) === 8
                ? Carbon::createFromFormat('H:i:s', $startTime)->format('H:i')
                : $startTime;

            $end = strlen($endTime) === 8
                ? Carbon::createFromFormat('H:i:s', $endTime)->format('H:i')
                : $endTime;

            return self::toAmPm($start) . ' to ' . self::toAmPm($end);
        } catch (\Exception $e) {
            return null;
        }
    }
}
