<?php

use Illuminate\Database\Seeder;
use App\propertyDealType;

class propertyDealTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        propertyDealType::create([
            'type_ru' => 'Аренда',
            'type_en' => 'for rent',
            'type_tm' => 'Kärendesine'
        ]);

        propertyDealType::create([
            'type_ru' => 'Продажа',
            'type_en' => 'for sale',
            'type_tm' => 'Satlyk'
        ]);
    }
}
