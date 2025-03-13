<?php

namespace Database\Seeders;

use App\Models\Ring;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $times = [
            ['9:00', '9:40'],
            ['9:45', '10:25'],
            ['10:30', '11:10'],
            ['11:15', '11:55'],
            ['12:30', '13:10'],
            ['13:15', '13:55'],
            ['14:00', '14:40'],
            ['14:45', '15:25'],
            ['15:30', '16:10'],
            ['16:15', '16:55'],
        ];

        $rings = [];

        for ($i=0; $i<count($times); $i++) {
            $rings[] = [
                'ring_at' => $times[$i][0],
                'name' => $i+1 . '. stundas sākums',
                'type' => 'default',
            ];

            $rings[] = [
                'ring_at' => $times[$i][1],
                'name' => $i+1 . '. stundas beigas',
                'type' => 'default',
            ];
        }

        Ring::factory()->createMany($rings);
    }
}
