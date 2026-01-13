<?php

use Illuminate\Database\Seeder;

class BusinessTypePropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\BusinessTypeProperty::create([
           'type_ru' => 'Офис',
           'type_en' => 'Office',
           'type_tm' => 'Ofis'
        ]);

        \App\BusinessTypeProperty::create([
            'type_ru' => 'Склад',
            'type_en' => 'Warehouse',
            'type_tm' => 'Sklad'
        ]);

        \App\BusinessTypeProperty::create([
            'type_ru' => 'Торговая площадь',
            'type_en' => 'Outlet point',
            'type_tm' => 'Söwda ýeri'
        ]);

        \App\BusinessTypeProperty::create([
            'type_ru' => 'Производство',
            'type_en' => 'Production place',
            'type_tm' => 'Önümçilik ýeri'
        ]);

        \App\BusinessTypeProperty::create([
            'type_ru' => 'Здание',
            'type_en' => 'Building',
            'type_tm' => 'Bina'
        ]);

        \App\BusinessTypeProperty::create([
            'type_ru' => 'Помещение свободного назначения',
            'type_en' => 'Free appointment premises',
            'type_tm' => 'Erkin maksatly binalar'
        ]);
    }
}
