<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    public function fromArray(array $dates): Collection
    {
        $collection = [];

        foreach ($dates as $date) {
            $collection[] = [
                'name' => $date[0],
                'start_at' => Carbon::createFromFormat('d.m.Y', $date[1]),
                'end_at' => Carbon::createFromFormat('d.m.Y', $date[2]),
                'type' => $date[3],
            ];
        }
        return static::createMany($collection);
    }
}
