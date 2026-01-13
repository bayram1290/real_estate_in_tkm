<?php

use Illuminate\Database\Seeder;

class LandStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\LandStatus::create([
            'status_ru' => 'Фермерское хоз-во',
            'status_en' => 'Farm enterprise',
            'status_tm' => 'Daýhan hojalygy'
        ]);

        \App\LandStatus::create([
            'status_ru' => 'Личное подсобное хозяйство',
            'status_en' => 'Private subsidiary enterprise',
            'status_tm' => 'Şahsa bagly hojalyk'
        ]);

        \App\LandStatus::create([
            'status_ru' => 'Садоводство',
            'status_en' => 'Gardening',
            'status_tm' => ''
        ]);

        \App\LandStatus::create([
            'status_ru' => 'ИЖС',
            'status_en' => 'Private housing construction',
            'status_tm' => 'Ekerançylyk hojalyk'
        ]);

        \App\LandStatus::create([
            'status_ru' => 'Земля промназначения',
            'status_en' => 'Industrial land',
            'status_tm' => 'Senagata degişli ýer'
        ]);

        \App\LandStatus::create([
            'status_ru' => 'ДНП',
            'status_en' => 'Suburban non-commercial partnership',
            'status_tm' => 'Söwdasyz daça hyzmatdaşlygy'
        ]);
    }
}
