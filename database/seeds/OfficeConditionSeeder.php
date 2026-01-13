<?php

use Illuminate\Database\Seeder;

class OfficeConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\OfficeCondition::create([
           'condition_ru' => 'С ремонтом',
           'condition_en' => 'Renovated',
           'condition_tm' => 'Remont edilen'
        ]);

        \App\OfficeCondition::create([
            'condition_ru' => 'Евроремонт',
            'condition_en' => 'Western-styled',
            'condition_tm' => 'Ýewro-remontly'
        ]);

        \App\OfficeCondition::create([
            'condition_ru' => 'Без ремонта',
            'condition_en' => 'Without repair',
            'condition_tm' => 'Remontsyz'
        ]);
    }
}
