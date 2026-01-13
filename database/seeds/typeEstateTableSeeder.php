<?php

use Illuminate\Database\Seeder;
use App\typeEstate;

class typeEstateTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        
        typeEstate::create([
            'e_type_ru' => 'Жилая',
            'e_type_en' => 'Residential',
            'e_type_tm' => 'Ýaşaýyş'
        ]);

        typeEstate::create([
            'e_type_ru' => 'Коммерческая',
            'e_type_en' => 'Commercial',
            'e_type_tm' => 'Täjirçilik'
        ]);
    }
}
