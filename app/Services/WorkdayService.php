<?php

namespace App\Services;

use Carbon\Carbon;

class WorkdayService
{
    public static function isWorkday(Carbon $date): bool
    {
        return !static::isHoliday($date);
    }

    public static function isHoliday(Carbon $date): bool
    {
        $formatted = $date->format('d.m');

        if (in_array($formatted, static::nationalHolidays())) {
            return true;
        }

        if (in_array($formatted, static::otherHolidays())) {
            return true;
        }

        if (in_array($formatted, static::otherWorkdays())) {
            return false;
        }

        if (static::isWeekend($date) || static::isSummerBreak($date)) {
            return true;
        }

        return false;
    }

    public static function nationalHolidays(): array
    {
        return [
            '01.01',
            '01.05',
            '04.05',
            '23.06',
            '24.06',
            '18.11',
            '24.12',
            '25.12',
            '26.12',
            '31.12',
        ];
    }

    public static function otherHolidays(): array
    {
        return [
            '18.04',
            '21.04',
            '02.05',
            '05.05',
            '17.11',
        ];
    }

    public static function otherWorkdays(): array
    {
        return [
            '10.05',
            '08.11',
        ];
    }

    public static function isWeekend(Carbon $date)
    {
        return $date->dayOfWeekIso == 6 || $date->dayOfWeekIso == 7;
    }

    public static function isSummerBreak(Carbon $date)
    {
        return in_array($date->month, [6, 7, 8]);
    }
}
