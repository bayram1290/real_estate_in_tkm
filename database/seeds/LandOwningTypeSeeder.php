<?php

use Illuminate\Database\Seeder;

class LandOwningTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\LandOwningType::create([
           'type_ru' => 'в собственности',
           'type_en' => 'in ownership',
           'type_tm' => 'eýesiniň eýeçiliginde',
        ]);

        \App\LandOwningType::create([
            'type_ru' => 'в аренде',
            'type_en' => 'in rent',
            'type_tm' => 'kärendesinde',
            
        ]);

        \App\LandOwningType::create([
            'type_ru' => 'в субаренде',
            'type_en' => 'in subrent',
            'type_tm' => 'garaşly kärendesinde',
        ]);
    }
}
