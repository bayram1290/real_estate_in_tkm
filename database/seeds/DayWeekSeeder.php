<?php

use Illuminate\Database\Seeder;

class DayWeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\DayWeek::create([
            'day' => 'Будни'
        ]);

        \App\DayWeek::create([
            'day' => 'Выходные'
        ]);

        \App\DayWeek::create([
            'day' => 'Ежедневно'
        ]);
    }
}
