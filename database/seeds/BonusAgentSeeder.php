<?php

use Illuminate\Database\Seeder;

class BonusAgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\BonusAgent::create([
           'bonus_ru' => 'Нет',
           'bonus_en' => 'No',
           'bonus_tm' => 'Ýok'
        ]);

        \App\BonusAgent::create([
            'bonus_ru' => 'Фиксированная сумма',
            'bonus_en' => 'Fixed amount',
            'bonus_tm' => 'Belli baha'
        ]);

        \App\BonusAgent::create([
            'bonus_ru' => 'Процент от сделки',
            'bonus_en' => 'Percent of the deal',
            'bonus_tm' => 'Söwdalaşygyň göteriminden'
        ]);
    }
}
