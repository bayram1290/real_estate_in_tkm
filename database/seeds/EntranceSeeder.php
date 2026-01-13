<?php

use Illuminate\Database\Seeder;

class EntranceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Entrance::create([
           'entrance_ru' => 'Свободный',
           'entrance_en' => 'Free',
           'entrance_tm' => 'Açyk',
        ]);

        \App\Entrance::create([
            'entrance_ru' => 'Пропускная система',
            'entrance_en' => 'Pass system',
            'entrance_tm' => 'Geçiriji ulgam',
        ]);
    }
}
