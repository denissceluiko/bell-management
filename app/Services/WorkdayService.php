<?php

namespace App\Services;

use App\Models\Schedule;
use Carbon\Carbon;

class WorkdayService
{
    public static function isWorkday(Carbon $date): bool
    {
        return !static::isHoliday($date);
    }

    public static function isHoliday(Carbon $date): bool
    {
        if (static::isHolidayOn($date)) {
            return true;
        }

        if (static::isAdditionalWorkdayOn($date)) {
            return false;
        }

        if (static::isWeekend($date)) {
            return true;
        }

        return false;
    }

    public static function isWeekend(Carbon $date)
    {
        return $date->dayOfWeekIso == 6 || $date->dayOfWeekIso == 7;
    }

    public static function isHolidayOn(Carbon $date): bool
    {
        $count = Schedule::query()
           ->annualFor($date)
           ->holiday()
           ->count();

        if ($count > 0)
            return true;

        $count = Schedule::query()
           ->for($date)
           ->holiday()
           ->count();

        return $count > 0;
    }

    public static function isAdditionalWorkdayOn(Carbon $date): bool
    {
        $count = Schedule::query()
           ->for($date)
           ->workday()
           ->count();

        return $count > 0;
    }
}
