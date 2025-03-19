<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedule = [
            ['Jaungada diena', '01.01.1970', '01.01.1970', 'annual_holiday'],
            ['Darba svētki', '01.05.1970', '01.05.1970', 'annual_holiday'],
            ['LR Neatkarības deklarācijas pasludināšanas diena', '04.05.1970', '04.05.1970', 'annual_holiday'],
            ['Jāņi', '23.06.1970', '24.06.1970', 'annual_holiday'],
            ['LR Proklamēšanas diena', '18.11.1970', '18.11.1970', 'annual_holiday'],
            ['Ziemassvētki', '24.12.1970', '26.12.1970', 'annual_holiday'],
            ['Vecgada diena', '31.12.1970', '31.12.1970', 'annual_holiday'],

            ['Vasaras brīvlaiks', '01.06.1970', '01.09.1970', 'annual_holiday'],
        ];

        Schedule::factory()->fromArray($schedule);
    }
}
