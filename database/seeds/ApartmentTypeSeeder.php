<?php

use Illuminate\Database\Seeder;
use App\ApartmentType;

class ApartmentTypeSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        ApartmentType::create([
            'type_ru' => 'Элитная',
            'type_en' => 'Elite',
            'type_tm' => 'Elitka'
        ]);

        ApartmentType::create([
            'type_ru' => 'Полу элитная',
            'type_en' => 'Semi elite',
            'type_tm' => 'Ýary elitka'
        ]);

        ApartmentType::create([
            'type_ru' => 'Новостройка',
            'type_en' => 'Newly built',
            'type_tm' => 'Täze salnan'
        ]);

        ApartmentType::create([
            'type_ru' => 'Вторичка',
            'type_en' => 'Ordinary',
            'type_tm' => 'Adaty'
        ]);
        
    }
}
