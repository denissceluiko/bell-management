<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'test@celuiko.com',
            'password' => bcrypt('changeme'),
        ]);

        $this->call([
            RingSeeder::class,
            ScheduleSeeder::class,
        ]);
    }
}
