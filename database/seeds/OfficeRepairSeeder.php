<?php

use Illuminate\Database\Seeder;
use App\OfficeRepair;

class OfficeRepairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OfficeRepair::create([
           'repair_ru' => 'Кабинетная',
           'repair_en' => 'Office',
           'repair_tm' => 'Ofis'
        ]);

        OfficeRepair::create([
            'repair_ru' => 'Открытая',
            'repair_en' => 'Open',
            'repair_tm' => 'Açyk'
        ]);

        OfficeRepair::create([
            'repair_ru' => 'Коридорная',           
            'repair_en' => 'Corridor',
            'repair_tm' => 'Koridorly'
        ]);

        OfficeRepair::create([
            'repair_ru' => 'Смешанная',
            'repair_en' => 'Compound',
            'repair_tm' => 'Garyşyk'
        ]);

    }
}
