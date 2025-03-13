<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnqueuedRing extends Model
{
    protected $connection = 'ring-queue';

    protected $fillable = ['ring_at', 'type'];

    protected function casts(): array
    {
        return [
            'ring_at' => 'datetime:H:i',
        ];
    }
}
