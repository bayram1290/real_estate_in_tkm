<?php

use Illuminate\Database\Seeder;
use App\propertyObjectType;

class propertyObjectTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        propertyObjectType::create([
            'name_ru' => 'квартиры',
            'name_en' => 'Apartment',
            'name_tm' => 'kwartira'
        ]);

        propertyObjectType::create([
            'name_ru' => 'элитной квартиры',
            'name_en' => 'Elite apartment',
            'name_tm' => 'elitniý kwartira'
        ]);

        propertyObjectType::create([
            'name_ru' => 'дома/дачи',
            'name_en' => 'House/detached house',
            'name_tm' => 'jaý/daça'
        ]);

        propertyObjectType::create([
            'name_ru' => 'коттеджа',
            'name_en' => 'Cottage',
            'name_tm' => 'kotež'
        ]);

        propertyObjectType::create([
            'name_ru' => 'части дома',
            'name_en' => 'Part of the house',
            'name_tm' => 'jaýyň bölegi'
        ]);

        propertyObjectType::create([
            'name_ru' => 'офиса',
            'name_en' => 'Office',
            'name_tm' => 'ofis'
        ]);

        propertyObjectType::create([
            'name_ru' => 'здания',
            'name_en' => 'Building',
            'name_tm' => 'bina'
        ]);

        propertyObjectType::create([
            'name_ru' => 'торговой точки',
            'name_en' => 'Outlet point',
            'name_tm' => 'söwda nokady'
        ]);

        propertyObjectType::create([
            'name_ru' => 'помещения под производство',
            'name_en' => 'Production environment',
            'name_tm' => 'önümçilik ýeri'
        ]);

        propertyObjectType::create([
            'name_ru' => 'склада',
            'name_en' => 'Warehouse',
            'name_tm' => 'sklad'
        ]);

        propertyObjectType::create([
            'name_ru' => 'готового бизнеса',
            'name_en' => 'Ready-made business',
            'name_tm' => 'taýyn biznes'
        ]);
    }
}
