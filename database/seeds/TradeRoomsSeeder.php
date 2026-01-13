<?php

use Illuminate\Database\Seeder;

class TradeRoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\TradeRoom::create([
           'room_ru' => 'Помещение в торговом комплексе',
           'room_en' => 'Premises in a shopping center',
           'room_tm' => 'Söwda toplumyndaky ýer'
        ]);

        \App\TradeRoom::create([
            'room_ru' => 'Место на улице',
            'room_en' => 'Place on the street',
            'room_tm' => 'Köçede/daşarda bir ýer'
        ]);
    }
}
