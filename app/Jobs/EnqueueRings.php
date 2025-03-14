<?php

namespace App\Jobs;

use App\Models\EnqueuedRing;
use App\Models\Ring;
use App\Services\StatusService;
use App\Services\WorkdayService;
use DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class EnqueueRings implements ShouldQueue
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
        if (!$this->isWorkday()) {
            return;
        }

        $rings = Ring::all();

        EnqueuedRing::truncate();

        foreach ($rings as $ring) {
            EnqueuedRing::create([
                'ring_at' => $ring->ring_at->format('H:i'),
                'type' => $ring->type,
            ]);
        }

        $state = StatusService::put('last_update_at', now());
    }

    public function isWorkday(): bool
    {
        return WorkdayService::isWorkday(now());
    }
}
