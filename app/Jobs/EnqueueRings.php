<?php

namespace App\Jobs;

use App\Models\EnqueuedRing;
use App\Models\Ring;
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
        if ($this->isHoliday()) {
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
    }

    public function isHoliday(): bool
    {
        return false;
    }
}
