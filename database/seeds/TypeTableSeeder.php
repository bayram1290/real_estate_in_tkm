<?php

use Illuminate\Database\Seeder;
use App\Type;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    App\Type::create([
		    'name_en' => 'Living',
		    'name_ru' => 'Жилая'
	    ]);

	    App\Type::create([
		    'name_en' => 'Commercial',
		    'name_ru' => 'Коммерческая'
	    ]);
    }
}
