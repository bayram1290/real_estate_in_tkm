<?php

use Illuminate\Database\Seeder;
use App\ObjectNames;

class ObjectNamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ObjectNames::create([
        	'type_id' => 1,
        	'name_ru' => 'Квартира',
			'name_en' => 'Apartment',
			'name_tm' => 'Kwartira'
		]);
		
		ObjectNames::create([
        	'type_id' => 1,
        	'name_ru' => 'Элитная квартира',
			'name_en' => 'Elite apartment',
			'name_tm' => 'Elitniý kwartira'
		]);
		
	    ObjectNames::create([
		    'type_id' => 1,
		    'name_ru' => 'Дом/Дача',
			'name_en' => 'House/Country House',
			'name_tm' => 'Jaý/Daça'
	    ]);

	    ObjectNames::create([
		    'type_id' => 1,
		    'name_ru' => 'Коттедж',
			'name_en' => 'Cottage',
			'name_tm' => 'Kotež'
	    ]);

	    ObjectNames::create([
		    'type_id' => 1,
		    'name_ru' => 'Часть дома',
			'name_en' => 'Part of home',
			'name_tm' => 'Jaýyň bölegi'			
	    ]);

	    ObjectNames::create([
		    'type_id' => 2,
		    'name_ru' => 'Офис',
			'name_en' => 'Office',
			'name_tm' => 'Ofis'
	    ]);

	    ObjectNames::create([
		    'type_id' => 2,
		    'name_ru' => 'Здание',
			'name_en' => 'Building',
			'name_tm' => 'Bina'
		]);
		
		ObjectNames::create([
            'type_id' => 2,
            'name_ru' => 'Торговая точка',
			'name_en' => 'Trade point',
			'name_tm' => 'Söwda nokady'
		]);
		
		ObjectNames::create([
            'type_id' => 2,
            'name_ru' => 'Производство',
			'name_en' => 'Manufacture',
			'name_tm' => 'Önümçilik ýeri'
        ]);

	    ObjectNames::create([
		    'type_id' => 2,
		    'name_ru' => 'Склад',
			'name_en' => 'Warehouse',
			'name_tm' => 'Sklad'
	    ]);      

        ObjectNames::create([
            'type_id' => 2,
            'name_ru' => 'Готовый бизнес',
			'name_en' => 'Business',
			'name_tm' => 'Taýyn biznes'
		]);
    }
}
