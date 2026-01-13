<?php

use Illuminate\Database\Seeder;
use App\Feature;

class FeatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Feature::create([
            'feature_en' => 'Furniture in rooms',
            'feature_ru' => 'Мебель в комнатах',
            'img' => '/images/icons/features/furn_in_rooms1.png',
            'type' => 1
        ]);

        App\Feature::create([
            'feature_en' => 'Furniture in kitchen',
            'feature_ru' => 'Мебель на кухне',
            'img' => '/images/icons/features/furn_in_kitchen.png',
            'type' => 1,
        ]);

        App\Feature::create([
            'feature_en' => 'Balcony',
            'feature_ru' => 'Балкон',
            'img' => '/images/icons/features/balcony.png',
            'type' => 1,
        ]);

        App\Feature::create([
            'feature_en' => 'Loggia',
            'feature_ru' => 'Лоджия',
            'img' => '/images/icons/features/loggia.png',
            'type' => 1
        ]);

        App\Feature::create([
            'feature_en' => 'Refrigerator',
            'feature_ru' => 'Холодильник',
            'img' => '/images/icons/features/refregirator.png',
            'type' => 2
        ]);

        App\Feature::create([
            'feature_en' => 'Dishwashing machine',
            'feature_ru' => 'Посудомоечная машина',
            'img' => '/images/icons/features/dishwashing.png',
            'type' => 2
        ]);

        App\Feature::create([
            'feature_en' => 'Laundry machine',
            'feature_ru' => 'Стиральная машина',
            'img' => '/images/icons/features/laundry.png',
            'type' => 2
        ]);

        App\Feature::create([
            'feature_en' => 'TV',
            'feature_ru' => 'Телевизор',
            'img' => '/images/icons/features/tv.png',
            'type' => 2
        ]);

//        App\Feature::create([
//            'feature_en' => 'Phone',
//            'feature_ru' => 'Телефон',
//            'img' => '/images/icons/features/furn_in_kitchen.png',
//            'type' => 2
//        ]);

        App\Feature::create([
            'feature_en' => 'Bath',
            'feature_ru' => 'Ванна',
            'img' => '/images/icons/features/bath.png',
            'type' => 3
        ]);

        App\Feature::create([
            'feature_en' => 'Shower',
            'feature_ru' => 'Душ',
            'img' => '/images/icons/features/shower.png',
            'type' => 3
        ]);

        App\Feature::create([
            'feature_en' => 'Internet',
            'feature_ru' => 'Интернет',
            'img' => '/images/icons/features/internet.png',
            'type' => 3
        ]);

        App\Feature::create([
            'feature_en' => 'Separated bathroom',
            'feature_ru' => 'Раздельный санузел',
            'img' => '/images/icons/features/seper_bath.png',
            'type' => 3
        ]);

        App\Feature::create([
            'feature_en' => 'Combined bathroom',
            'feature_ru' => 'Совмещённый санузел',
            'img' => '/images/icons/features/un_bath.png',
            'type' => 3
        ]);

    }
}
