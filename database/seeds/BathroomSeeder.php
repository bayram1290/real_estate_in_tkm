<?php

use Illuminate\Database\Seeder;
use App\Bathroom;

class BathroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bathroom::create([
           'bathroom_ru' => 'На улице',
           'bathroom_en' => 'Outside',
           'bathroom_tm' => 'Daşynda'
        ]);

        Bathroom::create([
            'bathroom_ru' => 'В доме',
            'bathroom_en' => 'Inside',
            'bathroom_tm' => 'Öýde'
        ]);

        Bathroom::create([
            'bathroom_ru' => 'Обе',
            'bathroom_en' => 'Both',
            'bathroom_tm' => 'Her ikisi-de'
        ]);
    }
}
