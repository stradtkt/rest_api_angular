<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    /**
     * Format a date using Carbon.
     */
    public static function formatDate($date, string $format = 'Y-m-d'): string
    {
        return Carbon::parse($date)->format($format);
    }

    /**
     * Get the human-readable difference (e.g., "2 days ago").
     */
    public static function diffForHumans($date, $other = null): string
    {
        return Carbon::parse($date)->diffForHumans($other ? Carbon::parse($other) : null);
    }

    /**
     * Check if the date is today.
     */
    public static function isToday($date): bool
    {
        return Carbon::parse($date)->isToday();
    }

    /**
     * Check if a date is in the past.
     */
    public static function isPast($date): bool
    {
        return Carbon::parse($date)->isPast();
    }

    /**
     * Check if a date is in the future.
     */
    public static function isFuture($date): bool
    {
        return Carbon::parse($date)->isFuture();
    }

    /**
     * Get the day of the week.
     */
    public static function dayOfWeek($date): string
    {
        return Carbon::parse($date)->format('l'); // e.g., "Monday"
    }

    /**
     * Get number of days between two dates.
     */
    public static function daysBetween($start, $end): int
    {
        return Carbon::parse($start)->diffInDays(Carbon::parse($end));
    }

    /**
     * Add days to a date.
     */
    public static function addDays($date, int $days): string
    {
        return Carbon::parse($date)->addDays($days)->toDateString();
    }

    /**
     * Subtract days from a date.
     */
    public static function subtractDays($date, int $days): string
    {
        return Carbon::parse($date)->subDays($days)->toDateString();
    }

    /**
     * Convert to ISO 8601 format.
     */
    public static function toIso8601($date): string
    {
        return Carbon::parse($date)->toIso8601String();
    }
}
