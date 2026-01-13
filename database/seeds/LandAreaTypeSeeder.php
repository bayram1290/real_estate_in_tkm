<?php

use Illuminate\Database\Seeder;
use App\LandAreaType;

class LandAreaTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LandAreaType::create([
           'type_ru' => 'сот',
           'type_en' => 'are',
           'type_tm' => 'sotok'
        ]);

        LandAreaType::create([
            'type_ru' => 'га',
            'type_en' => 'ha',
            'type_tm' => 'gek'
        ]);
    }
}
