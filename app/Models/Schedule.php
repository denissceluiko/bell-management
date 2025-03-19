<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /** @use HasFactory<\Database\Factories\ScheduleFactory> */
    use HasFactory;

    protected $fillable = ['name', 'type', 'start_at', 'end_at', 'enabled'];

    protected function casts()
    {
        return [
            'start_at' => 'date',
            'end_at' => 'date',
            'enabled' => 'boolean',
        ];
    }

    public function scopeAnnualFor(Builder $query, Carbon $date): void
    {
        $query->whereDate('start_at', '<=', '1970-'.$date->format('m-d'))
            ->whereDate('end_at', '>=', '1970-'.$date->format('m-d'));
    }

    public function scopeFor(Builder $query, Carbon $date): void
    {
        $query->whereDate('start_at', '<=', $date->format('Y-m-d'))
            ->whereDate('end_at', '>=', $date->format('Y-m-d'));
    }

    public function scopeType(Builder $query, string|array $type): void
    {
        if (is_string($type)) {
            $type = [$type];
        }

        $query->whereIn('type', $type);
    }

    public function scopeHoliday(Builder $query): void
    {
        $query->type(['holiday', 'annual_holiday']);
    }

    public function scopeWorkday(Builder $query): void
    {
        $query->type('workday');
    }
}
