<?php

use Illuminate\Database\Seeder;

class BuildingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Building::create([
            'building_ru' => 'Кирпичный',
            'building_en' => 'Brick',
            'building_tm' => ''
        ]);

        \App\Building::create([
            'building_ru' => 'Монолитный',
            'building_en' => 'Monolithic',
            'building_tm' => ''
        ]);

        \App\Building::create([
            'building_ru' => 'Панельный',
            'building_en' => 'Panel structured',
            'building_tm' => ''
        ]);

        \App\Building::create([
            'building_ru' => 'Блочный',
            'building_en' => 'Block-structured',
            'building_tm' => ''
        ]);

        \App\Building::create([
            'building_ru' => 'Монолитно-кирпичный',
            'building_en' => 'Mono-brick',
            'building_tm' => ''
        ]);

        \App\Building::create([
            'building_ru' => 'Каркасный',
            'building_en' => 'Light-frame',
            'building_tm' => 'Karkas'
        ]); 
        
    }
}
