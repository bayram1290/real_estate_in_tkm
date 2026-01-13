<?php

use Illuminate\Database\Seeder;

class SaleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\SaleType::create([
           'type_ru' => 'Свободная продажа',
           'type_en' => 'Free sale',
           'type_tm' => 'Erkin satuw'
        ]);

        \App\SaleType::create([
            'type_ru' => 'Альтернатива',
            'type_en' => 'Alternative',
            'type_tm' => 'Alternatiwa'
        ]);
    }
}
