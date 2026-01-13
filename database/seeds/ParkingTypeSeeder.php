<?php

use Illuminate\Database\Seeder;

class ParkingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\ParkingType::create([
           'type_ru' => 'Для легковесного транспорта',
           'type_en' => 'For light vehicles',
           'type_tm' => 'Ýeňil ulaglar üçin'
        ]);

        \App\ParkingType::create([
            'type_ru' => 'Для грузового транспорта',
            'type_en' => 'For trucks',
            'type_tm' => 'Ýük ulaglar üçin'
        ]);
    }
}
