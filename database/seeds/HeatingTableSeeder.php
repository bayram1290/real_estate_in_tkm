<?php

use Illuminate\Database\Seeder;
use App\Heating;

class HeatingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Heating::create([
            'heating_ru' => 'Автономное',
            'heating_en' => 'Autonomous',
            'heating_tm' => 'Awtonom',
            'type' => 1
        ]);

        Heating::create([
            'heating_ru' => 'Центральное',
            'heating_en' => 'Central',
            'heating_tm' => 'Merkezi',
            'type' => 1
        ]);

        Heating::create([
            'heating_ru' => 'Нет',
            'heating_en' => 'No',
            'heating_tm' => 'Ýok',
            'type' => 1
        ]);

        Heating::create([
            'heating_ru' => 'Центральное газовое',
            'heating_en' => 'Central gas',
            'heating_tm' => 'Merkezi gaz bilen',
            'type' => 2
        ]);

        Heating::create([
            'heating_ru' => 'Центральное угольное',
            'heating_en' => 'Central coal',
            'heating_tm' => 'Merkezi kömür bilen',
            'type' => 2
        ]);

        Heating::create([
            'heating_ru' => 'Печь',
            'heating_en' => 'Furnace',
            'heating_tm' => 'Peç',
            'type' => 2
        ]);

        Heating::create([
            'heating_ru' => 'Камин',
            'heating_en' => 'Fireplace',
            'heating_tm' => 'Ot ojagy',
            'type' => 2
        ]);

        Heating::create([
            'heating_ru' => 'Без отопления',
            'heating_en' => 'Without heating',
            'heating_tm' => 'Ýyladyjysyz',
            'type' => 2
        ]);

    }
}
