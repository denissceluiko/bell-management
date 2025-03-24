<?php

namespace App\Jobs;

use App\Services\StatusService;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class Heartbeat implements ShouldQueue
{
    use Queueable;


    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $state = StatusService::get('last_update_at');

        if (is_null($state)) {
            $this->dispatch();
            return;
        }

        $last_update = Carbon::parse($state);

        if ($last_update->isToday()) {
            return;
        }

        $this->dispatch();
    }

    protected function dispatch()
    {
        EnqueueRings::dispatch();
    }

}
