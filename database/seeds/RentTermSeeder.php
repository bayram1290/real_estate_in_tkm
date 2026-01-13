<?php

use Illuminate\Database\Seeder;

class RentTermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\RentTerm::create([
            'term_ru' => 'Длительный',
            'term_en' => 'Prolonged',
            'term_tm' => 'Uzak möhletli'
        ]);

        \App\RentTerm::create([
            'term_ru' => 'Несколько месяцев',
            'term_en' => 'A few months',
            'term_tm' => 'Gysga möhletli'
        ]);
    }
}
