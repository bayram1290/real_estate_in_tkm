<?php

use Illuminate\Database\Seeder;

class BuildingEntranceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\BuildingEntrance::create([
           'entrance_ru' => 'Отдельный со двора',
           'entrance_en' => 'Separate from the yard',
           'entrance_tm' => 'Aýratyn howlydan'
        ]);

        \App\BuildingEntrance::create([
            'entrance_ru' => 'Отдельный с улицы',
            'entrance_en' => 'Separate from the street',
            'entrance_tm' => 'Aýratyn köçeden'
        ]);

        \App\BuildingEntrance::create([
            'entrance_ru' => 'Общий со двора',
            'entrance_en' => 'Common from the yard',
            'entrance_tm' => 'Howlydan umumy'
        ]);

        \App\BuildingEntrance::create([
            'entrance_ru' => 'Общий с улицы',
            'entrance_en' => 'Common from the street',
            'entrance_tm' => 'Köçeden umumy'
        ]);
    }
}
