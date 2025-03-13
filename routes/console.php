<?php

use App\Jobs\EnqueueRings;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::job(EnqueueRings::class)->dailyAt('08:00');
