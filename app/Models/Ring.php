<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ring extends Model
{
    use HasFactory;
    
    protected $fillable = ['ring_at', 'name', 'type'];

    protected function casts(): array
    {
        return [
            'ring_at' => 'datetime:H:i',
        ];
    }
}
