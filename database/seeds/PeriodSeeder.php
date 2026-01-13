<?php

use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Period::create([
            'period_ru' => 'В месяц',
            'period_en' => 'Per month',
            'period_tm' => 'Aýda'
        ]);

        \App\Period::create([
            'period_ru' => 'В год',
            'period_en' => 'In year',
            'period_tm' => 'Ýylda'
        ]);
    }
}
