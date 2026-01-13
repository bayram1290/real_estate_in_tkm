<?php

use Illuminate\Database\Seeder;

class ParkingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Parking::create([
           'parking_ru' => 'Наземная',
           'parking_en' => 'On ground',
           'parking_tm' => 'Ýerüsti'
        ]);

        \App\Parking::create([
            'parking_ru' => 'Подземная',
            'parking_en' => 'Underground',
            'parking_tm' => 'Ýerasty'
            
        ]);

        \App\Parking::create([
            'parking_ru' => 'На территории объекта',
            'parking_en' => 'Inside property territory',
            'parking_tm' => 'Emlägiň içinde'
        ]);

        \App\Parking::create([
            'parking_ru' => 'За территорией объекта',
            'parking_en' => 'Near property territory',
            'parking_tm' => 'Emlägiň ýanynda'
        ]);

        \App\Parking::create([
           'parking_ru' => 'Обе',
           'parking_en' => 'Both',
           'parking_tm' => 'Her ikisi-de'
        ]);
    }
}
