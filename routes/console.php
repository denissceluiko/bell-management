<?php

use App\Jobs\EnqueueRings;
use App\Jobs\Heartbeat;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::job(Heartbeat::class)->everyFiveMinutes();
Schedule::job(EnqueueRings::class)->dailyAt('08:00');
