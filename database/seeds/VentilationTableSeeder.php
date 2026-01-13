<?php

use Illuminate\Database\Seeder;
use App\Ventilation;

class VentilationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ventilation::create([
           'ventilation_ru' => 'естественная',
           'ventilation_en' => 'original',
           'ventilation_tm' => 'adaty'
        ]);

        Ventilation::create([
            'ventilation_ru' => 'приточная',
            'ventilation_en' => 'air supply',
            'ventilation_tm' => 'howa ulgamy'
        ]);

        Ventilation::create([
            'ventilation_ru' => 'нет',
            'ventilation_en' => 'no',
            'ventilation_tm' => 'ýok'
        ]);
    }
}
