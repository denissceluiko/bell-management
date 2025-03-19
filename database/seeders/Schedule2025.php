<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Schedule2025 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedule = [
            ['Lielā piektdiena', '18.04.2025', '18.04.2025', 'holiday'],
            ['Otrās Lieldienas', '21.04.2025', '21.04.2025', 'holiday'],
            ['Pārcelta brīvdiena no 10.05', '02.05.2025', '02.05.2025', 'holiday'],
            ['Pārcelta brīvdiena no 04.05.', '05.05.2025', '05.05.2025', 'holiday'],

            ['Pārcelta darbdiena no 02.05.', '10.05.2025', '10.05.2025', 'workday'],
        ];

        Schedule::factory()->fromArray($schedule);
    }
}
