<?php

use App\Models\Schedule;
use App\Services\WorkdayService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('recognizes annual single day holiday', function () {
    Schedule::factory()->fromArray([
        ['Jaungada diena', '01.01.1970', '01.01.1970', 'annual_holiday'],
        ['LR Proklamēšanas diena', '18.11.1970', '18.11.1970', 'annual_holiday'],
        ['Vecgada diena', '31.12.1970', '31.12.1970', 'annual_holiday'],
    ]);

    $newYearsDay = Carbon::createFromDate(2025, 1, 1);
    $independenceDay = Carbon::createFromDate(2025, 11, 18);
    $lastDayOfYear = Carbon::createFromDate(2025, 12, 31);
    $otherDay = Carbon::createFromDate(2025, 1, 2);

    expect(WorkdayService::isHoliday($newYearsDay))->toBeTrue();
    expect(WorkdayService::isHoliday($independenceDay))->toBeTrue();
    expect(WorkdayService::isHoliday($lastDayOfYear))->toBeTrue();
    expect(WorkdayService::isHoliday($otherDay))->toBeFalse();
});

test('recognizes multiple day holidays', function () {
    Schedule::factory()->fromArray([
        ['Ziemassvētki', '24.12.1970', '26.12.1970', 'annual_holiday'],
    ]);

    $dayOne = Carbon::createFromDate(2025, 12, 24);
    $dayTwo = Carbon::createFromDate(2025, 12, 25);
    $dayThree = Carbon::createFromDate(2025, 12, 26);
    $otherDay = Carbon::createFromDate(2025, 12, 23);

    expect(WorkdayService::isHoliday($dayOne))->toBeTrue();
    expect(WorkdayService::isHoliday($dayTwo))->toBeTrue();
    expect(WorkdayService::isHoliday($dayThree))->toBeTrue();
    expect(WorkdayService::isHoliday($otherDay))->toBeFalse();
});

test('recognizes weekends', function () {
    $friday = Carbon::createFromDate(2025, 3, 21);
    $saturday = Carbon::createFromDate(2025, 3, 22);
    $sunday = Carbon::createFromDate(2025, 3, 23);
    $monday = Carbon::createFromDate(2025, 3, 24);

    expect(WorkdayService::isHoliday($friday))->toBeFalse();
    expect(WorkdayService::isHoliday($saturday))->toBeTrue();
    expect(WorkdayService::isHoliday($sunday))->toBeTrue();
    expect(WorkdayService::isHoliday($monday))->toBeFalse();
});


test('recognizes additional workdays', function () {
    Schedule::factory()->fromArray([
        ['Darbdiena', '22.03.2025', '22.03.2025', 'workday'],
    ]);

    $friday = Carbon::createFromDate(2025, 3, 21);
    $saturday = Carbon::createFromDate(2025, 3, 22);
    $sunday = Carbon::createFromDate(2025, 3, 23);
    $monday = Carbon::createFromDate(2025, 3, 24);

    expect(WorkdayService::isHoliday($friday))->toBeFalse();

    expect(WorkdayService::isHoliday($saturday))->toBeFalse();
    expect(WorkdayService::isWorkday($saturday))->toBeTrue();

    expect(WorkdayService::isHoliday($sunday))->toBeTrue();
    expect(WorkdayService::isHoliday($monday))->toBeFalse();
});


test('recognizes additional holidays', function () {
    Schedule::factory()->fromArray([
        ['Additional holiday', '15.01.2025', '15.01.2025', 'holiday'],
    ]);

    $wdBefore = Carbon::createFromDate(2025, 1, 14);
    $holiday = Carbon::createFromDate(2025, 1, 15);
    $wdAfter = Carbon::createFromDate(2025, 1, 16);

    expect(WorkdayService::isHoliday($wdBefore))->toBeFalse();
    expect(WorkdayService::isHoliday($holiday))->toBeTrue();
    expect(WorkdayService::isHoliday($wdAfter))->toBeFalse();
});
